<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 26/03/19
 * Time: 13:00
 */

namespace App\Entity\Search;


use App\Entity\User;
use App\Repository\Ads\AdRepository;
use FOS\ElasticaBundle\Repository;
use App\Model\AdModel;
use Elastica\Query\BoolQuery;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\Exists;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdsRepository extends Repository
{

    private $generalCategory;
    // This searchOffer function will build the elasticsearch query to get a list of ad that match our criterias


    public function searchOffer(AdModel $search, User $user=null)
    {
        $bool = new BoolQuery();

        if ($search->getGeneralCategory() != null && $search->getGeneralCategory() !=''){
            $nested = new Query\Nested();
            $userBool = new BoolQuery();
            $match = new Match();
            // declare nom de generalcategory pour les category qui contients field city en charche
            $this->generalCategory = $search->getGeneralCategory()->getName();
            if ($search->getCategory() != null && $search->getCategory() != '') {
                $match->setFieldQuery('category.id', $search->getCategory()->getId());
                $userBool->addMust($match);
                $nested->setPath('category');
            }
            else{
                $match->setFieldQuery('generalCategory.id', $search->getGeneralCategory()->getId());
                $userBool->addMust($match);
                $nested->setPath('generalCategory');
            }
            $nested->setQuery($userBool);
            $bool->addMust($nested);
        }
//=================my area==============

        if($search->getMyArea()){
            if($user != null){
                $distance = $user->getMaxDistance();
                $lat = $user->getMapY();
                $lng = $user->getMapX();

                $total = 0.012626*$distance;
                $minLat= $lat - $total;
                $maxLat= $lat + $total;
                $minLng= $lng - $total;
                $maxLng= $lng + $total;

                $latMatch = new Query\Range();
                $latMatch->addField('gpsLat',["gte" => $minLat,"lte" => $maxLat]);
                $bool->addMust($latMatch);

                $lonMatch = new Query\Range();
                $lonMatch->addField('gpsLng',["gte" => $minLng,"lte" => $maxLng]);
                $bool->addMust($lonMatch);
            }
        }

//==================end my area=============
//=================lat and lon==============

        if($search->getNearme()){
            $lat = $search->getLat();
            $lng = $search->getLng();
            $distance = $search->getDistance();
            if($distance === null){
                $total = 0.012626*10;
            }
            else{
                $total = 0.012626*$distance;
            }
            $minLat= $lat - $total;
            $maxLat= $lat + $total;
            $minLng= $lng - $total;
            $maxLng= $lng + $total;
            if(($lat != null) && ($lng != null)){
                dump($lat);
                dump($lng);
                $latMatch = new Query\Range();
                $latMatch->addField('gpsLat',["gte" => $minLat,"lte" => $maxLat]);
                $bool->addMust($latMatch);

                $lonMatch = new Query\Range();
                $lonMatch->addField('gpsLng',["gte" => $minLng,"lte" => $maxLng]);
                $bool->addMust($lonMatch);
            }
        }

//==================end test=============
        if($this->isHaveCity($this->generalCategory)){
            if ($search->getRegion() != null && $search->getRegion() != '') {
                $nested = new Query\Nested();
                $userBool = new BoolQuery();
                $match = new Match();
                $match->setFieldQuery('city.department.region.id', $search->getRegion()->getId());
                $userBool->addMust($match);
                $nested->setPath('city.department.region');
                $nested->setQuery($userBool);
                $bool->addMust($nested);
                if ($search->getDepartment() != null && $search->getDepartment() != '') {
                    $nested = new Query\Nested();
                    $userBool = new BoolQuery();
                    $match = new Match();
                    $match->setFieldQuery('city.department.id', $search->getDepartment()->getId());
                    $userBool->addMust($match);
                    $nested->setPath('city.department');
                    $nested->setQuery($userBool);
                    $bool->addMust($nested);
                    if ($search->getVille() != null && $search->getVille() != ''){
                        $listCitys = $search->getVille();
                        $nested = new Query\Nested();
                        $shold = new BoolQuery();

                        foreach ($listCitys as $city){
                            $match = new Match();
                            $match->setFieldQuery('city.id', $city->getId());
                            $shold->addShould($match);
                        }
                        $nested->setPath('city');
                        $nested->setQuery($shold);
                        $bool->addMust($nested);
                    }
                }
            }
        }
        else{
            if ($search->getRegion() != null && $search->getRegion() != '') {
                $nested = new Query\Nested();
                $userBool = new BoolQuery();
                $match = new Match();
                $match->setFieldQuery('region.id', $search->getRegion()->getId());
                $userBool->addMust($match);
                $nested->setPath('region');
                $nested->setQuery($userBool);
                $bool->addMust($nested);
                if ($search->getDepartment() != null && $search->getDepartment() != '') {
                    $nested = new Query\Nested();
                    $userBool = new BoolQuery();
                    $match = new Match();
                    $match->setFieldQuery('department.id', $search->getDepartment()->getId());
                    $userBool->addMust($match);
                    $nested->setPath('department');
                    $nested->setQuery($userBool);
                    $bool->addMust($nested);
                    if ($search->getVille() != null && $search->getVille() != ''){
                        $listCitys = $search->getVille();
                        $nested = new Query\Nested();
                        $shold = new BoolQuery();

                        foreach ($listCitys as $city){
                            $match = new Match();
                            $match->setFieldQuery('ville.id', $city->getId());
                            $shold->addShould($match);
                        }
                        $nested->setPath('ville');
                        $nested->setQuery($shold);
                        $bool->addMust($nested);
                    }
                }
            }
        }

        $textPhraseForm = [
            //
            'material'=>          $search->getMaterial(),
            'fuelType'=>          $search->getFuelType(),

            // pour confirmer
            'theType'=>           $search->getTheType(),
            'placeOfLesson'=>     $search->getPlaceOfLesson(),
            'printingType'=>      $search->getPrintingType(),
            'printingColor'=>     $search->getPrintingColor(),
            'coverMaterial'=>     $search->getCoverMaterial(),

        ];

        foreach ($textPhraseForm as $key=>$value){
            if ($value != null && $value != '') {
                $match = new Query\MatchPhrase();
                $match->setFieldQuery($key, $value);
                $bool->addMust($match);
            }
        }
        //  Language exchange  il faut charch à la contrair de les first and second languages
        //  if category is language exchange => the offer is same as the demand
        if($search->getLanguage()!= null && $search->getLanguage() != ''){
            if($search->getCategory()->getName() === 'Language exchange'){
                if($search->getSecondLanguage() != null && $search->getSecondLanguage()!=''){
                    $firstMatch = new Match();
                    $firstMatch->setFieldQuery('language', $search->getSecondLanguage());
                    $bool->addMust($firstMatch);

                    $secondMatch = new Match();
                    $secondMatch->setFieldQuery('secondLanguage', $search->getLanguage());
                    $bool->addMust($secondMatch);

                    $shold = new BoolQuery();
                    $demandMatch = new Match();
                    $demandMatch->setFieldQuery('typeOfAd', 'Demand');
                    $offerMatch = new Match();
                    $offerMatch->setFieldQuery('typeOfAd', 'Offer');
                    $shold->addShould($demandMatch);
                    $shold->addShould($offerMatch);
                    $bool->addShould($shold);
                }
                else{
                    $secondMatch = new Match();
                    $secondMatch->setFieldQuery('secondLanguage', $search->getLanguage());
                    $bool->addMust($secondMatch);

                    $shold = new BoolQuery();
                    $demandMatch = new Match();
                    $demandMatch->setFieldQuery('typeOfAd', 'Demand');
                    $offerMatch = new Match();
                    $offerMatch->setFieldQuery('typeOfAd', 'Offer');
                    $shold->addShould($demandMatch);
                    $shold->addShould($offerMatch);
                    $bool->addShould($shold);
                }
            }
            else{
                $firstMatch = new Match();
                $firstMatch->setFieldQuery('language', $search->getLanguage());
                $bool->addMust($firstMatch);

                $offerMatch = new Match();
                $offerMatch->setFieldQuery('typeOfAd', 'Offer');
                $bool->addMust($offerMatch);
            }
        }
        else{
            $offerMatch = new Match();
            $offerMatch->setFieldQuery('typeOfAd', 'Offer');
            $bool->addMust($offerMatch);
        }
        // end Language exchange
        $textForm = [
            //checkbox
            'donate'=>            $search->getDonate(),
            'withDriver'=>        $search->getWithDriver(),
            'hdmi'=>              $search->getHdmi(),
            'cdRoom'=>            $search->getCdRoom(),
            'wifi'=>              $search->getWifi(),
            'usb'=>               $search->getUsb(),
            'threeInOne'=>        $search->getThreeInOne(),
            'accessories'=>       $search->getAccessories(),
            'withFreezer'=>       $search->getWithFreezer(),
            'electricHead'=>      $search->getElectricHead(),
            'withOven'=>          $search->getWithOven(),
            'covered'=>           $search->getCovered(),
            'withFurniture'=>     $search->getWithFurniture(),
            'withGarden'=>        $search->getWithGarden(),
            'withVerandah'=>      $search->getWithVerandah(),
            'withElevator'=>      $search->getWithElevator(),
            // other
            'dvdCd'=>             $search->getDvdCd(),
            'title'=>             $search->getTitle(),
            'sSize'=>             $search->getSSize(),
            'iSize'=>             $search->getISize(),
            'workHours'=>         $search->getWorkHours(),
            'typeOfContract'=>    $search->getTypeOfContract(),
            'levelOfStudy'=>      $search->getLevelOfStudy(),
            'brand'=>             $search->getBrand(),
            'model'=>             $search->getModel(),
            'changeGear'=>        $search->getChangeGear(),
            'manufactureCompany'=>$search->getManufactureCompany(),
            'analogDigital'=>     $search->getAnalogDigital(),
            'animalSpecies'=>     $search->getAnimalSpecies(),
            'originCountry'=>     $search->getOriginCountry(),
            'shape'=>             $search->getShape(),
            'heating'=>           $search->getHeating(),
            'heatingType'=>       $search->getHeatingType(),
            'eventType'=>         $search->getEventType(),
            'subjectName'=>       $search->getSubjectName(),
            'acitvityArea'=>      $search->getAcitvityArea()

        ];

        foreach ($textForm as $key=>$value){
            if ($value != null && $value != '') {
                $match = new Match();
                $match->setFieldQuery($key, $value);
                $bool->addMust($match);
            }
        }


        $rangeForm = [
            'manufacturingYear'=>['max'=> $search->getMaxManufacturingYear(),'min'=> $search->getMinManufacturingYear()],
            'kilometer'=>['max'=> $search->getMaxKilometer(),'min'=> $search->getMinKilometer()],
            'capacity'=>['max'=> $search->getMaxCapacity(),'min'=> $search->getMinCapacity()],
            'area'=>['max'=> $search->getMaxArea(),'min'=> $search->getMinArea()],
            'numberOfRooms'=>['max'=> null,'min'=> $search->getNumberOfRooms()],
            'age'=> ['max'=> $search->getAge(),'min'=> null],
            'paperSize'=> ['max'=> $search->getPaperSize(),'min'=> null],
            'salary'=> ['max'=> null,'min'=> $search->getSalary()],
            'numberOfPassengers'=> ['max'=> null,'min'=> $search->getNumberOfPassengers()],
            'numberOfDoors'=> ['max'=> null,'min'=> $search->getNumberOfDoors()],
            'ram'=> ['max'=> null,'min'=> $search->getRam()],
            'accuracy'=> ['max'=> null,'min'=> $search->getAccuracy()],
            'number'=> ['max'=> null,'min'=> $search->getNumber()],
            'numberOfPersson'=> ['max'=> null,'min'=> $search->getNumberOfPersson()],
            'numberOfDrawer'=> ['max'=> null,'min'=> $search->getNumberOfDrawer()],
            'numberOfStaging'=> ['max'=> null,'min'=> $search->getNumberOfStaging()],
            'numberOfHead'=> ['max'=> null,'min'=> $search->getNumberOfHead()],
            'classEnergie'=>  ['max'=>  $search->getClassEnergie(),'min'=> null],
            'ges'=>           ['max'=>  $search->getGes(),'min'=> null],
            'weight'=>           ['max'=>  $search->getWeight(),'min'=> null],
            'experience'=>           ['max'=>  $search->getExperience(),'min'=> null],
            'levelOfStudent'=>           ['max'=>  null,'min'=> $search->getLevelOfStudent()],
            'generalSituation'=>           ['max'=>  $search->getGeneralSituation(),'min'=> null],

        ];

        foreach ($rangeForm as $key=>$value){
                if(($value['max'] != null && $value['max'] !='')|| ($value['min'] != null && $value['min'] !='')){
                    $match = new Query\Range();
                    $match->addField($key,["gte" => $value['min'],"lte" => $value['max']]);
                    $bool->addMust($match);
                }
        }

        if ($search->getLanguages() != null && $search->getLanguages() != ''){
            $languages = $search->getLanguages();
            foreach ($languages as $language){
                $match = new Match();
                $match->setFieldQuery('languages', $language);
                $bool->addMust($match);
            }
        }

        if ($search->getTypeOfTranslation() != null && $search->getTypeOfTranslation() != '' ){
            // pour afficher all type de traduir en n'amport qelle type
            $shold = new BoolQuery();

            $match = new Match();
            $match->setFieldQuery('typeOfTranslation', $search->getTypeOfTranslation());
            $shold->addShould($match) ;

            $allmatch = new Match();
            $allmatch->setFieldQuery('typeOfTranslation', 'All');
            $shold->addShould($allmatch) ;

            $bool->addMust($shold);

        }
        if ($search->getPrice() != null && $search->getPrice() != '' ){
            // pour afficher all type de traduir en n'amport qelle type
            $shold = new BoolQuery();

            $match = new Query\Range();
            $match->addField('price',["gte" => null,"lte" => $search->getPrice()]);
            $shold->addShould($match);



            $matchDonat = new Match();
            $matchDonat->setFieldQuery('donate', true);
            $shold->addShould($matchDonat) ;

            $matchPrice = new BoolQuery();
            $existPrice = new Exists('price');
            $matchPrice->addMustNot($existPrice);
            $shold->addShould($matchPrice) ;

            $bool->addMust($shold);

        }




        $query = Query::create($bool);
        return $this->find($query,3000);


    }

    // This searchDemand function will build the elasticsearch query to get a list of ad that match our criterias
    public function searchDemand(AdModel $search, User $user=null)
    {
        $bool = new BoolQuery();

        //=================lat and lng==============

        if($search->getNearme()){
            $lat = $search->getLat();
            $lng = $search->getLng();
            $distance = $search->getDistance();
            if($distance === null){
                $total = 0.012626*10;
            }
            else{
                $total = 0.012626*$distance;
            }
            $minLat= $lat - $total;
            $maxLat= $lat + $total;
            $minLng= $lng - $total;
            $maxLng= $lng + $total;
            if(($lat != null) && ($lng != null)){
                dump($lat);
                dump($lng);
                $latMatch = new Query\Range();
                $latMatch->addField('gpsLat',["gte" => $minLat,"lte" => $maxLat]);
                $bool->addMust($latMatch);

                $lonMatch = new Query\Range();
                $lonMatch->addField('gpsLng',["gte" => $minLng,"lte" => $maxLng]);
                $bool->addMust($lonMatch);
            }
        }

//==================end near me=============

        //=================my area==============

        if($search->getMyArea()){
            if($user != null){
                $distance = $user->getMaxDistance();
                $lat = $user->getMapY();
                $lng = $user->getMapX();

                $total = 0.012626*$distance;
                $minLat= $lat - $total;
                $maxLat= $lat + $total;
                $minLng= $lng - $total;
                $maxLng= $lng + $total;

                $latMatch = new Query\Range();
                $latMatch->addField('gpsLat',["gte" => $minLat,"lte" => $maxLat]);
                $bool->addMust($latMatch);

                $lonMatch = new Query\Range();
                $lonMatch->addField('gpsLng',["gte" => $minLng,"lte" => $maxLng]);
                $bool->addMust($lonMatch);
            }
        }

//==================end my area=============
        if($this->isHaveCity($this->generalCategory)){
            if ($search->getRegion() != null && $search->getRegion() != '') {
                $nested = new Query\Nested();
                $userBool = new BoolQuery();
                $match = new Match();
                $match->setFieldQuery('city.department.region.id', $search->getRegion()->getId());
                $userBool->addMust($match);
                $nested->setPath('city.department.region');
                $nested->setQuery($userBool);
                $bool->addMust($nested);
                if ($search->getDepartment() != null && $search->getDepartment() != '') {
                    $nested = new Query\Nested();
                    $userBool = new BoolQuery();
                    $match = new Match();
                    $match->setFieldQuery('city.department.id', $search->getDepartment()->getId());
                    $userBool->addMust($match);
                    $nested->setPath('city.department');
                    $nested->setQuery($userBool);
                    $bool->addMust($nested);
                    if ($search->getVille() != null && $search->getVille() != ''){
                        $listCitys = $search->getVille();
                        $nested = new Query\Nested();
                        $shold = new BoolQuery();

                        foreach ($listCitys as $city){
                            $match = new Match();
                            $match->setFieldQuery('city.id', $city->getId());
                            $shold->addShould($match);
                        }
                        $nested->setPath('city');
                        $nested->setQuery($shold);
                        $bool->addMust($nested);
                    }
                }
            }
        }
        else{
            if ($search->getRegion() != null && $search->getRegion() != '') {
                $nested = new Query\Nested();
                $userBool = new BoolQuery();
                $match = new Match();
                $match->setFieldQuery('region.id', $search->getRegion()->getId());
                $userBool->addMust($match);
                $nested->setPath('region');
                $nested->setQuery($userBool);
                $bool->addMust($nested);
                if ($search->getDepartment() != null && $search->getDepartment() != '') {
                    $nested = new Query\Nested();
                    $userBool = new BoolQuery();
                    $match = new Match();
                    $match->setFieldQuery('department.id', $search->getDepartment()->getId());
                    $userBool->addMust($match);
                    $nested->setPath('department');
                    $nested->setQuery($userBool);
                    $bool->addMust($nested);
                    if ($search->getVille() != null && $search->getVille() != ''){
                        $listCitys = $search->getVille();
                        $nested = new Query\Nested();
                        $shold = new BoolQuery();

                        foreach ($listCitys as $city){
                            $match = new Match();
                            $match->setFieldQuery('ville.id', $city->getId());
                            $shold->addShould($match);
                        }
                        $nested->setPath('ville');
                        $nested->setQuery($shold);
                        $bool->addMust($nested);
                    }
                }
            }
        }



        if ($search->getGeneralCategory() != null && $search->getGeneralCategory() !=''){
            $nested = new Query\Nested();
            $userBool = new BoolQuery();
            $match = new Match();
            if ($search->getCategory() != null && $search->getCategory() != '') {
                $match->setFieldQuery('category.id', $search->getCategory()->getId());
                $userBool->addMust($match);
                $nested->setPath('category');
            }
            else{
                $match->setFieldQuery('generalCategory.id', $search->getGeneralCategory()->getId());
                $userBool->addMust($match);
                $nested->setPath('generalCategory');
            }
            $nested->setQuery($userBool);
            $bool->addMust($nested);
        }

        $textPhraseForm = [
            //
            'material'=>          $search->getMaterial(),
            'fuelType'=>          $search->getFuelType(),

            // pour confirmer
            'theType'=>           $search->getTheType(),
            'placeOfLesson'=>     $search->getPlaceOfLesson(),
            'printingType'=>      $search->getPrintingType(),
            'printingColor'=>     $search->getPrintingColor(),
            'coverMaterial'=>     $search->getCoverMaterial(),

        ];

        foreach ($textPhraseForm as $key=>$value){
            if ($value != null && $value != '') {
                $match = new Query\MatchPhrase();
                $match->setFieldQuery($key, $value);
                $bool->addMust($match);
            }
        }
        //  Language exchange  il faut charch à la contrair de les first and second languages
        //  if category is language exchange => the offer is same as the demand
        if($search->getLanguage()!= null && $search->getLanguage() != ''){
            if($search->getCategory()->getName() === 'Language exchange'){
                if($search->getSecondLanguage() != null && $search->getSecondLanguage()!=''){
                    $firstMatch = new Match();
                    $firstMatch->setFieldQuery('language', $search->getSecondLanguage());
                    $bool->addMust($firstMatch);

                    $secondMatch = new Match();
                    $secondMatch->setFieldQuery('secondLanguage', $search->getLanguage());
                    $bool->addMust($secondMatch);

                    $shold = new BoolQuery();
                    $demandMatch = new Match();
                    $demandMatch->setFieldQuery('typeOfAd', 'Demand');
                    $offerMatch = new Match();
                    $offerMatch->setFieldQuery('typeOfAd', 'Offer');
                    $shold->addShould($demandMatch);
                    $shold->addShould($offerMatch);
                    $bool->addShould($shold);
                }
                else{
                    $secondMatch = new Match();
                    $secondMatch->setFieldQuery('secondLanguage', $search->getLanguage());
                    $bool->addMust($secondMatch);

                    $shold = new BoolQuery();
                    $demandMatch = new Match();
                    $demandMatch->setFieldQuery('typeOfAd', 'Demand');
                    $offerMatch = new Match();
                    $offerMatch->setFieldQuery('typeOfAd', 'Offer');
                    $shold->addShould($demandMatch);
                    $shold->addShould($offerMatch);
                    $bool->addShould($shold);
                }
            }
            else{
                $firstMatch = new Match();
                $firstMatch->setFieldQuery('language', $search->getLanguage());
                $bool->addMust($firstMatch);

                $offerMatch = new Match();
                $offerMatch->setFieldQuery('typeOfAd', 'Demand');
                $bool->addMust($offerMatch);
            }
        }
        else{
            $offerMatch = new Match();
            $offerMatch->setFieldQuery('typeOfAd', 'Demand');
            $bool->addMust($offerMatch);
        }
        // end Language exchange
        $textForm = [
            //checkbox
            'donate'=>            $search->getDonate(),
            'withDriver'=>        $search->getWithDriver(),
            'hdmi'=>              $search->getHdmi(),
            'cdRoom'=>            $search->getCdRoom(),
            'wifi'=>              $search->getWifi(),
            'usb'=>               $search->getUsb(),
            'threeInOne'=>        $search->getThreeInOne(),
            'accessories'=>       $search->getAccessories(),
            'withFreezer'=>       $search->getWithFreezer(),
            'electricHead'=>      $search->getElectricHead(),
            'withOven'=>          $search->getWithOven(),
            'covered'=>           $search->getCovered(),
            'withFurniture'=>     $search->getWithFurniture(),
            'withGarden'=>        $search->getWithGarden(),
            'withVerandah'=>      $search->getWithVerandah(),
            'withElevator'=>      $search->getWithElevator(),
            // other
            'dvdCd'=>             $search->getDvdCd(),
            'title'=>             $search->getTitle(),
            'sSize'=>             $search->getSSize(),
            'iSize'=>             $search->getISize(),
            'workHours'=>         $search->getWorkHours(),
            'typeOfContract'=>    $search->getTypeOfContract(),
            'levelOfStudy'=>      $search->getLevelOfStudy(),
            'brand'=>             $search->getBrand(),
            'model'=>             $search->getModel(),
            'changeGear'=>        $search->getChangeGear(),
            'manufactureCompany'=>$search->getManufactureCompany(),
            'analogDigital'=>     $search->getAnalogDigital(),
            'animalSpecies'=>     $search->getAnimalSpecies(),
            'originCountry'=>     $search->getOriginCountry(),
            'shape'=>             $search->getShape(),
            'heating'=>           $search->getHeating(),
            'heatingType'=>       $search->getHeatingType(),
            'eventType'=>         $search->getEventType(),
            'subjectName'=>       $search->getSubjectName(),
            'acitvityArea'=>      $search->getAcitvityArea()

        ];

        foreach ($textForm as $key=>$value){
            if ($value != null && $value != '') {
                $match = new Match();
                $match->setFieldQuery($key, $value);
                $bool->addMust($match);
            }
        }
        /*for search to mor than the field and less than the same field*/
        $moreLessForm = [
            'manufacturingYear'  => ['field' => $search->getManufacturingYear(), 'max'   => 'maxManufacturingYear', 'min'   => 'minManufacturingYear'],
            'kilometer'  => ['field' => $search->getKilometer(), 'max'   => 'maxKilometer', 'min'   => 'minKilometer'],
            'capacity'  => ['field' => $search->getCapacity(), 'max'   => 'maxCapacity', 'min'   => 'minCapacity'],
            'area'  => ['field' => $search->getArea(), 'max'   => 'maxArea', 'min'   => 'minArea'],
        ];


            foreach ($moreLessForm as $key => $value){
                if($value['field'] != null && $value['field'] !=''){
                    $maxMatch = new Query\Range();
                    $maxMatch->addField($value['max'],["gte" =>  $value['field'],"lte" => null]);
                    $bool->addMust($maxMatch);

                    $minMatch = new Query\Range();
                    $minMatch->addField($value['min'],["gte" => null,"lte" => $value['field']]);
                    $bool->addMust($minMatch);
                }
            }
        /*end */

        $rangeForm = [
            'numberOfRooms'=>['max'=> $search->getNumberOfRooms(),'min'=> null],
            'age'=> ['max'=> null,'min'=> $search->getAge()],
            'paperSize'=> ['max'=> null,'min'=> $search->getPaperSize()],
            'salary'=> ['max'=> null,'min'=> $search->getSalary()],
            'numberOfPassengers'=> ['max'=> null,'min'=> $search->getNumberOfPassengers()],
            'numberOfDoors'=> ['max'=> $search->getNumberOfDoors(),'min'=> null],
            'ram'=> ['max'=> $search->getRam(),'min'=> null],
            'accuracy'=> ['max'=> null,'min'=> $search->getAccuracy()],
            'number'=> ['max'=> $search->getNumber(),'min'=> null],
            'numberOfPersson'=> ['max'=> $search->getNumberOfPersson(),'min'=> null],
            'numberOfDrawer'=> ['max'=> $search->getNumberOfDrawer(),'min'=> null],
            'numberOfStaging'=> ['max'=> $search->getNumberOfStaging(),'min'=> null],
            'numberOfHead'=> ['max'=> $search->getNumberOfHead(),'min'=> null],
            'classEnergie'=>  ['max'=>  $search->getClassEnergie(),'min'=> null],
            'ges'=>           ['max'=>  $search->getGes(),'min'=> null],
            'weight'=>           ['max'=>  $search->getWeight(),'min'=> null],
            'experience'=>           ['max'=>  null,'min'=> $search->getExperience()],
            'levelOfStudent'=>           ['max'=>  null,'min'=> $search->getLevelOfStudent()],
            'capacity'=>           ['max'=>  $search->getMinCapacity(),'min'=> null],
            'generalSituation'=>           ['max'=>  $search->getGeneralSituation(),'min'=> null],

        ];

        foreach ($rangeForm as $key=>$value){
            if(($value['max'] != null && $value['max'] !='')|| ($value['min'] != null && $value['min'] !='')){
                $match = new Query\Range();
                $match->addField($key,["gte" => $value['min'],"lte" => $value['max']]);
                $bool->addMust($match);
            }
        }

        if ($search->getLanguages() != null && $search->getLanguages() != ''){
            $languages = $search->getLanguages();
            foreach ($languages as $language){
                $match = new Match();
                $match->setFieldQuery('languages', $language);
                $bool->addMust($match);
            }
        }

        if ($search->getTypeOfTranslation() != null && $search->getTypeOfTranslation() != '' ){
            // pour afficher all type de traduir en n'amport qelle type
            $shold = new BoolQuery();

            $match = new Match();
            $match->setFieldQuery('typeOfTranslation', $search->getTypeOfTranslation());
            $shold->addShould($match) ;

            $allmatch = new Match();
            $allmatch->setFieldQuery('typeOfTranslation', 'All');
            $shold->addShould($allmatch) ;

            $bool->addMust($shold);

        }


        $query = Query::create($bool);
        return $this->find($query,3000);


    }

    public function isHaveCity(string $generalCategory=null ){

         $listCity = ['Jobs and services','Residence','Holidays'];
        if($generalCategory !== null) {
            return in_array($generalCategory, $listCity);
        }
    }


}