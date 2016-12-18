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

    public function getUsuario($id)
    {
        printFunctionName(__METHOD__, __FILE__);

        $id = (int) $id;

        $usuarios = $this->_db->query("SELECT * FROM usuario WHERE id=$id");

        return $usuarios->fetch();
    }

    public function editarUsuario($id, $username, $password)
    {
        printFunctionName(__METHOD__, __FILE__);

        $id = (int) $id;

        $this->_db->prepare("UPDATE usuario SET username = :username, password = :password WHERE id = :id")
                ->execute(
                        array(
                            ':id' => $id,
                            ':username' => $username,
                            ':password' => $password
        ));
    }

    public function insertarUsuario($username, $password)
    {
        printFunctionName(__METHOD__, __FILE__);

        $this->_db->prepare("INSERT INTO usuario VALUES(null, :username, :password)")
                ->execute(
                        array(
                            ':username' => $username,
                            ':password' => $password
        ));
    }

    public function eliminarUsuario($id)
    {
        printFunctionName(__METHOD__, __FILE__);

        $id = (int) $id;

        $this->_db->query("DELETE FROM usuario WHERE id = $id");
    }

    //FUNCIONES PARA DEV
    public function nuevoUsuarioAuto()
    {
        $nombres = array('María', 'Laura', 'Cristina', 'Marta', 'Sara', 'Andrea',
            'Ana', 'Alba', 'Paula', 'Sandra', 'David', 'Alejandro', 'Daniel',
            'Javier', 'Sergio', 'Adrián', 'Carlos', 'Pablo', 'Álvaro',);
        $apellidos = array(
            'Alonso', 'Álvarez', 'Blanco', 'Calvo', 'Cano',
            'Castillo', 'Castro', 'Delgado', 'Díaz', 'Díez',
            'Domínguez', 'Fernández', 'García', 'Garrido', 'Gil',
            'Gómez', 'González', 'Gutiérrez', 'Hernández', 'Iglesias',
            'Jiménez', 'López', 'Lozano', 'Marín', 'Martín',
            'Martínez', 'Medina', 'Molina', 'Morales', 'Moreno',
            'Muñoz', 'Navarro', 'Núñez', 'Ortega', 'Ortiz',
            'Pérez', 'Prieto', 'Ramírez', 'Ramos', 'Rodríguez',
            'Romero', 'Rubio', 'Ruiz', 'Sánchez', 'Santos',
            'Sanz', 'Serrano', 'Suárez', 'Torres', 'Vázquez'
        );
        $nombre = $nombres[rand(0, count($nombres))];
        $apellido = $apellidos[rand(0, count($apellidos))];
/*
        $rand = rand(0, 99999999);
        $id_rol = rand(1, 3);
        $mail = limpiar(strtolower($nombre)) . $rand . "@" . limpiar(strtolower($apellido)) . '.com';
        $tel = rand(600000000, 799999999);

        $codigo = rand(11111111, 99999999);
        $SQL = "INSERT INTO usuario(id_rol, nombre, apellidos, username, password, email, telefono, estado, fecha_creacion,codigo)"
        . "VALUES($id_rol, '$nombre', '$apellido','user" . $rand . "','" . Hash::getHash('sha1',
                        '1234', HASH_KEY) . "',' $mail ','" . $tel . "',1,now(),$codigo)";
//        $this->_db->query($SQL);
  */      
        
        
        $username = substr($nombre,0,3) . "_" . substr($apellido, 0, 5);
        $options = array(
            'min_long' => 10,
            'max_long' => 20
        );
        $password = createPassword($options);
        $SQL = "INSERT INTO usuario VALUES(null, :username, :password)";
        
        $this->_db->prepare("INSERT INTO usuario VALUES(null, :username, :password)")
                ->execute(
                        array(
                            ':username' => $username,
                            ':password' => $password
        ));
    }

}
