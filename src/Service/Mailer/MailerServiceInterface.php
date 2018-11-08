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
     * Send email after user registration.
     *
     * @param User $user
     */
    public function sendRegistrationEmail(User $user): void;
}
