<?php

namespace App\Controller\Ads;

use App\Entity\Ads\Specification;
use App\Form\Ads\SpecificationType;
use App\Repository\Ads\SpecificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/specification")
 */
class SpecificationController extends AbstractController
{
    /**
     * @Route("/", name="specification_index", methods={"GET"})
     */
    public function index(SpecificationRepository $specificationRepository): Response
    {
        return $this->render('Ads/specification/index.html.twig', [
            'specifications' => $specificationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="specification_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $specification = new Specification();
        $form = $this->createForm(SpecificationType::class, $specification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specification);
            $entityManager->flush();

            return $this->redirectToRoute('specification_index');
        }

        return $this->render('Ads/specification/new.html.twig', [
            'specification' => $specification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specification_show", methods={"GET"})
     */
    public function show(Specification $specification): Response
    {
        return $this->render('Ads/specification/show.html.twig', [
            'specification' => $specification,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="specification_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Specification $specification): Response
    {
        $form = $this->createForm(SpecificationType::class, $specification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('specification_index', [
                'id' => $specification->getId(),
            ]);
        }

        return $this->render('Ads/specification/edit.html.twig', [
            'specification' => $specification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specification_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Specification $specification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specification->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($specification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('specification_index');
    }
}
