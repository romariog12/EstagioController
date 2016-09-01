<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuario\Entity\Empresa;

class EmpresaController extends AbstractActionController
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
                      return $this->redirect()->toRoute('cadastrarEmpresa/default', 
                  array('controller' => 'empresa', 'action' => 'cadastrarEmpresa','id'=>'0'));
                      
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
              $agente = new \Usuario\Entity\Agente();
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
                      return $this->redirect()->toRoute('cadastrarEmpresa/default', 
                  array('controller' => 'empresa', 'action' => 'cadastrarAgente','id'=>'0'));
                      
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
        
}
