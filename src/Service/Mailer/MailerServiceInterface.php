<?php

namespace App\Service\Mailer;

use App\Entity\User;

/**
 * Contract for Mailer service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
interface MailerServiceInterface
{
    /**
     * Sending emails.
     *
     * @param User $user
     */
    public function sendEmail(User $user): void;
}
