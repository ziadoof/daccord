<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 25/12/18
 * Time: 22:01
 */

namespace App\Controller;


use App\Entity\Image;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;



class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }
}