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
     * @var string
     *
     * @ORM\Column(name="Inicio", type="string", nullable=false)
     */
    private $inicio;

    /**
     * @var string
     *
     * @ORM\Column(name="Fim", type="string", nullable=false)
     */
    private $fim;

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

    function setInicio($inicio) {
        $this->inicio = $inicio;
        return $this;
    }

    function setFim($fim) {
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




}

