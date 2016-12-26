<?php

class Paginador
{

    private $_datos;
    private $_paginacion;
    private $_limite = 5;

    public function __construct()
    {
        printFunctionName(__METHOD__, __FILE__);
        $this->_datos = array();
        $this->_paginacion = array();
    }

    /**
     * 
     * @param type $query: resultado de la consulta a paginar (todos los registros)
     * @param type $pagina: pagina actual
     * @param type $limite: registros por página
     * @param type $paginacion
     * @return type
     */
    public function paginar($query, $pagina = false, $limite = false, $paginacion = false)
    {
        printFunctionName(__METHOD__, __FILE__);

        if ($limite && is_numeric($limite)) {
            $limite = $limite;
        }
        else {
            $limite = REGISTROS_POR_PAGINA;
        }

        if ($pagina && is_numeric($pagina)) {
            $pagina = $pagina;
            $inicio = ($pagina - 1) * $limite;
        }
        else {
            $pagina = 1;
            $inicio = 0;
        }

        $total = ceil(count($query) / $limite);
        $this->_datos = array_slice($query, $inicio, $limite);

        $paginacion = array();
        $paginacion['actual'] = $pagina;
        $paginacion['total'] = $total;

        if ($pagina > 1) {
            $paginacion['primero'] = 1;
            $paginacion['anterior'] = $pagina - 1;
        }
        else {
            $paginacion['primero'] = '';
            $paginacion['anterior'] = '';
        }

        if ($pagina < $total) {
            $paginacion['ultimo'] = $total;
            $paginacion['siguiente'] = $pagina + 1;
        }
        else {
            $paginacion['ultimo'] = '';
            $paginacion['siguiente'] = '';
        }

        $this->_paginacion = $paginacion;
//        $this->_rangoPaginacion($paginacion);
        $this->_rangoPaginacion($this->_limite);

        return $this->_datos;
    }

    private function _rangoPaginacion($limite = false)
    {
        printFunctionName(__METHOD__, __FILE__);
        if ($limite && is_numeric($limite)) {
            $limite = $limite;
        }
        else {
            $limite = 10;
        }

        $total_paginas = $this->_paginacion['total'];
        $pagina_seleccionada = $this->_paginacion['actual'];
        $rango = ceil($limite / 2);
        $paginas = array();

        $rango_derecho = $total_paginas - $pagina_seleccionada;

        if ($rango_derecho < $rango) {
            $resto = $rango - $rango_derecho;
        }
        else {
            $resto = 0;
        }

        $rango_izquierdo = $pagina_seleccionada - ($rango + $resto);

        for ($i = $pagina_seleccionada; $i > $rango_izquierdo; $i--) {
            if ($i == 0) {
                break;
            }

            $paginas[] = $i;
        }

        sort($paginas);

        if ($pagina_seleccionada < $rango) {
            $rango_derecho = $limite;
        }
        else {
            $rango_derecho = $pagina_seleccionada + $rango;
        }

        for ($i = $pagina_seleccionada + 1; $i <= $rango_derecho; $i++) {
            if ($i > $total_paginas) {
                break;
            }

            $paginas[] = $i;
        }

        $this->_paginacion['rango'] = $paginas;

        return $this->_paginacion;
    }

    public function getView($vista, $link = false)
    {
        printFunctionName(__METHOD__, __FILE__);
        $rutaView = ROOT . 'views' . DS . '_paginador' . DS . $vista . '.php';

        if ($link) {
            $link = BASE_URL . $link . '/';
        }
        else {
            $link = BASE_URL;
        }


        if (is_readable($rutaView)) {
            ob_start();

            include $rutaView;

            $contenido = ob_get_contents();

            ob_end_clean();

            return $contenido;
        }

        throw new Exception('Error de paginación');
    }

}

?>
