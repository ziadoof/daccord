<?php

namespace App\Entity\Ads;

use App\Entity\Location\City;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * @ORM\Entity(repositoryClass="App\Repository\Ads\AdRepository")
 * @ORM\Table()
 *
 */
class Ad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("string")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageOne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageTow;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageThree;

//-------------------------
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $gpsLat;
    /**
    * @ORM\Column(type="float", nullable=true)
    */
    private $gpsLng;

    /**
     * @return mixed
     */
    public function getGpsLat()
    {
        return $this->gpsLat;
    }

    /**
     * @param mixed $gpsLat
     */
    public function setGpsLat($gpsLat): void
    {
        $this->gpsLat = $gpsLat;
    }

    /**
     * @return mixed
     */
    public function getGpsLng()
    {
        return $this->gpsLng;
    }

    /**
     * @param mixed $gpsLng
     */
    public function setGpsLng($gpsLng): void
    {
        $this->gpsLng = $gpsLng;
    }

//-------------------------

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $price;

    /**
     * @return mixed
     */
    public function getPPrice()
    {
        return $this->pPrice;
    }

    /**
     * @param mixed $pPrice
     */
    public function setPPrice($pPrice): void
    {
        $this->pPrice = $pPrice;
    }

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $pPrice;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $donate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateOfAd;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeOfAd;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads\Category", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $category;

    /**
     * @return mixed
     */
    public function getGeneralCategory()
    {
        return $this->generalCategory;
    }

    /**
     * @param mixed $generalCategory
     */
    public function setGeneralCategory($generalCategory): void
    {
        $this->generalCategory = $generalCategory;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads\Category")
     *
     *
     */
    private $generalCategory;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

/*-------------------start specification -------------------*/

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $withDriver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mission;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $theType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondLanguage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $age;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $iSize;

    /**
     * @return mixed
     */
    public function getISize()
    {
        return $this->iSize;
    }

    /**
     * @param mixed $iSize
     */
    public function setISize($iSize): void
    {
        $this->iSize = $iSize;
    }

    /**
     * @return mixed
     */
    public function getSSize()
    {
        return $this->sSize;
    }

    /**
     * @param mixed $sSize
     */
    public function setSSize($sSize): void
    {
        $this->sSize = $sSize;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sSize;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $languages = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $acitvityArea;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $workHours;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeOfContract;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $levelOfStudy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeOfTranslation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $material;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $placeOfLesson;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $levelOfStudent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fuelType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $changeGear;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $manufactureCompany;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $generalSituation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $paperSize;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $printingType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $printingColor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $analogDigital;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $animalSpecies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dvdCd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $originCountry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coverMaterial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shape;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heating;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heatingType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $classEnergie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ges;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eventType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subjectName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $salary;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $durationOfLesson;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $maxDistance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $manufacturingYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $maxManufacturingYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $minManufacturingYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $numberOfPassengers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $numberOfDoors;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $kilometer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $maxKilometer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $minKilometer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $processor;



    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $ram;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $screenSizeCm;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $screenSizeInch;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $capacity;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $minCapacity;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $maxCapacity;

    /**
     * @return mixed
     */
    public function getMinCapacity()
    {
        return $this->minCapacity;
    }

    /**
     * @param mixed $minCapacity
     */
    public function setMinCapacity($minCapacity): void
    {
        $this->minCapacity = $minCapacity;
    }

    /**
     * @return mixed
     */
    public function getMaxCapacity()
    {
        return $this->maxCapacity;
    }

    /**
     * @param mixed $maxCapacity
     */
    public function setMaxCapacity($maxCapacity): void
    {
        $this->maxCapacity = $maxCapacity;
    }

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $accuracy;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $weight;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $caliber;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $maxCaliber;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $minCaliber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $number;


    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $width;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $height;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $numberOfPersson;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $length;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $numberOfDrawer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $numberOfStaging;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $numberOfHead;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $ability;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $floor;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $area;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $minArea;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $maxArea;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $numberOfRooms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $minNumberOfRooms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $maxNumberOfRooms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="You must enter numbers only."
     * )
     */
    private $numberOfFloors;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hdmi;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cdRoom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $wifi;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $usb;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $threeInOne;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $accessories;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $withFreezer;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $electricHead;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $withOven;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $covered;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $withFurniture;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $withGarden;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $withVerandah;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $withElevator;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateOfEvent;

    /**
     *  @ORM\ManyToOne(targetEntity="App\Entity\Location\City",)
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City",)
     */
    private $ville;

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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }


    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
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

    /**
     * @return mixed
     */
    public function getImageOne()
    {
        return $this->imageOne;
    }

    /**
     * @param mixed $imageOne
     */
    public function setImageOne($imageOne): void
    {
        $this->imageOne = $imageOne;
    }

    /**
     * @return mixed
     */
    public function getImageTow()
    {
        return $this->imageTow;
    }

    /**
     * @param mixed $imageTow
     */
    public function setImageTow($imageTow): void
    {
        $this->imageTow = $imageTow;
    }

    /**
     * @return mixed
     */
    public function getImageThree()
    {
        return $this->imageThree;
    }

    /**
     * @param mixed $imageThree
     */
    public function setImageThree($imageThree): void
    {
        $this->imageThree = $imageThree;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDonate()
    {
        return $this->donate;
    }

    /**
     * @param mixed $donate
     */
    public function setDonate($donate): void
    {
        $this->donate = $donate;
    }

    /**
     * @return mixed
     */
    public function getDateOfAd()
    {
        return $this->dateOfAd;
    }

    /**
     * @param mixed $dateOfAd
     */
    public function setDateOfAd($dateOfAd): void
    {
        $this->dateOfAd = $dateOfAd;
    }

    /**
     * @return mixed
     */
    public function getTypeOfAd()
    {
        return $this->typeOfAd;
    }

    /**
     * @param mixed $typeOfAd
     */
    public function setTypeOfAd($typeOfAd): void
    {
        $this->typeOfAd = $typeOfAd;
    }

    /**
     * @return mixed
     */
    public function getWithDriver()
    {
        return $this->withDriver;
    }

    /**
     * @param mixed $withDriver
     */
    public function setWithDriver($withDriver): void
    {
        $this->withDriver = $withDriver;
    }

    /**
     * @return mixed
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * @param mixed $mission
     */
    public function setMission($mission): void
    {
        $this->mission = $mission;
    }

    /**
     * @return mixed
     */
    public function getTheType()
    {
        return $this->theType;
    }

    /**
     * @param mixed $theType
     */
    public function setTheType($theType): void
    {
        $this->theType = $theType;
    }

    /**
     * @return mixed
     */
    public function getSecondLanguage()
    {
        return $this->secondLanguage;
    }

    /**
     * @param mixed $secondLanguage
     */
    public function setSecondLanguage($secondLanguage): void
    {
        $this->secondLanguage = $secondLanguage;
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
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param mixed $languages
     */
    public function setLanguages($languages): void
    {
        $this->languages = $languages;
    }

    /**
     * @return mixed
     */
    public function getAcitvityArea()
    {
        return $this->acitvityArea;
    }

    /**
     * @param mixed $acitvityArea
     */
    public function setAcitvityArea($acitvityArea): void
    {
        $this->acitvityArea = $acitvityArea;
    }

    /**
     * @return mixed
     */
    public function getTypeOfContract()
    {
        return $this->typeOfContract;
    }

    /**
     * @return mixed
     */
    public function getWorkHours()
    {
        return $this->workHours;
    }

    /**
     * @param mixed $workHours
     */
    public function setWorkHours($workHours): void
    {
        $this->workHours = $workHours;
    }

    /**
     * @param mixed $typeOfContract
     */
    public function setTypeOfContract($typeOfContract): void
    {
        $this->typeOfContract = $typeOfContract;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param mixed $experience
     */
    public function setExperience($experience): void
    {
        $this->experience = $experience;
    }

    /**
     * @return mixed
     */
    public function getLevelOfStudy()
    {
        return $this->levelOfStudy;
    }

    /**
     * @param mixed $levelOfStudy
     */
    public function setLevelOfStudy($levelOfStudy): void
    {
        $this->levelOfStudy = $levelOfStudy;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getTypeOfTranslation()
    {
        return $this->typeOfTranslation;
    }

    /**
     * @param mixed $typeOfTranslation
     */
    public function setTypeOfTranslation($typeOfTranslation): void
    {
        $this->typeOfTranslation = $typeOfTranslation;
    }

    /**
     * @return mixed
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param mixed $material
     */
    public function setMaterial($material): void
    {
        $this->material = $material;
    }

    /**
     * @return mixed
     */
    public function getPlaceOfLesson()
    {
        return $this->placeOfLesson;
    }

    /**
     * @param mixed $placeOfLesson
     */
    public function setPlaceOfLesson($placeOfLesson): void
    {
        $this->placeOfLesson = $placeOfLesson;
    }

    /**
     * @return mixed
     */
    public function getLevelOfStudent()
    {
        return $this->levelOfStudent;
    }

    /**
     * @param mixed $levelOfStudent
     */
    public function setLevelOfStudent($levelOfStudent): void
    {
        $this->levelOfStudent = $levelOfStudent;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getFuelType()
    {
        return $this->fuelType;
    }

    /**
     * @param mixed $fuelType
     */
    public function setFuelType($fuelType): void
    {
        $this->fuelType = $fuelType;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getChangeGear()
    {
        return $this->changeGear;
    }

    /**
     * @param mixed $changeGear
     */
    public function setChangeGear($changeGear): void
    {
        $this->changeGear = $changeGear;
    }

    /**
     * @return mixed
     */
    public function getManufactureCompany()
    {
        return $this->manufactureCompany;
    }

    /**
     * @param mixed $manufactureCompany
     */
    public function setManufactureCompany($manufactureCompany): void
    {
        $this->manufactureCompany = $manufactureCompany;
    }

    /**
     * @return mixed
     */
    public function getGeneralSituation()
    {
        return $this->generalSituation;
    }

    /**
     * @param mixed $generalSituation
     */
    public function setGeneralSituation($generalSituation): void
    {
        $this->generalSituation = $generalSituation;
    }

    /**
     * @return mixed
     */
    public function getPaperSize()
    {
        return $this->paperSize;
    }

    /**
     * @param mixed $paperSize
     */
    public function setPaperSize($paperSize): void
    {
        $this->paperSize = $paperSize;
    }

    /**
     * @return mixed
     */
    public function getPrintingType()
    {
        return $this->printingType;
    }

    /**
     * @param mixed $printingType
     */
    public function setPrintingType($printingType): void
    {
        $this->printingType = $printingType;
    }

    /**
     * @return mixed
     */
    public function getPrintingColor()
    {
        return $this->printingColor;
    }

    /**
     * @param mixed $printingColor
     */
    public function setPrintingColor($printingColor): void
    {
        $this->printingColor = $printingColor;
    }

    /**
     * @return mixed
     */
    public function getAnalogDigital()
    {
        return $this->analogDigital;
    }

    /**
     * @param mixed $analogDigital
     */
    public function setAnalogDigital($analogDigital): void
    {
        $this->analogDigital = $analogDigital;
    }

    /**
     * @return mixed
     */
    public function getAnimalSpecies()
    {
        return $this->animalSpecies;
    }

    /**
     * @param mixed $animalSpecies
     */
    public function setAnimalSpecies($animalSpecies): void
    {
        $this->animalSpecies = $animalSpecies;
    }

    /**
     * @return mixed
     */
    public function getDvdCd()
    {
        return $this->dvdCd;
    }

    /**
     * @param mixed $dvdCd
     */
    public function setDvdCd($dvdCd): void
    {
        $this->dvdCd = $dvdCd;
    }

    /**
     * @return mixed
     */
    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    /**
     * @param mixed $originCountry
     */
    public function setOriginCountry($originCountry): void
    {
        $this->originCountry = $originCountry;
    }

    /**
     * @return mixed
     */
    public function getCoverMaterial()
    {
        return $this->coverMaterial;
    }

    /**
     * @param mixed $coverMaterial
     */
    public function setCoverMaterial($coverMaterial): void
    {
        $this->coverMaterial = $coverMaterial;
    }

    /**
     * @return mixed
     */
    public function getShape()
    {
        return $this->shape;
    }

    /**
     * @param mixed $shape
     */
    public function setShape($shape): void
    {
        $this->shape = $shape;
    }

    /**
     * @return mixed
     */
    public function getHeating()
    {
        return $this->heating;
    }

    /**
     * @param mixed $heating
     */
    public function setHeating($heating): void
    {
        $this->heating = $heating;
    }

    /**
     * @return mixed
     */
    public function getHeatingType()
    {
        return $this->heatingType;
    }

    /**
     * @param mixed $heatingType
     */
    public function setHeatingType($heatingType): void
    {
        $this->heatingType = $heatingType;
    }

    /**
     * @return mixed
     */
    public function getClassEnergie()
    {
        return $this->classEnergie;
    }

    /**
     * @param mixed $classEnergie
     */
    public function setClassEnergie($classEnergie): void
    {
        $this->classEnergie = $classEnergie;
    }

    /**
     * @return mixed
     */
    public function getGes()
    {
        return $this->ges;
    }

    /**
     * @param mixed $ges
     */
    public function setGes($ges): void
    {
        $this->ges = $ges;
    }

    /**
     * @return mixed
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @param mixed $eventType
     */
    public function setEventType($eventType): void
    {
        $this->eventType = $eventType;
    }

    /**
     * @return mixed
     */
    public function getSubjectName()
    {
        return $this->subjectName;
    }

    /**
     * @param mixed $subjectName
     */
    public function setSubjectName($subjectName): void
    {
        $this->subjectName = $subjectName;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function getDurationOfLesson()
    {
        return $this->durationOfLesson;
    }

    /**
     * @param mixed $durationOfLesson
     */
    public function setDurationOfLesson($durationOfLesson): void
    {
        $this->durationOfLesson = $durationOfLesson;
    }

    /**
     * @return mixed
     */
    public function getMaxDistance()
    {
        return $this->maxDistance;
    }

    /**
     * @param mixed $maxDistance
     */
    public function setMaxDistance($maxDistance): void
    {
        $this->maxDistance = $maxDistance;
    }

    /**
     * @return mixed
     */
    public function getManufacturingYear()
    {
        return $this->manufacturingYear;
    }

    /**
     * @param mixed $manufacturingYear
     */
    public function setManufacturingYear($manufacturingYear): void
    {
        $this->manufacturingYear = $manufacturingYear;
    }

    /**
     * @return mixed
     */
    public function getMaxManufacturingYear()
    {
        return $this->maxManufacturingYear;
    }

    /**
     * @param mixed $maxManufacturingYear
     */
    public function setMaxManufacturingYear($maxManufacturingYear): void
    {
        $this->maxManufacturingYear = $maxManufacturingYear;
    }

    /**
     * @return mixed
     */
    public function getMinManufacturingYear()
    {
        return $this->minManufacturingYear;
    }

    /**
     * @param mixed $minManufacturingYear
     */
    public function setMinManufacturingYear($minManufacturingYear): void
    {
        $this->minManufacturingYear = $minManufacturingYear;
    }

    /**
     * @return mixed
     */
    public function getNumberOfPassengers()
    {
        return $this->numberOfPassengers;
    }

    /**
     * @param mixed $numberOfPassengers
     */
    public function setNumberOfPassengers($numberOfPassengers): void
    {
        $this->numberOfPassengers = $numberOfPassengers;
    }

    /**
     * @return mixed
     */
    public function getNumberOfDoors()
    {
        return $this->numberOfDoors;
    }

    /**
     * @param mixed $numberOfDoors
     */
    public function setNumberOfDoors($numberOfDoors): void
    {
        $this->numberOfDoors = $numberOfDoors;
    }

    /**
     * @return mixed
     */
    public function getKilometer()
    {
        return $this->kilometer;
    }

    /**
     * @param mixed $kilometer
     */
    public function setKilometer($kilometer): void
    {
        $this->kilometer = $kilometer;
    }

    /**
     * @return mixed
     */
    public function getMaxKilometer()
    {
        return $this->maxKilometer;
    }

    /**
     * @param mixed $maxKilometer
     */
    public function setMaxKilometer($maxKilometer): void
    {
        $this->maxKilometer = $maxKilometer;
    }

    /**
     * @return mixed
     */
    public function getMinKilometer()
    {
        return $this->minKilometer;
    }

    /**
     * @param mixed $minKilometer
     */
    public function setMinKilometer($minKilometer): void
    {
        $this->minKilometer = $minKilometer;
    }

    /**
     * @return mixed
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * @param mixed $processor
     */
    public function setProcessor($processor): void
    {
        $this->processor = $processor;
    }

    /**
     * @return mixed
     */
    public function getRam()
    {
        return $this->ram;
    }

    /**
     * @param mixed $ram
     */
    public function setRam($ram): void
    {
        $this->ram = $ram;
    }

    /**
     * @return mixed
     */
    public function getScreenSizeCm()
    {
        return $this->screenSizeCm;
    }

    /**
     * @param mixed $screenSizeCm
     */
    public function setScreenSizeCm($screenSizeCm): void
    {
        $this->screenSizeCm = $screenSizeCm;
    }

    /**
     * @return mixed
     */
    public function getScreenSizeInch()
    {
        return $this->screenSizeInch;
    }

    /**
     * @param mixed $screenSizeInch
     */
    public function setScreenSizeInch($screenSizeInch): void
    {
        $this->screenSizeInch = $screenSizeInch;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity): void
    {
        $this->capacity = $capacity;
    }

    /**
     * @return mixed
     */
    public function getAccuracy()
    {
        return $this->accuracy;
    }

    /**
     * @param mixed $accuracy
     */
    public function setAccuracy($accuracy): void
    {
        $this->accuracy = $accuracy;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getCaliber()
    {
        return $this->caliber;
    }

    /**
     * @param mixed $caliber
     */
    public function setCaliber($caliber): void
    {
        $this->caliber = $caliber;
    }

    /**
     * @return mixed
     */
    public function getMaxCaliber()
    {
        return $this->maxCaliber;
    }

    /**
     * @param mixed $maxCaliber
     */
    public function setMaxCaliber($maxCaliber): void
    {
        $this->maxCaliber = $maxCaliber;
    }

    /**
     * @return mixed
     */
    public function getMinCaliber()
    {
        return $this->minCaliber;
    }

    /**
     * @param mixed $minCaliber
     */
    public function setMinCaliber($minCaliber): void
    {
        $this->minCaliber = $minCaliber;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getNumberOfPersson()
    {
        return $this->numberOfPersson;
    }

    /**
     * @param mixed $numberOfPersson
     */
    public function setNumberOfPersson($numberOfPersson): void
    {
        $this->numberOfPersson = $numberOfPersson;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length): void
    {
        $this->length = $length;
    }

    /**
     * @return mixed
     */
    public function getNumberOfDrawer()
    {
        return $this->numberOfDrawer;
    }

    /**
     * @param mixed $numberOfDrawer
     */
    public function setNumberOfDrawer($numberOfDrawer): void
    {
        $this->numberOfDrawer = $numberOfDrawer;
    }

    /**
     * @return mixed
     */
    public function getNumberOfStaging()
    {
        return $this->numberOfStaging;
    }

    /**
     * @param mixed $numberOfStaging
     */
    public function setNumberOfStaging($numberOfStaging): void
    {
        $this->numberOfStaging = $numberOfStaging;
    }

    /**
     * @return mixed
     */
    public function getNumberOfHead()
    {
        return $this->numberOfHead;
    }

    /**
     * @param mixed $numberOfHead
     */
    public function setNumberOfHead($numberOfHead): void
    {
        $this->numberOfHead = $numberOfHead;
    }

    /**
     * @return mixed
     */
    public function getAbility()
    {
        return $this->ability;
    }

    /**
     * @param mixed $ability
     */
    public function setAbility($ability): void
    {
        $this->ability = $ability;
    }

    /**
     * @return mixed
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param mixed $floor
     */
    public function setFloor($floor): void
    {
        $this->floor = $floor;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     */
    public function setArea($area): void
    {
        $this->area = $area;
    }

    /**
     * @return mixed
     */
    public function getMinArea()
    {
        return $this->minArea;
    }

    /**
     * @param mixed $minArea
     */
    public function setMinArea($minArea): void
    {
        $this->minArea = $minArea;
    }

    /**
     * @return mixed
     */
    public function getMaxArea()
    {
        return $this->maxArea;
    }

    /**
     * @param mixed $maxArea
     */
    public function setMaxArea($maxArea): void
    {
        $this->maxArea = $maxArea;
    }

    /**
     * @return mixed
     */
    public function getNumberOfRooms()
    {
        return $this->numberOfRooms;
    }

    /**
     * @param mixed $numberOfRooms
     */
    public function setNumberOfRooms($numberOfRooms): void
    {
        $this->numberOfRooms = $numberOfRooms;
    }

    /**
     * @return mixed
     */
    public function getMinNumberOfRooms()
    {
        return $this->minNumberOfRooms;
    }

    /**
     * @param mixed $minNumberOfRooms
     */
    public function setMinNumberOfRooms($minNumberOfRooms): void
    {
        $this->minNumberOfRooms = $minNumberOfRooms;
    }

    /**
     * @return mixed
     */
    public function getMaxNumberOfRooms()
    {
        return $this->maxNumberOfRooms;
    }

    /**
     * @param mixed $maxNumberOfRooms
     */
    public function setMaxNumberOfRooms($maxNumberOfRooms): void
    {
        $this->maxNumberOfRooms = $maxNumberOfRooms;
    }

    /**
     * @return mixed
     */
    public function getNumberOfFloors()
    {
        return $this->numberOfFloors;
    }

    /**
     * @param mixed $numberOfFloors
     */
    public function setNumberOfFloors($numberOfFloors): void
    {
        $this->numberOfFloors = $numberOfFloors;
    }

    /**
     * @return mixed
     */
    public function getHdmi()
    {
        return $this->hdmi;
    }

    /**
     * @param mixed $hdmi
     */
    public function setHdmi($hdmi): void
    {
        $this->hdmi = $hdmi;
    }

    /**
     * @return mixed
     */
    public function getCdRoom()
    {
        return $this->cdRoom;
    }

    /**
     * @param mixed $cdRoom
     */
    public function setCdRoom($cdRoom): void
    {
        $this->cdRoom = $cdRoom;
    }

    /**
     * @return mixed
     */
    public function getWifi()
    {
        return $this->wifi;
    }

    /**
     * @param mixed $wifi
     */
    public function setWifi($wifi): void
    {
        $this->wifi = $wifi;
    }

    /**
     * @return mixed
     */
    public function getUsb()
    {
        return $this->usb;
    }

    /**
     * @param mixed $usb
     */
    public function setUsb($usb): void
    {
        $this->usb = $usb;
    }

    /**
     * @return mixed
     */
    public function getThreeInOne()
    {
        return $this->threeInOne;
    }

    /**
     * @param mixed $threeInOne
     */
    public function setThreeInOne($threeInOne): void
    {
        $this->threeInOne = $threeInOne;
    }

    /**
     * @return mixed
     */
    public function getAccessories()
    {
        return $this->accessories;
    }

    /**
     * @param mixed $accessories
     */
    public function setAccessories($accessories): void
    {
        $this->accessories = $accessories;
    }

    /**
     * @return mixed
     */
    public function getWithFreezer()
    {
        return $this->withFreezer;
    }

    /**
     * @param mixed $withFreezer
     */
    public function setWithFreezer($withFreezer): void
    {
        $this->withFreezer = $withFreezer;
    }

    /**
     * @return mixed
     */
    public function getElectricHead()
    {
        return $this->electricHead;
    }

    /**
     * @param mixed $electricHead
     */
    public function setElectricHead($electricHead): void
    {
        $this->electricHead = $electricHead;
    }

    /**
     * @return mixed
     */
    public function getWithOven()
    {
        return $this->withOven;
    }

    /**
     * @param mixed $withOven
     */
    public function setWithOven($withOven): void
    {
        $this->withOven = $withOven;
    }

    /**
     * @return mixed
     */
    public function getCovered()
    {
        return $this->covered;
    }

    /**
     * @param mixed $covered
     */
    public function setCovered($covered): void
    {
        $this->covered = $covered;
    }

    /**
     * @return mixed
     */
    public function getWithFurniture()
    {
        return $this->withFurniture;
    }

    /**
     * @param mixed $withFurniture
     */
    public function setWithFurniture($withFurniture): void
    {
        $this->withFurniture = $withFurniture;
    }

    /**
     * @return mixed
     */
    public function getWithGarden()
    {
        return $this->withGarden;
    }

    /**
     * @param mixed $withGarden
     */
    public function setWithGarden($withGarden): void
    {
        $this->withGarden = $withGarden;
    }

    /**
     * @return mixed
     */
    public function getWithVerandah()
    {
        return $this->withVerandah;
    }

    /**
     * @param mixed $withVerandah
     */
    public function setWithVerandah($withVerandah): void
    {
        $this->withVerandah = $withVerandah;
    }

    /**
     * @return mixed
     */
    public function getWithElevator()
    {
        return $this->withElevator;
    }

    /**
     * @param mixed $withElevator
     */
    public function setWithElevator($withElevator): void
    {
        $this->withElevator = $withElevator;
    }

    /**
     * @return mixed
     */
    public function getDateOfEvent()
    {
        return $this->dateOfEvent;
    }

    /**
     * @param mixed $dateOfEvent
     */
    public function setDateOfEvent($dateOfEvent): void
    {
        $this->dateOfEvent = $dateOfEvent;
    }

    public function __construct()
    {
        $this->dateOfAd = new \DateTime('now');
    }
    public function __toString()
    {
        return $this->title;
    }

    public function getAllSpecifications(){
       $vars  = get_object_vars($this);
       $all = [];
       $exp = ['id','title','imageOne','imageTow','imageThree','donate','price','dateOfAd','typeOfAd','user','description'];
       foreach ($vars as $key=>$value){
           if(!in_array($key,$exp)){
               if($value !== null){
                   $all[$key]=$value;
               }
           }
       }
        return $all;
    }
}
