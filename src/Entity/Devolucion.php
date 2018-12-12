<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devolucion
 *
 * @ORM\Table(name="devolucion")
 * @ORM\Entity(repositoryClass="App\Repository\DevolucionRepository")
 */

class Devolucion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_devolucion_pk", type="integer", unique=true)
     */
    private $codigoDevolucionPk;

    /**
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(name="comentarios", type="text", nullable=true)
     */
    private $comentarios;

    /**
     * @ORM\Column(name="codigo_tarea_fk", type="integer", nullable=true)
     */
    private $codigoTareaFk;

    /**
     * @ORM\ManyToOne(targetEntity="Tarea", inversedBy="tareasDevolucionRel")
     * @ORM\JoinColumn(name="codigo_tarea_fk", referencedColumnName="codigo_tarea_pk")
     */
    private $devolucionRel;

    /**
     * @return mixed
     */
    public function getCodigoDevolucionPk()
    {
        return $this->codigoDevolucionPk;
    }

    /**
     * @param mixed $codigoDevolucionPk
     */
    public function setCodigoDevolucionPk($codigoDevolucionPk): void
    {
        $this->codigoDevolucionPk = $codigoDevolucionPk;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * @param mixed $comentarios
     */
    public function setComentarios($comentarios): void
    {
        $this->comentarios = $comentarios;
    }

    /**
     * @return mixed
     */
    public function getCodigoTareaFk()
    {
        return $this->codigoTareaFk;
    }

    /**
     * @param mixed $codigoTareaFk
     */
    public function setCodigoTareaFk($codigoTareaFk): void
    {
        $this->codigoTareaFk = $codigoTareaFk;
    }

    /**
     * @return mixed
     */
    public function getDevolucionRel()
    {
        return $this->devolucionRel;
    }

    /**
     * @param mixed $devolucionRel
     */
    public function setDevolucionRel($devolucionRel): void
    {
        $this->devolucionRel = $devolucionRel;
    }

}