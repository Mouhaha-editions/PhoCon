<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipationRepository")
 */
class Participation
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
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="participations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contest", inversedBy="participations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contest;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Picture", mappedBy="participations")
     */
    private $pictures;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|Contest[]
     */
    public function getContest(): Collection
    {
        return $this->contest;
    }

    public function addContest(Contest $contest): self
    {
        if (!$this->contest->contains($contest)) {
            $this->contest[] = $contest;
            $contest->setParticipation($this);
        }

        return $this;
    }

    public function removeContest(Contest $contest): self
    {
        if ($this->contest->contains($contest)) {
            $this->contest->removeElement($contest);
            // set the owning side to null (unless already changed)
            if ($contest->getParticipation() === $this) {
                $contest->setParticipation(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function setContest(?Contest $contest): self
    {
        $this->contest = $contest;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->addParticipation($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            $picture->removeParticipation($this);
        }

        return $this;
    }
}
