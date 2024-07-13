<?php

namespace App\Entity;

use App\Repository\KeyboardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Model>
     */
    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'keyboard')]
    private Collection $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Model>
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): static
    {
        if (!$this->models->contains($model)) {
            $this->models->add($model);
            $model->setKeyboard($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getKeyboard() === $this) {
                $model->setKeyboard(null);
            }
        }

        return $this;
    }
}
