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
            $notification->addNotification(['type' => 'voyageRequest', 'object' => $voyageRequest]);

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
            $notification->addNotification(['type' => 'treatmentVoyageRequest', 'object' => $voyageRequest, 'treatment' => $status]);

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
        $notification->addNotification(['type' => 'treatmentVoyageRequest', 'object' => $voyageRequest, 'treatment' => $status]);

        return $this->redirectToRoute('voyage_show',['id'=>$voyage->parentVoyage()->getId()]);

    }

    /**
     * @Route("/remove/passenger/{voyageRequest}", name="remove_passenger", methods={"POST"})
     * @param VoyageRequest $voyageRequest
     * @param Notification $notification
     * @return Response
     */
    public function remove_passenger(VoyageRequest $voyageRequest, Notification $notification,string $cancel = null): Response
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

        if($cancel === null){
            $carpool = $voyage->getCreator();
            if($carpool->getPoint()>9){
                $carpool->setPoint($carpool->getPoint()-10);
                $this->addFlash(
                    'danger',
                    'You lost 10 points as Carpool!'
                );
                $notification->addNotification(['type' => 'removeCarpoolPoints', 'user' => $voyage->getCreator()->getUser(), 'point'=> 10]);

            }
            else{
                $carpool->setPoint(0);
                $this->addFlash(
                    'danger',
                    'You no longer have points as Carpool!'
                );
                $notification->addNotification(['type' => 'removeCarpoolPoints', 'user' => $voyage->getCreator()->getUser(), 'point'=> 0]);

            }
            $entityManager->persist($carpool);
        }

        $entityManager->remove($voyageRequest);
        $entityManager->flush();

        if($cancel === null){
            $this->addFlash(
                'success',
                'This passenger was successfully removed!'
            );

            $notification->addNotification([
                'type' => 'voyageRemovePassenger',
                'object' => $voyageRequest->getVoyage(),
                'sender'=>$voyage->getCreator()->getUser(),
                'recipient'=>$passenger,
                'status'=>'removed'
            ]);

        }


        return $this->redirectToRoute('voyage_show',['id'=>$voyageRequest->getVoyage()->parentVoyage()->getId()]);
    }

    /**
     * @Route("/passenger/retired/{voyage}", name="cancel_joining_passenger", methods={"POST"})
     * @param Voyage $voyage
     * @param Notification $notification
     * @return Response
     */
    public function cancel_joining_passenger(Voyage $voyage, Notification $notification): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $allVoyageRequests = $voyage->getAllVoyageRequests();

        foreach ($allVoyageRequests as $voyageRequest){
            if($voyageRequest->getSender()=== $this->getUser()){
                $this->remove_passenger($voyageRequest,$notification,'cancel');
            }
        }


        if($this->getUser()->getPoint()>3){
            $this->getUser()->setPoint($this->getUser()->getPoint()-3);
            $this->addFlash(
                'danger',
                'You lost 3 points!'
            );
            $notification->addNotification(['type' => 'removeUserPoints', 'user' => $this->getUser(), 'point'=> 3]);

        }
        else{
            $this->getUser()->setPoint(0);
            $this->addFlash(
                'danger',
                'You no longer have points!'
            );
            $notification->addNotification(['type' => 'removeUserPoints', 'user' => $this->getUser(), 'point'=> 0]);
        }
        $entityManager->persist($this->getUser());
        $entityManager->flush();
        $this->addFlash(
            'success',
            'You have successfully retired from this voyage!'
        );

        $notification->addNotification([
            'type' => 'voyageRemovePassenger',
            'object' => $voyage,
            'sender'=>$this->getUser(),
            'recipient'=>$voyage->getCreator()->getUser(),
            'status'=>'retired'
        ]);

        return $this->redirectToRoute('voyage_show',['id'=>$voyage->getId()]);
    }

    /**
     * @Route("/{id}", name="carpool_voyage_request_delete", methods={"DELETE"})
     * @param Request $request
     * @param VoyageRequest $voyageRequest
     * @return Response
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
