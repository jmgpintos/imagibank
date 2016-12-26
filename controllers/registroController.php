<?php

class registroController extends Controller
{

    private $_registro;

    public function __construct()
    {
        parent::__construct();
        $this->_registro = $this->loadModel('registro');
    }

    public function index()
    {
        if (Session::get('autenticado')) {
            //Si el usuario está logueado no puede entrar al registro de usuarios
            $this->redireccionar();
        }

        $this->_view->titulo = 'Registro';

        if ($this->getInt('enviar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getSql('nombre')) {
                $this->_view->_error = 'Debe introducir su nombre';
                $this->_view->renderizar('index', 'registro');
                exit;
            }

            if (!$this->getAlphaNum('usuario')) {
                $this->_view->_error = 'Debe introducir su nombre de usuario';
                $this->_view->renderizar('index', 'registro');
                exit;
            }

            if ($this->_registro->verificarUsuario($this->getAlphaNum('usuario'))) {
                $this->_view->_error = 'El usuario ' . $this->getAlphaNum('usuario') . ' ya existe';
                $this->_view->renderizar('index', 'registro');
                exit;
            }

            if (!$this->validarEmail($this->getPostParam('email'))) {
                $this->_view->_error = 'La dirección de email no es válida';
                $this->_view->renderizar('index', 'registro');
                exit;
            }

            if ($this->_registro->verificarEmail($this->getPostParam('email'))) {
                $this->_view->_error = 'Esta dirección de email ya está en uso';
                $this->_view->renderizar('index', 'registro');
                exit;
            }

            if (!$this->getSql('password')) {
                $this->_view->_error = 'Debe introducir su password';
                $this->_view->renderizar('index', 'registro');
                exit;
            }

            if (!$this->getPostParam('password') != $this->getPostParam('confirma')) {
                $this->_view->_error = 'Las contraseñas no coinciden';
                $this->_view->renderizar('index', 'registro');
                exit;
            }

            $this->_registro->registrarUsuario(
                    $this->getSql('nombre'), $this->getAlphaNum('usuario'),
                    $this->getSql('password'), $this->getPostParam('email'));

            if (!$this->_registro->verificarUsuario($this->getAlphaNum('usuario'))) {
                $this->_view->_error = 'Error al registrar el usuario';
                $this->_view->renderizar('index', 'registro');
            }

            $this->_view->datos = false;
            $this->_view->_mensaje = 'Registro completado';
        }

        $this->_view->renderizar('index', 'registro');
    }

}
