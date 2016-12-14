<?php

/**
 * HELPER 
 * 
 * Funciones de propósito general
 */
/**
 * Mostrar mensaje de DEBUG en pantalla
 * 
 * $msg: string mensaje a mostrar
 * $label: string (opcional) etiqueta
 * 
 */
if (!function_exists('put')) {

    function put($msg = 'xxx', $label = '', $alwaysShow = false)
    {
        if (DEBUG || $alwaysShow) {
            echo "<pre>";
            if (strlen($label) > 0) {
                echo "<strong>$label: </strong>";
            }
            echo "$msg</pre>\n";
        }
    }

}


/**
 * Mostrar mensaje de DEBUG en pantalla y finalizar la ejecución
 * 
 * $msg: string mensaje a mostrar
 * $label: string (opcional) etiqueta
 * 
 */
if (!function_exists('puty')) {

    function puty($msg, $label = '')
    {
        put($msg, $label);
        exit;
    }

}


/**
 * Mostrar mensaje de DEBUG en pantalla
 * 
 * $msg: array mensaje a mostrar
 * 
 */
if (!function_exists('vardump')) {

    function vardump($msg = null, $label ='', $alwaysShow = false)
    {
        if (DEBUG || $alwaysShow) {
            $args = func_get_args();
            if (is_string($msg)) {
                array_shift($args); // remove msg from the args array
                $msg = "<b>$msg</b>\n";
            }
            else {
                $msg = "";
            }


            echo "<pre>";
            if (strlen($label) > 0) {
                echo "<strong>$label: </strong>";
            }
            echo $msg;
            var_dump($args);
            echo "</pre>";
        }
    }

}


/**
 * Mostrar mensaje de DEBUG en pantalla y finalizar la ejecución
 * 
 * $msg: array mensaje a mostrar
 * 
 */
if (!function_exists('vardumpy')) {

    function vardumpy($msg = null)
    {
        vardump($msg);
        exit;
    }

}

/**
 * Mostrar mensajes de DEBUG en pantalla  
 * 
 * $msg: array mensaje a mostrar
 * 
 */
if (!function_exists('printFileName')) {

    function printFileName($fileName)
    {
        put($fileName, 'File loaded');
    }

}

if (!function_exists('printFunctionName')) {

    function printFunctionName($functionName, $fileName = '')
    {
        if ($fileName) {
            put($functionName . ' on ' . $fileName, 'function called');
        }
        else {
            put($functionName, 'function called');
        }
    }

}
printFileName(__FILE__);
