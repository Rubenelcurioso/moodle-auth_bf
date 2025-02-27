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

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    // hCaptcha settings.
    $settings->add(new admin_setting_heading('auth_bf/hcaptchasettings',
        get_string('hcaptchasettings', 'auth_bf'),
        get_string('hcaptchasettingsinfo', 'auth_bf')));

    $settings->add(new admin_setting_configtext('auth_bf/hcaptcha_site_key',
        get_string('hcaptcha_site_key', 'auth_bf'),
        get_string('hcaptcha_site_key_desc', 'auth_bf'),
        '', PARAM_TEXT));

    $settings->add(new admin_setting_configtext('auth_bf/hcaptcha_secret_key',
        get_string('hcaptcha_secret_key', 'auth_bf'),
        get_string('hcaptcha_secret_key_desc', 'auth_bf'),
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
