<?php

namespace App\Entity\Deal;

use App\Entity\Ads\Category;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Deal\DoneDealRepository")
 */
class DoneDeal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="offerDoneDeals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offerUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="demandDoneDeals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $demandUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $driverUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads\Category", inversedBy="doneDeals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
}
