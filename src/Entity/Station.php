<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StationRepository")
 */
class Station

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
    private $name;


    /**
     * One Station has One Position.
     * @OneToOne(targetEntity="Position")
     * @JoinColumn(name="Position_id", referencedColumnName="id")
     */
    private $rPosition;

//    /**
//     * Many Station have Many Line.
//     * @ManyToMany(targetEntity="Line", mappedBy="station")
//     */
//    private $line;


    public function __construct() {
        $this->line = new \Doctrine\Common\Collections\ArrayCollection();
    }


//    /**
//     * Many Station have Many Road.
//     * @ManyToMany(targetEntity="Road", mappedBy="station")
//     */
//    private $road;

//    public function __construct1() {
//        $this->road = new \Doctrine\Common\Collections\ArrayCollection();
//    }






//    /**
//     * Many Stations have Many Stations.
//     * @ManyToMany(targetEntity="Station", mappedBy="mstations")
//     */
//    private $mystations;
//
//    /**
//     * Many Stations have many Stations.
//     * @ManyToMany(targetEntity="Station", inversedBy="mystations")
//     * @JoinTable(name="Interstations",
//     *      joinColumns={@JoinColumn(name="station_id", referencedColumnName="id")},
//     *      inverseJoinColumns={@JoinColumn(name="next_station_id", referencedColumnName="id")}
//     *      )
//     */
//    private $mstations;
//
//    public function __construct2() {
//        $this->mystations = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->mstations = new \Doctrine\Common\Collections\ArrayCollection();
//    }




    /**
     * One Station has many Interstation. This is the inverse side.
     * @OneToMany(targetEntity="Interstation", mappedBy="Station")
     */
    private $interstation;
    // ...

    public function __construct2() {
        $this->interstation = new ArrayCollection();
    }











    public function getId(): ?int
    {
        return $this->id;
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
}
