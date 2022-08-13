<?php

namespace App\Entity;

use App\Repository\DateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DateRepository::class)
 */
class Date
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $place_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $place_url;

    // /**
    //  * @ORM\ManyToOne(targetEntity=Play::class, inversedBy="play_date")
    //  * @ORM\JoinColumn(nullable=false)
    //  */
    // private $play_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getPlaceName(): ?string
    {
        return $this->place_name;
    }

    public function setPlaceName(string $place_name): self
    {
        $this->place_name = $place_name;

        return $this;
    }

    public function getPlaceUrl(): ?string
    {
        return $this->place_url;
    }

    public function setPlaceUrl(string $place_url): self
    {
        $this->place_url = $place_url;

        return $this;
    }

    // public function getPlayId(): ?Play
    // {
    //     return $this->play_id;
    // }

    // public function setPlayId(?Play $play_id): self
    // {
    //     $this->play_id = $play_id;

    //     return $this;
    // }
}
