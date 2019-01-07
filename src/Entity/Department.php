<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartmentsRepository")
 */
class Department
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
     * @ORM\OneToMany(targetEntity="App\Entity\City", mappedBy="department")
     *
     */
    private $citys;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="department")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $region;

    public function __construct()
    {
        $this->citys = new ArrayCollection();
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
     * @return Collection|City[]
     */
    public function getCitys(): Collection
    {
        return $this->citys;
    }

    public function addCity(City $city): self
    {
        if (!$this->citys->contains($city)) {
            $this->citys[] = $city;
            $city->setDepartment($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->citys->contains($city)) {
            $this->citys->removeElement($city);
            // set the owning side to null (unless already changed)
            if ($city->getDepartment() === $this) {
                $city->setDepartment(null);
            }
        }

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }


}
