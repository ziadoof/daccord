<?php


namespace App\Controller;

use App\Entity\Rating\Rating;
use App\Entity\Rating\Vote;
use App\Entity\User;
use App\Form\VoteType;
use App\Repository\Rating\RatingRepository;
use App\Repository\Rating\VoteRepository;
use App\Repository\UserRepository;
use App\Service\Notification;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RatingController extends AbstractController
/**
 * @Route("/rating")
 */
{

    private $voteRepository;
    private $ratingRepository;
    private $userRepository;

    /**
     * FeedBack constructor.
     * @param RatingRepository $ratingRepository
     * @param VoteRepository $voteRepository
     */
    public function __construct(RatingRepository $ratingRepository, VoteRepository $voteRepository, UserRepository $userRepository)
    {
        $this->ratingRepository = $ratingRepository;
        $this->voteRepository = $voteRepository;
        $this->userRepository = $userRepository;

    }

    /**
     * @Route("/vote/{candidate}/{type}" ,name="new_vote", methods={"POST"})
     * @param Request $request
     * @param  $candidate
     * @param string $type
     * @param Notification $notification
     * @return RedirectResponse|Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function createVote(Request $request,  $candidate, string $type, Notification $notification){

        $userCandidate = $this->userRepository->findOneById($candidate);
        $BDrating = $this->ratingRepository->findByTypeAndCandidate($type,$candidate);
        $newRating = new Rating();
        $newRating->setCandidate($userCandidate);
        $newRating->setType($type);
        $rating = $BDrating?:$newRating;

        $vote = new Vote();
        $vote->setRating($rating);
        $vote->setCandidate($userCandidate);
        $vote->setType($type);


        $form = $this->createForm(VoteType::class, $vote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $rating->setTotal($rating->getTotal()+$form->get('value')->getData());
            $rating->setNumVotes($rating->getNumVotes()+1);
            $vote->setVoter($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vote);
            $entityManager->persist($rating);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your rating has been recorded successfully!'
            );

            $notification->addNotification(['type' => 'ratingDriver', 'object' => $vote]);


            if($type === 'driver'){
                return $this->redirectToRoute('deal_index');
            }

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('Rating/vote.html.twig', [
            'candidate' => $userCandidate,
            'type' => $type,
            'form' => $form->createView()
        ]);

    }
}