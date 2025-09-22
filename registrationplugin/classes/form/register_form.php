<?php
require_once("$CFG->libdir/formslib.php");

class register_form extends moodleform {

    // Define the form.
    public function definition() {
        $mform = $this->_form;

        // Email (will act as username).
        $mform->addElement('text', 'email', get_string('email'));
        $mform->setType('email', PARAM_EMAIL);
        $mform->addRule('email', null, 'required', null, 'client');

        // First name.
        $mform->addElement('text', 'firstname', get_string('firstname'));
        $mform->setType('firstname', PARAM_NOTAGS);
        $mform->addRule('firstname', null, 'required', null, 'client');

        // Last name.
        $mform->addElement('text', 'lastname', get_string('lastname'));
        $mform->setType('lastname', PARAM_NOTAGS);
        $mform->addRule('lastname', null, 'required', null, 'client');

        // Country dropdown (correct function).
        $countryoptions = get_list_of_countries();
        $mform->addElement('select', 'country', get_string('country'), $countryoptions);
        $mform->setType('country', PARAM_ALPHA);

        // Mobile.
        $mform->addElement('text', 'mobile', get_string('phone'));
        $mform->setType('mobile', PARAM_NOTAGS);

        // Submit button.
        $this->add_action_buttons(true, get_string('register'));
    }
}
