<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 */
class Usuarios
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", length=400, nullable=false)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=400, nullable=false)
     */
    private $apellidos;

    /**
     * @var int
     *
     * @ORM\Column(name="cedula", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=350, nullable=false)
     */
    private $correo;

    /**
     * @var int
     *
     * @ORM\Column(name="telefono", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $telefono;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(string $nombres): self
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCedula(): ?int
    {
        return $this->cedula;
    }

    public function setCedula(int $cedula): self
    {
        $this->cedula = $cedula;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }


}
