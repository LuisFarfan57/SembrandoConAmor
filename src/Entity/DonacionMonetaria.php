<?php

namespace App\Entity;

use App\Repository\DonacionMonetariaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DonacionMonetariaRepository::class)
 */
class DonacionMonetaria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="float")
     */
    private $cantidad;

    /**
     * @ORM\ManyToOne(targetEntity=Familia::class, inversedBy="donacionesMonetarias")
     * @ORM\JoinColumn(nullable=true)
     */
    private $familia;

    /**
     * @ORM\ManyToOne(targetEntity=Donador::class, inversedBy="donacionesMonetarias")
     * @ORM\JoinColumn(nullable=true)
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

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCantidad(): ?float
    {
        return $this->cantidad;
    }

    public function setCantidad(float $cantidad): self
    {
        $this->cantidad = $cantidad;

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
