<?php

namespace App\Service\Mailer;

use App\Entity\User;
use App\Mail\WelcomeMessageLetter;

/**
 * SwiftMailer service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class SwiftMailer implements MailerServiceInterface
{
    private $mailer;
    private $welcomeMessagee;

    public function __construct(\Swift_Mailer $mailer, WelcomeMessageLetter $welcomeMessage)
    {
        $this->mailer = $mailer;
        $this->welcomeMessage = $welcomeMessage;
    }

    /**
     * {@inheritdoc}
     */
    public function sendEmail(User $user): void
    {
        $this->mailer->send($this->welcomeMessage->getWelcomeMessage($user));
    }
}
