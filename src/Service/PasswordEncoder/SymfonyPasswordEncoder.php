<?php

namespace App\Service\PasswordEncoder;

use App\Dto\UserDto;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Symfony password encoder service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class SymfonyPasswordEncoder implements PasswordEncoderInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(UserDto $userDto): string
    {
        return $this->passwordEncoder->encodePassword(
            $userDto,
            $userDto->getPlainPassword()
        );
    }
}
