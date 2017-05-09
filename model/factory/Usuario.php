class Usuario
{
    private $id;
    private $Nombre;

    public function __GET($k) { return $this->$k; }
    public function __SET($k,$v) { return $this->$k = $v; }
}
