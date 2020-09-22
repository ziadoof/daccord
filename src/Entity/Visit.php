<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisitRepository")
 */
class Visit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ip;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $pagesVisited;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $idOfUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;


    /**
     * Visit constructor.
     *
     */
    public function __construct($ip)
    {
        $this->ip = $ip;
        $this->date = new \DateTime('now');
        $this->pagesVisited = 1;
        $this->idOfUser = 0;
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
        if($query && $query['status'] == 'success'){
            $this->city = $query['city'];
            $this->zipcode = $query['zip'];
            $this->region = $query['regionName'];
        }
        else{
            $this->city = 'Unknown';
            $this->zipcode = 'Unknown';
            $this->region = 'Unknown';
        }

    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

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
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getPagesVisited()
    {
        return $this->pagesVisited;
    }

    /**
     * @param mixed $pagesVisited
     */
    public function setPagesVisited($pagesVisited): void
    {
        $this->pagesVisited = $pagesVisited;
    }

    /**
     * @return mixed
     */
    public function getIdOfUser()
    {
        return $this->idOfUser;
    }

    /**
     * @param mixed $idOfUser
     */
    public function setIdOfUser($idOfUser): void
    {
        $this->idOfUser = $idOfUser;
    }

}
