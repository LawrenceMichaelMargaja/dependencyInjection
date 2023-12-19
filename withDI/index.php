<?php

class Mailer
{
    public function mail($recipient, $content)
    {
        // Implement the email sending logic
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
        // User registration logic
        // ...

        // Send an email to say hello
        $this->mailer->mail($email, $password);
    }
}
//
//// Dependency Injection in action
//$mailer = new Mailer();
//$userManager = new UserManager($mailer);
//$userManager->register('tester@example.com', 'thereisnospoon');


$container = new DI\ContainerBuilder();

