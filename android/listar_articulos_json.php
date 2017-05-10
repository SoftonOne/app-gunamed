<?php
//hacemos un require_once del archivo que contiene nuestra clase
require_once 'Database_Singleton.php';
//accedemos al método singleton que es quién crea la instancia
//de nuestra clase y así podemos acceder sin necesidad de 
//crear nuevas instancias, lo que ahorra consumo de recursos
$nuevoSingleton = PatronSingleton::singleton();
//accedemos al método articulos y los mostramos
$articulos = $nuevoSingleton->articulos();
    if ($articulos) {

        $datos["estado"] = 1;
        $datos["articulos"] = $articulos;

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
?>