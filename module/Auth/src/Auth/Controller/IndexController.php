<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Model\Constantes;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */

class IndexController extends AbstractActionController
{
    public function loginAction() { 
    $request = $this->getRequest();
    if($request->isPost()){ 
        $data = $this->params()->fromPost();
        $auth = $this->getServiceLocator()->get(Constantes::AuthenticationService);
        $adapter = $auth->getAdapter();
        $login = $data['login'];
        $senha = $data['senha'];     
        $adapter->setLogin($login)
                ->setSenha($senha);
        if($auth->authenticate()->isValid()) {
            return $this->redirect()->toRoute('home', ['controller' => Constantes::administrador, 'action' => Constantes::home]); 
        } 
        return new ViewModel([ 'mensagem'=> $auth->getAdapter()->authenticate()->getMessages()[0]]);
    }
 }
 public function loginAlunoAction(){
    $request = $this->getRequest();
    if($request->isPost()){ 
        $data = $this->params()->fromPost();
        $auth = $this->getServiceLocator()->get(Constantes::AuthenticationService);
        $adapter = $auth->getAdapter();
        $cpf = $data['login'];
        $senha = $data['senha'];     
        $adapter->setCpf($cpf)
                ->setSenha($senha);
        if ($auth->authenticate()->isValid()) {
            return $this->redirect()->toRoute('auth');  
        }
            return new ViewModel(['mensagem'=> $auth->getAdapter()->authenticate()->getMessages()[0]]);
    }
 }
  public function loginEmpresaAction(){
    $request = $this->getRequest();
    if($request->isPost())
    { 
        $data = $this->params()->fromPost();
        $auth = $this->getServiceLocator()->get(Constantes::AuthenticationService);
        $adapter = $auth->getAdapter();
        $cnpj = $data['login'];
        $senha = $data['senha'];     
        $adapter->setCnpj($cnpj)
                ->setSenha($senha);
        if ($auth->authenticate()->isValid()) {
            return $this->redirect()->toRoute(Constantes::painelEmpresaDefault ,['controller' => Constantes::empresa,'action'=>Constantes::painelEmpresaEstagiando,'id'=>'1']);    
        } 
      return new ViewModel(['mensagem'=> $auth->getAdapter()->authenticate()->getMessages()[0]]);
    }
  }
}
