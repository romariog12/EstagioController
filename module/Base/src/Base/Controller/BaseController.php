<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
class BaseController extends AbstractActionController
{
    public function dadosAction(){
             $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $lista = $em->getRepository("Base\Entity\Dados")->findAll();
            $quantidadeCursos = count($lista);
            $request = $this->getRequest();
           
            if($request ->isPost()){  
                $curso = [];
                        $quantidade = [];
                        $meta = [];
                        $selectCurso = [];
                         $orientador = [];
                        for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                            $curso[$count]= $request->getPost($count);
                            $quantidade[$count] = $request->getPost("GV-".$count);
                            $meta[$count] = $request->getPost(100 + $count);
                            $orientador [$count] =  $request->getPost("orientador".$count);
                            $selectCurso[$count] = $em ->find("Base\Entity\Dados", $count);     
                            $selectCurso[$count]->setCurso($curso[$count]);
                            $selectCurso[$count]->setQuantidadealunos($quantidade[$count]);
                            $selectCurso[$count]->setMeta($meta[$count]);
                             $selectCurso[$count]->setOrientador($orientador[$count]);
                            $em->persist($selectCurso[$count]);
                            $em->flush();
                            
                        }
            }
      return new ViewModel([
                'lista'=>$lista,
          
            ]);
    }
      
    public function logoutAction(){
       unset($this->session()->administrador);
       unset($this->session()->comum);
       return $this->redirect()->toUrl('http://127.0.0.1/Projem/public/login');
    }
}
