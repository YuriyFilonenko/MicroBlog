<?php

namespace App\Dto;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Dto for User entity.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class UserDto implements UserInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=50, minMessage="Minimal username length - 5 characters")
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6, max=255, minMessage="Minimal password length - 6 characters")
     */
    private $plainPassword;

    /**
     * @Assert\NotBlank()
     * @Assert\Email(message="Incorrect email")
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=50, minMessage="Minimal fullname length - 4 characters")
     */
    private $fullName;

    private $password;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * Creates new User from UserDto.
     *
     * @return User
     */
    public function createUser(): User
    {
        $user = new User();
        $user->setUsername($this->username)
                ->setPassword($this->password)
                ->setEmail($this->email)
                ->setFullName($this->fullName);

        return $user;
    }
}
