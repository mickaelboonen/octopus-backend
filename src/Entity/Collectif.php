<?php

namespace App\Entity;

use App\Repository\CollectifRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollectifRepository::class)
 */
class Collectif
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
    private $history;

    /**
     * @ORM\OneToMany(targetEntity=Play::class, mappedBy="collectif_id")
     */
    private $play;

    public function __construct()
    {
        $this->play = new ArrayCollection();
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
     * @return Collection<int, Play>
     */
    public function getPlay(): Collection
    {
        return $this->play;
    }

    public function addPlay(Play $play): self
    {
        if (!$this->play->contains($play)) {
            $this->play[] = $play;
            $play->setCollectifId($this);
        }

        return $this;
    }

    public function removePlay(Play $play): self
    {
        if ($this->play->removeElement($play)) {
            // set the owning side to null (unless already changed)
            if ($play->getCollectifId() === $this) {
                $play->setCollectifId(null);
            }
        }

        return $this;
    }

}
