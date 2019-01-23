<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AdRepository")
 */
class Ad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageOne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageTow;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageThree;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $donate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $withDriver;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeOfAd;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Specification", cascade={"persist", "remove"})
     */
    private $specification;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    public function getSpecification(): ?Specification
    {
        return $this->specification;
    }

    public function setSpecification(?Specification $specification): self
    {
        $this->specification = $specification;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImageOne(): ?string
    {
        return $this->imageOne;
    }

    public function setImageOne(?string $imageOne): self
    {
        $this->imageOne = $imageOne;

        return $this;
    }

    public function getImageTow(): ?string
    {
        return $this->imageTow;
    }

    public function setImageTow(?string $imageTow): self
    {
        $this->imageTow = $imageTow;

        return $this;
    }

    public function getImageThree(): ?string
    {
        return $this->imageThree;
    }

    public function setImageThree(?string $imageThree): self
    {
        $this->imageThree = $imageThree;

        return $this;
    }

    public function getAdNumber(): ?int
    {
        return $this->adNumber;
    }

    public function setAdNumber(int $adNumber): self
    {
        $this->adNumber = $adNumber;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDonate(): ?bool
    {
        return $this->donate;
    }

    public function setDonate(?bool $donate): self
    {
        $this->donate = $donate;

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

    public function getWithDriver(): ?bool
    {
        return $this->withDriver;
    }

    public function setWithDriver(?bool $withDriver): self
    {
        $this->withDriver = $withDriver;

        return $this;
    }

    public function getTypeOfAd(): ?string
    {
        return $this->typeOfAd;
    }

    public function setTypeOfAd(string $typeOfAd): self
    {
        $this->typeOfAd = $typeOfAd;

        return $this;
    }

    public function __construct()
    {
        $this->date = new \DateTime('now');
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }
}
