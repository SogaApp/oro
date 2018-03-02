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
    private $estadoAtendido;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="estado_escalado", type="boolean" ,nullable= TRUE)
	 */
	private $estadoEscalado;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="estado_reabierto", type="boolean" ,nullable= TRUE)
	 */
	private $estadoReabierto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado_solucionado", type="boolean" ,nullable= TRUE)
     */
    private $estadoSolucionado;

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
	 */

	private $tareasCasoRel;


    /**
     * Get codigoCasoPk.
     *
     * @return int
     */
    public function getCodigoCasoPk()
    {
        return $this->codigoCasoPk;
    }

    /**
     * Set asunto.
     *
     * @param string $asunto
     *
     * @return Caso
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto.
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set correo.
     *
     * @param string $correo
     *
     * @return Caso
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo.
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set contacto.
     *
     * @param string $contacto
     *
     * @return Caso
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto.
     *
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set usuario.
     *
     * @param string|null $usuario
     *
     * @return Caso
     */
    public function setUsuario($usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario.
     *
     * @return string|null
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set telefono.
     *
     * @param string $telefono
     *
     * @return Caso
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set extension.
     *
     * @param string $extension
     *
     * @return Caso
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension.
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set descripcion.
     *
     * @param string $descripcion
     *
     * @return Caso
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion.
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set soporte.
     *
     * @param string|null $soporte
     *
     * @return Caso
     */
    public function setSoporte($soporte = null)
    {
        $this->soporte = $soporte;

        return $this;
    }

    /**
     * Get soporte.
     *
     * @return string|null
     */
    public function getSoporte()
    {
        return $this->soporte;
    }

    /**
     * Set solucion.
     *
     * @param string|null $solucion
     *
     * @return Caso
     */
    public function setSolucion($solucion = null)
    {
        $this->solucion = $solucion;

        return $this;
    }

    /**
     * Get solucion.
     *
     * @return string|null
     */
    public function getSolucion()
    {
        return $this->solucion;
    }

    /**
     * Set fechaRegistro.
     *
     * @param \DateTime|null $fechaRegistro
     *
     * @return Caso
     */
    public function setFechaRegistro($fechaRegistro = null)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro.
     *
     * @return \DateTime|null
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set fechaGestion.
     *
     * @param \DateTime|null $fechaGestion
     *
     * @return Caso
     */
    public function setFechaGestion($fechaGestion = null)
    {
        $this->fechaGestion = $fechaGestion;

        return $this;
    }

    /**
     * Get fechaGestion.
     *
     * @return \DateTime|null
     */
    public function getFechaGestion()
    {
        return $this->fechaGestion;
    }

    /**
     * Set fechaSolucion.
     *
     * @param \DateTime|null $fechaSolucion
     *
     * @return Caso
     */
    public function setFechaSolucion($fechaSolucion = null)
    {
        $this->fechaSolucion = $fechaSolucion;

        return $this;
    }

    /**
     * Get fechaSolucion.
     *
     * @return \DateTime|null
     */
    public function getFechaSolucion()
    {
        return $this->fechaSolucion;
    }

    /**
     * Set codigoCategoriaCasoFk.
     *
     * @param string $codigoCategoriaCasoFk
     *
     * @return Caso
     */
    public function setCodigoCategoriaCasoFk($codigoCategoriaCasoFk)
    {
        $this->codigoCategoriaCasoFk = $codigoCategoriaCasoFk;

        return $this;
    }

    /**
     * Get codigoCategoriaCasoFk.
     *
     * @return string
     */
    public function getCodigoCategoriaCasoFk()
    {
        return $this->codigoCategoriaCasoFk;
    }

    /**
     * Set codigoCargoFk.
     *
     * @param string|null $codigoCargoFk
     *
     * @return Caso
     */
    public function setCodigoCargoFk($codigoCargoFk = null)
    {
        $this->codigoCargoFk = $codigoCargoFk;

        return $this;
    }

    /**
     * Get codigoCargoFk.
     *
     * @return string|null
     */
    public function getCodigoCargoFk()
    {
        return $this->codigoCargoFk;
    }

    /**
     * Set codigoAreaFk.
     *
     * @param string|null $codigoAreaFk
     *
     * @return Caso
     */
    public function setCodigoAreaFk($codigoAreaFk = null)
    {
        $this->codigoAreaFk = $codigoAreaFk;

        return $this;
    }

    /**
     * Get codigoAreaFk.
     *
     * @return string|null
     */
    public function getCodigoAreaFk()
    {
        return $this->codigoAreaFk;
    }

    /**
     * Set codigoPrioridadFk.
     *
     * @param string|null $codigoPrioridadFk
     *
     * @return Caso
     */
    public function setCodigoPrioridadFk($codigoPrioridadFk = null)
    {
        $this->codigoPrioridadFk = $codigoPrioridadFk;

        return $this;
    }

    /**
     * Get codigoPrioridadFk.
     *
     * @return string|null
     */
    public function getCodigoPrioridadFk()
    {
        return $this->codigoPrioridadFk;
    }

    /**
     * Set codigoUsuarioAtiendeFk.
     *
     * @param string|null $codigoUsuarioAtiendeFk
     *
     * @return Caso
     */
    public function setCodigoUsuarioAtiendeFk($codigoUsuarioAtiendeFk = null)
    {
        $this->codigoUsuarioAtiendeFk = $codigoUsuarioAtiendeFk;

        return $this;
    }

    /**
     * Get codigoUsuarioAtiendeFk.
     *
     * @return string|null
     */
    public function getCodigoUsuarioAtiendeFk()
    {
        return $this->codigoUsuarioAtiendeFk;
    }

    /**
     * Set codigoUsuarioSolucionaFk.
     *
     * @param string|null $codigoUsuarioSolucionaFk
     *
     * @return Caso
     */
    public function setCodigoUsuarioSolucionaFk($codigoUsuarioSolucionaFk = null)
    {
        $this->codigoUsuarioSolucionaFk = $codigoUsuarioSolucionaFk;

        return $this;
    }

    /**
     * Get codigoUsuarioSolucionaFk.
     *
     * @return string|null
     */
    public function getCodigoUsuarioSolucionaFk()
    {
        return $this->codigoUsuarioSolucionaFk;
    }

    /**
     * Set estadoAtendido.
     *
     * @param bool|null $estadoAtendido
     *
     * @return Caso
     */
    public function setEstadoAtendido($estadoAtendido = null)
    {
        $this->estadoAtendido = $estadoAtendido;

        return $this;
    }

    /**
     * Get estadoAtendido.
     *
     * @return bool|null
     */
    public function getEstadoAtendido()
    {
        return $this->estadoAtendido;
    }

    /**
     * Set estadoSolucionado.
     *
     * @param bool|null $estadoSolucionado
     *
     * @return Caso
     */
    public function setEstadoSolucionado($estadoSolucionado = null)
    {
        $this->estadoSolucionado = $estadoSolucionado;

        return $this;
    }



	/**
	 * Get estadoSolucionado.
	 *
	 * @return bool|null
	 */
	public function getEstadoSolucionado()
	{
		return $this->estadoSolucionado;
	}

    /**
     * Set codigoClienteFk.
     *
     * @param int|null $codigoClienteFk
     *
     * @return Caso
     */
    public function setCodigoClienteFk($codigoClienteFk = null)
    {
        $this->codigoClienteFk = $codigoClienteFk;

        return $this;
    }

    /**
     * Get codigoClienteFk.
     *
     * @return int|null
     */
    public function getCodigoClienteFk()
    {
        return $this->codigoClienteFk;
    }

    /**
     * Set clienteRel.
     *
     * @param \App\Entity\Cliente|null $clienteRel
     *
     * @return Caso
     */
    public function setClienteRel(\App\Entity\Cliente $clienteRel = null)
    {
        $this->clienteRel = $clienteRel;

        return $this;
    }

    /**
     * Get clienteRel.
     *
     * @return \App\Entity\Cliente|null
     */
    public function getClienteRel()
    {
        return $this->clienteRel;
    }

    /**
     * Set categoriaRel.
     *
     * @param \App\Entity\CasoCategoria|null $categoriaRel
     *
     * @return Caso
     */
    public function setCategoriaRel(\App\Entity\CasoCategoria $categoriaRel = null)
    {
        $this->categoriaRel = $categoriaRel;

        return $this;
    }

    /**
     * Get categoriaRel.
     *
     * @return \App\Entity\CasoCategoria|null
     */
    public function getCategoriaRel()
    {
        return $this->categoriaRel;
    }

    /**
     * Set cargoRel.
     *
     * @param \App\Entity\Cargo|null $cargoRel
     *
     * @return Caso
     */
    public function setCargoRel(\App\Entity\Cargo $cargoRel = null)
    {
        $this->cargoRel = $cargoRel;

        return $this;
    }

    /**
     * Get cargoRel.
     *
     * @return \App\Entity\Cargo|null
     */
    public function getCargoRel()
    {
        return $this->cargoRel;
    }

    /**
     * Set areaRel.
     *
     * @param \App\Entity\Area|null $areaRel
     *
     * @return Caso
     */
    public function setAreaRel(\App\Entity\Area $areaRel = null)
    {
        $this->areaRel = $areaRel;

        return $this;
    }

    /**
     * Get areaRel.
     *
     * @return \App\Entity\Area|null
     */
    public function getAreaRel()
    {
        return $this->areaRel;
    }

    /**
     * Set prioridadRel.
     *
     * @param \App\Entity\Prioridad|null $prioridadRel
     *
     * @return Caso
     */
    public function setPrioridadRel(\App\Entity\Prioridad $prioridadRel = null)
    {
        $this->prioridadRel = $prioridadRel;

        return $this;
    }

    /**
     * Get prioridadRel.
     *
     * @return \App\Entity\Prioridad|null
     */
    public function getPrioridadRel()
    {
        return $this->prioridadRel;
    }

	/**
	 * @return string
	 */
	public function getCodigoTareaFk(): string {
		return $this->codigoTareaFk;
	}

	/**
	 * @param string $codigoTareaFk
	 */
	public function setCodigoTareaFk( string $codigoTareaFk ): void {
		$this->codigoTareaFk = $codigoTareaFk;
	}

	/**
	 * @return mixed
	 */
	public function getTareaRel() {
		return $this->tareaRel;
	}

	/**
	 * @param mixed $tareaRel
	 */
	public function setTareaRel( $tareaRel ): void {
		$this->tareaRel = $tareaRel;
	}

	/**
	 * @return mixed
	 */
	public function getTareasCasoRel() {
		return $this->tareasCasoRel;
	}

	/**
	 * @param mixed $tareasCasoRel
	 */
	public function setTareasCasoRel( $tareasCasoRel ): void {
		$this->tareasCasoRel = $tareasCasoRel;
	}

	/**
	 * Get estadoReabierto.
	 *
	 * @return bool|null
	 */
	public function getEstadoReabierto()
	{
		return $this->estadoReabierto;
	}

	/**
	 * Set estadoReabierto.
	 *
	 * @param bool|null $estadoReabierto
	 *
	 * @return Caso
	 */
	public function setEstadoReabierto($estadoReabierto )
	{
		$this->estadoReabierto = $estadoReabierto;

		return $this;
	}

	/**
	 * Get estadoEscalado
	 *
	 * @return bool|null
	 */
	public function getEstadoEscalado()
	{
		return $this->estadoEscalado;
	}

	/**
	 * Set estadoEscalado.
	 *
	 * @param bool|null $estadoEscalado
	 *
	 * @return Caso
	 */
	public function setEstadoEscalado($estadoEscalado)
	{
		$this->estadoEscalado = $estadoEscalado;

		return $this;
	}


}
