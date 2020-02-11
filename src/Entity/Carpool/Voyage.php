<?php

namespace App\Entity\Carpool;

use App\Entity\Location\City;
use App\Entity\User;
use App\Repository\Location\CityRepository;
use DateInterval;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Carpool\VoyageRepository")
 */
class Voyage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Carpool\Carpool", inversedBy="voyages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City", inversedBy="voyages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mainDeparture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $placeMainDeparture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mainArrival;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $placeMainArrival;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $highway;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City")
     * @ORM\JoinColumn(nullable=true)
     */
    private $stationDeparture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $placeStationDeparture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City")
     * @ORM\JoinColumn(nullable=true)
     */
    private $stationArrival;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $placeStationArrival;

    /**
     * @ORM\Column(type="integer")
     */
    private $mainPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    private $numberOfPlaces;

    /**
     *  @ORM\Column(type="integer", nullable=true)
     */
    private $stationDuration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stationDistance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $distance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $timeDeparture;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $timeArrival;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $stationPrice;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $passenger;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Carpool\VoyageRequest", mappedBy="voyage", orphanRemoval=true)
     */
    private $voyageRequests;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Carpool\Station", mappedBy="voyage",cascade={"persist"})
     */
    private $stations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Carpool\Voyage", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Carpool\Voyage", mappedBy="parent")
     */
    private $children;


    public function __construct()
    {
        $this->passenger = new ArrayCollection();
        $this->stations = new ArrayCollection();
        $this->voyageRequests = new ArrayCollection();
        $this->children = new ArrayCollection();

    }

    /**
     * @return mixed
     */
    public function getTimeDeparture()
    {
        return $this->timeDeparture;
    }

    /**
     * @param mixed $timeDeparture
     */
    public function setTimeDeparture($timeDeparture): void
    {
        $this->timeDeparture = $timeDeparture;
    }

    /**
     * @return mixed
     */
    public function getTimeArrival()
    {
        return $this->timeArrival;
    }

    /**
     * @param mixed $timeArrival
     */
    public function setTimeArrival($timeArrival): void
    {
        $this->timeArrival = $timeArrival;
    }


    /**
     * @return mixed
     */
    public function getStationDistance()
    {
        return $this->stationDistance;
    }

    /**
     * @param mixed $stationDistance
     */
    public function setStationDistance($stationDistance): void
    {
        $this->stationDistance = $stationDistance;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    public function fixDuration($duration){
        return gmdate('H:i', $duration);
    }
    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance): void
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getStationDuration()
    {
        return $this->stationDuration;
    }

    /**
     * @param mixed $stationDuration
     */
    public function setStationDuration($stationDuration): void
    {
        $this->stationDuration = $stationDuration;
    }




    /**
     * @return mixed
     */
    public function getNumberOfPlaces()
    {
        return $this->numberOfPlaces;
    }

    /**
     * @param mixed $numberOfPlaces
     */
    public function setNumberOfPlaces($numberOfPlaces): void
    {
        $this->numberOfPlaces = $numberOfPlaces;
    }



    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreator(): ?Carpool
    {
        return $this->creator;
    }

    public function setCreator(?Carpool $creator): self
    {
        $this->creator = $creator;

        return $this;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getHighway(): ?bool
    {
        return $this->highway;
    }

    public function setHighway(?bool $highway): self
    {
        $this->highway = $highway;

        return $this;
    }


    /**
     * @return Collection|User[]
     */
    public function getPassenger(): Collection
    {
        return $this->passenger;
    }

    public function addPassenger(User $passenger): self
    {
        if (!$this->passenger->contains($passenger)) {
            $this->passenger[] = $passenger;
        }

        return $this;
        /*$this->passenger[] = $passenger;
        return $this;*/
    }

    public function removePassenger(User $passenger): self
    {
        if ($this->passenger->contains($passenger)) {
            $this->passenger->removeElement($passenger);
        }

        return $this;
    }


    /**
     * @return Collection|VoyageRequest[]
     */
    public function getVoyageRequests(): Collection
    {
        return $this->voyageRequests;
    }

    public function addVoyageRequest(VoyageRequest $voyageRequest): self
    {
        if (!$this->voyageRequests->contains($voyageRequest)) {
            $this->voyageRequests[] = $voyageRequest;
            $voyageRequest->setVoyage($this);
        }

        return $this;
    }

    public function removeVoyageRequest(VoyageRequest $voyageRequest): self
    {
        if ($this->voyageRequests->contains($voyageRequest)) {
            $this->voyageRequests->removeElement($voyageRequest);
            // set the owning side to null (unless already changed)
            if ($voyageRequest->getVoyage() === $this) {
                $voyageRequest->setVoyage(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMainDeparture()
    {
        return $this->mainDeparture;
    }

    /**
     * @param mixed $mainDeparture
     */
    public function setMainDeparture($mainDeparture): void
    {
        $this->mainDeparture = $mainDeparture;
    }

    /**
     * @return mixed
     */
    public function getMainArrival()
    {
        return $this->mainArrival;
    }

    /**
     * @param mixed $mainArrival
     */
    public function setMainArrival($mainArrival): void
    {
        $this->mainArrival = $mainArrival;
    }

    /**
     * @return mixed
     */
    public function getStationDeparture()
    {
        return $this->stationDeparture;
    }

    /**
     * @param mixed $stationDeparture
     */
    public function setStationDeparture($stationDeparture): void
    {
        $this->stationDeparture = $stationDeparture;
    }

    /**
     * @return mixed
     */
    public function getStationArrival()
    {
        return $this->stationArrival;
    }

    /**
     * @param mixed $stationArrival
     */
    public function setStationArrival($stationArrival): void
    {
        $this->stationArrival = $stationArrival;
    }

    /**
     * @return mixed
     */
    public function getMainPrice()
    {
        return $this->mainPrice;
    }

    /**
     * @param mixed $mainPrice
     */
    public function setMainPrice($mainPrice): void
    {
        $this->mainPrice = $mainPrice;
    }

    /**
     * @return mixed
     */
    public function getStationPrice()
    {
        return $this->stationPrice;
    }

    /**
     * @param mixed $stationPrice
     */
    public function setStationPrice($stationPrice): void
    {
        $this->stationPrice = $stationPrice;
    }

    /**
     * @return Collection|Station[]
     */
    public function getStations(): Collection
    {
        return $this->stations;
    }

    public function addStation(Station $station): self
    {
        if (!$this->stations->contains($station)) {
            $this->stations[] = $station;
        }

        return $this;
    }

    public function removeStation(Station $station): self
    {
        if ($this->stations->contains($station)) {
            $this->stations->removeElement($station);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlaceMainDeparture()
    {
        return $this->placeMainDeparture;
    }

    /**
     * @param mixed $placeMainDeparture
     */
    public function setPlaceMainDeparture($placeMainDeparture): void
    {
        $this->placeMainDeparture = $placeMainDeparture;
    }

    /**
     * @return mixed
     */
    public function getPlaceMainArrival()
    {
        return $this->placeMainArrival;
    }

    /**
     * @param mixed $placeMainArrival
     */
    public function setPlaceMainArrival($placeMainArrival): void
    {
        $this->placeMainArrival = $placeMainArrival;
    }


    /**
     * @return mixed
     */
    public function getPlaceStationDeparture()
    {
        return $this->placeStationDeparture;
    }

    /**
     * @param mixed $placeStationDeparture
     */
    public function setPlaceStationDeparture($placeStationDeparture): void
    {
        $this->placeStationDeparture = $placeStationDeparture;
    }

    /**
     * @return mixed
     */
    public function getPlaceStationArrival()
    {
        return $this->placeStationArrival;
    }

    /**
     * @param mixed $placeStationArrival
     */
    public function setPlaceStationArrival($placeStationArrival): void
    {
        $this->placeStationArrival = $placeStationArrival;
    }

    public function parentVoyage()
    {
        if($this->parent !== null){
            return $this->parent;
        }
        return $this;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    public function serializer(): array
    {
        $stations = $this->getStations()->toArray();
        $arrayStations=[];
        foreach ($stations as $station){
            $arrayStations[]= [
              'city'=>$station->getCity()->getId(),
              'place'=>$station->getPlace(),
              'sort'=>$station->getSort(),
              'duration'=>$station->getDuration(),
              'distance'=>$station->getDistance(),
            ];
        }
        return [
            'mainDeparture'=> $this->getMainDeparture()->getId(),
            'placeMainDeparture'=> $this->getPlaceMainDeparture(),
            'mainArrival'=> $this->getMainArrival()->getId(),
            'placeMainArrival'=> $this->getPlaceMainArrival(),
            'date'=> $this->getDate(),
            'time'=> $this->getTime(),
            'distance'=> $this->getDistance(),
            'duration'=> $this->getDuration(),
            'stations'=> $arrayStations,
        ];
    }

    public function normalizer(array $serializer, CityRepository $repo): Voyage
    {

        $this->setPlaceMainArrival($serializer['placeMainArrival']);
        $this->setPlaceMainDeparture($serializer['placeMainDeparture']);
        $this->setDate($serializer['date']);
        $this->setTime($serializer['time']);
        $this->setMainDeparture($repo->findById($serializer['mainDeparture']));
        $this->setMainArrival($repo->findById($serializer['mainArrival']));
        $this->setDistance((int)$serializer['distance']);
        $this->setDuration((int)$serializer['duration']);
        $arrayStations = $serializer['stations'];

        foreach ($arrayStations as $station){
            $oneStations = new Station();
            $oneStations->setCity($repo->findById($station['city']));
            $oneStations->setPlace($station['place']);
            $oneStations->setSort($station['sort']);
            $oneStations->setDuration((int)$station['duration']);
            $oneStations->setDistance((int)$station['distance']);
            $this->addStation($oneStations);
        }

            return $this;
    }

    public function createTime(\DateTimeInterface $date,\DateTimeInterface $time,int $duration): \DateTime
    {
        $year = $date->format('Y');
        $month = $date->format('m');
        $day = $date->format('d');
        $datetime = new \DateTime();
        $datetime->setDate($year,$month,$day);
        $hours=$time->format('H');
        $minutes=$time->format('i');
        $second=$time->format('s');
        $datetime->setTime($hours,$minutes,$second);
        try {
            $datetime->add(new DateInterval('PT' . $duration . 'S'));
        } catch (\Exception $e) {
        }
        return $datetime;
    }

    public function searchSerialize(){
        if($this->getParent() !== null){
            $departure = $this->getStationDeparture()->getName();
            $arrival = $this->getStationArrival()->getName();
            $price = $this->getStationPrice();
        }
        else{
            $departure = $this->getMainDeparture()->getName();
            $arrival = $this->getMainArrival()->getName();
            $price = $this->getMainPrice();
        }

        if($this->getTimeArrival()->format('d')=== $this->getTimeDeparture()->format('d')){
            $arrivalDate ='.';
        }
        elseif($this->getTimeArrival()->format('d')=== $this->getTimeDeparture()->format('d')+1){
            $arrivalDate ='Next day';
        }
        else{
            $arrivalDate =$this->getTimeArrival()->format('d-M');
        }

        return [
            'id'=>$this->getId(),
            'creatorName'=>$this->getCreator()->getUser()->getFirstname(),
            'creatorImage'=>$this->getCreator()->getUser()->photoProfile(),
            'creatorPoint'=>$this->getCreator()->getPoint(),
            /*'creatorRating'=>$this->getCreator()->getRating(),*/
            'highway'=>$this->getHighway(),
            'timeDeparture'=>$this->getTimeDeparture()->format('H:i'),
            'timeArrival'=>$this->getTimeArrival()->format('H:i'),
            'departure'=>$departure,
            'arrival'=>$arrival,
            'price'=>$price,
            'arrivalDate'=>$arrivalDate,
            'departureDate'=>$this->getTimeDeparture()->format('d M')
        ];

    }

    public function durationToTime($duration){
        if ($duration/60 <60) {
            return gmdate(('i'),$duration).' Minutes';
        }

        if($duration/60/60<24) {
            return gmdate(('H\h i'),$duration).' Minutes';
        }

        return gmdate(('d \Day H\h i'),$duration).' Minutes';
    }
    public function isFinish(){
        $now = new \DateTime('now');
        return $now > $this->getTimeArrival();
    }

    public function getAllVoyageRequests(): array
    {
        $requests = $this->getVoyageRequests()->toArray();
        if($this->getParent() === null){
            $children = $this->getChildren()->toArray();
            foreach ($children as $child){
                if(!empty($child->getVoyageRequests()->toArray())){
                    foreach ($child->getVoyageRequests() as $voyageRequest){
                        $requests[]= $voyageRequest;
                    }
                }
            }
        }

        return $requests;
    }


    public function getAllPassengers(): array
    {
        $allPassengers = [];
        $passengers = $this->getPassenger()->toArray();
        foreach ($passengers as $passenger){
            $allPassengers[]=['voyage'=>$this,'passenger'=>$passenger];
        }

        if($this->getParent() === null){
            $children = $this->getChildren()->toArray();
            foreach ($children as $child){
                if(!empty($child->getPassenger()->toArray())){
                    foreach ($child->getPassenger()->toArray() as $childPassenger){
                        $allPassengers[]=['voyage'=>$child,'passenger'=>$childPassenger];
                    }
                }
            }
        }
        return $allPassengers;
    }

    public function isPassenger(User $user): bool
    {
        return in_array($user, $this->getPassenger()->toArray(), true);
    }
    public function haveRequest(User $user){

        foreach ($this->getVoyageRequests()->toArray() as $request){
            if($request->getSender()===$user &&($request->getStatus()==='Pending' || $request->getStatus()==='Rejected')){
                return $request;
            }
        }
        return false;
    }

    public function isClosedVoyage(): bool
    {
        // if one or more small voyage closed return true
        if($this->parent === null){
            $children = $this->getChildren()->toArray();
            if(empty($children)){
                $numberOfPlaces = $this->getNumberOfPlaces();
                $passengers = $this->getPassenger()->toArray();
                $numberOfPassengerSeats =0;
                foreach ($passengers as $passenger){
                    $numberOfPassengerSeats += $this->getPassengerSeats($passenger);
                }
                return $numberOfPassengerSeats === $numberOfPlaces;
            }
            foreach ($children as $child){
                $numberOfPlaces = $this->getNumberOfPlaces();
                $passengers = $child->getPassenger()->toArray();
                $numberOfPassengerSeats =0;
                foreach ($passengers as $passenger){
                    $numberOfPassengerSeats += $this->getPassengerSeats($passenger);
                }
                if($numberOfPassengerSeats === $numberOfPlaces){
                    return true;
                    break;
                }
            }
            return false;
        }

        $smallVoyages=$this->getSmallVoyages($this);
        if(!empty($smallVoyages)){
            foreach ($smallVoyages as $smallVoyage){
                $numberOfPlaces = $smallVoyage->getParent()->getNumberOfPlaces();
                $passengers = $smallVoyage->getPassenger()->toArray();
                $numberOfPassengerSeats =0;
                foreach ($passengers as $passenger){
                    $numberOfPassengerSeats += $this->getPassengerSeats($passenger);
                }
                if($numberOfPassengerSeats === $numberOfPlaces){
                    return true;
                    break;
                }
            }
            return false;
        }

        $numberOfPlaces = $this->getParent()->getNumberOfPlaces();
        $passengers = $this->getPassenger()->toArray();
        $numberOfPassengerSeats =0;
        foreach ($passengers as $passenger){
            $numberOfPassengerSeats += $this->getPassengerSeats($passenger);
        }
        return $numberOfPassengerSeats === $numberOfPlaces;
    }


    //return all small voyage between voyage departure and voyage arrival
    public function getSmallVoyages(Voyage $voyage): array
    {
        $voyageRelated= $this->getVoyageRelated($voyage);
        $departureCites=[$voyage->getStationDeparture()->getId()];
        foreach ($voyageRelated as $oneVoyage){
            $departureCites[]=$oneVoyage;
        }
        $children = $voyage->parentVoyage()->getChildren()->toArray();
        $smallVoyages=[];
        for($i=0;$i<count($departureCites)-1;$i++){
            foreach ($children as $child){
                if($child->getStationDeparture()->getId()===$departureCites[$i] && $child->getStationArrival()->getid() === $departureCites[$i+1]){
                    $smallVoyages[]=$child;
                }
            }
        }
        return$smallVoyages;
    }

    //return all cities id that th voyage well passe
    public function getVoyageRelated(Voyage $voyage): array
    {

        $allCity = [$voyage->parentVoyage()->getMainDeparture()->getId()];
        foreach ($voyage->parentVoyage()->getStations() as $station){
            $allCity[]=$station->getCity()->getId();
        }
        $allCity[]=$voyage->parentVoyage()->getMainArrival()->getId();

        $departure = 0;
        $arrival = 0;
        foreach ($allCity as $key=>$city){
            if($voyage->getStationDeparture()->getId()=== $city){
                $departure = $key;
            }
            if($voyage->getStationArrival()->getId()=== $city){
                $arrival = $key;
            }
        }
        $citesRelated = [];
        foreach ($allCity as $key=>$city){
            if($key >$departure && $key<=$arrival ){
                $citesRelated []=$city;
            }
        }
        if(!empty($citesRelated)){
            return $citesRelated;
        }
        return [];

    }

    public function getAvailableSeats(Voyage $voyage){

        $smallVoyages = $this->getSmallVoyages($voyage);
        $numberOfPlaces = $voyage->parentVoyage()->getNumberOfPlaces();
        $list =[];

        foreach ($smallVoyages as $smallVoyage){
            $class=[];
            for($i=1;$i<=$numberOfPlaces;$i++){
                $class[]= true;
            }
            $passengers = $smallVoyage->getPassenger();
            foreach ($passengers as $passenger){
                if($passenger){
                    $seats = $this->getPassengerSeats($passenger);
                    for($i=0;$i<$seats;$i++){
                        array_unshift($class,false);
                        array_pop($class);
                    }
                }
            }
            $list[]=$class;
        }
        $num=[];
        foreach ($list as $classes) {
            $int = 0;
            foreach ($classes as $item){
                if($item){
                    $int++;
                }
            }
            $num[]=$int;
        }
        if(!empty($num)){
            return min($num);
        }
        return $voyage->getNumberOfPlaces();
    }

    public function getVoyageMap(): array
    {
        $parentVoyage = $this->parentVoyage();
        $voyageRelated = $this->getVoyageRelated($this) ;
        $arrival = array_pop($voyageRelated) ;
        $stations = $parentVoyage->getStations()->toArray();
        $smallVoyages = $this->getSmallVoyages($this->parentVoyage());
        $firstPassengers = [];
        foreach ($smallVoyages[0]->getPassenger() as $passenger){
            $firstPassengers [] = ['user' => $passenger->photoProfile(),'seats'=>$this->getPassengerSeats($passenger)];
        }

        $voyageMap [] = ['time'=>$smallVoyages[0]->getTimeDeparture(),'city'=>$smallVoyages[0]->getStationDeparture()->getName(),
            'departure'=>($this->getStationDeparture() === $smallVoyages[0]->getStationDeparture()),
            'arrival'=>false,
            'station'=>false,
            'passenger'=>$firstPassengers,
            'first'=> true,
            'last'=> false,
            'availableSeats'=>$this->getAvailableSeats($smallVoyages[0])
        ];

        foreach ($stations as $station){
            $listPassengers =[];
            foreach ($smallVoyages[$station->getSort()]->getPassenger() as $passenger){
                $listPassengers [] = ['user' => $passenger->photoProfile(),'seats'=>$this->getPassengerSeats($passenger)];
            }
            $voyageMap[] = ['time'=>$smallVoyages[$station->getSort()]->getTimeDeparture(),'city'=>$smallVoyages[$station->getSort()]->getStationDeparture()->getName(),
                'departure'=>($this->getStationDeparture() === $smallVoyages[$station->getSort()]->getStationDeparture()),
                'arrival'=>($this->getStationArrival() === $station->getCity()),
                'station'=>(in_array($station->getCity()->getId(),$voyageRelated,true)),
                'passenger'=>$listPassengers,
                'first'=>false,
                'last'=>false,
                'availableSeats'=>$this->getAvailableSeats($smallVoyages[$station->getSort()])
            ];
        }

        $voyageMap [] = ['time'=>$parentVoyage->getTimeArrival(),'city'=>$parentVoyage->getStationArrival()->getName(),
            'departure'=>false,
            'arrival'=>($this->getStationArrival() === $parentVoyage->getStationArrival()),
            'station'=>false,
            'passenger'=>false,
            'first'=>false,
            'last'=>true,
            'availableSeats'=>false

        ];

        return $voyageMap;
    }

    public function getPassengerSeats(User $passenger){
        $voyageRequests = $this->parentVoyage()->getAllVoyageRequests();
        $numberOfSeats = 0;
        foreach ($voyageRequests as $request){
            if ($request->getStatus()==='Accepted' && $request->getSender()===$passenger){
                $numberOfSeats = $request->getNumberOfSeats();
            }
        }
        return $numberOfSeats;
    }

}
