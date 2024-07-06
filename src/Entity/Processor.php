<?php

namespace App\Entity;

use App\Repository\ProcessorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProcessorRepository::class)]
class Processor extends Piece
{



    #[ORM\Column(nullable: true)]
    private ?float $frequency = null;

    #[ORM\Column(nullable: true)]
    private ?int $cores = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $compatibleChipsets = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrequency(): ?float
    {
        return $this->frequency;
    }

    public function setFrequency(?float $frequency): static
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getCores(): ?int
    {
        return $this->cores;
    }

    public function setCores(?int $cores): static
    {
        $this->cores = $cores;

        return $this;
    }

    public function getCompatibleChipsets(): ?string
    {
        return $this->compatibleChipsets;
    }

    public function setCompatibleChipsets(?string $compatibleChipsets): static
    {
        $this->compatibleChipsets = $compatibleChipsets;

        return $this;
    }
}
