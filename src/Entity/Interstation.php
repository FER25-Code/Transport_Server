<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToOne;
/**
 * @ORM\Entity(repositoryClass="App\Repository\InterstationRepository")
 */
class Interstation
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
    private $periode;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="float")
     */
    private $distance;



    /**
     * Many Interstation have one Station. This is the owning side.
     * @ManyToOne(targetEntity="Station", inversedBy="Interstation")
     * @JoinColumn(name="one_Station", referencedColumnName="id")


     */
    private $sattion;


    /**
     * @ManyToOne(targetEntity="Station")
     * @JoinColumn(name="other_Station", referencedColumnName="id")

     */
    private $msattion;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }
}
