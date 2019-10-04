<?php

namespace App\Controller\Deal;

use App\Entity\Ads\Ad;
use App\Entity\Ads\Category;
use App\Entity\Ads\Specification;
use App\Entity\Deal\Deal;
use App\Form\Deal\DealType;
use App\Repository\Deal\DealRepository;
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
    public function show(Deal $deal): Response
    {
        $specification = $this->specificationDeal($deal->getOffer(), $deal->getDemand());

        return $this->render('deal/show.html.twig', [
            'specification'=>$specification,
            'deal' => $deal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="deal_edit", methods={"GET","POST"})
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
        $demandDealSpecification = $this->fixDemandDealSpecification($demand->getDealSpecifications());

        foreach ($offerSpecifications as $specification){
            if($specification->getType() === 'CheckboxType'){
                $result[$specification->getLabel()]=[
                    'offer' =>  $offerDealSpecification[$specification->getName()]  ? 'Yes':'No',
                    'demand'=>  $demandDealSpecification[$specification->getName()] ? 'Yes':'No',
                ];
            }
            else
                $result[$specification->getLabel()]=[
                    'offer' =>  $offerDealSpecification[$specification->getName()]  ? $offerDealSpecification[$specification->getName()]:'Undefined',
                    'demand'=>  $demandDealSpecification[$specification->getName()] ? $demandDealSpecification[$specification->getName()]:'Undefined',
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
}
