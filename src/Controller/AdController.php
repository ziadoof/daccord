<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\User;
use App\Form\AdType;
use App\Repository\AdRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;



/**
 * @Route("/ad")
 */
class AdController extends AbstractController
{

    /**
     * @Route("/", name="ad_index", methods={"GET"})
     */
    public function index(AdRepository $adRepository): Response
    {
        return $this->render('ad/index.html.twig', ['ads' => $adRepository->findAll()]);
    }

    /**
     * @Route("/new/{type}", name="ad_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader, string $type): Response
    {
        $ad = new Ad();
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);




        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $category = $form->get('cato')->getData();

            $file1 = $form->get('imageOne')->getData();
            $file2 = $form->get('imageTow')->getData();
            $file3 = $form->get('imageThree')->getData();

            $file1 ?$ad->setImageOne($fileUploader->upload($file1)):$ad->setImageOne(null);
            $file2 ?$ad->setImageTow($fileUploader->upload($file2)):$ad->setImageTow(null);
            $file3 ?$ad->setImageThree($fileUploader->upload($file3)):$ad->setImageThree(null);


            $ad->setUser($this->getUser());
            $ad->setTypeOfAd($type);
            $ad->setCategory($category);


            $entityManager->persist($ad);
            $entityManager->flush();

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('ad/new.html.twig', [
            'ad' => $ad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ad_show", methods={"GET"})
     */
    public function show(Ad $ad): Response
    {
        return $this->render('ad/show.html.twig', ['ad' => $ad]);
    }

    /**
     * @Route("/{id}/edit", name="ad_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ad $ad): Response
    {
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ad_index', ['id' => $ad->getId()]);
        }

        return $this->render('ad/edit.html.twig', [
            'ad' => $ad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ad_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ad $ad): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ad->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ad);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ad_index');
    }
}
