<?php

class registroModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Verifica que el nombre de usuario sea único
     * 
     * @param type $usuario
     */
    public function verificarUsuario($usuario)
    {
        $id = $this->_db->query(
                "SELECT id, codigo from usuarios WHERE username = '$usuario'"
        );

        return $id->fetch();
    }

    /**
     * Verifica que el email de usuario sea único
     * 
     * @param type $email
     */
    public function verificarEmail($email)
    {
        $id = $this->_db->query(
                "SELECT id from usuarios WHERE email = '$email'"
        );

        if ($id->fetch()) {
            return true;
        }

        return false;
    }

    /**
     * Creaun nuevo usuario
     * 
     * @param type $nombre
     * @param type $usuario
     * @param type $password
     * @param type $email
     */
    public function registrarUsuario($nombre, $usuario, $password, $email)
    {
        $args = array(
            ':nombre' => $nombre,
            ':usuario' => $usuario,
            ':password' => $password,
            ':email' => $email
        );

        printFunctionName(__FUNCTION__, __FILE__, $args);

        $random = rand(1000000000, 9999999999);
        put($random, 'random');

        $SQL = "INSERT INTO usuarios VALUES(null, :nombre, :username, :password, :mail, 'usuario', 0, now(), :codigo)";
        $data = array(
            ':nombre' => $nombre,
            ':username' => $usuario,
            ':password' => Hash::getHash('sha1', $password, HASH_KEY),
            ':mail' => $email,
            ':codigo' => $random
        );
        $this->_db->prepare($SQL)
                ->execute($data);
    }
    
    public function getUsuario($id, $codigo)
    {
        $usuario = $this->_db->query(
                "SELECT * FROM usuarios WHERE id = $id AND codigo = $codigo"
                );
        
        return $usuario->fetch();
        
    }
    
    public function activarUsuario($id, $codigo)
    {
        $this->_db->query(
                "UPDATE usuarios SET estado = 1 "
                . "WHERE id = $id AND codigo = $codigo"
                );
    }

}
