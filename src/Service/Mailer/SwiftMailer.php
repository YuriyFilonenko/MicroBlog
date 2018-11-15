<?php

namespace App\Service\Mailer;

/**
 * SwiftMailer service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class SwiftMailer implements MailerServiceInterface
{
    private $swiftMailer;

    public function __construct(\Swift_Mailer $swiftMailer)
    {
        $this->swiftMailer = $swiftMailer;
    }

    /**
     * {@inheritdoc}
     */
    public function createMessage()
    {
        return new \Swift_Message();
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessage($message)
    {
        $this->swiftMailer->send($message);
    }
}
