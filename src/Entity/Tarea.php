<?php
/**
 * Created by Juan David Marulanda V.
 * User: @ju4nr3v0l
 * appSoga developers Team.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(name="codigo_usuario_registra_fk", type="string", length=50)
     */
    private $codigoUsuarioRegistraFk;

    /**
     * @ORM\Column(name="codigo_prioridad_fk", type="string", length=50, nullable=true)
     */
    private $codigoPrioridadFk;

    /**
     * @ORM\Column(name="codigo_tarea_tipo_fk", type="string", length=50, nullable=true)
     */
    private $codigoTareaTipoFk;

    /**
     * @ORM\Column(name="fecha_ejecucion", type="datetime", nullable=true)
     */
    private $fechaEjecucion;

    /**
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @ORM\Column(name="fecha_verificado", type="datetime", nullable=true)
     */
    private $fechaVerificado;

    /**
     * @ORM\Column(name="estado_ejecucion", type="boolean", nullable=true)
     */
    private $estadoEjecucion = false;

    /**
     * @ORM\Column(name="estado_terminado", type="boolean", nullable=true)
     */
    private $estadoTerminado = false;

    /**
     * @ORM\Column(name="estado_verificado", type="boolean", nullable=true)
     */
    private $estadoVerificado = false;

    /**
     * @ORM\Column(name="codigo_usuario_asigna_fk", type="string", length=50, nullable=true)
     */
    private $codigoUsuarioAsignaFk;

    /**
     * @ORM\Column(name="codigo_caso_fk", type="integer", length=50, nullable=true)
     */
    private $codigoCasoFk;

    /**
     * @ORM\Column(name="fecha_gestion", type="datetime", nullable=true)
     */
    private $fechaGestion;

    /**
     * @ORM\Column(name="fecha_solucion", type="datetime", nullable=true)
     */
    private $fechaSolucion;

    /**
     * @ORM\Column(name="descripcion", type="string", length=5000, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(name="comentario", type="string", length=5000, nullable=true)
     */
    private $comentario;

    /**
     * @ORM\Column(name="caso", type="string", length=10, nullable=true)
     */
    private $caso;

    /**
     * @ORM\Column(name="estado_incomprensible", type="boolean", nullable=true)
     */
    private $estadoIncomprensible = false;

    /**
     * @ORM\Column(name="estado_pausa", type="boolean", nullable=true)
     */
    private $estadoPausa = false;

    /**
     * @ORM\Column(name="codigo_tarea_tiempo_fk", type="integer", nullable=true)
     */
    private $codigoTareaTiempoFk;

    /**
     * @ORM\Column(name="numero_devoluciones", type="integer", nullable=true)
     */
    private $numeroDevoluciones = 0;


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
     * @ORM\ManyToOne(targetEntity="TareaTiempo", inversedBy="tareasTareaTiempoRel")
     * @ORM\JoinColumn(name="codigo_tarea_tiempo_fk", referencedColumnName="codigo_tarea_tiempo_pk")
     */
    private $tareaTiempoRel;

    /**
     * @ORM\OneToMany(targetEntity="TareaDevolucion", mappedBy="devolucionRel")
     */
    private $tareasDevolucionRel;


    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="tareaRel")
     */
    private $usuariosTareaRel;


    /**
     * @ORM\OneToMany(targetEntity="Comentario", mappedBy="tareaRel")
     */
    private $tareasComentarioRel;



    public function __construct()
    {
        $this->tareasDevolucionRel = new ArrayCollection();
        $this->usuariosTareaRel = new ArrayCollection();
        $this->tareasComentarioRel = new ArrayCollection();
    }

    public function getCodigoTareaPk(): ?int
    {
        return $this->codigoTareaPk;
    }

    public function getCodigoUsuarioRegistraFk(): ?string
    {
        return $this->codigoUsuarioRegistraFk;
    }

    public function setCodigoUsuarioRegistraFk(string $codigoUsuarioRegistraFk): self
    {
        $this->codigoUsuarioRegistraFk = $codigoUsuarioRegistraFk;

        return $this;
    }

    public function getCodigoPrioridadFk(): ?string
    {
        return $this->codigoPrioridadFk;
    }

    public function setCodigoPrioridadFk(?string $codigoPrioridadFk): self
    {
        $this->codigoPrioridadFk = $codigoPrioridadFk;

        return $this;
    }

    public function getCodigoTareaTipoFk(): ?string
    {
        return $this->codigoTareaTipoFk;
    }

    public function setCodigoTareaTipoFk(?string $codigoTareaTipoFk): self
    {
        $this->codigoTareaTipoFk = $codigoTareaTipoFk;

        return $this;
    }

    public function getFechaEjecucion(): ?\DateTimeInterface
    {
        return $this->fechaEjecucion;
    }

    public function setFechaEjecucion(?\DateTimeInterface $fechaEjecucion): self
    {
        $this->fechaEjecucion = $fechaEjecucion;

        return $this;
    }

    public function getFechaRegistro(): ?\DateTimeInterface
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(?\DateTimeInterface $fechaRegistro): self
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    public function getFechaVerificado(): ?\DateTimeInterface
    {
        return $this->fechaVerificado;
    }

    public function setFechaVerificado(?\DateTimeInterface $fechaVerificado): self
    {
        $this->fechaVerificado = $fechaVerificado;

        return $this;
    }

    public function getEstadoEjecucion(): ?bool
    {
        return $this->estadoEjecucion;
    }

    public function setEstadoEjecucion(?bool $estadoEjecucion): self
    {
        $this->estadoEjecucion = $estadoEjecucion;

        return $this;
    }

    public function getEstadoTerminado(): ?bool
    {
        return $this->estadoTerminado;
    }

    public function setEstadoTerminado(?bool $estadoTerminado): self
    {
        $this->estadoTerminado = $estadoTerminado;

        return $this;
    }

    public function getEstadoVerificado(): ?bool
    {
        return $this->estadoVerificado;
    }

    public function setEstadoVerificado(?bool $estadoVerificado): self
    {
        $this->estadoVerificado = $estadoVerificado;

        return $this;
    }

    public function getCodigoUsuarioAsignaFk(): ?string
    {
        return $this->codigoUsuarioAsignaFk;
    }

    public function setCodigoUsuarioAsignaFk(?string $codigoUsuarioAsignaFk): self
    {
        $this->codigoUsuarioAsignaFk = $codigoUsuarioAsignaFk;

        return $this;
    }

    public function getCodigoCasoFk(): ?int
    {
        return $this->codigoCasoFk;
    }

    public function setCodigoCasoFk(?int $codigoCasoFk): self
    {
        $this->codigoCasoFk = $codigoCasoFk;

        return $this;
    }

    public function getFechaGestion(): ?\DateTimeInterface
    {
        return $this->fechaGestion;
    }

    public function setFechaGestion(?\DateTimeInterface $fechaGestion): self
    {
        $this->fechaGestion = $fechaGestion;

        return $this;
    }

    public function getFechaSolucion(): ?\DateTimeInterface
    {
        return $this->fechaSolucion;
    }

    public function setFechaSolucion(?\DateTimeInterface $fechaSolucion): self
    {
        $this->fechaSolucion = $fechaSolucion;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(?string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getCaso(): ?string
    {
        return $this->caso;
    }

    public function setCaso(?string $caso): self
    {
        $this->caso = $caso;

        return $this;
    }

    public function getEstadoIncomprensible(): ?bool
    {
        return $this->estadoIncomprensible;
    }

    public function setEstadoIncomprensible(?bool $estadoIncomprensible): self
    {
        $this->estadoIncomprensible = $estadoIncomprensible;

        return $this;
    }

    public function getEstadoPausa(): ?bool
    {
        return $this->estadoPausa;
    }

    public function setEstadoPausa(?bool $estadoPausa): self
    {
        $this->estadoPausa = $estadoPausa;

        return $this;
    }

    public function getCodigoTareaTiempoFk(): ?int
    {
        return $this->codigoTareaTiempoFk;
    }

    public function setCodigoTareaTiempoFk(?int $codigoTareaTiempoFk): self
    {
        $this->codigoTareaTiempoFk = $codigoTareaTiempoFk;

        return $this;
    }

    public function getNumeroDevoluciones(): ?int
    {
        return $this->numeroDevoluciones;
    }

    public function setNumeroDevoluciones(?int $numeroDevoluciones): self
    {
        $this->numeroDevoluciones = $numeroDevoluciones;

        return $this;
    }

    public function getTareaTipoRel(): ?TareaTipo
    {
        return $this->tareaTipoRel;
    }

    public function setTareaTipoRel(?TareaTipo $tareaTipoRel): self
    {
        $this->tareaTipoRel = $tareaTipoRel;

        return $this;
    }

    public function getPrioridadRel(): ?Prioridad
    {
        return $this->prioridadRel;
    }

    public function setPrioridadRel(?Prioridad $prioridadRel): self
    {
        $this->prioridadRel = $prioridadRel;

        return $this;
    }

    public function getCasoRel(): ?Caso
    {
        return $this->casoRel;
    }

    public function setCasoRel(?Caso $casoRel): self
    {
        $this->casoRel = $casoRel;

        return $this;
    }

    public function getTareaTiempoRel(): ?TareaTiempo
    {
        return $this->tareaTiempoRel;
    }

    public function setTareaTiempoRel(?TareaTiempo $tareaTiempoRel): self
    {
        $this->tareaTiempoRel = $tareaTiempoRel;

        return $this;
    }

    /**
     * @return Collection|TareaDevolucion[]
     */
    public function getTareasDevolucionRel(): Collection
    {
        return $this->tareasDevolucionRel;
    }

    public function addTareasDevolucionRel(TareaDevolucion $tareasDevolucionRel): self
    {
        if (!$this->tareasDevolucionRel->contains($tareasDevolucionRel)) {
            $this->tareasDevolucionRel[] = $tareasDevolucionRel;
            $tareasDevolucionRel->setDevolucionRel($this);
        }

        return $this;
    }

    public function removeTareasDevolucionRel(TareaDevolucion $tareasDevolucionRel): self
    {
        if ($this->tareasDevolucionRel->contains($tareasDevolucionRel)) {
            $this->tareasDevolucionRel->removeElement($tareasDevolucionRel);
            // set the owning side to null (unless already changed)
            if ($tareasDevolucionRel->getDevolucionRel() === $this) {
                $tareasDevolucionRel->setDevolucionRel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Usuario[]
     */
    public function getUsuariosTareaRel(): Collection
    {
        return $this->usuariosTareaRel;
    }

    public function addUsuariosTareaRel(Usuario $usuariosTareaRel): self
    {
        if (!$this->usuariosTareaRel->contains($usuariosTareaRel)) {
            $this->usuariosTareaRel[] = $usuariosTareaRel;
            $usuariosTareaRel->setTareaRel($this);
        }

        return $this;
    }

    public function removeUsuariosTareaRel(Usuario $usuariosTareaRel): self
    {
        if ($this->usuariosTareaRel->contains($usuariosTareaRel)) {
            $this->usuariosTareaRel->removeElement($usuariosTareaRel);
            // set the owning side to null (unless already changed)
            if ($usuariosTareaRel->getTareaRel() === $this) {
                $usuariosTareaRel->setTareaRel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getTareasComentarioRel(): Collection
    {
        return $this->tareasComentarioRel;
    }

    public function addTareasComentarioRel(Comentario $tareasComentarioRel): self
    {
        if (!$this->tareasComentarioRel->contains($tareasComentarioRel)) {
            $this->tareasComentarioRel[] = $tareasComentarioRel;
            $tareasComentarioRel->setTareaRel($this);
        }

        return $this;
    }

    public function removeTareasComentarioRel(Comentario $tareasComentarioRel): self
    {
        if ($this->tareasComentarioRel->contains($tareasComentarioRel)) {
            $this->tareasComentarioRel->removeElement($tareasComentarioRel);
            // set the owning side to null (unless already changed)
            if ($tareasComentarioRel->getTareaRel() === $this) {
                $tareasComentarioRel->setTareaRel(null);
            }
        }

        return $this;
    }




}
