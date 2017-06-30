<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Controller;

/**
 * Description of AbstractActionControler
 *
 * @author romario
 */
use Zend\Authentication\AuthenticationService;
use Zend\Session\Container;

/**
 * Basic action controller
 */
class AdministradorAbstractActionController extends \Zend\Mvc\Controller\AbstractActionController
{ 
     private $session;
   public function logout(){
         $auth = new AuthenticationService(); 
         if(empty($auth->hasIdentity())){
            return $this->redirect()->toRoute('auth');
           }
       return false;
   }
   public function acessoNegado(){
         $auth = new AuthenticationService();
           foreach ($auth->getIdentity() as $l){
               $nivel = $l[0]->getNivel();
               switch ($nivel):
                   case 'u2':
                       return $this->redirect()->toRoute('authEmpresa');
                       endswitch;
                    
           } 
   }
   public function session(){
          $this->session = new Container('namespace');
          return $this->session;    
        }
    
}