<?php

namespace App\Entity;

use App\Repository\AdressesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdressesRepository::class)]
class Adresses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $province = null;

    public static $provinces = [
        'Antananarivo', 'Fianarantsoa','Mahajanga','Toamasina','Antsiranana','Toliara'
    ];

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?etablishments $etablishment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(string $province): static
    {
        $this->province = $province;

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
