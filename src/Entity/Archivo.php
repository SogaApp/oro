<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* Caso
*
* @ORM\Table(name="archivo")
* @ORM\Entity(repositoryClass="App\Repository\ArchivoRepository")
*/
class Archivo
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="codigo_archivo_pk", type="integer", unique=true)
     */
    private $codigoArchivoPk;

    /**
     * @ORM\Column(name="codigo_documento_fk", type="integer", nullable=true)
     */
    private $codigoDocumentoFk;

    /**
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero = 0;

    /**
     * @ORM\Column(name="fecha_hasta", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(name="nombre", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(name="extensionOriginal", type="string", length=250, nullable=true)
     */
    private $extensionOriginal;

    /**
     * @ORM\Column(name="tipo", type="string", length=250, nullable=true)
     */
    private $tipo;

    /**
     * @ORM\Column(name="tamano", type="float", nullable=true)
     */
    private $tamano = 0;

    /**
     * @ORM\Column(name="descripcion", type="string", length=1000, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(name="comentario", type="string", length=1000, nullable=true)
     */
    private $comentario;

    /**
     * @return int
     */
    public function getCodigoArchivoPk(): int
    {
        return $this->codigoArchivoPk;
    }

    /**
     * @param int $codigoArchivoPk
     */
    public function setCodigoArchivoPk(int $codigoArchivoPk): void
    {
        $this->codigoArchivoPk = $codigoArchivoPk;
    }

    /**
     * @return mixed
     */
    public function getCodigoDocumentoFk()
    {
        return $this->codigoDocumentoFk;
    }

    /**
     * @param mixed $codigoDocumentoFk
     */
    public function setCodigoDocumentoFk($codigoDocumentoFk): void
    {
        $this->codigoDocumentoFk = $codigoDocumentoFk;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero): void
    {
        $this->numero = $numero;
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getExtensionOriginal()
    {
        return $this->extensionOriginal;
    }

    /**
     * @param mixed $extensionOriginal
     */
    public function setExtensionOriginal($extensionOriginal): void
    {
        $this->extensionOriginal = $extensionOriginal;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getTamano()
    {
        return $this->tamano;
    }

    /**
     * @param mixed $tamano
     */
    public function setTamano($tamano): void
    {
        $this->tamano = $tamano;
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
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @param mixed $comentario
     */
    public function setComentario($comentario): void
    {
        $this->comentario = $comentario;
    }



}
