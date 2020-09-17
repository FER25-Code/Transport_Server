<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping\JoinColumn;

use Doctrine\ORM\Mapping\OneToOne;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
 class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;


     /**
      * @ORM\Column(type="string", length=255)
      */
     private $lastname;

     /**
      * @ORM\Column(type="string", length=255)
      */
     private $email;

     /**
      * @OneToOne(targetEntity="Wallet")
      * @joinColumn(name="wallet_id",referencedColumnName="id")
      */
     private $wallet ;

     /**
      * @return mixed
      */
     public function getWallet()
     {
         return $this->wallet;
     }

     /**
      * @param mixed $wallet
      */
     public function setWallet($wallet): void
     {
         $this->wallet = $wallet;
     }

     /**
      * @return mixed
      */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }





    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }



}
