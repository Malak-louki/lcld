<?php

namespace App\Entity;

use App\Repository\RAMRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RAMRepository::class)]
class RAM extends Piece
{


    #[ORM\Column(nullable: true)]
    private ?int $capacity = null;

    #[ORM\Column(nullable: true)]
    private ?int $modules = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeFrequency = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\ManyToMany(targetEntity: Model::class, mappedBy: 'ram')]
    private Collection $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getModules(): ?int
    {
        return $this->modules;
    }

    public function setModules(?int $modules): static
    {
        $this->modules = $modules;

        return $this;
    }

    public function getTypeFrequency(): ?string
    {
        return $this->typeFrequency;
    }

    public function setTypeFrequency(?string $typeFrequency): static
    {
        $this->typeFrequency = $typeFrequency;

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
            $model->addRam($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            $model->removeRam($this);
        }

        return $this;
    }

}
