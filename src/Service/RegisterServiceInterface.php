<?php

namespace App\Service;

use App\Entity\User;

/**
 * Contract for Register service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
interface RegisterServiceInterface
{
    /**
     * Register user.
     *
     * @param User $user
     */
    public function registerUser(User $user): void;
}
