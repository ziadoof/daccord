<?php

namespace App\Controller\Carpool;

use App\Entity\Carpool\Station;
use App\Form\Carpool\StationType;
use App\Repository\Carpool\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/carpool/station")
 */
class StationController extends AbstractController
{
    /**
     * @Route("/", name="carpool_station_index", methods={"GET"})
     */
    public function index(StationRepository $stationRepository): Response
    {
        return $this->render('carpool/station/index.html.twig', [
            'stations' => $stationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="carpool_station_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $station = new Station();
        $form = $this->createForm(StationType::class, $station);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($station);
            $entityManager->flush();

            return $this->redirectToRoute('carpool_station_index');
        }

        return $this->render('carpool/station/new.html.twig', [
            'station' => $station,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carpool_station_show", methods={"GET"})
     */
    public function show(Station $station): Response
    {
        return $this->render('carpool/station/show.html.twig', [
            'station' => $station,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carpool_station_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Station $station): Response
    {
        $form = $this->createForm(StationType::class, $station);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carpool_station_index');
        }

        return $this->render('carpool/station/edit.html.twig', [
            'station' => $station,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carpool_station_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Station $station): Response
    {
        if ($this->isCsrfTokenValid('delete'.$station->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($station);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carpool_station_index');
    }
}
