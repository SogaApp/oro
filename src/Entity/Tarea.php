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
    public function getCodigoTareaPk(): int
    {
        return $this->codigoTareaPk;
    }

    /**
     * @param int $codigoTareaPk
     */
    public function setCodigoTareaPk(int $codigoTareaPk): void
    {
        $this->codigoTareaPk = $codigoTareaPk;
    }

    /**
     * @return string
     */
    public function getCodigoUsuarioRegistraFk(): string
    {
        return $this->codigoUsuarioRegistraFk;
    }

    /**
     * @param string $codigoUsuarioRegistraFk
     */
    public function setCodigoUsuarioRegistraFk(string $codigoUsuarioRegistraFk): void
    {
        $this->codigoUsuarioRegistraFk = $codigoUsuarioRegistraFk;
    }

    /**
     * @return string
     */
    public function getCodigoPrioridadFk(): string
    {
        return $this->codigoPrioridadFk;
    }

    /**
     * @param string $codigoPrioridadFk
     */
    public function setCodigoPrioridadFk(string $codigoPrioridadFk): void
    {
        $this->codigoPrioridadFk = $codigoPrioridadFk;
    }

    /**
     * @return string
     */
    public function getCodigoTareaTipoFk(): string
    {
        return $this->codigoTareaTipoFk;
    }

    /**
     * @param string $codigoTareaTipoFk
     */
    public function setCodigoTareaTipoFk(string $codigoTareaTipoFk): void
    {
        $this->codigoTareaTipoFk = $codigoTareaTipoFk;
    }

    /**
     * @return \DateTime
     */
    public function getFechaRegistro(): \DateTime
    {
        return $this->fechaRegistro;
    }

    /**
     * @param \DateTime $fechaRegistro
     */
    public function setFechaRegistro(\DateTime $fechaRegistro): void
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    /**
     * @return \DateTime
     */
    public function getFechaVerificado(): \DateTime
    {
        return $this->fechaVerificado;
    }

    /**
     * @param \DateTime $fechaVerificado
     */
    public function setFechaVerificado(\DateTime $fechaVerificado): void
    {
        $this->fechaVerificado = $fechaVerificado;
    }

    /**
     * @return bool
     */
    public function isEstadoTerminado(): bool
    {
        return $this->estadoTerminado;
    }

    /**
     * @param bool $estadoTerminado
     */
    public function setEstadoTerminado(bool $estadoTerminado): void
    {
        $this->estadoTerminado = $estadoTerminado;
    }

    /**
     * @return bool
     */
    public function isEstadoVerificado(): bool
    {
        return $this->estadoVerificado;
    }

    /**
     * @param bool $estadoVerificado
     */
    public function setEstadoVerificado(bool $estadoVerificado): void
    {
        $this->estadoVerificado = $estadoVerificado;
    }

    /**
     * @return string
     */
    public function getCodigoUsuarioAsignaFk(): string
    {
        return $this->codigoUsuarioAsignaFk;
    }

    /**
     * @param string $codigoUsuarioAsignaFk
     */
    public function setCodigoUsuarioAsignaFk(string $codigoUsuarioAsignaFk): void
    {
        $this->codigoUsuarioAsignaFk = $codigoUsuarioAsignaFk;
    }

    /**
     * @return string
     */
    public function getCodigoCasoFk(): string
    {
        return $this->codigoCasoFk;
    }

    /**
     * @param string $codigoCasoFk
     */
    public function setCodigoCasoFk(string $codigoCasoFk): void
    {
        $this->codigoCasoFk = $codigoCasoFk;
    }

    /**
     * @return \DateTime
     */
    public function getFechaGestion(): \DateTime
    {
        return $this->fechaGestion;
    }

    /**
     * @param \DateTime $fechaGestion
     */
    public function setFechaGestion(\DateTime $fechaGestion): void
    {
        $this->fechaGestion = $fechaGestion;
    }

    /**
     * @return \DateTime
     */
    public function getFechaSolucion(): \DateTime
    {
        return $this->fechaSolucion;
    }

    /**
     * @param \DateTime $fechaSolucion
     */
    public function setFechaSolucion(\DateTime $fechaSolucion): void
    {
        $this->fechaSolucion = $fechaSolucion;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return string
     */
    public function getComentario(): string
    {
        return $this->comentario;
    }

    /**
     * @param string $comentario
     */
    public function setComentario(string $comentario): void
    {
        $this->comentario = $comentario;
    }

    /**
     * @return string
     */
    public function getCaso(): string
    {
        return $this->caso;
    }

    /**
     * @param string $caso
     */
    public function setCaso(string $caso): void
    {
        $this->caso = $caso;
    }

    /**
     * @return mixed
     */
    public function getTareaTipoRel()
    {
        return $this->tareaTipoRel;
    }

    /**
     * @param mixed $tareaTipoRel
     */
    public function setTareaTipoRel($tareaTipoRel): void
    {
        $this->tareaTipoRel = $tareaTipoRel;
    }

    /**
     * @return mixed
     */
    public function getPrioridadRel()
    {
        return $this->prioridadRel;
    }

    /**
     * @param mixed $prioridadRel
     */
    public function setPrioridadRel($prioridadRel): void
    {
        $this->prioridadRel = $prioridadRel;
    }

    /**
     * @return mixed
     */
    public function getCasoRel()
    {
        return $this->casoRel;
    }

    /**
     * @param mixed $casoRel
     */
    public function setCasoRel($casoRel): void
    {
        $this->casoRel = $casoRel;
    }

    /**
     * @return mixed
     */
    public function getTareasComentarioRel()
    {
        return $this->tareasComentarioRel;
    }

    /**
     * @param mixed $tareasComentarioRel
     */
    public function setTareasComentarioRel($tareasComentarioRel): void
    {
        $this->tareasComentarioRel = $tareasComentarioRel;
    }


   }
