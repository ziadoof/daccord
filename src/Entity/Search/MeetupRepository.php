<?php


namespace App\Entity\Search;

use Elastica\Aggregation\Filter;
use FOS\ElasticaBundle\Repository;
use App\Model\MeetupModel;
use Elastica\Query\BoolQuery;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\Exists;
class MeetupRepository extends Repository
{


    public function searchMeetup(MeetupModel $search): array
    {

        $bool = new BoolQuery();

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
                if ($search->getCity() !== null && $search->getCity() !== ''){
                    $listCitys = $search->getCity();
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
        if ($search->getType() !== null && $search->getType() !== '' ){
            $match =  new Match();
            $match->setFieldQuery('type',$search->getType());
            $bool->addMust($match);
        }
        if ($search->getMaxParticipants() !== null && $search->getMaxParticipants() !== '' ){
            $match = new Query\Range();
            $match->addField('maxParticipants',["gte" =>null ,"lte" => $search->getMaxParticipants()]);
            $bool->addMust($match);
        }

        if ($search->getTitle() !== null && $search->getTitle() !== '' ){
            $match =  new Match();
            $match->setFieldQuery('title',$search->getTitle());
            $bool->addMust($match);
        }

        $query = Query::create($bool);

        return $this->find($query,3000);
    }

}