<?php

namespace Vaga\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Encaminhamento
 *
 * @ORM\Table(name="encaminhamento")
 * @ORM\Entity
 */
class Encaminhamento
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Inicio", type="date", nullable=false)
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fim", type="date", nullable=false)
     */
    private $fim;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Recisao", type="date", nullable=true)
     */
    private $recisao;

    /**
     * @var integer
     *
     * @ORM\Column(name="Relatorio", type="integer", nullable=false)
     */
    private $relatorio;

    /**
     * @var string
     *
     * @ORM\Column(name="Entregue", type="string", length=50, nullable=false)
     */
    private $entregue;

    /**
     * @var integer
     *
     * @ORM\Column(name="idEncaminhamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idencaminhamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="idVaga_Encaminhamento", type="integer", nullable=false)
     */
    private $idvagaEncaminhamento;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="idAluno_Encaminhamento", type="integer", nullable=false)
     */
    private $idalunoEncaminhamento;

    function getInicio() {
        return $this->inicio;
    }

    function getFim() {
        return $this->fim;
    }

    function getRecisao() {
        return $this->recisao;
    }

    function getRelatorio() {
        return $this->relatorio;
    }

    function getEntregue() {
        return $this->entregue;
    }

    function getIdencaminhamento() {
        return $this->idencaminhamento;
    }

    function getIdvagaEncaminhamento() {
        return $this->idvagaEncaminhamento;
    }

    function getIdalunoEncaminhamento() {
        return $this->idalunoEncaminhamento;
    }

    function setInicio(\DateTime $inicio) {
        $this->inicio = $inicio;
        return $this;
    }

    function setFim(\DateTime $fim) {
        $this->fim = $fim;
        return $this;
    }

    function setRecisao(\DateTime $recisao) {
        $this->recisao = $recisao;
        return $this;
    }

    function setRelatorio($relatorio) {
        $this->relatorio = $relatorio;
        return $this;
    }

    function setEntregue($entregue) {
        $this->entregue = $entregue;
        return $this;
    }

    function setIdencaminhamento($idencaminhamento) {
        $this->idencaminhamento = $idencaminhamento;
        return $this;
    }

    function setIdvagaEncaminhamento($idvagaEncaminhamento) {
        $this->idvagaEncaminhamento = $idvagaEncaminhamento;
        return $this;
    }

    function setIdalunoEncaminhamento($idalunoEncaminhamento) {
        $this->idalunoEncaminhamento = $idalunoEncaminhamento;
        return $this;
    }




}

