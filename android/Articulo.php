<?php

/**
 * Representa el la estructura de las metas
 * almacenadas en la base de datos
 */
require 'Database.php';

class Articulo
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'meta'
     *
     * @param $idcategoria Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM articulo";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de un articulo con un identificador
     * determinado
     *
     * @param $idarticulo Identificador del articulo
     * @return mixed
     */
    public static function getById($idarticulo)
    {
        // Consulta de la articulo
        $consulta = "SELECT idarticulo,
                            idcategoria,
                             idunidad_medida,
                             nombre,
                             descripcion,
                             imagen,
                             estado
                             FROM articulo
                             WHERE idarticulo = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idarticulo));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idarticulo       identificador
     * @param $idcategoria      categoria
     * @param $idunidad_medida  unidade de medida
     * @param $nombre           nombre
     * @param $descripcion      descripción
     * @param $imagen           imagen
     * @param $estado           estado     
     */
    public static function update(
        $idarticulo,
        $idcategoria,
        $idunidad_medida,
        $nombre,
        $descripcion,
        $imagen,        
        $estado
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE articulo" .
            " SET idcategoria=?, idunidad_medida=?, nombre=?, descripcion=?, imagen=?, estado=? " .
            "WHERE idarticulo=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($idcategoria, $idunidad_medida, $nombre, $descripcion, $imagen, $estado, $idarticulo));

        return $cmd;
    }

    /**
     * Insertar un nuevo articulo
     *
     * @param $idcategoria      categoria
     * @param $idunidad_medida  unidade de medida
     * @param $nombre           nombre
     * @param $descripcion      descripción
     * @param $imagen           imagen
     * @param $estado           estado   
     * @return PDOStatement
     */
    public static function insert(
        $idcategoria,
        $idunidad_medida,
        $nombre,
        $descripcion,
        $imagen,        
        $estado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO articulo ( " .
            "idcategoria," .
            " idunidad_medida," .
            " nombre," .
            " descripcion," .
            " imagen," .            
            " estado)" .
            " VALUES( ?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $idcategoria,
                $idunidad_medida,
                $nombre,
                $descripcion,
                $imagen,        
                $estado                
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idarticulo identificador del articulo
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idarticulo)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM articulo WHERE idarticulo=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idarticulo));
    }
}

?>