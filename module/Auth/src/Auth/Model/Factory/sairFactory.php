<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Model\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\Authentication\AuthenticationService;

/**
 * Description of sairFactory
 *
 * @author romario
 */
class sairFactory {
    public function createService() {
           $auth = new AuthenticationService();
           if(empty($auth->hasIdentity())){
            return $this->redirect()->toUrl('http://127.0.0.1/Projem_/public/login');
           }
    }

//put your code here
}
