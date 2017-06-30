<?php

namespace Home\Controller;

use Auth\Controller\AdministradorAbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;

class IndexController extends AdministradorAbstractActionController {

    public function homeAction(){
   
           $auth = new AuthenticationService();
           $identity = $auth->getIdentity();
       return new ViewModel([ 
                'identityComum'=>$identity,
                'identityAdministrador'=>$identity
             
           ]);  
       
   }
}
    
