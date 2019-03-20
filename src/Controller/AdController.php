<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\City;
use App\Entity\User;
use App\Entity\Category;
use App\Form\OfferType;
use App\Form\DemandType;
use App\Form\AdType;
use App\Form\UserType;
use App\Repository\AdRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;



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
        if ($type === 'Offer'){

            $entityManager = $this->getDoctrine()->getManager();
            $ad = new Ad();
            $ad->setTypeOfAd($type);
            $form = $this->createForm(OfferType::class, $ad,[
                'entity_manager' => $entityManager,
            ]);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();

                $category = $form->get('category')->getData();

                $file1 = $form->get('imageOne')->getData();
                $file2 = $form->get('imageTow')->getData();
                $file3 = $form->get('imageThree')->getData();

                $file1 ?$ad->setImageOne($fileUploader->upload($file1)):$ad->setImageOne(null);
                $file2 ?$ad->setImageTow($fileUploader->upload($file2)):$ad->setImageTow(null);
                $file3 ?$ad->setImageThree($fileUploader->upload($file3)):$ad->setImageThree(null);


                $ad->setUser($this->getUser());

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
        else
        {
            $entityManager = $this->getDoctrine()->getManager();
            $ad = new Ad();
            $ad->setTypeOfAd($type);
            $form = $this->createForm(DemandType::class, $ad,[
                'entity_manager' => $entityManager,
            ]);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();

                $category = $form->get('category')->getData();


                $ad->setUser($this->getUser());
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

    }

    /**
     * @Route("/{id}", name="ad_show", methods={"GET"})
     */
    public function show(Ad $ad): Response
    {
        $allSpecifications = $ad->getAllSpecifications();
        return $this->render('ad/show.html.twig', ['ad' => $ad, 'specifications'=>$allSpecifications]);
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

    /**
     * @Route("/adSpe", name="ad_spe", methods={"GET","POST"})
     */
 /*   public function addSpe(Request $request,  $cato=null): Response
    {

            $ad = new Ad();
            $nan = 'ahmad';
            $form2 = $this->createForm(AdType::class, $ad);
            $form2->handleRequest($request);

            if ($form2->isSubmitted() && $form2->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->persist($ad);
                $entityManager->flush();

                return $this->redirectToRoute('ad_index');
            }

            return $this->render('ad/_form2.html.twig', [
                'ad' => $ad,
                'nan' => $nan,
                'cato'=> $cato,
                'form2' => $form2->createView(),
            ]);




    }*/
}
