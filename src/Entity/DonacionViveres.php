<?php

namespace App\Entity;

use App\Repository\DonacionViveresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DonacionViveresRepository::class)
 */
class DonacionViveres
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $unidad_medida;

    /**
     * @ORM\ManyToOne(targetEntity=Familia::class, inversedBy="donacionesViveres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $familia;

    /**
     * @ORM\ManyToOne(targetEntity=Donador::class, inversedBy="donacionesViveres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $donador;

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

    public function getUnidadMedida(): ?string
    {
        return $this->unidad_medida;
    }

    public function setUnidadMedida(string $unidad_medida): self
    {
        $this->unidad_medida = $unidad_medida;

        return $this;
    }

    public function getFamilia(): ?Familia
    {
        return $this->familia;
    }

    public function setFamilia(?Familia $familia): self
    {
        $this->familia = $familia;

        return $this;
    }

    public function getDonador(): ?Donador
    {
        return $this->donador;
    }

    public function setDonador(?Donador $donador): self
    {
        $this->donador = $donador;

        return $this;
    }
}
