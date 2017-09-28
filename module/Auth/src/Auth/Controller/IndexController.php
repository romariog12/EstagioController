<?php
namespace Auth\Controller;

use Auth\Controller\AdministradorAbstractActionController;
use Zend\View\Model\ViewModel;
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
            return $this->redirect()->toRoute('home', array('controller' => 'index', 'action' => 'index')); 
        } 
        return new ViewModel([
        'mensagem'=> $auth->getAdapter()->authenticate()->getMessages()[0]
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
                   return $this->redirect()->toRoute('auth');  
                }
              return new ViewModel([
                    'mensagem'=> $auth->getAdapter()->authenticate()->getMessages()[0]
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
                     return $this->redirect()->toRoute('painelEmpresa/default' ,['controller' => 'empresa','action'=>'painelEmpresaEstagiando','id'=>'1']);
                          
                          } 
              return new ViewModel([
                   'mensagem'=> $auth->getAdapter()->authenticate()->getMessages()[0]
                ]
              );
        }
  }
}
