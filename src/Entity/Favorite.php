<?php

namespace App\Entity;

use App\Entity\Ads\Ad;
use App\Entity\Carpool\Voyage;
use App\Entity\Deal\Deal;
use App\Entity\Hosting\Hosting;
use App\Entity\Meetup\Meetup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavoriteRepository")
 */
class Favorite
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
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="favorites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads\Ad", inversedBy="favorites")
     */
    private $ad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Deal\Deal", inversedBy="favorites")
     */
    private $deal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hosting\Hosting", inversedBy="favorites")
     */
    private $hosting;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Meetup\Meetup", inversedBy="favorites")
     */
    private $meetup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Carpool\Voyage", inversedBy="favorites")
     */
    private $voyage;

    /**
     * Favorite constructor.
     *
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAd(): ?Ad
    {
        return $this->ad;
    }

    public function setAd(?Ad $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    public function getDeal(): ?Deal
    {
        return $this->deal;
    }

    public function setDeal(?Deal $deal): self
    {
        $this->deal = $deal;

        return $this;
    }

    public function getHosting(): ?Hosting
    {
        return $this->hosting;
    }

    public function setHosting(?Hosting $hosting): self
    {
        $this->hosting = $hosting;

        return $this;
    }

    public function getMeetup(): ?Meetup
    {
        return $this->meetup;
    }

    public function setMeetup(?Meetup $meetup): self
    {
        $this->meetup = $meetup;

        return $this;
    }

    public function getVoyage(): ?Voyage
    {
        return $this->voyage;
    }

    public function setVoyage(?Voyage $voyage): self
    {
        $this->voyage = $voyage;

        return $this;
    }
}
