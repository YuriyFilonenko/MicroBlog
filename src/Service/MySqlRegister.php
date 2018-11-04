<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepositoryInterface;

/**
 * Register service that fetch data from database.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class MySqlRegister implements RegisterServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function registerUser(User $user): void
    {
        $this->userRepository->addUser($user);
    }
}
