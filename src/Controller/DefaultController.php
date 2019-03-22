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
        return $this->render('ad/index.html.twig', ['ads' => $adRepository->findAll()]);

    }
}