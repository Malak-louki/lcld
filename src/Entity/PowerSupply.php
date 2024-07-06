<?php

namespace App\Entity;

use App\Repository\PowerSupplyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PowerSupplyRepository::class)]
class PowerSupply extends Piece
{


    #[ORM\Column(nullable: true)]
    private ?int $power = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(?int $power): static
    {
        $this->power = $power;

        return $this;
    }
}
