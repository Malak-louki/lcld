<?php

namespace App\Entity;

use App\Repository\MotherboardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotherboardRepository::class)]
class Motherboard extends Piece
{




    #[ORM\Column(length: 255, nullable: true)]
    private ?string $socket = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $formFactor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocket(): ?string
    {
        return $this->socket;
    }

    public function setSocket(?string $socket): static
    {
        $this->socket = $socket;

        return $this;
    }

    public function getFormFactor(): ?string
    {
        return $this->formFactor;
    }

    public function setFormFactor(?string $formFactor): static
    {
        $this->formFactor = $formFactor;

        return $this;
    }
}
