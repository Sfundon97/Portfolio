
<?php
// Include the PHP Email Form class
require 'assets/vendor/php-email-form/php-email-form.php';

$receiving_email_address = 'sfundon97@gmail.com';

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->setTo($receiving_email_address);
$contact->setFromName($_POST['name']);
$contact->setFromEmail($_POST['email']);
$contact->setSubject($_POST['subject']);

// Uncomment below code if you want to use SMTP to send emails. Enter your correct SMTP credentials.
/*
$contact->setSMTP(array(
    'host' => 'your-smtp-server.com',
    'username' => 'your-email@example.com',
    'password' => 'your-email-password',
    'port' => 587
));
*/

$contact->addMessage($_POST['name'], 'From');
$contact->addMessage($_POST['email'], 'Email');
$contact->addMessage($_POST['message'], 'Message', 10);

echo $contact->send() ? 'OK' : 'Something went wrong. Please try again later.';
?>
