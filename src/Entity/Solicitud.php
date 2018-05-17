<?php
/**
 * Created by Juan David Marulanda V.
 * User: @ju4nr3v0l
 * appSoga developers Team.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarea
 *
 * @ORM\Table(name="solicitud")
 * @ORM\Entity(repositoryClass="App\Repository\SolicitudRepository")
 */
class Solicitud
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_solicitud_pk", type="integer", unique=true )
     */
    private $codigoSolicitudPk;

    /**
     * @ORM\Column(name="codigo_cliente_fk", type="integer", nullable=true)
     */
    private $codigoClienteFk;

    /**
     * @ORM\Column(name="$codigoSolicitudTipoFk", type="string", length=10, nullable=true)
     */
    private $codigoSolicitudTipoFk;

    /**
     * @ORM\Column(name="fecha_solicitud", type="datetime", nullable=true)
     */
    private $fechaSolicitud;

    /**
     * @ORM\Column(name="fecha_atencion", type="datetime", nullable=true)
     */
    private $fechaAtencion;


    /**
     * @ORM\Column(name="estado_atendido", type="boolean", nullable=true)
     */
    private $estadoAtendido = false;

    /**
     * @ORM\Column(name="estado_cerrado", type="boolean", nullable=true)
     */
    private $estadoCerrado = false;

    /**
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="solicitudesClienteRel")
     * @ORM\JoinColumn(name="codigo_cliente_fk", referencedColumnName="codigo_cliente_pk")
     */
    private $clienteRel;

    /**
     * @ORM\ManyToOne(targetEntity="SolicitudTipo", inversedBy="tsolicitudesSolicitudTipoRel")
     * @ORM\JoinColumn(name="codigo_solicitud_tipo_fk", referencedColumnName="codigo_solicitud_tipo_pk")
     */
    private $solicitudTipoRel;

    /**
     * @return mixed
     */
    public function getCodigoSolicitudPk()
    {
        return $this->codigoSolicitudPk;
    }

    /**
     * @param mixed $codigoSolicitudPk
     */
    public function setCodigoSolicitudPk($codigoSolicitudPk): void
    {
        $this->codigoSolicitudPk = $codigoSolicitudPk;
    }

    /**
     * @return mixed
     */
    public function getCodigoClienteFk()
    {
        return $this->codigoClienteFk;
    }

    /**
     * @param mixed $codigoClienteFk
     */
    public function setCodigoClienteFk($codigoClienteFk): void
    {
        $this->codigoClienteFk = $codigoClienteFk;
    }

    /**
     * @return mixed
     */
    public function getCodigoSolicitudTipoFk()
    {
        return $this->codigoSolicitudTipoFk;
    }

    /**
     * @param mixed $codigoSolicitudTipoFk
     */
    public function setCodigoSolicitudTipoFk($codigoSolicitudTipoFk): void
    {
        $this->codigoSolicitudTipoFk = $codigoSolicitudTipoFk;
    }

    /**
     * @return mixed
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * @param mixed $fechaSolicitud
     */
    public function setFechaSolicitud($fechaSolicitud): void
    {
        $this->fechaSolicitud = $fechaSolicitud;
    }

    /**
     * @return mixed
     */
    public function getFechaAtencion()
    {
        return $this->fechaAtencion;
    }

    /**
     * @param mixed $fechaAtencion
     */
    public function setFechaAtencion($fechaAtencion): void
    {
        $this->fechaAtencion = $fechaAtencion;
    }

    /**
     * @return mixed
     */
    public function getEstadoAtendido()
    {
        return $this->estadoAtendido;
    }

    /**
     * @param mixed $estadoAtendido
     */
    public function setEstadoAtendido($estadoAtendido): void
    {
        $this->estadoAtendido = $estadoAtendido;
    }

    /**
     * @return mixed
     */
    public function getEstadoCerrado()
    {
        return $this->estadoCerrado;
    }

    /**
     * @param mixed $estadoCerrado
     */
    public function setEstadoCerrado($estadoCerrado): void
    {
        $this->estadoCerrado = $estadoCerrado;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getClienteRel()
    {
        return $this->clienteRel;
    }

    /**
     * @param mixed $clienteRel
     */
    public function setClienteRel($clienteRel): void
    {
        $this->clienteRel = $clienteRel;
    }

    /**
     * @return mixed
     */
    public function getSolicitudTipoRel()
    {
        return $this->solicitudTipoRel;
    }

    /**
     * @param mixed $solicitudTipoRel
     */
    public function setSolicitudTipoRel($solicitudTipoRel): void
    {
        $this->solicitudTipoRel = $solicitudTipoRel;
    }

}
