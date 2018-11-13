<?php

namespace App\Service\Event;

use App\Entity\User;

/**
 * Contract for event dispatcher service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
interface DispatcherInterface
{
    /**
     * Create registration event dispatcher.
     *
     * @param User $user
     */
    public function registerEvent(User $user): void;
}
