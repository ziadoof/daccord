<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SDspecificationRepository")
 */
class SDspecification
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
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="ospecifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $textOptions = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $numericOptions = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeOfChoice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minOption;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxOption;

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function __construct(string $name)
    {
        $this->name = $name;
        $lowerName = strtolower(preg_replace('/(?<!^)[A-Z]/', ' $0', $name));
        $this->label = ucwords($lowerName) ;
    }

    public function getTextOptions(): ?array
    {
        return $this->textOptions;
    }

    public function setTextOptions(?array $textOptions): self
    {
        $this->textOptions = $textOptions;

        return $this;
    }

    public function getNumericOptions(): ?array
    {
        return $this->numericOptions;
    }

    public function setNumericOptions(?array $numericOptions): self
    {
        $this->numericOptions = $numericOptions;

        return $this;
    }

    public function getTypeOfChoice(): ?string
    {
        return $this->typeOfChoice;
    }

    public function setTypeOfChoice(?string $typeOfChoice): self
    {
        $this->typeOfChoice = $typeOfChoice;

        return $this;
    }

    public function getMinOption(): ?int
    {
        return $this->minOption;
    }

    public function setMinOption(?int $minOption): self
    {
        $this->minOption = $minOption;

        return $this;
    }

    public function getMaxOption(): ?int
    {
        return $this->maxOption;
    }

    public function setMaxOption(?int $maxOption): self
    {
        $this->maxOption = $maxOption;

        return $this;
    }
}
