<?php
namespace App\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseProController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Form\UserType;



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
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $data = $form->getData();
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
            'form' => $form->createView(),
        ]);
    }
}