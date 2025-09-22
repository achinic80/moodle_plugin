<?php
require_once(__DIR__ . '/../../config.php');

$context = context_system::instance();
$PAGE->set_context($context);
require_sesskey(); // important if using POST

// get POSTed data
$email = required_param('email', PARAM_EMAIL);
$firstname = required_param('firstname', PARAM_TEXT);
$lastname = required_param('lastname', PARAM_TEXT);
$country = optional_param('country', '', PARAM_ALPHANUM);
$mobile = optional_param('mobile', '', PARAM_TEXT);

// basic validation
if (email_exists_in_db($email)) {
    // show error
    print_error('emailexists', 'local_registrationplugin');
}

$token = bin2hex(random_bytes(32));
$now = time();
$expires = $now + (60*60*24); // 24 hours

$record = new stdClass();
$record->email = $email;
$record->firstname = $firstname;
$record->lastname = $lastname;
$record->country = $country;
$record->mobile = $mobile;
$record->token = $token;
$record->created = $now;
$record->expires = $expires;

// insert into plugin table
$DB->insert_record('local_registrationtoken', $record);

// build verify URL
$verifyurl = new moodle_url('/local/registrationplugin/verify.php', ['token' => $token]);

// prepare email (from admin)
$site = get_site();
$admin = get_admin();

$subject = get_string('email_subject', 'local_registrationplugin');
$body = "Hello {$firstname},\n\n";
$body .= "Please verify your registration by clicking the link below:\n";
$body .= $verifyurl->out(true) . "\n\n";
$body .= "This link expires in 24 hours.\n";

// send email
$emailuser = (object)[
    'id' => 0,
    'email' => $email,
    'firstname' => $firstname,
    'lastname' => $lastname
];

email_to_user($emailuser, $admin, $subject, $body);

// redirect to a "check your mail" page
redirect(new moodle_url('/local/registrationplugin/confirm_sent.php'));
