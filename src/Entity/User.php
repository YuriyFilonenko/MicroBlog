<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="This email is already used")
 * @UniqueEntity(fields="username", message="This username is already used")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=50, minMessage="Minimal username length - 5 characters")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6, max=255, minMessage="Minimal password length - 6 characters")
     */
    private $rowPassword;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(message="Incorrect email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=50, minMessage="Minimal fullname length - 4 characters")
     */
    private $fullName;

    public function getId(): ?int
    {
        return $this->id;
    }

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
    
    public function getRowPassword(): ?string
    {
        return $this->rowPassword;
    }

    public function setRowPassword(string $rowPassword): self
    {
        $this->rowPassword = $rowPassword;

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
        return [
            'ROLE_USER'
        ];
    }

    public function getSalt() 
    {
        return null;
    }

    public function serialize(): ?string 
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    public function unserialize($serialized): void 
    {
        list($this->id,
            $this->username,
            $this->password) = unserialize($serialized);
    }
}
