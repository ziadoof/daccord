<?php

namespace App\Entity\Hosting;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Hosting\HostingRequestRepository")
 */
class HostingRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="hostingRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="hostingRequestsReceived")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hosting;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastUpdate;

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * @param mixed $lastUpdate
     */
    public function setLastUpdate($lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfPersons;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $treatment;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $senderStatus;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hostingStatus;

    /**
     * HostingRequest constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->date = new \DateTime('now');
        $this->treatment = 'pending';
        $this->senderStatus = false;
        $this->hostingStatus = false;
        $this->lastUpdate = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getHosting(): ?User
    {
        return $this->hosting;
    }

    public function setHosting(?User $hosting): self
    {
        $this->hosting = $hosting;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getNumberOfPersons(): ?int
    {
        return $this->numberOfPersons;
    }

    public function setNumberOfPersons(int $numberOfPersons): self
    {
        $this->numberOfPersons = $numberOfPersons;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTreatment(): ?string
    {
        return $this->treatment;
    }

    public function setTreatment(?string $treatment): self
    {
        $this->treatment = $treatment;

        return $this;
    }

    public function getSenderStatus(): ?bool
    {
        return $this->senderStatus;
    }

    public function setSenderStatus(?bool $senderStatus): self
    {
        $this->senderStatus = $senderStatus;

        return $this;
    }

    public function getHostingStatus(): ?bool
    {
        return $this->hostingStatus;
    }

    public function setHostingStatus(?bool $hostingStatus): self
    {
        $this->hostingStatus = $hostingStatus;

        return $this;
    }
}
