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

namespace auth_bf\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;

/**
 * Custom login page renderable.
 */
class custom_login implements renderable, templatable {
    /** @var array The data for the template */
    protected $data;

    /**
     * Constructor.
     *
     * @param array $data The data for the template
     */
    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * Export the data for the mustache template.
     *
     * @param renderer_base $output The renderer
     * @return array The data for the template
     */
    public function export_for_template(renderer_base $output) {
        return $this->data;
    }
}
