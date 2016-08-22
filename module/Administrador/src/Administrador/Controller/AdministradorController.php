<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;




class AdministradorController extends AbstractActionController
{
      public function indexAction()
      {
          $this->sairAction();
          $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
          $request = $this->getRequest();
          if($request->isPost()){
              $nome = $request->getPost("nome");
              $login = $request->getPost("login");
              $senha = $request->getPost("senha");
              $nivel = $request->getPost("nivel");
                $administrador = new \Administrador\Entity\Administrador();
                $administrador->setNome($nome);
                $administrador->setLogin($login);
                $administrador->setSenha($senha);
                $administrador->setNivel($nivel);
                try {
                    
                $em->persist($administrador);
                $em->flush();
      
                } catch (Exception $ex) {
                    
                } 
          }
          
          return new ViewModel();
      }
}
