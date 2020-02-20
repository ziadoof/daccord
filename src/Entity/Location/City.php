<?php

namespace App\Entity\Location;

use App\Entity\Carpool\Voyage;
use App\Entity\Driver;
use App\Entity\Hosting\Hosting;
use App\Entity\Meetup\Meetup;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Location\CityRepository")
 */
class City
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $inseeCode;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="float")
     */
    private $gpsLat;

    /**
     * @ORM\Column(type="float")
     */
    private $gpsLng;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\Department", inversedBy="citys")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $department;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="city")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Driver", mappedBy="city")
     */
    private $drivers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hosting\Hosting", mappedBy="ville")
     */
    private $hostings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Meetup\Meetup", mappedBy="city")
     */
    private $meetups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Carpool\Voyage", mappedBy="mainDeparture")
     */
    private $voyages;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->drivers = new ArrayCollection();
        $this->hostings = new ArrayCollection();
        $this->meetups = new ArrayCollection();
        $this->voyages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInseeCode(): ?string
    {
        return $this->inseeCode;
    }

    public function setInseeCode(string $inseeCode): self
    {
        $this->inseeCode = $inseeCode;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setVille($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getVille() === $this) {
                $user->setVille(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name .' ('. $this->getZipCode().')';
    }

    /**
     * @return Collection|Driver[]
     */
    public function getDrivers(): Collection
    {
        return $this->drivers;
    }

    public function addDriver(Driver $driver): self
    {
        if (!$this->drivers->contains($driver)) {
            $this->drivers[] = $driver;
            $driver->setCity($this);
        }

        return $this;
    }

    public function removeDriver(Driver $driver): self
    {
        if ($this->drivers->contains($driver)) {
            $this->drivers->removeElement($driver);
            // set the owning side to null (unless already changed)
            if ($driver->getCity() === $this) {
                $driver->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hosting[]
     */
    public function getHostings(): Collection
    {
        return $this->hostings;
    }

    public function addHosting(Hosting $hosting): self
    {
        if (!$this->hostings->contains($hosting)) {
            $this->hostings[] = $hosting;
            $hosting->setCity($this);
        }

        return $this;
    }

    public function removeHosting(Hosting $hosting): self
    {
        if ($this->hostings->contains($hosting)) {
            $this->hostings->removeElement($hosting);
            // set the owning side to null (unless already changed)
            if ($hosting->getCity() === $this) {
                $hosting->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Meetup[]
     */
    public function getMeetups(): Collection
    {
        return $this->meetups;
    }

    public function addMeetup(Meetup $meetup): self
    {
        if (!$this->meetups->contains($meetup)) {
            $this->meetups[] = $meetup;
            $meetup->setCity($this);
        }

        return $this;
    }

    public function removeMeetup(Meetup $meetup): self
    {
        if ($this->meetups->contains($meetup)) {
            $this->meetups->removeElement($meetup);
            // set the owning side to null (unless already changed)
            if ($meetup->getCity() === $this) {
                $meetup->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Voyage[]
     */
    public function getVoyages(): Collection
    {
        return $this->voyages;
    }

    public function addVoyage(Voyage $voyage): self
    {
        if (!$this->voyages->contains($voyage)) {
            $this->voyages[] = $voyage;
            $voyage->setMainDeparture($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): self
    {
        if ($this->voyages->contains($voyage)) {
            $this->voyages->removeElement($voyage);
            // set the owning side to null (unless already changed)
            if ($voyage->getMainDeparture() === $this) {
                $voyage->setMainDeparture(null);
            }
        }

        return $this;
    }

}
