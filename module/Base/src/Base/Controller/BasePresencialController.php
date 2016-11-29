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
use Base\Model\Entity;

class BasePresencialController extends AbstractActionController
{
    public function dadosAction(){
             $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get(Entity::em);
            $lista = $em->getRepository(Entity::dadosPresencial)->findAll();
            $quantidadeCursos = count($lista);
            $request = $this->getRequest();
           
           if($request ->isPost()){  
                        $curso = [];
                        $quantidadePresencial = [];
                        $meta = [];
                        $selectCurso = [];
                        $orientador = [];
                        for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                            $curso[$count]= $request->getPost($count);
                            $quantidadePresencial[$count] = $request->getPost("GP-".$count);
                            $meta[$count] = $request->getPost(100 + $count);
                            $orientador [$count] =  $request->getPost("orientador".$count);
                            $selectCurso[$count] = $em ->find(Entity::dadosPresencial, $count);     
                            $selectCurso[$count]->setCurso($curso[$count]);
                            $selectCurso[$count]->setQuantidadealunos($quantidadePresencial[$count]);
                            $selectCurso[$count]->setMeta($meta[$count]);
                            $selectCurso[$count]->setOrientador($orientador[$count]);
                            $em->persist($selectCurso[$count]);
                            $em->flush();     
                        }
            }
      return new ViewModel([
                'listaPresencial'=>$lista,
                'quantidadeCursos'=> $quantidadeCursos
            ]);
    }
}
