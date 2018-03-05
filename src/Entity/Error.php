<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ErrorRepository")
 */
class Error
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="cliente", type="string", length=255, nullable=true)
     */
    private $cliente;

    /**
     * @var string
     * @ORM\Column(name="mensaje", type="text", nullable=true)
     */
    private $mensaje;

    /**
     * @var integer
     * @ORM\Column(name="codigo", type="integer", nullable=true)
     */
    private $codigo;

    /**
     * @var string
     * @ORM\Column(name="ruta", type="string", length=500, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     * @ORM\Column(name="archivo", type="string", length=500, nullable=true)
     */
    private $archivo;

    /**
     * @var string
     * @ORM\Column(name="traza", type="text", nullable=true)
     */
    private $traza;

    /**
     * @var \DateTime
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     * @ORM\Column(name="url", type="text", nullable=true)
     */
    private $url;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param string $cliente
     */
    public function setCliente(string $cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }

    /**
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @param string $mensaje
     */
    public function setMensaje(string $mensaje)
    {
        $this->mensaje = $mensaje;
        return $this;
    }

    /**
     * @return int
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param int $codigo
     */
    public function setCodigo(int $codigo)
    {
        $this->codigo = $codigo;
        return $this;
    }

    /**
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * @param string $ruta
     */
    public function setRuta(string $ruta)
    {
        $this->ruta = $ruta;
        return $this;
    }

    /**
     * @return string
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * @param string $archivo
     */
    public function setArchivo(string $archivo)
    {
        $this->archivo = $archivo;
        return $this;
    }

    /**
     * @return string
     */
    public function getTraza()
    {
        return $this->traza;
    }

    /**
     * @param string $traza
     */
    public function setTraza(string $traza)
    {
        $this->traza = $traza;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha(\DateTime $fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }


}
