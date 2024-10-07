<?php

namespace App\Entity;

use App\Repository\StockHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[Assert\NotNull(message: "Quantity change cannot be null.")]
    #[Assert\Type(type: 'integer', message: "Quantity change must be an integer.")]
    private ?int $quantityChange = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Assert\NotNull(message: "Change date cannot be null.")]
    #[Assert\Type("\DateTimeInterface", message: "Change date must be a valid date.")]
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

    public function getQuantityChange(): ?int
    {
        return $this->quantityChange;
    }

    public function setQuantityChange(?int $quantityChange): static
    {
        $this->quantityChange = $quantityChange;

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
