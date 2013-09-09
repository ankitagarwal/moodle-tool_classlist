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

echo json_encode($parser->get_classes());

