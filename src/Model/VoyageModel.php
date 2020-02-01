<?php


namespace App\Model;

use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Entity\Location\Region;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
class VoyageModel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City", inversedBy="voyages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mainDeparture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mainArrival;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City", inversedBy="voyages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stationDeparture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stationArrival;
    /**
     * @ORM\Column(type="float")
     */
    private $mainPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $stationPrice;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $passenger;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getHighway()
    {
        return $this->highway;
    }

    /**
     * @param mixed $highway
     */
    public function setHighway($highway): void
    {
        $this->highway = $highway;
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
     * @return mixed
     */
    public function getPassenger()
    {
        return $this->passenger;
    }

    /**
     * @param mixed $passenger
     */
    public function setPassenger($passenger): void
    {
        $this->passenger = $passenger;
    }





}