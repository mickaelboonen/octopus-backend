<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
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
     * @ORM\Column(type="string", length=255)
     */
    private $theater_roles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_role;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $pronouns;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Play::class, inversedBy="artist")
     */
    private $play;

    // /**
    //  * @ORM\ManyToOne(targetEntity=Collectif::class, inversedBy="artist")
    //  * @ORM\JoinColumn(nullable=false)
    //  */
    // private $collectif;

    /**
     * @ORM\ManyToOne(targetEntity=Collectif::class, inversedBy="artist")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collectif_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_former;

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

    public function getTheaterRoles(): ?string
    {
        return $this->theater_roles;
    }

    public function setTheaterRoles(string $theater_roles): self
    {
        $this->theater_roles = $theater_roles;

        return $this;
    }

    public function getUserRole(): ?string
    {
        return $this->user_role;
    }

    public function setUserRole(string $user_role): self
    {
        $this->user_role = $user_role;

        return $this;
    }

    public function getPronouns(): ?string
    {
        return $this->pronouns;
    }

    public function setPronouns(string $pronouns): self
    {
        $this->pronouns = $pronouns;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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
        }

        return $this;
    }

    public function removePlay(Play $play): self
    {
        $this->play->removeElement($play);

        return $this;
    }

    // public function getCollectif(): ?Collectif
    // {
    //     return $this->collectif;
    // }

    // public function setCollectifId(?Collectif $collectif): self
    // {
    //     $this->collectif = $collectif;

    //     return $this;
    // }

    public function isIsFormer(): ?bool
    {
        return $this->is_former;
    }

    public function setIsFormer(bool $is_former): self
    {
        $this->is_former = $is_former;

        return $this;
    }
}
