<?php

namespace App\Controller\Carpool;

use App\Entity\Carpool\Voyage;
use App\Entity\Carpool\VoyageRequest;
use App\Form\Carpool\VoyageRequestType;
use App\Repository\Carpool\VoyageRepository;
use App\Repository\Carpool\VoyageRequestRepository;
use App\Service\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voyage/request")
 */
class VoyageRequestController extends AbstractController
{
    /**
     * @Route("/", name="carpool_voyage_request_index", methods={"GET"})
     */
    public function index(VoyageRequestRepository $voyageRequestRepository): Response
    {
        return $this->render('carpool/voyage_request/index.html.twig', [
            'voyage_requests' => $voyageRequestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{voyage}", name="voyage_request_new", methods={"GET","POST"})
     * @param Request $request
     * @param Voyage $voyage
     * @param Notification $notification
     * @return Response
     */
    public function new(Request $request,Voyage $voyage, Notification $notification): Response
    {
        $voyageRequest = new VoyageRequest();
        $voyageRequest->setVoyage($voyage);
        $voyageRequest->setSender($this->getUser());
        $voyageRequest->setStatus('Pending');
        $form = $this->createForm(VoyageRequestType::class, $voyageRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voyageRequest);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your voyage request has bin sent successfully!'
            );
            return $this->redirectToRoute('voyage_show',['id'=>$voyage->getId()]);
        }

        return $this->render('carpool/voyage_request/new.html.twig', [
            'voyage_request' => $voyageRequest,
            'voyage'=>$voyage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route( "/{voyageRequest}/{status}",name="treatment_voyage_request", methods={"GET","POST"})
     *
     * @param VoyageRequest $voyageRequest
     * @param string $status
     * @param VoyageRepository $repository
     * @param Notification $notification
     *
     * @return RedirectResponse
     */
    public function voyageTreatment (VoyageRequest $voyageRequest, string $status, VoyageRepository $repository, Notification $notification): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $voyage = $voyageRequest->getVoyage();

        if($status ==='Rejected'){
            $voyageRequest->setStatus('Rejected');
            $entityManager->persist($voyageRequest);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'This request was successfully rejected!'
            );
            /*$notification->addNotification(['type' => 'treatmentMeetupRequest', 'object' => $joinRequest, 'treatment' => $status]);*/

            return $this->redirectToRoute('voyage_show',['id'=>$voyage->parentVoyage()->getId()]);
        }

        $smallVoyage= $voyage->getSmallVoyages($voyageRequest->getVoyage());
        if(!empty($smallVoyage)){
            foreach ($smallVoyage as $oneVoyage){
                if($oneVoyage->getNumberOfPlaces()>0){
                    $oneVoyage->addPassenger($voyageRequest->getSender());
                    $entityManager->persist($oneVoyage);
                }

            }
        }
        //if voyage not small => have minimum 1 station or farther voyage
        if(!in_array($voyageRequest->getVoyage(), $smallVoyage, true)){
            //have minimum 1 station
            if ($voyageRequest->getVoyage()->getParent()){
                if($voyageRequest->getVoyage()->getAvailableSeats($voyageRequest->getVoyage()) >0) {
                    $voyageRequest->getVoyage()->addPassenger($voyageRequest->getSender());
                }
            }
            //farther voyage
            else{
                if(count($voyageRequest->getVoyage()->getPassenger())<$voyageRequest->getVoyage()->getNumberOfPlaces()){
                    $voyageRequest->getVoyage()->addPassenger($voyageRequest->getSender());
                }
            }
        }

        $voyagesRelated = $voyage->getVoyageRelated($voyage);
        if(!empty($voyagesRelated)) {
            foreach ($voyage->parentVoyage()->getChildren() as $child) {
                foreach ($voyagesRelated as $cityId) {
                    if ($child->getStationArrival()->getId() === $cityId) {
                        $child->setNumberOfPlaces($child->getNumberOfPlaces() - 1);
                        $entityManager->persist($child);
                    }
                }
            }
        }

        $voyageRequest->setStatus('Accepted');
        $entityManager->persist($voyageRequest);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'This request was successfully Accepted!'
        );
        /*$notification->addNotification(['type' => 'treatmentMeetupRequest', 'object' => $joinRequest, 'treatment' => $status]);*/

        return $this->redirectToRoute('voyage_show',['id'=>$voyage->parentVoyage()->getId()]);

    }

    /**
     * @Route("/{id}", name="carpool_voyage_request_delete", methods={"DELETE"})
     */
    public function delete(Request $request, VoyageRequest $voyageRequest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyageRequest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyageRequest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carpool_voyage_request_index');
    }
}
