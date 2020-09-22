<?php

namespace App\Entity;

use App\Repository\DonadorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=DonadorRepository::class)
 * @Vich\Uploadable()
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="comprobante_donacion", fileNameProperty="nombreArchivo", size="tamanioArchivo")
     *
     * @var File|null
     */
    private $comprobanteDonacion;

    /**
     * @ORM\Column(type="string", length=200, nullable=false)
     *
     * @var string|null
     */
    private $nombreArchivo;

    /**
     * @ORM\Column(type="integer", nullable=false)
     *
     * @var int|null
     */
    private $tamanioArchivo;

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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile|null $uploadedFile
     */
    public function setComprobanteDonacion(?File $archivo = null): void
    {
        $this->comprobanteDonacion = $archivo;

        if (null !== $archivo) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setTamanioArchivo($archivo->getSize());
        }
    }

    public function getComprobanteDonacion(): ?File
    {
        return $this->comprobanteDonacion;
    }

    public function setNombreArchivo(?string $nombreArchivo): void
    {
        $this->nombreArchivo = $nombreArchivo;
    }

    public function getNombreArchivo(): ?string
    {
        return $this->nombreArchivo;
    }

    public function setTamanioArchivo(?int $tamanioArchivo): void
    {
        $this->tamanioArchivo = $tamanioArchivo;
    }

    public function getTamanioArchivo(): ?int
    {
        return $this->tamanioArchivo;
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
