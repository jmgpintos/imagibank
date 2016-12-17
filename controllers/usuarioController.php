<?php

printFileName(__FILE__);

class usuarioController extends Controller
{

    private $_usuario;

    public function __construct()
    {
        parent::__construct();
        $this->_usuario = $this->loadModel('usuario');
    }

    public function index()
    {
        printFunctionName(__METHOD__, __FILE__);


        $this->_view->usuarios = $this->_usuario->getUsuarios();
        $this->_view->titulo = 'Usuarios';
        $this->_view->renderizar('index', 'usuario');
    }

    public function nuevo()
    {
        $this->_view->titulo = 'Nuevo usuario';

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('username')) {
                $this->_view->_error = 'Debe introducir el nombre de usuario';
                $this->_view->renderizar('nuevo', 'usuario');
                exit;
            }

            if (!$this->getTexto('password')) {
                $this->_view->_error = 'Debe introducir el password del usuario';
                $this->_view->renderizar('nuevo', 'usuario');
                exit;
            }

            $this->_usuario->insertarUsuario(
                    $this->getTexto('username'), $this->getTexto('password')
            );
            $this->redireccionar('usuario');
        }

        $this->_view->renderizar('nuevo', 'usuario');
    }

}
