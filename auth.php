<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');
require_once($CFG->libdir.'/filelib.php');

/**
 * Authentication Plugin for BF authentication with hCaptcha and brute force protection.
 */
class auth_plugin_bf extends auth_plugin_base {
    /**
     * Constructor.
     */
    public function __construct() {
        $this->authtype = 'bf';
        $this->config = get_config('auth_bf');
    }

    /**
     * Verify hCaptcha response.
     *
     * @param string $response The hCaptcha response from the form
     * @return bool True if verification successful, false otherwise
     */
    private function verify_recaptcha($response) {
        if (empty($this->config->recaptcha_secret_key)) {
            return true; // Skip verification if not configured
        }

        $url = 'https://hcaptcha.com/siteverify';
        $data = [
            'secret' => $this->config->recaptcha_secret_key,
            'response' => $response
        ];

        $curl = new curl();
        $options = [
            'CURLOPT_RETURNTRANSFER' => true,
            'CURLOPT_POST' => true,
            'CURLOPT_POSTFIELDS' => $data
        ];
        
        $result = $curl->post($url, $data, $options);
        $response = json_decode($result);

        return isset($response->success) && $response->success === true;
    }

    /**
     * Check if user is locked out due to too many failed attempts.
     *
     * @param string $username The username to check
     * @return bool|int False if not locked out, lockout remaining time in seconds if locked
     */
    private function check_lockout($username) {
        global $DB;

        $max_attempts = empty($this->config->max_attempts) ? 3 : $this->config->max_attempts;
        $lockout_duration = empty($this->config->lockout_duration) ? 300 : $this->config->lockout_duration;

        $attempts = $DB->get_record('auth_bf_attempts', ['username' => $username]);
        
        if (!$attempts) {
            return false;
        }

        if ($attempts->count >= $max_attempts) {
            $time_passed = time() - $attempts->last_attempt;
            if ($time_passed < $lockout_duration) {
                return $lockout_duration - $time_passed;
            }
            // Reset attempts after lockout period
            $DB->delete_records('auth_bf_attempts', ['username' => $username]);
        }

        return false;
    }

    /**
     * Record failed login attempt.
     *
     * @param string $username The username that failed to login
     */
    private function record_failed_attempt($username) {
        global $DB;

        $attempt = $DB->get_record('auth_bf_attempts', ['username' => $username]);
        
        if ($attempt) {
            $attempt->count++;
            $attempt->last_attempt = time();
            $DB->update_record('auth_bf_attempts', $attempt);
        } else {
            $attempt = new stdClass();
            $attempt->username = $username;
            $attempt->count = 1;
            $attempt->last_attempt = time();
            $DB->insert_record('auth_bf_attempts', $attempt);
        }
    }

    /**
     * Returns true if the username and password work and false if they are
     * wrong or don't exist.
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Authentication success or failure.
     */
    public function user_login($username, $password) {
        global $CFG, $DB;

        // Check for lockout
        if ($lockout = $this->check_lockout($username)) {
            throw new moodle_exception('error_too_many_attempts', 'auth_bf', '', $lockout);
        }

        // Verify hCaptcha if configured
        if (!empty($this->config->recaptcha_secret_key)) {
            $hcaptcha_response = optional_param('h-captcha-response', '', PARAM_TEXT);
            if (!$this->verify_recaptcha($hcaptcha_response)) {
                throw new moodle_exception('error_recaptcha', 'auth_bf');
            }
        }
        
        if ($user = $DB->get_record('user', array('username' => $username, 'mnethostid' => $CFG->mnet_localhost_id))) {
            if (validate_internal_user_password($user, $password)) {
                // Reset failed attempts on successful login
                $DB->delete_records('auth_bf_attempts', ['username' => $username]);
                return true;
            }
        }
        
        // Record failed attempt
        $this->record_failed_attempt($username);
        return false;
    }

    /**
     * Updates the user's password.
     *
     * @param  object  $user        User table object
     * @param  string  $newpassword Plaintext password
     * @return boolean result
     */
    public function user_update_password($user, $newpassword) {
        $user = get_complete_user_data('id', $user->id);
        return update_internal_user_password($user, $newpassword);
    }

    /**
     * Returns true if this authentication plugin can change the user's password.
     *
     * @return bool
     */
    public function can_change_password() {
        return true;
    }

    /**
     * Returns true if this authentication plugin is 'internal'.
     *
     * @return bool
     */
    public function is_internal() {
        return true;
    }

    /**
     * Modify the login form.
     *
     * @param object $form mform object
     */
    public function loginform_hook($form) {
        if (!empty($this->config->recaptcha_site_key)) {
            // Add hCaptcha script
            global $PAGE;
            $PAGE->requires->js_call_amd('auth_bf/recaptcha', 'init', array($this->config->recaptcha_site_key));
            
            // Add hCaptcha element
            $form->addElement('html', '<div class="h-captcha mb-3" data-sitekey="' . 
                $this->config->recaptcha_site_key . '"></div>');
        }
    }

    /**
     * Hook for login page
     *
     * This method is called from the login page to add additional elements to the login form
     */
    public function loginpage_hook() {
        global $PAGE;

        if (empty($this->config->recaptcha_site_key)) {
            return;
        }

        // Add hCaptcha JS
        $PAGE->requires->js_call_amd('auth_bf/recaptcha', 'init', array($this->config->recaptcha_site_key));

        // Return the hCaptcha div
        return html_writer::div('', 'h-captcha', array(
            'data-sitekey' => $this->config->recaptcha_site_key
        ));
    }
}
