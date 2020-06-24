<?php

namespace App\Controller;

use App\Entity\Ads\Ad;
use App\Entity\Favorite;
use App\Entity\User;
use App\Repository\Ads\AdRepository;
use App\Repository\Carpool\VoyageRepository;
use App\Repository\Deal\DealRepository;
use App\Repository\FavoriteRepository;
use App\Repository\Hosting\HostingRepository;
use App\Repository\Meetup\MeetupRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/favorite")
 */
class FavoriteController extends AbstractController
{
    private $userRepo;
    private $adRepo;
    private $dealRepo;
    private $hostingRepo;
    private $meetupRepo;
    private $voyageRepo;
    private $favoriteRepo;


    public function __construct(UserRepository $userRepository,
                                AdRepository $adRepository,
                                DealRepository $dealRepository,
                                HostingRepository $hostingRepository,
                                MeetupRepository $meetupRepository,
                                VoyageRepository $voyageRepository,
                                FavoriteRepository $favoriteRepository)
    {
        $this->userRepo = $userRepository;
        $this->adRepo = $adRepository;
        $this->dealRepo = $dealRepository;
        $this->hostingRepo = $hostingRepository;
        $this->meetupRepo = $meetupRepository;
        $this->voyageRepo = $voyageRepository;
        $this->favoriteRepo = $favoriteRepository;
    }

    /**
     * @Route("/", name="favorite_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $favorites = $this->getUser()->getFavorites()->toArray();
        $fav = $paginator->paginate(
        // Doctrine Query, not results
            $favorites,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            18
        );
        return $this->render('favorite/index.html.twig', [
            'favorites' => $fav,
        ]);
    }

    /**
     * @Route("/add/", name="favorite_add", methods={"POST"}, options={"expose"=true})
     * @param Request $request
     * @return Response
     * @throws NonUniqueResultException
     */
    public function add(Request $request): Response
    {
        $user = $this->getUser();
        $type = $request->request->get('type');
        $favorite = new Favorite();
        $favorite->setType($type);
        $favorite->setUser($user);

        $object = $request->request->get('object');


        switch ($type){
            case 'ad':
                $ad = $this->adRepo->findOneById($object);
                $favorite->setAd($ad);
                break;
            case 'deal':
                $deal = $this->dealRepo->findOneById($object);
                $favorite->setDeal($deal);
                break;
            case 'hosting':
                $hosting = $this->hostingRepo->findOneById($object);
                $favorite->setHosting($hosting);
                break;
            case 'meetup':
                $meetup = $this->meetupRepo->findOneById($object);
                $favorite->setMeetup($meetup);
                break;
            case 'voyage':
                $voyage = $this->voyageRepo->findOneById($object);
                $favorite->setVoyage($voyage);
                break;
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($favorite);
        $entityManager->flush();

        return new  JsonResponse(['add']);

    }

    /**
     * @Route("/remove", name="favorite_remove", methods={"POST"}, options={"expose"=true})
     * @param Request $request
     * @return Response
     */
    public function remove(Request $request): Response
    {
        $userId = $this->getUser()->getId() ;
        $type = $request->request->get('type');
        $object = $request->request->get('object');
        $entityManager = $this->getDoctrine()->getManager();


        switch ($type){
            case 'ad':
                $favorite = $this->favoriteRepo->findAdByUser($userId,$object);
                break;
            case 'deal':
                $favorite = $this->favoriteRepo->findDealByUser($userId,$object);
                break;
            case 'hosting':
                $favorite = $this->favoriteRepo->findHostingByUser($userId,$object);
                break;
            case 'meetup':
                $favorite = $this->favoriteRepo->findMeetupByUser($userId,$object);
                break;
            case 'voyage':
                $favorite = $this->favoriteRepo->findVoyageByUser($userId,$object);
                break;
        }
            $entityManager->remove($favorite);
            $entityManager->flush();

        return new  JsonResponse(['remove']);
    }






    /**
     * @Route("/{id}", name="favorite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Favorite $favorite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favorite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($favorite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('favorite_index');
    }
}
