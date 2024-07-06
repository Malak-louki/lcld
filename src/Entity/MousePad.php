<?php

namespace App\Entity;

use App\Repository\MousePadRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MousePadRepository::class)]
class MousePad extends Piece
{
    
    #[ORM\Column(nullable: true)]
    private ?bool $isWireless = null;

    #[ORM\Column(nullable: true)]
    private ?int $buttons = null;

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

    public function getButtons(): ?int
    {
        return $this->buttons;
    }

    public function setButtons(?int $buttons): static
    {
        $this->buttons = $buttons;

        return $this;
    }
}
