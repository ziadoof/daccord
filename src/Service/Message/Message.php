<?php


namespace App\Service\Message;



use App\Repository\Message\MessageRepository;
use FOS\MessageBundle\Model\ParticipantInterface;


class Message
{
    private $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository=$repository;
    }

    public function getNbUnreadMessage(ParticipantInterface $participant)
    {
       return $this->repository->findAllUnreadMessage($participant);

    }


}