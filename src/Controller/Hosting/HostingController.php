<?php

namespace App\Controller\Hosting;

use App\Entity\Hosting\Hosting;
use App\Form\Hosting\HostingType;
use App\Repository\Hosting\HostingRepository;
use App\Repository\Rating\RatingRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/admin/hostings", name="hostings_index", methods={"GET"})
     * @param Request $request
     * @param HostingRepository $hostingRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, HostingRepository $hostingRepository, PaginatorInterface $paginator): Response
    {
        $result= $hostingRepository->findAll();
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            50
        );
        return $this->render('admin/view/users/hostingUsers.html.twig', [
            'hostings' => $results,
        ]);
    }

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
