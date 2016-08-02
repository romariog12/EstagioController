<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aluno\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Perfil\Entity\Perfil;

class AlunoController extends AbstractActionController
{
    
    public function cadastrarAction() {
       if(!isset($this->session()->item)){
           $this->redirect()->toUrl('http://127.0.0.1/Projem/public/login');
       }
          $request = $this->getRequest();
          $result = array();
          if($request->isPost())
          {         
               try{  
                $nome = $request->getPost("nome");
                $curso = $request->getPost("curso");
                $matricula = $request->getPost("matricula");

                $aluno = new \Aluno\Entity\Aluno();
                $aluno->setAdministradorIdadministrador("0");
                $aluno->setNome($nome);
                $aluno->setCurso($curso);
                $aluno->setMatricula($matricula);
                    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                    $em->persist($aluno);
                    $em->flush(); 
                    $perfil = new Perfil();
                        $em->persist($perfil);
                        $em->flush();                
                  
          }catch (Exception $e){
              echo $this->flashMessenger()->render();
          }         
         }
    
        return new ViewModel($result);
    }
}
