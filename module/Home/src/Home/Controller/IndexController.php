<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $findCurso = $em->getRepository("Aluno\Entity\Aluno")->findAll();
            $findEmpresa = $em->getRepository("Empresa\Entity\Empresa")->findAll();
            $recisaoRow1 = $em->getRepository("Vaga\Entity\Vaga")->findByRecisao('');
            $recisaoRow2 = $em->getRepository("Vaga\Entity\Vaga")->findByRecisao('-');
            $row = count($findCurso);
            $rowRecisao1 = count($recisaoRow1); 
            $rowRecisao2 = count($recisaoRow2);
            $rowRecisao = $rowRecisao2 + $rowRecisao1;
            $rowEmpresa = count($findEmpresa);
        return new ViewModel([
            'fetchRow'=>$findCurso,
            'row'=> $row,
            'recisaoRow'=>$rowRecisao,
            'rowEmpresa' =>$rowEmpresa
        ]);
 
   }
   }
    
