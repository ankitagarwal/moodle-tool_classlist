<?php
// This file is part of Class list tool for Moodle
//
// Class list is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Advanced Spam Cleaner is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// For a copy of the GNU General Public License, see <http://www.gnu.org/licenses/>.

/**
 * Main page to display class list reports.
 *
 * @package    tool_classlist
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');

require_login();
admin_externalpage_setup('toolclasslist');

$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'tool_classlist'));
$PAGE->set_url('/admin/tool/classlist/index.php');
$PAGE->requires->jquery();
$PAGE->requires->js(new moodle_url('js/angular.js'));
$PAGE->requires->js(new moodle_url('js/table.js'));

$output = $PAGE->get_renderer('tool_classlist');

echo $output->header();
echo $output->render_tool_classlist();
echo $output->footer();

