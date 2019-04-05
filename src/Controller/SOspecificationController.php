<?php

namespace App\Controller;

use App\Entity\SOspecification;
use App\Form\SOspecificationType;
use App\Repository\SOspecificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/s/ospecification")
 */
class SOspecificationController extends AbstractController
{
    /**
     * @Route("/", name="s_ospecification_index", methods={"GET"})
     */
    public function index(SOspecificationRepository $sOspecificationRepository): Response
    {
        return $this->render('s_ospecification/index.html.twig', [
            's_ospecifications' => $sOspecificationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="s_ospecification_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sOspecification = new SOspecification();
        $form = $this->createForm(SOspecificationType::class, $sOspecification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sOspecification);
            $entityManager->flush();

            return $this->redirectToRoute('s_ospecification_index');
        }

        return $this->render('s_ospecification/new.html.twig', [
            's_ospecification' => $sOspecification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="s_ospecification_show", methods={"GET"})
     */
    public function show(SOspecification $sOspecification): Response
    {
        return $this->render('s_ospecification/show.html.twig', [
            's_ospecification' => $sOspecification,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="s_ospecification_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SOspecification $sOspecification): Response
    {
        $form = $this->createForm(SOspecificationType::class, $sOspecification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('s_ospecification_index', [
                'id' => $sOspecification->getId(),
            ]);
        }

        return $this->render('s_ospecification/edit.html.twig', [
            's_ospecification' => $sOspecification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="s_ospecification_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SOspecification $sOspecification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sOspecification->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sOspecification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('s_ospecification_index');
    }
}
