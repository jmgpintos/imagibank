<?php

printFileName(__FILE__);

class usuarioModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getUsuarios()
    {
        printFunctionName(__METHOD__, __FILE__);
        
        $usuarios = $this->_db->query("SELECT * FROM usuario");
        
        return $usuarios->fetchAll();
    }
}
