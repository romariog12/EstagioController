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
                
                $lista = $em->getRepository("Administrador\Entity\Administrador")->findByLoginAndPassword($login, $senha);        
                $adapter->setLogin($login)->setSenha($senha);
                
                if ($auth->authenticate()->isValid()) {
                    $this->session()->item = $lista;
                    $this->flashMessenger()->addSuccessMessage('Login realizado com sucesso!'); 
                    return $this->redirect()->toRoute('home', array('controller' => 'index', 'action' => 'index'));            
                }
                $mensagem = $auth->authenticate()->getMessages();
                    $this->flashMessenger()->addErrorMessage($mensagem[0]);
        }
 
        
      return new ViewModel();
 }
 
 
 
}
