<?php
/**
 * Obtiene el detalle de un articulo especificada por
 * su identificador "idarticulo"
 */

require 'Articulo.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idarticulo'])) {

        // Obtener parámetro idarticulo
        $parametro = $_GET['idarticulo'];

        // Tratar retorno
        $retorno = Articulo::getById($parametro);


        if ($retorno) {

            $dato["estado"] = "1";
            $dato["articulo"] = $retorno;
            // Enviar objeto json del articulo
            print json_encode($dato);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}