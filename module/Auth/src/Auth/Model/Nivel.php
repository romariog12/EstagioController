<?php

namespace Auth\Model;

/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
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