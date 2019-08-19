<?php
namespace App\Controller;


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
     * @Route("/offers", name="add-offerType",methods={"POST"})
     *
     */
    public function formOffer(FormOfferType $formOfferType, Request $request)
    {
        $user = $this->getUser();
        $offerForm = $formOfferType->getForm();
        $offerForm->handleRequest($request);
// test

        if ($offerForm->isSubmitted() && $offerForm->isValid()) {
            $offerSearch = $offerForm->getData();
            $result = $this->manager->getRepository('App\Entity\Ads\Ad')->searchOffer($offerSearch,$user);
            $message = "saccses";
        }else{
            $message = "invalid form data";
        }

        $response = array(
            'result' => $result,
            'message' => $message
        );

        return new JsonResponse($response);


//test

        /*if ($offerForm->isSubmitted() && $offerForm->isValid()) {
            $offerSearch = $offerForm->getData();
            $result = $this->manager->getRepository('App\Entity\Ads\Ad')->searchOffer($offerSearch,$user);
            return $this->render('Ads/ad/results/offer.html.twig', [
                'ads' => $result,
            ]);
        }*/

       /* return $this->render('Ads/ad/results/offer.html.twig', [
        ]);*/
    }


    /**
     * @Route("/demands", name="add-DemandType",methods={"POST"})
     *
     */
    public function formDemand(FormDemandType $formDemandType, Request $request)
    {
        $user = $this->getUser();
        $demandForm = $formDemandType->getForm();
        $demandForm->handleRequest($request);

        if ($demandForm->isSubmitted() && $demandForm->isValid()) {
            $demandSearch = $demandForm->getData();
            $result = $this->manager->getRepository('App\Entity\Ads\Ad')->searchDemand($demandSearch, $user);
            return $this->render('Ads/ad/results/demand.html.twig', [
                'ads' => $result
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