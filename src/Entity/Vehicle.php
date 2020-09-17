<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehicleRepository")
 */
class Vehicle
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
    private $nbr_bus;


    /**
     * @return mixed
     */
    public function getRVehicleOwner()
    {
        return $this->rVehicleOwner;
    }

    /**
     * @param mixed $rVehicleOwner
     */
    public function setRVehicleOwner($rVehicleOwner): void
    {
        $this->rVehicleOwner = $rVehicleOwner;
    }

    /**
     * @return mixed
     */
    public function getRVehicleType()
    {
        return $this->rVehicleType;
    }

    /**
     * @param mixed $rVehicleType
     */
    public function setRVehicleType($rVehicleType): void
    {
        $this->rVehicleType = $rVehicleType;
    }

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $mark;

    /**
     * @return mixed
     */
    public function getOnstation()
    {
        return $this->onstation;
    }

    /**
     * @param mixed $onstation
     */
    public function setOnstation($onstation): void
    {
        $this->onstation = $onstation;
    }

    /**
     * @ORM\Column(type="integer")
     */


    /**
     * @ORM\Column(type="integer")
     */
    private $onStation;

    private $register_nbr;

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @ORM\Column(type="integer")
     */

    /**
     * @ORM\Column(type="float" ,length=255)
     */
    private $latitude;

    /**
     * @ORM\Column(type="float" ,length=255)
     */
    private $longitude;


    private $max_siege;

    /**
     * @ORM\Column(type="string", length=30)
     */

    /**
     * @ManyToOne(targetEntity="VehicleOwner")
     * @JoinColumn(name="VehicleOwner_id", referencedColumnName="id")
     */
    private $rVehicleOwner;

    /**
     * @ManyToOne(targetEntity="VehicleType")
     * @JoinColumn(name="VehicleType_id", referencedColumnName="id")
     */
    private $rVehicleType;

    /**
     * @ORM\Column(type="integer")
     */
    private $registerNbr;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrBus(): ?int
    {
        return $this->nbr_bus;
    }

    public function setNbrBus(int $nbr_bus): self
    {
        $this->nbr_bus = $nbr_bus;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getRegisterNbr(): ?int
    {
        return $this->register_nbr;
    }

    public function setRegisterNbr(int $register_nbr): self
    {
        $this->register_nbr = $register_nbr;

        return $this;
    }

    public function getMaxSiege(): ?int
    {
        return $this->max_siege;
    }

    public function setMaxSiege(int $max_siege): self
    {
        $this->max_siege = $max_siege;

        return $this;
    }


}
