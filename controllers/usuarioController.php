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

    public function index($pagina = false)
    {
        printFunctionName(__METHOD__, __FILE__, array('pagina' => $pagina));

        if (!$this->filtrarInt($pagina)) {
            $pagina = false;
        }
        else {
            $pagina = (int) $pagina;
        }

        $this->getLibrary('paginador');
        $paginador = new Paginador();
        $this->_view->assign('usuarios' , $paginador->paginar($this->_usuario->getUsuarios(), $pagina));
        $this->_view->assign('paginacion', $paginador->getView('paginacion', 'usuario/index'));
        $this->_view->assign('titulo', 'Usuarios');
        $this->_view->renderizar('index', 'usuario');
    }

    public function nuevo()
    {
        printFunctionName(__METHOD__, __FILE__);
        Session::accesoEstricto(array('usuario'), true);

        $this->_view->titulo = 'Nuevo usuario';
        $this->_view->setJs(array('nuevo'));

        if ($this->getInt('guardar') == 1) {
            $this->_view->assign('datos', $_POST);

            if (!$this->getTexto('username')) {
                $this->_view->assign('_error', 'Debe introducir el nombre de usuario');
                $this->_view->renderizar('nuevo', 'usuario');
                exit;
            }

            if (!$this->getTexto('password')) {
                $this->_view->assign('_error', 'Debe introducir el password del usuario');
                $this->_view->renderizar('nuevo', 'usuario');
                exit;
            }

            $this->_usuario->insertarUsuario(
                    $this->getPostParam('username'), $this->getPostParam('password')
            );
            $this->redireccionar('usuario');
        }

        $this->_view->renderizar('nuevo', 'usuario');
    }

    public function editar($id)
    {
        printFunctionName(__METHOD__, __FILE__);

        if (!$this->filtrarInt($id)) {
            $this->redireccionar('usuario');
        }

        if (!$this->_usuario->getUsuario($this->filtrarInt($id))) {
            $this->redireccionar('usuario');
        }

        $this->_view->titulo = 'Editar usuario';
        $this->_view->setJs(array('nuevo'));

        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;

            if (!$this->getTexto('username')) {
                $this->_view->assign('_error', 'Debe introducir el nombre de usuario');
                $this->_view->renderizar('editar', 'usuario');
                exit;
            }

            if (!$this->getTexto('password')) {
                $this->_view->assign('_error' , 'Debe introducir el password del usuario');
                $this->_view->renderizar('editar', 'usuario');
                exit;
            }

            $this->_usuario->editarUsuario(
                    $this->filtrarInt($id), $this->getTexto('username'), $this->getTexto('password')
            );
            $this->redireccionar('usuario');
        }

        $this->_view->assign('datos', $this->_usuario->getUsuario($this->filtrarInt($id)));
        $this->_view->renderizar('editar', 'usuario');
    }

    public function eliminar($id)
    {
        printFunctionName(__METHOD__, __FILE__);

        if (!$this->filtrarInt($id)) {
            $this->redireccionar('usuario');
        }

        if (!$this->_usuario->getUsuario($this->filtrarInt($id))) {
            $this->redireccionar('usuario');
        }

        $this->_usuario->eliminarUsuario($this->filtrarInt($id));

        $this->redireccionar('usuario');
    }

    //METODOS PARA DEV
    /**
     * Crear nuevo usuario automáticamente
     */
    public function crear()
    {
        printFunctionName(__METHOD__, __FILE__);

        $this->_usuario->nuevoUsuarioAuto();

        $this->redireccionar('usuario');
    }

    /**
     * Cambiar código de RAND a UNIQID
     */
    public function editarCodigo()
    {
        printFunctionName(__METHOD__, __FILE__);

        $this->_usuario->editarCodigo();

        $this->redireccionar('usuario');
    }

}
