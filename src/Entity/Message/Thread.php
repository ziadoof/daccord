<?php


namespace App\Entity\Message;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Thread as BaseThread;
use FOS\MessageBundle\Model\ParticipantInterface;

/**
 * @ORM\Entity
 */
class Thread extends BaseThread
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     *
     */
    protected $createdBy;

    /**
     * @ORM\OneToMany(
     *   targetEntity="App\Entity\Message\Message",
     *   mappedBy="thread"
     * )
     * @var Message[]|Collection
     */
    protected $messages;

    /**
     * @ORM\OneToMany(
     *   targetEntity="App\Entity\Message\ThreadMetadata",
     *   mappedBy="thread",
     *   cascade={"all"}
     * )
     * @var ThreadMetadata[]|Collection
     */
    protected $metadata;

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
     *
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param ParticipantInterface $createdBy
     */
    public function setCreatedBy(ParticipantInterface $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return Message[]|Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param Message[]|Collection $messages
     */
    public function setMessages($messages): void
    {
        $this->messages = $messages;
    }

    /**
     * @return ThreadMetadata[]|Collection
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param ThreadMetadata[]|Collection $metadata
     */
    public function setMetadata($metadata): void
    {
        $this->metadata = $metadata;
    }

}