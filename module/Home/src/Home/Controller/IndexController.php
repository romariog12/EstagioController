<?php

namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Model\Entity;

class IndexController extends AbstractActionController {
    
   public function homeAction(){
        $this->sairComumAction();
            foreach ($this->session()->comum as $l){
                        $idUsuario = $l[0]->getIdusuario();
                    }
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaVagaPresencialPorUsuario = $em->getRepository(Entity::vagaPresencial)->findByUsuarioIdusuario($idUsuario);
            $listaVagaEADPorUsuario = $em->getRepository(Entity::vagaEad)->findByUsuarioIdusuario($idUsuario);
            
            $listaVagaTotalEAD = $em->getRepository(Entity::vagaEad)->findAll();
            $listaVagaTotalPresencial = $em->getRepository(Entity::vagaPresencial)->findAll();
            
            
       return new ViewModel([ 
                'identityComum'=>$this->session()->comum,
                'identityAdministrador'=>$this->session()->administrador,
                'quantidadeVagaPorUsuario'=>  count($listaVagaPresencialPorUsuario) + count($listaVagaEADPorUsuario),
                'quantidadeVagaTotal' => count($listaVagaTotalEAD) + count($listaVagaTotalPresencial)
             
       ]);  
   }
   
   
}
    
