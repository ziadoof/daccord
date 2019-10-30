<?php


namespace App\Entity\Notification;


use App\Entity\User;
use Mgilet\NotificationBundle\Entity\NotifiableEntity;
use Mgilet\NotificationBundle\Entity\Notification;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Notification\NotifiedByRepository")
 */
class NotifiedBy
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var $type
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @var Notification
     * @ORM\ManyToOne(targetEntity="Mgilet\NotificationBundle\Entity\Notification", inversedBy="notifiableNotifications", cascade={"persist"})
     */
    private $notification;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $sender;

    /**
     * @var $receiver
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     *
     */
    private $receiver;



    /**
     * @var $category
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * NotifiedBy constructor.
     * @param Notification $notification
     * @param User $sender
     * @param User $receiver
     * @throws \Exception
     */
    public function __construct(Notification $notification,User $sender, User $receiver, string $type, string $category)
    {
        $this->notification = $notification;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->type = $type;
        $this->date = new \DateTime('now');
        $this->category=$category;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $date;

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
     * @return Notification
     */
    public function getNotification(): Notification
    {
        return $this->notification;
    }

    /**
     * @param Notification $notification
     */
    public function setNotification(Notification $notification): void
    {
        $this->notification = $notification;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed  $sender
     */
    public function setSender($sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param mixed $receiver
     */
    public function setReceiver($receiver): void
    {
        $this->receiver = $receiver;
    }

    public function date_format(\DateTime $date): string
    {
        $now  = new \DateTime('now');
        $interval = date_diff($date, $now)->days;
        $dateString = $date->format('d-m-Y');
        switch (true) {
            case $interval === 0:
                return 'Today';
                break;
            case $interval === 1:
                return 'Yesterday';
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