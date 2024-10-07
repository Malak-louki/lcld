<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $commentDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isRead = false;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Comment cannot be blank.")]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[Assert\NotBlank]
    private ?User $editor = null;

    public function __construct()
    {

        $this->commentDate = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentDate(): ?\DateTimeInterface
    {
        return $this->commentDate;
    }


    public function isRead(): ?bool
    {
        return $this->isRead;
    }

    public function setRead(?bool $isRead): static
    {
        $this->isRead = $isRead;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getEditor(): ?User
    {
        return $this->editor;
    }

    public function setEditor(?User $editor): static
    {
        $this->editor = $editor;

        return $this;
    }
}
