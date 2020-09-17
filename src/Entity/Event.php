<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $description;

    /**
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;



    /**
     * @ManyToOne(targetEntity="Position")
     * @JoinColumn(name="position_id", referencedColumnName="id")
     */
    private $rPosition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phataudio;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(string $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhataudio(): ?string
    {
        return $this->phataudio;
    }

    public function setPhataudio(?string $phataudio): self
    {
        $this->phataudio = $phataudio;

        return $this;
    }
}
