<?php

namespace App\Entity\Meetup;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Meetup\JoinRequestRepository")
 */
class JoinRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Meetup\Meetup", inversedBy="joinRequests")
     */
    private $meetup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="joinRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $treatment;

    /**
     * JoinRequest constructor.
     * @param $treatment
     */
    public function __construct()
    {
        $this->treatment = 'Pending';
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTreatment(): ?string
    {
        return $this->treatment;
    }

    public function setTreatment(string $treatment): self
    {
        $this->treatment = $treatment;

        return $this;
    }
}
