<?php


namespace Auth\Model;

use Zend\Authentication\Adapter\AdapterInterface;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\Result;
use Base\Model\Entity;

/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class Adapter implements AdapterInterface{
    
    protected $login;
    protected $senha;
    protected $cpf;
    protected $cnpj;
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
    function getCpf() {
        return $this->cpf;
    }

    function getCnpj() {
        return $this->cnpj;
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
    function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
        return $this;
    }

    
    public function authenticate() {
        if (!empty($this->getLogin())){
            $user = $this->em->getRepository(Entity::usuario)->findByLoginAndPassword($this->getLogin(), $this->getSenha());    
              if (!empty($user)) {
            return new Result(Result::SUCCESS, $user, []);
            } else {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, ['Login e/ou senha nao encontrados']);
        }
        }
        if(!empty($this->getCnpj())){
            $userEmpresa = $this->em->getRepository(Entity::empresa)->findByCnpjAndPassword($this->getCnpj(), $this->getSenha());
             if (!empty($userEmpresa)) {
                 
                return new Result(Result::SUCCESS, $userEmpresa, []);
                
            } else {
           
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array('Login e/ou senha nao encontrados'));

        }
        }
        if(!empty( $this->getCpf())){
         $userAluno = $this->em->getRepository(Entity::aluno)->findByCpfAndSenha($this->getCpf(), $this->getSenha());
            if (!empty($userAluno)) {
            
                return new Result(Result::SUCCESS, $userAluno, [])   ;
            } else {
           
                return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, ['Login e/ou senha nao encontrados']);
            }   
        }
    }
}