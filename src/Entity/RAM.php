<?php

namespace App\Entity;

use App\Repository\RAMRepository;
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
}
