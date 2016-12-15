<?php

printFileName(__FILE__);

class indexController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        printFunctionName(__METHOD__, __FILE__);
        
        $usuario= $this->loadModel('usuario');
        
        $this->_view->usuarios = $usuario->getUsuarios();
        $this->_view->titulo = 'Portada';
        $this->_view->renderizar('index');
    }

}
