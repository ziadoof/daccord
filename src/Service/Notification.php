<?php


namespace App\Service;


use App\Entity\Deal\Deal;
use App\Entity\DriverRequest;
use App\Entity\Notification\NotifiedBy;
use App\Entity\User;
use App\Server\Chat;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Mgilet\NotificationBundle\Manager\NotificationManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;

class Notification
{
    private $em;
    private $notificationManager;
    private $security;
    private $chat;

    public function __construct(EntityManagerInterface $em, NotificationManager $notificationManager,Security $security,Chat $chat)
    {
        $this->em = $em;
        $this->notificationManager = $notificationManager;
        $this->security = $security;
        $this->chat = $chat;
    }

    public function addNotification(array $options): void
    {
        $type = $options['type'];
        $object = $options['object']??null;

        if($type === 'deal'){
            $this->addDealNotification($object);
        }
        if ($type === 'driverRequest'){
            $this->addDriverRequestNotification($object);
        }
        if($type === 'treatmentDriverRequest'){
            $this->addRequestTreatmentNotification($object,$options['treatment']);
        }
        if($type === 'addDriverToDeal'){
            $this->addAddDriverToDealNotification($object);
        }
        if($type === 'doneDeal' || $type === 'semiDoneDeal'){
            $this->addDoneDealNotification($object,$type,$options['status']);
        }
        if($type === 'points'){
            $this->addPointsNotification($options['user'], $options['status'],$options['number']);
        }

    }

    protected function addDealNotification(Deal $deal): void
    {
        $offerUser = $deal->getOfferUser();
        $demandUser = $deal->getDemandUser();

        $category = $deal->getCategory()->getName()==='Other'?$deal->getOffer()->getSubjectName():$deal->getCategory()->getName();
        $notification = $this->notificationManager->createNotification('','','/deal/'.$deal->getId());

        $this->notificationManager->addNotification(array($offerUser), $notification, true);
        $this->notificationManager->addNotification(array($demandUser), $notification, true);

        $offerNotifiedBy = new NotifiedBy($notification, $demandUser, $offerUser, 'deal',$category);
        $demandNotifiedBy = new NotifiedBy($notification, $offerUser, $demandUser,'deal',$category);
        $this->em->persist($offerNotifiedBy);
        $this->em->persist($demandNotifiedBy);
        $this->em->flush();

    }

    protected function addDriverRequestNotification(DriverRequest $driverRequest): void
    {
        $driver = $driverRequest->getDriver()->getUser();
        $sender = $driverRequest->getUser();

        $category = $driverRequest->getDeal()->getCategory()->getName()==='Other'?$driverRequest->getDeal()->getOffer()->getSubjectName()
                                                                                :$driverRequest->getDeal()->getCategory()->getName();
        $notification = $this->notificationManager->createNotification('','','/driver_request/');

        $this->notificationManager->addNotification(array($driver), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $driver, 'driverRequest',$category);
        $this->em->persist($notifiedBy);
        $this->em->flush();
    }

    protected function addRequestTreatmentNotification(DriverRequest $driverRequest, string $type): void
    {
        $user = $driverRequest->getUser();
        $sender = $driverRequest->getDriver()->getUser();

        $category = $driverRequest->getDeal()->getCategory()->getName()==='Other'?$driverRequest->getDeal()->getOffer()->getSubjectName()
            :$driverRequest->getDeal()->getCategory()->getName();
        $notification = $this->notificationManager->createNotification($type,'','/deal/'.$driverRequest->getDeal()->getId());

        $this->notificationManager->addNotification(array($user), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $user, 'treatmentDriverRequest',$category);
        $this->em->persist($notifiedBy);
        $this->em->flush();
    }

    protected function addAddDriverToDealNotification(DriverRequest $driverRequest): void
    {
        $driver = $driverRequest->getDriver()->getUser();
        $sender = $driverRequest->getUser();

        $category = $driverRequest->getDeal()->getCategory()->getName()==='Other'?$driverRequest->getDeal()->getOffer()->getSubjectName()
            :$driverRequest->getDeal()->getCategory()->getName();
        $notification = $this->notificationManager->createNotification('','','/driver_request/');

        $this->notificationManager->addNotification(array($driver), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $driver, 'addDriverToDeal',$category);
        $this->em->persist($notifiedBy);
        $this->em->flush();
    }

    protected function addDoneDealNotification(Deal $deal, string $type, string $status): void
    {
        $category = $deal->getCategory()->getName()==='Other'?$deal->getOffer()->getSubjectName()
            :$deal->getCategory()->getName();
        $doneDealNotification = $this->notificationManager->createNotification('','','/deal/');
        $semiDoneDealNotification = $this->notificationManager->createNotification('','','/deal/'.$deal->getId());
        $driverNotification = $this->notificationManager->createNotification('','','/driver_request/');

        if($type === 'doneDeal'){
            if($status ==='offer'){
                $this->notificationManager->addNotification(array($deal->getDemandUser()), $doneDealNotification, true);
                $demandNotifiedBy = new NotifiedBy($doneDealNotification, $deal->getOfferUser(), $deal->getDemandUser(), 'doneDeal',$category);
                $this->em->persist($demandNotifiedBy);

                if($deal->getDriverUser()){
                    $this->notificationManager->addNotification(array($deal->getDriverUser()), $driverNotification, true);
                    $driverNotifiedBy = new NotifiedBy($driverNotification, $deal->getOfferUser(), $deal->getDriverUser(), 'doneDeal',$category);
                    $this->em->persist($driverNotifiedBy);
                }
            }
            elseif ($status === 'demand'){
                $this->notificationManager->addNotification(array($deal->getOfferUser()), $doneDealNotification, true);
                $offerNotifiedBy = new NotifiedBy($doneDealNotification, $deal->getDemandUser(), $deal->getOfferUser(), 'doneDeal',$category);
                $this->em->persist($offerNotifiedBy);

                if($deal->getDriverUser()){
                    $this->notificationManager->addNotification(array($deal->getDriverUser()), $driverNotification, true);
                    $driverNotifiedBy = new NotifiedBy($driverNotification, $deal->getDemandUser(), $deal->getDriverUser(), 'doneDeal',$category);
                    $this->em->persist($driverNotifiedBy);
                }
            }
            else{//driver
                $this->notificationManager->addNotification(array($deal->getOfferUser()), $doneDealNotification, true);
                $offerNotifiedBy = new NotifiedBy($doneDealNotification, $deal->getDriverUser(), $deal->getOfferUser(), 'doneDeal',$category);
                $this->em->persist($offerNotifiedBy);

                $this->notificationManager->addNotification(array($deal->getDemandUser()), $doneDealNotification, true);
                $demandNotifiedBy = new NotifiedBy($doneDealNotification, $deal->getDriverUser(), $deal->getDemandUser(), 'doneDeal',$category);
                $this->em->persist($demandNotifiedBy);

            }
        }
        else{
            if($status ==='offer'){
                $this->notificationManager->addNotification(array($deal->getDemandUser()), $semiDoneDealNotification, true);
                $demandNotifiedBy = new NotifiedBy($semiDoneDealNotification, $deal->getOfferUser(), $deal->getDemandUser(), 'semiDoneDeal',$category);
                $this->em->persist($demandNotifiedBy);

                if($deal->getDriverUser()){
                    $this->notificationManager->addNotification(array($deal->getDriverUser()), $driverNotification, true);
                    $driverNotifiedBy = new NotifiedBy($driverNotification, $deal->getOfferUser(), $deal->getDriverUser(), 'semiDoneDeal',$category);
                    $this->em->persist($driverNotifiedBy);
                }
            }
            elseif ($status === 'demand'){
                $this->notificationManager->addNotification(array($deal->getOfferUser()), $semiDoneDealNotification, true);
                $offerNotifiedBy = new NotifiedBy($semiDoneDealNotification, $deal->getDemandUser(), $deal->getOfferUser(), 'semiDoneDeal',$category);
                $this->em->persist($offerNotifiedBy);

                if($deal->getDriverUser()){
                    $this->notificationManager->addNotification(array($deal->getDriverUser()), $driverNotification, true);
                    $driverNotifiedBy = new NotifiedBy($driverNotification, $deal->getDemandUser(), $deal->getDriverUser(), 'semiDoneDeal',$category);
                    $this->em->persist($driverNotifiedBy);
                }
            }
            else{//driver
                $this->notificationManager->addNotification(array($deal->getOfferUser()), $semiDoneDealNotification, true);
                $offerNotifiedBy = new NotifiedBy($semiDoneDealNotification, $deal->getDriverUser(), $deal->getOfferUser(), 'semiDoneDeal',$category);
                $this->em->persist($offerNotifiedBy);

                $this->notificationManager->addNotification(array($deal->getDemandUser()), $semiDoneDealNotification, true);
                $demandNotifiedBy = new NotifiedBy($semiDoneDealNotification, $deal->getDriverUser(), $deal->getDemandUser(), 'semiDoneDeal',$category);
                $this->em->persist($demandNotifiedBy);
            }
        }
        $this->em->flush();
    }

    protected function addPointsNotification(User $user,string $status, string $point): void
    {

        $type = $status === 'user'? 'profilePoints':'driverPoints';
        $subject = $status === 'user'? 'profilePoints':'driverPoints';
        $notification = $this->notificationManager->createNotification($subject,$point,'/profile/');
        $this->notificationManager->addNotification(array($user), $notification, true);
        // you must make the sender nullable , here no sender but it is any user
        $notifiedBy = new NotifiedBy($notification, $user, $user, $type,'Points');
        $this->em->persist($notifiedBy);
        $this->em->flush();
    }


}