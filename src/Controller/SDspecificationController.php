<?php

namespace App\Controller;

use App\Entity\SDspecification;
use App\Form\SDspecificationType;
use App\Repository\SDspecificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/s/dspecification")
 */
class SDspecificationController extends AbstractController
{
    /**
     * @Route("/", name="s_dspecification_index", methods={"GET"})
     */
    public function index(SDspecificationRepository $sDspecificationRepository): Response
    {
        return $this->render('s_dspecification/index.html.twig', [
            's_dspecifications' => $sDspecificationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="s_dspecification_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sDspecification = new SDspecification();
        $form = $this->createForm(SDspecificationType::class, $sDspecification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sDspecification);
            $entityManager->flush();

            return $this->redirectToRoute('s_dspecification_index');
        }

        return $this->render('s_dspecification/new.html.twig', [
            's_dspecification' => $sDspecification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="s_dspecification_show", methods={"GET"})
     */
    public function show(SDspecification $sDspecification): Response
    {
        return $this->render('s_dspecification/show.html.twig', [
            's_dspecification' => $sDspecification,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="s_dspecification_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SDspecification $sDspecification): Response
    {
        $form = $this->createForm(SDspecificationType::class, $sDspecification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('s_dspecification_index', [
                'id' => $sDspecification->getId(),
            ]);
        }

        return $this->render('s_dspecification/edit.html.twig', [
            's_dspecification' => $sDspecification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="s_dspecification_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SDspecification $sDspecification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sDspecification->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sDspecification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('s_dspecification_index');
    }
}
