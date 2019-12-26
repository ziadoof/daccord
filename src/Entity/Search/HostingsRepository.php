<?php


namespace App\Entity\Search;

use FOS\ElasticaBundle\Repository;
use App\Model\HostingModel;
use Elastica\Query\BoolQuery;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\Exists;
class HostingsRepository extends Repository
{


    public function searchHosting(HostingModel $search){

        $bool = new BoolQuery();

        $activeMatch = new Match();
        $activeMatch->setFieldQuery('active', true);
        $bool->addMust($activeMatch);

        if ($search->getRegion() !== null && $search->getRegion() !== '') {
            $nested = new Query\Nested();
            $userBool = new BoolQuery();
            $match = new Match();
            $match->setFieldQuery('region.id', $search->getRegion()->getId());
            $userBool->addMust($match);
            $nested->setPath('region');
            $nested->setQuery($userBool);
            $bool->addMust($nested);
            if ($search->getDepartment() !== null && $search->getDepartment() !== '') {
                $nested = new Query\Nested();
                $userBool = new BoolQuery();
                $match = new Match();
                $match->setFieldQuery('department.id', $search->getDepartment()->getId());
                $userBool->addMust($match);
                $nested->setPath('department');
                $nested->setQuery($userBool);
                $bool->addMust($nested);
                if ($search->getVille() !== null && $search->getVille() !== ''){
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
        if ($search->getNumberOfPersons() !== null && $search->getNumberOfPersons() !== '' ){
            $match = new Query\Range();
            $match->addField('numberOfPersons',["gte" => $search->getNumberOfPersons(),"lte" => null]);
            $bool->addMust($match);
        }
        if ($search->getNumberOfDays() !== null && $search->getNumberOfDays() !== '' ){
            $match = new Query\Range();
            $match->addField('numberOfDays',["gte" => $search->getNumberOfDays(),"lte" => null]);
            $bool->addMust($match);
        }
        if ($search->getLanguages() != null && $search->getLanguages() != ''){
            $languages = $search->getLanguages();
            foreach ($languages as $language){
                $match = new Match();
                $match->setFieldQuery('languages', $language);
                $bool->addMust($match);
            }
        }

        $checkboxes = [
            'animal'=>$search->getAnimal(),
            'handicapped'=>$search->getHandicapped(),
            'child'=>$search->getChild(),
            'food'=>$search->getFood(),
            'conversation'=>$search->getConversation(),
            'cityTour'=>$search->getCityTour(),
            'music'=>$search->getMusic(),
            'videoGame'=>$search->getVideoGame(),
            'movie'=>$search->getMovie(),
            'television'=>$search->getTelevision()
        ];


        foreach ($checkboxes as $key=>$value){
            if ($value != null && $value != '') {
                $match = new Match();
                $match->setFieldQuery($key, $value);
                $bool->addMust($match);
            }
        }


        $query = Query::create($bool);

        return $this->find($query,3000);
    }

}