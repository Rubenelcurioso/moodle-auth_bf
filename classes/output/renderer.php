<?php
namespace auth_bf\output;

defined('MOODLE_INTERNAL') || die();

class renderer extends \plugin_renderer_base {

    public function get_template_names() {
        return [
            'auth_bf/custom_login',
        ];
    }

    /**
     * Render the custom login form.
     * @param custom_login $customlogin
     * @return string HTML output
     */
    public function render_custom_login(custom_login $customlogin) {
        return $this->render_from_template('auth_bf/custom_login', $customlogin->export_for_template($this));
    }
}