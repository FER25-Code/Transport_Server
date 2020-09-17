<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Table(name="ride")
 * @ORM\Entity(repositoryClass="App\Repository\RideRepository")
 */
class Ride
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
    private $direction;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departureDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $finishDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


    /**
     * @ManyToOne(targetEntity="Line")
     * @JoinColumn(name="line_id", referencedColumnName="id")
     */
    private $rLine;

    /**
     * @ManyToOne(targetEntity="Driver")
     * @JoinColumn(name="Driver_id", referencedColumnName="id")
     */
    private $rDriver;

    /**
     * @ManyToOne(targetEntity="Vehicle")
     * @JoinColumn(name="Vehicle_id", referencedColumnName="id")
     */
    private $rVehicle;


    /**
     * Many Ride have Many Customer.
     * @ManyToMany(targetEntity="Customer", mappedBy="ride")
     */
    private $customer;

    public function __construct() {
        $this->customer = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * One Ride has many Evaluation. This is the inverse side.
     * @OneToMany(targetEntity="Evaluation", mappedBy="Ride")
     */
    private $evaluation;

    public function __construct1() {
        $this->evaluation= new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDirection(): ?int
    {
        return $this->direction;
    }

    public function setDirection(int $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getFinishDate(): ?\DateTimeInterface
    {
        return $this->finishDate;
    }

    public function setFinishDate(\DateTimeInterface $finishDate): self
    {
        $this->finishDate = $finishDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
