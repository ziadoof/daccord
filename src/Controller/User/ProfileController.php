<?php
namespace App\Controller\User;

use App\Entity\Carpool\Carpool;
use App\Entity\Driver;
use App\Entity\Hosting\HostingRequest;
use App\Events\Events;
use App\Form\DriverType;
use App\Repository\Deal\DealRepository;
use App\Repository\DriverRequestRepository;
use App\Repository\Hosting\HostingRequestRepository;
use App\Repository\Rating\RatingRepository;
use App\Service\City\CityAreaType;
use App\Service\FileUploader;
use App\Service\FormCarpoolType;
use App\Service\FormDriverType;
use App\Service\FormHostingType;
use FOS\UserBundle\Controller\ProfileController as BaseProController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Location\City;
use App\Entity\Ads\Ad;
use Doctrine\ORM\Mapping as ORM;
use App\Form\User\ProfileType;
use App\Form\Location\CityType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Location\CityRepository;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;



class ProfileController extends BaseProController
{
    private $eventDispatcher;
    private $formFactory;
    private $userManager;

    public function __construct(EventDispatcherInterface $eventDispatcher, FactoryInterface $formFactory, UserManagerInterface $userManager)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->formFactory = $formFactory;
        $this->userManager = $userManager;

        return parent::__construct( $eventDispatcher,  $formFactory,  $userManager);
    }

    /**
     * @Route("/profile/edit", name="profile_edit")
     * @param Request $request
     * @return RedirectResponse|Response|null
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $oldImage = $user->getProfileImage();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $event = new GetResponseUserEvent($user, $request);
        $this->eventDispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->formFactory->createForm();
        $form->remove('username');
        $form->remove('current_password');
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filesystem = new Filesystem();
            /*$fileUploader = new FileUploader('assets/images/profile/');
            $profileImage = $form->get('profileImage')->getData();
            //delet old photo
            $oldImage && $profileImage ?$filesystem->remove('assets/images/profile/'.$oldImage):null;
            // upload new photo
            $profileImage ? $user->setProfileImage($fileUploader->upload($profileImage)):$user->setProfileImage($oldImage);*/
            //new profile image code
            $profileImage = $form->get('profileImage')->getData();
            if (!empty($_POST['newProfileImage'])){
                if ($_POST['newProfileImage'][0] !== null){
                    $file_name = $this->generateUniqueFileName();
                    $profileImage = $this->base64ToImage($_POST['newProfileImage'][0],'assets/images/profile/'.$file_name.'.jpg');
                }
            }
            //delet old photo
            $oldImage && $profileImage ?$filesystem->remove('assets/images/profile/'.$oldImage):null;
            // upload new photo
            $profileImage ? $user->setProfileImage($file_name.'.jpg'):$user->setProfileImage($oldImage);
            // end new code

            $event = new FormEvent($form, $request);
            $this->eventDispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $this->userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $this->eventDispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('user/Profile/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/profile", name="fos_user_profile_show")
     */
    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $oldImage = $user->getProfileImage();
        return $this->render('user/Profile/show.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route( "/set_area",name="set_area", methods={"GET","POST"})
     * @param Request $request
     * @param DriverRequestRepository $driverRequestRepository
     * @param DealRepository $dealRepository
     * @param EventDispatcherInterface $eventDispatcher
     * @return RedirectResponse|Response
     */
    public function areaAction(Request $request, DriverRequestRepository $driverRequestRepository,
                               DealRepository $dealRepository , EventDispatcherInterface $eventDispatcher,
                               \App\Service\City\CityAutoAreaType $cityType, CityAreaType $regionType,
                               HostingRequestRepository $hostingRequestRepository)
    {
        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        $formRegion = $regionType->getForm();
        $formCity = $cityType->getForm();

        $formRegion->handleRequest($request);
        $formCity->handleRequest($request);

        if ($formCity->isSubmitted() && $formCity->isValid()) {

            $data = $formCity->getData();
            $city = $data->getCity();
            $ville=$data->getCity()->getName();
            $postalCode=$data->getCity()->getZipCode();
            $gpsLat=$data->getCity()->getGpsLat();
            $gpsLng=$data->getCity()->getGpsLng();

            $user->setVille($ville);
            $user->setPostalCode($postalCode);
            $user->setMapX($gpsLng);
            $user->setMapY($gpsLat);
            $user->setCity($city);
            $driver = $user->getDriver();
            if($driver){
                $driver->setCity($data->getCity());
                $driver->setGpsLat($gpsLat);
                $driver->setGpsLng($gpsLng);
                $entityManager->persist($user);
            }


            $userAds = $user->getAds();
            $ads = 0;
            foreach ($userAds as $ad){
                $count = $this->deleteAdDeals($ad, $dealRepository, $driverRequestRepository);
                $ad->setVille($data->getCity());
                $ad->setDepartment($data->getCity()->getDepartment());
                $ad->setRegion($data->getCity()->getDepartment()->getRegion());
                $ad->setGpsLat($gpsLat);
                $ad->setGpsLng($gpsLng);
                $entityManager->persist($ad);
                $event = new GenericEvent($ad);
                $eventDispatcher->dispatch(Events::AD_ADD, $event);
                $ads +=1;
            }

            $hosting = $user->getHosting();
            if($hosting){
                $hostingRequests = $hostingRequestRepository->findByPendingHosting($user->getId());
                if(!empty($hostingRequests)){
                    foreach ($hostingRequests as $hostingRequest){
                        $entityManager->remove($hostingRequest);
                    }
                }
                $hosting->setVille($city);
                $hosting->setDepartment($city->getDepartment());
                $hosting->setRegion($city->getDepartment()->getRegion());
                $entityManager->persist($hosting);
            }



            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your city for your account, driver, Hosting has been successfully changed, and there are ('
                .$ads. ') ads that have been changed,All Deals and driver requests and hosting requests related has been deleted.'

            );
            return $this->redirectToRoute('fos_user_profile_show');
        }

        if($formRegion->isSubmitted() && $formRegion->isValid()) {
            $data = $formCity->getData();
            $city = $data->getCity();
            $ville=$data->getCity()->getName();
            $postalCode=$data->getCity()->getZipCode();
            $gpsLat=$data->getCity()->getGpsLat();
            $gpsLng=$data->getCity()->getGpsLng();

            $user->setVille($ville);
            $user->setPostalCode($postalCode);
            $user->setMapX($gpsLng);
            $user->setMapY($gpsLat);
            $user->setCity($city);
            $driver = $user->getDriver();
            if($driver){
                $driver->setCity($data->getCity());
                $driver->setGpsLat($gpsLat);
                $driver->setGpsLng($gpsLng);
                $entityManager->persist($user);
            }


            $userAds = $user->getAds();
            $ads = 0;
            foreach ($userAds as $ad){
                $count = $this->deleteAdDeals($ad, $dealRepository, $driverRequestRepository);
                $ad->setVille($data->getCity());
                $ad->setDepartment($data->getCity()->getDepartment());
                $ad->setRegion($data->getCity()->getDepartment()->getRegion());
                $ad->setGpsLat($gpsLat);
                $ad->setGpsLng($gpsLng);
                $entityManager->persist($ad);
                $event = new GenericEvent($ad);
                $eventDispatcher->dispatch(Events::AD_ADD, $event);
                $ads +=1;
            }

            $hosting = $user->getHosting();
            if($hosting){
                $hostingRequests = $hostingRequestRepository->findByPendingHosting($user->getId());
                if(!empty($hostingRequests)){
                    foreach ($hostingRequests as $hostingRequest){
                        $entityManager->remove($hostingRequest);
                    }
                }
                $hosting->setVille($city);
                $hosting->setDepartment($city->getDepartment());
                $hosting->setRegion($city->getDepartment()->getRegion());
                $entityManager->persist($hosting);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your city for your account, driver, Hosting has been successfully changed, and there are ('
                .$ads. ') ads that have been changed,All Deals and driver requests and hosting requests related has been deleted.'
            );
            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('user/Profile/edit_area.html.twig', [
        ]);
    }

    /**
     * @Route("/user_driver",  name="new_driver", methods={"POST"})
     * @param Request $request
     * @param FormDriverType $formDriverType
     * @return RedirectResponse|Response
     */
    public function new_driver(Request $request, FormDriverType $formDriverType)
    {
        $user = $this->getUser();
        $driverOldPhoto = null;
        if ($user->getDriver()){
            $driverOldPhoto = $user->getDriver()->getCarImage();
        }

        $DriverForm = $formDriverType->getForm();
        $DriverForm->handleRequest($request);
        if ($DriverForm->isSubmitted() && $DriverForm->isValid()) {
            /* $driver = $DriverForm->getData();
             $filesystem = new Filesystem();
             $carImage = $DriverForm->get('carImage')->getData();
             $fileUploader = new FileUploader('assets/images/car_driver/');

             //delet old photo
             $driverOldPhoto && $carImage ?$filesystem->remove('assets/images/car_driver/'.$driverOldPhoto):null;
             // upload new photo
             $carImage ? $driver->setCarImage($fileUploader->upload($carImage)):$driver->setCarImage($driverOldPhoto?:'with out photo');

             $driver->setUser($user);
             $driver->setCity($user->getCity());
             $driver->setGpsLat($user->getMapY());
             $driver->setGpsLng($user->getMapX());

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($driver);
             $entityManager->flush();

             return $this->redirectToRoute('fos_user_profile_show');*/

            $carImage = $DriverForm->get('carImage')->getData();
            if (!empty($_POST['driverImage'])){
                if ($_POST['driverImage'][0] !== null){
                    $file_name = $this->generateUniqueFileName();
                    $carImage = $this->base64ToImage($_POST['driverImage'][0],'assets/images/car_driver/'.$file_name.'.jpeg');
                }
            }

            $driver = $DriverForm->getData();
            $filesystem = new Filesystem();
            /*$fileUploader = new FileUploader('assets/images/car_driver/');*/
            //delet old photo
            $driverOldPhoto && $carImage ?$filesystem->remove('assets/images/car_driver/'.$driverOldPhoto):null;
            // upload new pho$this->driverPhototo
            $carImage ? $driver->setCarImage($file_name.'.jpeg'):$driver->setCarImage($driverOldPhoto?:'with out photo');

            $driver->setUser($user);
            $driver->setCity($user->getCity());
            $driver->setGpsLat($user->getMapY());
            $driver->setGpsLng($user->getMapX());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($driver);
            $entityManager->flush();

            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('user/Profile/driver_edit_form.html.twig', [

        ]);

    }

    //delete all the driver request and deal contact with this ad
    public function deleteAdDeals(Ad $ad, DealRepository $dealRepository, DriverRequestRepository $driverRequestRepository): array
    {
        $entityManager = $this->getDoctrine()->getManager();
        $deals = $dealRepository->findByAd($ad);
        $countDriverRequests = 0;
        $countDeals =0;
        if(!empty($deals)){
            foreach ($deals as $deal){
                $driverRequests = $driverRequestRepository->findByDeal($deal);
                if(!empty($driverRequests)){
                    foreach ($driverRequests as $driverRequest){
                        $entityManager->remove($driverRequest);
                        ++$countDriverRequests;
                    }
                    $entityManager->flush();
                }
                $entityManager->remove($deal);
                ++$countDeals;
            }
            $entityManager->flush();
        }
        return array('countDriverRequests' => $countDriverRequests, 'countDeals' => $countDeals);
    }

    /**
     * @Route( name="rating_driver")
     * @param User $user
     * @param RatingRepository $ratingRepository
     * @return Response
     */
    public function ratingDriver(User $user, RatingRepository $ratingRepository)
    {
        $rating = $ratingRepository->findByTypeAndCandidate('driver',$user->getId());
        return $this->render('user/Driver/rating.html.twig', [
            'rating'=>$rating,
        ]);
    }

    /**
     * @Route( name="rating_hosting")
     * @param User $user
     * @param RatingRepository $ratingRepository
     * @return Response
     */
    public function ratingHosting(User $user, RatingRepository $ratingRepository): Response
    {
        $rating = $ratingRepository->findByTypeAndCandidate('hosting',$user->getId());
        return $this->render('user/Hosting/rating.html.twig', [
            'rating'=>$rating,
        ]);
    }

    /**
     * @Route("/user_hosting",  name="new_hosting", methods={"POST"})
     * @param Request $request
     * @param FormHostingType $formHostingType
     * @return RedirectResponse|Response
     */
    public function new_hosting(Request $request, FormHostingType $formHostingType)
    {
        $user = $this->getUser();
        $hostingOldPhoto = null;
        if ($user->getHosting()){
            $hostingOldPhoto = $user->getHosting()->getImage();
        }

        $HostingForm = $formHostingType->getForm();
        $HostingForm->handleRequest($request);
        if ($HostingForm->isSubmitted() && $HostingForm->isValid()) {
            $hosting = $HostingForm->getData();
            $filesystem = new Filesystem();

            $hostingImage = $HostingForm->get('image')->getData();
            /*$fileUploader = new FileUploader('assets/images/Hosting/');

            //delet old photo
            $hostingOldPhoto && $hostingImage ?$filesystem->remove('assets/images/car_driver/'.$hostingOldPhoto):null;
            // upload new photo
            $hostingImage ? $hosting->setImage($fileUploader->upload($hostingImage)):$hosting->setImage($hostingOldPhoto?:'with out photo');*/

            //new photo code

            if (!empty($_POST['hostingImage'])){
                if ($_POST['hostingImage'][0] !== null){
                    $file_name = $this->generateUniqueFileName();
                    $hostingImage = $this->base64ToImage($_POST['hostingImage'][0],'assets/images/Hosting/'.$file_name.'.jpg');
                }
            }
            //delet old photo
            $hostingOldPhoto && $hostingImage ?$filesystem->remove('assets/images/Hosting/'.$hostingOldPhoto):null;
            // upload new photo
            $hostingImage ? $hosting->setImage($file_name.'.jpg'):$hosting->setImage($hostingOldPhoto);
            //end new photo code


            $hosting->setUser($user);
            $hosting->setVille($user->getCity());
            $hosting->setDepartment($user->getCity()->getDepartment());
            $hosting->setRegion($user->getCity()->getDepartment()->getRegion());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hosting);
            $entityManager->flush();

            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('user/Profile/hosting_edit_form.html.twig', [

        ]);
    }

    /**
     * @Route("/user_carpool",  name="new_carpool", methods={"POST"})
     * @param Request $request
     * @param FormCarpoolType $formCarpoolType
     * @return RedirectResponse|Response
     */
    public function new_carpool(Request $request, FormCarpoolType $formCarpoolType)
    {
        $user = $this->getUser();
        $carpoolOldPhoto = null;
        if ($user->getCarpool()){
            $carpoolOldPhoto = $user->getCarpool()->getCarImage();
        }

        $carpoolForm = $formCarpoolType->getForm();
        $carpoolForm->handleRequest($request);
        if ($carpoolForm->isSubmitted() && $carpoolForm->isValid()) {

            $carpool = $carpoolForm->getData();
            $filesystem = new Filesystem();
            $carImage = $carpoolForm->get('carImage')->getData();
            /*$fileUploader = new FileUploader('assets/images/carpool/');

            //delet old photo
            $carpoolOldPhoto && $carImage ?$filesystem->remove('assets/images/carpool/'.$carpoolOldPhoto):null;
            // upload new photo
            $carImage ? $carpool->setCarImage($fileUploader->upload($carImage)):$carpool->setCarImage($carpoolOldPhoto?:'with out photo');*/

            //new photo code

            if (!empty($_POST['carpoolImage'])){
                if ($_POST['carpoolImage'][0] !== null){
                    $file_name = $this->generateUniqueFileName();
                    $carImage = $this->base64ToImage($_POST['carpoolImage'][0],'assets/images/carpool/'.$file_name.'.jpg');
                }
            }
            //delet old photo
            $carpoolOldPhoto && $carImage ?$filesystem->remove('assets/images/carpool/'.$carpoolOldPhoto):null;
            // upload new photo
            $carImage ? $carpool->setCarImage($file_name.'.jpg'):$carpool->setCarImage($carpoolOldPhoto);
            //end new photo code

            $carpool->setUser($user);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carpool);
            $entityManager->flush();

            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('user/Profile/carpool_edit_form.html.twig', [

        ]);

    }

    /**
     * @Route("carpool/{id}", name="carpool_show", methods={"GET"})
     * @param Carpool $carpool
     * @param RatingRepository $ratingRepository
     * @return Response
     */
    public function showCarpool(Carpool $carpool, RatingRepository $ratingRepository): Response
    {
        $rating = $ratingRepository->findByTypeAndCandidate('carpool', $carpool->getUser()->getId());
        return $this->render('user/Carpool/carpool_show.html.twig', [
            'carpool' => $carpool,
            'rating' => $rating
        ]);
    }

    /**
     * @Route( name="rating_carpool")
     * @param User $user
     * @param RatingRepository $ratingRepository
     * @return Response
     */
    public function ratingCarpool(User $user, RatingRepository $ratingRepository): Response
    {
        $rating = $ratingRepository->findByTypeAndCandidate('carpool',$user->getId());
        return $this->render('user/Carpool/rating.html.twig', [
            'rating'=>$rating,
        ]);
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
}