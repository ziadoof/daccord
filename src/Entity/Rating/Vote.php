<?php


namespace App\Entity\Rating;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 */
class Vote
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rating\Rating", inversedBy="votes",cascade={"persist"})
     *
     */
    private $rating;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $voter;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $candidate;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     * this variable change when create sortir
     */
    private $event;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     *
     */
    private $comment;

     /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $value;



    /**
     * Vote constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getVoter()
    {
        return $this->voter;
    }

    /**
     * @param mixed $voter
     */
    public function setVoter($voter): void
    {
        $this->voter = $voter;
    }

    /**
     * @return mixed
     */
    public function getCandidate()
    {
        return $this->candidate;
    }

    /**
     * @param mixed $candidate
     */
    public function setCandidate($candidate): void
    {
        $this->candidate = $candidate;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event): void
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

}