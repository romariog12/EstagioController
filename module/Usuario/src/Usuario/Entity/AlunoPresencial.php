<?php

namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlunoPresencial
 *
 * @ORM\Table(name="alunoPresencial", indexes={@ORM\Index(name="Usuario_FKIndex1", columns={"Administrador_idAdministrador"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Usuario\Entity\AlunoPresencialRepository")
 */
class AlunoPresencial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAluno", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idaluno;

    /**
     * @var integer
     *
     * @ORM\Column(name="Administrador_idAdministrador", type="integer", nullable=false)
     */
    private $administradorIdadministrador;

    /**
     * @var string
     *
     * @ORM\Column(name="Nome", type="string", length=50, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="Curso", type="string", length=50, nullable=true)
     */
    private $curso;

    /**
     * @var string
     *
     * @ORM\Column(name="Matricula", type="string", length=12, nullable=true)
     * 
     */
    private $matricula;
    /**
     * @var string
     *
     * @ORM\Column(name="Modalidade", type="string", length=50, nullable=true)
     * 
     */
    private $modalidade;
    
    function getIdaluno() {
        return $this->idaluno;
    }

    function getAdministradorIdadministrador() {
        return $this->administradorIdadministrador;
    }

    function getNome() {
        return $this->nome;
    }

    function getCurso() {
        return $this->curso;
    }

    function getMatricula() {
        return $this->matricula;
    }
    function getModalidade() {
        return $this->modalidade;
    }

    
    function setIdaluno($idaluno) {
        $this->idaluno = $idaluno;
    }

    function setAdministradorIdadministrador($administradorIdadministrador) {
        $this->administradorIdadministrador = $administradorIdadministrador;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setCurso($curso) {
        $this->curso = $curso;
        return $this;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
        return $this;
    }
    function setModalidade($modalidade) {
        $this->modalidade = $modalidade;
        return $this;
    }





}

