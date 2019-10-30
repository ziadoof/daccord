<?php


namespace App\Events\EventSubscriber;

use App\Entity\Ads\Ad;
use App\Entity\Notification\NotifiedBy;
use App\Entity\User;
use App\Events\Events;
use App\Model\AdModel;
use App\Service\Notification;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use Mgilet\NotificationBundle\Manager\NotificationManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Entity\Deal\Deal;
class AdAddSubscriber implements EventSubscriberInterface
{
    private $em;
    private $manager;
    protected $notification;


    /**
     * AdAddSubscriber constructor.
     * @param EntityManager $em
     * @param RepositoryManagerInterface $manager
     * @param Notification $notification
     */
    public function __construct(EntityManager $em, RepositoryManagerInterface $manager, Notification $notification)
    {
        $this->em = $em;
        $this->manager = $manager;
        $this->notification = $notification;

    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents(): array
    {
        return [
            // le nom de l'event et le nom de la fonction qui sera déclenché
            Events::AD_ADD => 'prepareDeal',
        ];
    }

    public function prepareDeal(GenericEvent $event): void
    {
        /** @var Ad $ad */
        $ad = $event->getSubject();
        $typeOfAd = $ad->getTypeOfAd();
        if($typeOfAd === 'Demand'){
            // search for offer symmetric with this demand
            $results = $this->manager->getRepository('App\Entity\Ads\Ad')->getDealOffer($ad);
            foreach ($results as $result){
                if($result->getUser() !== $ad->getUser()){
                    $this->createDeal($result, $ad);
                }
            }
        }
        else{
            // search for demand symmetric with this offer
            $results = $this->manager->getRepository('App\Entity\Ads\Ad')->getDealDemand($ad);
            foreach ($results as $result){
                if($result->getUser() !== $ad->getUser()){
                    $this->createDeal($ad, $result);
                }
            }
        }



    }

    public function createDeal(Ad $offer, Ad $demand): void
    {
        $deal = new Deal();

        $deal->setOffer($offer);
        $deal->setDemand($demand);
        $deal->setCategory($offer->getCategory());
        $deal->setOfferUser($offer->getUser());
        $deal->setDemandUser($demand->getUser());
        try {
            $this->em->persist($deal);
        } catch (ORMException $e) {
        }

        try {
            $this->em->flush();
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
        $this->notification->addNotification(['type'=>'deal','object'=>$deal]);
    }

}