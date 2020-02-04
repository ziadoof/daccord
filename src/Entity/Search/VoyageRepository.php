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


        if (($search->getMainDeparture() !== null && $search->getMainDeparture() !== '')&&
            ($search->getMainArrival()   !== null && $search->getMainArrival()   !== '') )
        {

            $departure = $search->getMainDeparture();
            $arrival = $search->getMainArrival();

            $departureLat= $departure->getGpsLat();
            $departureLng= $departure->getGpsLng();
            $arrivalLat= $arrival->getGpsLat();
            $arrivalLng= $arrival->getGpsLng();

            // gps for 6 KM
            $MaxDlat = $departureLat + (0.012626*6);
            $MinDlat = $departureLat - (0.012626*6);
            $MaxDlng = $departureLng + (0.012626*6);
            $MinDlng = $departureLng - (0.012626*6);

            $MaxAlat = $arrivalLat + (0.012626*6);
            $MinAlat = $arrivalLat - (0.012626*6);
            $MaxAlng = $arrivalLng + (0.012626*6);
            $MinAlng = $arrivalLng - (0.012626*6);

            $mainShold = new BoolQuery();
            $gpsMainShold = new BoolQuery();
            $gpsStationShold = new BoolQuery();
            $stationShold = new BoolQuery();

            // search in mainDeparture city as id
            $Dnested = new Query\Nested();
            $DShold = new BoolQuery();
            $Dmatch = new Match();
            $Dmatch->setFieldQuery('mainDeparture.id', $departure->getId());

            $DShold->addMust($Dmatch);
            $Dnested->setPath('mainDeparture');

            $Dnested->setQuery($DShold);
            $mainShold->addMust($Dnested);



            // search in mainArrival city as id
            $Anested = new Query\Nested();
            $AShold = new BoolQuery();
            $Amatch = new Match();
            $Amatch->setFieldQuery('mainArrival.id', $arrival->getId());

            $AShold->addMust($Amatch);
            $Anested->setPath('mainArrival');

            $Anested->setQuery($AShold);
            $mainShold->addMust($Anested);

            //search just voyage withe parent null
            // use in gps too
            $voyageParent = new BoolQuery();
            $existParent = new Exists('parent.id');
            $voyageParent->addMust($existParent);
            $parentNested = new Query\Nested();
            $parentNested->setPath('parent');
            $parentNested->setQuery($voyageParent);
            $Null = new BoolQuery();
            $Null->addMustNot($parentNested);
            $mainShold->addMust($Null);


            // search in gps city departure
            $LatDnested = new Query\Nested();
            $LatDShold = new BoolQuery();
            $LatDmatch = new Query\Range();
            $LatDmatch->addField('mainDeparture.gpsLat',['gte' => $MinDlat, 'lte' => $MaxDlat]);
            $LatDShold->addMust($LatDmatch);
            $LatDnested->setPath('mainDeparture');
            $LatDnested->setQuery($LatDShold);

            $LngDnested = new Query\Nested();
            $LngDShold = new BoolQuery();
            $LngDmatch = new Query\Range();
            $LngDmatch->addField('mainDeparture.gpsLng',['gte' => $MinDlng, 'lte' => $MaxDlng]);
            $LngDShold->addMust($LngDmatch);
            $LngDnested->setPath('mainDeparture');
            $LngDnested->setQuery($LngDShold);

            $gpsMainShold->addMust($LatDnested);
            $gpsMainShold->addMust($LngDnested);

            //search in gps city arrival
            $LatAnested = new Query\Nested();
            $LatAShold = new BoolQuery();
            $LatAmatch = new Query\Range();
            $LatAmatch->addField('mainArrival.gpsLat',['gte' => $MinAlat, 'lte' => $MaxAlat]);
            $LatAShold->addMust($LatAmatch);
            $LatAnested->setPath('mainArrival');
            $LatAnested->setQuery($LatAShold);


            $LngAnested = new Query\Nested();
            $LngAShold = new BoolQuery();
            $LngAmatch = new Query\Range();
            $LngAmatch->addField('mainArrival.gpsLng',['gte' => $MinAlng, 'lte' => $MaxAlng]);
            $LngAShold->addMust($LngAmatch);
            $LngAnested->setPath('mainArrival');
            $LngAnested->setQuery($LngAShold);

            $gpsMainShold->addMust($LatAnested);
            $gpsMainShold->addMust($LngAnested);
            $gpsMainShold->addMust($Null);


            //end gps

            $bool->addShould($mainShold);
            $bool->addShould($gpsMainShold);
//end main
//start station



            // search in stationMainDeparture city as id
            $SDnested = new Query\Nested();
            $SDShold = new BoolQuery();
            $SDmatch = new Match();
            $SDmatch->setFieldQuery('stationDeparture.id', $departure->getId());

            $SDShold->addMust($SDmatch);
            $SDnested->setPath('stationDeparture');
            $SDnested->setQuery($SDShold);
            $stationShold->addMust($SDnested);


            // search in stationMainArrival city as id
            $SAnested = new Query\Nested();
            $SAShold = new BoolQuery();
            $SAmatch = new Match();
            $SAmatch->setFieldQuery('stationArrival.id', $arrival->getId());
              
            $SAShold->addMust($SAmatch);
            $SAnested->setPath('stationArrival');
            $SAnested->setQuery($SAShold);
            $stationShold->addMust($SAnested);

            // search gps station
            // search in gps city station departure
            $LatSDnested = new Query\Nested();
            $LatSDShold = new BoolQuery();
            $LatSDmatch = new Query\Range();
            $LatSDmatch->addField('stationDeparture.gpsLat',['gte' => $MinDlat, 'lte' => $MaxDlat]);
            $LatSDShold->addMust($LatSDmatch);
            $LatSDnested->setPath('stationDeparture');
            $LatSDnested->setQuery($LatSDShold);

            $LngSDnested = new Query\Nested();
            $LngSDShold = new BoolQuery();
            $LngSDmatch = new Query\Range();
            $LngSDmatch->addField('stationDeparture.gpsLng',['gte' => $MinDlng, 'lte' => $MaxDlng]);
            $LngSDShold->addMust($LngSDmatch);
            $LngSDnested->setPath('stationDeparture');
            $LngSDnested->setQuery($LngSDShold);

            $gpsStationShold->addMust($LatSDnested);
            $gpsStationShold->addMust($LngSDnested);

            // search in gps city station arrival
            $LatSAnested = new Query\Nested();
            $LatSAShold = new BoolQuery();
            $LatSAmatch = new Query\Range();
            $LatSAmatch->addField('stationArrival.gpsLat',['gte' => $MinAlat, 'lte' => $MaxAlat]);
            $LatSAShold->addMust($LatSAmatch);
            $LatSAnested->setPath('stationArrival');
            $LatSAnested->setQuery($LatSAShold);


            $LngSAnested = new Query\Nested();
            $LngSAShold = new BoolQuery();
            $LngSAmatch = new Query\Range();
            $LngSAmatch->addField('stationArrival.gpsLng',['gte' => $MinAlng, 'lte' => $MaxAlng]);
            $LngSAShold->addMust($LngSAmatch);
            $LngSAnested->setPath('stationArrival');
            $LngSAnested->setQuery($LngSAShold);

            $gpsStationShold->addMust($LatSAnested);
            $gpsStationShold->addMust($LngSAnested);

            //highway boolean
            $highway = $search->getHighway();
            if ($highway){
                $match = new Match();
                $match->setFieldQuery('highway', $highway);
                $mainShold->addMust($match);
                $stationShold->addMust($match);
                $gpsMainShold->addMust($match);
                $gpsStationShold->addMust($match);
            }

            // date datetime
            $date = $search->getDate();
            if($date === null){

                $minDate = new Query\Range();
                $minDate->addField('timeDeparture',['gte' => 'now']);
                $dateQ = new BoolQuery();
                $dateQ->addMust($minDate);

                $mainShold->addMust($dateQ);
                $stationShold->addMust($dateQ);
                $gpsMainShold->addMust($dateQ);
                $gpsStationShold->addMust($dateQ);

            }
            else{

                $dateString = $date->format('Y-m-d');
                $dateMatch = new Match();
                $dateMatch->setFieldQuery('timeDeparture', $dateString);
                $mainShold->addMust($dateMatch);
                $stationShold->addMust($dateMatch);
                $gpsMainShold->addMust($dateMatch);
                $gpsStationShold->addMust($dateMatch);

            }

            $bool->addShould($mainShold);
            $bool->addShould($stationShold);

            $bool->addShould($gpsMainShold);
            $bool->addShould($gpsStationShold);

        }

        $query = Query::create($bool);

        return $this->find($query,3000);
    }

}