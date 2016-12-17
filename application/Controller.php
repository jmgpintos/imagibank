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
        printFunctionName(__FUNCTION__, __FILE__);

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
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
            return $_POST[$clave];
        }

        return 0;
    }

    /**
     * redirecciona a la ruta indicada o a HOME
     * @param type $ruta
     */
    protected function redireccionar($ruta = false)
    {
        if ($ruta) {
            header('location:' . BASE_URL . $ruta);
        }
        else {
            header('location:' . BASE_URL);
        }
    }

}
