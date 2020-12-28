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
 * Page example.
 *
 * @package   tool_guillogo
 * @copyright 2020, Guillermo Gomez <guillermogomez@catalyst-au.net>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
$cmid = optional_param('id', '',PARAM_INT );

// Set up the page.
$title = get_string('pluginname', 'tool_guillogo');
$pagetitle = $title;
$url = new moodle_url('/admin/tool/guillogo/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('report');
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($title);

echo $OUTPUT->header();

echo html_writer::div(get_string('hello', 'tool_guillogo'));
echo html_writer::div(get_string('courseid', 'tool_guillogo', $cmid));

echo $OUTPUT->footer();