// La clase encargada de devolvernos con que motor de base de datos vamos a trabajar para la clase Usuario
class UsuarioFactory
{
    private $db = null;

    // Le inyectamos con que clase queremos trabajar (IoC)
    public function __CONSTRUCT($db){
        $this->db = new $db();
    }

    public function Listar() { return $this->db->Listar(); }
    public function Obtener($id) { return $this->db->Obtener($id); }

    public function Registrar($obj) { return $this->db->Registrar($obj); }
    public function Actualizar($obj) { return $this->db->Actualizar($obj); }
    public function Eliminar($id) { return $this->db->Eliminar($id); }
}

// La clase encargada de hacer consultas a mysql
class UsuarioConsultasMysql extends UsuarioConsultas
{
    public function Listar(){ /* Lógica a implementar */ }
    public function Obtener($id){ /* Lógica a implementar */ }

    public function Registrar(Usuario $obj){ /* Lógica a implementar */ }
    public function Actualizar(Usuario $obj){ /* Lógica a implementar */ }
    public function Eliminar($id){ /* Lógica a implementar */ }
}

// La clase encargada de hacer consultas a SqlServer
class UsuarioConsultasSqlServer extends UsuarioConsultas
{
    public function Listar(){ /* Lógica a implementar */ }
    public function Obtener($id){ /* Lógica a implementar */ }

    public function Registrar(Usuario $obj){ /* Lógica a implementar */ }
    public function Actualizar(Usuario $obj){ /* Lógica a implementar */ }
    public function Eliminar($id){ /* Lógica a implementar */ }
}

// La clase encargada de hacer consultas a Oracle
class UsuarioConsultasOracle extends UsuarioConsultas
{
    public function Listar(){ /* Lógica a implementar */ }
    public function Obtener($id){ /* Lógica a implementar */ }

    public function Registrar(Usuario $obj){ /* Lógica a implementar */ }
    public function Actualizar(Usuario $obj){ /* Lógica a implementar */ }
    public function Eliminar($id){ /* Lógica a implementar */ }
}
/*
$usuario = new UsuarioFactory('UsuarioConsultasOracle'); // Trabajamos con Oracle
$usuario->Listar();

// Ejemlo de un update
$u = new Usuario();
$u->__SET('id', 1);
$u->__SET('Nombre', 'Eduardo Rodriguez');

$usuario->Actualizar($u);
*/
