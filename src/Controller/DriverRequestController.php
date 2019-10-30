<?php

namespace App\Controller;

use App\Entity\Deal\Deal;
use App\Entity\Driver;
use App\Entity\DriverRequest;
use App\Entity\User;
use App\Form\DriverRequestType;
use App\Repository\Deal\DealRepository;
use App\Repository\Deal\DoneDealRepository;
use App\Repository\DriverRepository;
use App\Repository\DriverRequestRepository;
use App\Service\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/driver_request")
 */
class DriverRequestController extends AbstractController
{
    /**
     * @Route("/", name="driver_request_index", methods={"GET"})
     * @param DriverRequestRepository $driverRequestRepository
     * @param DealRepository $dealRepository
     * @param DoneDealRepository $doneDealRepository
     * @return Response
     */
    public function index(DriverRequestRepository $driverRequestRepository, DealRepository $dealRepository, DoneDealRepository $doneDealRepository): Response
    {
        $user = $this->getUser();
        $driver = $user->getDriver();
        $driverRequest = $driverRequestRepository->findByDriver($driver);
        // in deals the driver user is User object and not Driver so we use $user instant of driver
        $deals = $dealRepository->findByDriver($user);
        $doneDeals = $doneDealRepository->findByDriver($user);

        return $this->render('driver_request/index.html.twig', [
            'driver_requests' => $driverRequest,
            'doneDeals' => $doneDeals,
            'deals'=>$deals
        ]);
    }

    /**
     * @Route("/new/{driver}/{deal}", name="driver_request_new", methods={"GET","POST"})
     * @param Request $request
     * @param Driver $driver
     * @param Deal $deal
     * @param Notification $notification
     * @return Response
     */
    public function new(Request $request, Driver $driver, Deal $deal, Notification $notification): Response
    {
        $driverRequest = new DriverRequest();
        $user = $this->getUser();

        $form = $this->createForm(DriverRequestType::class, $driverRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $driverRequest->setUser($user);
            $driverRequest->setDeal($deal);
            $driverRequest->setDriver($driver);
            $entityManager->persist($driverRequest);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your driver request has bin sent!'
            );
            $notification->addNotification(['type'=>'driverRequest','object'=>$driverRequest]);
            return $this->redirectToRoute('deal_show', array('id' => $deal->getId()));
        }

        return $this->render('driver_request/new.html.twig', [
            'driver_request' => $driverRequest,
            'driver'=> $driver,
            'deal'=> $deal,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/{deal}", name="driver_request_delete", methods={"DELETE"})
     * @param Request $request
     * @param DriverRequest $driverRequest
     * @param Deal $deal
     * @return Response
     */
    public function delete(Request $request, DriverRequest $driverRequest, Deal $deal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$driverRequest->getId(), $request->request->get('_token'))) {
            //to do if driver request accepted th user less 2 point
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($driverRequest);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your driver request has bin deleted!'
            );
        }

        return $this->redirectToRoute('deal_show', array('id' => $deal->getId()));    }

    /**
     * @Route( "/{driverRequest}/{type}",name="driver_request_treatment", methods={"GET","POST"})
     * @param DriverRequest $driverRequest
     * @param string $type
     * @param Notification $notification
     * @return RedirectResponse
     */
    public function request_treatment(DriverRequest $driverRequest, string $type, Notification $notification): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $driverRequest->setStatus($type);

        $entityManager->persist($driverRequest);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'The driver request has bin '.$type.' ..!'
        );
        $notification->addNotification(['type'=>'treatmentDriverRequest','object'=>$driverRequest,'treatment'=>$type]);

        return $this->redirectToRoute('driver_request_index');
    }
}
