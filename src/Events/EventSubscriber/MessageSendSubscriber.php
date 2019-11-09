<?php


namespace App\Events\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FOS\MessageBundle\Event\MessageEvent;
use FOS\MessageBundle\Event\FOSMessageEvents as Event;
use FOS\MessageBundle\ModelManager\MessageManagerInterface;
class MessageSendSubscriber implements EventSubscriberInterface
{
    private $messageManager;

    public function __construct(MessageManagerInterface $messageManager)
    {
        $this->messageManager = $messageManager;
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
    public static function getSubscribedEvents()
    {
        return array(
            Event::POST_SEND => 'messageSent'
        );
    }

    public function messageSent(MessageEvent $event)
    {
        $message = $event->getMessage();
        $sender = $message->getSender();
        dump($message);
        $this->messageManager->markAsReadByParticipant($message, $sender);
        $this->messageManager->saveMessage($message);
    }
}