<?php


namespace App\Service;


use App\Entity\Carpool\Voyage;
use App\Entity\Carpool\VoyageRequest;
use App\Entity\Deal\Deal;
use App\Entity\DriverRequest;
use App\Entity\Hosting\HostingRequest;
use App\Entity\Meetup\JoinRequest;
use App\Entity\Meetup\Meetup;
use App\Entity\Notification\NotifiedBy;
use App\Entity\Rating\Vote;
use App\Entity\User;
use App\Server\Chat;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Mgilet\NotificationBundle\Manager\NotificationManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;
use ZMQ;
use ZMQContext;
use ZMQSocket;

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

        switch ($type){
            case 'deal':
                $this->addDealNotification($object);
                break;
            case 'driverRequest':
                $this->addDriverRequestNotification($object);
                break;
            case 'treatmentDriverRequest':
                $this->addRequestTreatmentNotification($object,$options['treatment']);
                break;
            case 'addDriverToDeal':
                $this->addAddDriverToDealNotification($object);
                break;
            case 'semiDoneDeal':
            case 'doneDeal':
                $this->addDoneDealNotification($object,$type,$options['status']);
                break;
            case 'points':
                $this->addPointsNotification($options['user'], $options['status'],$options['number']);
                break;
            case 'ratingDriver':
                $this->addRatingDriver($object);
                break;
            case 'ratingHosting':
                $this->addRatingHosting($object);
                break;
            case 'hostingRequest':
                $this->addHostingRequestNotification($object);
                break;
            case 'treatmentHostingRequest':
                $this->addHostingRequestTreatmentNotification($object,$options['treatment']);
                break;
            case 'doneHosting':
                $this->addDoneHostingNotification($object);
                break;
            case 'hostingPoints':
                $this->addPointsHostingNotification($options['user'],$options['number']);
                break;
            case 'meetupRequest':
                $this->addMeetupRequestNotification($object);
                break;
            case 'treatmentMeetupRequest':
                $this->addMeetupRequestTreatmentNotification($object,$options['treatment']);
                break;
            case 'cancelJoinParticipant':
                $this->addMeetupCancelJoinParticipantNotification($object,$options);
                break;
            case 'cancelJoinWaiting':
                $this->addMeetupCancelJoinWaitingNotification($object,$options);
                break;
            case 'transferToParticipant':
                $this->addMeetupTransferToParticipantNotification($object,$options['recipient']);
                break;
            case 'meetupComment':
                $this->addMeetupCommentNotification($object,$options);
                break;
            case 'ratingMeetup':
                $this->addRatingMeetup($object,$options);
                break;
            case 'voyageRequest':
                $this->addVoyageRequest($object);
                break;
            case 'treatmentVoyageRequest':
                $this->addVoyageRequestTreatmentNotification($object,$options['treatment']);
                break;
            case 'voyageRemovePassenger':
                $this->addVoyageRemovePassengerNotification($object,$options);
                break;
            case 'lostPoints':
            case 'removeUserPoints':
                $this->addRemoveUserPointsNotification($options);
                break;
            case 'removeCarpoolPoints':
                $this->addRemoveCarpoolPointsNotification($options);
                break;
            case 'carpoolAddPoints':
                $this->addCarpoolPointsNotification($options);
                break;
            case 'ratingCarpool':
                $this->addRatingCarpoolNotification($object);
                break;
            case 'cancelVoyage':
                $this->addCancelVoyageNotification($object,$options);
                break;
            case 'pointsVoyageCanceled':
                $this->addCancelVoyageAddPointNotification($options);
                break;
            case 'dealCancel':
                $this->addDealCancelNotification($options);
                break;


        }

    }

    protected function addDealNotification(Deal $deal): void
    {
        $offerUser = $deal->getOfferUser();
        $demandUser = $deal->getDemandUser();

        $category = $deal->getCategory()->getName()==='Other'?$deal->getOffer()->getSubjectName():$deal->getCategory()->getName();
        $offerNotification = $this->notificationManager->createNotification('','','/deal/'.$deal->getId());
        $demandNotification = $this->notificationManager->createNotification('','','/deal/'.$deal->getId());

        $this->notificationManager->addNotification(array($offerUser), $offerNotification, true);
        $this->notificationManager->addNotification(array($demandUser), $demandNotification, true);

        $offerNotifiedBy = new NotifiedBy($offerNotification, $demandUser, $offerUser, 'deal',$category);
        $demandNotifiedBy = new NotifiedBy($demandNotification, $offerUser, $demandUser,'deal',$category);
        $this->em->persist($offerNotifiedBy);
        $this->em->persist($demandNotifiedBy);
        $this->em->flush();

        $thisUser = $this->security->getUser();
        $recipient = $thisUser===$offerUser?$demandUser:$offerUser;
        $sender = $thisUser===$offerUser?$offerUser:$demandUser;
        $notificationId = $thisUser===$offerUser?$demandNotification->getId():$offerNotification->getId();
        $notifiableId = $thisUser===$offerUser ?$demandNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId()
                                               :$offerNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();

        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'deal',
            'recipient'=>$recipient->getId(),
            'category'=>$category,
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/deal/' . $deal->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage()
        );

            $this->pushNotification($pushedNotification);

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

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'driverRequest',
            'recipient'=>$driver->getId(),
            'category'=>$category,
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/driver_request/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage()
        );

        $this->pushNotification($pushedNotification);
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

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'treatmentDriverRequest',
            'recipient'=>$user->getId(),
            'category'=>$category,
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/deal/'.$driverRequest->getDeal()->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
            'subject' =>$type
        );

        $this->pushNotification($pushedNotification);
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

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'addDriverToDeal',
            'recipient'=>$driver->getId(),
            'category'=>$category,
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/driver_request/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
        );

        $this->pushNotification($pushedNotification);
    }

    protected function addDoneDealNotification(Deal $deal, string $type, string $status): void
    {
        $category = $deal->getCategory()->getName()==='Other'?$deal->getOffer()->getSubjectName()
            :$deal->getCategory()->getName();
      /*  $doneDealNotification = $this->notificationManager->createNotification('','','/deal/');
        $semiDoneDealNotification = $this->notificationManager->createNotification('','','/deal/'.$deal->getId());
        $driverNotification = $this->notificationManager->createNotification('','','/driver_request/');*/

        $typeOfNotification = null;
        $sender = null;

        $firstNotificationId = null;
        $secondNotificationId = null;
        $firstNotifiableId = null;
        $secondNotifiableId = null;
        $firstRecipient = null;
        $secondRecipient = null;
        $firstLink= null;
        $secondLink= null;

        if($type === 'doneDeal'){
            $typeOfNotification = 'doneDeal';
            if($status ==='offer'){
                $sender = $deal->getOfferUser();

                $doneDealNotification = $this->notificationManager->createNotification('','','/deal/');
                $this->notificationManager->addNotification(array($deal->getDemandUser()), $doneDealNotification, true);
                $demandNotifiedBy = new NotifiedBy($doneDealNotification, $deal->getOfferUser(), $deal->getDemandUser(), 'doneDeal',$category);
                $this->em->persist($demandNotifiedBy);

                //variable realtime notification
                $firstNotificationId = $doneDealNotification->getId();
                $firstNotifiableId = $doneDealNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                $firstRecipient = $deal->getDemandUser();
                $firstLink= '/deal/';

                if($deal->getDriverUser()){
                    $driverNotification = $this->notificationManager->createNotification('','','/driver_request/');
                    $this->notificationManager->addNotification(array($deal->getDriverUser()), $driverNotification, true);
                    $driverNotifiedBy = new NotifiedBy($driverNotification, $deal->getOfferUser(), $deal->getDriverUser(), 'doneDeal',$category);
                    $this->em->persist($driverNotifiedBy);

                    //variable realtime notification
                    $secondNotificationId = $driverNotification->getId();
                    $secondNotifiableId = $driverNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                    $secondRecipient = $deal->getDriverUser();
                    $secondLink= '/driver_request/';
                }
            }
            elseif ($status === 'demand'){
                $sender = $deal->getDemandUser();

                $doneDealNotification = $this->notificationManager->createNotification('','','/deal/');
                $this->notificationManager->addNotification(array($deal->getOfferUser()), $doneDealNotification, true);
                $offerNotifiedBy = new NotifiedBy($doneDealNotification, $deal->getDemandUser(), $deal->getOfferUser(), 'doneDeal',$category);
                $this->em->persist($offerNotifiedBy);

                //variable realtime notification
                $firstNotificationId = $doneDealNotification->getId();
                $firstNotifiableId = $doneDealNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                $firstRecipient = $deal->getOfferUser();
                $firstLink= '/deal/';

                if($deal->getDriverUser()){

                    $driverNotification = $this->notificationManager->createNotification('','','/driver_request/');
                    $this->notificationManager->addNotification(array($deal->getDriverUser()), $driverNotification, true);
                    $driverNotifiedBy = new NotifiedBy($driverNotification, $deal->getDemandUser(), $deal->getDriverUser(), 'doneDeal',$category);
                    $this->em->persist($driverNotifiedBy);

                    //variable realtime notification
                    $secondNotificationId = $driverNotification->getId();
                    $secondNotifiableId = $driverNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                    $secondRecipient = $deal->getDriverUser();
                    $secondLink= '/driver_request/';
                }
            }
            else{//driver
                $sender = $deal->getDriverUser();

                $firstDoneDealNotification = $this->notificationManager->createNotification('','','/deal/');
                $this->notificationManager->addNotification(array($deal->getOfferUser()), $firstDoneDealNotification, true);
                $offerNotifiedBy = new NotifiedBy($firstDoneDealNotification, $deal->getDriverUser(), $deal->getOfferUser(), 'doneDeal',$category);
                $this->em->persist($offerNotifiedBy);

                //variable realtime notification
                $firstNotificationId = $firstDoneDealNotification->getId();
                $firstNotifiableId = $firstDoneDealNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                $firstRecipient = $deal->getOfferUser();
                $firstLink= '/deal/';

                $secondDoneDealNotification = $this->notificationManager->createNotification('','','/deal/');
                $this->notificationManager->addNotification(array($deal->getDemandUser()), $secondDoneDealNotification, true);
                $demandNotifiedBy = new NotifiedBy($secondDoneDealNotification, $deal->getDriverUser(), $deal->getDemandUser(), 'doneDeal',$category);
                $this->em->persist($demandNotifiedBy);

                //variable realtime notification
                $secondNotificationId = $secondDoneDealNotification->getId();
                $secondNotifiableId = $secondDoneDealNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                $secondRecipient = $deal->getDemandUser();
                $secondLink= '/deal/';

            }
        }
        else{
            $typeOfNotification = 'semiDoneDeal';

            if($status ==='offer'){
                $sender = $deal->getOfferUser();

                $semiDoneDealNotification = $this->notificationManager->createNotification('','','/deal/'.$deal->getId());
                $this->notificationManager->addNotification(array($deal->getDemandUser()), $semiDoneDealNotification, true);
                $demandNotifiedBy = new NotifiedBy($semiDoneDealNotification, $deal->getOfferUser(), $deal->getDemandUser(), 'semiDoneDeal',$category);
                $this->em->persist($demandNotifiedBy);

                //variable realtime notification
                $firstNotificationId = $semiDoneDealNotification->getId();
                $firstNotifiableId = $semiDoneDealNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                $firstRecipient = $deal->getDemandUser();
                $firstLink= '/deal/'.$deal->getId();

                if($deal->getDriverUser()){
                    $driverNotification = $this->notificationManager->createNotification('','','/driver_request/');
                    $this->notificationManager->addNotification(array($deal->getDriverUser()), $driverNotification, true);
                    $driverNotifiedBy = new NotifiedBy($driverNotification, $deal->getOfferUser(), $deal->getDriverUser(), 'semiDoneDeal',$category);
                    $this->em->persist($driverNotifiedBy);

                    //variable realtime notification
                    $secondNotificationId = $driverNotification->getId();
                    $secondNotifiableId = $driverNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                    $secondRecipient = $deal->getDriverUser();
                    $secondLink= '/driver_request/';
                }
            }
            elseif ($status === 'demand'){
                $sender = $deal->getDemandUser();

                $semiDoneDealNotification = $this->notificationManager->createNotification('','','/deal/'.$deal->getId());
                $this->notificationManager->addNotification(array($deal->getOfferUser()), $semiDoneDealNotification, true);
                $offerNotifiedBy = new NotifiedBy($semiDoneDealNotification, $deal->getDemandUser(), $deal->getOfferUser(), 'semiDoneDeal',$category);
                $this->em->persist($offerNotifiedBy);

                //variable realtime notification
                $firstNotificationId = $semiDoneDealNotification->getId();
                $firstNotifiableId = $semiDoneDealNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                $firstRecipient = $deal->getOfferUser();
                $firstLink= '/deal/'.$deal->getId();

                if($deal->getDriverUser()){
                    $driverNotification = $this->notificationManager->createNotification('','','/driver_request/');
                    $this->notificationManager->addNotification(array($deal->getDriverUser()), $driverNotification, true);
                    $driverNotifiedBy = new NotifiedBy($driverNotification, $deal->getDemandUser(), $deal->getDriverUser(), 'semiDoneDeal',$category);
                    $this->em->persist($driverNotifiedBy);

                    //variable realtime notification
                    $secondNotificationId = $driverNotification->getId();
                    $secondNotifiableId = $driverNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                    $secondRecipient = $deal->getDriverUser();
                    $secondLink= '/driver_request/';
                }
            }
            else{//driver
                $sender = $deal->getDriverUser();


                $firstSemiDoneDealNotification = $this->notificationManager->createNotification('','','/deal/'.$deal->getId());
                $this->notificationManager->addNotification(array($deal->getOfferUser()), $firstSemiDoneDealNotification, true);
                $offerNotifiedBy = new NotifiedBy($firstSemiDoneDealNotification, $deal->getDriverUser(), $deal->getOfferUser(), 'semiDoneDeal',$category);
                $this->em->persist($offerNotifiedBy);

                //variable realtime notification
                $firstNotificationId = $firstSemiDoneDealNotification->getId();
                $firstNotifiableId = $firstSemiDoneDealNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                $firstRecipient = $deal->getOfferUser();
                $firstLink= '/deal/'.$deal->getId();


                $secondSemiDoneDealNotification = $this->notificationManager->createNotification('','','/deal/'.$deal->getId());
                $this->notificationManager->addNotification(array($deal->getDemandUser()), $secondSemiDoneDealNotification, true);
                $demandNotifiedBy = new NotifiedBy($secondSemiDoneDealNotification, $deal->getDriverUser(), $deal->getDemandUser(), 'semiDoneDeal',$category);
                $this->em->persist($demandNotifiedBy);

                //variable realtime notification
                $secondNotificationId = $secondSemiDoneDealNotification->getId();
                $secondNotifiableId = $secondSemiDoneDealNotification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
                $secondRecipient = $deal->getDemandUser();
                $secondLink= '/deal/'.$deal->getId();
            }
        }
        $this->em->flush();

        //send realTime notification

        $firstNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>$typeOfNotification,
            'recipient'=>$firstRecipient->getId(),
            'category'=>$category,
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>$firstLink,
            'notificationId'=>$firstNotificationId,
            'notifiableId'=>$firstNotifiableId,
            'senderImage'=>$sender->getProfileImage(),
        );


        $this->pushNotification($firstNotification);

        if($secondRecipient && $secondNotificationId){
            $secondNotification = array(
                'type'=>'notification',
                'typeOfNotification'=>$typeOfNotification,
                'recipient'=>$secondRecipient->getId(),
                'category'=>$category,
                'sender'=>ucfirst($sender->getFirstname()),
                'link' =>$secondLink,
                'notificationId'=>$secondNotificationId,
                'notifiableId'=>$secondNotifiableId,
                'senderImage'=>$sender->getProfileImage(),
            );
            $this->pushNotification($secondNotification);
        }
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

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>$type,
            'recipient'=>$user->getId(),
            'category'=>'Points',
            'sender'=>null,
            'link' =>'/profile/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>null,
        );


        $this->pushNotification($pushNotification);
    }


    /**
     * send realtime notification
     * @param $pushedNotification
     * @throws \ZMQSocketException
     */
    public function pushNotification($pushedNotification): void
    {

        $dsn = 'tcp://127.0.0.1:5555';
        /* Create a socket */
        $socket = new ZMQSocket(new ZMQContext(1), ZMQ::SOCKET_PUSH);
        /* Get list of connected endpoints */
        $endpoints = $socket->getEndpoints();
        /* Check if the socket is connected */
        if (!in_array($dsn, $endpoints['connect'])) {
            $socket->connect($dsn);
            $socket->send(json_encode($pushedNotification));
        } else {
            $socket->send(json_encode($pushedNotification));
        }
    }

    public function addRatingDriver(Vote $vote): void
    {
        $notification = $this->notificationManager->createNotification('','','/profile/');
        $this->notificationManager->addNotification(array($vote->getCandidate()), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $vote->getVoter(), $vote->getCandidate(), 'ratingDriver','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'ratingDriver',
            'recipient'=>$vote->getCandidate()->getId(),
            'category'=>'',
            'sender'=>ucfirst($vote->getVoter()->getFirstname()),
            'link' =>'/profile/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$vote->getVoter()->getProfileImage(),
        );


        $this->pushNotification($pushNotification);

    }

    private function addRatingHosting(Vote $vote): void
    {
        $notification = $this->notificationManager->createNotification('','','/profile/');
        $this->notificationManager->addNotification(array($vote->getCandidate()), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $vote->getVoter(), $vote->getCandidate(), 'ratingHosting','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'ratingHosting',
            'recipient'=>$vote->getCandidate()->getId(),
            'category'=>'',
            'sender'=>ucfirst($vote->getVoter()->getFirstname()),
            'link' =>'/profile/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$vote->getVoter()->getProfileImage(),
        );


        $this->pushNotification($pushNotification);
    }

    private function addHostingRequestNotification(HostingRequest $hostingRequest): void
    {
        $hosting = $hostingRequest->getHosting();
        $sender = $hostingRequest->getSender();

        $notification = $this->notificationManager->createNotification('','','/hosting_request/received');

        $this->notificationManager->addNotification(array($hosting), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $hosting, 'hostingRequest','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'hostingRequest',
            'recipient'=>$hosting->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/hosting_request/received',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage()
        );

        $this->pushNotification($pushedNotification);
    }

    private function addHostingRequestTreatmentNotification(HostingRequest $hostingRequest, string $type): void
    {
        $user = $hostingRequest->getSender();
        $sender = $hostingRequest->getHosting();

        $notification = $this->notificationManager->createNotification($type,'','/hosting_request/');

        $this->notificationManager->addNotification(array($user), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $user, 'treatmentHostingRequest','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'treatmentHostingRequest',
            'recipient'=>$user->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/hosting_request/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
            'subject' =>$type
        );

        $this->pushNotification($pushedNotification);
    }

    private function addDoneHostingNotification(HostingRequest $hostingRequest): void
    {
        $thisUser = $this->security->getUser();

        if ($thisUser === $hostingRequest->getSender()){
            $user = $hostingRequest->getHosting();
            $sender =$hostingRequest->getSender();
            $link = '/hosting_request/received';
        }
        else{
            $user = $hostingRequest->getSender();
            $sender =$hostingRequest->getHosting();
            $link = '/hosting_request/';
        }

        $notification = $this->notificationManager->createNotification('','',$link);

        $this->notificationManager->addNotification(array($user), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $user, 'doneHosting','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'doneHosting',
            'recipient'=>$user->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>$link,
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
        );

        $this->pushNotification($pushedNotification);
    }

    private function addPointsHostingNotification(User $user, string $point): void
    {

        $notification = $this->notificationManager->createNotification('hostingPoints',$point,'/profile/');
        $this->notificationManager->addNotification(array($user), $notification, true);
        // you must make the sender nullable , here no sender but it is any user
        $notifiedBy = new NotifiedBy($notification, $user, $user, 'hostingPoints','Points');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'hostingPoints',
            'recipient'=>$user->getId(),
            'category'=>'Points',
            'sender'=>null,
            'link' =>'/profile/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>null,
        );


        $this->pushNotification($pushNotification);
    }

    private function addMeetupRequestNotification(JoinRequest $joinRequest): void
    {
        $recipient = $joinRequest->getMeetup()->getCreator();
        $sender = $joinRequest->getUser();

        $notification = $this->notificationManager->createNotification('','meetupParticipant','/meetup/show/'.$joinRequest->getMeetup()->getId());

        $this->notificationManager->addNotification(array($recipient), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'meetupRequest','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'meetupRequest',
            'recipient'=>$recipient->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/meetup/show/'.$joinRequest->getMeetup()->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage()
        );

        $this->pushNotification($pushedNotification);
    }

    private function addMeetupRequestTreatmentNotification(JoinRequest $joinRequest,string $treatment): void
    {
        $recipient = $joinRequest->getUser();
        $sender = $joinRequest->getMeetup()->getCreator();

        $notification = $this->notificationManager->createNotification($treatment,'meetupParticipant','/meetup/show/'.$joinRequest->getMeetup()->getId());

        $this->notificationManager->addNotification(array($recipient), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'treatmentMeetupRequest','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'treatmentMeetupRequest',
            'recipient'=>$recipient->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/meetup/show/'.$joinRequest->getMeetup()->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
            'subject' =>$treatment
        );

        $this->pushNotification($pushedNotification);
    }

    private function addMeetupCancelJoinParticipantNotification(Meetup $meetup, array $options): void
    {
        $recipient = $options['recipient'];
        $sender = $options['sender'];

        $notification = $this->notificationManager->createNotification($options['status'],'meetupParticipant','/meetup/show/'.$meetup->getId());

        $this->notificationManager->addNotification(array($recipient), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'cancelJoinParticipant','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'cancelJoinParticipant',
            'recipient'=>$recipient->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/meetup/show/'.$meetup->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
            'subject' =>$options['status']
        );
        $this->pushNotification($pushedNotification);

    }

    private function addMeetupCancelJoinWaitingNotification(Meetup $meetup, array $options): void
    {
        $recipient = $options['recipient'];
        $sender = $options['sender'];

        $notification = $this->notificationManager->createNotification($options['status'],'meetupParticipant','/meetup/show/'.$meetup->getId());

        $this->notificationManager->addNotification(array($recipient), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'cancelJoinWaiting','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'cancelJoinWaiting',
            'recipient'=>$recipient->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/meetup/show/'.$meetup->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
            'subject' =>$options['status']
        );
        $this->pushNotification($pushedNotification);
    }

    private function addMeetupTransferToParticipantNotification(Meetup $meetup, $recipient): void
    {

        $sender = $meetup->getCreator();

        $notification = $this->notificationManager->createNotification('','participant','/meetup/show/'.$meetup->getId());

        $this->notificationManager->addNotification(array($recipient), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'transferToParticipant','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'transferToParticipant',
            'recipient'=>$recipient->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/meetup/show/'.$meetup->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
        );
        $this->pushNotification($pushedNotification);
    }

    private function addMeetupCommentNotification(Meetup $meetup, $options): void
    {
        $recipients = $options['recipients'];
        $sender = $options['sender'];

        $notification = $this->notificationManager->createNotification('meetupComment','','/meetup/show/'.$meetup->getId());

        $this->notificationManager->addNotification($recipients, $notification, true);

        foreach ($recipients as $recipient){
            $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'meetupComment','');
            $this->em->persist($notifiedBy);
        }
        $this->em->flush();


        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        foreach ($recipients as $recipient){
            $pushedNotification = array(
                'type'=>'notification',
                'typeOfNotification'=>'meetupComment',
                'recipient'=>$recipient->getId(),
                'category'=>'',
                'sender'=>ucfirst($sender->getFirstname()),
                'link' =>'/meetup/show/'.$meetup->getId(),
                'notificationId'=>$notificationId,
                'notifiableId'=>$notifiableId,
                'senderImage'=>$sender->getProfileImage(),
            );
            $this->pushNotification($pushedNotification);
        }

    }

    private function addRatingMeetup(Vote $vote, $options): void
    {
        $meetup = $options['meetup'];

        $notification = $this->notificationManager->createNotification('ratingMeetup','','/meetup/show/'.$meetup->getId());
        $this->notificationManager->addNotification(array($meetup->getCreator()), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $vote->getVoter(), $meetup->getCreator(), 'ratingMeetup','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'ratingMeetup',
            'recipient'=>$meetup->getCreator()->getId(),
            'category'=>'',
            'sender'=>ucfirst($vote->getVoter()->getFirstname()),
            'link' =>'/meetup/show/'.$meetup->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$vote->getVoter()->getProfileImage(),
        );


        $this->pushNotification($pushNotification);
    }

    private function addVoyageRequest(VoyageRequest $voyageRequest): void
    {
        $recipient = $voyageRequest->getVoyage()->getCreator()->getUser();
        $sender = $voyageRequest->getSender();

        $notification = $this->notificationManager->createNotification('','','/voyage/'.$voyageRequest->getVoyage()->getId());

        $this->notificationManager->addNotification(array($recipient), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'voyageRequest','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'voyageRequest',
            'recipient'=>$recipient->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/voyage/'.$voyageRequest->getVoyage()->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage()
        );

        $this->pushNotification($pushedNotification);

    }

    private function addVoyageRequestTreatmentNotification(VoyageRequest $voyageRequest,string $treatment): void
    {
        $recipient = $voyageRequest->getSender();
        $sender = $voyageRequest->getVoyage()->getCreator()->getUser();

        $notification = $this->notificationManager->createNotification($treatment,'voyageTreatment','/voyage/'.$voyageRequest->getVoyage()->getId());

        $this->notificationManager->addNotification(array($recipient), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'treatmentVoyageRequest','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'treatmentVoyageRequest',
            'recipient'=>$recipient->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/voyage/'.$voyageRequest->getVoyage()->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
            'subject' =>$treatment
        );

        $this->pushNotification($pushedNotification);
    }

    private function addVoyageRemovePassengerNotification(Voyage $voyage,array $options): void
    {
        $recipient = $options['recipient'];
        $sender = $options['sender'];
        $status = $options['status'];

        $notification = $this->notificationManager->createNotification($status,'','/voyage/'.$voyage->getId());

        $this->notificationManager->addNotification(array($recipient), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'voyageRemovePassenger','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'voyageRemovePassenger',
            'recipient'=>$recipient->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/voyage/'.$voyage->getId(),
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
        );
        $this->pushNotification($pushedNotification);
    }

    private function addRemoveUserPointsNotification(array $options): void
    {
        $recipient = $options['user'];
        $point = $options['point'];
        $notification = $this->notificationManager->createNotification('removeUserPoints',$point,'/profile/');
        $this->notificationManager->addNotification(array($recipient), $notification, true);
        // you must make the sender nullable , here no sender but it is any user
        $notifiedBy = new NotifiedBy($notification, $recipient, $recipient, 'removeUserPoints',$point);
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'removeUserPoints',
            'recipient'=>$recipient->getId(),
            'category'=>$point,
            'sender'=>null,
            'link' =>'/profile/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>null,
        );


        $this->pushNotification($pushNotification);
    }

    private function addRemoveCarpoolPointsNotification(array $options): void
    {
        $recipient = $options['user'];
        $point = $options['point'];
        $notification = $this->notificationManager->createNotification('removeCarpoolPoints',$point,'/profile/');
        $this->notificationManager->addNotification(array($recipient), $notification, true);
        // you must make the sender nullable , here no sender but it is any user
        $notifiedBy = new NotifiedBy($notification, $recipient, $recipient, 'removeCarpoolPoints',$point);
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'removeCarpoolPoints',
            'recipient'=>$recipient->getId(),
            'category'=>$point,
            'sender'=>null,
            'link' =>'/profile/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>null,
        );


        $this->pushNotification($pushNotification);
    }

    private function addCarpoolPointsNotification(array $options): void
    {
        $recipient = $options['user'];
        $point =    $options['point'];
        $notification = $this->notificationManager->createNotification('carpoolAddPoints',$point,'/profile/');
        $this->notificationManager->addNotification(array($recipient), $notification, true);
        // you must make the sender nullable , here no sender but it is any user
        $notifiedBy = new NotifiedBy($notification, $recipient, $recipient, 'carpoolAddPoints',$point);
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'carpoolAddPoints',
            'recipient'=>$recipient->getId(),
            'category'=>'Points',
            'sender'=>null,
            'link' =>'/profile/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>null,
        );


        $this->pushNotification($pushNotification);
    }

    private function addRatingCarpoolNotification(Vote $vote): void
    {
        $notification = $this->notificationManager->createNotification('ratingCarpool','','/profile/');
        $this->notificationManager->addNotification(array($vote->getCandidate()), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $vote->getVoter(), $vote->getCandidate(), 'ratingCarpool','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'ratingCarpool',
            'recipient'=>$vote->getCandidate()->getId(),
            'category'=>'',
            'sender'=>ucfirst($vote->getVoter()->getFirstname()),
            'link' =>'/profile/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$vote->getVoter()->getProfileImage(),
        );


        $this->pushNotification($pushNotification);
    }

    private function addCancelVoyageNotification(Voyage $voyage, array $options): void
    {
        $recipient = $options['recipient'];
        $sender = $voyage->getCreator()->getUser();

        $notification = $this->notificationManager->createNotification('cancelVoyage','','/voyage/');

        $this->notificationManager->addNotification(array($recipient), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'cancelVoyage','');
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'cancelVoyage',
            'recipient'=>$recipient->getId(),
            'category'=>'',
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/voyage/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
        );
        $this->pushNotification($pushedNotification);
    }

    private function addCancelVoyageAddPointNotification(array $options): void
    {
        $recipient = $options['recipient'];
        $point =    $options['points'];
        $notification = $this->notificationManager->createNotification('pointsVoyageCanceled',$point,'/profile/');
        $this->notificationManager->addNotification(array($recipient), $notification, true);
        // you must make the sender nullable , here no sender but it is any user
        $notifiedBy = new NotifiedBy($notification, $recipient, $recipient, 'pointsVoyageCanceled',$point);
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'pointsVoyageCanceled',
            'recipient'=>$recipient->getId(),
            'category'=>'Points',
            'sender'=>null,
            'link' =>'/profile/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>null,
        );


        $this->pushNotification($pushNotification);
    }

    public function addDealCancelNotification($options){
        $recipient = $options['recipient'];
        $sender = $options['sender'];
        $category = $options['category'];

        $notification = $this->notificationManager->createNotification('','','/driver_request/');

        $this->notificationManager->addNotification(array($recipient), $notification, true);

        $notifiedBy = new NotifiedBy($notification, $sender, $recipient, 'cancelDeal',$category);
        $this->em->persist($notifiedBy);
        $this->em->flush();

        $notificationId = $notification->getId();
        $notifiableId = $notification->getNotifiableNotifications()[0]->getNotifiableEntity()->getId();
        $pushedNotification = array(
            'type'=>'notification',
            'typeOfNotification'=>'cancelDeal',
            'recipient'=>$recipient->getId(),
            'category'=>$category,
            'sender'=>ucfirst($sender->getFirstname()),
            'link' =>'/driver_request/',
            'notificationId'=>$notificationId,
            'notifiableId'=>$notifiableId,
            'senderImage'=>$sender->getProfileImage(),
        );
        $this->pushNotification($pushedNotification);
    }
}