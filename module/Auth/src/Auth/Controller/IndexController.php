<?php
namespace Auth\Controller;

use Auth\Controller\AdministradorAbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
class IndexController extends AdministradorAbstractActionController
{
    const administrador = '1';
    const usuarioComum = '2';
    const empresa = 'u1';
    const aluno = 'u2';
    const instituição = 'u3';
                        
    public function loginAction() { 
    $request = $this->getRequest();
    if($request->isPost())
        { 
                $data = $this->params()->fromPost();
                $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                $adapter = $auth->getAdapter();
                $login = $data['login'];
                $senha = $data['senha'];     
                $adapter->setLogin($login)
                        ->setSenha($senha);
                
                if ($auth->authenticate()->isValid()) {
                    $this->session()->administrador = $auth->authenticate()->getIdentity();
                            return $this->redirect()->toRoute('home', array('controller' => 'index', 'action' => 'index')); 
                } 
              $mensagem = 'Credenciais inválidas' ;
              return new ViewModel([
          'mensagem'=>$mensagem
      ]
              
              );
        }
    
 }
 public function loginAlunoAction(){
    $request = $this->getRequest();
    if($request->isPost())
        { 
                $data = $this->params()->fromPost();
                $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                $adapter = $auth->getAdapter();
                $cpf = $data['login'];
                $senha = $data['senha'];     
                $adapter->setCpf($cpf)
                        ->setSenha($senha);
                
                if ($auth->authenticate()->isValid()) {
                     $this->session()->aluno = $auth->authenticate()->getIdentity();
                   return $this->redirect()->toRoute('auth');  
                } 
              $mensagem = 'Credenciais inválidas' ;
              return new ViewModel([
                    'mensagem'=>$mensagem
                ]
              
              );
        }
    
 }
  public function loginEmpresaAction(){
    $request = $this->getRequest();
    if($request->isPost())
        { 
                $data = $this->params()->fromPost();
                $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                $adapter = $auth->getAdapter();
                $cnpj = $data['login'];
                $senha = $data['senha'];     
                $adapter->setCnpj($cnpj)
                        ->setSenha($senha);
                
                if ($auth->authenticate()->isValid()) {
                    $this->session()->empresa = $auth->authenticate()->getIdentity();
                     return $this->redirect()->toRoute('painelEmpresa/default' ,['controller' => 'empresa','action'=>'painelEmpresaEstagiando','id'=>'1']);
                          
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
        if ($auth->hasIdentity()){
            $auth->clearIdentity();
            $this->flashMessenger()->addSuccessMessage('Voce acabou de ser desconectado!');
        }
        return $this->redirect()->toRoute('auth');    
    }
}
