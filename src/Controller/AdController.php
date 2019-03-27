<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Model\AdModel;
use App\Form\AdSearchType;
use App\Entity\City;
use App\Entity\User;
use App\Entity\Category;
use App\Form\OfferType;
use App\Form\DemandType;
use App\Form\AdType;
use App\Form\UserType;
use App\Repository\AdRepository;
use App\Service\FileUploader;
use FOS\ElasticaBundle\FOSElasticaBundle;
use FOS\ElasticaBundle\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use App\Entity\AdsRepository;



/**
 * @Route("/ad")
 */
class AdController extends AbstractController
{

    private $manager;
    public function __construct(RepositoryManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="ad_index", methods={"GET"})
     */
    public function index(Request $request, AdRepository $adRepository): Response
    {
        $user = $this->getUser();
        if($user !== null){
            $maxDistance = $user->getMaxDistance();
            $mapx = $user->getMapX();
            $mapy = $user->getMapY();
            $KM = 0.009999;

            $min_x = $mapx-($KM*$maxDistance);
            $max_x = $mapx+($KM*$maxDistance);
            $min_y = $mapy-($KM*$maxDistance);
            $max_y = $mapy+($KM*$maxDistance);


            $ad_area = $adRepository->findByArea($min_x,$max_x,$min_y,$max_y);

            return $this->render('ad/index.html.twig', ['ads' => $adRepository->findAll(),'ad_area'=>$ad_area]);
        }
        else{
            $adSearch = new AdModel();

            $form = $this->createForm(AdSearchType::class, $adSearch);
            $form->handleRequest($request);

            $adSearch = $form->getData();

/*            $elasticaManager = $this->get('fos_elastica.manager');*/
            $results = $this->manager->getRepository('App:Ad')->searchAd($adSearch);
            dump($results);

            return $this->render('ad/index.html.twig', [
                'ads' => $adRepository->findAll(),
                'form' => $form->createView(),
                'sAds' => $results
            ]);

        }
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
        $allSpecifications = $ad->getAllSpecifications();
        $price = $ad->getPrice();
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ad->setPPrice($price);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ad_show', ['id' => $ad->getId()]);
        }

        return $this->render('ad/edit.html.twig', [
            'specifications'=>$allSpecifications,
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
     * @Route("/my/{type}", name="my_ads", methods={"GET"})
     *
     */
    public function myads(string $type): Response
    {
        $user = $this->getUser();
        $ads=$user->getAds();
        $my_ads =[];
        foreach ($ads as $ad){
        $typeOfAd = $ad->getTypeOfAd();
          if($typeOfAd === $type){
             $my_ads []= $ad;
          }
        }
        return $this->render('ad/myAds.html.twig', [
            'my_ads' => $my_ads,
        ]);
    }
}
