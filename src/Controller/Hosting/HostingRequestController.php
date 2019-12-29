<?php

namespace App\Controller\Hosting;

use App\Entity\Hosting\Hosting;
use App\Entity\Hosting\HostingRequest;
use App\Form\Hosting\HostingRequestType;
use App\Repository\Hosting\HostingRepository;
use App\Repository\Hosting\HostingRequestRepository;
use App\Repository\UserRepository;
use App\Service\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hosting_request")
 */
class HostingRequestController extends AbstractController
{
    /**
     * @Route("/", name="hosting_request_index", methods={"GET"})
     * @param HostingRequestRepository $hostingRequestRepository
     * @return Response
     */
    public function index(HostingRequestRepository $hostingRequestRepository): Response
    {
        $hosting_requests = $hostingRequestRepository->findBySender($this->getUser()->getId());
        return $this->render('hosting/hosting_request/index.html.twig', [
            'hosting_requests' => $hosting_requests,
        ]);
    }

    /**
     * @Route("/received", name="hosting_request_received", methods={"GET"})
     * @param HostingRequestRepository $hostingRequestRepository
     * @return Response
     */
    public function indexReceived(HostingRequestRepository $hostingRequestRepository): Response
    {
        $hosting_received = $hostingRequestRepository->findByHostingNotRegected($this->getUser()->getId());
        return $this->render('hosting/hosting_request/received.html.twig', [
            'hosting_received' => $hosting_received,
        ]);
    }

    /**
     * @Route( "/{hostingRequest}/{type}",name="hosting_request_treatment", methods={"GET","POST"})
     * @param HostingRequest $hostingRequest
     * @param string $type
     * @param Notification $notification
     * @return RedirectResponse
     */
    public function request_treatment(HostingRequest $hostingRequest, string $type, Notification $notification): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $hostingRequest->setTreatment($type);

        $entityManager->persist($hostingRequest);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'The hosting request has bin '.$type.' ..!'
        );
        /*$notification->addNotification(['type' => 'treatmentHostingRequest', 'object' => $hostingRequest, 'treatment' => $type]);*/

        return $this->redirectToRoute('hosting_request_received');
    }

    /**
     * @Route("/new/{hosting}", name="hosting_request_new", methods={"GET","POST"})
     * @param Request $request
     * @param Hosting $hosting
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request,Hosting $hosting): Response
    {
        $hostingRequest = new HostingRequest();
        $user = $this->getUser();
        $form = $this->createForm(HostingRequestType::class, $hostingRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hostingRequest->setSender($user);
            $hostingRequest->setHosting($hosting->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hostingRequest);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your hosting request has bin sent successfully!'
            );

            return $this->redirectToRoute('hosting_request_index');
        }

        return $this->render('hosting/hosting_request/new.html.twig', [
            'hosting_request' => $hostingRequest,
            'form' => $form->createView(),
            'hosting'=>$hosting
        ]);
    }

    /**
     * @Route("/{id}", name="hosting_hosting_request_show", methods={"GET"})
     */
    public function show(HostingRequest $hostingRequest): Response
    {
        return $this->render('hosting/hosting_request/show.html.twig', [
            'hosting_request' => $hostingRequest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hosting_hosting_request_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HostingRequest $hostingRequest): Response
    {
        $form = $this->createForm(HostingRequestType::class, $hostingRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hosting_hosting_request_index');
        }

        return $this->render('hosting/hosting_request/edit.html.twig', [
            'hosting_request' => $hostingRequest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hosting_hosting_request_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HostingRequest $hostingRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hostingRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hostingRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hosting_hosting_request_index');
    }
}
