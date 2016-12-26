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
                "SELECT id from usuarios WHERE username = '$usuario'"
        );

        if ($id->fetch()) {
            return true;
        }

        return false;
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

    public function registrarUsuario($nombre, $usuario, $password, $email)
    {
        $args = array(
            ':nombre' => $nombre,
            ':usuario' => $usuario,
            ':password' => $password,
            ':email' => $email
        );

        printFunctionName(__FUNCTION__, __FILE__, $args);



        $SQL = "INSERT INTO usuarios VALUES(null, :nombre, :username, :password, :mail, 'usuario', 1, now())";
        $data = array(
            ':nombre' => $nombre,
            ':username' => $usuario,
            ':password' => Hash::getHash('sha1', $password, HASH_KEY),
            ':mail' => $email
        );
        $this->_db->prepare($SQL)
                ->execute($data);
    }

}
