<?php
/**
 * Created by PhpStorm.
 * User: avera
 * Date: 4/12/17
 * Time: 11:10 AM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* Caso
*
* @ORM\Table(name="caso")
* @ORM\Entity(repositoryClass="App\Repository\CasoRepository")
*/
class Caso
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_caso_pk", type="integer", unique=true)
     */
    private $codigoCasoPk;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255)
     */
    private $asunto;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="adjunto", type="string", length=255, nullable =true)
	 */
	private $adjunto;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=200)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="string", length=200)
     */
    private $contacto;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=100, nullable=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=100)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=50)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=5000)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="soporte", type="string", length=5000, nullable=true)
     */
    private $soporte;

    /**
     * @var string
     *
     * @ORM\Column(name="solucion", type="string", length=5000, nullable=true)
     */
    private $solucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable= TRUE)
     */
    private $fechaRegistro;


	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="fecha_solicitud_informacion", type="datetime", nullable= TRUE)
	 */
	private $fechaSolicitudInformacion;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="fecha_respuesta_solicitud_informacion", type="datetime", nullable= TRUE)
	 */
	private $fechaRespuestaSolicitudInformacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_gestion", type="datetime" ,nullable= TRUE)
     */
    private $fechaGestion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solucion", type="datetime" ,nullable= TRUE)
     */
    private $fechaSolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_categoria_caso_fk", type="string", length=50 )
     */
    private $codigoCategoriaCasoFk;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_cargo_fk", type="string", length=50, nullable=true)
     */
    private $codigoCargoFk;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_area_fk", type="string", length=50, nullable=true)
     */
    private $codigoAreaFk;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_prioridad_fk", type="string", length=50, nullable= TRUE)
     */
    private $codigoPrioridadFk;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_usuario_atiende_fk", type="string", length=50 ,nullable= TRUE)
     */
    private $codigoUsuarioAtiendeFk;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="codigo_tarea_fk", type="integer", length=50 ,nullable= TRUE)
	 */
	private $codigoTareaFk;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_usuario_soluciona_fk", type="string", length=50 ,nullable= TRUE)
     */
    private $codigoUsuarioSolucionaFk;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado_atendido", type="boolean" ,nullable= TRUE)
     */
    private $estadoAtendido = false;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="estado_solicitud_informacion", type="boolean" ,nullable= TRUE)
	 */
	private $estadoSolicitudInformacion = false;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="estado_respuesta_solicitud_informacion", type="boolean" ,nullable= TRUE)
	 */
	private $estadoRespuestaSolicitudInformacion = false;

	/**
	 * @var text
	 *
	 * @ORM\Column(name="solicitud_informacion", type="text" ,nullable= TRUE)
	 */
	private $solicitudInformacion;


	/**
	 * @var text
	 *
	 * @ORM\Column(name="respuesta_solicitud_informacion", type="text" ,nullable= TRUE)
	 */
	private $respuestaSolicitudInformacion;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="estado_escalado", type="boolean" ,nullable= TRUE)
	 */
	private $estadoEscalado = false;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="estado_reabierto", type="boolean" ,nullable= TRUE)
	 */
	private $estadoReabierto = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado_solucionado", type="boolean" ,nullable= TRUE)
     */
    private $estadoSolucionado = false;

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_cliente_fk", type="integer" ,nullable= TRUE)
     */
    private $codigoClienteFk;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="casosClienteRel")
     * @ORM\JoinColumn(name="codigo_cliente_fk", referencedColumnName="codigo_cliente_pk")
     */
    private $clienteRel;

    /**
    * @ORM\ManyToOne(targetEntity="CasoCategoria", inversedBy="casosCategoriaRel")
    * @ORM\JoinColumn(name="codigo_categoria_caso_fk", referencedColumnName="codigo_categoria_caso_pk")
    */
    private $categoriaRel;

    /**
     * @ORM\ManyToOne(targetEntity="Cargo", inversedBy="casosCargoRel")
     * @ORM\JoinColumn(name="codigo_cargo_fk", referencedColumnName="codigo_cargo_pk")
     */
    private $cargoRel;

    /**
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="casosAreaRel")
     * @ORM\JoinColumn(name="codigo_area_fk", referencedColumnName="codigo_area_pk")
     */
    private $areaRel;

    /**
     * @ORM\ManyToOne(targetEntity="Prioridad", inversedBy="casosPrioridadRel")
     * @ORM\JoinColumn(name="codigo_prioridad_fk", referencedColumnName="codigo_prioridad_pk")
     */
    private $prioridadRel;


	/**
	 *
	 * @ORM\OneToMany(targetEntity="Tarea", mappedBy="casoRel")
	 *
	 */
	 private $tareasCasoRel;


	/**
	 *
	 * @ORM\OneToMany(targetEntity="Comentario", mappedBy="casoRel")
	 */

	private $casosComentarioRel;

    /**
     * @return int
     */
    public function getCodigoCasoPk(): int
    {
        return $this->codigoCasoPk;
    }

    /**
     * @param int $codigoCasoPk
     */
    public function setCodigoCasoPk(int $codigoCasoPk): void
    {
        $this->codigoCasoPk = $codigoCasoPk;
    }

    /**
     * @return string
     */
    public function getAsunto(): string
    {
        return $this->asunto;
    }

    /**
     * @param string $asunto
     */
    public function setAsunto(string $asunto): void
    {
        $this->asunto = $asunto;
    }

    /**
     * @return string
     */
    public function getAdjunto(): string
    {
        return $this->adjunto;
    }

    /**
     * @param string $adjunto
     */
    public function setAdjunto(string $adjunto): void
    {
        $this->adjunto = $adjunto;
    }

    /**
     * @return string
     */
    public function getCorreo(): string
    {
        return $this->correo;
    }

    /**
     * @param string $correo
     */
    public function setCorreo(string $correo): void
    {
        $this->correo = $correo;
    }

    /**
     * @return string
     */
    public function getContacto(): string
    {
        return $this->contacto;
    }

    /**
     * @param string $contacto
     */
    public function setContacto(string $contacto): void
    {
        $this->contacto = $contacto;
    }

    /**
     * @return string
     */
    public function getUsuario(): string
    {
        return $this->usuario;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }

    /**
     * @return string
     */
    public function getTelefono(): string
    {
        return $this->telefono;
    }

    /**
     * @param string $telefono
     */
    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     */
    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
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
    public function getSoporte(): string
    {
        return $this->soporte;
    }

    /**
     * @param string $soporte
     */
    public function setSoporte(string $soporte): void
    {
        $this->soporte = $soporte;
    }

    /**
     * @return string
     */
    public function getSolucion(): string
    {
        return $this->solucion;
    }

    /**
     * @param string $solucion
     */
    public function setSolucion(string $solucion): void
    {
        $this->solucion = $solucion;
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
    public function getFechaSolicitudInformacion(): \DateTime
    {
        return $this->fechaSolicitudInformacion;
    }

    /**
     * @param \DateTime $fechaSolicitudInformacion
     */
    public function setFechaSolicitudInformacion(\DateTime $fechaSolicitudInformacion): void
    {
        $this->fechaSolicitudInformacion = $fechaSolicitudInformacion;
    }

    /**
     * @return \DateTime
     */
    public function getFechaRespuestaSolicitudInformacion(): \DateTime
    {
        return $this->fechaRespuestaSolicitudInformacion;
    }

    /**
     * @param \DateTime $fechaRespuestaSolicitudInformacion
     */
    public function setFechaRespuestaSolicitudInformacion(\DateTime $fechaRespuestaSolicitudInformacion): void
    {
        $this->fechaRespuestaSolicitudInformacion = $fechaRespuestaSolicitudInformacion;
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
    public function getCodigoCategoriaCasoFk(): string
    {
        return $this->codigoCategoriaCasoFk;
    }

    /**
     * @param string $codigoCategoriaCasoFk
     */
    public function setCodigoCategoriaCasoFk(string $codigoCategoriaCasoFk): void
    {
        $this->codigoCategoriaCasoFk = $codigoCategoriaCasoFk;
    }

    /**
     * @return string
     */
    public function getCodigoCargoFk(): string
    {
        return $this->codigoCargoFk;
    }

    /**
     * @param string $codigoCargoFk
     */
    public function setCodigoCargoFk(string $codigoCargoFk): void
    {
        $this->codigoCargoFk = $codigoCargoFk;
    }

    /**
     * @return string
     */
    public function getCodigoAreaFk(): string
    {
        return $this->codigoAreaFk;
    }

    /**
     * @param string $codigoAreaFk
     */
    public function setCodigoAreaFk(string $codigoAreaFk): void
    {
        $this->codigoAreaFk = $codigoAreaFk;
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
    public function getCodigoUsuarioAtiendeFk(): string
    {
        return $this->codigoUsuarioAtiendeFk;
    }

    /**
     * @param string $codigoUsuarioAtiendeFk
     */
    public function setCodigoUsuarioAtiendeFk(string $codigoUsuarioAtiendeFk): void
    {
        $this->codigoUsuarioAtiendeFk = $codigoUsuarioAtiendeFk;
    }

    /**
     * @return string
     */
    public function getCodigoTareaFk(): string
    {
        return $this->codigoTareaFk;
    }

    /**
     * @param string $codigoTareaFk
     */
    public function setCodigoTareaFk(string $codigoTareaFk): void
    {
        $this->codigoTareaFk = $codigoTareaFk;
    }

    /**
     * @return string
     */
    public function getCodigoUsuarioSolucionaFk(): string
    {
        return $this->codigoUsuarioSolucionaFk;
    }

    /**
     * @param string $codigoUsuarioSolucionaFk
     */
    public function setCodigoUsuarioSolucionaFk(string $codigoUsuarioSolucionaFk): void
    {
        $this->codigoUsuarioSolucionaFk = $codigoUsuarioSolucionaFk;
    }

    /**
     * @return bool
     */
    public function isEstadoAtendido(): bool
    {
        return $this->estadoAtendido;
    }

    /**
     * @param bool $estadoAtendido
     */
    public function setEstadoAtendido(bool $estadoAtendido): void
    {
        $this->estadoAtendido = $estadoAtendido;
    }

    /**
     * @return bool
     */
    public function isEstadoSolicitudInformacion(): bool
    {
        return $this->estadoSolicitudInformacion;
    }

    /**
     * @param bool $estadoSolicitudInformacion
     */
    public function setEstadoSolicitudInformacion(bool $estadoSolicitudInformacion): void
    {
        $this->estadoSolicitudInformacion = $estadoSolicitudInformacion;
    }

    /**
     * @return bool
     */
    public function isEstadoRespuestaSolicitudInformacion(): bool
    {
        return $this->estadoRespuestaSolicitudInformacion;
    }

    /**
     * @param bool $estadoRespuestaSolicitudInformacion
     */
    public function setEstadoRespuestaSolicitudInformacion(bool $estadoRespuestaSolicitudInformacion): void
    {
        $this->estadoRespuestaSolicitudInformacion = $estadoRespuestaSolicitudInformacion;
    }

    /**
     * @return text
     */
    public function getSolicitudInformacion(): text
    {
        return $this->solicitudInformacion;
    }

    /**
     * @param text $solicitudInformacion
     */
    public function setSolicitudInformacion(text $solicitudInformacion): void
    {
        $this->solicitudInformacion = $solicitudInformacion;
    }

    /**
     * @return text
     */
    public function getRespuestaSolicitudInformacion(): text
    {
        return $this->respuestaSolicitudInformacion;
    }

    /**
     * @param text $respuestaSolicitudInformacion
     */
    public function setRespuestaSolicitudInformacion(text $respuestaSolicitudInformacion): void
    {
        $this->respuestaSolicitudInformacion = $respuestaSolicitudInformacion;
    }

    /**
     * @return bool
     */
    public function isEstadoEscalado(): bool
    {
        return $this->estadoEscalado;
    }

    /**
     * @param bool $estadoEscalado
     */
    public function setEstadoEscalado(bool $estadoEscalado): void
    {
        $this->estadoEscalado = $estadoEscalado;
    }

    /**
     * @return bool
     */
    public function isEstadoReabierto(): bool
    {
        return $this->estadoReabierto;
    }

    /**
     * @param bool $estadoReabierto
     */
    public function setEstadoReabierto(bool $estadoReabierto): void
    {
        $this->estadoReabierto = $estadoReabierto;
    }

    /**
     * @return bool
     */
    public function isEstadoSolucionado(): bool
    {
        return $this->estadoSolucionado;
    }

    /**
     * @param bool $estadoSolucionado
     */
    public function setEstadoSolucionado(bool $estadoSolucionado): void
    {
        $this->estadoSolucionado = $estadoSolucionado;
    }

    /**
     * @return int
     */
    public function getCodigoClienteFk(): int
    {
        return $this->codigoClienteFk;
    }

    /**
     * @param int $codigoClienteFk
     */
    public function setCodigoClienteFk(int $codigoClienteFk): void
    {
        $this->codigoClienteFk = $codigoClienteFk;
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
    public function getCategoriaRel()
    {
        return $this->categoriaRel;
    }

    /**
     * @param mixed $categoriaRel
     */
    public function setCategoriaRel($categoriaRel): void
    {
        $this->categoriaRel = $categoriaRel;
    }

    /**
     * @return mixed
     */
    public function getCargoRel()
    {
        return $this->cargoRel;
    }

    /**
     * @param mixed $cargoRel
     */
    public function setCargoRel($cargoRel): void
    {
        $this->cargoRel = $cargoRel;
    }

    /**
     * @return mixed
     */
    public function getAreaRel()
    {
        return $this->areaRel;
    }

    /**
     * @param mixed $areaRel
     */
    public function setAreaRel($areaRel): void
    {
        $this->areaRel = $areaRel;
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
    public function getTareasCasoRel()
    {
        return $this->tareasCasoRel;
    }

    /**
     * @param mixed $tareasCasoRel
     */
    public function setTareasCasoRel($tareasCasoRel): void
    {
        $this->tareasCasoRel = $tareasCasoRel;
    }

    /**
     * @return mixed
     */
    public function getCasosComentarioRel()
    {
        return $this->casosComentarioRel;
    }

    /**
     * @param mixed $casosComentarioRel
     */
    public function setCasosComentarioRel($casosComentarioRel): void
    {
        $this->casosComentarioRel = $casosComentarioRel;
    }



}
