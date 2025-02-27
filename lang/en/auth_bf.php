<?php
// This file is part of an external plugin for Moodle - http://moodle.org/
// This plugin is licensed under GNU Public License v3.
//
// This plugin is NOT part of the Moodle core and is provided as is. It is developed independently
// and must comply with the GNU Public License v3 requirements.
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

$string['pluginname'] = 'Anti-Brute Force Authentication';
$string['auth_bfdescription'] = 'This authentication method uses BF to verify user credentials against Moodle\'s database with added protection against brute force attacks.';
$string['auth_bftitle'] = 'Anti-Brute Force Authentication';

// hCaptcha settings
$string['hcaptchasettings'] = 'hCaptcha Settings';
$string['hcaptchasettingsinfo'] = 'Configure hCaptcha settings for brute force protection.';
$string['hcaptcha_site_key'] = 'hCaptcha Site Key';
$string['hcaptcha_site_key_desc'] = 'The site key from your hCaptcha dashboard.';
$string['hcaptcha_secret_key'] = 'hCaptcha Secret Key';
$string['hcaptcha_secret_key_desc'] = 'The secret key from your hCaptcha dashboard.';

// Brute force protection settings
$string['bfsettings'] = 'Brute Force Protection Settings';
$string['bfsettingsinfo'] = 'Configure protection against brute force attacks';
$string['max_attempts'] = 'Maximum Login Attempts';
$string['max_attempts_desc'] = 'Number of failed login attempts before temporary lockout';
$string['lockout_duration'] = 'Lockout Duration';
$string['lockout_duration_desc'] = 'Duration of the lockout in seconds';

// Error messages
$string['error_hcaptcha'] = 'The hCaptcha verification failed. Please try again.';
$string['error_too_many_attempts'] = 'Too many failed login attempts. Your account has been temporarily locked for {$a} seconds.';
$string['error_login'] = 'The username or password is incorrect.';

// Custom login form
$string['entercaptcha'] = 'Please complete the hCaptcha verification';
$string['pleaseverifycaptcha'] = 'Please complete the hCaptcha verification before logging in';
$string['username'] = 'Username';
$string['password'] = 'Password';
$string['login'] = 'Log in';
