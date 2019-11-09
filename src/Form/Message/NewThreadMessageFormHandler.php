<?php


namespace App\Form\Message;

use FOS\MessageBundle\Composer\ComposerInterface;
use FOS\MessageBundle\FormHandler\NewThreadMessageFormHandler as BaseFormHandler;
use FOS\MessageBundle\FormModel\AbstractMessage;
use App\Form\Message\NewThreadMessage;
use FOS\MessageBundle\Model\MessageInterface;
use FOS\MessageBundle\Security\ParticipantProviderInterface;
use FOS\MessageBundle\Sender\SenderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Form handler for multiple recipients support
 */
class NewThreadMessageFormHandler extends BaseFormHandler
{
    protected $request;

    public function __construct(RequestStack $requestStack, ComposerInterface $composer, SenderInterface $sender, ParticipantProviderInterface $participantProvider)
    {
        $this->request=$requestStack->getCurrentRequest();
        parent::__construct($this->request, $composer, $sender, $participantProvider);
    }

    /**
     * Composes a message from the form data.
     *
     * @param AbstractMessage $message
     *
     * @throws \InvalidArgumentException if the message is not a NewThreadMessage
     *
     * @return MessageInterface the composed message ready to be sent
     */
    public function composeMessage(AbstractMessage $message)
    {
        if (!$message instanceof NewThreadMessage) {
            throw new \InvalidArgumentException(sprintf('Message must be a NewThreadMessage instance, "%s" given', get_class($message)));
        }

        return $this->composer->newThread()
            ->setSubject(' ')
            ->addRecipient($message->getRecipient())
            ->setSender($this->getAuthenticatedParticipant())
            ->setBody($message->getBody())
            ->getMessage();
    }
}