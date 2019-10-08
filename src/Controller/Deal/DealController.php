<?php

namespace App\Controller\Deal;

use App\Entity\Ads\Ad;
use App\Entity\Ads\Category;
use App\Entity\Ads\Specification;
use App\Entity\Deal\Deal;
use App\Form\Deal\DealType;
use App\Repository\Deal\DealRepository;
use App\Repository\DriverRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/deal")
 */
class DealController extends AbstractController
{
    /**
     * @Route("/", name="deal_index", methods={"GET"})
     * @param DealRepository $dealRepository
     * @return Response
     */
    public function index(DealRepository $dealRepository): Response
    {
        $user = $this->getUser();
        $suggestedDeals = $user->getDeals();
        $doneDeals = $user->getDoneDeals();

        return $this->render('deal/index.html.twig', [
            'suggestedDeals' => $suggestedDeals,
            'doneDeals' => $doneDeals,
        ]);
    }

    /**
     * @Route("/new", name="deal_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $deal = new Deal();
        $form = $this->createForm(DealType::class, $deal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deal);
            $entityManager->flush();

            return $this->redirectToRoute('deal_index');
        }

        return $this->render('deal/new.html.twig', [
            'deal' => $deal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="deal_show", methods={"GET"})
     * @param Deal $deal
     * @return Response
     */
    public function show(Deal $deal, DriverRepository $driverRepository): Response
    {
        $specification = $this->specificationDeal($deal->getOffer(), $deal->getDemand());
        $drivers = $this->getDriversArea($deal,$driverRepository);
        return $this->render('deal/show.html.twig', [
            'specification'=>$specification,
            'drivers'=> $drivers,
            'deal' => $deal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="deal_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Deal $deal
     * @return Response
     */
    public function edit(Request $request, Deal $deal): Response
    {
        $form = $this->createForm(DealType::class, $deal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('deal_index');
        }

        return $this->render('deal/driver_edit.html.twig', [
            'deal' => $deal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="deal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Deal $deal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($deal);
            $entityManager->flush();
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
                case 'ges':
                    $allSpecifications[$key] = $classEnergieAndGes[$value];
                    break;
                case 'classEnergie':
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

        $drivers = $driverRepo->findByArea($latOffer, $lngOffer, $latDemand, $lngDemand);
       dump($drivers);
       return $drivers;
    }
}
