<?php


namespace App\Entity\Search;

use App\Model\VoyageModel;
use FOS\ElasticaBundle\Repository;
use Elastica\Query\BoolQuery;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\Exists;
class VoyageRepository extends Repository
{


    public function searchCarpooling(VoyageModel $search){

        $bool = new BoolQuery();

        /*if ($search->getDeparture() !== null && $search->getDeparture() !== '' ){
            $match = new Query\Range();
            $match->addField('numberOfPersons',["gte" => $search->getDeparture(),"lte" => null]);
            $bool->addMust($match);
        }*/
        $departure = $search->getDeparture();
        $arrival = $search->getArrival();
        if (($departure !== null && $departure !== '')&&($arrival !== null && $arrival !== '') ){

            $shold = new BoolQuery();

            /*$nested = new Query\Nested();
            $departureBool = new BoolQuery();
            $match = new Match();
            $match->setFieldQuery('stations.city.id', $search->getDeparture()->getId());
            $departureBool->addMust($match);
            $nested->setPath('stations.city');
            $nested->setQuery($departureBool);
            $bool->addMust($nested);*/

           /*$stationDeparture = new BoolQuery();
           $stationNested = new Query\Nested();
           $stationMatch = new Match();
            $stationMatch->setFieldQuery('stations.id', $search->getDeparture()->getId());
            $stationDeparture->addMust($stationMatch);
            $stationNested->setPath('stations');
            $stationNested->setQuery($stationDeparture);
            $bool->addShould($stationNested);*/

        }
        /*if ($search->getArrival() !== null && $search->getArrival() !== '' ){
            $nested = new Query\Nested();
            $userBool = new BoolQuery();
            $match = new Match();
            $match->setFieldQuery('arrival.id', $search->getArrival()->getId());
            $userBool->addMust($match);
            $nested->setPath('arrival');
            $nested->setQuery($userBool);
            $bool->addMust($nested);
        }*/


        /*$checkboxes = [
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
        }*/


        $query = Query::create($bool);

        return $this->find($query,3000);
    }

}