<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartmentsRepository")
 */
class Departments
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
     * @ORM\OneToMany(targetEntity="App\Entity\Cities", mappedBy="departmentCode")
     *
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Regions", inversedBy="code")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $regionCode;

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
     * @return Collection|Cities[]
     */
    public function getCode(): Collection
    {
        return $this->code;
    }

    public function addCode(Cities $code): self
    {
        if (!$this->code->contains($code)) {
            $this->code[] = $code;
            $code->setDepartmentCode($this);
        }

        return $this;
    }

    public function removeCode(Cities $code): self
    {
        if ($this->code->contains($code)) {
            $this->code->removeElement($code);
            // set the owning side to null (unless already changed)
            if ($code->getDepartmentCode() === $this) {
                $code->setDepartmentCode(null);
            }
        }

        return $this;
    }

    public function getRegionCode(): ?Regions
    {
        return $this->regionCode;
    }

    public function setRegionCode(?Regions $regionCode): self
    {
        $this->regionCode = $regionCode;

        return $this;
    }
}
