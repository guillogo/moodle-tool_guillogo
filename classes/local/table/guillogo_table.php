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
 * Teams and channels groups table.
 *
 * @package   tool_guillogo
 * @author    Guillermo Gomez <guigomar@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_guillogo\local\table;

use table_sql;

class guillogo_table extends table_sql {

    /**
     * Store the course id.
     *
     * @var int Course id
     */
    private $courseid;

    /**
     * Constructor
     * @param string $uniqueid all tables have to have a unique id, this is used
     *      as a key when storing table properties like sort order in the session.
     * @param int $courseid
     */
    public function __construct($uniqueid, $courseid = null) {
        parent::__construct($uniqueid);

        $fields = '*';
        $from = '{tool_guillogo}';
        $where = 'courseid = ?';
        $params = [$courseid];

        $this->set_sql($fields, $from, $where, $params);

        // Define the list of columns to show.
        $columns =
            [
                'courseid',
                'name',
                'completed',
                'priority',
                'timecreated',
                'timemodified',
            ];
        $this->define_columns($columns);

        // Define the titles of columns to show in header.
        $headers =
            [
                get_string('courseidheader', 'tool_guillogo'),
                get_string('name', 'tool_guillogo'),
                get_string('completed', 'tool_guillogo'),
                get_string('priority', 'tool_guillogo'),
                get_string('timecreated', 'tool_guillogo'),
                get_string('timemodified', 'tool_guillogo'),
            ];
        $this->define_headers($headers);

        $this->courseid = $courseid;
    }

    /**
     * This function is called for each data row to allow processing of the
     * name value.
     *
     * @param object $values Contains object with all the values of record.
     * @return string Return group_members template rendered.
     */
    public function col_name($values) {
        return format_string($values->name);
    }

    /**
     * This function is called for each data row to allow processing of the
     * completed value.
     *
     * @param object $values Contains object with all the values of record.
     * @return string Return group_members template rendered.
     */
    public function col_completed($values) {
        return $values->completed ? get_string('yes') : get_string('no');
    }

    /**
     * This function is called for each data row to allow processing of the
     * timecreated value.
     *
     * @param object $values Contains object with all the values of record.
     * @return string Return group_members template rendered.
     */
    public function col_timecreated($values) {
        return userdate($values->timecreated);
    }

    /**
     * This function is called for each data row to allow processing of the
     * timemodified value.
     *
     * @param object $values Contains object with all the values of record.
     * @return string Return group_members template rendered.
     */
    public function col_timemodified($values) {
        return userdate($values->timemodified);
    }
}