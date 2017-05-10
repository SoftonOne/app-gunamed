<?php
/**
 * Insertar un nuevo articulo en la base de datos
 */

require 'Articulo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Insertar articulo
    $retorno = Articulo::insert(
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
                'mensaje' => 'Creación exitosa')
        );
    } else {
        // Código de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Creación fallida')
        );
    }
}