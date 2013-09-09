<?php
require('../../../config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/admin/tool/classlist/index.php');
$PAGE->requires->jquery();
$PAGE->requires->js(new moodle_url('js/angular.js'));
$PAGE->requires->js(new moodle_url('js/table.js'));
$PAGE->requires->js(new moodle_url('js/ng-table.js'));

require_login();

$parser = new tool_classlist_parser();
$output = $PAGE->get_renderer('tool_classlist');

echo $output->header();
echo $output->render($parser);
echo $output->footer();

