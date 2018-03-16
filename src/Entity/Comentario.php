<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComentarioRepository")
 */
class Comentario
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_comentario_pk", type="integer", unique=true)
     */
    private $codigoComentarioPk;

	/**
	 * @var dateTime
	 *
	 * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
	 */
	private $fechaRegistro;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="comentario", type="string", length=500, nullable=true)
	 */
	private $comentario;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="codigo_ususario_fk", type="string", length=50, nullable=true)
	 */
	private $codigoUsuarioFk;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="codigo_caso_fk", type="integer",  nullable=true)
	 */
	private $codigoCasoFk;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="codigo_tarea_fk", type="integer", nullable=true)
	 */
	private $codigoTareaFk;

    /**
     * @ORM\Column(name="cliente", type="boolean", nullable= true)
     */
    private $cliente;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Caso", inversedBy="casosComentarioRel")
	 * @ORM\JoinColumn(name="codigo_caso_fk", referencedColumnName="codigo_caso_pk")
	 */
	private $casoRel;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Tarea", inversedBy="tareasComentarioRel")
	 * @ORM\JoinColumn(name="codigo_tarea_fk", referencedColumnName="codigo_tarea_pk")
	 */
	private $tareaRel;

    /**
     * @return int
     */
    public function getCodigoComentarioPk()
    {
        return $this->codigoComentarioPk;
    }

    /**
     * @param int
     */
    public function setCodigoComentarioPk($codigoComentarioPk)
    {
        $this->codigoComentarioPk = $codigoComentarioPk;
	    return $this;
    }

    /**
     * @return dateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * @param dateTime
     */
    public function setFechaRegistro( $fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
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
	    return $this;
    }

    /**
     * @return string
     */
    public function getCodigoUsuarioFk()
    {
        return $this->codigoUsuarioFk;
    }

    /**
     * @param string
     */
    public function setCodigoUsuarioFk($codigoUsuarioFk)
    {
        $this->codigoUsuarioFk = $codigoUsuarioFk;
    }

    /**
     * @return int
     */
    public function getCodigoCasoFk()
    {
        return $this->codigoCasoFk;
    }

    /**
     * @param int
     */
    public function setCodigoCasoFk($codigoCasoFk)
    {
        $this->codigoCasoFk = $codigoCasoFk;
	    return $this;
    }

    /**
     * @return int
     */
    public function getCodigoTareaFk()
    {
        return $this->codigoTareaFk;
    }

    /**
     * @param int
     */
    public function setCodigoTareaFk($codigoTareaFk)
    {
        $this->codigoTareaFk = $codigoTareaFk;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
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
    public function getTareaRel()
    {
        return $this->tareaRel;
    }

    /**
     * @param mixed
     */
    public function setTareaRel($tareaRel)
    {
        $this->tareaRel = $tareaRel;
	    return $this;
    }



}
