<?php

namespace App\Entity;

use App\Repository\MotherboardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotherboardRepository::class)]
class Motherboard extends Piece
{

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $socket = null;

    #[ORM\Column(length: 255, nullable: true)]
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

    // /**
    //  * @var Collection<int, Model>
    //  */
    // #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'motherboard')]
    // private Collection $model;

    // public function __construct()
    // {
    //     $this->model = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->id;
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

    // /**
    //  * @return Collection<int, Model>
    //  */
    // public function getmodel(): Collection
    // {
    //     return $this->model;
    // }

    // public function addmodel(Model $model): static
    // {
    //     if (!$this->model->contains($model)) {
    //         $this->model->add($model);
    //         $model->setMotherboard($this);
    //     }

    //     return $this;
    // }

    // public function removemodel(Model $model): static
    // {
    //     if ($this->model->removeElement($model)) {
    //         // set the owning side to null (unless already changed)
    //         if ($model->getMotherboard() === $this) {
    //             $model->setMotherboard(null);
    //         }
    //     }

    //     return $this;
    // }

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
            // set the owning side to null (unless already changed)
            if ($model->getMotherboard() === $this) {
                $model->setMotherboard(null);
            }
        }

        return $this;
    }
}
