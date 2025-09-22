<?php
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/classes/form/register_form.php');

$context = context_system::instance();
require_login(); // if only logged users can register; otherwise remove

$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/registrationplugin/index.php'));
$PAGE->set_title(get_string('pluginname','local_registrationplugin'));
$PAGE->set_heading(get_string('pluginname','local_registrationplugin'));

$mform = new \local_registrationplugin\form\register_form();

if ($mform->is_cancelled()) {
    redirect(new moodle_url('/')); // or other page
} else if ($fromform = $mform->get_data()) {
    // forward to process.php via POST or call processing function
    // Here we forward to process.php (see next)
    $sesskey = sesskey();
    $params = (array)$fromform;
    redirect(new moodle_url('/local/registrationplugin/process.php', $params));
} else {
    echo $OUTPUT->header();
    $mform->display();
    echo $OUTPUT->footer();
}
