<?php

namespace App\Entity;

use App\Repository\StockHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockHistoryRepository::class)]
class StockHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'stockHistories')]
    private ?Piece $piece = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantitychange = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $changeDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPiece(): ?Piece
    {
        return $this->piece;
    }

    public function setPiece(?Piece $piece): static
    {
        $this->piece = $piece;

        return $this;
    }

    public function getQuantitychange(): ?int
    {
        return $this->quantitychange;
    }

    public function setQuantitychange(?int $quantitychange): static
    {
        $this->quantitychange = $quantitychange;

        return $this;
    }

    public function getChangeDate(): ?\DateTimeInterface
    {
        return $this->changeDate;
    }

    public function setChangeDate(?\DateTimeInterface $changeDate): static
    {
        $this->changeDate = $changeDate;

        return $this;
    }
}
