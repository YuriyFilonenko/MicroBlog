<?php

namespace App\Mail;

use App\Entity\User;
use App\Service\Mailer\MailerServiceInterface;
use Twig_Environment;

/**
 * Welcome message letter.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class WelcomeMessageLetter
{
    private $mailerService;
    private $twig;
    private $mailFrom;

    public function __construct(MailerServiceInterface $mailerService, Twig_Environment $twig, string $mailFrom)
    {
        $this->mailerService = $mailerService;
        $this->twig = $twig;
        $this->mailFrom = $mailFrom;
    }

    /**
     * Send welcome message letter.
     *
     * @param User $user
     */
    public function send(User $user): void
    {
        $body = $this->twig->render('email/registration.html.twig', [
            'user' => $user,
        ]);

        $message = $this->mailerService->createMessage()
            ->setSubject('Welcome to the MigroBlog!')
            ->setFrom($this->mailFrom)
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html');

        $this->mailerService->sendMessage($message);
    }
}
