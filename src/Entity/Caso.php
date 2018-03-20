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
     * @ORM\Column(name="estado_tarea", type="boolean", nullable=TRUE)
     */
    private $estadoTarea = false;

    /**
     * @ORM\Column(name="estado_tarea_terminada", type="boolean", nullable=TRUE)
     */
    private $estadoTareaTerminada = false;

    /**
     * @ORM\Column(name="estado_tarea_revisada", type="boolean", nullable=TRUE)
     */
    private $estadoTareaRevisada = false;

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
    public function getCodigoCasoPk()
    {
        return $this->codigoCasoPk;
    }

    /**
     * @param int
     */
    public function setCodigoCasoPk($codigoCasoPk)
    {
        $this->codigoCasoPk = $codigoCasoPk;
	    return $this;
    }

    /**
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * @param string
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
	    return $this;
    }

    /**
     * @return string
     */
    public function getAdjunto()
    {
        return $this->adjunto;
    }

    /**
     * @param string
     */
    public function setAdjunto($adjunto)
    {
        $this->adjunto = $adjunto;
	    return $this;
    }

    /**
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param string
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
	    return $this;
    }

    /**
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * @param string
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;
	    return $this;
    }

    /**
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param string
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
	    return $this;
    }

    /**
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param string
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
	    return $this;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
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
    public function getSoporte()
    {
        return $this->soporte;
    }

    /**
     * @param string
     */
    public function setSoporte($soporte)
    {
        $this->soporte = $soporte;
	    return $this;
    }

    /**
     * @return string
     */
    public function getSolucion()
    {
        return $this->solucion;
    }

    /**
     * @param string
     */
    public function setSolucion($solucion)
    {
        $this->solucion = $solucion;
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
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
	    return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaSolicitudInformacion()
    {
        return $this->fechaSolicitudInformacion;
    }

    /**
     * @param \DateTime
     */
    public function setFechaSolicitudInformacion ($fechaSolicitudInformacion)
    {
        $this->fechaSolicitudInformacion = $fechaSolicitudInformacion;
	    return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaRespuestaSolicitudInformacion()
    {
        return $this->fechaRespuestaSolicitudInformacion;
    }

    /**
     * @param \DateTime
     */
    public function setFechaRespuestaSolicitudInformacion($fechaRespuestaSolicitudInformacion)
    {
        $this->fechaRespuestaSolicitudInformacion = $fechaRespuestaSolicitudInformacion;
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
     * @param \DateTime
     */
    public function setFechaSolucion($fechaSolucion)
    {
        $this->fechaSolucion = $fechaSolucion;
    }

    /**
     * @return string
     */
    public function getCodigoCategoriaCasoFk()
    {
        return $this->codigoCategoriaCasoFk;
    }

    /**
     * @param string
     */
    public function setCodigoCategoriaCasoFk($codigoCategoriaCasoFk)
    {
        $this->codigoCategoriaCasoFk = $codigoCategoriaCasoFk;
	    return $this;
    }

    /**
     * @return string
     */
    public function getCodigoCargoFk()
    {
        return $this->codigoCargoFk;
    }

    /**
     * @param string
     */
    public function setCodigoCargoFk($codigoCargoFk)
    {
        $this->codigoCargoFk = $codigoCargoFk;
    }

    /**
     * @return string
     */
    public function getCodigoAreaFk()
    {
        return $this->codigoAreaFk;
    }

    /**
     * @param string
     */
    public function setCodigoAreaFk($codigoAreaFk)
    {
        $this->codigoAreaFk = $codigoAreaFk;
    }

    /**
     * @return string
     */
    public function getCodigoPrioridadFk()
    {
        return $this->codigoPrioridadFk;
    }

    /**
     * @param string
     */
    public function setCodigoPrioridadFk($codigoPrioridadFk)
    {
        $this->codigoPrioridadFk = $codigoPrioridadFk;
	    return $this;
    }

    /**
     * @return string
     */
    public function getCodigoUsuarioAtiendeFk()
    {
        return $this->codigoUsuarioAtiendeFk;
    }

    /**
     * @param string
     */
    public function setCodigoUsuarioAtiendeFk($codigoUsuarioAtiendeFk)
    {
        $this->codigoUsuarioAtiendeFk = $codigoUsuarioAtiendeFk;
    }

    /**
     * @return string
     */
    public function getCodigoTareaFk()
    {
        return $this->codigoTareaFk;
    }

    /**
     * @param string
     */
    public function setCodigoTareaFk($codigoTareaFk)
    {
        $this->codigoTareaFk = $codigoTareaFk;
	    return $this;
    }

    /**
     * @return string
     */
    public function getCodigoUsuarioSolucionaFk()
    {
        return $this->codigoUsuarioSolucionaFk;
    }

    /**
     * @param string
     */
    public function setCodigoUsuarioSolucionaFk($codigoUsuarioSolucionaFk)
    {
        $this->codigoUsuarioSolucionaFk = $codigoUsuarioSolucionaFk;
	    return $this;
    }

    /**
     * @return bool
     */
    public function getEstadoAtendido()
    {
        return $this->estadoAtendido;
    }

    /**
     * @param bool
     */
    public function setEstadoAtendido( $estadoAtendido)
    {
        $this->estadoAtendido = $estadoAtendido;
	    return $this;
    }

    /**
     * @return bool
     */
    public function getEstadoSolicitudInformacion()
    {
        return $this->estadoSolicitudInformacion;
    }

    /**
     * @param bool
     */
    public function setEstadoSolicitudInformacion($estadoSolicitudInformacion)
    {
        $this->estadoSolicitudInformacion = $estadoSolicitudInformacion;
	    return $this;
    }

    /**
     * @return bool
     */
    public function getEstadoRespuestaSolicitudInformacion()
    {
        return $this->estadoRespuestaSolicitudInformacion;
    }

    /**
     * @param bool
     */
    public function setEstadoRespuestaSolicitudInformacion(bool $estadoRespuestaSolicitudInformacion)
    {
        $this->estadoRespuestaSolicitudInformacion = $estadoRespuestaSolicitudInformacion;
	    return $this;
    }

    /**
     * @return text
     */
    public function getSolicitudInformacion()
    {
        return $this->solicitudInformacion;
    }

    /**
     * @param text
     */
    public function setSolicitudInformacion($solicitudInformacion)
    {
        $this->solicitudInformacion = $solicitudInformacion;

        return $this;
    }

    /**
     * @return text
     */
    public function getRespuestaSolicitudInformacion()
    {
        return $this->respuestaSolicitudInformacion;
    }

    /**
     * @param text
     */
    public function setRespuestaSolicitudInformacion($respuestaSolicitudInformacion)
    {
        $this->respuestaSolicitudInformacion = $respuestaSolicitudInformacion;
	    return $this;
    }

    /**
     * @return bool
     */
    public function getEstadoEscalado()
    {
        return $this->estadoEscalado;
    }

    /**
     * @param bool
     */
    public function setEstadoEscalado( $estadoEscalado)
    {
        $this->estadoEscalado = $estadoEscalado;
        return $this;
    }

    /**
     * @return bool
     */
    public function getEstadoReabierto()
    {
        return $this->estadoReabierto;
    }

    /**
     * @param bool
     */
    public function setEstadoReabierto( $estadoReabierto)
    {
        $this->estadoReabierto = $estadoReabierto;
	    return $this;
    }

    /**
     * @return bool
     */
    public function getEstadoSolucionado()
    {
        return $this->estadoSolucionado;
    }

    /**
     * @param bool
     */
    public function setEstadoSolucionado($estadoSolucionado)
    {
        $this->estadoSolucionado = $estadoSolucionado;
	    return $this;
    }

    /**
     * @return int
     */
    public function getCodigoClienteFk()
    {
        return $this->codigoClienteFk;
    }

    /**
     * @param int
     */
    public function setCodigoClienteFk($codigoClienteFk)
    {
        $this->codigoClienteFk = $codigoClienteFk;
	    return $this;
    }

    /**
     * @return mixed
     */
    public function getClienteRel()
    {
        return $this->clienteRel;
    }

    /**
     * @param mixed
     */
    public function setClienteRel($clienteRel)
    {
        $this->clienteRel = $clienteRel;
	    return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoriaRel()
    {
        return $this->categoriaRel;
    }

    /**
     * @param mixed
     */
    public function setCategoriaRel($categoriaRel)
    {
        $this->categoriaRel = $categoriaRel;
	    return $this;
    }

    /**
     * @return mixed
     */
    public function getCargoRel()
    {
        return $this->cargoRel;
    }

    /**
     * @param mixed
     */
    public function setCargoRel($cargoRel)
    {
        $this->cargoRel = $cargoRel;
	    return $this;
    }

    /**
     * @return mixed
     */
    public function getAreaRel()
    {
        return $this->areaRel;
    }

    /**
     * @param mixed
     */
    public function setAreaRel($areaRel)
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
    public function getTareasCasoRel()
    {
        return $this->tareasCasoRel;
    }

    /**
     * @param mixed
     */
    public function setTareasCasoRel($tareasCasoRel)
    {
        $this->tareasCasoRel = $tareasCasoRel;
	    return $this;
    }

    /**
     * @return mixed
     */
    public function getCasosComentarioRel()
    {
        return $this->casosComentarioRel;
    }

    /**
     * @param mixed
     */
    public function setCasosComentarioRel($casosComentarioRel)
    {
        $this->casosComentarioRel = $casosComentarioRel;
	    return $this;
    }

    /**
     * @return mixed
     */
    public function getEstadoTarea()
    {
        return $this->estadoTarea;
    }

    /**
     * @param mixed $estadoTarea
     */
    public function setEstadoTarea($estadoTarea): void
    {
        $this->estadoTarea = $estadoTarea;
    }

    /**
     * @return mixed
     */
    public function getEstadoTareaTerminada()
    {
        return $this->estadoTareaTerminada;
    }

    /**
     * @param mixed $estadoTareaTerminada
     */
    public function setEstadoTareaTerminada($estadoTareaTerminada): void
    {
        $this->estadoTareaTerminada = $estadoTareaTerminada;
    }

    /**
     * @return mixed
     */
    public function getEstadoTareaRevisada()
    {
        return $this->estadoTareaRevisada;
    }

    /**
     * @param mixed $estadoTareaRevisada
     */
    public function setEstadoTareaRevisada($estadoTareaRevisada): void
    {
        $this->estadoTareaRevisada = $estadoTareaRevisada;
    }


}
