<?php

namespace App\Controller\Deal;

use App\Entity\Deal\DoneDeal;
use App\Form\Deal\DoneDealType;
use App\Repository\Deal\DoneDealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/deal/done/deal")
 */
class DoneDealController extends AbstractController
{
    /**
     * @Route("/", name="deal_done_deal_index", methods={"GET"})
     */
    public function index(DoneDealRepository $doneDealRepository): Response
    {
        return $this->render('deal/done_deal/index.html.twig', [
            'done_deals' => $doneDealRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="deal_done_deal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $doneDeal = new DoneDeal();
        $form = $this->createForm(DoneDealType::class, $doneDeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($doneDeal);
            $entityManager->flush();

            return $this->redirectToRoute('deal_done_deal_index');
        }

        return $this->render('deal/done_deal/new.html.twig', [
            'done_deal' => $doneDeal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="deal_done_deal_show", methods={"GET"})
     */
    public function show(DoneDeal $doneDeal): Response
    {
        return $this->render('deal/done_deal/show.html.twig', [
            'done_deal' => $doneDeal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="deal_done_deal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DoneDeal $doneDeal): Response
    {
        $form = $this->createForm(DoneDealType::class, $doneDeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('deal_done_deal_index');
        }

        return $this->render('deal/done_deal/edit.html.twig', [
            'done_deal' => $doneDeal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="deal_done_deal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DoneDeal $doneDeal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doneDeal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($doneDeal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('deal_done_deal_index');
    }
}
