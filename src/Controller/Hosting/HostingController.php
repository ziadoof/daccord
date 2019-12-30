<?php

namespace App\Controller\Hosting;

use App\Entity\Hosting\Hosting;
use App\Form\Hosting\HostingType;
use App\Repository\Hosting\HostingRepository;
use App\Repository\Rating\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hosting")
 */
class HostingController extends AbstractController
{


    /**
     * @Route("/{id}", name="hosting_show", methods={"GET","POST"}, options={"expose"=true})
     * @param Hosting $hosting
     * @return Response
     */
    public function show(Hosting $hosting, RatingRepository $ratingRepository): Response
    {
        $rating = $ratingRepository->findByTypeAndCandidate('hosting', $hosting->getUser()->getId());

        return $this->render('user/Hosting/show.html.twig', [
            'hosting' => $hosting,
            'rating' => $rating
        ]);
    }

}
