<?php
/**
 * Actualiza un articulo especificada por su identificador
 */

require 'Articulo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Actualizar articulo
    $retorno = Articulo::update(
        $body['idarticulo'],
        $body['idcategoria'],
        $body['idunidad_medida'],
        $body['nombre'],
        $body['descripcion'],
        $body['imagen'],        
        $body['estado']);

    if ($retorno) {
        // Código de éxito
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Actualización exitosa')
        );
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Actualización fallida')
        );
    }
}