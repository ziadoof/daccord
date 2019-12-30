<?php

namespace App\Entity\Hosting;

use App\Entity\Location\City;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Hosting\HostingRepository")
 */
class Hosting
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="hosting", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\Department")
     */
    private $department;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\Region")
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City", inversedBy="hostings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville;

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
    private $numberOfPersons;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfDays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="array")
     */
    private $languages = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="text")
     */
    private $aboutMe;

    /**
     * @ORM\Column(type="text")
     */
    private $hostingFor;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $animal;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $child;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $handicapped;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $food;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $conversation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cityTour;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $videoGame;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $movie;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $television;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $music;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * Hosting constructor.
     * @param $active
     * @param $point
     */
    public function __construct()
    {
        $this->active = false;
        $this->point = 0;
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

    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @param mixed $point
     */
    public function setPoint($point): void
    {
        $this->point = $point;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $point;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }


    public function getNumberOfPersons(): ?int
    {
        return $this->numberOfPersons;
    }

    public function setNumberOfPersons(int $numberOfPersons): self
    {
        $this->numberOfPersons = $numberOfPersons;

        return $this;
    }

    public function getNumberOfDays(): ?int
    {
        return $this->numberOfDays;
    }

    public function setNumberOfDays(?int $numberOfDays): self
    {
        $this->numberOfDays = $numberOfDays;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    public function setLanguages(array $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getAboutMe(): ?string
    {
        return $this->aboutMe;
    }

    public function setAboutMe(string $aboutMe): self
    {
        $this->aboutMe = $aboutMe;

        return $this;
    }

    public function getHostingFor(): ?string
    {
        return $this->hostingFor;
    }

    public function setHostingFor(string $hostingFor): self
    {
        $this->hostingFor = $hostingFor;

        return $this;
    }

    public function getAnimal(): ?bool
    {
        return $this->animal;
    }

    public function setAnimal(?bool $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function getChild(): ?bool
    {
        return $this->child;
    }

    public function setChild(?bool $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getHandicapped(): ?bool
    {
        return $this->handicapped;
    }

    public function setHandicapped(?bool $handicapped): self
    {
        $this->handicapped = $handicapped;

        return $this;
    }

    public function getFood(): ?bool
    {
        return $this->food;
    }

    public function setFood(?bool $food): self
    {
        $this->food = $food;

        return $this;
    }

    public function getConversation(): ?bool
    {
        return $this->conversation;
    }

    public function setConversation(?bool $conversation): self
    {
        $this->conversation = $conversation;

        return $this;
    }

    public function getCityTour(): ?bool
    {
        return $this->cityTour;
    }

    public function setCityTour(?bool $cityTour): self
    {
        $this->cityTour = $cityTour;

        return $this;
    }

    public function getVideoGame(): ?bool
    {
        return $this->videoGame;
    }

    public function setVideoGame(?bool $videoGame): self
    {
        $this->videoGame = $videoGame;

        return $this;
    }

    public function getMovie(): ?bool
    {
        return $this->movie;
    }

    public function setMovie(?bool $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getTelevision(): ?bool
    {
        return $this->television;
    }

    public function setTelevision(?bool $television): self
    {
        $this->television = $television;

        return $this;
    }

    public function getMusic(): ?bool
    {
        return $this->music;
    }

    public function setMusic(?bool $music): self
    {
        $this->music = $music;

        return $this;
    }

     public function photoHosting(){
        if(!$this->image || $this->image === 'with out photo'){
            return '/assets/images/Hosting/hosting_avatar.png';
        }
         return '/assets/images/Hosting/'.$this->getImage();
     }

     public function getPossibility(){
        $possibility = [];
        if($this->animal){
            $possibility[] = 'Animal';
        }
         if($this->child){
             $possibility[] ='Child';
         }
         if($this->handicapped){
             $possibility[] ='Handicapped';
         }
        if(!empty($possibility)){
            return $possibility;
        }
         return false;
     }
     public function getShare(){
         $share = [];
         if($this->food){
             $share[] = 'Food';
         }
         if($this->conversation){
             $share[] ='Conversation';
         }
         if($this->cityTour){
             $share[] ='City Tour';
         }
         if($this->videoGame){
             $share[] ='Video Game';
         }
         if($this->movie){
             $share[] ='Movie';
         }
         if($this->television){
             $share[] ='Television';
         }
         if($this->music){
             $share[] ='Music';
         }
         if(!empty($share)){
             return $share;
         }
         return false;
     }

    public function serialize():array
    {

        $url = '../../assets/images/Hosting/';
        if($this->image === 'with out photo'|| $this->image === null){
            $image = $url.'hosting_avatar.png';
        }
        else{
            $image = $url.$this->getImage();
        }
        $firstname = ucfirst($this->getUser()->getFirstname());
        return [
            'id'=> $this->id,
            'user'=> $firstname,
            'city'=> $this->getVille()->getName(),
            'image'=> $image,
            'userImage'=>$this->getUser()->photoProfile()
        ];
    }
}
