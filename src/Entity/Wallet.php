<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
/**
 * @ORM\Entity(repositoryClass="App\Repository\WalletRepository")
 */
class Wallet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $AMOUNTTOTAL;

    /**
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="User_id", referencedColumnName="id")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAMOUNTTOTAL(): ?int
    {
        return $this->AMOUNTTOTAL;
    }

    public function setAMOUNTTOTAL(int $AMOUNTTOTAL): self
    {
        $this->AMOUNTTOTAL = $AMOUNTTOTAL;

        return $this;
    }
}
