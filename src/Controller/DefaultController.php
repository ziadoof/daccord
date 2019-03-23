<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 25/12/18
 * Time: 22:01
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Repository\AdRepository;



class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(AdRepository $adRepository)
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
            return $this->render('ad/index.html.twig', ['ads' => $adRepository->findAll()]);

        }

       /* $maxDistance = $user->getMaxDistance();
        $mapx = $user->getMapX();
        $mapy = $user->getMapY();
        $KM = 0.012626;

        $min_x = $mapx-($KM*$maxDistance);
        $max_x = $mapx+($KM*$maxDistance);
        $min_y = $mapy-($KM*$maxDistance);
        $max_y = $mapy+($KM*$maxDistance);


        $ad_area = $adRepository->findByArea($min_x,$max_x,$min_y,$max_y);*/

/*        return $this->render('ad/index.html.twig', ['ads' => $adRepository->findAll(),'ad_area'=>$ad_area]);*/

    }
}