<?php

class Mailer
{
    public function mail($recipient, $content)
    {
        // Here you would implement the actual email sending logic
        echo "Sending email to " . $recipient . ": " . $content . "\n";
    }
}

class UserManager
{
    private $mailer;

    // This function creates a new instance of mailer every time a new instance of UserManager is made.
    public function __construct()
    {
        $this->mailer = new Mailer();
        $this->student = new Student();
        $this->police = new Police();
        $this->army = new Army();
        $this->doctors = new Doctors();
    }

    public function register($email, $password)
    {
        // The user just registered, we create his account
        // ...

        // We send him an email to say hello!
        $this->mailer->mail($email, $password);
    }
}

$userManager = new UserManager();
$userManager->register('lawrence@example.com', 123123);
