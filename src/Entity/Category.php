<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="parent")
     */
    private $children;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ad", mappedBy="category")
     */
    private $ads;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ospecification", mappedBy="category")
     */
    private $ospecifications;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->ads = new ArrayCollection();
        $this->ospecifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|Ospecification[]
     */
    public function getOspecifications(): Collection
    {
        return $this->ospecifications;
    }

    public function addOspecification(Ospecification $ospecification): self
    {
        if (!$this->ospecifications->contains($ospecification)) {
            $this->ospecifications[] = $ospecification;
            $ospecification->setCategory($this);
        }

        return $this;
    }

    public function removeOspecification(Ospecification $ospecification): self
    {
        if ($this->ospecifications->contains($ospecification)) {
            $this->ospecifications->removeElement($ospecification);
            // set the owning side to null (unless already changed)
            if ($ospecification->getCategory() === $this) {
                $ospecification->setCategory(null);
            }
        }

        return $this;
    }
}
