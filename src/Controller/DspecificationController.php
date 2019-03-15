<?php

namespace App\Controller;

use App\Entity\Dspecification;
use App\Form\DspecificationType;
use App\Repository\DspecificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dspecification")
 */
class DspecificationController extends AbstractController
{
    /**
     * @Route("/", name="dspecification_index", methods={"GET"})
     */
    public function index(DspecificationRepository $dspecificationRepository): Response
    {
        return $this->render('dspecification/index.html.twig', [
            'dspecifications' => $dspecificationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dspecification_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dspecification = new Dspecification();
        $form = $this->createForm(DspecificationType::class, $dspecification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dspecification);
            $entityManager->flush();

            return $this->redirectToRoute('dspecification_index');
        }

        return $this->render('dspecification/new.html.twig', [
            'dspecification' => $dspecification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dspecification_show", methods={"GET"})
     */
    public function show(Dspecification $dspecification): Response
    {
        return $this->render('dspecification/show.html.twig', [
            'dspecification' => $dspecification,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dspecification_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dspecification $dspecification): Response
    {
        $form = $this->createForm(DspecificationType::class, $dspecification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dspecification_index', [
                'id' => $dspecification->getId(),
            ]);
        }

        return $this->render('dspecification/edit.html.twig', [
            'dspecification' => $dspecification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dspecification_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dspecification $dspecification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dspecification->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dspecification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dspecification_index');
    }
}
