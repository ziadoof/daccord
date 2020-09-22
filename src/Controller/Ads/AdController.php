<?php

namespace App\Controller\Ads;

use App\Entity\Ads\Ad;
use App\Entity\Ads\Category;
use App\Entity\Deal\Deal;
use App\Entity\Visit;
use App\Events\Events;
use App\Form\Ads\OfferType;
use App\Form\Ads\DemandType;
use App\Form\Ads\AdType;
use App\Repository\Ads\AdRepository;
use App\Repository\Deal\DealRepository;
use App\Repository\Location\CityRepository;
use App\Repository\VisitRepository;
use App\Service\FileUploader;
use Doctrine\ORM\OptimisticLockException;
use Knp\Component\Pager\PaginatorInterface;
use Mgilet\NotificationBundle\Manager\NotificationManager;
use Mgilet\NotificationBundle\NotifiableInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Contracts\Translation\TranslatorInterface;
use ZMQ;
use ZMQContext;


/**
 * @Route("/")
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
     * @param Request $request
     * @param AdRepository $adRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, AdRepository $adRepository , PaginatorInterface $paginator, TranslatorInterface $translator): Response
    {

        $user = $this->getUser();

        $result = $adRepository->findAll();
        $allResults = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );

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
            if(empty($ad_area)){
                $results = $allResults;
            }
            else{
                $results = $paginator->paginate(
                // Doctrine Query, not results
                    $ad_area,
                    // Define the page parameter
                    $request->query->getInt('page', 1),
                    // Items per page
                    20
                );
            }
            return $this->render('Ads/ad/index.html.twig', [
                'ad_area'=>$results,
                'ads' => $results

            ]);
        }

        return $this->render('Ads/ad/index.html.twig', [
            'ads' => $allResults,
        ]);
    }

    /**
     * @Route("ad/new/{type}", name="ad_new", methods={"GET","POST"})
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param string $type
     * @param EventDispatcherInterface $eventDispatcher
     * @param NotificationManager $manager
     * @return Response
     * @throws OptimisticLockException
     */
    public function new(Request $request, FileUploader $fileUploader, string $type, EventDispatcherInterface $eventDispatcher, NotificationManager $manager): Response
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

                /*$file1 = $form->get('imageOne')->getData();
                $file2 = $form->get('imageTow')->getData();
                $file3 = $form->get('imageThree')->getData();

                $file1 ?$ad->setImageOne($fileUploader->upload($file1)):$ad->setImageOne(null);
                $file2 ?$ad->setImageTow($fileUploader->upload($file2)):$ad->setImageTow(null);
                $file3 ?$ad->setImageThree($fileUploader->upload($file3)):$ad->setImageThree(null);*/

                //photo new code
                $image1 = $form->get('imageOne')->getData();
                $image2 = $form->get('imageTow')->getData();
                $image3 = $form->get('imageThree')->getData();

                if (!empty($_POST['adImageOne'])){
                    if ($_POST['adImageOne'][0] !== null){
                        $file1_name = $this->generateUniqueFileName();
                        $image1 = $this->base64ToImage($_POST['adImageOne'][0],'assets/images/annonce/'.$file1_name.'.jpg');
                    }
                }
                if (!empty($_POST['adImageTow'])){
                    if ($_POST['adImageTow'][0] !== null){
                        $file2_name = $this->generateUniqueFileName();
                        $image2 = $this->base64ToImage($_POST['adImageTow'][0],'assets/images/annonce/'.$file2_name.'.jpg');
                    }
                }
                if (!empty($_POST['adImageThree'])){
                    if ($_POST['adImageThree'][0] !== null){
                        $file3_name = $this->generateUniqueFileName();
                        $image3 = $this->base64ToImage($_POST['adImageThree'][0],'assets/images/annonce/'.$file3_name.'.jpg');
                    }
                }
                // upload new photo
                $image1 ? $ad->setImageOne($file1_name.'.jpg'):$ad->setImageOne(null);
                $image2 ? $ad->setImageTow($file2_name.'.jpg'):$ad->setImageTow(null);
                $image3 ? $ad->setImageThree($file3_name.'.jpg'):$ad->setImageThree(null);

                //end photo new code

                $ad->setUser($this->getUser());
                $ad->setCategory($category);
                $ad->setGeneralCategory($category->getParent());

                $ville = $this->getUser()->getCity();
                $department = $this->getUser()->getCity()->getDepartment();
                $region = $this->getUser()->getCity()->getDepartment()->getRegion();
                $ad->setVille($ville);
                $ad->setDepartment($department);
                $ad->setRegion($region);

                $categoryName = $category->getName();
                if($this->isHaveCity($categoryName)){

                $city = $form->get('city')->getData();
                    $lat = $city->getGpsLat();
                    $lng= $city->getGpsLng();
                    $ad->setGpsLat($lat);
                    $ad->setGpsLng($lng);
                }
                else{
                    $lat = $ville->getGpsLat();
                    $lng= $ville->getGpsLng();
                    $ad->setGpsLat($lat);
                    $ad->setGpsLng($lng);
                }


                $entityManager->persist($ad);
                $entityManager->flush();

                //On déclenche l'event create deal in max 8
                $event = new GenericEvent($ad);
                $eventDispatcher->dispatch(Events::AD_ADD, $event);
                return $this->redirectToRoute('ad_index');
            }

            return $this->render('Ads/ad/new.html.twig', [
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
                $ad->setGeneralCategory($category->getParent());

                $ville = $this->getUser()->getCity();
                $department = $this->getUser()->getCity()->getDepartment();
                $region = $this->getUser()->getCity()->getDepartment()->getRegion();
                $ad->setVille($ville);
                $ad->setDepartment($department);
                $ad->setRegion($region);


                $categoryName = $category->getName();
                if($this->isHaveCity($categoryName)){

                    $city = $form->get('city')->getData();
                    $lat = $city->getGpsLat();
                    $lng= $city->getGpsLng();
                    $ad->setGpsLat($lat);
                    $ad->setGpsLng($lng);
                }
                else{
                    $lat = $ville->getGpsLat();
                    $lng= $ville->getGpsLng();
                    $ad->setGpsLat($lat);
                    $ad->setGpsLng($lng);
                }


                $entityManager->persist($ad);
                $entityManager->flush();

                //On déclenche l'event create deals in max 8
                $event = new GenericEvent($ad);
                $eventDispatcher->dispatch(Events::AD_ADD, $event);
                return $this->redirectToRoute('ad_index');
            }

            return $this->render('Ads/ad/new.html.twig', [
                'ad' => $ad,
                'form' => $form->createView(),
            ]);
        }

    }

    /**
     * @Route("ad/{id}", name="ad_show", methods={"GET"}, options={"expose"=true})
     * @param Ad $ad
     * @return Response
     */
    public function show(Ad $ad): Response
    {
        if (!$ad) {
            throw $this->createNotFoundException('This ad has been removed');
        }
        $em = $this->getDoctrine()->getManager();
        $categoryParent = $ad->getCategory()->getParent()->getName();
        $realCategory = $em->getRepository(Category::class)->findCategoryByName($ad->getCategory()->getName(),$ad->getTypeOfAd(), $categoryParent);
        $allSpecifications = $this->fixSpecifications($ad->getAllSpecifications());
        return $this->render('Ads/ad/show.html.twig', [
            'ad' => $ad,
            'realCategory'=> $realCategory,
            'specifications'=>$allSpecifications
        ]);
    }

    /**
     * @Route("ad/{id}/edit", name="ad_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Ad $ad
     * @return Response
     */
    public function edit(Request $request, Ad $ad): Response
    {
        $em = $this->getDoctrine()->getManager();
        $allSpecifications = $ad->getAllSpecifications();
        $price = $ad->getPrice();
        $categoryParent = $ad->getCategory()->getParent()->getName();
        $realCategory = $em->getRepository(Category::class)->findCategoryByName($ad->getCategory()->getName(),$ad->getTypeOfAd(), $categoryParent);

        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ad->setPPrice($price);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ad_show', ['id' => $ad->getId()]);
        }

        return $this->render('Ads/ad/edit.html.twig', [
            'specifications'=>$allSpecifications,
            'realCategory'=> $realCategory,
            'ad' => $ad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("ad/{id}", name="ad_delete", methods={"DELETE"})
     * @param Request $request
     * @param Ad $ad
     * @param DealRepository $dealRepository
     * @return Response
     */
    public function delete(Request $request, Ad $ad, DealRepository $dealRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ad->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $dealsContact = $dealRepository->findByAd($ad);
            foreach ($dealsContact as $dealContact){
                $driverRequests = $dealContact->getDriverRequests();
                foreach ($driverRequests as $driverRequest){
                    $entityManager->remove($driverRequest);
                }
                $entityManager->remove($dealContact);
            }
            $entityManager->remove($ad);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your ad and all the deals related to it has been removed successfully!'
            );
        }
        if($this->getUser()->isAdmin()){
            return $this->redirectToRoute('admin_ads');
        }
        return $this->redirectToRoute('ad_index');
    }


    /**
     * @Route("/my_ads/offers", name="my_offers",methods={"POST","GET"}, options={"expose"=true})
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function my_offers(PaginatorInterface $paginator, Request $request): Response
    {
        $user = $this->getUser();
        $ads  = $user->getAds();
        $data = $request->get('type');
        $my_ads =[];

        foreach ($ads as $ad){
            $typeOfAd = $ad->getTypeOfAd();
            if($typeOfAd === 'Offer'){
                $serializedResult []= $ad->serialize();
                $my_ads []= $ad;
            }
        }
        if(!empty($serializedResult)){
            $response = array(
                'result' => $serializedResult,
                'message' => 'succese',
            );
        }
        else{
            $response = array(
                'result' => [],
                'message' => 'empty',
            );
        }

        if($data === 'Offer'){
            return new JsonResponse($response);
        }
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $my_ads,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );
        return $this->render('Ads/ad/myAds.html.twig', [
            'my_ads' => $results,
        ]);

    }

    /**
     * @Route("/my_ads/demands", name="my_demands",methods={"POST","GET"}, options={"expose"=true})
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function my_demands(PaginatorInterface $paginator, Request $request): Response
    {
        $user = $this->getUser();
        $ads  = $user->getAds();
        $data = $request->get('type');
        $my_ads =[];

        foreach ($ads as $ad){
            $typeOfAd = $ad->getTypeOfAd();
            if($typeOfAd === 'Demand'){
                $serializedResult []= $ad->serialize();
                $my_ads []= $ad;
            }
        }
        $response = array(
            'result' => $serializedResult,
            'message' => 'succese',
        );

        if(!empty($serializedResult)){
            $response = array(
                'result' => $serializedResult,
                'message' => 'succese',
            );
        }
        else{
            $response = array(
                'result' => [],
                'message' => 'empty',
            );
        }

        if($data === 'Demand'){
            return new JsonResponse($response);
        }
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $my_ads,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );
        return $this->render('Ads/ad/myAds.html.twig', [
            'my_ads' => $results,
        ]);
    }

    public function fixSpecifications ($allSpecifications){
        $classEnergieAndGes=[1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G'];
        $paperSize=[1=>'4A0',2=>'2A0',3=>'A0',4=>'A1',5=>'A2',6=>'A3',7=>'A4',8=>'A5',9=>'A6',10>'A7',11=>'A8',12=>'A9',13=>'A10'];
        $experience=[0=>'Not required',1=>'1 YEAR',2=>'2 YEARS' ,3=>'3 YEARS' ,4=>'4 YEARS' ,5=>'5 YEARS' ,6=>'+ 5 YEARS'];
        $levelOfStudent=[1=>'Maternal school',2=>'Middle school',3=>'High school',4=>'Universities',5=>'Professional'];
        $capacityLitre = [1=>'Less than 50 Liters',2 =>'50-80 Liters',3 =>'80-150 Liters',4 =>'150-250 Liters',5 =>'250-330 Liters',6 =>'330-490 Liters',7 =>'More than 50 Liters'];
        $boolean = [0=>'No',1=>'Yes'];
        $generalSituation = [1=>'Damaged' ,2 =>'Medium' , 3 =>'Good' ,4 => 'Semi-new',5=> 'Totally new'];
        $checkbox = ['hdmi','cdRoom', 'wifi', 'usb', 'threeInOne', 'accessories', 'withFreezer', 'electricHead',
            'withOven', 'covered', 'withFurniture', 'withGarden', 'withVerandah', 'withElevator'];
        $category = $allSpecifications['category']->getName();

        foreach ($allSpecifications as $key=>$value){
            switch ($key){
                case 'classEnergie':
                case 'ges':
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
                case 'generalSituation':
                    $allSpecifications[$key] = $generalSituation[$value];
                    break;
            }
            if(in_array($key,$checkbox)){
                $allSpecifications[$key] = $boolean[$value];
            }
            if($key === 'capacity' && $category === 'Refrigerator'){
                        $allSpecifications[$key] = $capacityLitre[$value];
            }
        }
        return $allSpecifications;
    }

    public function isHaveCity(string $generalCategory=null ){

        $listCity = ['Jobs and services','Residence','Holidays'];
        if($generalCategory !== null) {
            return in_array($generalCategory, $listCity);
        }
        return false;
    }

    /**
     * @Route("/send-notification", name="send_notification")
     * @param NotificationManager $manager
     * @return RedirectResponse
     * @throws OptimisticLockException
     */
    public function sendNotification(NotificationManager $manager): RedirectResponse
    {

        $notif = $manager->createNotification('Hello world !');
        $notif->setMessage('Compellingly formulate worldwide methods of empowerment with quality infrastructures. Quickly facilitate just in time customer service rather ');
        $notif->setLink('http://symfony.com/');
        // or the one-line method :
        // $manager->createNotification('Notification subject','Some random text','http://google.fr');

        // you can add a notification to a list of entities
        // the third parameter ``$flush`` allows you to directly flush the entities
        $manager->addNotification(array($this->getUser()), $notif, true);

        return $this->redirectToRoute('ad_index');
    }



    function base64ToImage($base64_string, $output_file) {
        $data = explode(',', $base64_string);
        file_put_contents($output_file, base64_decode($data[1]));
        return $output_file;
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }


    /**
     * @Route("/visit", name="add_visit", methods={"POST"}, options={"expose"=true})
     * @param VisitRepository $repository
     * @return JsonResponse
     */
    public function addVisit(VisitRepository $repository){
        $ip   =  $_SERVER["REMOTE_ADDR"];

         $visit = new Visit($ip);
         $entityManager = $this->getDoctrine()->getManager();

         if($this->getUser()!== null){
             $visit->setIdOfUser($this->getUser()->getId());
         }
         $isVisitedToday = $repository->findByIpToday($ip);
         if(empty($isVisitedToday)){
             $entityManager->persist($visit);
             $entityManager->flush();
         }
         else{
             $hisVisit = $repository->findByIpToday($ip)[0];
             $hisVisit->setPagesVisited($hisVisit->getPagesVisited()+1);
             $entityManager->persist($hisVisit);
             $entityManager->flush();
         }
        $response = [$ip];
        return new JsonResponse($response);
    }
}
