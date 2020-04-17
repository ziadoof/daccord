<?php

namespace App\Entity;

use App\Entity\Location\City;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 */
class Driver
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="driver", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carBrand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carColor;

    /**
     * @var string $carImage
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $carImage;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxDistance;

    /**
     * @ORM\Column(type="integer")
     */
    private $point;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City", inversedBy="drivers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="float")
     */
    private $gpsLat;

    /**
     * @ORM\Column(type="float")
     */
    private $gpsLng;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $feedback;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DriverRequest", mappedBy="driver")
     */
    private $driverRequests;

    /**
     * Driver constructor.
     */
    public function __construct()
    {
        $this->point = 10;
        $this->active = true;
        $this->driverRequests = new ArrayCollection();
    }

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

    public function getCarBrand(): ?string
    {
        return $this->carBrand;
    }

    public function setCarBrand(string $carBrand): self
    {
        $this->carBrand = $carBrand;

        return $this;
    }

    public function getCarColor(): ?string
    {
        return $this->carColor;
    }

    public function setCarColor(string $carColor): self
    {
        $this->carColor = $carColor;

        return $this;
    }

    public function getCarImage(): ?string
    {
        return $this->carImage;
    }

    public function setCarImage(?string $carImage): self
    {
        $this->carImage = $carImage;

        return $this;
    }

    public function getMaxDistance(): ?int
    {
        return $this->maxDistance;
    }

    public function setMaxDistance(int $maxDistance): self
    {
        $this->maxDistance = $maxDistance;

        return $this;
    }

    public function getPoint(): ?int
    {
        return $this->point;
    }

    public function setPoint(int $point): self
    {
        $this->point = $point;

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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getGpsLat(): ?float
    {
        return $this->gpsLat;
    }

    public function setGpsLat(float $gpsLat): self
    {
        $this->gpsLat = $gpsLat;

        return $this;
    }

    public function getGpsLng(): ?float
    {
        return $this->gpsLng;
    }

    public function setGpsLng(float $gpsLng): self
    {
        $this->gpsLng = $gpsLng;

        return $this;
    }

    public function getFeedback(): ?float
    {
        return $this->feedback;
    }

    public function setFeedback(?float $feedback): self
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * @return Collection|DriverRequest[]
     */
    public function getDriverRequests(): Collection
    {
        return $this->driverRequests;
    }

    public function addDriverRequest(DriverRequest $driverRequest): self
    {
        if (!$this->driverRequests->contains($driverRequest)) {
            $this->driverRequests[] = $driverRequest;
            $driverRequest->setDriver($this);
        }

        return $this;
    }

    public function removeDriverRequest(DriverRequest $driverRequest): self
    {
        if ($this->driverRequests->contains($driverRequest)) {
            $this->driverRequests->removeElement($driverRequest);
            // set the owning side to null (unless already changed)
            if ($driverRequest->getDriver() === $this) {
                $driverRequest->setDriver(null);
            }
        }

        return $this;
    }

    public function photoDriver(){
        if(!$this->carImage || $this->carImage === 'with out photo'){
            return '/assets/images/car_driver/driver-avatar.png';
        }
        return '/assets/images/car_driver/'.$this->getCarImage();
    }
}
