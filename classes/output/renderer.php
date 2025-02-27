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

use plugin_renderer_base;

/**
 * Renderer for auth_bf.
 */
class renderer extends plugin_renderer_base {
    /**
     * Render the custom login page.
     *
     * @param custom_login $page The custom login page
     * @return string HTML
     */
    public function render_custom_login(custom_login $page) {
        $data = $page->export_for_template($this);
        return $this->render_from_template('auth_bf/custom_login', $data);
    }
}
