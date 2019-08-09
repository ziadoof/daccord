<?php
namespace App\Controller;


use App\Service\FormOfferType;
use App\Service\FormDemandType;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;





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

        if ($offerForm->isSubmitted() && $offerForm->isValid()) {
            $offerSearch = $offerForm->getData();
            $result = $this->manager->getRepository('App:Ad')->searchOffer($offerSearch);

            return $this->render('ad/results/offer.html.twig', [
                'ads' => $result
            ]);
        }

        return $this->render('ad/results/offer.html.twig', [
        ]);
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
            $result = $this->manager->getRepository('App:Ad')->searchDemand($demandSearch);
            return $this->render('ad/results/demand.html.twig', [
                'ads' => $result
            ]);
        }

        return $this->render('ad/results/demand.html.twig', [
        ]);
    }
}