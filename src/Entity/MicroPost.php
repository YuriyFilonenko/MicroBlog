<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MicroPostRepository")
 */
class MicroPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $microPostText;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdTime;

    public function getId(): int
    {
        return $this->id;
    }

    public function getMicroPostText(): string
    {
        return $this->microPostText;
    }

    public function setMicroPostText(string $microPostText): self
    {
        $this->microPostText = $microPostText;

        return $this;
    }

    public function getCreatedTime(): \DateTimeInterface
    {
        return $this->createdTime;
    }

    public function setCreatedTime(\DateTimeInterface $createdTime): self
    {
        $this->createdTime = $createdTime;

        return $this;
    }
}
