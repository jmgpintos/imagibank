<?php

printFileName(__FILE__);
/*
 * Las diferentes vistas NO heredan de este archivo, porque las vistas no son instanciadas, pero necesitamos un objeto que nos facilite el trabajo con las vistas. Ese es el objeto de esta clase
 */

class View
{

    private $_controlador;

    public function __construct(Request $peticion)
    {
        printFunctionName(__METHOD__, __FILE__);
        $this->_controlador = $peticion->getControlador();
    }

    public function renderizar($vista, $item = false)
    {
        printFunctionName(__METHOD__, __FILE__);
        
        $menu = array(
          array(
              'id' => 'inicio',
              'titulo' => 'Inicio',
              'enlace' => BASE_URL
          ),
          array(
              'id' => 'hola',
              'titulo' => 'Hola',
              'enlace' => BASE_URL. 'hola'
          )  
        );

        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'menu' => $menu
        );

        $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';

        if (is_readable($rutaView)) {
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            include_once $rutaView;
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        }
        else {
            throw new Exception("No existe la vista: " . $rutaView);
        }
    }

}
