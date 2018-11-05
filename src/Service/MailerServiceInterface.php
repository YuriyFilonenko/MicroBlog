<?php

namespace App\Service;

use App\Entity\User;

/**
 * Contract Mailer service.
 * 
 * @author Yuriy Filonenko <mail@gmail.com>
 */
interface MailerServiceInterface
{
    /**
     * Send email after user registration.
     * 
     * @param User $user
     * 
     * @return void
     */
    public function sendRegistrationEmail(User $user): void;
}
