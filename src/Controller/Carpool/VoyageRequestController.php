<?php

namespace App\Controller\Carpool;

use App\Entity\Carpool\Voyage;
use App\Entity\Carpool\VoyageRequest;
use App\Entity\User;
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
     * @param Notification $notification
     *
     * @return RedirectResponse
     */
    public function voyageTreatment (VoyageRequest $voyageRequest, string $status, Notification $notification): RedirectResponse
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

        $seats = $voyageRequest->getNumberOfSeats();
        $smallVoyage= $voyage->getSmallVoyages($voyageRequest->getVoyage());
        if(!empty($smallVoyage)){
            foreach ($smallVoyage as $oneVoyage){
                if($oneVoyage->getAvailableSeats()>0){
                    $oneVoyage->addPassenger($voyageRequest->getSender());
                    $entityManager->persist($oneVoyage);
                }

            }
        }
        if(!in_array($voyageRequest->getVoyage(), $smallVoyage, true)){
            if($voyageRequest->getVoyage()->getAvailableSeats() >0) {
                $voyageRequest->getVoyage()->addPassenger($voyageRequest->getSender());
            }
        }

        $voyagesRelated = $voyage->getVoyageRelated($voyage);
        if(!empty($voyagesRelated)) {
            $mainSeats =[];
            if(!empty($voyage->parentVoyage()->getChildren()->toArray())){
                foreach ($voyage->parentVoyage()->getChildren() as $child) {
                    foreach ($voyagesRelated as $cityId) {
                        if ($child->getStationArrival()->getId() === $cityId) {
                            $child->setAvailableSeats($child->getAvailableSeats() - $seats);
                            $entityManager->persist($child);
                        }
                    }
                    $mainSeats[] = $child->getAvailableSeats();
                }
            }
            else{
                $voyage->parentVoyage()->setAvailableSeats($voyage->parentVoyage()->getAvailableSeats() - $seats);
                $mainSeats[] = $voyage->parentVoyage()->getAvailableSeats();
            }

            $main = min($mainSeats);
            $voyageRequest->getVoyage()->parentVoyage()->setAvailableSeats($main);
            $entityManager->persist($voyageRequest->getVoyage()->parentVoyage());
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
     * @Route("/remove/passenger/{voyageRequest}", name="remove_passenger", methods={"POST"})
     * @param VoyageRequest $voyageRequest
     * @param User $passenger
     * @return Response
     */
    public function remove_passenger(VoyageRequest $voyageRequest): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $voyage = $voyageRequest->getVoyage();
        $passenger= $voyageRequest->getSender();
        $seats = $voyage->getPassengerSeats($passenger);
        $smallVoyage= $voyage->getSmallVoyages($voyage);
        if(!empty($smallVoyage)){
            foreach ($smallVoyage as $oneVoyage){
                    $oneVoyage->removePassenger($passenger);
                    $entityManager->persist($oneVoyage);
            }
        }
        if(!in_array($voyage, $smallVoyage, true)){
            $voyage->removePassenger($passenger);
        }

        $voyagesRelated = $voyage->getVoyageRelated($voyage);
        if(!empty($voyagesRelated)) {
            $mainSeats =[];
            if(!empty($voyage->parentVoyage()->getChildren()->toArray())) {
                foreach ($voyage->parentVoyage()->getChildren() as $child) {
                    foreach ($voyagesRelated as $cityId) {
                        if ($child->getStationArrival()->getId() === $cityId) {
                            $child->setAvailableSeats($child->getAvailableSeats() +$seats);
                            $entityManager->persist($child);
                        }
                    }
                    $mainSeats[]= $child->getAvailableSeats();
                }
            }
            else{
                $voyage->parentVoyage()->setAvailableSeats($voyage->parentVoyage()->getAvailableSeats() + $seats);
                $mainSeats[] = $voyage->parentVoyage()->getAvailableSeats();
            }

            $main = min($mainSeats);
            $voyageRequest->getVoyage()->parentVoyage()->setAvailableSeats($main);
            $entityManager->persist($voyageRequest->getVoyage()->parentVoyage());
        }

            $entityManager->remove($voyageRequest);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'This passenger was successfully removed!'
            );


        return $this->redirectToRoute('voyage_show',['id'=>$voyageRequest->getVoyage()->parentVoyage()->getId()]);
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
            $this->addFlash(
                'success',
                'Your request was successfully deleted!'
            );
        }

        return $this->redirectToRoute('voyage_show',['id'=>$voyageRequest->getVoyage()->parentVoyage()->getId()]);
    }
}
