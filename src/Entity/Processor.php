<?php

namespace App\Entity;

use App\Repository\ProcessorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProcessorRepository::class)]
class Processor extends Piece
{
    #[ORM\Column(nullable: true)]
    #[Assert\Positive(message: "The frequency must be a positive number.")]
    private ?float $frequency = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive(message: "The number of cores must be a positive integer.")]
    private ?int $cores = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Compatible chipsets cannot be empty if specified.")]
    private ?string $compatibleChipsets = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'processor')]
    private Collection $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

    public function getFrequency(): ?float
    {
        return $this->frequency;
    }

    public function setFrequency(?float $frequency): static
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getCores(): ?int
    {
        return $this->cores;
    }

    public function setCores(?int $cores): static
    {
        $this->cores = $cores;

        return $this;
    }

    public function getCompatibleChipsets(): ?string
    {
        return $this->compatibleChipsets;
    }

    public function setCompatibleChipsets(?string $compatibleChipsets): static
    {
        $this->compatibleChipsets = $compatibleChipsets;

        return $this;
    }

    /**
     * @return Collection<int, Model>
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): static
    {
        if (!$this->models->contains($model)) {
            $this->models->add($model);
            $model->setProcessor($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            if ($model->getProcessor() === $this) {
                $model->setProcessor(null);
            }
        }

        return $this;
    }
}
