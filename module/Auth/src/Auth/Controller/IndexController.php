<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
        
    public function loginAction() {  
    $request = $this->getRequest();  
    if($request->isPost())
        { 
                $data = $this->params()->fromPost();
                $auth = $this->getServiceLocator()->get('AuthenticationService');
                $adapter = $auth->getAdapter();
                $login = $data['login'];
                $senha = $data['senha'];
                $adapter->setLogin($login)->setSenha($senha);
                 
                if ($auth->authenticate()->isValid()) {
                    $this->flashMessenger()->addSuccessMessage('Login realizado com sucesso!');
                    return $this->redirect()->toRoute('geral', array('controller' => 'home', 'action' => 'index'));
                }
                $mensagem = $auth->authenticate()->getMessages();
                    $this->flashMessenger()->addErrorMessage($mensagem[0]);
        }
 
        
      return new ViewModel();
 }
 
 
 
}
