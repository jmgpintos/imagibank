<?php

printFileName(__FILE__);

class Bootstrap
{

    public static function run(Request $peticion)
    {
        $controller = $peticion->getControlador() . 'Controller';
        $rutaControlador = ROOT . 'controllers' . DS . $controller . '.php';
        $metodo = $peticion->getMetodo();
        $args = $peticion->getArgs();
        
        if (is_readable($rutaControlador)) {//comprobar si existe el controlador
            require_once $rutaControlador;

            $controlador = new $controller;

            if (is_callable(array($controller, $metodo))) {
                $metodo = $peticion->getMetodo();
            }
            else {
                $metodo = 'index';
            }

            if (isset($args) ) {
                call_user_func_array(array($controlador, $metodo), $args);
            }
            else {
                call_user_func(array($controlador, $metodo));
            }
        }
        else{
            put('ERROR');
            throw new Exception('No encontrado');
        }
    }

}
