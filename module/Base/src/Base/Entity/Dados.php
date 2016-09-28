<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dados
 *
 * @ORM\Table(name="dados")
 * @ORM\Entity (repositoryClass="Base\Entity\DadosRepository")
 */
class Dados
{
    /**
     * @var string
     *
     * @ORM\Column(name="Curso", type="string", length=50, nullable=false)
     */
    private $curso;

    /**
     * @var string
     *
     * @ORM\Column(name="quantidadeAlunos", type="string", length=50, nullable=false)
     */
    private $quantidadealunos;

    /**
     * @var string
     *
     * @ORM\Column(name="Estagiando", type="string", length=50, nullable=false)
     */
    private $estagiando;

    /**
     * @var string
     *
     * @ORM\Column(name="Ano", type="string", length=50, nullable=false)
     */
    private $ano;

    /**
     * @var string
     *
     * @ORM\Column(name="Semestre", type="string", length=50, nullable=false)
     */
    private $semestre;

    /**
     * @var integer
     *
     * @ORM\Column(name="idDados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddados;

    /**
     * @var string
     *
     * @ORM\Column(name="idCurso", type="string", nullable=false)
     */
    private $idcurso;
      /**
     * @var string
     *
     * @ORM\Column(name="Meta", type="string", nullable=false)
     */
    private $meta;

    function getCurso() {
        return $this->curso;
    }

    function getQuantidadealunos() {
        return $this->quantidadealunos;
    }

    function getEstagiando() {
        return $this->estagiando;
    }

    function getAno() {
        return $this->ano;
    }

    function getSemestre() {
        return $this->semestre;
    }

    function getIddados() {
        return $this->iddados;
    }

    function getIdcurso() {
        return $this->idcurso;
    }
    function getMeta() {
        return $this->meta;
    }

        function setCurso($curso) {
        $this->curso = $curso;
        return $this;
    }

    function setQuantidadealunos($quantidadealunos) {
        $this->quantidadealunos = $quantidadealunos;
        return $this;
    }

    function setEstagiando($estagiando) {
        $this->estagiando = $estagiando;
        return $this;
    }

    function setAno($ano) {
        $this->ano = $ano;
        return $this;
    }

    function setSemestre($semestre) {
        $this->semestre = $semestre;
        return $this;
    }

    function setIddados($iddados) {
        $this->iddados = $iddados;
        return $this;
    }

    function setIdcurso($idcurso) {
        $this->idcurso = $idcurso;
        return $this;
    }

    function setMeta($meta) {
        $this->meta = $meta;
        return $this;
    }


}

