<?php
namespace Administrador\Controller;
use Zend\Authentication\AuthenticationService;

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