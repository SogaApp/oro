<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Caso
 *
 * @ORM\Table(name="implementacion_grupo")
 * @ORM\Entity(repositoryClass="App\Repository\ImplementacionDetalleRepository")
 */
class ImplementacionGrupo
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_implementacion_grupo_pk", type="integer", unique=true)
     */
    private $codigoImplementacionGrupoPk;

    /**
     * @ORM\Column(name="nombre", type="string", length=50, nullable= TRUE)
     */
    private $nombre;

    /**
     *
     * @ORM\OneToMany(targetEntity="ImplementacionDetalle", mappedBy="implementacionGrupoRel")
     */
    private $implementacionesDetallesImplementacionGrupoRel;

    /**
     *
     * @ORM\OneToMany(targetEntity="ImplementacionTema", mappedBy="implementacionGrupoRel")
     */
    private $implementacionesTemasImplementacionGrupoRel;

    public function __construct()
    {
        $this->implementacionesDetallesImplementacionGrupoRel = new ArrayCollection();
        $this->implementacionesTemasImplementacionGrupoRel = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getCodigoImplementacionGrupoPk(): int
    {
        return $this->codigoImplementacionGrupoPk;
    }

    /**
     * @param int $codigoImplementacionGrupoPk
     */
    public function setCodigoImplementacionGrupoPk(int $codigoImplementacionGrupoPk): void
    {
        $this->codigoImplementacionGrupoPk = $codigoImplementacionGrupoPk;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getImplementacionesDetallesImplementacionGrupoRel()
    {
        return $this->implementacionesDetallesImplementacionGrupoRel;
    }

    /**
     * @param mixed $implementacionesDetallesImplementacionGrupoRel
     */
    public function setImplementacionesDetallesImplementacionGrupoRel($implementacionesDetallesImplementacionGrupoRel): void
    {
        $this->implementacionesDetallesImplementacionGrupoRel = $implementacionesDetallesImplementacionGrupoRel;
    }

    /**
     * @return mixed
     */
    public function getImplementacionesTemasImplementacionGrupoRel()
    {
        return $this->implementacionesTemasImplementacionGrupoRel;
    }

    /**
     * @param mixed $implementacionesTemasImplementacionGrupoRel
     */
    public function setImplementacionesTemasImplementacionGrupoRel($implementacionesTemasImplementacionGrupoRel): void
    {
        $this->implementacionesTemasImplementacionGrupoRel = $implementacionesTemasImplementacionGrupoRel;
    }

    public function addImplementacionesDetallesImplementacionGrupoRel(ImplementacionDetalle $implementacionesDetallesImplementacionGrupoRel): self
    {
        if (!$this->implementacionesDetallesImplementacionGrupoRel->contains($implementacionesDetallesImplementacionGrupoRel)) {
            $this->implementacionesDetallesImplementacionGrupoRel[] = $implementacionesDetallesImplementacionGrupoRel;
            $implementacionesDetallesImplementacionGrupoRel->setImplementacionGrupoRel($this);
        }

        return $this;
    }

    public function removeImplementacionesDetallesImplementacionGrupoRel(ImplementacionDetalle $implementacionesDetallesImplementacionGrupoRel): self
    {
        if ($this->implementacionesDetallesImplementacionGrupoRel->contains($implementacionesDetallesImplementacionGrupoRel)) {
            $this->implementacionesDetallesImplementacionGrupoRel->removeElement($implementacionesDetallesImplementacionGrupoRel);
            // set the owning side to null (unless already changed)
            if ($implementacionesDetallesImplementacionGrupoRel->getImplementacionGrupoRel() === $this) {
                $implementacionesDetallesImplementacionGrupoRel->setImplementacionGrupoRel(null);
            }
        }

        return $this;
    }

    public function addImplementacionesTemasImplementacionGrupoRel(ImplementacionTema $implementacionesTemasImplementacionGrupoRel): self
    {
        if (!$this->implementacionesTemasImplementacionGrupoRel->contains($implementacionesTemasImplementacionGrupoRel)) {
            $this->implementacionesTemasImplementacionGrupoRel[] = $implementacionesTemasImplementacionGrupoRel;
            $implementacionesTemasImplementacionGrupoRel->setImplementacionGrupoRel($this);
        }

        return $this;
    }

    public function removeImplementacionesTemasImplementacionGrupoRel(ImplementacionTema $implementacionesTemasImplementacionGrupoRel): self
    {
        if ($this->implementacionesTemasImplementacionGrupoRel->contains($implementacionesTemasImplementacionGrupoRel)) {
            $this->implementacionesTemasImplementacionGrupoRel->removeElement($implementacionesTemasImplementacionGrupoRel);
            // set the owning side to null (unless already changed)
            if ($implementacionesTemasImplementacionGrupoRel->getImplementacionGrupoRel() === $this) {
                $implementacionesTemasImplementacionGrupoRel->setImplementacionGrupoRel(null);
            }
        }

        return $this;
    }


}
