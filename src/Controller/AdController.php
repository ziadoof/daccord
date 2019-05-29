<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\DemandSearchType;
use App\Model\AdModel;
use App\Form\OfferSearchType;
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
        $entityManager = $this->getDoctrine()->getManager();
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
            $offerSearch = new AdModel();
            $demandSearch = new AdModel();

            $offerForm = $this->createForm(OfferSearchType::class, $offerSearch,[
                'entity_manager' => $entityManager,
            ]);
            $offerForm->handleRequest($request);
            $offerSearch = $offerForm->getData();


            $demandForm = $this->createForm(DemandSearchType::class, $demandSearch,[
                'entity_manager' => $entityManager,
            ]);
            $demandForm->handleRequest($request);
            $demandSearch = $demandForm->getData();

/*            $elasticaManager = $this->get('fos_elastica.manager');*/
            $offerResults = $this->manager->getRepository('App:Ad')->searchAd($offerSearch);
            $demandResults = $this->manager->getRepository('App:Ad')->searchAd($demandSearch);

            return $this->render('ad/index.html.twig', [
                'ads' => $adRepository->findAll(),
                'offerForm' => $offerForm->createView(),
                'demandForm' => $demandForm->createView(),
                'offerADS' => $offerResults,
                'demandADS' => $demandResults,
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
                $ad->setGeneralCategory($category->getParent());

                $ville = $this->getUser()->getCity();
                $department = $this->getUser()->getCity()->getDepartment();
                $region = $this->getUser()->getCity()->getDepartment()->getRegion();
                $ad->setVille($ville);
                $ad->setDepartment($department);
                $ad->setRegion($region);


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
        $em = $this->getDoctrine()->getManager();
        $categoryParent = $ad->getCategory()->getParent()->getName();
        $realCategory = $em->getRepository(Category::class)->findCategoryByName($ad->getCategory()->getName(),'Demand', $categoryParent);
        $allSpecifications = $ad->getAllSpecifications();
        $classEnergieAndGes=[1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G'];
        $paperSize=[1=>'4A0',2=>'2A0',3=>'A0',4=>'A1',5=>'A2',6=>'A3',7=>'A4',8=>'A5',9=>'A6',10>'A7',11=>'A8',12=>'A9',13=>'A10'];
        $experience=[0=>'Not required',1=>'1 YEAR',2=>'2 YEARS' ,3=>'3 YEARS' ,4=>'4 YEARS' ,5=>'5 YEARS' ,6=>'+ 5 YEARS'];
        $levelOfStudent=[1=>'Maternal school',2=>'Middle school',3=>'High school',4=>'Universities',5=>'Professional'];
        foreach ($allSpecifications as $key=>$value){
            switch ($key){
                case 'ges':
                    $allSpecifications[$key] = $classEnergieAndGes[$value];
                    break;
                case 'classEnergie':
                    $allSpecifications[$key] = $classEnergieAndGes[$value];
                    break;
                case 'experience':
                    $allSpecifications[$key] = $experience[$value];
                    break;
                case 'paperSize':
                    $allSpecifications[$key] = $paperSize[$value];
                    break;
                case 'levelOfStudent':
                    $allSpecifications[$key] = $levelOfStudent[$value];
                    break;
            }
        }
        return $this->render('ad/show.html.twig', [
            'ad' => $ad,
            'realCategory'=> $realCategory,
            'specifications'=>$allSpecifications
        ]);
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
