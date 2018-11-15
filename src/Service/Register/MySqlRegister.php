<?php

namespace App\Service\Register;

use App\Repository\UserRepositoryInterface;
use App\Dto\UserDtoToUser;
use App\Service\Event\DispatcherInterface;
use App\Service\PasswordEncoder\PasswordEncoderInterface;

/**
 * User registration service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class MySqlRegister implements RegisterServiceInterface
{
    private $userRepository;
    private $password;
    private $event;
    private $newUser;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordEncoderInterface $password,
        DispatcherInterface $event,
        UserDtoToUser $newUser
    ) {
        $this->userRepository = $userRepository;
        $this->password = $password;
        $this->event = $event;
        $this->newUser = $newUser;
    }

    /**
     * {@inheritdoc}
     */
    public function registerUser($userDto): void
    {
        $userDto->setPassword($this->password->encode($userDto));

        $user = $this->newUser->createUser($userDto);

        $this->userRepository->addUser($user);

        $this->event->registerEvent($user);
    }
}
