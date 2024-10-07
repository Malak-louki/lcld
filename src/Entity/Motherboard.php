<?php

namespace App\Entity;

use App\Repository\MotherboardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MotherboardRepository::class)]
class Motherboard extends Piece
{
    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "The socket cannot exceed {{ limit }} characters.")]
    private ?string $socket = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: "The form factor cannot exceed {{ limit }} characters.")]
    private ?string $formFactor = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'motherboard')]
    private Collection $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ArrayCollection();
    }

    public function getSocket(): ?string
    {
        return $this->socket;
    }

    public function setSocket(?string $socket): static
    {
        $this->socket = $socket;

        return $this;
    }

    public function getFormFactor(): ?string
    {
        return $this->formFactor;
    }

    public function setFormFactor(?string $formFactor): static
    {
        $this->formFactor = $formFactor;

        return $this;
    }

    /**
     * @return Collection<int, Model>
     */
    public function getModel(): Collection
    {
        return $this->model;
    }

    public function addModel(Model $model): static
    {
        if (!$this->model->contains($model)) {
            $this->model->add($model);
            $model->setMotherboard($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->model->removeElement($model)) {
            if ($model->getMotherboard() === $this) {
                $model->setMotherboard(null);
            }
        }

        return $this;
    }
}
