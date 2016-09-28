<?php



/**
 * Description of aproveitamento_presencial
 *
 * @author romario
 */
namespace Relatorio\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * aproveitamentoPresencial
 *
 * @ORM\Table(name="aproveitamentopresencial")
 * @ORM\Entity
 * 
 */
class aproveitamentoPresencial {
  

    /**
     * @var integer
     *
     * @ORM\Column(name="idaproveitamentopresencial", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     */
    private $idAproveitamentoPresencial;


    /**
     * @var string
     *
     * @ORM\Column(name="Curso", type="string", length=50, nullable=true)
     * 
     */
    private $curso;

    /**
     * @var string
     *
     * @ORM\Column(name="quantidadeAlunos", type="string",length=50, nullable=true)
     */
    private $quantidadeAlunos;

    /**
     * @var string
     *
     * @ORM\Column(name="Estagiando", type="string",length=50, nullable=true)
     */
    private $estagiando;
      /**
     * @var string
     *
     * @ORM\Column(name="Ano", type="string",length=50, nullable=true)
     */
    private $ano;
      /**
     * @var string
     *
     * @ORM\Column(name="Semestre", type="string",length=50, nullable=true)
     */
    private $semestre;
    function getIdAproveitamentoPresencial() {
        return $this->idAproveitamentoPresencial;
    }

    function getCurso() {
        return $this->curso;
    }

    function getQuantidadeAlunos() {
        return $this->quantidadeAlunos;
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

    function setIdAproveitamentoPresencial($idAproveitamentoPresencial) {
        $this->idAproveitamentoPresencial = $idAproveitamentoPresencial;
        return $this;
    }

    function setCurso($curso) {
        $this->curso = $curso;
        return $this;
    }

    function setQuantidadeAlunos($quantidadeAlunos) {
        $this->quantidadeAlunos = $quantidadeAlunos;
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


}
