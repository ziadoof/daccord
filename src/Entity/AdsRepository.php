<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 26/03/19
 * Time: 13:00
 */

namespace App\Entity;

use Elastica\QueryBuilder;
use FOS\ElasticaBundle\Repository;
use App\Model\AdModel;
use Elastica\Query\BoolQuery;
use Elastica\Query\HasChild;
use Elastica\Query\Terms;
use Elastica\Query\QueryString;
use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\MultiMatch;
use Elastica\Query\MatchAll;





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

      /*  $searchForm = [
            'price'=> $search->getPrice(),
            'title'=> $search->getTitle(),
            'sSize'=> $search->getSSize(),
            'manufacturingYear'=> $search->getManufacturingYear(),

        ];

        foreach ($searchForm as $key=>$value){
            if ($value != null && $value != '') {
                $match = new Match();
                $match->setFieldQuery($key, $value);
                $bool->addMust($match);
            }
        }*/


        if ($search->getTitle() != null && $search->getTitle() != '') {
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
        }


        $query = Query::create($bool);
        return $this->find($query,3000);


    }
}