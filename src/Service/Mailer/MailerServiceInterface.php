<?php

namespace App\Service\Mailer;

/**
 * Contract for Mailer service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
interface MailerServiceInterface
{
    /**
     * Create message for send.
     */
    public function createMessage();

    /**
     * Send message.
     *
     * @param type $message
     */
    public function sendMessage($message);
}
