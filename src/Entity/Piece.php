<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "piece" => "Piece",
    "motherboard" => "Motherboard",
    "processor" => "Processor",
    "ram" => "RAM",
    "graphics_card" => "GraphicsCard",
    "keyboard" => "Keyboard",
    "mouse_pad" => "MousePad",
    "monitor" => "Monitor",
    "power_supply" => "PowerSupply",
    "storage" => "Storage"
])]
class Piece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column]
    private ?float $buyingPrice = null;

    #[ORM\Column]
    private ?int $quantity = null;


    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(max: 12000)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;

    /**
     * @var Collection<int, StockHistory>
     */
    #[ORM\OneToMany(targetEntity: StockHistory::class, mappedBy: 'piece')]
    private Collection $stockHistories;

    public function __construct()
    {
        $this->stockHistories = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBuyingPrice(): ?float
    {
        return $this->buyingPrice;
    }

    public function setBuyingPrice(float $buyingPrice): static
    {
        $this->buyingPrice = $buyingPrice;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, StockHistory>
     */
    public function getStockHistories(): Collection
    {
        return $this->stockHistories;
    }

    public function addStockHistory(StockHistory $stockHistory): static
    {
        if (!$this->stockHistories->contains($stockHistory)) {
            $this->stockHistories->add($stockHistory);
            $stockHistory->setPiece($this);
        }

        return $this;
    }

    public function removeStockHistory(StockHistory $stockHistory): static
    {
        if ($this->stockHistories->removeElement($stockHistory)) {

            if ($stockHistory->getPiece() === $this) {
                $stockHistory->setPiece(null);
            }
        }

        return $this;
    }

}
