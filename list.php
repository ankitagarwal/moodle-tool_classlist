<?php

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

