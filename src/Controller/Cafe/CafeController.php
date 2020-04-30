<?php

namespace App\Controller\Cafe;

use App\Entity\Cafe\Cafe;
use App\Form\Cafe\CafeType;
use App\Repository\Cafe\CafeRepository;
use DateInterval;
use DateTime;
use JMS\JobQueueBundle\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cafe")
 */
class CafeController extends AbstractController
{

    /**
     * @Route("/", name="cafe_index", methods={"POST"})
     * @param CafeRepository $cafeRepository
     * @param Request $request
     * @param KernelInterface $kernel
     * @return Response
     */
    public function index( CafeRepository $cafeRepository ,Request $request, KernelInterface $kernel): Response
    {
        $session = new Session();
        $currentCafe = $cafeRepository->findActiveByUser($this->getUser()->getId());
        $deleteCafe = 0;

        if (isset($_POST['currentCafe'])){
            $deleteCafe = $_POST['currentCafe'];
        }


        if (isset($_POST['lat'], $_POST['lng']))
        {
            $lat = $_POST['lat'];
            $lng = $_POST['lng'];

            $session->set('lat', $lat);
            $session->set('lng', $lng);
        }
        if($currentCafe && $deleteCafe === 0){
            $areaCafes = $cafeRepository->findAreaCafe($this->getUser()->getId(),$session->get('lat'), $session->get('lng'));
            return $this->render('cafe/index.html.twig', [
                'currentCafe'=>$currentCafe,
                'areaCafes'=>$areaCafes
            ]);
        }
        if($currentCafe && $deleteCafe !== 0){
            $cafe = $cafeRepository->findOneById($deleteCafe);
            $cafe->setActive(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cafe);
            $entityManager->flush();
            return  $this->generateIndex($session->get('lat'), $session->get('lng'), $request, $cafeRepository,$kernel);

        }

        return  $this->generateIndex($session->get('lat'), $session->get('lng'), $request, $cafeRepository,$kernel);
    }


    private function generateIndex($lat, $lng, Request $request, CafeRepository $cafeRepository, KernelInterface $kernel): Response
    {
        if($lat && $lng){
            $session = new Session();
            $areaCafes = $cafeRepository->findAreaCafe($this->getUser()->getId(),$session->get('lat'), $session->get('lng'));

            $cafe = new Cafe();
            $cafe->setCreatedBy($this->getUser());
            $cafe->setGpsLat($lat);
            $cafe->setGpsLng($lng);

            $form = $this->createForm(CafeType::class, $cafe);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $cafeCreatedAt = $cafe->getCreatedAt();
                try {
                    $createdAt = new DateTime($cafeCreatedAt->format('Y-m-d H:i:s'));
                } catch (\Exception $e) {
                }
                try {
                    $expire = $createdAt->add(new DateInterval('PT' . $cafe->getDuration() . 'M'));
                } catch (\Exception $e) {
                }
                $uid = $cafe->getUid();

                $cafe->setExpireAt($expire);


                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($cafe);
                $entityManager->flush();

                $cafeId = $cafeRepository->findOneByUid($uid);
                $job = new Job('app:deactivate-cafe', array('cafeId'=>$cafeId->getId()));
                $date = new DateTime();
                try {
                    $date->add(new DateInterval('PT' . $cafeId->getDuration() . 'M'));
                } catch (\Exception $e) {
                }
                $job->setExecuteAfter($date);
                $entityManager->persist($job);
                $entityManager->flush();

                return $this->render('cafe/index.html.twig', [
                    'currentCafe'=>$cafe,
                    'areaCafes'=>$areaCafes
                ]);
            }

            return $this->render('cafe/index.html.twig', [
                'cafe' => $cafe,
                'areaCafes'=>$areaCafes,
                'form' => $form->createView(),
            ]);
        }
        return $this->render('cafe/index.html.twig', [
            'error'=>'Your current location information has not been specified'
        ]);

    }

    public function desActiveCafe(Cafe $cafe): void
    {
        $cafe->setActive(false);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($cafe);
        $entityManager->flush();
    }

    /**
     * @Route("/{id}", name="cafe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cafe $cafe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cafe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cafe);
            $entityManager->flush();
        }
        if($this->getUser()->isAdmin()){
            return $this->redirectToRoute('admin_cafe');
        }
        return $this->redirectToRoute('cafe_index');
    }


}
