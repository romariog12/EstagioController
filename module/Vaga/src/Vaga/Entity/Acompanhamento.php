<?php

namespace Vaga\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acompanhamento
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 * @ORM\Table(name="acompanhamento")
 * @ORM\Entity
 */
class Acompanhamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAcompanhamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idacompanhamento;

    /**
     * @var string
     *
     * @ORM\Column(name="inicio", type="string", length=20, nullable=false)
     */
    private $inicio; 
    /**
     * @var string
     *
     * @ORM\Column(name="fim", type="string", length=20, nullable=false)
     */
    private $fim; 
    /**
     * @var string
     *
     * @ORM\Column(name="periodo", type="string", length=20, nullable=false)
     */
    private $periodo; 
    /**
     * @var string
     *
     * @ORM\Column(name="acompanhante", type="string", length=50, nullable=false)
     */
    private $acompanhante; 

    /**
     * @var string
     *
     * @ORM\Column(name="idVagaAcompanhamento", type="string", length=10, nullable=false)
     */
    private $idvagaacompanhamento;

    /**
     * @var string
     *
     * @ORM\Column(name="idAlunoAcompanhamento", type="string", length=10, nullable=false)
     */
    private $idalunoacompanhamento;

    /**
     * @var string
     *
     * @ORM\Column(name="mesAcompanhamento", type="string", length=10, nullable=false)
     */
    private $mesacompanhamento;

    /**
     * @var string
     *
     * @ORM\Column(name="anoAcompanhamento", type="string", length=10, nullable=false)
     */
    private $anoacompanhamento;
      /**
     * @var string
     *
     * @ORM\Column(name="dataAcompanhamento", type="string", length=50, nullable=false)
     */
    private $dataacompanhamento;
    function setIdacompanhamento($idacompanhamento) {
        $this->idacompanhamento = $idacompanhamento;
        return $this;
    }

    function setInicio($inicio) {
        $this->inicio = $inicio;
        return $this;
    }

    function setFim($fim) {
        $this->fim = $fim;
        return $this;
    }

    function setPeriodo($periodo) {
        $this->periodo = $periodo;
        return $this;
    }

    function setAcompanhante($acompanhante) {
        $this->acompanhante = $acompanhante;
        return $this;
    }

    
    function setIdvagaacompanhamento($idvagaacompanhamento) {
        $this->idvagaacompanhamento = $idvagaacompanhamento;
        return $this;
    }

    function setIdalunoacompanhamento($idalunoacompanhamento) {
        $this->idalunoacompanhamento = $idalunoacompanhamento;
        return $this;
    }

    function setMesacompanhamento($mesacompanhamento) {
        $this->mesacompanhamento = $mesacompanhamento;
        return $this;
    }

    function setAnoacompanhamento($anoacompanhamento) {
        $this->anoacompanhamento = $anoacompanhamento;
        return $this;
    }
    function setDataacompanhamento($dataacompanhamento) {
        $this->dataacompanhamento = $dataacompanhamento;
        return $this;
    }

    
        function getIdacompanhamento() {
        return $this->idacompanhamento;
    }

    function getInicio() {
        return $this->inicio;
    }

    function getFim() {
        return $this->fim;
    }

    function getPeriodo() {
        return $this->periodo;
    }

    function getAcompanhante() {
        return $this->acompanhante;
    }

        function getIdvagaacompanhamento() {
        return $this->idvagaacompanhamento;
    }

    function getIdalunoacompanhamento() {
        return $this->idalunoacompanhamento;
    }

    function getMesacompanhamento() {
        return $this->mesacompanhamento;
    }

    function getAnoacompanhamento() {
        return $this->anoacompanhamento;
    }
    function getDataacompanhamento() {
        return $this->dataacompanhamento;
    }




}

