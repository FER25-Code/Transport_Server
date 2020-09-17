<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;

/**
 *
 * @ORM\Table(name="line")
 * @ORM\Entity(repositoryClass="LineRepository")
 */
class Line
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $colorType;

    /**
     * @ORM\Column(type="integer")
     */
    private $lineNumber;



    /**
     * @ManyToOne(targetEntity="LineType")
     * @JoinColumn(name="LineType_id", referencedColumnName="id")
     */
    private $rLineType;



    /**
     * One Line has many LineStation. This is the inverse side.
     * @OneToMany(targetEntity="LineStation", mappedBy="Line")
     */
    private $LineStation;
    // ...

    public function __construct2() {
        $this->LineStation = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColorType(): ?string
    {
        return $this->colorType;
    }

    public function setColorType(string $colorType): self
    {
        $this->colorType = $colorType;

        return $this;
    }

    public function getLineNumber(): ?int
    {
        return $this->lineNumber;
    }

    public function setLineNumber(int $lineNumber): self
    {
        $this->lineNumber = $lineNumber;

        return $this;
    }
}