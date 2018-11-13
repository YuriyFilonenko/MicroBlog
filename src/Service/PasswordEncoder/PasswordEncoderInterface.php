<?php

namespace App\Service\PasswordEncoder;

use App\Dto\UserDto;

/**
 * Contract for password encoder service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
interface PasswordEncoderInterface
{
    /**
     * Encode password.
     *
     * @param UserDto $userDto
     *
     * @return string
     */
    public function encode(UserDto $userDto): string;
}
