<?php

namespace App\Entity;

use App\Repository\EtablishmentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablishmentsRepository::class)]
class Etablishments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $about = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slogan = null;


    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    /**
     * @var Collection<int, Formations>
     */
    #[ORM\OneToMany(targetEntity: Formations::class, mappedBy: 'etablishment')]
    private Collection $formations;

    /**
     * @var Collection<int, Adresses>
     */
    #[ORM\OneToMany(targetEntity: Adresses::class, mappedBy: 'etablishment')]
    private Collection $adresses;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): static
    {
        $this->about = $about;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(?string $slogan): static
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getUser(): ?users
    {
        return $this->user;
    }

    public function setUser(users $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Formations>
     */
    public function getFormations()
    {
        return count($this->formations) > 1 ? $this->formations : $this->formations[0];
    }

    public function addFormation(Formations $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->setEtablishment($this);
        }

        return $this;
    }

    public function removeFormation(Formations $formation): static
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getEtablishment() === $this) {
                $formation->setEtablishment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Adresses>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresses $adress): static
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses->add($adress);
            $adress->setEtablishment($this);
        }

        return $this;
    }

    public function removeAdress(Adresses $adress): static
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getEtablishment() === $this) {
                $adress->setEtablishment(null);
            }
        }

        return $this;
    }
}
