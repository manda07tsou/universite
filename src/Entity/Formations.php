<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\FormationTypeTrait;
use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
class Formations
{
    use FormationTypeTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $admissionCondition = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?etablishments $etablishment = null;

    #[ORM\OneToMany(targetEntity: Departments::class, mappedBy: 'formation')]
    private Collection $departments;
    
    public function __construct()
    {
        $this->departments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getAdmissionCondition(): ?string
    {
        return $this->admissionCondition;
    }

    public function setAdmissionCondition(string $admissionCondition): static
    {
        $this->admissionCondition = $admissionCondition;
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

    public function getDepartments(): Collection
    {
        return $this->departments;
    }
}
