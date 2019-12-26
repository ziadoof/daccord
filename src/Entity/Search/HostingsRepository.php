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
/*        $finder = $this->container->get('fos_elastica.finder.app.hosting');*/
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
            $match = new Match();
            $match->setFieldQuery('numberOfPersons', $search->getNumberOfPersons());
            $bool->addMust($match);

        }
        $query = Query::create($bool);

        return $this->find($query,3000);
    }

}