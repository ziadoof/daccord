<?php

namespace App\Entity\Meetup;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Meetup\CommentRepository")
 */
class Comment
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
    private $sender;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Meetup\Meetup", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $meetup;

    /**
     * Comment constructor.
     * @param $createdAt
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getMeetup(): ?Meetup
    {
        return $this->meetup;
    }

    public function setMeetup(?Meetup $meetup): self
    {
        $this->meetup = $meetup;

        return $this;
    }


    public function date_format(\DateTime $date): string
    {
        $now  = new \DateTime('now');
        $interval = date_diff($date, $now)->days;
        $dateString = $date->format('d-m-Y');
        $time = $date->format('H:i');
        switch (true) {
            case $interval === 0:
                return 'Today '.$time;
                break;
            case $interval === 1:
                return 'Yesterday '.$time;
                break;
            case ($interval >1 && $interval< 7):
                return $interval.'Days ago';
                break;
            case $interval === 7:
                return '1 Week ago';
                break;
            case ($interval >7 && $interval< 15):
                return 'Last week';
                break;
            case ($interval >15 && $interval< 21):
                return 'About َ3 Week ago';
                break;
            case ($interval >21 && $interval< 30):
                return 'About 4 Week ago';
                break;
            case ($interval > 30 && $interval< 60):
                return 'Last month';
                break;
            case ( $interval> 60):
                return $dateString;
                break;
            case 15:
                return '2 Week ago';
                break;
            case 21:
                return '3 Week ago';
                break;
            case 30:
                return '1 Month ago';
                break;
        }
    }

}
