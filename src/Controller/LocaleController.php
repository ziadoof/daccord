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
            $url = $request->headers->get('referer');

            if(strpos($url, '/cafe/') !== false){
                /* it is cafe url */
                return $this->redirectToRoute('ad_index');
            }
            elseif(strpos($url, '/meetup/near/me') !== false){
                /* it is near me url */
                return $this->redirectToRoute('meetup_index');
            }
            elseif ($url === null){
                return $this->redirectToRoute('ad_index');
            }

            return $this->redirect($url);
        }
    }