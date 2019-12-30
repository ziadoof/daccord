<?php
namespace App\Controller\User;

use App\Entity\Driver;
use App\Events\Events;
use App\Form\DriverType;
use App\Repository\Deal\DealRepository;
use App\Repository\DriverRequestRepository;
use App\Repository\Rating\RatingRepository;
use App\Service\City\CityAreaType;
use App\Service\FileUploader;
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



class ProfileController extends BaseProController
{
    /**
     * @Route("/profile/edit", name="profile_edit")
     */
    public function editAction(Request $request)
    {
        $response = parent::editAction($request);
        // ... do custom stuff
        return $response;
    }

    /**
     * @Route("/profile", name="fos_user_profile_show")
     */
    public function showAction()
    {
        return parent::showAction();
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
                               \App\Service\City\CityAutoAreaType $cityType, CityAreaType $regionType )
    {
        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        $formRegion = $regionType->getForm();
        $formCity = $cityType->getForm();

        $formRegion->handleRequest($request);
        $formCity->handleRequest($request);

        if ($formCity->isSubmitted() && $formCity->isValid()) {

            $data = $formCity->getData();
            $ville=$data->getCity()->getName();
            $postalCode=$data->getCity()->getZipCode();
            $gpsLat=$data->getCity()->getGpsLat();
            $gpsLng=$data->getCity()->getGpsLng();

            $user->setVille($ville);
            $user->setPostalCode($postalCode);
            $user->setMapX($gpsLng);
            $user->setMapY($gpsLat);
            $driver = $user->getDriver();
            if($driver){
              $driver->setCity($data->getCity());
              $driver->setGpsLat($gpsLat);
              $driver->setGpsLng($gpsLng);
                $entityManager->persist($user);
            }


            $userAds = $user->getAds();
            $ads = 0;
            $countDriverRequests=0;
            $countDeals=0;
            foreach ($userAds as $ad){
                $count = $this->deleteAdDeals($ad, $dealRepository, $driverRequestRepository);
                $countDriverRequests = $count['countDriverRequests'];
                $countDeals = $count['countDeals'];
                $ad->setVille($data->getCity());
                $ad->setDepartment($data->getCity()->getDepartment());
                $ad->setRegion($data->getCity()->getDepartment()->getRegion());
                $entityManager->persist($ad);
                   $event = new GenericEvent($ad);
                   $eventDispatcher->dispatch(Events::AD_ADD, $event);
                $ads +=1;
            }


            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your city for your account and driver has been successfully changed, and there are ('
                .$ads. ') ads that have been changed('
                .$countDriverRequests.') Driver requests has been deleted('
                .$countDeals.') Deals has been deleted'

            );
            return $this->redirectToRoute('fos_user_profile_show');
        }

        if($formRegion->isSubmitted() && $formRegion->isValid()) {
            $data = $formRegion->getData();
            $ville=$data->getCity()->getName();
            $postalCode=$data->getCity()->getZipCode();
            $gpsLat=$data->getCity()->getGpsLat();
            $gpsLng=$data->getCity()->getGpsLng();
            $user->setVille($ville);
            $user->setPostalCode($postalCode);
            $user->setMapX($gpsLng);
            $user->setMapY($gpsLat);

            $userAds = $user->getAds();
            $ads = 0;
            $countDriverRequests=0;
            $countDeals=0;
            foreach ($userAds as $ad){
                $count = $this->deleteAdDeals($ad, $dealRepository, $driverRequestRepository);
                $countDriverRequests = $count['countDriverRequests'];
                $countDeals = $count['countDeals'];
                $ad->setVille($data->getCity());
                $ad->setDepartment($data->getCity()->getDepartment());
                $ad->setRegion($data->getCity()->getDepartment()->getRegion());
                $entityManager->persist($ad);

                $event = new GenericEvent($ad);
                $eventDispatcher->dispatch(Events::AD_ADD, $event);

                $ads +=1;
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your city for your account and driver has been successfully changed, and there are ('
                .$ads. ') ads that have been changed('
                .$countDriverRequests.') Driver requests has been deleted('
                .$countDeals.') Deals has been deleted'
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
                $driver = $DriverForm->getData();
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
    public function ratingHosting(User $user, RatingRepository $ratingRepository)
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
            $fileUploader = new FileUploader('assets/images/Hosting/');

            //delet old photo
            $hostingOldPhoto && $hostingImage ?$filesystem->remove('assets/images/car_driver/'.$hostingOldPhoto):null;
            // upload new photo
            $hostingImage ? $hosting->setImage($fileUploader->upload($hostingImage)):$hosting->setImage($hostingOldPhoto?:'with out photo');

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
}