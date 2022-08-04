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
     * @ORM\OneToMany(targetEntity=Date::class, mappedBy="play_id")
     */
    private $play_date;

    // /**
    //  * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="play")
    //  */
    // private $pictures;

    public function __construct()
    {
        $this->artist = new ArrayCollection();
        $this->play_date = new ArrayCollection();
        $this->pictures = new ArrayCollection();
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

    // /**
    //  * @return Collection<int, Picture>
    //  */
    // public function getPictures(): Collection
    // {
    //     return $this->pictures;
    // }

    // public function addPicture(Picture $picture): self
    // {
    //     if (!$this->pictures->contains($picture)) {
    //         $this->pictures[] = $picture;
    //         $picture->setPlay($this);
    //     }

    //     return $this;
    // }

    // public function removePicture(Picture $picture): self
    // {
    //     if ($this->pictures->removeElement($picture)) {
    //         // set the owning side to null (unless already changed)
    //         if ($picture->getPlay() === $this) {
    //             $picture->setPlay(null);
    //         }
    //     }

    //     return $this;
    // }
}
