<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
/**
 * @ORM\Entity(repositoryClass="App\Repository\FavoritesRepository")
 */
class Favorites
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
     * @ManyToOne(targetEntity="Line")
     * @JoinColumn(name="line_id", referencedColumnName="id")
     */
    private $rLine;

    /**
     * @ManyToOne(targetEntity="Station")
     * @JoinColumn(name="Station_id", referencedColumnName="id")
     */
    private $station;

    /**
     * @ManyToOne(targetEntity="Customer")
     * @JoinColumn(name="Customer_id", referencedColumnName="id")
     */
    private $customer;

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
}
