<?php


namespace App\Entity\Message;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\ThreadMetadata as BaseThreadMetadata;
use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\MessageBundle\Model\ThreadInterface;

/**
 * @ORM\Entity
 */
class ThreadMetadata extends BaseThreadMetadata
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
     *   inversedBy="metadata"
     * )
     * @var ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @var ParticipantInterface
     */
    protected $participant;

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
    public function getParticipant(): ParticipantInterface
    {
        return $this->participant;
    }

    /**
     * @param ParticipantInterface $participant
     */
    public function setParticipant(ParticipantInterface $participant): void
    {
        $this->participant = $participant;
    }


}