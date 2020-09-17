<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;



/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketsRepository")
 */
class Tickets
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $AMOUNT;
    /**
     * @OneToOne(targetEntity="Line")
     * @JoinColumn(name="Line_id", referencedColumnName="id")
     */
     private $line ;

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param mixed $line
     */
    public function setLine($line): void
    {
        $this->line = $line;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAMOUNT(): ?int
    {
        return $this->AMOUNT;
    }

    public function setAMOUNT(?int $AMOUNT): self
    {
        $this->AMOUNT = $AMOUNT;

        return $this;
    }

}
