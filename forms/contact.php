<?php
// Requires the "PHP Email Form" library
// Make sure the library is in the correct location
require '../assets/vendor/php-email-form/php-email-form.php';

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'sfundon97@gmail.com';

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// Uncomment below code if you want to use SMTP to send emails. Enter your correct SMTP credentials.
/*
$contact->smtp = array(
    'host' => 'your-smtp-server.com',
    'username' => 'your-email@example.com',
    'password' => 'your-email-password',
    'port' => 587
);
*/

$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

echo $contact->send();
?>
