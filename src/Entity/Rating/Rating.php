<?php


namespace App\Entity\Rating;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 */
class Rating
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rating\Vote", mappedBy="rating")
     */
    protected $votes;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     * this variable change when create sortir
     */
    private $event;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $total;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $numVotes;

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
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes): void
    {
        $this->votes = $votes;
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
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getNumVotes()
    {
        return $this->numVotes;
    }

    /**
     * @param mixed $numVotes
     */
    public function setNumVotes($numVotes): void
    {
        $this->numVotes = $numVotes;
    }

}