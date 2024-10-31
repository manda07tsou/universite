<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcoursRepository::class)]
class Parcours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $parcour = null;

    #[ORM\ManyToOne(inversedBy: 'parcours')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'cascade')]
    private ?departments $department = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParcour(): ?string
    {
        return $this->parcour;
    }

    public function setParcour(string $parcour): static
    {
        $this->parcour = $parcour;

        return $this;
    }

    public function getDepartment(): ?departments
    {
        return $this->department;
    }

    public function setDepartment(?departments $department): static
    {
        $this->department = $department;

        return $this;
    }
}
