<?php

namespace App\Controller\Carpool;

use App\Entity\Carpool\Carpool;
use App\Entity\Carpool\Voyage;
use App\Form\Carpool\VoyageFirstType;
use App\Form\Carpool\VoyageSecondType;
use App\Form\Carpool\VoyageType;
use App\Repository\Carpool\VoyageRepository;
use App\Repository\Carpool\VoyageRequestRepository;
use App\Repository\Location\CityRepository;
use App\Repository\Rating\RatingRepository;
use App\Repository\Rating\VoteRepository;
use App\Service\Notification;
use DateInterval;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Time;

/**
 * @Route("/voyage")
 */
class VoyageController extends AbstractController
{
    private $ratingRepository;

    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }
    /**
     * @Route("/myvoyage", name="voyage_index", methods={"GET"})
     * @param VoyageRepository $voyageRepository
     * @param VoteRepository $voteRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(VoyageRepository $voyageRepository, VoteRepository $voteRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $user = $this->getUser();
        $voyageRequestsPassenger = $user->getVoyageRequests()->toArray();
        $voyagesPassenger = [];
        $listCarpool=[];


        $voteCarpoolByThisUser = $voteRepository->findByVoterCarpool($this->getUser()->getId());
        $votesVoyage =[];
        foreach ($voteCarpoolByThisUser as $vote){
            $votesVoyage[$vote->getCandidate()->getId()]=$vote->getValue();
        }

        foreach ($voyageRequestsPassenger as $voyageRequest){
            $voyagesPassenger[]=$voyageRequest->getVoyage();

            // for select all the carpool id where who the user is not rating them for create the modals
            if(!in_array($voyageRequest->getVoyage()->getCreator()->getUser()->getId(), $listCarpool, true)){
                $listCarpool[]= $voyageRequest->getVoyage()->getCreator()->getUser()->getId();
            }
        }

        if($user->getCarpool()){
            $voyagesOrganized = $voyageRepository->findParentByCreator($this->getUser()->getCarpool()->getId());
            $voyages = array_merge($voyagesPassenger, $voyagesOrganized);
        }else{
            $voyages =  $voyagesPassenger;
        }

        $ratingList = [];
        foreach ($voyages as $voyage){
            $ratingList[$voyage->getId()]= $this->getCarpoolRating($voyage);
        }

        $results = $paginator->paginate(
        // Doctrine Query, not results
            $voyages,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );
        return $this->render('carpool/voyage/index.html.twig', [
            'voyages' => $results,
            'listCarpool'=>$listCarpool,
            'votesVoyage'=>$votesVoyage,
            'ratingList'=>$ratingList
        ]);
    }

    public function createTime(\DateTimeInterface $date,\DateTimeInterface $time,int $duration1, int $duration2): \DateTime
    {
        $year = $date->format('Y');
        $month = $date->format('m');
        $day = $date->format('d');
        $datetime = new \DateTime();
        $datetime->setDate($year,$month,$day);
        $hours=$time->format('H');
        $minutes=$time->format('i');
        $second=$time->format('s');
        $datetime->setTime($hours,$minutes,$second);
        $duration = $duration1+$duration2;
        try {
            $datetime->add(new DateInterval('PT' . $duration . 'S'));
        } catch (\Exception $e) {
        }
        return $datetime;
    }


    /**
     * @Route("/new/{type}", name="voyage_new", methods={"Get","POST"})
     * @param Request $request
     * @param string $type
     * @param CityRepository $repo
     * @return Response
     * @throws \Exception
     */
    public function newVoyage(Request $request,string $type,CityRepository $repo): Response
    {
        $session = new Session();

        $voyage = new Voyage();
        $form = $this->createForm(VoyageFirstType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $i = 1;
            foreach ($voyage->getStations() as $station) {
                $station->setSort($i);
                $i++;
            }
            $serializedVoyage = $voyage->serializer();
            $session->set('voyage', $serializedVoyage);
            return $this->redirectToRoute('voyage_new',['type'=>'second']);
        }

        if ($type ==='second'){
            $serializedVoyage = $session->get('voyage');
            $newVoyage = new Voyage();
            $newVoyage->normalizer($serializedVoyage,$repo);
            $stations= $newVoyage->getStations()->toArray();

            if($serializedVoyage === null){
                return $this->render('carpool/voyage/newFirst.html.twig', [
                    'voyage' => $voyage,
                    'form' => $form->createView(),
                ]);
            }
            $partialVoyages =$this->createPartialVoyages($newVoyage,$stations);
            $secondForm = $this->createForm(VoyageSecondType::class, $newVoyage);

            $fields = [];
            foreach ($stations as $i=>$iStation){
                $fields[]='partialPrice_'.$i;
                if($i === count($stations)-1){
                    $fields[]='partialPrice_'.($i+1);
                }
            }
            foreach ($fields as $i=>$iField){
                $secondForm->add($fields[$i],IntegerType::class,[
                    'mapped'=>false,
                    'label'=> false,
                    'attr' => array('min' => '1','max'=>200,'placeholder'=>'Price')
                ]);
            }
            $secondForm->handleRequest($request);

                if ($secondForm->isSubmitted() && $secondForm->isValid()) {


                    $entityManager = $this->getDoctrine()->getManager();
                    $timeNewVoyage = $newVoyage->getTime();
                    $dateNewVoyage = $newVoyage->getDate();
                    $newVoyage->setCreator($this->getUser()->getCarpool());
                    $newVoyage->setStationPrice(0);
                    $newVoyage->setStationDeparture($newVoyage->getMainDeparture());
                    $newVoyage->setStationArrival($newVoyage->getMainArrival());
                    $newVoyage->setTimeDeparture($this->createTime($dateNewVoyage,$timeNewVoyage,0,0));
                    $newVoyage->setTimeArrival($this->createTime($dateNewVoyage,$timeNewVoyage,$newVoyage->getDuration(),0));
                    $newVoyage->setAvailableSeats($newVoyage->getNumberOfPlaces());

                    $newStations= $newVoyage->getStations()->toArray();

                    $priceToArrival = 0;
                    $count = count($newStations);
                    foreach ($newStations as $i=>$iStation){
                        if($i === $count-1 ){
                            $iStation->setPrice($secondForm->get('partialPrice_'.$i)->getData());
                            $priceToArrival = $secondForm->get('partialPrice_'.($i+1))->getData();
                        }
                        $iStation->setPrice($secondForm->get('partialPrice_'.$i)->getData());
                    }
                            foreach ($newStations as $station){
                                $one = true;
                                for($i=$count-1;$i>=$station->getSort()-1;$i--){
                                    if($station->getCity()!== $newStations[$i]->getCity()){
                                        $stationVoyage = new Voyage();
                                        $stationVoyage->setCreator($this->getUser()->getCarpool());
                                        $stationVoyage->setMainDeparture($newVoyage->getMainDeparture());
                                        $stationVoyage->setMainArrival($newVoyage->getMainArrival());
                                        $stationVoyage->setDate($newVoyage->getDate());
                                        $stationVoyage->setTime($newVoyage->getTime());
                                        $stationVoyage->setMainPrice(0);
                                        $stationVoyage->setDuration($newVoyage->getDuration());
                                        $stationVoyage->setDistance($newVoyage->getDistance());
                                        $stationVoyage->setHighway($newVoyage->getHighway());
                                        $stationVoyage->setPlaceMainDeparture($newVoyage->getPlaceMainDeparture());
                                        $stationVoyage->setPlaceMainArrival($newVoyage->getPlaceMainArrival());
                                        $stationVoyage->setParent($newVoyage);
                                        $stationVoyage->setNumberOfPlaces($newVoyage->getNumberOfPlaces());
                                        $stationVoyage->setAvailableSeats($newVoyage->getNumberOfPlaces());


                                        $stationVoyage->setStationDeparture($station->getCity());
                                        $stationVoyage->setStationArrival($newStations[$i]->getCity());
                                        $stationVoyage->setPlaceStationDeparture($station->getPlace());
                                        $stationVoyage->setPlaceStationArrival($newStations[$i]->getPlace());

                                        $price = 0;
                                        $duration=0;
                                        $distance=0;
                                        $stationBeforeDurations=0;
                                        foreach ($newStations as $item){
                                            $start = $station->getSort();
                                            $end = $newStations[$i]->getSort();
                                            $sort = $item->getSort();
                                            if($sort>$start && $sort<=$end){
                                                $price += $item->getPrice();
                                                $duration += $item->getDuration();
                                                $distance += $item->getDistance();
                                            }
                                            if($sort<=$start){
                                                $stationBeforeDurations+=$item->getDuration();
                                            }
                                        }

                                        $stationVoyage->setStationPrice($price);
                                        $stationVoyage->setStationDistance($distance);
                                        $stationVoyage->setStationDuration($duration);
                                        $stationVoyage->setTimeDeparture($this->createTime($dateNewVoyage,$timeNewVoyage,$stationBeforeDurations,0));
                                        $stationVoyage->setTimeArrival($this->createTime($dateNewVoyage,$timeNewVoyage,$stationBeforeDurations,$duration));
                                        $entityManager->persist($stationVoyage);
                                    }


                                    //befor
                                    if($one){
                                        $beforeVoyage = new Voyage();
                                        $beforeVoyage->setCreator($this->getUser()->getCarpool());
                                        $beforeVoyage->setMainDeparture($newVoyage->getMainDeparture());
                                        $beforeVoyage->setMainArrival($newVoyage->getMainArrival());
                                        $beforeVoyage->setDate($newVoyage->getDate());
                                        $beforeVoyage->setTime($newVoyage->getTime());
                                        $beforeVoyage->setMainPrice(0);
                                        $beforeVoyage->setDuration($newVoyage->getDuration());
                                        $beforeVoyage->setDistance($newVoyage->getDistance());
                                        $beforeVoyage->setHighway($newVoyage->getHighway());
                                        $beforeVoyage->setPlaceMainDeparture($newVoyage->getPlaceMainDeparture());
                                        $beforeVoyage->setPlaceMainArrival($newVoyage->getPlaceMainArrival());
                                        $beforeVoyage->setParent($newVoyage);
                                        $beforeVoyage->setNumberOfPlaces($newVoyage->getNumberOfPlaces());
                                        $beforeVoyage->setAvailableSeats($newVoyage->getNumberOfPlaces());



                                        $beforeVoyage->setStationDeparture($newVoyage->getMainDeparture());
                                        $beforeVoyage->setStationArrival($station->getCity());
                                        $beforeVoyage->setPlaceStationDeparture($newVoyage->getPlaceMainDeparture());
                                        $beforeVoyage->setPlaceStationArrival($station->getPlace());

                                        $beforePrice = 0;
                                        $beforeDistance = 0;
                                        $beforeDuration = 0;
                                        $beforeBeforeDurations=0;

                                        foreach ($newStations as $item){
                                            $end = $station->getSort();
                                            $sort = $item->getSort();
                                            if( $sort<= $end){
                                                $beforePrice += $item->getPrice();
                                                $beforeDuration += $item->getDuration();
                                                $beforeDistance += $item->getDistance();
                                            }
                                           /* if($sort<=$end){
                                                $beforeBeforeDurations+=$item->getDuration();
                                            }*/
                                        }

                                        $beforeVoyage->setStationPrice($beforePrice);
                                        $beforeVoyage->setStationDuration($beforeDuration);
                                        $beforeVoyage->setStationDistance($beforeDistance);
                                        $beforeVoyage->setTimeDeparture($this->createTime($dateNewVoyage,$timeNewVoyage,0,0));
                                        $beforeVoyage->setTimeArrival($this->createTime($dateNewVoyage,$timeNewVoyage,0,$beforeDuration));

                                        //after
                                        $afterVoyage = new Voyage();
                                        $afterVoyage->setCreator($this->getUser()->getCarpool());
                                        $afterVoyage->setMainDeparture($newVoyage->getMainDeparture());
                                        $afterVoyage->setMainArrival($newVoyage->getMainArrival());
                                        $afterVoyage->setDate($newVoyage->getDate());
                                        $afterVoyage->setTime($newVoyage->getTime());
                                        $afterVoyage->setMainPrice(0);
                                        $afterVoyage->setDuration($newVoyage->getDuration());
                                        $afterVoyage->setDistance($newVoyage->getDistance());
                                        $afterVoyage->setHighway($newVoyage->getHighway());
                                        $afterVoyage->setPlaceMainDeparture($newVoyage->getPlaceMainDeparture());
                                        $afterVoyage->setPlaceMainArrival($newVoyage->getPlaceMainArrival());
                                        $afterVoyage->setParent($newVoyage);
                                        $afterVoyage->setNumberOfPlaces($newVoyage->getNumberOfPlaces());
                                        $afterVoyage->setAvailableSeats($newVoyage->getNumberOfPlaces());


                                        $afterVoyage->setStationDeparture($station->getCity());
                                        $afterVoyage->setStationArrival($newVoyage->getMainArrival());
                                        $afterVoyage->setPlaceStationDeparture($station->getPlace());
                                        $afterVoyage->setPlaceStationArrival($newVoyage->getPlaceMainArrival());


                                        $afterDuration=0;
                                        $afterDistance=0;

                                        $restDuration=0;
                                        $restDistance=0;

                                        $afterPrice=0;
                                        $afterBeforeDurations=0;
                                        foreach ($newStations as $item){
                                            $start = $station->getSort();
                                            $sort = $item->getSort();
                                            if( $sort > $start){
                                                $afterPrice += $item->getPrice();
                                                $afterDuration += $item->getDuration();
                                                $afterDistance += $item->getDistance();
                                            }
                                            $restDuration+=$item->getDuration();
                                            $restDistance+=$item->getDistance();

                                            if($sort<=$start){
                                                $afterBeforeDurations+=$item->getDuration();
                                            }
                                        }

                                        $lastDuration = $newVoyage->getDuration()-$restDuration;
                                        $lastDistance = $newVoyage->getDistance()-$restDistance;
                                        $afterVoyage->setStationPrice($priceToArrival+$afterPrice);
                                        $afterVoyage->setStationDistance($lastDistance+$afterDistance);
                                        $afterVoyage->setStationDuration($lastDuration+$afterDuration);

                                        $afterVoyage->setTimeDeparture($this->createTime($dateNewVoyage,$timeNewVoyage,$afterBeforeDurations,0));
                                        $afterVoyage->setTimeArrival($this->createTime($dateNewVoyage,$timeNewVoyage,$newVoyage->getDuration(),0));



                                        $entityManager->persist($beforeVoyage);
                                        $entityManager->persist($afterVoyage);

                                        $one = false;
                                    }
                                }
                            }

                            $entityManager->persist($newVoyage);

                            $entityManager->flush();
                            $session->remove('voyage');
                            $this->addFlash(
                                'success',
                                'Your voyage was successfully added!'
                            );
                    return $this->redirectToRoute('voyage_index');

                }

            return $this->render('carpool/voyage/newSecond.html.twig', [
                'voyage' => $newVoyage,
                'partialVoyages' => $partialVoyages,
                'secondForm' => $secondForm->createView(),
            ]);
        }

        return $this->render('carpool/voyage/newFirst.html.twig', [
            'voyage' => $voyage,
            'form' => $form->createView(),
        ]);
    }

    public function createPartialVoyages(Voyage $voyage, array $stations): array
    {
        $partialVoyages =[];
        $i = 1;
        foreach ($stations as $station) {
            $station->setVoyage($voyage);
            $station->setSort($i);
            $i++;
        }
        $count = count($stations);
        if($count ===1){
            $partialVoyages[]= ['from'=>$voyage->getMainDeparture()->getName(),'to'=>$stations[0]->getCity()->getName(),
                'distance'=>$stations[0]->getDistance(),'duration'=> gmdate('H:i', $stations[0]->getDuration())];
            $partialVoyages[]= ['from'=>$stations[0]->getCity()->getName(),'to'=>$voyage->getMainArrival()->getName(),
                'distance'=>$voyage->getDistance()-$stations[0]->getDistance(),'duration'=>
                    gmdate('H:i', $voyage->getDuration() - $stations[0]->getDuration())];

        }
        else{
            foreach ($stations as $i => $iValue) {
                if($i === 0){
                    $partialVoyages[]= ['from'=>$voyage->getMainDeparture()->getName(),'to'=> $iValue->getCity()->getName(),
                        'distance'=>$iValue->getDistance(),'duration'=> gmdate('H:i', $iValue->getDuration())];
                }
                elseif($i === $count-1){
                    $restDuration=0;
                    $restDistance=0;
                    for ($x=0;$x<=$count-1;$x++){
                        $restDistance+=$stations[$x]->getDistance();
                        $restDuration+=$stations[$x]->getDuration();
                    }
                    $partialVoyages[]= ['from'=>$stations[$i-1]->getCity()->getName(),'to'=> $iValue->getCity()->getName(),
                        'distance'=>$iValue->getDistance(),'duration'=> gmdate('H:i', $iValue->getDuration())];
                    $partialVoyages[]= ['from'=> $iValue->getCity()->getName(),'to'=>$voyage->getMainArrival()->getName(),
                        'distance'=>$voyage->getDistance()-$restDistance,'duration'=> gmdate('H:i', $voyage->getDuration()-$restDuration)];
                }
                else{
                    $partialVoyages[]= ['from'=>$stations[$i-1]->getCity()->getName(),'to'=> $iValue->getCity()->getName(),
                        'distance'=>$iValue->getDistance(),'duration'=> gmdate('H:i', $iValue->getDuration())];
                }
            }
        }
        return $partialVoyages;
    }

    /**
     * @Route("/{id}", name="voyage_show", methods={"GET"}, options={"expose"=true})
     * @param Voyage $voyage
     * @param RatingRepository $repository
     * @return Response
     */
    public function show(Voyage $voyage): Response
    {
        $rating = $this->getCarpoolRating($voyage);
        $smallVoyages = $voyage->getSmallVoyages($voyage->parentVoyage());
        return $this->render('carpool/voyage/show.html.twig', [
            'voyage' => $voyage,
            'smallVoyages'=>$smallVoyages,
            'rating'=>$rating
        ]);
    }

    public function getCarpoolRating(Voyage $voyage){
        $rating = $this->ratingRepository->findByTypeAndCandidate('carpool', $voyage->getCreator()->getUser()->getId());
        if($rating){
            $number = $rating->getTotal()/$rating->getNumVotes();
            return number_format($number, 1);
        }
        return(0);
    }

    /**
     * @Route("/{id}", name="voyage_delete", methods={"DELETE"})
     * @param Request $request
     * @param Voyage $voyage
     * @param Notification $notification
     * @return Response
     */
    public function delete(Request $request, Voyage $voyage, Notification $notification): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $children = $voyage->parentVoyage()->getChildren()->toArray();
        $passengers = [];
        foreach ( $children as $child){
            foreach ($child->getPassenger()->toArray() as $passenger){
                if(!in_array($passenger,$passengers,true)){
                    $passengers[] = $passenger;
                }
            }
        }
        foreach ($voyage->getPassenger()->toArray() as $passenger){
            if(!in_array($passenger,$passengers,true)){
                $passengers[] = $passenger;
            }
        }

        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
           if(empty($passengers) || $voyage->isFinish() ){
               $this->removeVoyage($voyage);
               $this->addFlash(
                   'success',
                   'Your voyage was successfully removed!'
               );
               return $this->redirectToRoute('voyage_index');
           }

           foreach ($passengers as $passenger){
               $notification->addNotification(['type' => 'cancelVoyage', 'object' => $voyage, 'recipient'=>$passenger]);
               $passenger->setPoint($passenger->getPoint()+5);
               $entityManager->persist($passenger);
               $notification->addNotification(['type' => 'pointsVoyageCanceled', 'recipient'=>$passenger, 'points'=>5]);
           }
            $carpool = $voyage->getCreator();
            if($carpool && $carpool->getPoint()>39){
                $carpool->setPoint($carpool->getPoint()-40);
                $entityManager->persist($carpool);
                $notification->addNotification(['type' => 'removeCarpoolPoints', 'user' => $voyage->getCreator()->getUser(), 'point'=> 40]);
            }
            else{
                $carpool->setPoint(0);
                $entityManager->persist($carpool);
                $notification->addNotification(['type' => 'removeCarpoolPoints', 'user' => $voyage->getCreator()->getUser(), 'point'=> 0]);
            }
            $entityManager->flush();
            $this->removeVoyage($voyage);
            $this->addFlash(
                'success',
                'Your voyage was successfully removed!'
            );
            return $this->redirectToRoute('voyage_index');
        }

        return $this->redirectToRoute('voyage_index');
    }

    public function removeVoyage(Voyage $voyage): void
    {
        $entityManager = $this->getDoctrine()->getManager();

        $stations = $voyage->parentVoyage()->getStations()->toArray();
        foreach ($stations as $station){
            $entityManager->remove($station);
        }

        $children = $voyage->parentVoyage()->getChildren()->toArray();
        foreach ($children as $child){
            $entityManager->remove($child);
        }
        $entityManager->remove($voyage);
        $entityManager->flush();
    }


}