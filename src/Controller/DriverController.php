<?php

namespace App\Controller;

use App\Entity\Driver;
use App\Form\DriverType;
use App\Repository\DriverRepository;
use App\Repository\Rating\RatingRepository;
use App\Repository\Rating\VoteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/driver")
 */
class DriverController extends AbstractController
{
    /**
     * @Route("/admin/drivers", name="driver_index", methods={"GET"})
     * @param Request $request
     * @param DriverRepository $driverRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, DriverRepository $driverRepository, PaginatorInterface $paginator): Response
    {
        $result= $driverRepository->findAll();
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            50
        );
        return $this->render('admin/view/users/driverUsers.html.twig', [
            'drivers' => $results,
        ]);
    }

    /**
     * @Route("/{id}", name="driver_show", methods={"GET"})
     * @param Driver $driver
     * @return Response
     */
    public function show(Driver $driver, RatingRepository $ratingRepository): Response
    {
        $rating = $ratingRepository->findByTypeAndCandidate('driver', $driver->getUser()->getId());

        return $this->render('user/Driver/show.html.twig', [
            'driver' => $driver,
            'rating' => $rating
        ]);
    }


    /**
     * @Route("/admin/{id}", name="driver_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Driver $driver): Response
    {
        if ($this->isCsrfTokenValid('delete'.$driver->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($driver);
            $entityManager->flush();
        }

        return $this->redirectToRoute('driver_index');
    }
}
