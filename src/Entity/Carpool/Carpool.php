<?php

namespace App\Entity\Carpool;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Carpool\CarpoolRepository")
 */
class Carpool
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="carpool", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $carBrand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $carColor;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfPassengers;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bag;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $animal;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $baby;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bankCard;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $conversation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $music;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Carpool\Voyage", mappedBy="creator", orphanRemoval=true)
     */
    private $voyages;

    /**
     * @ORM\Column(type="integer")
     */
    private $point;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $carImage;

    public function __construct()
    {
        $this->voyages = new ArrayCollection();
        $this->point = 10;
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

    public function setCarBrand(?string $carBrand): self
    {
        $this->carBrand = $carBrand;

        return $this;
    }

    public function getCarColor(): ?string
    {
        return $this->carColor;
    }

    public function setCarColor(?string $carColor): self
    {
        $this->carColor = $carColor;

        return $this;
    }

    public function getNumberOfPassengers(): ?int
    {
        return $this->numberOfPassengers;
    }

    public function setNumberOfPassengers(int $numberOfPassengers): self
    {
        $this->numberOfPassengers = $numberOfPassengers;

        return $this;
    }

    public function getBag(): ?bool
    {
        return $this->bag;
    }

    public function setBag(?bool $bag): self
    {
        $this->bag = $bag;

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

    public function getBaby(): ?bool
    {
        return $this->baby;
    }

    public function setBaby(?bool $baby): self
    {
        $this->baby = $baby;

        return $this;
    }

    public function getBankCard(): ?bool
    {
        return $this->bankCard;
    }

    public function setBankCard(?bool $bankCard): self
    {
        $this->bankCard = $bankCard;

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

    public function getMusic(): ?bool
    {
        return $this->music;
    }

    public function setMusic(?bool $music): self
    {
        $this->music = $music;

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
            $voyage->setCreator($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): self
    {
        if ($this->voyages->contains($voyage)) {
            $this->voyages->removeElement($voyage);
            // set the owning side to null (unless already changed)
            if ($voyage->getCreator() === $this) {
                $voyage->setCreator(null);
            }
        }

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

    public function getCarImage(): ?string
    {
        return $this->carImage;
    }

    public function setCarImage(?string $carImage): self
    {
        $this->carImage = $carImage;

        return $this;
    }

    public function photoCarpool(){
        if(!$this->carImage || $this->carImage === 'with out photo'){
            return '/assets/images/carpool/carpool.png';
        }
        return '/assets/images/carpool/'.$this->getCarImage();
    }
}
