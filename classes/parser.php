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

namespace tool_classlist;

/**
 * Parser to parse all classes in core.
 *
 * Class parser
 * @package tool_classlist
 */
class parser {

    /**
     * @var array List of all classes found.
     */
    protected $classmap = array();

    /**
     * @var array List of all classes found.
     */
    protected $classes = array();

    /**
     * constructor.
     */
    public function __construct() {
        $this->classmap = component::get_classmap();
        $this->generate_class_details();
    }

    /**
     * Returns list of all classes found.
     *
     * @return array list of all classes found
     */
    public function get_classes() {
        return $this->classes;
    }

    /**
     * Generate class details array from passed on class map.
     *
     * @param array $classmap classmap
     */
    public function generate_class_details($classmap = array()) {
        global $CFG;

        if (empty($classmap)) {
            $classmap = $this->classmap;
        }
        $this->classes = array();
        $i = 0;

        foreach ($classmap as $class => $file) {
            $i++;
            if (is_readable($file)) {
                if (strpos($class, 'tinymce_spellchecker') !== false) {
                    // Hack to stop loading broken file.
                    continue;
                }
                include_once($file);
                // Ignore synonyms.
                if (class_exists($class, false)) {
                    $details = array();
                    $details['class'] = $class;

                    $parts = explode('\\', $class);
                    if (count($parts) > 1) {
                        // Name space is used.
                        $details['classname'] = array_pop($parts);
                        $details['component'] = $parts[0];
                    } else {
                        // Legacy style.
                        $parts = explode('/', $file);
                        $filename = str_replace('.php', '', array_pop($parts));
                        $details['classname'] = $class;
                        $details['component'] = str_replace($filename, '', $class);
                        $details['component'] = trim($details['component'], '_'); // Remove any trailing _ .
                    }
                    $details['file'] = $file;

                    $this->classes[] = $details;
                }
            }
        }
    }
}

