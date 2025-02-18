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

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->ad('auth', new admin_category('auth_bf', get_string('auth_bf', 'auth_bf')));
    $settings = new admin_settingpage('auth_bf', get_string('auth_bf', 'auth_bf'));

    if ($ADMIN->fulltree) {
        // reCAPTCHA settings.
        $settings->add(new admin_setting_heading('auth_bf/recaptchasettings',
            get_string('recaptchasettings', 'auth_bf'),
            get_string('recaptchasettingsinfo', 'auth_bf')));
    
        $settings->add(new admin_setting_configtext('auth_bf/recaptcha_site_key',
            get_string('recaptcha_site_key', 'auth_bf'),
            get_string('recaptcha_site_key_desc', 'auth_bf'),
            '', PARAM_TEXT));
    
        $settings->add(new admin_setting_configtext('auth_bf/recaptcha_secret_key',
            get_string('recaptcha_secret_key', 'auth_bf'),
            get_string('recaptcha_secret_key_desc', 'auth_bf'),
            '', PARAM_TEXT));
    
        // Anti-brute force settings.
        $settings->add(new admin_setting_heading('auth_bf/bfsettings',
            get_string('bfsettings', 'auth_bf'),
            get_string('bfsettingsinfo', 'auth_bf')));
    
        $settings->add(new admin_setting_configtext('auth_bf/max_attempts',
            get_string('max_attempts', 'auth_bf'),
            get_string('max_attempts_desc', 'auth_bf'),
            '3', PARAM_INT));
    
        $settings->add(new admin_setting_configtext('auth_bf/lockout_duration',
            get_string('lockout_duration', 'auth_bf'),
            get_string('lockout_duration_desc', 'auth_bf'),
            '300', PARAM_INT));
    }
}


