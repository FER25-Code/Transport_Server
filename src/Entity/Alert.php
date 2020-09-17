<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AlertRepository")
 */
class Alert
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
    private $comment;


    /**
     * @ManyToOne(targetEntity="AlertType")
     * @JoinColumn(name="AlertType_id", referencedColumnName="id")
     */
    private $rAlertType;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="User_id", referencedColumnName="id")
     */
    private $rUser;

    /**
     * @return mixed
     */
    public function getRAlertType()
    {
        return $this->rAlertType;
    }

    /**
     * @param mixed $rAlertType
     */
    public function setRAlertType($rAlertType): void
    {
        $this->rAlertType = $rAlertType;
    }

    /**
     * @return mixed
     */
    public function getRUser()
    {
        return $this->rUser;
    }

    /**
     * @param mixed $rUser
     */
    public function setRUser($rUser): void
    {
        $this->rUser = $rUser;
    }

    /**
     * @return mixed
     */
    public function getRLine()
    {
        return $this->rLine;
    }

    /**
     * @param mixed $rLine
     */
    public function setRLine($rLine): void
    {
        $this->rLine = $rLine;
    }

    /**
     * @ManyToOne(targetEntity="Line")
     * @JoinColumn(name="Line_id", referencedColumnName="id")
     */
      private $rLine ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;

    }
}
