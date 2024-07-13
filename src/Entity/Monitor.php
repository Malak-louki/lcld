<?php

namespace App\Entity;

use App\Repository\MonitorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonitorRepository::class)]
class Monitor extends Piece
{



    #[ORM\Column(nullable: true)]
    private ?float $diagonalSize = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\ManyToMany(targetEntity: Model::class, mappedBy: 'monitor')]
    private Collection $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiagonalSize(): ?float
    {
        return $this->diagonalSize;
    }

    public function setDiagonalSize(?float $diagonalSize): static
    {
        $this->diagonalSize = $diagonalSize;

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
            $model->addMonitor($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            $model->removeMonitor($this);
        }

        return $this;
    }

}
