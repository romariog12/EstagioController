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
    
    public function logout(){
         $auth = new AuthenticationService(); 
         if(empty($auth->hasIdentity())){
            return $this->redirect()->toRoute('auth');
           }
       return false;
    }
}