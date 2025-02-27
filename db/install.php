<?php
// auth_bf/db/install.php
function xmldb_auth_bf_install() {
    set_config('auth', 'bf'); // Set as primary auth method
    set_config('registerauth', 'bf');
    return true;
}