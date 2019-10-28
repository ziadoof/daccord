<?php


namespace App\Service;


use App\Entity\Deal\Deal;
use App\Entity\Notification\NotifiedBy;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Mgilet\NotificationBundle\Manager\NotificationManager;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class Notification
{
    private $em;
    private $notificationManager;
    private $tokenStorage;

    public function __construct(EntityManagerInterface $em, NotificationManager $notificationManager,TokenStorageInterface $tokenStorage)
    {
        $this->em = $em;
        $this->notificationManager = $notificationManager;
        $this->tokenStorage = $tokenStorage;
    }

    public function addNotification(array $options): void
    {
        $type = $options['type'];
        $object = $options['object'];

        if($type === 'deal'){
            $this->addDealNotification($object);
        }

    }

    public function addDealNotification(Deal $deal): void
    {
        $offerUser = $deal->getOfferUser();
        $demandUser = $deal->getDemandUser();
        $category = $deal->getCategory()->getParent()->getName().'-'. $deal->getCategory()->getName();

        $offerMessage='There is a proposed deal with ' . ' '. $demandUser->getFirstname(). ' regarding your OFFER from category '.$category ;
        $demandMessage='There is a proposed deal with '. ' '. $offerUser->getFirstname(). ' regarding your DEMAND from category '.$category ;

        $offerNot = $this->notificationManager->createNotification('New suggested deal !',$offerMessage,'/deal/'.$deal->getId());
        $demandNot = $this->notificationManager->createNotification('New suggested deal !',$demandMessage,'/deal/'.$deal->getId());

        $this->notificationManager->addNotification(array($offerUser), $offerNot, true);
        $this->notificationManager->addNotification(array($demandUser), $demandNot, true);

        $offerNotifiableNotifications= $offerNot->getNotifiableNotifications();
        $demandNotifiableNotifications= $demandNot->getNotifiableNotifications();

        $offerNotifiedBy = new NotifiedBy($offerNot, $demandUser, $offerUser, 'deal');
        $demandNotifiedBy = new NotifiedBy($demandNot, $offerUser, $demandUser,'deal');
        $this->em->persist($offerNotifiedBy);
        $this->em->persist($demandNotifiedBy);
        $this->em->flush();
    }
}