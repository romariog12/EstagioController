<<<<<<< HEAD
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Model;

/**
 * Description of Nivel
 *
 * @author romario
 */
class Nivel {
    
    const administrador = '1';
    const usuarioComum = '2';
    
    public static function getAdministrador(){
        return self::administrador;
    }
    
    public static function getUsuarioComum(){
        return self::usuarioComum;
    }
    
}
=======
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Model;

/**
 * Description of Nivel
 *
 * @author romario
 */
class Nivel {
    
    const administrador = '1';
    const usuarioComum = '2';
    
    public static function getAdministrador(){
        return self::administrador;
    }
    
    public static function getUsuarioComum(){
        return self::usuarioComum;
    }
    
}
>>>>>>> origin/master
