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
	private $fechaCreacion;

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
	public function getCodigoComentarioPk() {
		return $this->codigoComentarioPk;
	}

	/**
	 * @param mixed $codigoComentarioPk
	 */
	public function setCodigoComentarioPk( $codigoComentarioPk ) {
		$this->codigoComentarioPk = $codigoComentarioPk;
		return $this;
	}

	/**
	 * @return dateTime
	 */
	public function getFechaCreacion(){
		return $this->fechaCreacion;
	}

	/**
	 * @param dateTime $fechaCreacion
	 */
	public function setFechaCreacion( $fechaCreacion ){
		$this->fechaCreacion = $fechaCreacion;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getComentario() {
		return $this->comentario;
	}

	/**
	 * @param string $comentario
	 */
	public function setComentario( $comentario ){
		$this->comentario = $comentario;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCodigoUsuarioFk() {
		return $this->codigoUsuarioFk;
	}

	/**
	 * @param string $codigoUsuarioFk
	 */
	public function setCodigoUsuarioFk( $codigoUsuarioFk){
		$this->codigoUsuarioFk = $codigoUsuarioFk;
		return $this;
	}



	/**
	 * @return int
	 */
	public function getCodigoCasoFk() {
		return $this->codigoCasoFk;
	}

	/**
	 * @param int $codigoCasoFk
	 */
	public function setCodigoCasoFk( $codigoCasoFk ){
		$this->codigoCasoFk = $codigoCasoFk;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getCodigoTareaFk(){
		return $this->codigoTareaFk;
	}

	/**
	 * @param int $codigoTareaFk
	 */
	public function setCodigoTareaFk($codigoTareaFk ) {
		$this->codigoTareaFk = $codigoTareaFk;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCasoRel() {
		return $this->casoRel;
	}

	/**
	 * @param mixed $casoRel
	 */
	public function setCasoRel( $casoRel ){
		$this->casoRel = $casoRel;
		return $this;
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
	public function setTareaRel( $tareaRel ){
		$this->tareaRel = $tareaRel;
		return $this;
	}






}
