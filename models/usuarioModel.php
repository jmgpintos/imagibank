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

        $usuarios = $this->_db->query("SELECT * FROM usuarios");

        return $usuarios->fetchAll();
    }

    public function getUsuario($id)
    {
        printFunctionName(__METHOD__, __FILE__);

        $id = (int) $id;

        $usuarios = $this->_db->query("SELECT * FROM usuarios WHERE id=$id");

        return $usuarios->fetch();
    }

    public function editarUsuario($id, $username, $password)
    {
        printFunctionName(__METHOD__, __FILE__);

        $id = (int) $id;

        $this->_db->prepare("UPDATE usuarios SET username = :username, password = :password WHERE id = :id")
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

        $this->_db->prepare("INSERT INTO usuarios VALUES(null, :username, :password)")
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

        $this->_db->query("DELETE FROM usuarios WHERE id = $id");
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
        $nombreCompleto = $nombre . ' ' . $apellido;
        $rand = rand(0, 99999999);
        $id_rol = rand(1, 3);
        $mail = limpiarCadena(strtolower($nombre)) . $rand . "@" . limpiarCadena(strtolower($apellido)) . '.com';
        /*
          $tel = rand(600000000, 799999999);

          $codigo = rand(11111111, 99999999);
          $SQL = "INSERT INTO usuario(id_rol, nombre, apellidos, username, password, email, telefono, estado, fecha_creacion,codigo)"
          . "VALUES($id_rol, '$nombre', '$apellido','user" . $rand . "','" . Hash::getHash('sha1',
          '1234', HASH_KEY) . "',' $mail ','" . $tel . "',1,now(),$codigo)";
          //        $this->_db->query($SQL);
         */


        $username = substr($nombre, 0, 3) . "_" . substr($apellido, 0, 5);
        $options = array(
            'min_long' => 10,
            'max_long' => 20
        );
        $password = md5(createPassword($options));
        $random = uniqid();
        $SQL = "INSERT INTO usuarios VALUES(null, :nombre, :username, :password, :mail, 'usuario', 1, now(), :codigo)";
        put($SQL);
        put($nombreCompleto, 'nombre');
        put($username, 'username');
        put($password, 'password');
        put($mail, 'mail');
        put($random, 'random');
        $data = array(
            ':nombre' => $nombreCompleto,
            ':username' => $username,
            ':password' => $password,
            ':mail' => $mail,
            ':codigo' => $random
        );
        vardump($data);
        $this->_db->prepare($SQL)
                ->execute($data);
    }

    /**
     * Cambiar código de RAND a UNIQID
     */
    public function editarCodigo()
    {
        printFunctionName(__METHOD__, __FILE__);
        $rows = $this->_db->query('SELECT * FROM usuarios');

        foreach ($rows as $row) {
            put('Editando registro con id ' . $row['id']);
            $sql = "UPDATE usuarios SET codigo = '" . uniqid() . "' WHERE id = " . $row['id'];
            $rows = $this->_db->query($sql);
        }
    }

}
