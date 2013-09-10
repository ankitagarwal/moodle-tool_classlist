<?php

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
                    $details['file'] = $file;
                    $details['class'] = $class;

                    $parts = explode('\\', $class);
                    if (count($parts) > 1) {
                        // Name space is used.
                        $details['component'] = $parts[0];
                        $details['classname'] = array_pop($parts);
                    } else {
                        // Legacy style.
                        $parts = explode('/', $file);
                        $filename = str_replace('.php', '', array_pop($parts));
                        $details['component'] = str_replace($filename, '', $class);
                        $details['classname'] = $class;
                        $details['component'] = trim($details['component'], '_'); // Remove any trailing _ .
                    }

                    $this->classes[] = $details;
                }
            }
        }
    }
}

