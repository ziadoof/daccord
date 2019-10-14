<?php

namespace App\Entity\Deal;

use App\Entity\Ads\Ad;
use App\Entity\Ads\Category;
use App\Entity\DriverRequest;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Deal\DealRepository")
 */
class Deal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="offerDeals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offerUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="demandDeals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $demandUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $driverUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads\Category", inversedBy="deals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads\Ad", inversedBy="offerDeals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads\Ad", inversedBy="demandDeals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $demand;

    /**
     * @ORM\Column(type="datetime")
     */
    private $suggestionDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $offerUserStatus;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $demandUserStatus;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $driverStatus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DriverRequest", mappedBy="deal")
     */
    private $driverRequests;


    /**
     * Deal constructor.
     */
    public function __construct()
    {
        $this->suggestionDate = new \DateTime('now');
        $this->offerUserStatus = false;
        $this->demandUserStatus = false;
        $this->driverStatus = false;
        $this->driverRequests = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfferUser(): ?User
    {
        return $this->offerUser;
    }

    public function setOfferUser(?User $offerUser): self
    {
        $this->offerUser = $offerUser;

        return $this;
    }

    public function getDemandUser(): ?User
    {
        return $this->demandUser;
    }

    public function setDemandUser(?User $demandUser): self
    {
        $this->demandUser = $demandUser;

        return $this;
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

    public function getOffer(): ?Ad
    {
        return $this->offer;
    }

    public function setOffer(?Ad $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getDemand(): ?Ad
    {
        return $this->demand;
    }

    public function setDemand(?Ad $demand): self
    {
        $this->demand = $demand;

        return $this;
    }

    public function getSuggestionDate(): ?\DateTimeInterface
    {
        return $this->suggestionDate;
    }

    public function setSuggestionDate(\DateTimeInterface $suggestionDate): self
    {
        $this->suggestionDate = $suggestionDate;

        return $this;
    }

    public function getOfferUserStatus(): ?bool
    {
        return $this->offerUserStatus;
    }

    public function setOfferUserStatus(?bool $offerUserStatus): self
    {
        $this->offerUserStatus = $offerUserStatus;

        return $this;
    }

    public function getDemandUserStatus(): ?bool
    {
        return $this->demandUserStatus;
    }

    public function setDemandUserStatus(?bool $demandUserStatus): self
    {
        $this->demandUserStatus = $demandUserStatus;

        return $this;
    }

    public function getDriverStatus(): ?bool
    {
        return $this->driverStatus;
    }

    public function setDriverStatus(?bool $driverStatus): self
    {
        $this->driverStatus = $driverStatus;

        return $this;
    }

    public function date_format(\DateTime $date): string
    {
        $now  = new \DateTime('now');
        $interval = date_diff($date, $now)->days;
        $dateString = $date->format('d-m-Y');
        switch (true) {
            case $interval === 0:
                return 'Today';
                break;
            case $interval === 1:
                return 'Yesterday';
                break;
            case ($interval >1 && $interval< 7):
                return $interval.'Days ago';
                break;
            case $interval === 7:
                return '1 Week ago';
                break;
            case ($interval >7 && $interval< 15):
                return 'Last week';
                break;
            case ($interval >15 && $interval< 21):
                return 'About َ3 Week ago';
                break;
            case ($interval >21 && $interval< 30):
                return 'About 4 Week ago';
                break;
            case ($interval > 30 && $interval< 60):
                return 'Last month';
                break;
            case ( $interval> 60):
                return $dateString;
                break;
            case 15:
                return '2 Week ago';
                break;
            case 21:
                return '3 Week ago';
                break;
            case 30:
                return '1 Month ago';
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getDriverUser()
    {
        return $this->driverUser;
    }

    /**
     * @param mixed $driverUser
     */
    public function setDriverUser($driverUser): void
    {
        $this->driverUser = $driverUser;
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
            $driverRequest->setDeal($this);
        }

        return $this;
    }

    public function removeDriverRequest(DriverRequest $driverRequest): self
    {
        if ($this->driverRequests->contains($driverRequest)) {
            $this->driverRequests->removeElement($driverRequest);
            // set the owning side to null (unless already changed)
            if ($driverRequest->getDeal() === $this) {
                $driverRequest->setDeal(null);
            }
        }

        return $this;
    }
}
