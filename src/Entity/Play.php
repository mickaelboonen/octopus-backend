<?php

namespace App\Entity;

use App\Repository\PlayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayRepository::class)
 */
class Play
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $synopsis;

    /**
     * @ORM\Column(type="text")
     */
    private $history;

    /**
     * @ORM\ManyToMany(targetEntity=Artist::class, mappedBy="play")
     */
    private $artist;

    /**
     * @ORM\ManyToOne(targetEntity=Collectif::class, inversedBy="play")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collectif_id;

    /**
     * @ORM\OneToMany(targetEntity=Date::class, mappedBy="play_id")
     */
    private $play_date;

    /**
     * @ORM\ManyToOne(targetEntity=Picture::class)
     */
    private $image;

    public function __construct()
    {
        $this->artist = new ArrayCollection();
        $this->play_date = new ArrayCollection();
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

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(string $history): self
    {
        $this->history = $history;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtist(): Collection
    {
        return $this->artist;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artist->contains($artist)) {
            $this->artist[] = $artist;
            $artist->addPlay($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artist->removeElement($artist)) {
            $artist->removePlay($this);
        }

        return $this;
    }

    public function getCollectifId(): ?Collectif
    {
        return $this->collectif_id;
    }

    public function setCollectifId(?Collectif $collectif_id): self
    {
        $this->collectif_id = $collectif_id;

        return $this;
    }

    /**
     * @return Collection<int, Date>
     */
    public function getPlayDate(): Collection
    {
        return $this->play_date;
    }

    public function addPlayDate(Date $playDate): self
    {
        if (!$this->play_date->contains($playDate)) {
            $this->play_date[] = $playDate;
            $playDate->setPlayId($this);
        }

        return $this;
    }

    public function removePlayDate(Date $playDate): self
    {
        if ($this->play_date->removeElement($playDate)) {
            // set the owning side to null (unless already changed)
            if ($playDate->getPlayId() === $this) {
                $playDate->setPlayId(null);
            }
        }

        return $this;
    }

    public function getImage(): ?Picture
    {
        return $this->image;
    }

    public function setImage(?Picture $image): self
    {
        $this->image = $image;

        return $this;
    }
}
