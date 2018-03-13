<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComentarioRepository")
 */
class Comentario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $codigoComentarioPk;

	/**
	 * @var dateTime
	 *
	 * @ORM\Column(name="fecha_registro", type="datetime", length=30, nullable=true)
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
     * @return mixed
     */
    public function getCodigoComentarioPk()
    {
        return $this->codigoComentarioPk;
    }

    /**
     * @param mixed $codigoComentarioPk
     */
    public function setCodigoComentarioPk($codigoComentarioPk): void
    {
        $this->codigoComentarioPk = $codigoComentarioPk;
    }

    /**
     * @return dateTime
     */
    public function getFechaRegistro(): dateTime
    {
        return $this->fechaRegistro;
    }

    /**
     * @param dateTime $fechaRegistro
     */
    public function setFechaRegistro(dateTime $fechaRegistro): void
    {
        $this->fechaRegistro = $fechaRegistro;
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
    public function getCodigoUsuarioFk(): string
    {
        return $this->codigoUsuarioFk;
    }

    /**
     * @param string $codigoUsuarioFk
     */
    public function setCodigoUsuarioFk(string $codigoUsuarioFk): void
    {
        $this->codigoUsuarioFk = $codigoUsuarioFk;
    }

    /**
     * @return int
     */
    public function getCodigoCasoFk(): int
    {
        return $this->codigoCasoFk;
    }

    /**
     * @param int $codigoCasoFk
     */
    public function setCodigoCasoFk(int $codigoCasoFk): void
    {
        $this->codigoCasoFk = $codigoCasoFk;
    }

    /**
     * @return int
     */
    public function getCodigoTareaFk(): int
    {
        return $this->codigoTareaFk;
    }

    /**
     * @param int $codigoTareaFk
     */
    public function setCodigoTareaFk(int $codigoTareaFk): void
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
     * @param mixed $cliente
     */
    public function setCliente($cliente): void
    {
        $this->cliente = $cliente;
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
    public function getTareaRel()
    {
        return $this->tareaRel;
    }

    /**
     * @param mixed $tareaRel
     */
    public function setTareaRel($tareaRel): void
    {
        $this->tareaRel = $tareaRel;
    }


}
