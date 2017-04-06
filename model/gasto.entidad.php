<?php
class Gasto
{
	private $idgasto;
	private $tipo_persona;
	private $tipo_gasto;
	private $nombre;
	private $tipo_documento;
	private $num_documento;
	private $tipo_pago;
	private $descripcion;
	private $fecha;
	private $valor;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}