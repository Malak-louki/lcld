<?php

namespace App\Entity;

use App\Repository\GraphicsCardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GraphicsCardRepository::class)]
class GraphicsCard extends Piece
{

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $chipset = null;

    #[ORM\Column(nullable: true)]
    private ?int $memory = null;

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
}
