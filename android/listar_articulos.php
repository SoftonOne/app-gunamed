<?php
//hacemos un require_once del archivo que contiene nuestra clase
require_once 'Database_Singleton.php';
//accedemos al método singleton que es quién crea la instancia
//de nuestra clase y así podemos acceder sin necesidad de 
//crear nuevas instancias, lo que ahorra consumo de recursos
$nuevoSingleton = PatronSingleton::singleton();
//accedemos al método articulos y los mostramos
$articulo = $nuevoSingleton->articulos();
?>
Mostramos a todos los articulos<br />
<?php
foreach ($articulo as $fila):?>
    <?=$fila['nombre']?> || <?=$fila['descripcion']?><br /> 
<?php
endforeach;
?>