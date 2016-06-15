<?php

namespace Aluno\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlunoHasVaga
 *
 * @ORM\Table(name="aluno_has_vaga", indexes={@ORM\Index(name="Aluno_has_Vaga_FKIndex1", columns={"Aluno_idAluno"}), @ORM\Index(name="Aluno_has_Vaga_FKIndex2", columns={"Vaga_idVaga"})})
 * @ORM\Entity
 */
class AlunoHasVaga
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Aluno_idAluno", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $alunoIdaluno;

    /**
     * @var integer
     *
     * @ORM\Column(name="Vaga_idVaga", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $vagaIdvaga;

    function getAlunoIdaluno() {
        return $this->alunoIdaluno;
    }

    function getVagaIdvaga() {
        return $this->vagaIdvaga;
    }

    function setAlunoIdaluno($alunoIdaluno) {
        $this->alunoIdaluno = $alunoIdaluno;
        return $this;
    }

    function setVagaIdvaga($vagaIdvaga) {
        $this->vagaIdvaga = $vagaIdvaga;
        return $this;
    }


}

