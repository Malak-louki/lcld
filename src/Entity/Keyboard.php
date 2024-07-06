<?php

namespace App\Entity;

use App\Repository\KeyboardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KeyboardRepository::class)]
class Keyboard extends Piece
{

    #[ORM\Column(nullable: true)]
    private ?bool $isWireless = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hasNumericKeypad = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $keyType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isWireless(): ?bool
    {
        return $this->isWireless;
    }

    public function setWireless(?bool $isWireless): static
    {
        $this->isWireless = $isWireless;

        return $this;
    }

    public function hasNumericKeypad(): ?bool
    {
        return $this->hasNumericKeypad;
    }

    public function setHasNumericKeypad(?bool $hasNumericKeypad): static
    {
        $this->hasNumericKeypad = $hasNumericKeypad;

        return $this;
    }

    public function getKeyType(): ?string
    {
        return $this->keyType;
    }

    public function setKeyType(?string $keyType): static
    {
        $this->keyType = $keyType;

        return $this;
    }
}
