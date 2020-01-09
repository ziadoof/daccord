<?php

namespace App\Entity\Meetup;

use App\Entity\Location\City;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Meetup\MeetupRepository")
 */
class Meetup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="meetups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\Department")
     */
    private $department;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\Region")
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City", inversedBy="meetups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxParticipants;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Meetup\JoinRequest", mappedBy="meetup")
     */
    private $joinRequests;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Meetup\Comment", mappedBy="meetup", orphanRemoval=true)
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $comments;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     * @ORM\JoinTable(name="participants_user")
     */
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     * @ORM\JoinTable(name="waitlists_user")
     */
    private $waitlists;

    public function __construct()
    {
        $this->joinRequests = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->participants = new ArrayCollection();
        $this->waitlists = new ArrayCollection();
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     */
    public function setDepartment($department): void
    {
        $this->department = $department;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getMaxParticipants(): ?int
    {
        return $this->maxParticipants;
    }

    public function setMaxParticipants(int $maxParticipants): self
    {
        $this->maxParticipants = $maxParticipants;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

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

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }


    /**
     * @return Collection|JoinRequest[]
     */
    public function getJoinRequests(): Collection
    {
        return $this->joinRequests;
    }

    public function addJoinRequest(JoinRequest $joinRequest): self
    {
        if (!$this->joinRequests->contains($joinRequest)) {
            $this->joinRequests[] = $joinRequest;
            $joinRequest->setMeetup($this);
        }

        return $this;
    }

    public function removeJoinRequest(JoinRequest $joinRequest): self
    {
        if ($this->joinRequests->contains($joinRequest)) {
            $this->joinRequests->removeElement($joinRequest);
            // set the owning side to null (unless already changed)
            if ($joinRequest->getMeetup() === $this) {
                $joinRequest->setMeetup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setMeetup($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getMeetup() === $this) {
                $comment->setMeetup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(User $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getWaitlists(): Collection
    {
        return $this->waitlists;
    }

    public function addWaitlist(User $waitlist): self
    {
        if (!$this->waitlists->contains($waitlist)) {
            $this->waitlists[] = $waitlist;
        }

        return $this;
    }

    public function removeWaitlist(User $waitlist): self
    {
        if ($this->waitlists->contains($waitlist)) {
            $this->waitlists->removeElement($waitlist);
        }

        return $this;
    }

    public function meetupImage(){
        $url = '/assets/images/meetup/';
        if($this->image ===null){
            return $url.'meetup.png';
        }
        return $url.$this->image;
    }

    public function isFinish(): bool
    {
        $now = new \DateTime('now');
        return $this->getEndAt()<$now;
    }

    public function isParticipant(User $user): bool
    {
        return in_array($user, $this->getParticipants()->toArray(), true);
    }

    public function isWaitlists(User $user): bool
    {
        return in_array($user, $this->getWaitlists()->toArray(), true);
    }

    public function haveJoinRequest(User $user): bool
    {
        $listUser=[];
        foreach ($this->getJoinRequests()->toArray() as $joinRequest){
            $listUser[]= $joinRequest->getUser();
        }
        return in_array($user, $listUser, true);
    }

    public function getJoinRequestStatus(User $user): string
    {
        $status =null;
        foreach ($this->getJoinRequests()->toArray() as $joinRequest){
            if($joinRequest->getUser()=== $user){
                $status = $joinRequest->getTreatment();
            }
        }
        return $status;
    }

    public function isFull(){
        $nP = count($this->getParticipants());
        $nL = count($this->getWaitlists());
        return $nP === $this->getMaxParticipants() && $nL === 4;
    }
    public function participantFull(): bool
    {
        $nP = count($this->getParticipants());
        return $nP === $this->getMaxParticipants();
    }

}
