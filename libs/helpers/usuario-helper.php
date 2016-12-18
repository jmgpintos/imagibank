<?php

/*
 * Funciones utilizadas por usuarioModel
 */

if (!function_exists('createPassword')) {

    /**
     * 
     * @param type $options
     * @return string
     */
    function createPassword($options)
    {
        $letras = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        $totalLetras = count($letras) - 1;
        $sym = array("`", "~", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "-", "+", "=", "{", "}", "[", "]");
        $totalSym = count($sym) - 1;

        $pw = "";

        $min_long = getArrayElement($options, 'min_long');
        $max_long = getArrayElement($options, 'max_long');

        if (!$min_long)
            $min_long = 4;

        if (!$max_long)
            $max_long = 12;

        $long = rand($min_long, $max_long);
//        echo 'long: ' . $long . "\t";

        for ($i = 0; $i < $long; $i++) {

            $l = $letras[rand(0, $totalLetras)];
            if ((rand(0, 1000) % 4) == 0) {
                $l = strtoupper($l);
            }
            if ((rand(0, 1000) % 25) == 0) {
                $l = rand(0, 9);
            }
            if ((rand(0, 1000) % 50) == 0) {
                $l = $sym[rand(0, $totalSym)];
            }

            $pw.=$l;
        }

        return $pw;
    }

}


printFileName(__FILE__);