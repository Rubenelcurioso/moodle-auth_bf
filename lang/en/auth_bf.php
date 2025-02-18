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

$string['pluginname'] = 'BF Authentication';
$string['auth_bfdescription'] = 'This authentication method uses BF to verify user credentials against Moodle\'s database with added protection against brute force attacks.';
$string['auth_bftitle'] = 'BF Authentication';

// reCAPTCHA settings
$string['recaptchasettings'] = 'reCAPTCHA Settings';
$string['recaptchasettingsinfo'] = 'Configure Google reCAPTCHA v2 settings. You can obtain these from https://www.google.com/recaptcha/admin';
$string['recaptcha_site_key'] = 'Site Key';
$string['recaptcha_site_key_desc'] = 'The reCAPTCHA Site Key provided by Google';
$string['recaptcha_secret_key'] = 'Secret Key';
$string['recaptcha_secret_key_desc'] = 'The reCAPTCHA Secret Key provided by Google';

// Brute force protection settings
$string['bfsettings'] = 'Brute Force Protection Settings';
$string['bfsettingsinfo'] = 'Configure protection against brute force attacks';
$string['max_attempts'] = 'Maximum Login Attempts';
$string['max_attempts_desc'] = 'Number of failed login attempts before temporary lockout';
$string['lockout_duration'] = 'Lockout Duration';
$string['lockout_duration_desc'] = 'Duration of the lockout in seconds';

// Error messages
$string['error_recaptcha'] = 'The reCAPTCHA verification failed. Please try again.';
$string['error_too_many_attempts'] = 'Too many failed login attempts. Your account has been temporarily locked for {$a} seconds.';
