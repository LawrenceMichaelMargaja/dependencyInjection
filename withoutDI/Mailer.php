<?php

class Mailer
{
    public function mail($recipient, $content)
    {
        // Here you would implement the actual email sending logic
        echo "Sending email to " . $recipient . ": " . $content . "\n";
    }
}