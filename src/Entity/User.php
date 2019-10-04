<?php

namespace App\Entity;

use App\Entity\Ads\Ad;
use App\Entity\Deal\Deal;
use App\Entity\Deal\DoneDeal;
use App\Entity\Location\City;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email", message="Email déjà pris")
 * @UniqueEntity(fields="username", message="Username déjà pris")
 */
class User  extends BaseUser implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $firstname;

   /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $lastname;

   /**
    * @ORM\Column(type="boolean")
    */
    private $emailStatus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $postalCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location\City", inversedBy="users")
     *
     */
    private $city;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $phonNumberStatus;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="boolean")
     */
    private $genderStatus;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\Column(type="boolean")
     */
    private $birthdayStatus;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mapX;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mapY;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profileImage;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxDistance;

    /**
     * @ORM\Column(type="integer")
     */
    private $point;


    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ads\Ad", mappedBy="user", orphanRemoval=true)
     */
    private $ads;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Deal\Deal", mappedBy="offerUser", orphanRemoval=true)
     */
    private $offerDeals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Deal\Deal", mappedBy="demandUser", orphanRemoval=true)
     */
    private $demandDeals;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Driver", mappedBy="user", cascade={"persist", "remove"})
     */
    private $driver;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Deal\DoneDeal", mappedBy="offerUser")
     */
    private $offerDoneDeals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Deal\DoneDeal", mappedBy="demandUser")
     */
    private $demandDoneDeals;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmailStatus(): ?bool
    {
        return $this->emailStatus;
    }

    public function setEmailStatus(bool $emailStatus): self
    {
        $this->emailStatus = $emailStatus;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(?int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPhonNumberStatus(): ?bool
    {
        return $this->phonNumberStatus;
    }

    public function setPhonNumberStatus(bool $phonNumberStatus): self
    {
        $this->phonNumberStatus = $phonNumberStatus;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getGenderStatus(): ?bool
    {
        return $this->genderStatus;
    }

    public function setGenderStatus(bool $genderStatus): self
    {
        $this->genderStatus = $genderStatus;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getBirthdayStatus(): ?bool
    {
        return $this->birthdayStatus;
    }

    public function setBirthdayStatus(bool $birthdayStatus): self
    {
        $this->birthdayStatus = $birthdayStatus;

        return $this;
    }

    public function getMapX(): ?float
    {
        return $this->mapX;
    }

    public function setMapX(?float $mapX): self
    {
        $this->mapX = $mapX;

        return $this;
    }

    public function getMapY(): ?float
    {
        return $this->mapY;
    }

    public function setMapY(?float $mapY): self
    {
        $this->mapY = $mapY;

        return $this;
    }

    public function getProfileImage(): ?string
    {
        return $this->profileImage;
    }

    public function setProfileImage(?string $profileImage): self
    {
        $this->profileImage = $profileImage;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

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
    public function __toString()
    {
        return $this->firstname;
    }

    public function __construct()
    {
        parent::__construct();
        $this->setCreatedAt(new \DateTime('now'));
        $this->setEmailStatus(false);
        $this->setEnabled(true);
        $this->setMaxDistance(10);
        $this->setPhonNumberStatus(false);
        $this->setPoint(10);
        $this->setBirthdayStatus(false);
        $this->setFirstname('Utilisateur');
        $this->setLastname( (string) $this->getId());
        $this->setUsername("onadaccordUser" );
        $this->setgenderStatus(false );
        $this->ads = new ArrayCollection();
        $this->offerDeals = new ArrayCollection();
        $this->demandDeals = new ArrayCollection();
        $this->offerDoneDeals = new ArrayCollection();
        $this->demandDoneDeals = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Ad[]
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ad $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setUser($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->contains($ad)) {
            $this->ads->removeElement($ad);
            // set the owning side to null (unless already changed)
            if ($ad->getUser() === $this) {
                $ad->setUser(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Deal[]
     */
    public function getOfferDeals(): Collection
    {
        return $this->offerDeals;
    }

    public function addOfferDeal(Deal $offerDeal): self
    {
        if (!$this->offerDeals->contains($offerDeal)) {
            $this->offerDeals[] = $offerDeal;
            $offerDeal->setOfferUser($this);
        }

        return $this;
    }

    public function removeOfferDeal(Deal $offerDeal): self
    {
        if ($this->offerDeals->contains($offerDeal)) {
            $this->offerDeals->removeElement($offerDeal);
            // set the owning side to null (unless already changed)
            if ($offerDeal->getOfferUser() === $this) {
                $offerDeal->setOfferUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Deal[]
     */
    public function getDemandDeals(): Collection
    {
        return $this->demandDeals;
    }

    public function addDemandDeal(Deal $demandDeal): self
    {
        if (!$this->demandDeals->contains($demandDeal)) {
            $this->demandDeals[] = $demandDeal;
            $demandDeal->setDemandUser($this);
        }

        return $this;
    }

    public function removeDemandDeal(Deal $demandDeal): self
    {
        if ($this->demandDeals->contains($demandDeal)) {
            $this->demandDeals->removeElement($demandDeal);
            // set the owning side to null (unless already changed)
            if ($demandDeal->getDemandUser() === $this) {
                $demandDeal->setDemandUser(null);
            }
        }

        return $this;
    }

    public function getDeals(){
        $deals = new ArrayCollection(
            array_merge($this->getOfferDeals()->toArray(), $this->getDemandDeals()->toArray())
        );
        return $deals;
    }

    public function getDoneDeals(){
        $deals = new ArrayCollection(
            array_merge($this->getOfferDoneDeals()->toArray(), $this->getDemandDoneDeals()->toArray())
        );
        return $deals;
    }

    public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(Driver $driver): self
    {
        $this->driver = $driver;

        // set the owning side of the relation if necessary
        if ($this !== $driver->getUser()) {
            $driver->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|DoneDeal[]
     */
    public function getOfferDoneDeals(): Collection
    {
        return $this->offerDoneDeals;
    }

    public function addOfferDoneDeal(DoneDeal $offerDoneDeal): self
    {
        if (!$this->offerDoneDeals->contains($offerDoneDeal)) {
            $this->offerDoneDeals[] = $offerDoneDeal;
            $offerDoneDeal->setOfferUser($this);
        }

        return $this;
    }

    public function removeOfferDoneDeal(DoneDeal $offerDoneDeal): self
    {
        if ($this->offerDoneDeals->contains($offerDoneDeal)) {
            $this->offerDoneDeals->removeElement($offerDoneDeal);
            // set the owning side to null (unless already changed)
            if ($offerDoneDeal->getOfferUser() === $this) {
                $offerDoneDeal->setOfferUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DoneDeal[]
     */
    public function getDemandDoneDeals(): Collection
    {
        return $this->demandDoneDeals;
    }

    public function addDemandDoneDeal(DoneDeal $demandDoneDeal): self
    {
        if (!$this->demandDoneDeals->contains($demandDoneDeal)) {
            $this->demandDoneDeals[] = $demandDoneDeal;
            $demandDoneDeal->setDemandUser($this);
        }

        return $this;
    }

    public function removeDemandDoneDeal(DoneDeal $demandDoneDeal): self
    {
        if ($this->demandDoneDeals->contains($demandDoneDeal)) {
            $this->demandDoneDeals->removeElement($demandDoneDeal);
            // set the owning side to null (unless already changed)
            if ($demandDoneDeal->getDemandUser() === $this) {
                $demandDoneDeal->setDemandUser(null);
            }
        }

        return $this;
    }

}
