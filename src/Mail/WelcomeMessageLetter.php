<?php

namespace App\Mail;

use App\Entity\User;
use Swift_Message;
use Twig_Environment;

/**
 * Welcome message letter.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class WelcomeMessageLetter
{
    private $twig;
    private $mailFrom;

    public function __construct(Twig_Environment $twig, string $mailFrom)
    {
        $this->twig = $twig;
        $this->mailFrom = $mailFrom;
    }

    /**
     * Create welcome message letter.
     *
     * @param User $user
     *
     * @return Swift_Message
     */
    public function getWelcomeMessage(User $user): Swift_Message
    {
        $body = $this->twig->render('email/registration.html.twig', [
            'user' => $user,
        ]);

        return (new Swift_Message())
            ->setSubject('Welcome to the MigroBlog!')
            ->setFrom($this->mailFrom)
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html');
    }
}
