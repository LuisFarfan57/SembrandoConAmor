<?php

namespace App\Entity;

use App\Repository\DonadorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DonadorRepository::class)
 */
class Donador
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $correo_electronico;

    /**
     * @ORM\OneToMany(targetEntity=DonacionMonetaria::class, mappedBy="donador")
     */
    private $donacionesMonetarias;

    /**
     * @ORM\OneToMany(targetEntity=DonacionViveres::class, mappedBy="donador")
     */
    private $donacionesViveres;

    public function __construct()
    {
        $this->donacionesMonetarias = new ArrayCollection();
        $this->donacionesViveres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCorreoElectronico(): ?string
    {
        return $this->correo_electronico;
    }

    public function setCorreoElectronico(string $correo_electronico): self
    {
        $this->correo_electronico = $correo_electronico;

        return $this;
    }

    /**
     * @return Collection|DonacionMonetaria[]
     */
    public function getDonacionesMonetarias(): Collection
    {
        return $this->donacionesMonetarias;
    }

    public function addDonacionesMonetaria(DonacionMonetaria $donacionesMonetaria): self
    {
        if (!$this->donacionesMonetarias->contains($donacionesMonetaria)) {
            $this->donacionesMonetarias[] = $donacionesMonetaria;
            $donacionesMonetaria->setDonador($this);
        }

        return $this;
    }

    public function removeDonacionesMonetaria(DonacionMonetaria $donacionesMonetaria): self
    {
        if ($this->donacionesMonetarias->contains($donacionesMonetaria)) {
            $this->donacionesMonetarias->removeElement($donacionesMonetaria);
            // set the owning side to null (unless already changed)
            if ($donacionesMonetaria->getDonador() === $this) {
                $donacionesMonetaria->setDonador(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DonacionViveres[]
     */
    public function getDonacionesViveres(): Collection
    {
        return $this->donacionesViveres;
    }

    public function addDonacionesVivere(DonacionViveres $donacionesVivere): self
    {
        if (!$this->donacionesViveres->contains($donacionesVivere)) {
            $this->donacionesViveres[] = $donacionesVivere;
            $donacionesVivere->setDonador($this);
        }

        return $this;
    }

    public function removeDonacionesVivere(DonacionViveres $donacionesVivere): self
    {
        if ($this->donacionesViveres->contains($donacionesVivere)) {
            $this->donacionesViveres->removeElement($donacionesVivere);
            // set the owning side to null (unless already changed)
            if ($donacionesVivere->getDonador() === $this) {
                $donacionesVivere->setDonador(null);
            }
        }

        return $this;
    }
}
