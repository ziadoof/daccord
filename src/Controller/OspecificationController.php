<?php

namespace App\Controller;

use App\Entity\Ospecification;
use App\Form\OspecificationType;
use App\Repository\OspecificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ospecification")
 */
class OspecificationController extends AbstractController
{
    /**
     * @Route("/", name="ospecification_index", methods={"GET"})
     */
    public function index(OspecificationRepository $ospecificationRepository): Response
    {
        return $this->render('ospecification/index.html.twig', [
            'ospecifications' => $ospecificationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ospecification_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ospecification = new Ospecification();
        $form = $this->createForm(OspecificationType::class, $ospecification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ospecification);
            $entityManager->flush();

            return $this->redirectToRoute('ospecification_index');
        }

        return $this->render('ospecification/new.html.twig', [
            'ospecification' => $ospecification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ospecification_show", methods={"GET"})
     */
    public function show(Ospecification $ospecification): Response
    {
        return $this->render('ospecification/show.html.twig', [
            'ospecification' => $ospecification,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ospecification_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ospecification $ospecification): Response
    {
        $form = $this->createForm(OspecificationType::class, $ospecification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ospecification_index', [
                'id' => $ospecification->getId(),
            ]);
        }

        return $this->render('ospecification/edit.html.twig', [
            'ospecification' => $ospecification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ospecification_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ospecification $ospecification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ospecification->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ospecification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ospecification_index');
    }
}
