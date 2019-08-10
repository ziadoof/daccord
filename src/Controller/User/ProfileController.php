<?php
namespace App\Controller\User;

use FOS\UserBundle\Controller\ProfileController as BaseProController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Location\City;
use App\Entity\Ad;
use Doctrine\ORM\Mapping as ORM;
use App\Form\User\UserType;
use App\Form\User\UserCityType;
use App\Form\User\ProfileType;
use App\Form\Location\CityType;
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
                    $entityManager->persist($user);
                    $entityManager->flush();

                    $this->addFlash(
                        'success',
                        'Votre ville a été bien ajouté!'
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
}