<?php

namespace App\Service\Register;

use App\Dto\UserDto;

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
     * @param UserDto $userDto
     */
    public function registerUser(UserDto $userDto): void;
}
