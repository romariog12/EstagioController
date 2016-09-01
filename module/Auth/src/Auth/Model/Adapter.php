<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adapter
 *
 * @author romario
 */
namespace Auth\Model;

use Zend\Authentication\Adapter\AdapterInterface;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\Result;


class Adapter implements AdapterInterface{
    
    protected $login;
    protected $senha;
    protected $em;
    
    public function __construct(EntityManager $em) {  
          $this->em = $em;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEm() {
        return $this->em;
    }

    function setLogin($login) {
        $this->login = $login;
        return $this;
    }

    function setSenha($senha) {
        $this->senha = $senha;
        return $this;
    }

    function setEm($em) {
        $this->em = $em;
        return $this;
    }

    public function authenticate() {
        $user = $this->em->getRepository('Usuario\Entity\Administrador')->findByLoginAndPassword($this->getLogin(), $this->getSenha());
        if ($user) {
            
            return new Result(Result::SUCCESS, $user, array())   ;
        } else {
           
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array('Login e/ou senha nao encontrados'));

        }
    }

}
