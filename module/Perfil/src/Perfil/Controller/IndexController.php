<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Perfil\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Aluno\Entity\Aluno;
use Vaga\Entity\Vaga;

class IndexController extends AbstractActionController {
   
public function indexAction()   {
    $this->sairAction();
    
    $request = $this->getRequest();
   
    if($request->isPost()){
        $data = $this->params()->fromPost();
        $aluno = new Aluno(); 
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        if ($data['buscar']=='Buscar'){
                   $matricula = $request->getPost('busca');
                   $aluno->setMatricula($matricula);
                   $lista = $em->getRepository("Aluno\Entity\Aluno")->findByMatricula($aluno->getMatricula());
                   
        }
        return new ViewModel([
        'lista' => $lista,
            ]);  
        }
    }
    //Vagas cadastradas no Perfil                  
    public function perfilAction(){
       $this->sairAction();
      $vaga = new Vaga();
      $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdalunovaga($id);
      $lista = $em->getRepository("Aluno\Entity\Aluno")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                    $listaEncaminhamento = $em->getRepository("Vaga\Entity\Encaminhamento")->findByIdvagaEncaminhamento($vaga->getIdvaga());
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'lista'=>$lista,
                'listaEncaminhamento'=>$listaEncaminhamento
            ]);        
    }
    
}