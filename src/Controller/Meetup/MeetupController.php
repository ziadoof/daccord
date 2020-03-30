<?php

namespace App\Controller\Meetup;

use App\Entity\Meetup\Comment;
use App\Entity\Meetup\JoinRequest;
use App\Entity\Meetup\Meetup;
use App\Entity\User;
use App\Form\Meetup\CommentType;
use App\Form\Meetup\MeetupType;
use App\Repository\Meetup\MeetupRepository;
use App\Repository\Rating\RatingRepository;
use App\Repository\Rating\VoteRepository;
use App\Service\FileUploader;
use App\Service\Notification;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/meetup")
 */
class MeetupController extends AbstractController
{
    /**
     * @Route("/", name="meetup_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request,PaginatorInterface $paginator): Response
    {
        $myMeetup = $this->getUser()->getMeetups();
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $myMeetup,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );
        return $this->render('meetup/meetup/index.html.twig', [
            'meetups' => $results,
        ]);
    }

    /**
     * @Route("/new", name="meetup_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $meetup = new Meetup();
        $user = $this->getUser();
        $meetup->setCreator($user);
        $form = $this->createForm(MeetupType::class, $meetup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileUploader = new FileUploader('assets/images/meetup/');
            $image = $form->get('image')->getData();
            $image ?$meetup->setImage($fileUploader->upload($image)):$meetup->setImage(null);
            $meetup->setDepartment($meetup->getCity()->getDepartment());
            $meetup->setRegion($meetup->getCity()->getDepartment()->getRegion());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($meetup);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your new meetup was successfully added!'
            );
            return $this->redirectToRoute('meetup_show',['id'=>$meetup->getId()]);
        }

        return $this->render('meetup/meetup/new.html.twig', [
            'meetup' => $meetup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="meetup_show", methods={"GET","POST"}, options={"expose"=true})
     * @param Request $request
     * @param Meetup $meetup
     * @param RatingRepository $ratingRepository
     * @param VoteRepository $voteRepository
     * @param Notification $notification
     * @param PaginatorInterface $paginator
     * @return Response
     * @throws \Exception
     */
    public function show(Request $request, Meetup $meetup, RatingRepository $ratingRepository, VoteRepository $voteRepository, Notification $notification, PaginatorInterface $paginator): Response
    {
        $comment = new Comment();
        $comment->setMeetup($meetup);
        $comment->setSender($this->getUser());
        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);
        $rating = $ratingRepository->findByTypeAndMeetup('meetup',$meetup->getId());
        $votesMeetup = [];
        if($this->getUser()) {
            $voteMeetupByThisUser = $voteRepository->findByVoterMeetup($this->getUser()->getId());
            foreach ($voteMeetupByThisUser as $vote) {
                $votesMeetup[$vote->getMeetup()->getId()] = $vote->getValue();
            }
        }


        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your comment was successfully added!'
            );
            $comments = $meetup->getComments();
            $commentators =[];
            foreach ($comments as $comment){
                if(!in_array($comment->getSender(),$commentators) && $this->getUser() !== $comment->getSender()){
                    $commentators[]=$comment->getSender();
                }
            }
            if(!empty($commentators)){
                $notification->addNotification(['type' => 'meetupComment', 'object' => $meetup,'recipients'=>$commentators,'sender'=>$this->getUser()]);
            }

            return $this->redirectToRoute('meetup_show',['id'=>$meetup->getId()]);
        }


        $results = $paginator->paginate(
        // Doctrine Query, not results
            $meetup->getComments(),
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );


        return $this->render('meetup/meetup/show.html.twig', [
            'meetup' => $meetup,
            'rating' => $rating,
            'votesMeetup' => $votesMeetup,
            'comment' => $comment,
            'comments' => $results,
            'commentForm' => $commentForm->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="meetup_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Meetup $meetup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$meetup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($meetup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('meetup_index');
    }

    /**
     * @Route( "/{meetup}/join",name="meetup_join_request", methods={"GET","POST"})
     * @param Meetup $meetup
     * @param Notification $notification
     * @return RedirectResponse|null
     */
    public function joinRequest (Meetup $meetup, Notification $notification): ?RedirectResponse
    {

        $joinRequest = new JoinRequest();
        $joinRequest->setMeetup($meetup);
        $joinRequest->setUser($this->getUser());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($joinRequest);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'Your join request has bin sent successfully!'
        );
        $notification->addNotification(['type' => 'meetupRequest', 'object' => $joinRequest]);
        return $this->redirectToRoute('meetup_show',['id'=>$meetup->getId()]);

    }

    /**
     * @Route( "/{joinRequest}/{status}",name="join_treatment", methods={"GET","POST"})
     * @param JoinRequest $joinRequest
     * @param string $status
     * @param Notification $notification
     * @return RedirectResponse
     */
    public function joinTreatment (JoinRequest $joinRequest, string $status, Notification $notification): ?RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $meetup = $joinRequest->getMeetup();

        if($status ==='Rejected'){
            $joinRequest->setTreatment('Rejected');
            $entityManager->persist($joinRequest);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'This request was successfully rejected!'
            );
            $notification->addNotification(['type' => 'treatmentMeetupRequest', 'object' => $joinRequest, 'treatment' => $status]);

            return $this->redirectToRoute('meetup_show',['id'=>$joinRequest->getMeetup()->getId()]);
        }
        $maxP = $meetup->getMaxParticipants();
        $nParticipants = count($meetup->getParticipants());
        $nWaitlists = count($meetup->getWaitlists());

        if($nParticipants<$maxP){
            $meetup->addParticipant($joinRequest->getUser());
        }
        else{
            if($nWaitlists < 4){
                $meetup->addWaitlist($joinRequest->getUser());
            }
        }
        $entityManager->persist($meetup);
        $entityManager->remove($joinRequest);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'This request was successfully rejected!'
        );
        $notification->addNotification(['type' => 'treatmentMeetupRequest', 'object' => $joinRequest, 'treatment' => $status]);

        return $this->redirectToRoute('meetup_show',['id'=>$joinRequest->getMeetup()->getId()]);

    }

    /**
     * @Route( "/{meetup}/{user}/cancel",name="cancel_joining", methods={"GET","POST"})
     * @param Meetup $meetup
     * @param User $user
     * @param Notification $notification
     * @return RedirectResponse
     */
    public function cancelJoining (Meetup $meetup , User $user, Notification $notification): ?RedirectResponse
    {
        $recipient = $this->getUser() === $user?$meetup->getCreator():$user;
        $sender = $this->getUser() === $user?$user:$meetup->getCreator();

        $status = $recipient===$user?'removed':'retreat';

        $entityManager = $this->getDoctrine()->getManager();
        $meetup->removeParticipant($user);

        $entityManager->persist($meetup);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'The user was successfully removed!'
        );
        $notification->addNotification(['type' => 'cancelJoinParticipant', 'object' => $meetup, 'recipient' => $recipient,'sender'=>$sender,'status'=>$status]);

        return $this->redirectToRoute('meetup_show',['id'=>$meetup->getId()]);

    }

    /**
     * @Route( "/{meetup}/{user}/cancelwaiting",name="cancel_joining_waiting", methods={"GET","POST"})
     * @param Meetup $meetup
     * @param User $user
     * @param Notification $notification
     * @return RedirectResponse
     */
    public function cancelJoiningWaiting (Meetup $meetup , User $user, Notification $notification): ?RedirectResponse
    {
        $recipient = $this->getUser() === $user?$meetup->getCreator():$user;
        $sender = $this->getUser() === $user?$user:$meetup->getCreator();

        $status = $recipient===$user?'removed':'retreat';

        $entityManager = $this->getDoctrine()->getManager();
        $meetup->removeWaitlist($user);
        $entityManager->persist($meetup);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'The user was successfully removed!'
        );
        $notification->addNotification(['type' => 'cancelJoinWaiting', 'object' => $meetup, 'recipient' => $recipient,'sender'=>$sender,'status'=>$status]);

        return $this->redirectToRoute('meetup_show',['id'=>$meetup->getId()]);

    }

    /**
     * @Route( "/{meetup}/{user}/addwaiting",name="add_joining_waiting", methods={"GET","POST"})
     * @param Meetup $meetup
     * @param User $user
     * @return RedirectResponse
     */
    public function addJoiningWaiting (Meetup $meetup , User $user, Notification $notification): ?RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $meetup->addParticipant($user);
        $meetup->removeWaitlist($user);
        $entityManager->persist($meetup);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'The user was successfully added!'
        );
        $notification->addNotification(['type' => 'transferToParticipant', 'object' => $meetup,'recipient'=>$user]);

        return $this->redirectToRoute('meetup_show',['id'=>$meetup->getId()]);

    }

    /**
     * @Route("/meetup/joined/list", name="meetup_join", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param MeetupRepository $meetupRepository
     * @return Response
     */
    public function meetupJoin(Request $request,PaginatorInterface $paginator, MeetupRepository $meetupRepository): Response
    {
        $MettupJoin = $meetupRepository->findMeetupJoinByUser($this->getUser()->getId());
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $MettupJoin,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );
        return $this->render('meetup/meetup/meetup_join.html.twig', [
            'meetupsJoin' => $results,
        ]);
    }

    /**
     * @Route("/meetup/near/me/", name="meetup_near_me", methods={"POST"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param MeetupRepository $meetupRepository
     * @return Response
     */
    public function meetupNearMe(Request $request,PaginatorInterface $paginator, MeetupRepository $meetupRepository): Response
    {
        $session = new Session();
        if (isset($_POST['meetup_lat'], $_POST['meetup_lng']))
        {
            $lat = $_POST['meetup_lat'];
            $lng = $_POST['meetup_lng'];

            $session->set('meetup_lat', $lat);
            $session->set('meetup_lng', $lng);
        }
        $maxLat = $session->get('meetup_lat')+0.101008;//8KM
        $minLat = $session->get('meetup_lat')-0.101008;//8KM
        $maxLng = $session->get('meetup_lng')+0.101008;//8KM
        $minLng = $session->get('meetup_lng')-0.101008;//8KM

        $meetupNearMe = $meetupRepository->findMeetupNearMe($maxLat,$minLat,$maxLng,$minLng);
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $meetupNearMe,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );
        return $this->render('meetup/meetup/near_me.html.twig', [
            'meetups' => $results,
        ]);
    }



}
