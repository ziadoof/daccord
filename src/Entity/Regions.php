<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionsRepository")
 */
class Regions
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
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Departments", mappedBy="regionCode")
     * @ORM\Column(type="string", length=3)
     */
    private $code;

    public function __construct()
    {
        $this->code = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Departments[]
     */
    public function getCode(): Collection
    {
        return $this->code;
    }

    public function addCode(Departments $code): self
    {
        if (!$this->code->contains($code)) {
            $this->code[] = $code;
            $code->setRegionCode($this);
        }

        return $this;
    }

    public function removeCode(Departments $code): self
    {
        if ($this->code->contains($code)) {
            $this->code->removeElement($code);
            // set the owning side to null (unless already changed)
            if ($code->getRegionCode() === $this) {
                $code->setRegionCode(null);
            }
        }

        return $this;
    }
}
