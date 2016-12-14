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
        
        $this->_view->titulo = 'Portada';
        $this->_view->renderizar('index');
    }

}
