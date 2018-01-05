<?php

namespace Empresa\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agente
 *
 * @ORM\Table(name="agente")
 * @ORM\Entity
 * 
 */
class Agente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAgente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     */
    private $idagente;


    /**
     * @var string
     *
     * @ORM\Column(name="Agente", type="string", length=50, nullable=true)
     * 
     */
    private $agente;

    /**
     * @var string
     *
     * @ORM\Column(name="Cnpj", type="string",length=50, nullable=true)
     */
    private $cnpj;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefone", type="string",length=50, nullable=true)
     */
    private $telefone;
     /**
     * @var string
     *
     * @ORM\Column(name="Endereco", type="string",length=100, nullable=true)
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
    
    function getIdagente() {
        return $this->idagente;
    }

    function getAgente() {
        return $this->agente;
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

            function setIdagente($idagente) {
        $this->idagente = $idagente;
        return $this;
    }


    function setAgente($agente) {
        $this->agente = $agente;
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

