<?php

//namespace tool_classlist;

/**
 * Parser to parse all classes in core.
 *
 * Class parser
 * @package tool_classlist
 */
class tool_classlist_parser implements \renderable{

    /**
     * @var array List of event classes found.
     */
    protected $events = array();

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
        $this->classmap = \tool_classlist\component::get_classmap();
        $this->generate_class_details();
    }

    /**
     * Returns list of events classes found.
     *
     * @return array list of event classes.
     */
    public function get_events() {
        return $this->events;
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
            if ($i == 20)
                return;
            if (is_readable($file)) {
                include_once($file);
                $details = array();
                $details['file'] = $file;
                $details['class'] = $class;

                $parts = explode('\\', get_called_class());
                $details['component'] = $parts[0];
                $details['classname'] = array_pop($parts);
                unset($parts[0]);
                $details['path'] = implode('\\', $parts);
                $this->classes[] = $details;
            }
        }
    }
}
