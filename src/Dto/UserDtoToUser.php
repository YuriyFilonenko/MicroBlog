<?php

namespace App\Dto;

use App\Entity\User;

/**
 * Creates new User from UserDto.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class UserDtoToUser
{
    /**
     * Creates new User from UserDto.
     *
     * @return User
     */
    public function createUser(UserDto $userDto): User
    {
        $user = new User();
        $user->setUsername($userDto->getUsername())
                ->setPassword($userDto->getPassword())
                ->setEmail($userDto->getEmail())
                ->setFullName($userDto->getFullName());

        return $user;
    }
}
