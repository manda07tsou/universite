<?php

namespace App\Entity;

use App\Repository\DepartmentsRepository;
use App\Traits\DiplomaTypeTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentsRepository::class)]
class Departments
{
    use DiplomaTypeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'departments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?formations $formation = null;

    /**
     * @var Collection<int, Parcours>
     */
    #[ORM\OneToMany(targetEntity: Parcours::class, mappedBy: 'department')]
    private Collection $parcours;

    #[ORM\ManyToOne(fetch:'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Filieres $filiere = null;

    public function __construct()
    {
        $this->parcours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
