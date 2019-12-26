<?php


namespace App\Model;

use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Entity\Location\Region;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
class HostingModel
{


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\Department")
     */
    private $department;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\Region")
     */
    private $region;

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     */
    public function setDepartment($department): void
    {
        $this->department = $department;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City", inversedBy="hostings")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $ville;

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville): void
    {
        $this->ville = $ville;
    }

    /**
     * @ORM\Column(type="integer")
     */
    protected $numberOfPersons;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $numberOfDays;

    /**
     * @ORM\Column(type="array")
     */
    protected $languages = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $sex;


    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $animal;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $child;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $handicapped;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $food;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $conversation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $cityTour;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $videoGame;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $movie;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $television;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $music;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;


    /**
     * @return mixed
     */
    public function getNumberOfPersons()
    {
        return $this->numberOfPersons;
    }

    /**
     * @param mixed $numberOfPersons
     */
    public function setNumberOfPersons($numberOfPersons): void
    {
        $this->numberOfPersons = $numberOfPersons;
    }

    /**
     * @return mixed
     */
    public function getNumberOfDays()
    {
        return $this->numberOfDays;
    }

    /**
     * @param mixed $numberOfDays
     */
    public function setNumberOfDays($numberOfDays): void
    {
        $this->numberOfDays = $numberOfDays;
    }

    /**
     * @return array
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @param array $languages
     */
    public function setLanguages(array $languages): void
    {
        $this->languages = $languages;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * @param mixed $animal
     */
    public function setAnimal($animal): void
    {
        $this->animal = $animal;
    }

    /**
     * @return mixed
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * @param mixed $child
     */
    public function setChild($child): void
    {
        $this->child = $child;
    }

    /**
     * @return mixed
     */
    public function getHandicapped()
    {
        return $this->handicapped;
    }

    /**
     * @param mixed $handicapped
     */
    public function setHandicapped($handicapped): void
    {
        $this->handicapped = $handicapped;
    }

    /**
     * @return mixed
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * @param mixed $food
     */
    public function setFood($food): void
    {
        $this->food = $food;
    }

    /**
     * @return mixed
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * @param mixed $conversation
     */
    public function setConversation($conversation): void
    {
        $this->conversation = $conversation;
    }

    /**
     * @return mixed
     */
    public function getCityTour()
    {
        return $this->cityTour;
    }

    /**
     * @param mixed $cityTour
     */
    public function setCityTour($cityTour): void
    {
        $this->cityTour = $cityTour;
    }

    /**
     * @return mixed
     */
    public function getVideoGame()
    {
        return $this->videoGame;
    }

    /**
     * @param mixed $videoGame
     */
    public function setVideoGame($videoGame): void
    {
        $this->videoGame = $videoGame;
    }

    /**
     * @return mixed
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param mixed $movie
     */
    public function setMovie($movie): void
    {
        $this->movie = $movie;
    }

    /**
     * @return mixed
     */
    public function getTelevision()
    {
        return $this->television;
    }

    /**
     * @param mixed $television
     */
    public function setTelevision($television): void
    {
        $this->television = $television;
    }

    /**
     * @return mixed
     */
    public function getMusic()
    {
        return $this->music;
    }

    /**
     * @param mixed $music
     */
    public function setMusic($music): void
    {
        $this->music = $music;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }



}