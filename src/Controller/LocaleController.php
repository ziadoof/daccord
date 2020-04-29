<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class LocaleController extends AbstractController

    {

        /**
         *@Route("/change-locale/{locale}", name="change_locale")
         */
        public function changeLocale($locale, Request $request){
            $request->getSession()->set('_locale',$locale);
            return $this->redirect($request->headers->get('referer'));
        }
    }