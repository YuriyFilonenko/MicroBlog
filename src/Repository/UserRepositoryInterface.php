<?php

namespace App\Repository;

use App\Entity\User;

/**
 * Contract for UserRepository.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
interface UserRepositoryInterface
{
    /**
     * Gets user by username.
     *
     * @param string $username
     *
     * @return User
     */
    public function findUserByUsername(string $username): User;

    /**
     * Register user.
     *
     * @param User $user
     */
    public function addUser(User $user): void;
}
