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

/**
 * This page lists public api for tool_guillogo plugin.
 *
 * @package    tool_guillogo
 * @author     Guillermo Gomez Arias <guigomar@gmail.com>
 * @copyright  2020 Guillermo Gomez Arias
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * This function extends the navigation with the tool items.
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass $course The course to object for the tool
 * @param context $context The context of the course
 * @throws coding_exception|moodle_exception
 */
function tool_guillogo_extend_navigation_course($navigation, $course, $context) {

    if (has_capability('tool/guillogo:view', $context)) {
        $navigation->add(
            get_string('pluginname', 'tool_guillogo'),
            new moodle_url('/admin/tool/guillogo/index.php', ['id' => $course->id]),
            navigation_node::TYPE_SETTING,
            get_string('pluginname', 'tool_guillogo'),
            'guillogo',
            new pix_icon('icon', '', 'tool_guillogo')
        );
    }
}