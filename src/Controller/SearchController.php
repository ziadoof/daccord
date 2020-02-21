<?php
namespace App\Controller;


use App\Controller\Location\RegionController;
use App\Entity\Ads\Ad;
use App\Entity\Ads\Category;
use App\Entity\Carpool\Voyage;
use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Entity\Location\Region;
use App\Entity\User;
use App\Repository\Rating\RatingRepository;
use App\Service\Search\FormHostingSearchType;
use App\Service\Search\FormMeetupSearchType;
use App\Service\Search\FormOfferType;
use App\Service\Search\FormDemandType;
use App\Service\Search\FormVoyageSearchType;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/search")
 */
class SearchController extends AbstractController
{
    private $manager;

    public function __construct(RepositoryManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/offers/{id}", name="add-offerType",methods={"POST","GET"}, options={"expose"=true})
     * @param FormOfferType $formOfferType
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param String $id
     * @return JsonResponse|Response
     * @throws \Exception
     */
    public function formOffer(FormOfferType $formOfferType, Request $request, PaginatorInterface $paginator,String $id=null)
    {

        $random = random_int(9999,99999);

        $session = new Session();
        $user = $this->getUser();
        $offerForm = $formOfferType->getForm();
        $offerForm->handleRequest($request);
        $serializedResult = [];

        if ($offerForm->isSubmitted() && $offerForm->isValid()) {
            $offerSearch = $offerForm->getData();
            $generalCategory = $offerSearch->getGeneralCategory();
            $region = $offerSearch->getRegion();
            $nearme = $offerSearch->getNearme();
            $myArea = $offerSearch->getMyArea();
            if($generalCategory !== null){
                if($region !==  null || $nearme  || $myArea ){
                    $result = $this->manager->getRepository('App\Entity\Ads\Ad')->searchOffer($offerSearch, $user);

                    foreach ($result as $ad) {
                        $isFavorite = 'false';
                        if($user){
                            foreach ($user->getFavoritesByType('ad') as $favorite){
                                if($ad === $favorite->getAd()){
                                    $isFavorite = 'true';
                                }
                            }
                        }
                        $favorite = $user?$isFavorite:'unknown';
                        $serializedAd = $ad->serialize();
                        $serializedAd['favorite']=$favorite;
                        $serializedResult [] = $serializedAd;
                    }
                    $response = array(
                        'result' => $serializedResult,
                        'random' => $random,
                        'message' => 'succese',
                    );
                    $session->set($random, $result);

                    return new JsonResponse($response);
                }
                    return $this->render('Ads/ad/results/offer.html.twig');
            }
            return $this->render('Ads/ad/results/offer.html.twig');
        }
        $result =$session->get($id);

        if(isset($result)){
            $results = $paginator->paginate(
            // Doctrine Query, not results
                $result,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                20
            );
            return $this->render('Ads/ad/results/offer.html.twig', [
                'ads' => $results
            ]);
        }
        return $this->render('Ads/ad/results/offer.html.twig', [

        ]);


    }


    /**
     * @Route("/demands/{id}", name="add-DemandType",methods={"POST","GET"}, options={"expose"=true})
     * @param FormDemandType $formDemandType
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param String $id
     * @return JsonResponse|Response
     * @throws \Exception
     */
    public function formDemand(FormDemandType $formDemandType, Request $request, PaginatorInterface $paginator, String $id=null)
    {
        $random = random_int(9999,99999);
        $session = new Session();
        $user = $this->getUser();
        $demandForm = $formDemandType->getForm();
        $demandForm->handleRequest($request);
        $serializedResult = [];

        if ($demandForm->isSubmitted() && $demandForm->isValid()) {
            $demandSearch = $demandForm->getData();
            $generalCategory = $demandSearch->getGeneralCategory();
            $region = $demandSearch->getRegion();
            $nearme = $demandSearch->getNearme();
            $myArea = $demandSearch->getMyArea();
            if($generalCategory !== null){
                if($region !==  null || $nearme  || $myArea ){
                    $result = $this->manager->getRepository('App\Entity\Ads\Ad')->searchDemand($demandSearch, $user);

                    foreach ($result as $ad) {
                        $isFavorite = 'false';
                        if($user){
                            foreach ($user->getFavoritesByType('ad') as $favorite){
                                if($ad === $favorite->getAd()){
                                    $isFavorite = 'true';
                                }
                            }
                        }
                        $favorite = $user?$isFavorite:'unknown';
                        $serializedAd = $ad->serialize();
                        $serializedAd['favorite']=$favorite;
                        $serializedResult [] = $serializedAd;
                    }
                    $response = array(
                        'result' => $serializedResult,
                        'random' => $random,
                        'message' => 'succese',
                    );
                    $session->set($random, $result);

                    return new JsonResponse($response);
                }
                return $this->render('Ads/ad/results/demand.html.twig');
            }
            return $this->render('Ads/ad/results/demand.html.twig');
        }
        $result =$session->get($id);
        if(isset($result)){
            $results = $paginator->paginate(
            // Doctrine Query, not results
                $result,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                20
            );
            return $this->render('Ads/ad/results/demand.html.twig', [
                'ads' => $results
            ]);
        }
        return $this->render('Ads/ad/results/demand.html.twig', [

        ]);
    }

    /**
     * @Route("/hosting/{id}", name="add-hostingType",methods={"POST","GET"}, options={"expose"=true})
     * @param FormHostingSearchType $formHostingSearchType
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param String $id
     * @return JsonResponse|Response
     * @throws \Exception
     */
    public function formHosting(FormHostingSearchType $formHostingSearchType, Request $request, PaginatorInterface $paginator, String $id=null)
    {
        $random = random_int(9999,99999);
        $session = new Session();
        $hostingForm = $formHostingSearchType->getForm();
        $hostingForm->handleRequest($request);
        $serializedResult = [];
        $user = $this->getUser();

        if ($hostingForm->isSubmitted() && $hostingForm->isValid()) {
            $hostingSearch = $hostingForm->getData();
            $region = $hostingSearch->getRegion();
            if($hostingSearch->getNumberOfPersons() !== null) {
                if ($region !== null) {

                    $result = $this->manager->getRepository('App\Entity\Hosting\Hosting')->searchHosting($hostingSearch);

                    foreach ($result as $hosting) {
                        $isFavorite = 'false';
                        if($user){
                            foreach ($user->getFavoritesByType('hosting') as $favorite){
                                if($hosting === $favorite->getHosting()){
                                    $isFavorite = 'true';
                                }
                            }
                        }
                        $favorite = $user?$isFavorite:'unknown';
                        $serializedHosting = $hosting->serialize();
                        $serializedHosting['favorite']=$favorite;
                        $serializedResult [] = $serializedHosting;

                    }
                    $response = array(
                        'result' => $serializedResult,
                        'random' => $random,
                        'message' => 'succese',
                    );
                    //Unlike the demands and offers, they were saved rerializedResult in  session instead of result to get the name on the show page
                    $session->set($random, $serializedResult);

                    return new JsonResponse($response);
                }
                return $this->render('search/results/hosting.html.twig');
            }
            return $this->render('search/results/hosting.html.twig');

        }

        $result =$session->get($id);
        if(isset($result)){
            $results = $paginator->paginate(
            // Doctrine Query, not results
                $result,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                20
            );
            return $this->render('search/results/hosting.html.twig', [
                'hostings' => $results
            ]);
        }
        return $this->render('search/results/hosting.html.twig', [

        ]);
    }

    /**
     * @Route("/meetup/{id}", name="add-meetupType",methods={"POST","GET"}, options={"expose"=true})
     * @param FormMeetupSearchType $formMeetupSearchType
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param String $id
     * @return JsonResponse|Response
     * @throws \Exception
     */
    public function formMeetup(FormMeetupSearchType $formMeetupSearchType, Request $request, PaginatorInterface $paginator, String $id=null)
    {
        $random = random_int(9999,99999);
        $session = new Session();
        $meetupForm = $formMeetupSearchType->getForm();
        $meetupForm->handleRequest($request);
        $serializedResult = [];
        $user=$this->getUser();

        if ($meetupForm->isSubmitted() && $meetupForm->isValid()) {
            $meetupSearch = $meetupForm->getData();
            $region = $meetupSearch->getRegion();
            if($meetupSearch->getType() !== null) {
                if ($region !== null) {

                    $result = $this->manager->getRepository('App\Entity\Meetup\Meetup')->searchMeetup($meetupSearch);


                    foreach ($result as $meetup) {
                        $isFavorite = 'false';
                        if($user){
                            foreach ($user->getFavoritesByType('meetup') as $favorite){
                                if($meetup === $favorite->getMeetup()){
                                    $isFavorite = 'true';
                                }
                            }
                        }
                        $favorite = $user?$isFavorite:'unknown';
                        $serializedMeetup = $meetup->serialize();
                        $serializedMeetup['favorite']=$favorite;
                        $serializedResult [] = $serializedMeetup;

                    }
                    usort($serializedResult, function($a1, $a2) {
                        $v1 = strtotime($a2['start']);
                        $v2 = strtotime($a1['start']);
                        return $v1 - $v2; // $v2 - $v1 to reverse direction
                    });
                    $response = array(
                        'result' => $serializedResult,
                        'random' => $random,
                        'message' => 'succese',
                    );
                    //Unlike the demands and offers, they were saved serializedResult in  session instead of result to get the name on the show page
                    $session->set($random, $serializedResult);

                    return new JsonResponse($response);
                }
                return $this->render('search/results/meetup.html.twig');
            }
            return $this->render('search/results/meetup.html.twig');

        }

        $result =$session->get($id);
        if(isset($result)){
            $results = $paginator->paginate(
            // Doctrine Query, not results
                $result,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                20
            );
            return $this->render('search/results/meetup.html.twig', [
                'meetups' => $results
            ]);
        }
        return $this->render('search/results/meetup.html.twig', [

        ]);
    }

    /**
     * @Route("/carpooling/{id}", name="add-voyageType",methods={"POST","GET"}, options={"expose"=true})
     * @param FormVoyageSearchType $formVoyageSearchType
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param RatingRepository $ratingRepository
     * @param String $id
     * @return JsonResponse|Response
     * @throws \Exception
     */
    public function formCarpooling(FormVoyageSearchType $formVoyageSearchType, Request $request, PaginatorInterface $paginator,RatingRepository $ratingRepository, String $id=null)
    {
        $random = random_int(9999,99999);
        $session = new Session();
        $voyageForm = $formVoyageSearchType->getForm();
        $voyageForm->handleRequest($request);
        $serializedResult = [];
        $user = $this->getUser();

        if ($voyageForm->isSubmitted() && $voyageForm->isValid()) {
            $voyageSearch = $voyageForm->getData();
            if($voyageSearch->getMainDeparture() !== null) {

                    $result = $this->manager->getRepository('App\Entity\Carpool\Voyage')->searchCarpooling($voyageSearch);

                    foreach ($result as $voyage) {
                        $isFavorite = 'false';
                        if($user){
                            foreach ($user->getFavoritesByType('voyage') as $favorite){
                                if($voyage === $favorite->getVoyage()){
                                    $isFavorite = 'true';
                                }
                            }
                        }
                        $favorite = $user?$isFavorite:'unknown';
                        $serializedVoyage =  $voyage->searchSerialize();
                        $serializedVoyage['favorite']=$favorite;
                        $serializedVoyage['creatorRating']=$this->getCarpoolRating($voyage,$ratingRepository);;
                        $serializedResult [] = $serializedVoyage;

                    }
                    $response = array(
                        'result' => $serializedResult,
                        'random' => $random,
                        'message' => 'succese',
                    );
                //Unlike the demands and offers, they were saved serializedResult in  session instead of result to get the name on the show page
                    $session->set($random, $serializedResult);

                    return new JsonResponse($response);

            }
            return $this->render('search/results/voyage.html.twig');

        }

        $result =$session->get($id);
        if(isset($result)){
            $results = $paginator->paginate(
            // Doctrine Query, not results
                $result,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                20
            );
            return $this->render('search/results/voyage.html.twig', [
                'voyages' => $results
            ]);
        }
        return $this->render('search/results/voyage.html.twig', [

        ]);
    }

    /**
     * @Route("/ajax_request", name="ajax_request", methods="POST", options={"expose"=true})
     */
    public function search(Request $request) {
        $lat = $request->request->get('lat');
        $lng =  $request->request->get('lng');
        $params = [$lat,$lng];
        return new JsonResponse($params);
    }

    public function getCarpoolRating(Voyage $voyage, RatingRepository $ratingRepository){
        $rating = $ratingRepository->findByTypeAndCandidate('carpool', $voyage->getCreator()->getUser()->getId());
        $number = $rating->getTotal()/$rating->getNumVotes();
        return number_format($number, 1);
    }

}