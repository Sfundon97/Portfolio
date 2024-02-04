<?php

class PHP_Email_Form
{
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $smtp;
    public $message;

    public function __construct()
    {
        $this->to = '';
        $this->from_name = '';
        $this->from_email = '';
        $this->subject = '';
        $this->smtp = array();
        $this->message = '';
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function setFromName($from_name)
    {
        $this->from_name = $from_name;
    }

    public function setFromEmail($from_email)
    {
        $this->from_email = $from_email;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setSMTP($smtp)
    {
        $this->smtp = $smtp;
    }

    public function addMessage($message, $label, $maxlength = 70)
    {
        $this->message .= wordwrap($label . ": " . $message, $maxlength, "\r\n");
    }

    public function send()
    {
        $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
        $headers .= "Reply-To: {$this->from_email}\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (!empty($this->smtp)) {
            $host = $this->smtp['host'];
            $username = $this->smtp['username'];
            $password = $this->smtp['password'];
            $port = $this->smtp['port'];

            ini_set('SMTP', $host);
            ini_set('smtp_port', $port);
            ini_set('sendmail_from', $this->from_email);

            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

            $additional_parameters = "-f{$this->from_email}";
            return mail($this->to, $this->subject, $this->message, $headers, $additional_parameters);
        } else {
            return mail($this->to, $this->subject, $this->message, $headers);
        }
    }
}

?>
