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
 * Upgrade code.
 *
 * @package    tool_guillogo
 * @author     Guillermo Gomez Arias <guigomar@gmail.com>
 * @copyright  2020 Guillermo Gomez Arias
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Function to upgrade tool_guillogo.
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_tool_guillogo_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2020122805) {

        // Define table tool_guillogo to be created.
        $table = new xmldb_table('tool_guillogo');

        // Adding fields to table tool_guillogo.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('courseid', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('completed', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('priority', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '1');
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, null, null, null);
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, null, null, null);

        // Adding keys to table tool_guillogo.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for tool_guillogo.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Guillogo savepoint reached.
        upgrade_plugin_savepoint(true, 2020122805, 'tool', 'guillogo');
    }

    if ($oldversion < 2020122806) {

        $table = new xmldb_table('tool_guillogo');
        // Define key courseid (foreign) to be added to tool_guillogo.
        $key = new xmldb_key('courseid', XMLDB_KEY_FOREIGN, ['courseid'], 'course', ['id']);
        // Define index courseidname (unique) to be added to tool_guillogo.
        $index = new xmldb_index('courseidname', XMLDB_INDEX_UNIQUE, ['courseid', 'name']);

        // Launch add key courseid.
        $dbman->add_key($table, $key);
        // Conditionally launch add index courseidname.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Guillogo savepoint reached.
        upgrade_plugin_savepoint(true, 2020122806, 'tool', 'guillogo');
    }

    return true;
}