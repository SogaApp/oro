<?php
/**
 * Created by Juan David Marulanda V.
 * User: @ju4nr3v0l
 * appSoga developers Team.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TareaTipo
 *
 * @ORM\Table(name="solicitud_tipo")
 * @ORM\Entity(repositoryClass="App\Repository\SolicitudTipoRepository")
 */
class SolicitudTipo
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="codigo_solicitud_tipo_pk",length=10)
     */
    private $codigoSolicitudTipoPk;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     *
     * @ORM\OneToMany(targetEntity="Solicitud", mappedBy="solicitudTipoRel")
     */

    private $solicitudesSolicitudTipoRel;

    public function __construct()
    {
        $this->solicitudesSolicitudTipoRel = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getCodigoSolicitudTipoPk(): string
    {
        return $this->codigoSolicitudTipoPk;
    }

    /**
     * @param string $codigoSolicitudTipoPk
     */
    public function setCodigoSolicitudTipoPk(string $codigoSolicitudTipoPk): void
    {
        $this->codigoSolicitudTipoPk = $codigoSolicitudTipoPk;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getSolicitudesSolicitudTipoRel()
    {
        return $this->solicitudesSolicitudTipoRel;
    }

    /**
     * @param mixed $solicitudesSolicitudTipoRel
     */
    public function setSolicitudesSolicitudTipoRel($solicitudesSolicitudTipoRel): void
    {
        $this->solicitudesSolicitudTipoRel = $solicitudesSolicitudTipoRel;
    }

    public function addSolicitudesSolicitudTipoRel(Solicitud $solicitudesSolicitudTipoRel): self
    {
        if (!$this->solicitudesSolicitudTipoRel->contains($solicitudesSolicitudTipoRel)) {
            $this->solicitudesSolicitudTipoRel[] = $solicitudesSolicitudTipoRel;
            $solicitudesSolicitudTipoRel->setSolicitudTipoRel($this);
        }

        return $this;
    }

    public function removeSolicitudesSolicitudTipoRel(Solicitud $solicitudesSolicitudTipoRel): self
    {
        if ($this->solicitudesSolicitudTipoRel->contains($solicitudesSolicitudTipoRel)) {
            $this->solicitudesSolicitudTipoRel->removeElement($solicitudesSolicitudTipoRel);
            // set the owning side to null (unless already changed)
            if ($solicitudesSolicitudTipoRel->getSolicitudTipoRel() === $this) {
                $solicitudesSolicitudTipoRel->setSolicitudTipoRel(null);
            }
        }

        return $this;
    }

}
