<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LootRepository")
 */
class Loot
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
    private $label;

    /**
     * @ORM\Column(type="integer")
     */
    private $rankStart;

    /**
     * @ORM\Column(type="integer")
     */
    private $rankEnd;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contest", inversedBy="loots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getRankStart(): ?int
    {
        return $this->rankStart;
    }

    public function setRankStart(int $rankStart): self
    {
        $this->rankStart = $rankStart;

        return $this;
    }

    public function getRankEnd(): ?int
    {
        return $this->rankEnd;
    }

    public function setRankEnd(int $rankEnd): self
    {
        $this->rankEnd = $rankEnd;

        return $this;
    }

    public function getContest(): ?Contest
    {
        return $this->contest;
    }

    public function setContest(?Contest $contest): self
    {
        $this->contest = $contest;

        return $this;
    }
}
