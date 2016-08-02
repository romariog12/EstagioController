<?php

namespace Vaga\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vaga
 *
 * @ORM\Table(name="vaga", indexes={@ORM\Index(name="Vaga_FKIndex1", columns={"Administrador_idAdministrador"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Vaga\Entity\VagaRepository")
 */
class Vaga
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idVaga", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvaga;

    /**
     * @var integer
     *
     * @ORM\Column(name="Administrador_idAdministrador", type="integer", nullable=false)
     */
    private $administradorIdadministrador;

    /**
     * @var integer
     *
     * @ORM\Column(name="idAluno_Vaga", type="integer", length=254, nullable=true)
     */
    private $idalunovaga;
      
    /**
     * @var string
     *
     * @ORM\Column(name="Empresa", type="string", length=50, nullable=true)
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="Agente", type="string", length=50, nullable=true)
     */
    private $agente;

    /**
     * @var integer
     *
     * @ORM\Column(name="Carga", type="integer", nullable=true)
     */
    private $carga;

    /**
     * @var integer
     *
     * @ORM\Column(name="Bolsa", type="integer", nullable=true)
     */
    private $bolsa;
    /**
     * @var string
     *
     * @ORM\Column(name="Recisao", type="string", nullable=true)
     */
    private $recisao;
    function getIdvaga() {
        return $this->idvaga;
    }

    function getAdministradorIdadministrador() {
        return $this->administradorIdadministrador;
    }

    function getIdalunovaga() {
        return $this->idalunovaga;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getAgente() {
        return $this->agente;
    }

    function getCarga() {
        return $this->carga;
    }

    function getBolsa() {
        return $this->bolsa;
    }

    function getRecisao() {
        return $this->recisao;
    }

    function setIdvaga($idvaga) {
        $this->idvaga = $idvaga;
        return $this;
    }

    function setAdministradorIdadministrador($administradorIdadministrador) {
        $this->administradorIdadministrador = $administradorIdadministrador;
        return $this;
    }

    function setIdalunovaga($idalunovaga) {
        $this->idalunovaga = $idalunovaga;
        return $this;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
        return $this;
    }

    function setAgente($agente) {
        $this->agente = $agente;
        return $this;
    }

    function setCarga($carga) {
        $this->carga = $carga;
        return $this;
    }

    function setBolsa($bolsa) {
        $this->bolsa = $bolsa;
        return $this;
    }

    function setRecisao($recisao) {
        $this->recisao = $recisao;
        return $this;
    }


    
}