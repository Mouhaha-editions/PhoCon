<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContestRepository")
 */
class Contest
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $master;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participation", mappedBy="contest")
     */
    private $participations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Loot", mappedBy="contest", orphanRemoval=true)
     */
    private $loots;

    /**
     * @ORM\Column(type="datetime")
     */
    private $debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fin;

    /**
     * @Assert\Image(
     *     minWidth = 900,
     *     maxWidth = 4000,
     *     minHeight = 400,
     *     maxHeight = 3000
     * )
     * @ORM\Column(type="text")
     */
    private $cover;

    public function __construct()
    {
        $this->participations = new ArrayCollection();
        $this->loots = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getMaster(): ?User
    {
        return $this->master;
    }

    public function setMaster(?User $master): self
    {
        $this->master = $master;

        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setContest($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->contains($participation)) {
            $this->participations->removeElement($participation);
            // set the owning side to null (unless already changed)
            if ($participation->getContest() === $this) {
                $participation->setContest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Loot[]
     */
    public function getLoots(): Collection
    {
        return $this->loots;
    }

    public function addLoot(Loot $loot): self
    {
        if (!$this->loots->contains($loot)) {
            $this->loots[] = $loot;
            $loot->setContest($this);
        }

        return $this;
    }

    public function removeLoot(Loot $loot): self
    {
        if ($this->loots->contains($loot)) {
            $this->loots->removeElement($loot);
            // set the owning side to null (unless already changed)
            if ($loot->getContest() === $this) {
                $loot->setContest(null);
            }
        }

        return $this;
    }

    public function serialize()
    {
        return [
            "id" => $this->getId(),
            "title" => $this->getTitle(),
            "description" => $this->getDescription(),
//            "loots"=> $this->getLoots(),
//            "master"=> $this->getMaster(),
//            "participations"=> $this->getParticipations(),
        ];
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(File $cover): self
    {
        $this->cover = $cover;

        return $this;
    }
}
