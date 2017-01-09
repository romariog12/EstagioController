<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Model\Entity;
use Auth\Model\Nivel;
use Auth\Model\Session;
use Zend\Authentication\AuthenticationService;

class IndexController extends AbstractActionController
{
    const administrador = '1';
    const usuarioComum = '2';
   
                        
    public function loginAction() {
           
    $session = new Session();
    
    $request = $this->getRequest();
    $em = $this->getServiceLocator()->get(Entity::em);
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
                        
                        case self::administrador : 
                            $session->session()->administrador = $auth->authenticate()->getIdentity();
                            $session->session()->comum = $auth->authenticate()->getIdentity();
                            return $this->redirect()->toRoute('home', array('controller' => 'index', 'action' => 'index'));
                            break;
                        case self::usuarioComum: 
                            $session->session()->comum = $auth->authenticate()->getIdentity();       
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
 public function logoutAction(){
     $auth = new AuthenticationService();
     
        if ($auth->hasIdentity()) {
            $auth->clearIdentity();
            $this->flashMessenger()->addSuccessMessage('Voce acabou de ser desconectado!');
        }
        return $this->redirect()->toRoute('home', array('controller' => 'index', 'action' => 'login'));
    }
}
