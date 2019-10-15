<?php
namespace App\Controller\User;

use App\Entity\Driver;
use App\Form\DriverType;
use App\Service\FileUploader;
use App\Service\FormDriverType;
use FOS\UserBundle\Controller\ProfileController as BaseProController;
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
     * @Route("/area", name="set_area", methods={"GET","POST"})
     */
    public function areaAction(Request $request)
    {
        $user = $this->getUser();

        $formRegion = $this->createForm(UserCityType::class, $user);
        $formRegion->handleRequest($request);

        $formCity = $this->createForm(UserType::class, $user);
        $formCity->handleRequest($request);
        dump($user->getDriver());
                if($formCity->isSubmitted() && $formCity->isValid()) {
                    $entityManager = $this->getDoctrine()->getManager();
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
                    $entityManager->persist($user);
                    $entityManager->flush();

                    $this->addFlash(
                        'success',
                        'Votre ville pour User et Driver a été bien ajouté!'
                    );
                    return $this->redirectToRoute('fos_user_profile_show');
                }

                elseif ($formRegion->isSubmitted() && $formRegion->isValid()) {
                    $entityManager = $this->getDoctrine()->getManager();
                    $data = $formRegion->getData();
                    $ville=$data->getCity()->getName();
                    $postalCode=$data->getCity()->getZipCode();
                    $gpsLat=$data->getCity()->getGpsLat();
                    $gpsLng=$data->getCity()->getGpsLng();
                    $user->setVille($ville);
                    $user->setPostalCode($postalCode);
                    $user->setMapX($gpsLng);
                    $user->setMapY($gpsLat);
                    $entityManager->persist($user);
                    $entityManager->flush();

                    $this->addFlash(
                        'success',
                        'Votre ville a été bien ajouté!'
                    );
                    return $this->redirectToRoute('fos_user_profile_show');
                }

        return $this->render('user/Profile/area.html.twig', [
            'user' => $user,
            'formRegion' => $formRegion->createView(),
            'formCity' => $formCity->createView(),
            ]);
    }

    /**
     * @Route("/changeAdsArea", name="chang_ads_area", methods={"GET","POST"})
     */
    public function changeAdsArea(Request $request){
        $user = $this->getUser();
        $city = $user->getCity();
        $userAds = $user->getAds();
        $entityManager = $this->getDoctrine()->getManager();
        $ads = 0;
        $offer = 0;
        $demand=0;
        foreach ($userAds as $ad){
            $ad->setVille($city);
            $ad->setDepartment($city->getDepartment());
            $ad->setRegion($city->getDepartment()->getRegion());
            $entityManager->persist($ad);
            if($ad->getTypeOfAd() === 'Offer'){
                $offer +=1;
                $ads +=1;
            }
            else{
                $demand +=1;
                $ads+=1;
            }
        }
        $entityManager->flush();
        return $this->render('user/Profile/changeAdsArea.html.twig', [
            'user' => $user,
            'ads' => $ads,
            'offer' => $offer,
            'demand' => $demand,
        ]);
    }

    //test driver

    /**
     * @Route("/driver",  name="new_driver", methods={"GET","POST"})
     * @param Request $request
     * @param FormDriverType $formDriverType
     * @param FileUploader $fileUploader
     * @return RedirectResponse|Response
     */
    public function new_driver(Request $request, FormDriverType $formDriverType/*, FileUploader $fileUploader*/)
    {
        $user = $this->getUser();
        $DriverForm = $formDriverType->getForm();
        $DriverForm->handleRequest($request);
            if ($DriverForm->isSubmitted() && $DriverForm->isValid()) {
                $driver = $DriverForm->getData();
                /*$driverOldPhoto = $user*/

                $carImage = $DriverForm->get('carImage')->getData();
                $fileUploader = new FileUploader('assets/images/car_driver/');
                $driver->setCarImage($fileUploader->upload($carImage));

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