<?php

namespace App\Entity;

use App\Repository\MonitorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonitorRepository::class)]
class Monitor extends Piece
{



    #[ORM\Column(nullable: true)]
    private ?float $diagonalSize = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiagonalSize(): ?float
    {
        return $this->diagonalSize;
    }

    public function setDiagonalSize(?float $diagonalSize): static
    {
        $this->diagonalSize = $diagonalSize;

        return $this;
    }
}
