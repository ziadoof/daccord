<?php

namespace App\Entity\Ads;

use App\Entity\Deal\Deal;
use App\Entity\Deal\DoneDeal;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Ads\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ads\Category", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ads\Category", mappedBy="parent")
     */
    private $children;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ads\Ad", mappedBy="category")
     *
     */
    private $ads;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ads\Specification", mappedBy="category")
     */
    private $specifications;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Deal\Deal", mappedBy="category")
     */
    private $deals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Deal\DoneDeal", mappedBy="category")
     */
    private $doneDeals;


    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->ads = new ArrayCollection();
        $this->specifications = new ArrayCollection();
        $this->deals = new ArrayCollection();
        $this->doneDeals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(Category $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(Category $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
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
            $ad->setCategory($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->contains($ad)) {
            $this->ads->removeElement($ad);
            // set the owning side to null (unless already changed)
            if ($ad->getCategory() === $this) {
                $ad->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|Specification[]
     */
    public function getSpecifications(): Collection
    {
        return $this->specifications;
    }

    public function addSpecification(Specification $specification): self
    {
        if (!$this->specifications->contains($specification)) {
            $this->specifications[] = $specification;
            $specification->setCategory($this);
        }

        return $this;
    }

    public function removeSpecification(Specification $specification): self
    {
        if ($this->specifications->contains($specification)) {
            $this->specifications->removeElement($specification);
            // set the owning side to null (unless already changed)
            if ($specification->getCategory() === $this) {
                $specification->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Deal[]
     */
    public function getDeals(): Collection
    {
        return $this->deals;
    }

    public function addDeal(Deal $deal): self
    {
        if (!$this->deals->contains($deal)) {
            $this->deals[] = $deal;
            $deal->setCategory($this);
        }

        return $this;
    }

    public function removeDeal(Deal $deal): self
    {
        if ($this->deals->contains($deal)) {
            $this->deals->removeElement($deal);
            // set the owning side to null (unless already changed)
            if ($deal->getCategory() === $this) {
                $deal->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DoneDeal[]
     */
    public function getDoneDeals(): Collection
    {
        return $this->doneDeals;
    }

    public function addDoneDeal(DoneDeal $doneDeal): self
    {
        if (!$this->doneDeals->contains($doneDeal)) {
            $this->doneDeals[] = $doneDeal;
            $doneDeal->setCategory($this);
        }

        return $this;
    }

    public function removeDoneDeal(DoneDeal $doneDeal): self
    {
        if ($this->doneDeals->contains($doneDeal)) {
            $this->doneDeals->removeElement($doneDeal);
            // set the owning side to null (unless already changed)
            if ($doneDeal->getCategory() === $this) {
                $doneDeal->setCategory(null);
            }
        }

        return $this;
    }

}
