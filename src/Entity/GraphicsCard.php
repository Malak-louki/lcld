<?php

namespace App\Entity;

use App\Repository\GraphicsCardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GraphicsCardRepository::class)]
class GraphicsCard extends Piece
{

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $chipset = null;

    #[ORM\Column(nullable: true)]
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

    public function getId(): ?int
    {
        return $this->id;
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
            // set the owning side to null (unless already changed)
            if ($model->getGraphicsCard() === $this) {
                $model->setGraphicsCard(null);
            }
        }

        return $this;
    }
}
