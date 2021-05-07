<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    private $confirm_password;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        return (string)$this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return (string)$this->email;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }

    /**
     * @param mixed $confirm_password
     */
    public function setConfirmPassword($confirm_password): void
    {
        $this->confirm_password = $confirm_password;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using "bcript"
    }

    /**
     * @see UserInterface
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }
}
