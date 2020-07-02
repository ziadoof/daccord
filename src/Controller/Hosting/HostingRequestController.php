<?php

namespace App\Controller\Hosting;

use App\Entity\Hosting\Hosting;
use App\Entity\Hosting\HostingRequest;
use App\Form\Hosting\HostingRequestType;
use App\Repository\Hosting\HostingRepository;
use App\Repository\Hosting\HostingRequestRepository;
use App\Repository\Rating\VoteRepository;
use App\Repository\UserRepository;
use App\Service\Notification;
use Knp\Component\Pager\PaginatorInterface;
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
     * @param Request $request
     * @param HostingRequestRepository $hostingRequestRepository
     * @param VoteRepository $voteRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, HostingRequestRepository $hostingRequestRepository, VoteRepository $voteRepository, PaginatorInterface $paginator): Response
    {
        $requests = $hostingRequestRepository->findBySender($this->getUser()->getId());

        $voteHostingByThisUser = $voteRepository->findByVoterHosting($this->getUser()->getId());
        $votesHosting =[];
        foreach ($voteHostingByThisUser as $vote){
            $votesHosting[$vote->getCandidate()->getId()]=$vote->getValue();
        }
        // for select all the hosting id where who the user is not rating them for create the modals
        $listHosting =[];
        foreach ($requests as $hosting){
            if(!in_array($hosting->getHosting()->getId(), $listHosting, true)){
                $listHosting[]= $hosting->getHosting()->getId();
            }
        }


        $hosting_requests = $paginator->paginate(
        // Doctrine Query, not results
            $requests,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            24
        );

        return $this->render('hosting/hosting_request/index.html.twig', [
            'hosting_requests' => $hosting_requests,
            'votesHosting' => $votesHosting,
            'listHosting' => $listHosting,
        ]);
    }

    /**
     * @Route("/received", name="hosting_request_received", methods={"GET"})
     * @param Request $request
     * @param HostingRequestRepository $hostingRequestRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function indexReceived(Request $request, HostingRequestRepository $hostingRequestRepository, PaginatorInterface $paginator): Response
    {
        $hostings = $hostingRequestRepository->findByHostingNotRegected($this->getUser()->getId());

        $hosting_received = $paginator->paginate(
        // Doctrine Query, not results
            $hostings,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            24
        );
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
     * @throws \Exception
     */
    public function request_treatment(HostingRequest $hostingRequest, string $type, Notification $notification): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $hostingRequest->setTreatment($type);
        $hostingRequest->setLastUpdate(new \DateTime('now'));


        $entityManager->persist($hostingRequest);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'The hosting request has bin '.$type.' ..!'
        );
        $notification->addNotification(['type' => 'treatmentHostingRequest', 'object' => $hostingRequest, 'treatment' => $type]);

        return $this->redirectToRoute('hosting_request_received');
    }

    /**
     * @Route( "/done/hosting/{hosting}",name="done_hosting", methods={"GET","POST"})
     * @param HostingRequest $hosting
     * @param Notification $notification
     * @return RedirectResponse
     * @throws \Exception
     */
    public function doneHosting(HostingRequest $hosting, Notification $notification): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if($user === $hosting->getSender()){
            $hosting->setSenderStatus(true);
            $return = $this->redirectToRoute('hosting_request_index');
            if ($hosting->getHostingStatus()){
                $hosting->getHosting()->getHosting()->setPoint($hosting->getHosting()->getHosting()->getPoint()+10);
            }
        }
        else{
            $hosting->setHostingStatus(true);

            if ($hosting->getSenderStatus()){
                $hosting->getHosting()->getHosting()->setPoint($hosting->getHosting()->getHosting()->getPoint()+10);
            }
            $return = $this->redirectToRoute('hosting_request_received');
        }

        $hosting->setLastUpdate(new \DateTime('now'));
        $entityManager->persist($hosting);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'The hosting is DONE ..!'
        );

        $notification->addNotification(['type' => 'doneHosting', 'object' => $hosting]);
        if($hosting->getSenderStatus() && $hosting->getHostingStatus()){
            $notification->addNotification(['type' => 'hostingPoints', 'user' => $hosting->getHosting(), 'number' => 'Ten']);
        }


        return $return;
    }


    /**
     * @Route("/new/hosting/{hosting}", name="hosting_request_new", methods={"GET","POST"})
     * @param Request $request
     * @param Hosting $hosting
     * @param Notification $notification
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request,Hosting $hosting, Notification $notification): Response
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
            $notification->addNotification(['type' => 'hostingRequest', 'object' => $hostingRequest]);

            return $this->redirectToRoute('hosting_request_index');
        }

        return $this->render('hosting/hosting_request/new.html.twig', [
            'hosting_request' => $hostingRequest,
            'form' => $form->createView(),
            'hosting'=>$hosting
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

        return $this->redirectToRoute('hosting_request_index');
    }

}
