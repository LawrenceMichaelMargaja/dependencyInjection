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

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function register($email, $password)
    {
        // The user just registered, we create his account
        // ...

        // We send him an email to say hello!
        $this->mailer->mail($email, 'Hello and welcome!');
    }
}

//$result = UserManager::register('Hello@test.com', 123);

$result = new UserManager();
$final = $result->register('test@test.com', 123);