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
 * @package    tool_guillogo
 * @author     Guillermo Gomez Arias <guigomar@gmail.com>
 * @copyright  2020 Guillermo Gomez Arias
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use tool_guillogo\local\table\guillogo_table;

require_once(__DIR__ . '/../../../config.php');
require_once('../../../lib/tablelib.php');

$courseid = required_param('id', PARAM_INT );

$url = new moodle_url('/admin/tool/guillogo/index.php');
$title = get_string('pluginname', 'tool_guillogo');
$context = context_course::instance($courseid);

require_login($courseid);
require_capability('tool/guillogo:view', $context);

// Set up the page.
$PAGE->set_context($context);
$PAGE->set_pagelayout('report');
$PAGE->set_url($url, ['id' => $courseid]);
$PAGE->set_title($title);
$PAGE->set_heading($title);

$coursenode = $PAGE->settingsnav->add($title, $PAGE->url, navigation_node::TYPE_CONTAINER);

echo $OUTPUT->header();

echo html_writer::div(get_string('hello', 'tool_guillogo'));
echo html_writer::div(get_string('courseid', 'tool_guillogo', $courseid));

$table = 'course';

$courseinfo = $DB->get_records($table, ['id' => $courseid]);
foreach ($courseinfo as $info) {
    echo html_writer::div($info->fullname);
}

$table = new guillogo_table('manage-guillogo', $courseid);
$table->define_baseurl($PAGE->url);
$table->out(200, true);


echo $OUTPUT->footer();