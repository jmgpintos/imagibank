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
        
        if(is_readable($rutaModelo)) {
            require_once $rutaModelo;
            $modelo = new $modelo;
            return $modelo;
        }
        else{
            throw new Exception('Error de modelo');
        }
    }

}
