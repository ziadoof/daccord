<?php


namespace App\Events\EventSubscriber;

use App\Entity\Ads\Ad;
use App\Events\Events;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Entity\Deal\Deal;
class AdAddSubscriber implements EventSubscriberInterface
{
    private $em;

    /**
     * AdAddSubscriber constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
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
        $category = $ad->getCategory();
        $typeOfAd = $ad->getTypeOfAd();

    }

    public function createDeal(Ad $offer, Ad $demand): void
    {
        $deal = new Deal();

        $deal->setOffer($offer);
        $deal->setDemand($demand);
        $deal->setCategory($offer->getCategory());
        $deal->setOfferUser($offer->getUser());
        $deal->setDemandUser($demand->getUser());
        $this->em->persist($deal);
        $this->em->flush();
    }
}