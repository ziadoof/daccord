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






class AdsRepository extends Repository
{


    // This searchAd function will build the elasticsearch query to get a list of ad that match our criterias
    public function searchAd(AdModel $search)
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
            'languages'=>         $search->getLanguages(),
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
            'screenSizeCm'=>      $search->getScreenSizeCm(),
            'screenSizeInch'=>    $search->getScreenSizeInch(),
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
            'numberOfRooms'=>['max'=> null,'min'=> $search->getMinNumberOfRooms()],
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


        /*



        */

       /* if ($search->getPrice() != null && $search->getPrice() != '') {
            $price = $search->getPrice();
            $match = new Query\Range();
            $match->addField('price',["gte" => null,"lte" => $price]);
            $bool->addMust($match);
        }*/





        /* if ($search->getTitle() != null && $search->getTitle() != '') {
             $match = new Match();
             $match->setFieldQuery('title', $search->getTitle());
             $bool->addMust($match);
         }
         if ($search->getSSize() != null && $search->getSSize() != '') {
             $match = new Match();
             $match->setFieldQuery('sSize', $search->getSSize());
             $bool->addMust($match);
         }
         if ($search->getPrice() != null && $search->getPrice() != '') {
             $match = new Match();
             $match->setFieldQuery('price', $search->getPrice());
             $bool->addMust($match);
         }

         if ($search->getManufacturingYear() != null && $search->getManufacturingYear() != '') {
             $match = new Match();
             $match->setFieldQuery('manufacturingYear', $search->getManufacturingYear());
             $bool->addMust($match);
         }*/


        $query = Query::create($bool);
        return $this->find($query,3000);


    }
}