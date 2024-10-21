<?php

namespace App\Entity;

use App\Repository\DepartmentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentsRepository::class)]
class Departments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $diploma_required = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $diploma_delivered = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?formations $formation = null;

    /**
     * @var Collection<int, Parcours>
     */
    #[ORM\OneToMany(targetEntity: Parcours::class, mappedBy: 'department')]
    private Collection $parcours;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?filieres $filiere = null;

    public function __construct()
    {
        $this->parcours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiplomaRequired(): ?string
    {
        return $this->diploma_required;
    }

    public function setDiplomaRequired(string $diploma_required): static
    {
        $this->diploma_required = $diploma_required;

        return $this;
    }

    public function getDiplomaDelivered(): ?string
    {
        return $this->diploma_delivered;
    }

    public function setDiplomaDelivered(string $diploma_delivered): static
    {
        $this->diploma_delivered = $diploma_delivered;

        return $this;
    }

    public function getFormation(): ?formations
    {
        return $this->formation;
    }

    public function setFormation(?formations $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * @return Collection<int, Parcours>
     */
    public function getParcours(): Collection
    {
        return $this->parcours;
    }

    public function addParcour(Parcours $parcour): static
    {
        if (!$this->parcours->contains($parcour)) {
            $this->parcours->add($parcour);
            $parcour->setDepartment($this);
        }

        return $this;
    }

    public function removeParcour(Parcours $parcour): static
    {
        if ($this->parcours->removeElement($parcour)) {
            // set the owning side to null (unless already changed)
            if ($parcour->getDepartment() === $this) {
                $parcour->setDepartment(null);
            }
        }

        return $this;
    }

    public function getFiliere(): ?filieres
    {
        return $this->filiere;
    }

    public function setFiliere(?filieres $filiere): static
    {
        $this->filiere = $filiere;

        return $this;
    }
}
