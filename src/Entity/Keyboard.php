<?php

namespace App\Entity;

use App\Repository\KeyboardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: KeyboardRepository::class)]
class Keyboard extends Piece
{
    #[ORM\Column(nullable: true)]
    private ?bool $isWireless = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hasNumericKeypad = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "The key type cannot exceed {{ limit }} characters")]
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
            if ($model->getKeyboard() === $this) {
                $model->setKeyboard(null);
            }
        }

        return $this;
    }
}
