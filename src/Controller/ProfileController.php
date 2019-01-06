<?php
namespace App\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseProController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



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
}