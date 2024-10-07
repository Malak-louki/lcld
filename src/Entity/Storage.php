<?php

namespace App\Entity;

use App\Repository\StorageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StorageRepository::class)]
class Storage extends Piece
{
    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Storage type cannot be blank.")]
    private ?string $storageType = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Type(type: 'integer', message: "Capacity must be an integer.")]
    #[Assert\Positive(message: "Capacity must be a positive number.")]
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
