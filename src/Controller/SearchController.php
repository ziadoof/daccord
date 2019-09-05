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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;









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
     * @Route("/offers", name="add-offerType",methods={"POST"}, options={"expose"=true})
     *
     */
    public function formOffer(FormOfferType $formOfferType, Request $request)
    {
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
                        'message' => 'succese',
                    );

                    return new JsonResponse($response);
                }
                    return $this->render('Ads/ad/results/offer.html.twig');
            }
            return $this->render('Ads/ad/results/offer.html.twig');
        }
        return $this->render('Ads/ad/results/offer.html.twig', [
        ]);
    }


    /**
     * @Route("/demands", name="add-DemandType",methods={"POST"}, options={"expose"=true})
     *
     */
    public function formDemand(FormDemandType $formDemandType, Request $request)
    {
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
                        'message' => 'succese',
                    );

                    return new JsonResponse($response);
                }
                return $this->render('Ads/ad/results/demand.html.twig');
            }
            return $this->render('Ads/ad/results/demand.html.twig');
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