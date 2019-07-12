<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 26/03/19
 * Time: 13:00
 */

namespace App\Entity;


use FOS\ElasticaBundle\Repository;
use App\Model\AdModel;
use Elastica\Query\BoolQuery;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\Exists;


class AdsRepository extends Repository
{

    private $generalCategory;
    // This searchOffer function will build the elasticsearch query to get a list of ad that match our criterias
    public function searchOffer(AdModel $search)
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
            'language'=>          $search->getLanguage(),
            'secondLanguage'=>    $search->getSecondLanguage(),
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
    public function searchDemand(AdModel $search)
    {
        $bool = new BoolQuery();

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
                if ($search->getVille() != null && $search->getVille() != '') {
                    $nested = new Query\Nested();
                    $userBool = new BoolQuery();
                    $match = new Match();
                    $match->setFieldQuery('ville.id', $search->getVille()->getId());
                    $userBool->addMust($match);
                    $nested->setPath('ville');
                    $nested->setQuery($userBool);
                    $bool->addMust($nested);
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

        $textForm = [
            'title'=>             $search->getTitle(),
            'sSize'=>             $search->getSSize(),
            'withDriver'=>        $search->getWithDriver(),
            'theType'=>           $search->getTheType(),
            'secondLanguage'=>    $search->getSecondLanguage(),
            'iSize'=>             $search->getISize(),
            /*'languages'=>         $search->getLanguages(),*/
            'workHours'=>         $search->getWorkHours(),
            'typeOfContract'=>    $search->getTypeOfContract(),
            'experience'=>        $search->getExperience(),
            'levelOfStudy'=>      $search->getLevelOfStudy(),
            'language'=>          $search->getLanguage(),
            'typeOfTranslation'=> $search->getTypeOfTranslation(),
            'material'=>          $search->getMaterial(),
            'placeOfLesson'=>     $search->getPlaceOfLesson(),
            'levelOfStudent'=>    $search->getLevelOfStudent(),
            'brand'=>             $search->getBrand(),
            'fuelType'=>          $search->getFuelType(),
            'model'=>             $search->getModel(),
            'changeGear'=>        $search->getChangeGear(),
            'manufactureCompany'=>$search->getManufactureCompany(),
            'generalSituation'=>  $search->getGeneralSituation(),
            'printingType'=>      $search->getPrintingType(),
            'printingColor'=>     $search->getPrintingColor(),
            'analogDigital'=>     $search->getAnalogDigital(),
            'animalSpecies'=>     $search->getAnimalSpecies(),
            'dvdCd'=>             $search->getDvdCd(),
            'originCountry'=>     $search->getOriginCountry(),
            'coverMaterial'=>     $search->getCoverMaterial(),
            'shape'=>             $search->getShape(),
            'heating'=>           $search->getHeating(),
            'heatingType'=>       $search->getHeatingType(),
            'eventType'=>         $search->getEventType(),
            'subjectName'=>       $search->getSubjectName(),
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
            'city'=>              $search->getCity(),
            'donate'=>            $search->getDonate(),
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
            'price'=>['max'=> $search->getPrice(),'min'=> null],
            'age'=> ['max'=> $search->getAge(),'min'=> null],
            'paperSize'=> ['max'=> $search->getPaperSize(),'min'=> $search->getPaperSize()],
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

        ];

        foreach ($rangeForm as $key=>$value){
            if(($value['max'] != null && $value['max'] !='')|| ($value['min'] != null && $value['min'] !='')){
                $match = new Query\Range();
                $match->addField($key,["gte" => $value['min'],"lte" => $value['max']]);
                $bool->addMust($match);
            }
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