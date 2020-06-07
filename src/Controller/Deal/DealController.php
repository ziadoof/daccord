<?php

namespace App\Controller\Deal;

use App\Controller\DriverRequestController;
use App\Entity\Ads\Ad;
use App\Entity\Ads\Category;
use App\Entity\Ads\Specification;
use App\Entity\Deal\Deal;
use App\Entity\Deal\DoneDeal;
use App\Entity\DriverRequest;
use App\Form\Deal\DealType;
use App\Repository\Deal\DealRepository;
use App\Repository\Deal\DoneDealRepository;
use App\Repository\DriverRepository;
use App\Repository\DriverRequestRepository;
use App\Repository\Rating\VoteRepository;
use App\Repository\UserRepository;
use App\Service\Notification;
use Doctrine\Common\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use PhpParser\Node\Expr\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/deal")
 */
class DealController extends AbstractController
{
    /**
     * @Route("/", name="deal_index", methods={"GET","POST"})
     * @param Request $request
     * @param DoneDealRepository $doneDealRepository
     * @param PaginatorInterface $paginator
     * @param UserRepository $userRepository
     * @param VoteRepository $voteRepository
     * @return Response
     */
    public function index(Request $request, DoneDealRepository $doneDealRepository, PaginatorInterface $paginator, UserRepository $userRepository, VoteRepository $voteRepository): Response
    {

        $user = $this->getUser();
        $deals = $user->getDeals();
        $doneDeals = $doneDealRepository->findByUser($user);
        $pendingDeals = [];
        $suggestedDeals = [];
        $dealsGroup=[];
        foreach ($deals as $pendingDeal){
            if($pendingDeal->getOfferUser()===$user && $pendingDeal->getOfferUserStatus()){
                $pendingDeals []= $pendingDeal;
            }
            elseif($pendingDeal->getDemandUser()===$user && $pendingDeal->getDemandUserStatus()){
                $pendingDeals []= $pendingDeal;
            }
            else{
                $suggestedDeals [] = $pendingDeal;
            }
        }

        usort($pendingDeals, function ($a, $b)
        {
            if ($a->getSuggestionDate() == $b->getSuggestionDate()) {
                return 0;
            }
            return ($a->getSuggestionDate() > $b->getSuggestionDate()) ? -1 : 1;
        });

        usort($doneDeals, function ($a, $b)
        {
            if ($a->getDate() == $b->getDate()) {
                return 0;
            }
            return ($a->getDate() > $b->getDate()) ? -1 : 1;
        });

        foreach ($pendingDeals as $oneDeal){
            $dealsGroup[] = $oneDeal;
        }
        foreach ($doneDeals as $oneDeal){
            $dealsGroup[] = $oneDeal;
        }

        $dealsGroupPage = $paginator->paginate(
        // Doctrine Query, not results
            $dealsGroup,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            18
        );
        $suggestedDealsPage = $paginator->paginate(
        // Doctrine Query, not results
            $suggestedDeals,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            18
        );

        $voteDriversByThisUser = $voteRepository->findByVoter($this->getUser()->getId());
        $votesDrivers =[];
        foreach ($voteDriversByThisUser as $vote){
            $votesDrivers[$vote->getCandidate()->getId()]=$vote->getValue();
        }
        // for select all the driver id where who the user is not rating them for create the modals
        $listDriverModel =[];
        foreach ($doneDeals as $doneDeal){
            if($doneDeal->getDriverUser()){
                if(!in_array($doneDeal->getDriverUser()->getId(), $listDriverModel, true)){
                    $listDriverModel[]= $doneDeal->getDriverUser()->getId();
                }
            }
        }

        return $this->render('deal/index.html.twig', [
            'votesDriver'=> $votesDrivers,
            'listDriverModel'=>$listDriverModel,
            'suggestedDeals' => $suggestedDealsPage,
            'pendingDeals' => $pendingDeals,
            'doneDeals' => $doneDeals,
            'dealsGroup'=> $dealsGroupPage
        ]);
    }

    /**
     * @Route("/{id}", name="deal_show", methods={"GET","POST"})
     * @param Deal $deal
     * @param DriverRepository $driverRepository
     * @return Response
     */
    public function show(Deal $deal, DriverRepository $driverRepository): Response
    {
        if(!$deal){
            throw $this->createNotFoundException('The deal does not exist');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $offerUser = $deal->getOfferUser();
        $demandUser= $deal->getDemandUser();
        $driverUser= $deal->getDriverUser();

        // set new
        $user = $this->getUser();
        if($user === $offerUser && $deal->isNew($offerUser)){
            $deal->setOfferNew(false);
            $entityManager->persist($deal);
            $entityManager->flush();
        }
        if($user === $demandUser && $deal->isNew($demandUser)){
            $deal->setDemandNew(false);
            $entityManager->persist($deal);
            $entityManager->flush();
        }

        if($driverUser){
            $users = [$offerUser, $demandUser, $driverUser];
        }
        else{
            $users = [$offerUser, $demandUser];
        }
        $specification = $this->specificationDeal($deal->getOffer(), $deal->getDemand());
        $withOutDrivers = ['Jobs and services','Residence','Holidays'];
        $drivers = $this->getDriversArea($deal,$driverRepository);

        if(in_array($deal->getCategory()->getParent()->getName(),$withOutDrivers,true ) ){
            $drivers = null;
        }

        if (in_array($this->getUser(),$users,true)){
            return $this->render('deal/show.html.twig', [
                'specification'=>$specification,
                'drivers'=> $drivers,
                'deal' => $deal,
            ]);
        }
        else{
            throw $this->createNotFoundException('The deal does not exist');
        }

    }

    /**
     * @Route("/{id}", name="deal_delete", methods={"DELETE"})
     * @param Request $request
     * @param Deal $deal
     * @param DriverRequestRepository $driverRequestRepository
     * @param Notification $notification
     * @return Response
     */
    public function delete(Request $request, Deal $deal, DriverRequestRepository $driverRequestRepository, Notification $notification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deal->getId(), $request->request->get('_token'))) {
            $driverRequests = $driverRequestRepository->findByDeal($deal);
            $user = $this->getUser();
            $entityManager = $this->getDoctrine()->getManager();
            if($deal->getDriverUser()){
                if ($user === $deal->getDemandUser()){
                    $point = $deal->getDemandUser()->getPoint();
                    if($point <10){
                        $user->setPoint(0);
                    }
                    else{
                        $user->setPoint($user->getPoint()-10);
                    }
                    $entityManager->persist($user);
                    $notification->addNotification(['type' => 'lostPoints', 'user' => $deal->getDemandUser(), 'point' => 10]);
                }
                 foreach ($driverRequests as $driverRequest){
                     $entityManager->remove($driverRequest);
                 }
                $notification->addNotification(['type' => 'dealCancel', 'recipient' => $deal->getDriverUser(), 'sender'=>$user, 'category'=>$deal->getCategory()->getName()]);

                // notification for driver that the deal is canceled
            }
            else{
                foreach ($driverRequests as $driverRequest){
                    $entityManager->remove($driverRequest);

                }
            }
            $entityManager->flush();
            $entityManager->remove($deal);
            $entityManager->flush();
               $this->addFlash(
                'success',
                'Your deal has been deleted!'
            );
        }
        if($this->getUser()->isAdmin()){
            return $this->redirectToRoute('admin_deals');
        }
        return $this->redirectToRoute('deal_index');
    }

    /**
     *
     * @param Ad $offer
     * @param Ad $demand
     * @return array
     */
    public function specificationDeal(Ad $offer, Ad $demand):array
    {
        $result = [];

        $offerSpecifications = $offer->getCategory()->getSpecifications();

        $offerDealSpecification = $offer->getDealSpecifications();
        $demandDealSpecification = $demand->getDealSpecifications();

        $offerFixed = $this->fixSpecifications($offerDealSpecification,$offer->getCategory()->getName());
        $demandFixed = $this->fixSpecifications($demandDealSpecification, $demand->getCategory()->getName());

        $demandDealSpecificationFixed = $this->fixDemandDealSpecification($demandFixed);

        foreach ($offerSpecifications as $specification){
                $result[$specification->getLabel()]=[
                    'offer' =>  $offerFixed[$specification->getName()]  ? $offerFixed[$specification->getName()]:'Undefined',
                    'demand'=>  $demandDealSpecificationFixed[$specification->getName()] ? $demandDealSpecificationFixed[$specification->getName()]:'Undefined',
                ];
        }
        return $result;
    }

    /**
     * @param array $ar
     * @return array
     * fixed array for convent max min
     */
    public function fixDemandDealSpecification(array $ar): array
    {
        $fixed = [];
        $range =[
            'manufacturingYear' => ['min'=>'minManufacturingYear','max'=>'maxManufacturingYear'],
            'kilometer' => ['min'=>'minKilometer','max'=>'maxKilometer'],
            'capacity' => ['min'=>'minCapacity','max'=>'maxCapacity'],
            'area' => ['min'=>'minArea','max'=>'maxArea'],
        ];
        $minValue = ['numberOfRooms','salary','numberOfPassengers','numberOfDoors','ram','accuracy','number','numberOfPersson',
                'numberOfDrawer','numberOfStaging','numberOfHead','levelOfStudent'];
        $maxValue =['age','paperSize','classEnergie','ges','weight','experience','generalSituation'];
        foreach ($ar as $key=>$value){
            if(array_key_exists($key,$range)){
                $min = $ar[$range[$key]['min']];
                $max = $ar[$range[$key]['max']];
                if($min && $max){
                    $item = $min.' - '.$max;
                }
                elseif (!$min && $max){
                    $item = $max.'(Max)';
                }
                elseif ($min && !$max){
                    $item = $min.'(Min)';
                }
                elseif ($ar[$key]){
                    $item = $ar[$key];
                }
                else{
                    $item = 'Undefined';
                }
                $fixed[$key]=$item;
            }
            elseif (in_array($key,$minValue)){
                if($value){
                    $fixed[$key]=$value.'(Min)';
                }
                else{
                    $fixed[$key]='Undefined';
                }
            }
            elseif (in_array($key,$maxValue)){
                if($value){
                    $fixed[$key]=$value.'(Max)';
                }
                else{
                    $fixed[$key]='Undefined';
                }
            }
            else{
                $fixed[$key]=$value;
            }
        }
        return $fixed;
    }

    public function fixSpecifications ($allSpecifications, string $category){
        $classEnergieAndGes=[1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G'];
        $paperSize=[1=>'4A0',2=>'2A0',3=>'A0',4=>'A1',5=>'A2',6=>'A3',7=>'A4',8=>'A5',9=>'A6',10>'A7',11=>'A8',12=>'A9',13=>'A10'];
        $experience=[0=>'Not required',1=>'1 YEAR',2=>'2 YEARS' ,3=>'3 YEARS' ,4=>'4 YEARS' ,5=>'5 YEARS' ,6=>'+ 5 YEARS'];
        $levelOfStudent=[1=>'Maternal school',2=>'Middle school',3=>'High school',4=>'Universities',5=>'Professional'];
        $capacityLitre = [1=>'Less than 50 Liters',2 =>'50-80 Liters',3 =>'80-150 Liters',4 =>'150-250 Liters',5 =>'250-330 Liters',6 =>'330-490 Liters',7 =>'More than 50 Liters'];
        $boolean = [0=>'No',1=>'Yes'];
        $generalSituation = [1=>'Damaged' ,2 =>'Medium' , 3 =>'Good' ,4 => 'Semi-new',5=> 'Totally new'];
        $checkbox = ['hdmi','cdRoom', 'wifi', 'usb', 'threeInOne', 'accessories', 'withFreezer', 'electricHead',
            'withOven', 'covered', 'withFurniture', 'withGarden', 'withVerandah', 'withElevator'];
/*        $category = $allSpecifications['category']->getName();*/

        foreach ($allSpecifications as $key=>$value){
            if($key === 'donate') {
                if (true === $value) {
                    $allSpecifications[$key] = 'Yes';
                } else {
                    $allSpecifications[$key] = 'No';
                }
            }
            if($value){
            switch ($key){
                case 'classEnergie':
                case 'ges':
                    $allSpecifications[$key] = $classEnergieAndGes[$value];
                    break;
                case 'experience':
                    $allSpecifications[$key] = $experience[$value];
                    break;
                case 'paperSize':
                    $allSpecifications[$key] = $paperSize[$value];
                    break;
                case 'levelOfStudent':
                    $allSpecifications[$key] = $levelOfStudent[$value];
                    break;
                case 'generalSituation':
                    $allSpecifications[$key] = $generalSituation[$value];
                    break;
            }
            if(in_array($key,$checkbox)){
                $allSpecifications[$key] = $boolean[$value];
            }
            if($key === 'capacity' && $category === 'Refrigerator'){
                $allSpecifications[$key] = $capacityLitre[$value];
            }}
        }
        return $allSpecifications;
    }

    public function getDriversArea(Deal $deal, $driverRepo){
        $latOffer = $deal->getOfferUser()->getMapY();
        $lngOffer = $deal->getOfferUser()->getMapX();
        $latDemand = $deal->getDemandUser()->getMapY();
        $lngDemand = $deal->getDemandUser()->getMapX();
        $offerUser = $deal->getOfferUser();
        $demandUser= $deal->getDemandUser();

        $drivers = $driverRepo->findByArea($latOffer, $lngOffer, $latDemand, $lngDemand, $offerUser, $demandUser);
       return $drivers;
    }

    /**
     * @Route( "/{deal}/{driverRequest}",name="driver_request_add", methods={"GET","POST"})
     * @param DriverRequest $driverRequest
     * @param Deal $deal
     * @param DriverRequestRepository $driverRequestRepository
     * @param Notification $notification
     * @return RedirectResponse
     */
    public function add_driver_to_deal(DriverRequest $driverRequest, Deal $deal, DriverRequestRepository $driverRequestRepository, Notification $notification): RedirectResponse
    {
        $driver = $driverRequest->getDriver();
        if($deal->getDriverUser()){
            $this->addFlash(
                'danger',
                'You cannot add a driver to this deal, There is a driver who took this deal!'
            );
        }
        else{
            if($driver){
                $deal->setDriverUser($driver->getUser());
            }

            $allRestDriverRequests = $driverRequestRepository->findByUser($driverRequest->getUser(), $driverRequest->getDeal());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deal);
            $entityManager->flush();
            if( !empty($allRestDriverRequests)){
                foreach ($allRestDriverRequests as $restDriverRequest){
                    $entityManager->remove($restDriverRequest);
                }
                $entityManager->flush();
            }
            $this->addFlash(
                'success',
                'The driver has been add to your deal successfully!'
            );
            $notification->addNotification(['type' => 'addDriverToDeal', 'object' => $driverRequest]);
        }


        return $this->redirectToRoute('deal_show', array('id' => $deal->getId()));
    }

    /**
     * @Route("/done/{id}/deal", name="deal_done", methods={"GET","POST"})
     * @param Deal $deal
     * @param DealRepository $dealRepository
     * @param Notification $notification
     * @return RedirectResponse
     */
    public function dealDone(Deal $deal, DealRepository $dealRepository, Notification $notification): RedirectResponse
    {
        $user = $this->getUser();
        $offerUserStatus = $deal->getOfferUserStatus();
        $demandUserStatus= $deal->getDemandUserStatus();
        $entityManager = $this->getDoctrine()->getManager();

        if($deal->getDriverUser()){
            $driverStatus = $deal->getDriverStatus();
        }
        else{
            $driverStatus = true;
        }

        if ($deal->getOfferUser() === $user) {
            if($demandUserStatus && $driverStatus){
                //done deal
                $this->cleanDeal($deal, $dealRepository);
                $this->addFlash(
                    'info',
                    'You won 5 points!'
                );
                //done deal notification
                $notification->addNotification(['type' => 'doneDeal', 'object' => $deal, 'status' => 'offer']);
                $this->addPointsNotification($deal,$notification);

                return $this->redirectToRoute('deal_index');
            }
            $deal->setOfferUserStatus(true);
            $entityManager->persist($deal);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your deal has been finished!'
            );
            // semi done deal
            $notification->addNotification(['type' => 'semiDoneDeal', 'object' => $deal, 'status' => 'offer']);
            return $this->redirectToRoute('deal_index');
        }

        if ($deal->getDemandUser()===$user) {
            if ($offerUserStatus && $driverStatus) {
                //done deal
                $this->cleanDeal($deal, $dealRepository);
                $this->addFlash(
                    'info',
                    'You won 5 points!'
                );
                //done deal notification
                $notification->addNotification(['type' => 'doneDeal', 'object' => $deal, 'status' => 'demand']);
                $this->addPointsNotification($deal,$notification);

                return $this->redirectToRoute('deal_index');

            }
            $deal->setDemandUserStatus(true);
            $entityManager->persist($deal);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your deal has been finished!'
            );
            $notification->addNotification(['type' => 'semiDoneDeal', 'object' => $deal, 'status' => 'demand']);

            return $this->redirectToRoute('deal_index');
        }

        if($demandUserStatus && $offerUserStatus){
            //done deal
            $this->cleanDeal($deal, $dealRepository);
            $this->addFlash(
                'info',
                'You won 7 points!'
            );
            $notification->addNotification(['type' => 'doneDeal', 'object' => $deal, 'status' => 'driver']);
            $this->addPointsNotification($deal,$notification);

            return $this->redirectToRoute('driver_request_index');

        }
        $deal->setDriverStatus(true);
        $entityManager->persist($deal);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'Your deal has been finished!'
        );
        $notification->addNotification(['type' => 'semiDoneDeal', 'object' => $deal, 'status' => 'driver']);

        return $this->redirectToRoute('driver_request_index');
    }


    public function cleanDeal(Deal $deal, DealRepository $dealRepository): void
    {
        $doneDeal = new DoneDeal();
        $entityManager = $this->getDoctrine()->getManager();
        $offerUser = $deal->getOfferUser();
        $demandUser = $deal->getDemandUser();
        $driverUser = $deal->getDriverUser();
        if($driverUser){
            $driverUserEmailName = explode("@", $driverUser->getEmail());
            $driverUserName = $driverUser->getFirstname() ?:$driverUserEmailName[0];
        }
        else{
            $driverUserName = '';
        }

        $offerUserEmailName = explode("@", $offerUser->getEmail());
        $demandUserEmailName = explode("@", $demandUser->getEmail());

        $offerUserName  = $offerUser->getFirstname()   ?:$offerUserEmailName[0];
        $demandUserName = $demandUser->getFirstname() ?:$demandUserEmailName[0];


        $doneDeal->setDemandUser($demandUser);
        $doneDeal->setOfferUser($offerUser);
        $doneDeal->setCategory($deal->getCategory());
        $doneDeal->setDriverUser($driverUser);

        $doneDeal->setDriverUserName($driverUserName);
        $doneDeal->setOfferUserName($offerUserName);
        $doneDeal->setDemandUserName($demandUserName);

        $entityManager->persist($doneDeal);
        /*$entityManager->flush();*/
        $offerUser->setPoint($offerUser->getPoint() + 5);
        $entityManager->persist($offerUser);
        $demandUser->setPoint($demandUser->getPoint() + 5);
        $entityManager->persist($demandUser);

        if($driverUser){
            $driverUser->getDriver()->setPoint($driverUser->getDriver()->getPoint()+7);
            $entityManager->persist($driverUser);
        }
       /* $entityManager->flush();*/
        $driverRequests = $deal->getDriverRequests();
        foreach ($driverRequests as $driverRequest){
            $entityManager->remove($driverRequest);
        }
        $offer = $deal->getOffer();
        $demand= $deal->getDemand();

        $dealsContact = $dealRepository->findByOfferDemand($offer, $demand);
        $entityManager->remove($deal);
        foreach ($dealsContact as $dealContact){
            $entityManager->remove($dealContact);
        }
        $entityManager->remove($offer);
        $entityManager->remove($demand);

        $entityManager->flush();
        $this->addFlash(
            'success',
            'DONE DEAL!'
        );
    }
    public function addPointsNotification(Deal $deal, Notification $notification): void
    {
        $notification->addNotification(['type' => 'points', 'user' => $deal->getOfferUser(), 'status' => 'user', 'number' => 'Five']);
        $notification->addNotification(['type' => 'points', 'user' => $deal->getDemandUser(), 'status' => 'user', 'number' => 'Five']);
        if($deal->getDriverUser()){
            $notification->addNotification(['type' => 'points', 'user' => $deal->getDriverUser(), 'status' => 'driver', 'number' => 'Seven']);
        }
    }

}
