<?php

namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Base\Model\Entity;
class IndexController extends AbstractActionController {

  
   public function partialHomeAction(){
           $em = $this->getServiceLocator()->get(Entity::em);
           $auth = new AuthenticationService();
           $identity = $auth->getIdentity();
           foreach ($identity as $l){
               $idUsuario = $l[0]->getIdUsuario();
           }
           $usuario = $em->getRepository(Entity::usuario)->findByIdusuario($idUsuario);
           $view = new ViewModel([ 
                'usuario' =>$usuario
           ] );
           return $view;
   }
}
    
