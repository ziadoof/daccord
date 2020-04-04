<?php


namespace App\Entity\Message;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Message as BaseMessage;
use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\MessageBundle\Model\ThreadInterface;

/**
 * @ORM\Entity
 */
class Message extends BaseMessage
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="App\Entity\Message\Thread",
     *   inversedBy="messages"
     * )
     * @var ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @var ParticipantInterface
     */
    protected $sender;

    /**
     * @ORM\OneToMany(
     *   targetEntity="App\Entity\Message\MessageMetadata",
     *   mappedBy="message",
     *   cascade={"all"}
     * )
     * @var MessageMetadata[]|Collection
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
     * @return ThreadInterface
     */
    public function getThread(): ThreadInterface
    {
        return $this->thread;
    }

    /**
     * @param ThreadInterface $thread
     */
    public function setThread(ThreadInterface $thread): void
    {
        $this->thread = $thread;
    }

    /**
     * @return ParticipantInterface
     */
    public function getSender(): ParticipantInterface
    {
        return $this->sender;
    }

    /**
     * @param ParticipantInterface $sender
     */
    public function setSender(ParticipantInterface $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return MessageMetadata[]|Collection
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param MessageMetadata[]|Collection $metadata
     */
    public function setMetadata($metadata): void
    {
        $this->metadata = $metadata;
    }

    public function dateFormat(\DateTime $date){
        $now  = new \DateTime('now');
        $interval = date_diff($date, $now)->days;
        $dateString = $date->format('d M y').(' at ').$date->format('H:i');
        $houreString = $date->format('H:i');
        switch (true) {
            case $interval === 0:
                return $houreString;
                break;
            case $interval === 1:
                return 'Yesterday '.$houreString;
                break;
            case $interval >1:
                return $dateString;
                break;
        }
    }
}