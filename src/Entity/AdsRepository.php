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
use Elastica\Query\Terms;
use Elastica\Query;
use Elastica\Query\Match;



class AdsRepository extends Repository
{


    // This searchAd function will build the elasticsearch query to get a list of ad that match our criterias
    public function searchAd(AdModel $search)
    {
        $query = new BoolQuery();


        if ($search->getTitle() != null && $search->getTitle() != '') {
            $fieldQuery = new Match();
            $fieldQuery->setFieldQuery('title', $search->getTitle());
            $fieldQuery->setFieldParam('title', 'analyzer', 'custom_search_analyzer');
            $fieldQuery->setFieldParam('title', 'analyzer', 'custom_index_analyzer');
            $query->addShould($fieldQuery);
            $query->addMust(new Terms('title', [$fieldQuery]));
        }
        if ($search->getPrice() != null && $search->getPrice() != '') {
            $query->addMust(new Terms('price', [$search->getPrice()]));
        }
        if ($search->getSSize() != null && $search->getSSize() != '') {
            $fieldQuery = new Match();
            $fieldQuery->setFieldQuery('sSize', $search->getSSize());
            $fieldQuery->setFieldParam('sSize', 'analyzer', 'custom_index_analyzer');
            $query->addShould($fieldQuery);
            /*$query->addMust(new Terms('sSize', [$search->getSSize()]));*/
        }
        if ($search->getManufacturingYear() != null && $search->getManufacturingYear() != '') {
            $query->addMust(new Terms('manufacturingYear', [$search->getManufacturingYear()]));
        }
        $query = Query::create($query);

        return $this->find($query,3000);
    }
}