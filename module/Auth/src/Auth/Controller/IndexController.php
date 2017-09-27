<?php
namespace Auth\Controller;

use Auth\Controller\AdministradorAbstractActionController;
use Zend\View\Model\ViewModel;
<<<<<<< HEAD
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
            return $this->redirect()->toRoute('home', array('controller' => 'index', 'action' => 'index')); 
        } 
        return new ViewModel([
        'mensagem'=> $auth->getAdapter()->authenticate()->getMessages()[0]
      ]
              
              );
        }
    
 }
 public function loginAlunoAction(){
=======
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
    
>>>>>>> origin/master
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
<<<<<<< HEAD
                   return $this->redirect()->toRoute('auth');  
                }
=======
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
>>>>>>> origin/master
              return new ViewModel([
                    'mensagem'=> $auth->getAdapter()->authenticate()->getMessages()[0]
                ]
              
              );
        }
    
 }
<<<<<<< HEAD
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
=======
 public function logoutAction(){
     $auth = new AuthenticationService();
     
        if ($auth->hasIdentity()) {
            $auth->clearIdentity();
            $this->flashMessenger()->addSuccessMessage('Voce acabou de ser desconectado!');
        }
        return $this->redirect()->toRoute('home', array('controller' => 'index', 'action' => 'login'));
    }
>>>>>>> origin/master
}
