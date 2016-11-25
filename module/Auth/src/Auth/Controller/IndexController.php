<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
        
    public function loginAction() {
        
    $request = $this->getRequest();
    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    if($request->isPost())
        { 
                $data = $this->params()->fromPost();
                $auth = $this->getServiceLocator()->get('AuthenticationService');
                $adapter = $auth->getAdapter();
                $login = $data['login'];
                $senha = $data['senha'];     
                $adapter->setLogin($login)->setSenha($senha);
                
                if ($auth->authenticate()->isValid()) {
                    foreach ($auth->authenticate()->getIdentity() as $l){
                        $nivel = $l[0]->getNivel();
                    }
                    switch ($nivel){
                        case 1: 
                            $this->session()->administrador = $auth->authenticate()->getIdentity();
                            $this->session()->comum = $auth->authenticate()->getIdentity();
                            return $this->redirect()->toRoute('home', array('controller' => 'index', 'action' => 'index'));
                            break;
                        case 2: 
                            $this->session()->comum = $auth->authenticate()->getIdentity();
                            
                            return $this->redirect()->toRoute('home', array('controller' => 'index', 'action' => 'index'));
                            
                            break;
                    }
                     
                }
               
              $mensagem = 'Credenciais inválidas' ;
              return new ViewModel([
          'mensagem'=>$mensagem
      ]
              
              );
        }
 
        
      
 }
 
 
 
}
