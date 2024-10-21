<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
class Formations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $type_formation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $admission_condition = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?etablishments $etablishment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeFormation(): ?string
    {
        return $this->type_formation;
    }

    public function setTypeFormation(string $type_formation): static
    {
        $this->type_formation = $type_formation;

        return $this;
    }

    public function getAdmissionCondition(): ?string
    {
        return $this->admission_condition;
    }

    public function setAdmissionCondition(string $admission_condition): static
    {
        $this->admission_condition = $admission_condition;

        return $this;
    }

    public function getEtablishment(): ?etablishments
    {
        return $this->etablishment;
    }

    public function setEtablishment(?etablishments $etablishment): static
    {
        $this->etablishment = $etablishment;

        return $this;
    }
}
