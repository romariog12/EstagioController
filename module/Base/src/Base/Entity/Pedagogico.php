<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedagogico
 *
 * @ORM\Table(name="pedagogico")
 * @ORM\Entity
 */
class Pedagogico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPedagogico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpedagogico;

    /**
     * @var string
     *
     * @ORM\Column(name="Semestre", type="string", length=10, nullable=false)
     */
    private $semestre;

    /**
     * @var string
     *
     * @ORM\Column(name="Orientador", type="string", length=50, nullable=false)
     */
    private $orientador;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Orientacao", type="string", length=500, nullable=false)
     */
    private $orientacao;

    /**
     * @var string
     *
     * @ORM\Column(name="idCurso", type="string", length=50, nullable=false)
     */
    private $idcurso;

    function getIdpedagogico() {
        return $this->idpedagogico;
    }

    function getSemestre() {
        return $this->semestre;
    }

    function getOrientador() {
        return $this->orientador;
    }

    function getEmail() {
        return $this->email;
    }

    function getOrientacao() {
        return $this->orientacao;
    }

    function getIdcurso() {
        return $this->idcurso;
    }

    function setIdpedagogico($idpedagogico) {
        $this->idpedagogico = $idpedagogico;
        return $this;
    }

    function setSemestre($semestre) {
        $this->semestre = $semestre;
        return $this;
    }

    function setOrientador($orientador) {
        $this->orientador = $orientador;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    function setOrientacao($orientacao) {
        $this->orientacao = $orientacao;
        return $this;
    }

    function setIdcurso($idcurso) {
        $this->idcurso = $idcurso;
        return $this;
    }


}

