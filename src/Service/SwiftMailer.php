<?php

namespace App\Service;

use App\Entity\User;

/**
 * SwiftMailer service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class SwiftMailer implements MailerServiceInterface
{
    private $mailer;
    private $twig;
    private $mailFrom;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, string $mailFrom)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->mailFrom = $mailFrom;
    }

    /**
     * {@inheritdoc}
     */
    public function sendRegistrationEmail(User $user): void
    {
        $body = $this->twig->render('email/registration.html.twig', [
            'user' => $user,
        ]);

        $message = (new \Swift_Message())
            ->setSubject('Welcome to the MigroBlog!')
            ->setFrom($this->mailFrom)
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}
