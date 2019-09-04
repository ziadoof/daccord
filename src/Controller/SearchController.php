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
use Doctrine\Common\Annotations\AnnotationReader;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\SerializerManager;







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


// test

        if ($offerForm->isSubmitted() && $offerForm->isValid()) {
            $offerSearch = $offerForm->getData();
            $result = $this->manager->getRepository('App\Entity\Ads\Ad')->searchOffer($offerSearch,$user);
            $serializedResult= [];

            foreach ($result as $ad){
                $serializedResult []= $ad->serialize();
            }
        }

        $response = array(
            'result' => $serializedResult,
        );

        return new JsonResponse($response);
       /* return $this->render('Ads/ad/results/offer.html.twig', [
            'ads' => array($nan),
        ]);*/

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