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

// Assume there is a DI (Dependency Injection) Container set up in the application.
// This DI Container is like a central storage where all recipe books (services and configurations) are kept.

// The DI Container is created and configured somewhere in the application's bootstrap process.
// For simplicity, let's assume it's created like this (in reality, it's usually more complex):
$container = new DIContainer();
$container->register('Logger', function() { return new Logger(); });
$container->register('Database', function() { return new Database(); });

// ...

// ArticleController is like the head chef in a kitchen.

// ...

// When creating an instance of ArticleController, the DI Container is passed to it.
// This is like assigning the chef their recipe book when they start working.
$articleController = new ArticleController($container);


