<?php

namespace Empresa\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa", indexes={@ORM\Index(name="Empresa_FKIndex1", columns={"Administrador_idAdministrador"}), @ORM\Index(name="Empresa_FKIndex2", columns={"Vaga_idVaga"})})
 * @ORM\Entity
 */
class Empresa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEmpresa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idempresa;

    /**
     * @var integer
     *
     * @ORM\Column(name="Vaga_idVaga", type="integer", nullable=false)
     */
    private $vagaIdvaga;

    /**
     * @var integer
     *
     * @ORM\Column(name="Administrador_idAdministrador", type="integer", nullable=false)
     */
    private $administradorIdadministrador;

    /**
     * @var string
     *
     * @ORM\Column(name="Empresa", type="string", length=50, nullable=true)
     */
    private $empresa;

    /**
     * @var integer
     *
     * @ORM\Column(name="Cnpj", type="integer", nullable=true)
     */
    private $cnpj;

    /**
     * @var integer
     *
     * @ORM\Column(name="Telefone", type="integer", nullable=true)
     */
    private $telefone;
    function getIdempresa() {
        return $this->idempresa;
    }

    function getVagaIdvaga() {
        return $this->vagaIdvaga;
    }

    function getAdministradorIdadministrador() {
        return $this->administradorIdadministrador;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function setIdempresa($idempresa) {
        $this->idempresa = $idempresa;
        return $this;
    }

    function setVagaIdvaga($vagaIdvaga) {
        $this->vagaIdvaga = $vagaIdvaga;
        return $this;
    }

    function setAdministradorIdadministrador($administradorIdadministrador) {
        $this->administradorIdadministrador = $administradorIdadministrador;
        return $this;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
        return $this;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
        return $this;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
        return $this;
    }



}

