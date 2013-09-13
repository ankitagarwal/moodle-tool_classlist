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

define('TOOL_CLASSLIST_CONTENT_LIST', 'list');
define('TOOL_CLASSLIST_CONTENT_FILE', 'file');

if (!is_siteadmin()) {
    echo "We give cookies only to site admins";
    die();
}

$key = required_param('key', PARAM_ALPHANUM);
$content = required_param('content', PARAM_ALPHA);
$class = optional_param('class', 0, PARAM_RAW);
confirm_sesskey($key);
$parser = new \tool_classlist\parser();

switch ($content) {

    case TOOL_CLASSLIST_CONTENT_LIST : $classes = $parser->get_classes();
                                        echo json_encode(array('cols' => array_keys(reset($classes)), 'data' => $classes));
                                        break;
    case TOOL_CLASSLIST_CONTENT_FILE : $classmap = $parser->get_classmap();
                                        $cont = (isset($classmap[$class])) ? file_get_contents($classmap[$class]) : false;
                                        echo json_encode($cont);
                                        break;
    default: echo json_encode(get_string('error'));
            break;
}
