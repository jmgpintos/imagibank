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
        printLogLine($msg, $label);
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
        put($msg, $label, TRUE);
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

    function vardump($msg = null, $label = '', $alwaysShow = false)
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

if (!function_exists('printLogLine')) {

    function printLogLine($msg = 'xxx', $label = '')
    {
        if (defined('APP_NAME')) {
            $appName = APP_NAME;
        }
        else {
            $appName = '';
        }
        if (LOG) {
            if (strlen($label) > 0) {
                $msg = $label . ': ' . $msg;
            }

            $logLine = "[" . date("D M j G:i:s T Y") . "]";
            $logLine .=': ' . $appName . " - " . $msg . "\n";
            file_put_contents('php://stderr', print_r($logLine, TRUE));
        }
    }

}

if (!function_exists('loadFile')) {

    function loadFile($filename, $error = '')
    {
        if (is_readable($filename)) {
            require_once $filename;
        }
        else {
            throw new Exception($error . ' - ' . $filename);
        }
    }

}

if (!function_exists('getArrayElement')) {

    function getArrayElement($array, $element)
    {
        if(isset($array[$element]) && count($array[$element])){
            return $array[$element];
        }
        else{
            return null;
        }
    }

}




printFileName(__FILE__);
