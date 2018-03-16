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
 * @ORM\Table(name="tarea")
 * @ORM\Entity(repositoryClass="App\Repository\TareaRepository")
 */
class Tarea
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_tarea_pk", type="integer", unique=true )
     */
    private $codigoTareaPk;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_usuario_registra_fk", type="string", length=50)
     */
    private $codigoUsuarioRegistraFk;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="codigo_prioridad_fk", type="string", length=50, nullable=true)
	 */
	private $codigoPrioridadFk;


	/**
     * @var string
     *
     * @ORM\Column(name="codigo_tarea_tipo_fk", type="string", length=50, nullable=true)
     */
    private $codigoTareaTipoFk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_verificado", type="datetime", nullable=true)
     */
    private $fechaVerificado;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado_terminado", type="boolean", nullable=true)
     */
    private $estadoTerminado = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado_verificado", type="boolean", nullable=true)
     */
    private $estadoVerificado = false;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_usuario_asigna_fk", type="string", length=50, nullable=true)
     */
    private $codigoUsuarioAsignaFk;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="codigo_caso_fk", type="integer", length=50, nullable=true)
	 */
	private $codigoCasoFk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_gestion", type="datetime", nullable=true)
     */
    private $fechaGestion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solucion", type="datetime", nullable=true)
     */
    private $fechaSolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=5000, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=5000, nullable=true)
     */
    private $comentario;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="caso", type="string", length=10, nullable=true)
	 */
	private $caso;

    /**
     * @ORM\ManyToOne(targetEntity="TareaTipo", inversedBy="tareasTareaTipoRel")
     * @ORM\JoinColumn(name="codigo_tarea_tipo_fk", referencedColumnName="codigo_tarea_tipo_pk")
     */
    private $tareaTipoRel;

	/**
	 * @ORM\ManyToOne(targetEntity="Prioridad", inversedBy="tareaPrioridadRel")
	 * @ORM\JoinColumn(name="codigo_prioridad_fk", referencedColumnName="codigo_prioridad_pk")
	 */
	private $prioridadRel;


	/**
	 * @ORM\ManyToOne(targetEntity="Caso", inversedBy="tareasCasoRel")
	 * @ORM\JoinColumn(name="codigo_caso_fk", referencedColumnName="codigo_caso_pk", nullable=true)
	 */
	private $casoRel;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="Comentario", mappedBy="tareaRel")
	 */

	private $tareasComentarioRel;

    /**
     * @return int
     */
    public function getCodigoTareaPk()
    {
        return $this->codigoTareaPk;
    }

    /**
     * @param int
     */
    public function setCodigoTareaPk($codigoTareaPk)
    {
        $this->codigoTareaPk = $codigoTareaPk;
	    return $this;
    }

    /**
     * @return string
     */
    public function getCodigoUsuarioRegistraFk()
    {
        return $this->codigoUsuarioRegistraFk;
    }

    /**
     * @param string
     */
    public function setCodigoUsuarioRegistraFk($codigoUsuarioRegistraFk)
    {
        $this->codigoUsuarioRegistraFk = $codigoUsuarioRegistraFk;
	    return $this;
    }

    /**
     * @return string
     */
    public function getCodigoPrioridadFk()
    {
        return $this->codigoPrioridadFk;
    }

    /**
     * @param string $codigoPrioridadFk
     */
    public function setCodigoPrioridadFk($codigoPrioridadFk)
    {
        $this->codigoPrioridadFk = $codigoPrioridadFk;
	    return $this;
    }

    /**
     * @return string
     */
    public function getCodigoTareaTipoFk()
    {
        return $this->codigoTareaTipoFk;
    }

    /**
     * @param string
     */
    public function setCodigoTareaTipoFk( $codigoTareaTipoFk)
    {
        $this->codigoTareaTipoFk = $codigoTareaTipoFk;
	    return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * @param \DateTime
     */
    public function setFechaRegistro( $fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
	    return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaVerificado()
    {
        return $this->fechaVerificado;
    }

    /**
     * @param \DateTime
     *
     */
    public function setFechaVerificado($fechaVerificado)
    {
        $this->fechaVerificado = $fechaVerificado;
	    return $this;
    }

    /**
     * @return bool
     */
    public function isEstadoTerminado()
    {
        return $this->estadoTerminado;
    }

    /**
     * @param bool
     */
    public function setEstadoTerminado($estadoTerminado)
    {
        $this->estadoTerminado = $estadoTerminado;
	    return $this;
    }

    /**
     * @return bool
     */
    public function isEstadoVerificado()
    {
        return $this->estadoVerificado;
    }

    /**
     * @param bool
     */
    public function setEstadoVerificado($estadoVerificado)
    {
        $this->estadoVerificado = $estadoVerificado;
	    return $this;
    }

    /**
     * @return string
     */
    public function getCodigoUsuarioAsignaFk()
    {
        return $this->codigoUsuarioAsignaFk;
    }

    /**
     * @param string
     */
    public function setCodigoUsuarioAsignaFk($codigoUsuarioAsignaFk)
    {
        $this->codigoUsuarioAsignaFk = $codigoUsuarioAsignaFk;
	    return $this;
    }

    /**
     * @return string
     */
    public function getCodigoCasoFk()
    {
        return $this->codigoCasoFk;
    }

    /**
     * @param string
     */
    public function setCodigoCasoFk($codigoCasoFk)
    {
        $this->codigoCasoFk = $codigoCasoFk;
	    return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaGestion()
    {
        return $this->fechaGestion;
    }

    /**
     * @param \DateTime
     */
    public function setFechaGestion($fechaGestion)
    {
        $this->fechaGestion = $fechaGestion;
	    return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaSolucion()
    {
        return $this->fechaSolucion;
    }

    /**
     * @param \DateTime $fechaSolucion
     */
    public function setFechaSolucion($fechaSolucion)
    {
        $this->fechaSolucion = $fechaSolucion;
	    return $this;
    }

    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;

    }

    /**
     * @param string
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
	    return $this;
    }

    /**
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @param string
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    /**
     * @return string
     */
    public function getCaso()
    {
        return $this->caso;

    }

    /**
     * @param string
     */
    public function setCaso( $caso)
    {
        $this->caso = $caso;
	    return $this;
    }

    /**
     * @return mixed
     */
    public function getTareaTipoRel()
    {
        return $this->tareaTipoRel;
    }

    /**
     * @param mixed
     */
    public function setTareaTipoRel($tareaTipoRel)
    {
        $this->tareaTipoRel = $tareaTipoRel;
	    return $this;
    }

    /**
     * @return mixed
     */
    public function getPrioridadRel()
    {
        return $this->prioridadRel;
    }

    /**
     * @param mixed
     */
    public function setPrioridadRel($prioridadRel)
    {
        $this->prioridadRel = $prioridadRel;
	    return $this;
    }

    /**
     * @return mixed
     */
    public function getCasoRel()
    {
        return $this->casoRel;
    }

    /**
     * @param mixed
     */
    public function setCasoRel($casoRel)
    {
        $this->casoRel = $casoRel;
	    return $this;
    }

    /**
     * @return mixed
     */
    public function getTareasComentarioRel()
    {
        return $this->tareasComentarioRel;
    }

    /**
     * @param mixed
     */
    public function setTareasComentarioRel($tareasComentarioRel)
    {
        $this->tareasComentarioRel = $tareasComentarioRel;
        return $this;
    }


   }
