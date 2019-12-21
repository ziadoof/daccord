<?php

namespace App\Entity\Cafe;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Cafe\CafeRepository")
 *
 */
class Cafe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expireAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="float")
     */
    private $gpsLat;

    /**
     * @ORM\Column(type="float")
     */
    private $gpsLng;


    /**
     * @ORM\Column(type="string",nullable=false)
     */
    private $uid;

    /**
     * Cafe constructor.
     * @param $createdAt
     * @param $active
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->active = true;
        $this->uid=$this->generateUid();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

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

    /**
     * @return mixed
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

    /**
     * @param mixed $expireAt
     */
    public function setExpireAt($expireAt): void
    {
        $this->expireAt = $expireAt;
    }


    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Cafe
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getGpsLat(): ?float
    {
        return $this->gpsLat;
    }

    public function setGpsLat(float $gpsLat): self
    {
        $this->gpsLat = $gpsLat;

        return $this;
    }

    public function getGpsLng(): ?float
    {
        return $this->gpsLng;
    }

    public function setGpsLng(float $gpsLng): self
    {
        $this->gpsLng = $gpsLng;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }


    function generateUid()
    {
        return Uuid::uuid4();
    }
}
