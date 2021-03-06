<?php

printFileName(__FILE__);

abstract class Controller
{

    protected $_view;

    public function __construct()
    {
        $this->_view = new View(new Request);
    }

    abstract public function index(); //Todas las clases hijas deben implementar un método index

    protected function loadModel($modelo)
    {
        $modelo = $modelo . 'Model';
        $rutaModelo = ROOT . 'models' . DS . $modelo . '.php';

        if (is_readable($rutaModelo)) {
            require_once $rutaModelo;
            $modelo = new $modelo;
            return $modelo;
        }
        else {
            throw new Exception('Error de modelo');
        }
    }

    protected function getLibrary($libreria)
    {
        printFunctionName(__METHOD__, __FILE__);

        $rutaLibreria = ROOT . 'libs' . DS . $libreria . '.php';

        loadFile($rutaLibreria, 'Error al cargar la librería ' . $libreria);
    }

    //FUNCIONES PARA FILTRAR $_POST
    /**
     * Toma una variable de texto pasado por $_POST y la filtra
     * @param type $clave
     */
    protected function getTexto($clave)
    {
        printFunctionName(__METHOD__, __FILE__);

        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
            return $_POST[$clave];
        }

        return '';
    }

    /**
     * 
     * Toma una variable entera pasado por $_POST y la filtra
     * @param int $clave
     */
    protected function getInt($clave)
    {
        printFunctionName(__METHOD__, __FILE__);

        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
            return $_POST[$clave];
        }

        return 0;
    }

    protected function getSql($clave)
    {
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = strip_tags($_POST[$clave]);

            if (!get_magic_quotes_gpc()) {
                $_POST[$clave] = mysql_escape_string($_POST[$clave]);
            }

            return trim($_POST[$clave]);
        }
    }

    protected function getAlphaNum($clave)
    {

        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }
    }

    /**
     * Devuelve el valor de la clave $_POST sin filtrar, para ser utilizada en un db->prepare()
     * @param String $clave
     * @return type
     */
    protected function getPostParam($clave)
    {

        if (isset($_POST[$clave])) {
            return $_POST[$clave];
        }
    }

    //FUNCIONES PARA FILTRAR ARGUMENTOS EN URL
    /**
     * Los argumentos viene como cadenas. Esta función lo convierte en int
     * @param String $int
     * @return int
     */
    protected function filtrarInt($int)
    {
        printFunctionName(__METHOD__, __FILE__);

        $int = (int) $int;

        if (is_integer($int)) {
            return $int;
        }
        else {
            return 0;
        }
    }

    /**
     * redirecciona a la ruta indicada o a HOME
     * @param type $ruta
     */
    protected function redireccionar($ruta = false)
    {
        printFunctionName(__METHOD__, __FILE__, $ruta);

        if ($ruta) {
            header('location:' . BASE_URL . $ruta);
        }
        else {
            header('location:' . BASE_URL);
        }
    }

    
    public function validarEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        return true;
    }
}
