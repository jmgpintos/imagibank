<?php

define('DEBUG', false); //para ver en el navegador los mensajes de debug
define('LOG', true); //para enviar a /var/log/apache2/error.log los mensajes de debug
define('DS', DIRECTORY_SEPARATOR);

//Ruta raíz de la aplicación ('/var/www/html/imagibank/')
//Para incluir archivos desde el servidor
define('ROOT', realpath(dirname(__FILE__)) . DS);
//-directorio de los archivos de aplicación
define('APP_PATH', ROOT . 'application' . DS);
define('LIB_PATH', ROOT . 'libs' . DS);

try {
    require_once LIB_PATH . 'helpers/helper.php';
    require_once LIB_PATH . 'helpers/usuario-helper.php';

    require_once APP_PATH . 'Config.php';
    require_once APP_PATH . 'Request.php';
    require_once APP_PATH . 'Bootstrap.php';
    require_once APP_PATH . 'Controller.php';
    require_once APP_PATH . 'Model.php';
    require_once APP_PATH . 'View.php';
    require_once APP_PATH . 'Registro.php';
    require_once APP_PATH . 'Database.php';
    require_once APP_PATH . 'Session.php';
    require_once APP_PATH . 'Hash.php';
    
//    puty(Hash::getHash('md5', '1234', HASH_KEY));

    Session::init();

    Bootstrap::run(new Request());
} catch (Exception $e) {
    put($e->getMessage(), '', TRUE);
}