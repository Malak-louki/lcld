<?php

namespace App\Entity;

use App\Repository\StorageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StorageRepository::class)]
class Storage extends Piece
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $storageType = null; // Renamed from 'type' to 'storageType'

    #[ORM\Column(nullable: true)]
    private ?int $capacity = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\ManyToMany(targetEntity: Model::class, mappedBy: 'storageDevices')]
    private Collection $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
    }


    public function getStorageType(): ?string
    {
        return $this->storageType;
    }

    public function setStorageType(?string $storageType): static
    {
        $this->storageType = $storageType;

        return $this;
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
            $model->addStorageDevice($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            $model->removeStorageDevice($this);
        }

        return $this;
    }

}

