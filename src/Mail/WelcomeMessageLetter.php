<?php

namespace App\Mail;

use App\Entity\User;

/**
 * Create welcome message letter.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
final class WelcomeMessageLetter
{
    private $twig;
    private $mailFrom;

    public function __construct(\Twig_Environment $twig, string $mailFrom)
    {
        $this->twig = $twig;
        $this->mailFrom = $mailFrom;
    }

    public function getWelcomeMessage(User $user)
    {
        $body = $this->twig->render('email/registration.html.twig', [
            'user' => $user,
        ]);

        return (new \Swift_Message())
            ->setSubject('Welcome to the MigroBlog!')
            ->setFrom($this->mailFrom)
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html');
    }
}
