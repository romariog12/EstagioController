<?php

namespace Vaga\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoPresencial
 *
 * @ORM\Table(name="documentopresencial")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Vaga\Entity\DocumentoPresencialRepository")
 */
class DocumentoPresencial
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
     * @var string
     *
     * @ORM\Column(name="Operacao1", type="string", nullable=false)
     */
    private $operacao1 = '0';
     /**
     * @var string
     *
     * @ORM\Column(name="Operacao2", type="string", nullable=false)
     */
    private $operacao2 = '0';
     /**
     * @var string
     *
     * @ORM\Column(name="Operacao3", type="string", nullable=false)
     */
    private $operacao3 = '0';
     /**
     * @var string
     *
     * @ORM\Column(name="Operacao4", type="string", nullable=false)
     */
    private $operacao4 = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Recisao", type="date", nullable=true)
     */
    private $recisao;

    /**
     * @var string
     *
     * @ORM\Column(name="Relatorio", type="string", nullable=false)
     */
    private $relatorio;

    /**
     * @var string
     *
     * @ORM\Column(name="Entregue", type="string", length=50, nullable=false)
     */
    private $entregue;
    /**
     * @var string
     *
     * @ORM\Column(name="anoDocumento", type="string", length=50, nullable=false)
     */
    private $anoDocumento;
     /**
     * @var string
     *
     * @ORM\Column(name="mesDocumento", type="string", length=50, nullable=false)
     */
    private $mesDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="idDocumento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="idVagaDocumento", type="integer", nullable=false)
     */
    private $idvagaDocumento;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="idAlunoDocumento", type="integer", nullable=false)
     */
    private $idalunoDocumento;
    /**
     * @var integer
     *
     * @ORM\Column(name="cursoDocumento", type="integer", nullable=false)
    
     */
    private $cursoDocumento;
       /**
     * @var string
     *
     * @ORM\Column(name="relatorio1", type="string", nullable=false)
     */
    private $relatorio1 = '0';
     /**
     * @var string
     *
     * @ORM\Column(name="relatorio2", type="string", nullable=false)
     */
    private $relatorio2 = '0';
     /**
     * @var string
     *
     * @ORM\Column(name="relatorio3", type="string", nullable=false)
     */
    private $relatorio3 = '0';
     /**
     * @var string
     *
     * @ORM\Column(name="relatorio4", type="string", nullable=false)
     */
    private $relatorio4 = '0';
     /**
     * @var string
     *
     * @ORM\Column(name="dataLancamento", type="string", nullable=false)
     */
    private $dataLancamento;

    
    function getInicio() {
        return $this->inicio;
    }

    function getFim() {
        return $this->fim;
    }

        function getOperacao1() {
        return $this->operacao1;
    }

    function getOperacao2() {
        return $this->operacao2;
    }

    function getOperacao3() {
        return $this->operacao3;
    }

    function getOperacao4() {
        return $this->operacao4;
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

    function getAnoDocumento() {
        return $this->anoDocumento;
    }

    function getMesDocumento() {
        return $this->mesDocumento;
    }

    function getIddocumento() {
        return $this->iddocumento;
    }

    function getIdvagaDocumento() {
        return $this->idvagaDocumento;
    }

    function getIdalunoDocumento() {
        return $this->idalunoDocumento;
    }

    function getCursoDocumento() {
        return $this->cursoDocumento;
    }
    function getRelatorio1() {
        return $this->relatorio1;
    }

    function getRelatorio2() {
        return $this->relatorio2;
    }

    function getRelatorio3() {
        return $this->relatorio3;
    }

    function getRelatorio4() {
        return $this->relatorio4;
    }
    function getDataLancamento() {
        return $this->dataLancamento;
    }

    function setInicio(\DateTime $inicio) {
        $this->inicio = $inicio;
        return $this;
    }

    function setFim(\DateTime $fim) {
        $this->fim = $fim;
        return $this;
    }

        function setOperacao1($operacao1) {
        $this->operacao1 = $operacao1;
        return $this;
    }

    function setOperacao2($operacao2) {
        $this->operacao2 = $operacao2;
        return $this;
    }

    function setOperacao3($operacao3) {
        $this->operacao3 = $operacao3;
        return $this;
    }

    function setOperacao4($operacao4) {
        $this->operacao4 = $operacao4;
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

    function setAnoDocumento($anoDocumento) {
        $this->anoDocumento = $anoDocumento;
        return $this;
    }

    function setMesDocumento($mesDocumento) {
        $this->mesDocumento = $mesDocumento;
        return $this;
    }

    function setIddocumento($iddocumento) {
        $this->iddocumento = $iddocumento;
        return $this;
    }

    function setIdvagaDocumento($idvagaDocumento) {
        $this->idvagaDocumento = $idvagaDocumento;
        return $this;
    }

    function setIdalunoDocumento($idalunoDocumento) {
        $this->idalunoDocumento = $idalunoDocumento;
        return $this;
    }

    function setCursoDocumento($cursoDocumento) {
        $this->cursoDocumento = $cursoDocumento;
        return $this;
    }
    function setRelatorio1($relatorio1) {
        $this->relatorio1 = $relatorio1;
        return $this;
    }

    function setRelatorio2($relatorio2) {
        $this->relatorio2 = $relatorio2;
        return $this;
    }

    function setRelatorio3($relatorio3) {
        $this->relatorio3 = $relatorio3;
        return $this;
    }

    function setRelatorio4($relatorio4) {
        $this->relatorio4 = $relatorio4;
        return $this;
    }

    function setDataLancamento($dataLancamento) {
        $this->dataLancamento = $dataLancamento;
        return $this;
    }





}

