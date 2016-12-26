<?php

class loginController extends Controller
{

    private $_login;

    public function __construct()
    {
        parent::__construct();
        $this->_login = $this->loadModel('login');
    }

    public function index()
    {
        if(Session::get('autenticado')) {
            $this->redireccionar();
        }
        $this->_view->titulo = 'Iniciar sesión';

        if ($this->getInt('enviar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getAlphaNum('usuario')) {
                $this->_view->_error = 'Debe introducir su nombre de usuario';
                $this->_view->renderizar('index', 'login');
                exit;
            }

            if (!$this->getSql('password')) {
                $this->_view->_error = 'Debe introducir su contraseña';
                $this->_view->renderizar('index', 'login');
                exit;
            }

            $row = $this->_login->getUsuario(
                    $this->getAlphaNum('usuario'), $this->getSql('password')
            );
            
            if(!$row){
                $this->_view->_error = 'Usuario y/o contraseña incorrecto';
                $this->_view->renderizar('index', 'login');
                exit;                
            }
            vardump($row);
            if($row['estado'] != 1) {
                $this->_view->_error = 'Este usuario no está habilitado';
                $this->_view->renderizar('index', 'login');
                exit;
            }
            
            Session::set('autenticado', true);
            Session::set('level', $row['role']);
            Session::set('username', $row['username']);
            Session::set('id_usuario', $row['id']);
            Session::set('tiempo', time());
                        
            $this->redireccionar();
        }

        $this->_view->renderizar('index', 'login');
    }

    public function cerrar()
    {
        Session::destroy();
        $this->redireccionar();
    }

}
