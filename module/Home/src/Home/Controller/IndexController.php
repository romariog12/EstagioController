<?php

namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
    
   public function homeAction(){
        $this->sairComumAction();
            foreach ($this->session()->comum as $l){
                        $idUsuario = $l[0]->getIdusuario();
                    }
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaVagaPresencialPorUsuario = $em->getRepository("Vaga\Entity\VagaPresencial")->findByUsuarioIdusuario($idUsuario);
            $listaVagaEADPorUsuario = $em->getRepository("Vaga\Entity\Vaga")->findByUsuarioIdusuario($idUsuario);
            
            $listaVagaTotalEAD = $em->getRepository("Vaga\Entity\Vaga")->findAll();
            $listaVagaTotalPresencial = $em->getRepository("Vaga\Entity\VagaPresencial")->findAll();
            
            
       return new ViewModel([ 
                'identityComum'=>$this->session()->comum,
                'identityAdministrador'=>$this->session()->administrador,
                'quantidadeVagaPorUsuario'=>  count($listaVagaPresencialPorUsuario) + count($listaVagaEADPorUsuario),
                'quantidadeVagaTotal' => count($listaVagaTotalEAD) + count($listaVagaTotalPresencial)
             
       ]);  
   }
   
   
}
    
