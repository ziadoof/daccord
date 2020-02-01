<?php

namespace App\Controller\Carpool;

use App\Entity\Carpool\VoyageRequest;
use App\Form\Carpool\VoyageRequestType;
use App\Repository\Carpool\VoyageRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/carpool/voyage/request")
 */
class VoyageRequestController extends AbstractController
{
    /**
     * @Route("/", name="carpool_voyage_request_index", methods={"GET"})
     */
    public function index(VoyageRequestRepository $voyageRequestRepository): Response
    {
        return $this->render('carpool/voyage_request/index.html.twig', [
            'voyage_requests' => $voyageRequestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="carpool_voyage_request_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voyageRequest = new VoyageRequest();
        $form = $this->createForm(VoyageRequestType::class, $voyageRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voyageRequest);
            $entityManager->flush();

            return $this->redirectToRoute('carpool_voyage_request_index');
        }

        return $this->render('carpool/voyage_request/new.html.twig', [
            'voyage_request' => $voyageRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carpool_voyage_request_show", methods={"GET"})
     */
    public function show(VoyageRequest $voyageRequest): Response
    {
        return $this->render('carpool/voyage_request/show.html.twig', [
            'voyage_request' => $voyageRequest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carpool_voyage_request_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, VoyageRequest $voyageRequest): Response
    {
        $form = $this->createForm(VoyageRequestType::class, $voyageRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carpool_voyage_request_index');
        }

        return $this->render('carpool/voyage_request/edit.html.twig', [
            'voyage_request' => $voyageRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carpool_voyage_request_delete", methods={"DELETE"})
     */
    public function delete(Request $request, VoyageRequest $voyageRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyageRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyageRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carpool_voyage_request_index');
    }
}
