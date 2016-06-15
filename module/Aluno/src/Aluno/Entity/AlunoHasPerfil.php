<?php

namespace Aluno\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlunoHasPerfil
 *
 * @ORM\Table(name="aluno_has_perfil", indexes={@ORM\Index(name="Aluno_has_Perfil_FKIndex1", columns={"Aluno_idAluno"}), @ORM\Index(name="Aluno_has_Perfil_FKIndex2", columns={"Perfil_idPerfil"})})
 * @ORM\Entity
 */
class AlunoHasPerfil
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
     * @ORM\Column(name="Perfil_idPerfil", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $perfilIdperfil;


}

