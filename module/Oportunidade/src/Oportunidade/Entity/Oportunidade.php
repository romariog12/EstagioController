<?php

namespace Oportunidade\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oportunidade
 *
 * @ORM\Table(name="oportunidade")
 * @ORM\Entity (repositoryClass="Oportunidade\Entity\OportunidadeRepository")
 */
class Oportunidade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idOportunidade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idoportunidade;

    /**
     * @var string
     *
     * @ORM\Column(name="Empresa", type="string", length=100, nullable=false)
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="Curso", type="string", length=100, nullable=false)
     */
    private $curso;

    /**
     * @var string
     *
     * @ORM\Column(name="Descricao", type="string", length=1000, nullable=false)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroVaga", type="string", length=50, nullable=false)
     */
    private $numerovaga;

    /**
     * @var string
     *
     * @ORM\Column(name="Cargo", type="string", length=100, nullable=false)
     */
    private $cargo;
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="Data", type="date", nullable=false)
     */
    private $data;

    function getIdoportunidade() {
        return $this->idoportunidade;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getCurso() {
        return $this->curso;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getNumerovaga() {
        return $this->numerovaga;
    }

    function getCargo() {
        return $this->cargo;
    }
    function getData() {
        return $this->data;
    }

        function setIdoportunidade($idoportunidade) {
        $this->idoportunidade = $idoportunidade;
        return $this;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
        return $this;
    }

    function setCurso($curso) {
        $this->curso = $curso;
        return $this;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    function setNumerovaga($numerovaga) {
        $this->numerovaga = $numerovaga;
        return $this;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
        return $this;
    }

    function setData(\DateTime $data) {
        $this->data = $data;
        return $this;
    }


}

