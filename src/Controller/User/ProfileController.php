<?php
namespace App\Controller\User;

use App\Entity\Driver;
use App\Form\DriverType;
use App\Service\FileUploader;
use App\Service\FormDriverType;
use FOS\UserBundle\Controller\ProfileController as BaseProController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Location\City;
use App\Entity\Ads\Ad;
use Doctrine\ORM\Mapping as ORM;
use App\Form\User\UserType;
use App\Form\User\UserCityType;
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
     * @Route( name="set_area", methods={"GET","POST"})
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function areaAction(Request $request)
    {
        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $formRegion = $this->createForm(UserCityType::class, $user);
        $formRegion->handleRequest($request);

        $formCity = $this->createForm(UserType::class, $user);
        $formCity->handleRequest($request);
                if($formCity->isSubmitted() && $formCity->isValid()) {
                    $data = $formCity->getData();
                    $ville=$data->getCity()->getName();
                    $postalCode=$data->getCity()->getZipCode();
                    $gpsLat=$data->getCity()->getGpsLat();
                    $gpsLng=$data->getCity()->getGpsLng();
                    $change = $formCity->get('change')->getData();
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
                    if($change){
                        $userAds = $user->getAds();
                        $ads = 0;
                        foreach ($userAds as $ad){
                            $ad->setVille($data->getCity());
                            $ad->setDepartment($data->getCity()->getDepartment());
                            $ad->setRegion($data->getCity()->getDepartment()->getRegion());
                            $entityManager->persist($ad);
                            $ads +=1;
                            }
                    }

                    $entityManager->persist($user);
                    $entityManager->flush();

                    $this->addFlash(
                        'success',
                        'Your city for your account and driver has been successfully changed, and there are '.$ads. ' ads that have been changed'
                    );
                    return $this->redirectToRoute('fos_user_profile_show');
                }

                elseif ($formRegion->isSubmitted() && $formRegion->isValid()) {
                    $data = $formRegion->getData();
                    $ville=$data->getCity()->getName();
                    $postalCode=$data->getCity()->getZipCode();
                    $gpsLat=$data->getCity()->getGpsLat();
                    $gpsLng=$data->getCity()->getGpsLng();
                    $user->setVille($ville);
                    $user->setPostalCode($postalCode);
                    $user->setMapX($gpsLng);
                    $user->setMapY($gpsLat);
                    $change = $formRegion->get('change')->getData();
                    if($change){
                        $userAds = $user->getAds();
                        $ads = 0;
                        foreach ($userAds as $ad){
                            $ad->setVille($data->getCity());
                            $ad->setDepartment($data->getCity()->getDepartment());
                            $ad->setRegion($data->getCity()->getDepartment()->getRegion());
                            $entityManager->persist($ad);
                            $ads +=1;
                        }
                    }

                    $entityManager->persist($user);
                    $entityManager->flush();

                    $this->addFlash(
                        'success',
                        'Your city for your account and driver has been successfully changed, and there are '.$ads. ' ads that have been changed'                    );
                    return $this->redirectToRoute('fos_user_profile_show');
                }

        return $this->render('user/Profile/area.html.twig', [
            ]);
    }

    /**
     * @Route("/driver",  name="new_driver", methods={"GET","POST"})
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

}