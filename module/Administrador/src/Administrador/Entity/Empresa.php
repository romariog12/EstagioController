<?php

namespace Administrador\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa", indexes={@ORM\Index(name="Empresa_FKIndex1", columns={"Administrador_idAdministrador"}), @ORM\Index(name="Empresa_FKIndex2", columns={"Vaga_idVaga"})})
 * @ORM\Entity(repositoryClass="Administrador\Entity\EmpresaRepository")
 * 
 */
class Empresa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEmpresa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
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
     * 
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="Cnpj", type="string" ,  length=50, nullable=true)
     */
    private $cnpj;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefone", type="string",  length=50, nullable=true)
     * 
     */
    private $telefone;
     /**
     * @var string
     *
     * @ORM\Column(name="Endereco", type="string", length=50, nullable=true)
     * 
     */
    private $endereco;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Responsavel", type="string",length=50, nullable=true)
     */
    private $responsavel;
     /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string",length=50, nullable=true)
     */
    private $email;
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
    function getEndereco() {
        return $this->endereco;
    }

    function getResponsavel() {
        return $this->responsavel;
    }

    function getEmail() {
        return $this->email;
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

    function setEndereco($endereco) {
        $this->endereco = $endereco;
        return $this;
    }

    function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }



}

