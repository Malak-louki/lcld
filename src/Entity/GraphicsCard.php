<?php

namespace App\Entity;

use App\Repository\GraphicsCardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GraphicsCardRepository::class)]
class GraphicsCard extends Piece
{
    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "The chipset name cannot exceed {{ limit }} characters")]
    private ?string $chipset = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive(message: "Memory must be a positive integer")]
    private ?int $memory = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'graphicsCard')]
    private Collection $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

    public function getChipset(): ?string
    {
        return $this->chipset;
    }

    public function setChipset(?string $chipset): static
    {
        $this->chipset = $chipset;

        return $this;
    }

    public function getMemory(): ?int
    {
        return $this->memory;
    }

    public function setMemory(?int $memory): static
    {
        $this->memory = $memory;

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
            $model->setGraphicsCard($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            if ($model->getGraphicsCard() === $this) {
                $model->setGraphicsCard(null);
            }
        }

        return $this;
    }
}
