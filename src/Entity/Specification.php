<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecificationRepository")
 */
class Specification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mission;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $acitvityArea;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fullPartial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeOfContract;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $generalSituation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
    private $keyboardLanguage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $analogDigital;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $machinName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $animalColor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $animalSpecies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filmName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bookName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dvdCd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $languageBookFilm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $originCountry;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $clothesMaterial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $clothesSize;

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
    private $gazType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heating;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heatingType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $classEnergie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     */
    private $salary;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $durationOfLesson;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxDistance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $manufacturingYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxManufacturingYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minManufacturingYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfPassengers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfDoors;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $kilometer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxKilometer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minKilometer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $processor;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hddCapacity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ram;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $screenSizeCm;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $screenSizeInch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $accuracy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $caliber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxCaliber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minCaliber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gauge;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sizePerfume;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shoeSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $parachuteSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $animalAge;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $kidsClothesSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfPersson;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $length;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $diapersSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacitySize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfDrawer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfStaging;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfHead;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $washingCapacity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ability;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tiresSize;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $floor;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $area;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minArea;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxArea;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $roomNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minRoomNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxRoomNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
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
    private $treeInOne;

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
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\City", cascade={"persist", "remove"})
     */
    private $city;

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(?string $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getAcitvityArea(): ?string
    {
        return $this->acitvityArea;
    }

    public function setAcitvityArea(?string $acitvityArea): self
    {
        $this->acitvityArea = $acitvityArea;

        return $this;
    }

    public function getFullPartial(): ?string
    {
        return $this->fullPartial;
    }

    public function setFullPartial(?string $fullPartial): self
    {
        $this->fullPartial = $fullPartial;

        return $this;
    }

    public function getTypeOfContract(): ?string
    {
        return $this->typeOfContract;
    }

    public function setTypeOfContract(?string $typeOfContract): self
    {
        $this->typeOfContract = $typeOfContract;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getLevelOfStudy(): ?string
    {
        return $this->levelOfStudy;
    }

    public function setLevelOfStudy(?string $levelOfStudy): self
    {
        $this->levelOfStudy = $levelOfStudy;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getTypeOfTranslation(): ?string
    {
        return $this->typeOfTranslation;
    }

    public function setTypeOfTranslation(?string $typeOfTranslation): self
    {
        $this->typeOfTranslation = $typeOfTranslation;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(?string $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getPlaceOfLesson(): ?string
    {
        return $this->placeOfLesson;
    }

    public function setPlaceOfLesson(?string $placeOfLesson): self
    {
        $this->placeOfLesson = $placeOfLesson;

        return $this;
    }

    public function getLevelOfStudent(): ?string
    {
        return $this->levelOfStudent;
    }

    public function setLevelOfStudent(?string $levelOfStudent): self
    {
        $this->levelOfStudent = $levelOfStudent;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    public function setFuelType(?string $fuelType): self
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getChangeGear(): ?string
    {
        return $this->changeGear;
    }

    public function setChangeGear(?string $changeGear): self
    {
        $this->changeGear = $changeGear;

        return $this;
    }

    public function getManufactureCompany(): ?string
    {
        return $this->manufactureCompany;
    }

    public function setManufactureCompany(?string $manufactureCompany): self
    {
        $this->manufactureCompany = $manufactureCompany;

        return $this;
    }

    public function getGeneralSituation(): ?string
    {
        return $this->generalSituation;
    }

    public function setGeneralSituation(?string $generalSituation): self
    {
        $this->generalSituation = $generalSituation;

        return $this;
    }

    public function getPaperSize(): ?string
    {
        return $this->paperSize;
    }

    public function setPaperSize(?string $paperSize): self
    {
        $this->paperSize = $paperSize;

        return $this;
    }

    public function getPrintingType(): ?string
    {
        return $this->printingType;
    }

    public function setPrintingType(?string $printingType): self
    {
        $this->printingType = $printingType;

        return $this;
    }

    public function getPrintingColor(): ?string
    {
        return $this->printingColor;
    }

    public function setPrintingColor(?string $printingColor): self
    {
        $this->printingColor = $printingColor;

        return $this;
    }

    public function getKeyboardLanguage(): ?string
    {
        return $this->keyboardLanguage;
    }

    public function setKeyboardLanguage(?string $keyboardLanguage): self
    {
        $this->keyboardLanguage = $keyboardLanguage;

        return $this;
    }

    public function getAnalogDigital(): ?string
    {
        return $this->analogDigital;
    }

    public function setAnalogDigital(?string $analogDigital): self
    {
        $this->analogDigital = $analogDigital;

        return $this;
    }

    public function getMachinName(): ?string
    {
        return $this->machinName;
    }

    public function setMachinName(?string $machinName): self
    {
        $this->machinName = $machinName;

        return $this;
    }

    public function getAnimalColor(): ?string
    {
        return $this->animalColor;
    }

    public function setAnimalColor(?string $animalColor): self
    {
        $this->animalColor = $animalColor;

        return $this;
    }

    public function getAnimalSpecies(): ?string
    {
        return $this->animalSpecies;
    }

    public function setAnimalSpecies(?string $animalSpecies): self
    {
        $this->animalSpecies = $animalSpecies;

        return $this;
    }

    public function getFilmName(): ?string
    {
        return $this->filmName;
    }

    public function setFilmName(?string $filmName): self
    {
        $this->filmName = $filmName;

        return $this;
    }

    public function getBookName(): ?string
    {
        return $this->bookName;
    }

    public function setBookName(?string $bookName): self
    {
        $this->bookName = $bookName;

        return $this;
    }

    public function getDvdCd(): ?string
    {
        return $this->dvdCd;
    }

    public function setDvdCd(?string $dvdCd): self
    {
        $this->dvdCd = $dvdCd;

        return $this;
    }

    public function getLanguageBookFilm(): ?string
    {
        return $this->languageBookFilm;
    }

    public function setLanguageBookFilm(?string $languageBookFilm): self
    {
        $this->languageBookFilm = $languageBookFilm;

        return $this;
    }

    public function getOriginCountry(): ?string
    {
        return $this->originCountry;
    }

    public function setOriginCountry(?string $originCountry): self
    {
        $this->originCountry = $originCountry;

        return $this;
    }

    public function getClothesMaterial(): ?string
    {
        return $this->clothesMaterial;
    }

    public function setClothesMaterial(?string $clothesMaterial): self
    {
        $this->clothesMaterial = $clothesMaterial;

        return $this;
    }

    public function getClothesSize(): ?string
    {
        return $this->clothesSize;
    }

    public function setClothesSize(?string $clothesSize): self
    {
        $this->clothesSize = $clothesSize;

        return $this;
    }

    public function getCoverMaterial(): ?string
    {
        return $this->coverMaterial;
    }

    public function setCoverMaterial(?string $coverMaterial): self
    {
        $this->coverMaterial = $coverMaterial;

        return $this;
    }

    public function getShape(): ?string
    {
        return $this->shape;
    }

    public function setShape(?string $shape): self
    {
        $this->shape = $shape;

        return $this;
    }

    public function getGazType(): ?string
    {
        return $this->gazType;
    }

    public function setGazType(?string $gazType): self
    {
        $this->gazType = $gazType;

        return $this;
    }

    public function getHeating(): ?string
    {
        return $this->heating;
    }

    public function setHeating(?string $heating): self
    {
        $this->heating = $heating;

        return $this;
    }

    public function getHeatingType(): ?string
    {
        return $this->heatingType;
    }

    public function setHeatingType(?string $heatingType): self
    {
        $this->heatingType = $heatingType;

        return $this;
    }

    public function getClassEnergie(): ?string
    {
        return $this->classEnergie;
    }

    public function setClassEnergie(?string $classEnergie): self
    {
        $this->classEnergie = $classEnergie;

        return $this;
    }

    public function getGes(): ?string
    {
        return $this->ges;
    }

    public function setGes(?string $ges): self
    {
        $this->ges = $ges;

        return $this;
    }

    public function getEventType(): ?string
    {
        return $this->eventType;
    }

    public function setEventType(?string $eventType): self
    {
        $this->eventType = $eventType;

        return $this;
    }

    public function getSubjectName(): ?string
    {
        return $this->subjectName;
    }

    public function setSubjectName(?string $subjectName): self
    {
        $this->subjectName = $subjectName;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(?int $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getDurationOfLesson(): ?int
    {
        return $this->durationOfLesson;
    }

    public function setDurationOfLesson(?int $durationOfLesson): self
    {
        $this->durationOfLesson = $durationOfLesson;

        return $this;
    }

    public function getMaxDistance(): ?int
    {
        return $this->maxDistance;
    }

    public function setMaxDistance(?int $maxDistance): self
    {
        $this->maxDistance = $maxDistance;

        return $this;
    }

    public function getManufacturingYear(): ?int
    {
        return $this->manufacturingYear;
    }

    public function setManufacturingYear(?int $manufacturingYear): self
    {
        $this->manufacturingYear = $manufacturingYear;

        return $this;
    }

    public function getMaxManufacturingYear(): ?int
    {
        return $this->maxManufacturingYear;
    }

    public function setMaxManufacturingYear(?int $maxManufacturingYear): self
    {
        $this->maxManufacturingYear = $maxManufacturingYear;

        return $this;
    }

    public function getMinManufacturingYear(): ?int
    {
        return $this->minManufacturingYear;
    }

    public function setMinManufacturingYear(?int $minManufacturingYear): self
    {
        $this->minManufacturingYear = $minManufacturingYear;

        return $this;
    }

    public function getNumberOfPassengers(): ?int
    {
        return $this->numberOfPassengers;
    }

    public function setNumberOfPassengers(?int $numberOfPassengers): self
    {
        $this->numberOfPassengers = $numberOfPassengers;

        return $this;
    }

    public function getNumberOfDoors(): ?int
    {
        return $this->numberOfDoors;
    }

    public function setNumberOfDoors(?int $numberOfDoors): self
    {
        $this->numberOfDoors = $numberOfDoors;

        return $this;
    }

    public function getKilometer(): ?int
    {
        return $this->kilometer;
    }

    public function setKilometer(?int $kilometer): self
    {
        $this->kilometer = $kilometer;

        return $this;
    }

    public function getMaxKilometer(): ?int
    {
        return $this->maxKilometer;
    }

    public function setMaxKilometer(?int $maxKilometer): self
    {
        $this->maxKilometer = $maxKilometer;

        return $this;
    }

    public function getMinKilometer(): ?int
    {
        return $this->minKilometer;
    }

    public function setMinKilometer(?int $minKilometer): self
    {
        $this->minKilometer = $minKilometer;

        return $this;
    }

    public function getProcessor(): ?int
    {
        return $this->processor;
    }

    public function setProcessor(?int $processor): self
    {
        $this->processor = $processor;

        return $this;
    }

    public function getHddCapacity(): ?int
    {
        return $this->hddCapacity;
    }

    public function setHddCapacity(?int $hddCapacity): self
    {
        $this->hddCapacity = $hddCapacity;

        return $this;
    }

    public function getRam(): ?int
    {
        return $this->ram;
    }

    public function setRam(?int $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getScreenSizeCm(): ?int
    {
        return $this->screenSizeCm;
    }

    public function setScreenSizeCm(?int $screenSizeCm): self
    {
        $this->screenSizeCm = $screenSizeCm;

        return $this;
    }

    public function getScreenSizeInch(): ?int
    {
        return $this->screenSizeInch;
    }

    public function setScreenSizeInch(?int $screenSizeInch): self
    {
        $this->screenSizeInch = $screenSizeInch;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getAccuracy(): ?int
    {
        return $this->accuracy;
    }

    public function setAccuracy(?int $accuracy): self
    {
        $this->accuracy = $accuracy;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCaliber(): ?int
    {
        return $this->caliber;
    }

    public function setCaliber(?int $caliber): self
    {
        $this->caliber = $caliber;

        return $this;
    }

    public function getMaxCaliber(): ?int
    {
        return $this->maxCaliber;
    }

    public function setMaxCaliber(?int $maxCaliber): self
    {
        $this->maxCaliber = $maxCaliber;

        return $this;
    }

    public function getMinCaliber(): ?int
    {
        return $this->minCaliber;
    }

    public function setMinCaliber(?int $minCaliber): self
    {
        $this->minCaliber = $minCaliber;

        return $this;
    }

    public function getGauge(): ?int
    {
        return $this->gauge;
    }

    public function setGauge(?int $gauge): self
    {
        $this->gauge = $gauge;

        return $this;
    }

    public function getSizePerfume(): ?int
    {
        return $this->sizePerfume;
    }

    public function setSizePerfume(?int $sizePerfume): self
    {
        $this->sizePerfume = $sizePerfume;

        return $this;
    }

    public function getShoeSize(): ?int
    {
        return $this->shoeSize;
    }

    public function setShoeSize(?int $shoeSize): self
    {
        $this->shoeSize = $shoeSize;

        return $this;
    }

    public function getParachuteSize(): ?int
    {
        return $this->parachuteSize;
    }

    public function setParachuteSize(?int $parachuteSize): self
    {
        $this->parachuteSize = $parachuteSize;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getAnimalAge(): ?int
    {
        return $this->animalAge;
    }

    public function setAnimalAge(?int $animalAge): self
    {
        $this->animalAge = $animalAge;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getKidsClothesSize(): ?int
    {
        return $this->kidsClothesSize;
    }

    public function setKidsClothesSize(?int $kidsClothesSize): self
    {
        $this->kidsClothesSize = $kidsClothesSize;

        return $this;
    }

    public function getNumberOfPersson(): ?int
    {
        return $this->numberOfPersson;
    }

    public function setNumberOfPersson(?int $numberOfPersson): self
    {
        $this->numberOfPersson = $numberOfPersson;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getDiapersSize(): ?int
    {
        return $this->diapersSize;
    }

    public function setDiapersSize(?int $diapersSize): self
    {
        $this->diapersSize = $diapersSize;

        return $this;
    }

    public function getCapacitySize(): ?int
    {
        return $this->capacitySize;
    }

    public function setCapacitySize(?int $capacitySize): self
    {
        $this->capacitySize = $capacitySize;

        return $this;
    }

    public function getNumberOfDrawer(): ?int
    {
        return $this->numberOfDrawer;
    }

    public function setNumberOfDrawer(?int $numberOfDrawer): self
    {
        $this->numberOfDrawer = $numberOfDrawer;

        return $this;
    }

    public function getNumberOfStaging(): ?int
    {
        return $this->numberOfStaging;
    }

    public function setNumberOfStaging(?int $numberOfStaging): self
    {
        $this->numberOfStaging = $numberOfStaging;

        return $this;
    }

    public function getNumberOfHead(): ?int
    {
        return $this->numberOfHead;
    }

    public function setNumberOfHead(?int $numberOfHead): self
    {
        $this->numberOfHead = $numberOfHead;

        return $this;
    }

    public function getWashingCapacity(): ?int
    {
        return $this->washingCapacity;
    }

    public function setWashingCapacity(?int $washingCapacity): self
    {
        $this->washingCapacity = $washingCapacity;

        return $this;
    }

    public function getAbility(): ?int
    {
        return $this->ability;
    }

    public function setAbility(?int $ability): self
    {
        $this->ability = $ability;

        return $this;
    }

    public function getTiresSize(): ?int
    {
        return $this->tiresSize;
    }

    public function setTiresSize(?int $tiresSize): self
    {
        $this->tiresSize = $tiresSize;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(?int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getArea(): ?int
    {
        return $this->area;
    }

    public function setArea(?int $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getMinArea(): ?int
    {
        return $this->minArea;
    }

    public function setMinArea(?int $minArea): self
    {
        $this->minArea = $minArea;

        return $this;
    }

    public function getMaxArea(): ?int
    {
        return $this->maxArea;
    }

    public function setMaxArea(?int $maxArea): self
    {
        $this->maxArea = $maxArea;

        return $this;
    }

    public function getRoomNumber(): ?int
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(?int $roomNumber): self
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    public function getMinRoomNumber(): ?int
    {
        return $this->minRoomNumber;
    }

    public function setMinRoomNumber(?int $minRoomNumber): self
    {
        $this->minRoomNumber = $minRoomNumber;

        return $this;
    }

    public function getMaxRoomNumber(): ?int
    {
        return $this->maxRoomNumber;
    }

    public function setMaxRoomNumber(?int $maxRoomNumber): self
    {
        $this->maxRoomNumber = $maxRoomNumber;

        return $this;
    }

    public function getNumberOfFloors(): ?int
    {
        return $this->numberOfFloors;
    }

    public function setNumberOfFloors(?int $numberOfFloors): self
    {
        $this->numberOfFloors = $numberOfFloors;

        return $this;
    }

    public function getHdmi(): ?bool
    {
        return $this->hdmi;
    }

    public function setHdmi(?bool $hdmi): self
    {
        $this->hdmi = $hdmi;

        return $this;
    }

    public function getCdRoom(): ?bool
    {
        return $this->cdRoom;
    }

    public function setCdRoom(?bool $cdRoom): self
    {
        $this->cdRoom = $cdRoom;

        return $this;
    }

    public function getWifi(): ?bool
    {
        return $this->wifi;
    }

    public function setWifi(?bool $wifi): self
    {
        $this->wifi = $wifi;

        return $this;
    }

    public function getUsb(): ?bool
    {
        return $this->usb;
    }

    public function setUsb(?bool $usb): self
    {
        $this->usb = $usb;

        return $this;
    }

    public function getTreeInOne(): ?bool
    {
        return $this->treeInOne;
    }

    public function setTreeInOne(?bool $treeInOne): self
    {
        $this->treeInOne = $treeInOne;

        return $this;
    }

    public function getAccessories(): ?bool
    {
        return $this->accessories;
    }

    public function setAccessories(?bool $accessories): self
    {
        $this->accessories = $accessories;

        return $this;
    }

    public function getWithFreezer(): ?bool
    {
        return $this->withFreezer;
    }

    public function setWithFreezer(?bool $withFreezer): self
    {
        $this->withFreezer = $withFreezer;

        return $this;
    }

    public function getElectricHead(): ?bool
    {
        return $this->electricHead;
    }

    public function setElectricHead(?bool $electricHead): self
    {
        $this->electricHead = $electricHead;

        return $this;
    }

    public function getWithOven(): ?bool
    {
        return $this->withOven;
    }

    public function setWithOven(?bool $withOven): self
    {
        $this->withOven = $withOven;

        return $this;
    }

    public function getCovered(): ?bool
    {
        return $this->covered;
    }

    public function setCovered(?bool $covered): self
    {
        $this->covered = $covered;

        return $this;
    }

    public function getWithFurniture(): ?bool
    {
        return $this->withFurniture;
    }

    public function setWithFurniture(?bool $withFurniture): self
    {
        $this->withFurniture = $withFurniture;

        return $this;
    }

    public function getWithGarden(): ?bool
    {
        return $this->withGarden;
    }

    public function setWithGarden(?bool $withGarden): self
    {
        $this->withGarden = $withGarden;

        return $this;
    }

    public function getWithVerandah(): ?bool
    {
        return $this->withVerandah;
    }

    public function setWithVerandah(?bool $withVerandah): self
    {
        $this->withVerandah = $withVerandah;

        return $this;
    }

    public function getWithElevator(): ?bool
    {
        return $this->withElevator;
    }

    public function setWithElevator(?bool $withElevator): self
    {
        $this->withElevator = $withElevator;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

}
