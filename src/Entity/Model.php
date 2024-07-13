<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelRepository::class)]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDesktop = null;

    #[ORM\Column(nullable: true)]
    private ?int $computerCreationNumber = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $addDate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?float $totalPrice = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isArchived = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    private ?Motherboard $motherboard = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    private ?Processor $processor = null;


    #[ORM\ManyToOne(inversedBy: 'models')]
    private ?GraphicsCard $graphicsCard = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    private ?Keyboard $keyboard = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    private ?MousePad $mousePad = null;


    #[ORM\ManyToOne(inversedBy: 'models')]
    private ?PowerSupply $powerSupply = null;

    /**
     * @var Collection<int, RAM>
     */
    #[ORM\ManyToMany(targetEntity: RAM::class, inversedBy: 'models')]
    private Collection $ram;

    /**
     * @var Collection<int, Monitor>
     */
    #[ORM\ManyToMany(targetEntity: Monitor::class, inversedBy: 'models')]
    private Collection $monitor;

    /**
     * @var Collection<int, Storage>
     */
    #[ORM\ManyToMany(targetEntity: Storage::class, inversedBy: 'models')]
    private Collection $storageDevices;

    public function __construct()
    {
        $this->ram = new ArrayCollection();
        $this->monitor = new ArrayCollection();
        $this->storageDevices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isDesktop(): ?bool
    {
        return $this->isDesktop;
    }

    public function setDesktop(?bool $isDesktop): static
    {
        $this->isDesktop = $isDesktop;

        return $this;
    }

    public function getComputerCreationNumber(): ?int
    {
        return $this->computerCreationNumber;
    }

    public function setComputerCreationNumber(?int $computerCreationNumber): static
    {
        $this->computerCreationNumber = $computerCreationNumber;

        return $this;
    }

    public function getAddDate(): ?\DateTimeInterface
    {
        return $this->addDate;
    }

    public function setAddDate(?\DateTimeInterface $addDate): static
    {
        $this->addDate = $addDate;

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

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function isArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setArchived(?bool $isArchived): static
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    public function getMotherboard(): ?Motherboard
    {
        return $this->motherboard;
    }

    public function setMotherboard(?Motherboard $motherboard): static
    {
        $this->motherboard = $motherboard;

        return $this;
    }

    public function getProcessor(): ?Processor
    {
        return $this->processor;
    }

    public function setProcessor(?Processor $processor): static
    {
        $this->processor = $processor;

        return $this;
    }


    public function getGraphicsCard(): ?GraphicsCard
    {
        return $this->graphicsCard;
    }

    public function setGraphicsCard(?GraphicsCard $graphicsCard): static
    {
        $this->graphicsCard = $graphicsCard;

        return $this;
    }

    public function getKeyboard(): ?Keyboard
    {
        return $this->keyboard;
    }

    public function setKeyboard(?Keyboard $keyboard): static
    {
        $this->keyboard = $keyboard;

        return $this;
    }

    public function getMousePad(): ?MousePad
    {
        return $this->mousePad;
    }

    public function setMousePad(?MousePad $mousePad): static
    {
        $this->mousePad = $mousePad;

        return $this;
    }


    public function getPowerSupply(): ?PowerSupply
    {
        return $this->powerSupply;
    }

    public function setPowerSupply(?PowerSupply $powerSupply): static
    {
        $this->powerSupply = $powerSupply;

        return $this;
    }

    /**
     * @return Collection<int, RAM>
     */
    public function getRam(): Collection
    {
        return $this->ram;
    }

    public function addRam(RAM $ram): static
    {
        if (!$this->ram->contains($ram)) {
            $this->ram->add($ram);
        }

        return $this;
    }

    public function removeRam(RAM $ram): static
    {
        $this->ram->removeElement($ram);

        return $this;
    }

    /**
     * @return Collection<int, Monitor>
     */
    public function getMonitor(): Collection
    {
        return $this->monitor;
    }

    public function addMonitor(Monitor $monitor): static
    {
        if (!$this->monitor->contains($monitor)) {
            $this->monitor->add($monitor);
        }

        return $this;
    }

    public function removeMonitor(Monitor $monitor): static
    {
        $this->monitor->removeElement($monitor);

        return $this;
    }

    /**
     * @return Collection<int, Storage>
     */
    public function getStorageDevices(): Collection
    {
        return $this->storageDevices;
    }

    public function addStorageDevice(Storage $storageDevice): static
    {
        if (!$this->storageDevices->contains($storageDevice)) {
            $this->storageDevices->add($storageDevice);
        }

        return $this;
    }

    public function removeStorageDevice(Storage $storageDevice): static
    {
        $this->storageDevices->removeElement($storageDevice);

        return $this;
    }

}
