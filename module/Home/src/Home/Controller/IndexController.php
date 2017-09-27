<?php

namespace Home\Controller;

use Auth\Controller\AdministradorAbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Base\Model\Entity;
use Zend\Authentication\AuthenticationService;

<<<<<<< HEAD
class IndexController extends AdministradorAbstractActionController {

  
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
=======
class IndexController extends AbstractActionController {
   

    public function homeAction(){
            $this->sairComumAction();
            $auth = new AuthenticationService();
            $identity = $auth->getIdentity();
            foreach ($identity as $l){
                        $idUsuario = $l[0]->getIdusuario();
                    }
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaVagaPresencialPorUsuario = $em->getRepository(Entity::vagaPresencial)->findByUsuarioIdusuario($idUsuario);
            $listaVagaEADPorUsuario = $em->getRepository(Entity::vagaEad)->findByUsuarioIdusuario($idUsuario);
            
            $listaVagaTotalEAD = $em->getRepository(Entity::vagaEad)->findAll();
            $listaVagaTotalPresencial = $em->getRepository(Entity::vagaPresencial)->findAll();
            
            
       return new ViewModel([ 
                'identityComum'=>$identity,
                'identityAdministrador'=>$identity,
                'quantidadeVagaPorUsuario'=>  count($listaVagaPresencialPorUsuario) + count($listaVagaEADPorUsuario),
                'quantidadeVagaTotal' => count($listaVagaTotalEAD) + count($listaVagaTotalPresencial)
             
       ]);  
>>>>>>> origin/master
   }
}
    
