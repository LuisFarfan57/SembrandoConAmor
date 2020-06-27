<?php

namespace App\Entity;

use App\Repository\FamiliaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FamiliaRepository::class)
 */
class Familia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $primer_nombre;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $segundo_nombre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $primer_apellido;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $segundo_apellido;

    /**
     * @ORM\Column(type="integer")
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="integer")
     */
    private $integrantes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity=DonacionMonetaria::class, mappedBy="familia")
     */
    private $donacionesMonetarias;

    /**
     * @ORM\OneToMany(targetEntity=DonacionViveres::class, mappedBy="familia")
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

    public function getPrimerNombre(): ?string
    {
        return $this->primer_nombre;
    }

    public function setPrimerNombre(string $primer_nombre): self
    {
        $this->primer_nombre = $primer_nombre;

        return $this;
    }

    public function getSegundoNombre(): ?string
    {
        return $this->segundo_nombre;
    }

    public function setSegundoNombre(?string $segundo_nombre): self
    {
        $this->segundo_nombre = $segundo_nombre;

        return $this;
    }

    public function getPrimerApellido(): ?string
    {
        return $this->primer_apellido;
    }

    public function setPrimerApellido(string $primer_apellido): self
    {
        $this->primer_apellido = $primer_apellido;

        return $this;
    }

    public function getSegundoApellido(): ?string
    {
        return $this->segundo_apellido;
    }

    public function setSegundoApellido(?string $segundo_apellido): self
    {
        $this->segundo_apellido = $segundo_apellido;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getIntegrantes(): ?int
    {
        return $this->integrantes;
    }

    public function setIntegrantes(int $integrantes): self
    {
        $this->integrantes = $integrantes;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
            $donacionesMonetaria->setFamilia($this);
        }

        return $this;
    }

    public function removeDonacionesMonetaria(DonacionMonetaria $donacionesMonetaria): self
    {
        if ($this->donacionesMonetarias->contains($donacionesMonetaria)) {
            $this->donacionesMonetarias->removeElement($donacionesMonetaria);
            // set the owning side to null (unless already changed)
            if ($donacionesMonetaria->getFamilia() === $this) {
                $donacionesMonetaria->setFamilia(null);
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
            $donacionesVivere->setFamilia($this);
        }

        return $this;
    }

    public function removeDonacionesVivere(DonacionViveres $donacionesVivere): self
    {
        if ($this->donacionesViveres->contains($donacionesVivere)) {
            $this->donacionesViveres->removeElement($donacionesVivere);
            // set the owning side to null (unless already changed)
            if ($donacionesVivere->getFamilia() === $this) {
                $donacionesVivere->setFamilia(null);
            }
        }

        return $this;
    }
}
