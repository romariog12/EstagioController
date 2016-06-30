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
                $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                $adapter = $auth->getAdapter();
                $adapter->setLogin($data['login'])->setSenha($data['senha']);
                 if ($auth->authenticate()->isValid()) {
                    $this->flashMessenger()->addSuccessMessage('Login realizado com sucesso!');
                    return $this->redirect()->toRoute('home', array('controller' => 'home', 'action' => 'index'));
                }
          }
          
          
      
      return new ViewModel();
 }
}
