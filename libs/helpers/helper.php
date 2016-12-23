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

    function printFunctionName($functionName, $fileName = '', $params = false)
    {
        $args = '';
        if ($params) {
            $args = ' with arguments:';
            if (is_array($params)) {
                foreach ($params as $key => $value) {
                    $args .='[' . $key . ']: ' . $value . ', ';
                }
                $args = rtrim($args, ', ');
            }
            else {
                $args .= $params;
            }
        }
        if ($fileName) {
            put($functionName . ' on ' . $fileName . $args, 'function called');
        }
        else {
            put($functionName . $args, 'function called');
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
        if (isset($array[$element]) && count($array[$element])) {
            return $array[$element];
        }
        else {
            return null;
        }
    }

}


if (!function_exists('limpiarCadena')) {

    function limpiarCadena($String)
    {
        $String = str_replace(array('á', 'à', 'â', 'ã', 'ª', 'ä'), "a", $String);
        $String = str_replace(array('Á', 'À', 'Â', 'Ã', 'Ä'), "A", $String);
        $String = str_replace(array('Í', 'Ì', 'Î', 'Ï'), "I", $String);
        $String = str_replace(array('í', 'ì', 'î', 'ï'), "i", $String);
        $String = str_replace(array('é', 'è', 'ê', 'ë'), "e", $String);
        $String = str_replace(array('É', 'È', 'Ê', 'Ë'), "E", $String);
        $String = str_replace(array('ó', 'ò', 'ô', 'õ', 'ö', 'º'), "o", $String);
        $String = str_replace(array('Ó', 'Ò', 'Ô', 'Õ', 'Ö'), "O", $String);
        $String = str_replace(array('ú', 'ù', 'û', 'ü'), "u", $String);
        $String = str_replace(array('Ú', 'Ù', 'Û', 'Ü'), "U", $String);
        $String = str_replace(array('[', '^', '´', '`', '¨', '~', ']'), "", $String);
        $String = str_replace("ç", "c", $String);
        $String = str_replace("Ç", "C", $String);
        $String = str_replace("ñ", "n", $String);
        $String = str_replace("Ñ", "N", $String);
        $String = str_replace("Ý", "Y", $String);
        $String = str_replace("ý", "y", $String);

        $String = str_replace("&aacute;", "a", $String);
        $String = str_replace("&Aacute;", "A", $String);
        $String = str_replace("&eacute;", "e", $String);
        $String = str_replace("&Eacute;", "E", $String);
        $String = str_replace("&iacute;", "i", $String);
        $String = str_replace("&Iacute;", "I", $String);
        $String = str_replace("&oacute;", "o", $String);
        $String = str_replace("&Oacute;", "O", $String);
        $String = str_replace("&uacute;", "u", $String);
        $String = str_replace("&Uacute;", "U", $String);
        return $String;
    }

}




printFileName(__FILE__);
