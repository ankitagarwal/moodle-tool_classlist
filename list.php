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
 * Ajax responder script.
 *
 * @package    tool_classlist
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);
require('../../../config.php');

if (!is_siteadmin()) {
    echo "We give cookies only to site admins";
    die();
}

$key = required_param('key', PARAM_ALPHANUM);
confirm_sesskey($key);
$parser = new \tool_classlist\parser();
$classes = $parser->get_classes();

echo json_encode(array('cols' => array_keys($classes[0]), 'data' => $classes));

