<?php

require_once 'mysql_login.php';

class PatronSingleton{
    
    // Contenedor de la instancia del singleton
    private static $instancia;
    private $articulos = array();
    private $dbh;
 
    // Un constructor privado evita la creación de un nuevo objeto
    private function __construct() {
        $this->dbh = new PDO(
                'mysql:dbname=' . DATABASE .
                ';host=' . HOSTNAME .
                ';port:8080;',
                USERNAME,
                PASSWORD
            );
    }
 
    // método singleton
    public static function singleton()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        } 
        return self::$instancia;
    }
    
    public function articulos()
    {
        $consulta = $this->dbh->prepare("SELECT * FROM articulo");
        $consulta->execute();
        if ($consulta->rowCount()>0) 
        {
            while($reg = $consulta->fetch())
            {
               $this->articulos[]=$reg;
            }
            return $this->articulos;     
        }
    }
   
    // Evita que el objeto se pueda clonar
    public function __clone()
    {
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
    }
}
?>