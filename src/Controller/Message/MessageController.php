<?php


namespace App\Controller\Message;


use App\Form\Message\NewThreadMessageFormHandler;
use App\Repository\Message\MessageRepository;
use App\Repository\UserRepository;
use FOS\MessageBundle\Controller\MessageController as BaseController;
use FOS\MessageBundle\Sender\SenderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/message")
 */
class MessageController extends BaseController
{

    private $formHandler;
    private $sender;
    private $userRepository;
    private $messageRepository;

    public function __construct(ContainerInterface $container,
                                NewThreadMessageFormHandler $formHandler,
                                SenderInterface $sender,
                                UserRepository $userRepository,
                                MessageRepository $messageRepository)
    {
        parent::__construct($container);
        $this->formHandler = $formHandler;
        $this->sender = $sender;
        $this->userRepository =$userRepository;
        $this->messageRepository =$messageRepository;
    }

    /**
     * Displays the authenticated participant inbox.
     * @Route("/", name="message_index", methods={"GET","POST"})
     * @return Response
     */
    public function inboxAction()
    {
        $threads = $this->getFormsTreads()['threads'];
        $forms =  $this->getFormsTreads()['forms'];
        $unReadMessages =  $this->getFormsTreads()['unReadMessages'];

        foreach ($threads as $thread){
            $form = $this->container->get('fos_message.reply_form.factory')->create($thread);
            $formHandler = $this->container->get('fos_message.reply_form.handler');
            if ($message = $formHandler->process($form)) {
                return $this->render('@FOSMessage/Message/inbox.html.twig', array(
                    'threads' => $threads,
                    'forms' => $forms,
                    'unReadMessages'=>$unReadMessages
                ));
            }

        }
        return $this->render('@FOSMessage/Message/inbox.html.twig', array(
            'threads' => $threads,
            'forms' => $forms,
            'unReadMessages'=>$unReadMessages

        ));
    }

    /**
     *
     * @Route("/conversation",name="message_send", methods={"POST"})
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param EventDispatcherInterface $eventDispatcher
     * @return Response
     */
    public function sendMessage(\Symfony\Component\HttpFoundation\Request $request, EventDispatcherInterface $eventDispatcher): Response
    {
        $threadtext = $request->request->get('conversation');
        $messagetext = $request->request->get('message');
        $recipient = $request->request->get('recipient');

        $composer = $this->container->get('fos_message.composer');
        $thread = $this->getProvider()->getThread($threadtext);


        $message = $composer->reply($thread)
        ->setSender($this->getUser())
        ->setBody($messagetext)
        ->getMessage();

        $sender = $this->container->get('fos_message.sender');
        $sender->send($message);


        $data = [$messagetext ,$thread->getId(),$recipient];
        return new JsonResponse($data);
    }

    /**
     * Create a new message thread.
     * @Route( name="new_conversation", methods={"POST"})
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function newAction(): ?Response
    {
        $threads = $this->getFormsTreads()['threads'];
        $forms =  $this->getFormsTreads()['forms'];
        $unReadMessages =  $this->getFormsTreads()['unReadMessages'];

        $recipient = null;
        $haveConversation = false;
        $form = $this->container->get('fos_message.new_thread_form.factory')->create();
        if (isset($_POST['user']))
        {
            $recipient= $user= $this->userRepository->findOneById($_POST['user']);
            foreach ($threads as $thread){
                $participants = $thread->getParticipants($this->getUser());
                if(($participants[0] === $this->getUser() && $participants[1] === $recipient) ||
                    ($participants[0]  === $recipient && $participants[1]  === $this->getUser())
                    )
                {
                    $haveConversation = true;
                }
            }
        }

        if($recipient){
            if($haveConversation){
                return new RedirectResponse($this->container->get('router')->generate('fos_message_inbox', array(
                    'threads' => $threads,
                    'forms' => $forms,
                    'unReadMessages'=>$unReadMessages

                )));
            }
            $form->get('recipient')->setData($user);

            return $this->container->get('templating')->renderResponse('FOSMessageBundle:Message:inbox.html.twig', array(
                'form' => $form->createView(),
                'data' => $form->getData(),
                'recipient'=>$recipient,
                'threads' => $threads,
                'forms' => $forms,
                'unReadMessages'=>$unReadMessages

            ));
        }
        if ($message = $this->formHandler->process($form)) {

            return new RedirectResponse($this->container->get('router')->generate('fos_message_inbox', array(
                'threadId' => $message->getThread()->getId(),
                'threads' => $threads,
                'forms' => $forms,
                'unReadMessages'=>$unReadMessages
            )));
        }
        return new RedirectResponse($this->container->get('router')->generate('fos_message_inbox', array(
            'threads' => $threads,
            'forms' => $forms,
            'unReadMessages'=>$unReadMessages
        )));
    }

    public function newThreadAction()
    {

        $threads = $this->getFormsTreads()['threads'];
        $forms =  $this->getFormsTreads()['forms'];
        $unReadMessages =  $this->getFormsTreads()['unReadMessages'];

        $form = $this->container->get('fos_message.new_thread_form.factory')->create();
        $formHandler = $this->container->get('fos_message.new_thread_form.handler');

        if ($message = $formHandler->process($form)) {
            return new RedirectResponse($this->container->get('router')->generate('fos_message_inbox', array(
                'threadId' => $message->getThread()->getId(),
                'forms' => $forms,
                'threads' => $threads,
                'unReadMessages'=>$unReadMessages
            )));
        }

        return $this->render('@FOSMessage/Message/inbox.html.twig', array(
            'form' => $form->createView(),
            'data' => $form->getData(),
            'forms' => $forms,
            'threads' => $threads,
            'unReadMessages'=>$unReadMessages
        ));
    }

    /**
     * select Unseen Messages To Seen.
     * @Route("/statu", name="unseen_to_seen", methods={"POST"})
     * @return Response
     *
     */
    public function selectUnseenMessagesToSeen(\Symfony\Component\HttpFoundation\Request $request){
        $threadId = $request->request->get('thread');
        $status = false;
        $unSeenMessages = $this->messageRepository->findUnreadMessageByUser($this->getUser(),$threadId);
        if(!empty($unSeenMessages)){
            $status = true;
        }
        $thread = $this->getProvider()->getThread($threadId);
        $recipient = $thread->getOtherParticipants($this->getUser())[0];

        $em = $this->getDoctrine()->getManager();
        $messagesIds = [];
        foreach ($unSeenMessages as $message){
            $message->setIsReadByParticipant($this->getUser(),true);
            $messagesIds[]=$message->getId();
            $em->persist($message);
        }
        $em->flush();
        return new JsonResponse([$threadId,$messagesIds,$recipient->getId(),$status]);

    }

    public function getFormsTreads()
    {
        $threads = $this->getProvider()->getInboxThreads();
        $sentThreads = $this->getProvider()->getSentThreads();
        if(!empty($sentThreads)){
            foreach ($sentThreads as $sentThread){
                if(!in_array($sentThread, $threads)){
                    array_unshift($threads,$sentThread);
                }
            }
        }
        //sort all threads by date last message
        $sortByMetadata = array();
        foreach ($threads as $thread){
            $threadSender = $thread->getMetadata()->toArray()[0]->getLastMessageDate();
            $threadRecipient = $thread->getMetadata()->toArray()[1]->getLastMessageDate();
            if($threadSender >= $threadRecipient){
                $sortByMetadata[$thread->getId()]['thread']= $thread;
                $sortByMetadata[$thread->getId()]['datatime']= $threadSender;
            }
            else{
                $sortByMetadata[$thread->getId()]['thread']= $thread;
                $sortByMetadata[$thread->getId()]['datatime']= $threadRecipient;
            }
        }

         usort($sortByMetadata, function ($element1, $element2) {
             return $element1['datatime']< $element2['datatime'];
         });

        $sortThread=[];
        foreach ($sortByMetadata as $items){
                $sortThread []= $items['thread'];
        }
        //end sort

        $forms = [];
        $unReadMessages =[];
        foreach ($threads as $thread){
            $form = $this->container->get('fos_message.reply_form.factory')->create($thread);
            $forms [$thread->getId()]= $form->createView();
            /*$participant = $thread->getOtherParticipants($this->getUser())[0];*/
            /*$messages = $this->get('fos_message.message_manager')->getNbUnreadMessageByParticipant($this->getUser());*/
            $messages = $this->messageRepository->countUnreadMessageByUser($this->getUser()->getId(),$thread->getId());
            $unReadMessages[$thread->getId()]=$messages;
        }
        return ['threads'=>$sortThread,'forms'=>$forms, 'unReadMessages'=>$unReadMessages];
    }
}