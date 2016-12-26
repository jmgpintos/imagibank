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
        printFunctionName(__FUNCTION__, __FILE__);
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

            $this->getLibrary("class.phpmailer");
            $mail = new PHPMailer();

            $this->_registro->registrarUsuario(
                    $this->getSql('nombre'), $this->getAlphaNum('usuario'),
                    $this->getSql('password'), $this->getPostParam('email')
            );

            $usuario = $this->_registro->verificarUsuario($this->getAlphaNum('usuario'));

            if (!$usuario) {
                $this->_view->_error = 'Error al registrar el usuario';
                $this->_view->renderizar('index', 'registro');
                exit;
            }

            $mail->From = 'localhost/imagibank';
            $mail->FromName = 'PFC DAW';
            $mail->Subject = 'Alta de nuevo usuario';
            $mail->Body = 'Hola <strong>' . $this->getSql('nombre') . '</strong>,'
                    . '<p>Se ha registrado en imagibank.</p'
                    . '<p>Para activar su cuenta hagsa click sobre el siguiente enlace: <br/>'
                    . '<a href="' . BASE_URL . 'registro/activar/'
                    . $usuario['id'] . '/' . $usuario['codigo'] . '">'
                    . BASE_URL . 'registro/activar/'
                    . $usuario['id'] . '/' . $usuario['codigo'] . '</a>';
            $mail->AltBody = 'Su servidor de correo no soporta HTML';
            $mail->addAddress($this->getPostParam('email'));
            $mail->send();

            $this->_view->datos = false;
            $this->_view->_mensaje = 'Registro completado, revise su correo para activar su cuenta';
        }

        $this->_view->renderizar('index', 'registro');
    }

    public function activar($id, $codigo)
    {
        printFunctionName(__FUNCTION__, __FILE__);
        if (!$this->filtrarInt($id) || !$this->filtrarInt($codigo)) {
            $this->_view->_error = 'Esta cuenta no existe';
            $this->_view->renderizar('activar', 'registro');
            exit;
        }

        $row = $this->_registro->getUsuario(
                $this->filtrarInt($id), $this->filtrarInt($codigo)
        );

        if (!$row) {
            $this->_view->_error = 'Esta cuenta no existe';
            $this->_view->renderizar('activar', 'registro');
            exit;
        }


        if ($row['estado'] == 1) {
            $this->_view->_error = 'Esta cuenta ya ha sido activada';
            $this->_view->renderizar('activar', 'registro');
            exit;
        }

        $this->_registro->activarUsuario
                ($this->filtrarInt($id), $this->filtrarInt($codigo)
        );

        $row = $this->_registro->getUsuario(
                $this->filtrarInt($id), $this->filtrarInt($codigo)
        );

        if ($row['estado'] == 0) {
            $this->_view->_error = 'Error al activar la cuenta';
            $this->_view->renderizar('activar', 'registro');
            exit;
        }

        $this->_view->_mensaje = 'Cuenta activada correctamente';
        $this->_view->renderizar('activar', 'registro');
    }

}
