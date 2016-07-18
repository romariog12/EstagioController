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

class IndexController extends AbstractActionController
{
      public function indexAction()
      {
          if(!isset($this->session()->item)){
           $this->redirect()->toUrl('http://127.0.0.1/Projem/public/login');
       }
       {
          $result = array();
          $request = $this->getRequest();
          $idaluno = $this->params()->fromRoute("id", 0);
          
          if ($request->isPost()){
              try {
              $nomeEmpresa = $request->getPost("empresa");
              $cnpj = $request->getPost("cnpj");
              $telefone = $request->getPost("telefone");
              $empresa = new Empresa();
              $empresa ->setEmpresa($nomeEmpresa);
              $empresa ->setCnpj($cnpj);
              $empresa ->setTelefone($telefone);
              
              $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                  $em->persist($empresa);
                  $em->flush();
                  
                  
                    $this->flashMessenger()->addSuccessMessage('Cadastrado com Sucesso');
                  
              } catch (Exception $ex) {
                  echo $this->flashMessenger()->render();     
              }   
                if ($this->flashMessenger()->hasSuccessMessages()) {
                    return new ViewModel(array(
                    'success' => $this->flashMessenger()->getSuccessMessages()
                ));
                }
                 return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'index', 'id'=>$idaluno));
            }
      
          return new ViewModel(['success' => $this->flashMessenger()->getSuccessMessages()]);
        }
    }
}
