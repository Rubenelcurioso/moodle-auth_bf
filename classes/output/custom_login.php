<?php
// This file is part of Moodle auth_bf plugin.

namespace auth_bf\output;

defined('MOODLE_INTERNAL') || die();

/**
 * Renderable custom login form
 */
class custom_login implements \renderable, \templatable {
    /**
     * Data required by the template
     * @var array
     */
    protected $data;

    /**
     * Constructor
     * @param array $data Data for the template, e.g. loginurl, username, captcha_site_key, sesskey
     */
    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * Exports the data for rendering via mustache
     * @param \renderer_base $output
     * @return array
     */
    public function export_for_template(\renderer_base $output) {
        return $this->data;
    }
}
