abstract class UsuarioConsultas{
    public abstract function Listar();
    public abstract function Obtener($id);

    public abstract function Registrar(Usuario $obj);
    public abstract function Actualizar(Usuario $obj);
    public abstract function Eliminar($id);
}
