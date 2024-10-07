<?php

namespace App\Entity;

use App\Repository\MousePadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MousePadRepository::class)]
class MousePad extends Piece
{
    #[ORM\Column(nullable: true)]
    private ?bool $isWireless = null;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero(message: "The number of buttons must be zero or a positive integer.")]
    private ?int $buttons = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'mousePad')]
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

    public function getButtons(): ?int
    {
        return $this->buttons;
    }

    public function setButtons(?int $buttons): static
    {
        $this->buttons = $buttons;

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
            $model->setMousePad($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getMousePad() === $this) {
                $model->setMousePad(null);
            }
        }

        return $this;
    }
}
