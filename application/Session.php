<?php

printFileName(__FILE__);

class Session
{

    /**
     * Inicia la sesión
     */
    public static function init()
    {
        session_start();
    }

    /**
     * Destruye sesión o variables de sesión
     * @param type $clave
     */
    public static function destroy($clave = false)
    {
        printFunctionName(__FUNCTION__, __FILE__, $clave);
        if ($clave) {
            if (is_array($clave)) {
                for ($i = 0; $i < count($clave); $i++) {
                    if (isset($_SESSION[$clave[$i]]))
                        unset($_SESSION[$clave[$i]]);
                }
            }
            else {
                if (isset($_SESSION[$clave]))
                    put($clave);
                unset($_SESSION[$clave]);
            }
        }
        else {
            session_destroy();
        }
    }

    /**
     * Establece el valor de una variable de sesión
     * @param type $clave
     * @param type $valor
     */
    public static function set($clave, $valor)
    {
        printFunctionName(__FUNCTION__, __FILE__, array('clave' => $clave, 'valor' => $valor));
        if (!empty($clave))
            $_SESSION[$clave] = $valor;
    }

    /**
     * Devuelve el valor de una variable de sesión
     * @param type $clave
     * @return type
     */
    public static function get($clave = false)
    {
        if ($clave) {
            if (isset($_SESSION[$clave]))
                return $_SESSION[$clave];
        }
        else {
            $r = '';
            foreach ($_SESSION as $key => $value) {
                $r .= '[' . $key . ']: ' . $value . ', ';
            }
            return rtrim($r, ', ');
        }
    }

    //FUNCIONES DE CONTROL DE ACCESO

    /**
     * Devuelve el número correspondiente el nivel indicado
     * 
     * @param type $level
     * @return int
     * @throws Exception
     */
    public static function getLevel($level)
    {
        printFunctionName(__FUNCTION__, __FILE__);
        $role = array(
            'admin' => 3,
            'especial' => 2,
            'usuario' => 1
        );

        if (!array_key_exists($level, $role)) {
            throw new Exception('Error de acceso');
        }
        else {
            return $role[$level];
        }
    }

    /**
     * Controla el acceso de acuerdo al nivel del usuario
     * 
     * @param type $level
     */
    public static function acceso($level)
    {
        printFunctionName(__FUNCTION__, __FILE__, $level);
        if (!Session::get('autenticado')) {
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }

        Session::tiempo();
        if (Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }
    }

    /**
     * 
     * @param type $level
     * @return boolean
     */
    public static function accesoView($level)
    {
        printFunctionName(__FUNCTION__, __FILE__, $level);
        if (!Session::get('autenticado')) {
            return false;
        }

        if (Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
            return false;
        }

        return true;
    }

    /**
     * 
     * @param array $level
     * @param boolean $noAdmin
     */
    public static function accesoEstricto(array $level, $noAdmin = false)
    {
        if (!Session::get('autenticado')) {
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }

        Session::tiempo();

        if ($noAdmin == false) { //Si el admin tiene acceso
            if (Session::get('level') == 'admin') {
                return;
            }
        }
        if (count($level)) {
            if (in_array(Session::get('level'), $level)) {
                return; //Si el nivel del usuario actual está entre los enviados
            }
        }

        header('location:' . BASE_URL . 'error/access/5050');
    }

    /**
     * 
     * @param array $level
     * @param boolean $noAdmin
     */
    public static function accesoViewEstricto(array $level, $noAdmin = false)
    {
        if (!Session::get('autenticado')) {
            return false;
        }
        if ($noAdmin == false) { //Si el admin tiene acceso
            if (Session::get('level') == 'admin') {
                return true;
            }
        }
        if (count($level)) {
            if (in_array(Session::get('level'), $level)) {
                return true; //Si el nivel del usuario actual está entre los enviados
            }
        }

        return false;
    }

    public static function tiempo()
    {
        if (!Session::get('tiempo') || !defined('SESSION_TIME')) {
            throw new Exception('No se ha definido el tiempo de sesión');
        }

        if (SESSION_TIME == 0) { //las sesiones no caducan
            return;
        }

        if (time() - Session::get('tiempo') > SESSION_TIME * 60) {
            Session::destroy();
            header('location:' . BASE_URL . 'error/access/8080');
        }
        else {
            Session::set('tiempo', time());
        }
    }

}
