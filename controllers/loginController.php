<?php

class loginController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Session::set('autenticado', true);
        Session::set('level', 'usuario');
        Session::set('var1', 'var1');
        Session::set('var2', 'var2');

        $this->redireccionar('login/mostrar');
    }

    public function mostrar()
    {
        put(Session::get('autenticado'), 'Autenticado', TRUE);
        put(Session::get('level'), 'Level', TRUE);
        put(Session::get('var1'), 'var1', TRUE);
        put(Session::get('var2'), 'var2', TRUE);
        put(Session::get(), 'Session', TRUE);
//        echo Session::get();
        exit;
    }

    public function cerrar()
    {
        Session::destroy(array('var1', 'var2'));
        $this->redireccionar('login/mostrar');
    }

}
