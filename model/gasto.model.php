<?php
require "Conexion.php";	

class GastoModelo
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=97.74.31.133;dbname=systemguna', 'systemguna', 'Sistem2016%');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM gasto");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new gasto();

				$alm->__SET('idgasto', $r->idgasto);
				$alm->__SET('tipo_persona', $r->tipo_persona);
				$alm->__SET('tipo_gasto', $r->tipo_gasto);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('tipo_documento', $r->tipo_documento);
				$alm->__SET('num_documento', $r->num_documento);
				$alm->__SET('tipo_pago', $r->tipo_pago);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('fecha', $r->fecha);
				$alm->__SET('valor', $r->valor);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idgasto)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM gasto WHERE idgasto = ?");
			          

			$stm->execute(array($idgasto));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new gasto();

			$alm->__SET('idgasto', $r->idgasto);
				$alm->__SET('tipo_persona', $r->tipo_persona);
				$alm->__SET('tipo_gasto', $r->tipo_gasto);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('tipo_documento', $r->tipo_documento);
				$alm->__SET('num_documento', $r->num_documento);
				$alm->__SET('tipo_pago', $r->tipo_pago);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('fecha', $r->fecha);
				$alm->__SET('valor', $r->valor);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idgasto)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM gasto WHERE idgasto = ?");			          

			$stm->execute(array($idgasto));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(gasto $data)
	{
		try 
		{
			$sql = "UPDATE gasto SET 
						tipo_persona         = ?, 
						tipo_gasto           = ?,
						nombre               = ?,
						tipo_documento       = ?, 
						num_documento        = ?,
						tipo_pago            = ?, 
						descripcion          = ?, 
						fecha                = ?, 
						valor = ?
				    WHERE idgasto = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
				    $data->__GET('tipo_persona'),				   
					$data->__GET('tipo_gasto'), 
					$data->__GET('nombre'), 
					$data->__GET('tipo_documento'),
					$data->__GET('num_documento'),
					$data->__GET('tipo_pago'), 
					$data->__GET('descripcion'), 
					$data->__GET('fecha'),
					$data->__GET('valor'),
					$data->__GET('idgasto')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(gasto $data)
	{
		try 
		{
		$sql = "INSERT INTO gasto (tipo_persona,tipo_gasto,nombre,tipo_documento,num_documento,tipo_pago,descripcion,fecha,valor) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('tipo_persona'),				   
					$data->__GET('tipo_gasto'), 
					$data->__GET('nombre'), 
					$data->__GET('tipo_documento'),
					$data->__GET('num_documento'),
					$data->__GET('tipo_pago'), 
					$data->__GET('descripcion'), 
					$data->__GET('fecha'),
					$data->__GET('valor')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}/*
<!--
$conexion= new mysqli ('localhost','root','','venta');

$sql ="SELECT valor FROM gasto";
$consulta=$conexion->query($sql);
$total=0;
while($row =$consulta->fetch_array(MYSQL_ASSOC))
{
$total = $total + $row['valor'];

}

echo $total;  -->*/