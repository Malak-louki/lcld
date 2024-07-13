<?php

namespace App\Entity;

use App\Repository\PowerSupplyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PowerSupplyRepository::class)]
class PowerSupply extends Piece
{


    #[ORM\Column(nullable: true)]
    private ?int $power = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'powerSupply')]
    private Collection $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(?int $power): static
    {
        $this->power = $power;

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
            $model->setPowerSupply($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getPowerSupply() === $this) {
                $model->setPowerSupply(null);
            }
        }

        return $this;
    }
}
