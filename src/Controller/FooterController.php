<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FooterController extends AbstractController
{
    /**
     * @Route("/about-us", name="about_us")
     */
    public function aboutAs()
    {
        return $this->render('aboutus.html.twig');
    }

    /**
     * @Route("/legal-notice", name="legal_notice")
     * @param Request $request
     * @return Response
     */
    public function Legal_notice(Request $request)
    {
        $locale = $request->getLocale();
        $legal = 'legal_notice_'.$locale.'.html.twig';
        return $this->render($legal);
    }

}
