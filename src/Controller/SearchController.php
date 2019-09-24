<?php
namespace App\Controller;


use App\Controller\Location\RegionController;
use App\Entity\Ads\Ad;
use App\Entity\Ads\Category;
use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Entity\Location\Region;
use App\Entity\User;
use App\Service\Search\FormOfferType;
use App\Service\Search\FormDemandType;
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
                        $serializedResult [] = $ad->serialize();
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
                        $serializedResult [] = $ad->serialize();
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
     * @Route("/ajax_request", name="ajax_request", methods="POST", options={"expose"=true})
     */
    public function search(Request $request) {
        $lat = $request->request->get('lat');
        $lng =  $request->request->get('lng');
        $params = [$lat,$lng];
        return new JsonResponse($params);
    }

}