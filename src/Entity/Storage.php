<?php

namespace App\Entity;

use App\Repository\StorageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StorageRepository::class)]
class Storage extends Piece
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $storageType = null; // Renamed from 'type' to 'storageType'

    #[ORM\Column(nullable: true)]
    private ?int $capacity = null;

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
}

