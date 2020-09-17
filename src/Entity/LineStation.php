<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LineStationRepository")
 */
class LineStation
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
    private $rank;

    /**
     * @ORM\Column(type="integer")
     */
    private $stopduration;


    /**
     * Many LineStation have one Station. This is the owning side.
     * @ManyToOne(targetEntity="Station", inversedBy="LineStation")
     * @JoinColumn(name="station_id", referencedColumnName="id")


     */
    private $sattion;


    /**
     * @ManyToOne(targetEntity="Line")
     * @JoinColumn(name="line_id", referencedColumnName="id")

     */
    private $line;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getStopduration(): ?int
    {
        return $this->stopduration;
    }

    public function setStopduration(int $stopduration): self
    {
        $this->stopduration = $stopduration;

        return $this;
    }
}
