<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 */
class Driver
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $drivinglicence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDrivinglicence(): ?int
    {
        return $this->drivinglicence;
    }

    public function setDrivinglicence(int $drivinglicence): self
    {
        $this->drivinglicence = $drivinglicence;

        return $this;
    }
}
