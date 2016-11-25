<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Empresa\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Empresa\Entity\Empresa;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class IndexController extends AbstractActionController
{
    
 
    public function cadastrarEmpresaAction(){
        $this->sairAction();
          
          $request = $this->getRequest();
          $idaluno = $this->params()->fromRoute("id", 0);
          $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
          if ($request->isPost()){
              try {
              $nomeEmpresa = $request->getPost("empresa");
              $cnpj = $request->getPost("cnpj");
              $telefone = $request->getPost("telefone");
              $empresa = new Empresa();
              $empresa ->setEmpresa($nomeEmpresa);
              $empresa ->setCnpj($cnpj);
              $empresa ->setTelefone($telefone);
                  $em->persist($empresa);
                  $em->flush();
                  
              } catch (Exception $ex) {
                  echo $this->flashMessenger()->render();     
              }
              if($idaluno == 0){
                      return $this->redirect()->toRoute('empresa/default', 
                  array('controller' => 'index', 'action' => 'cadastrarEmpresa'));
                      
              }else
              {
                      return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'index', 'id'=>$idaluno));
              }
                      
              }
            
      
          return new ViewModel([
              'idaluno'=>$idaluno
          ]);
        }   
    
    public function cadastrarAgenteAction(){
          $this->sairAction();
          $request = $this->getRequest();
          $idaluno = $this->params()->fromRoute("id", 0);
          
          if ($request->isPost()){
              try {
              $nomeAgente = $request->getPost("agente");
              $cnpj = $request->getPost("cnpj");
              $telefone = $request->getPost("telefone");
              $agente = new \Empresa\Entity\Agente();
              $agente ->setAgente($nomeAgente);
              $agente ->setCnpj($cnpj);
              $agente ->setTelefone($telefone);
              
              $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                  $em->persist($agente);
                  $em->flush();
                  
              } catch (Exception $ex) {
                  echo $this->flashMessenger()->render();     
              }
                    if($idaluno == 0){
                      return $this->redirect()->toRoute('empresa/default', 
                  array('controller' => 'index', 'action' => 'cadastrarAgente'));
                      
              }else
              {
                      return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'index', 'id'=>$idaluno));
              }
            }
      
          return new ViewModel([
              'idaluno'=>$idaluno
          ]);
        }
        public function empresaAction(){
            $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaEmpresa = $em->getRepository("Empresa\Entity\Empresa")->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaEmpresa));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
            
            
            return new ViewModel([
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaEmpresa'=>$listaEmpresa
            ]);
        }
          public function agenteAction(){
              $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaAgente = $em->getRepository("Empresa\Entity\Agente")->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaAgente));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
            
            
            return new ViewModel([
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaEmpresa'=>$listaAgente
            ]);
        }
        
        
        
        public function editarEmpresaAction(){
            $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $idEmpresa = $this->params()->fromRoute("id", 0);
            $listaEmpresa = $em->getRepository("Empresa\Entity\Empresa")->findByIdempresa($idEmpresa);
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find("Empresa\Entity\Empresa", $idEmpresa);
                $empresa = $request->getPost("empresa");
                $cnpj = $request->getPost("cnpj");
                $telefone = $request->getPost("telefone");
                    
                
                try{
                   $select->setEmpresa($empresa);
                    $select->setCnpj($cnpj);
                    $select->setTelefone($telefone);
                    $em->persist($select);
                    $em->flush();     
                } catch (Exception $ex) {

                }
                
                  
            }
            
            return new ViewModel([
                   
                    'listaEmpresa' => $listaEmpresa
            ]);
        }
         public function editarAgenteAction(){
             $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $idAgente = $this->params()->fromRoute("id", 0);
            $listaAgente = $em->getRepository("Empresa\Entity\Agente")->findByIdagente($idAgente);
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find("Empresa\Entity\Agente", $idAgente);
                $agente = $request->getPost("agente");
                $cnpj = $request->getPost("cnpj");
                $telefone = $request->getPost("telefone");
                    
                
                try{
                   $select->setAgente($agente);
                    $select->setCnpj($cnpj);
                    $select->setTelefone($telefone);
                    $em->persist($select);
                    $em->flush();     
                } catch (Exception $ex) {

                }
                
                  
            }
            
            return new ViewModel([
                   
                    'listaAgente' => $listaAgente
            ]);
        }
            
        public function excluirEmpresaAction(){
            $this->sairAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteEmpresa", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $empresa = $em->find("Empresa\Entity\Empresa", $id);
            $em->remove($empresa);
            $em->flush();
          
        return $this->redirect()->toRoute('empresa/default',['controller'=>'index', 'id'=>$page]);       
    }
    public function excluirAgenteAction(){
            $this->sairAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAgente", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $agente = $em->find("Empresa\Entity\Agente", $id);
            $em->remove($agente);
            $em->flush();
          
        return $this->redirect()->toRoute('empresa/default',['controller'=>'index','action'=>'agente','id'=>$page]);       
    }
}
