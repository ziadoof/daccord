<?php


namespace App\Form\Message;

use FOS\MessageBundle\FormModel\AbstractMessage;
use FOS\MessageBundle\Model\ParticipantInterface;

class NewThreadMessage extends AbstractMessage
{
    /**
     * The user who receives the message
     *
     * @var ParticipantInterface
     */

    /**
     * The user who receives the message
     *
     * @var ParticipantInterface
     */
    protected $recipient;

    /**
     * @return ParticipantInterface
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param  ParticipantInterface
     * @return null
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }
}