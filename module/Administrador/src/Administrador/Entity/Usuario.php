<?php

namespace Administrador\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Usuario
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Administrador\Entity\UsuarioRepository")
 */
class Usuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuario;
     /**
     * @var string
     *
     * @ORM\Column(name="Nome", type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="Login", type="string", length=50, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="Senha", type="string", length=50, nullable=true)
     */
    private $senha;
    /**
     * @var string
     *
     * @ORM\Column(name="Matricula", type="string", length=50, nullable=true)
     */
    private $matricula;
    /**
     * @var string
     *
     * @ORM\Column(name="Cargo", type="string", length=50, nullable=true)
     */
    private $cargo;
    /**
     * @var integer
     *
     * @ORM\Column(name="Nivel", type="integer", nullable=true)
     */
    private $nivel;
    
    function getNivel() {
        return $this->nivel;
    }       
    function getIdusuario() {
        return $this->idusuario;
    }
    function getNome() {
        return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }
    function getMatricula() {
        return $this->matricula;
    }

    function getCargo() {
        return $this->cargo;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
        return $this;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
        return $this;
    }
    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setLogin($login) {
        $this->login = $login;
        return $this;
    }

    function setSenha($senha) {
        $this->senha = $senha;
        return $this;
    }
    function setMatricula($matricula) {
        $this->matricula = $matricula;
        return $this;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
        return $this;
    }

            
    public function encryptPassword($password)
    {
        return sha1($password);
    }
    


}

