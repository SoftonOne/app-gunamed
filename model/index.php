<?php
require_once 'gasto.entidad.php';
require_once 'gasto.model.php';
require "Conexion.php";	

$sql ="SELECT valor FROM gasto";
$consulta=$conexion->query($sql);
$total=0;
while($row =$consulta->fetch_array(MYSQL_ASSOC))
{
$total = $total + $row['valor'];

}

// Logica
$alm = new Gasto();
$model = new GastoModelo();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idgasto',                $_REQUEST['idgasto']);
			$alm->__SET('tipo_persona',           $_REQUEST['tipo_persona']);
			$alm->__SET('tipo_gasto',             $_REQUEST['tipo_gasto']);
			$alm->__SET('nombre',                 $_REQUEST['nombre']);
			$alm->__SET('tipo_documento',         $_REQUEST['tipo_documento']);
			$alm->__SET('num_documento',          $_REQUEST['num_documento']);
			$alm->__SET('tipo_pago',              $_REQUEST['tipo_pago']);
			$alm->__SET('descripcion',            $_REQUEST['descripcion']);			
			$alm->__SET('valor',                  $_REQUEST['valor']);

			$model->Actualizar($alm);
			
			echo '<script>alert("Desea actualizar los datos de la tabla:")</script>';
			echo '<script>alert("Los datos han sido actualizados con exito:")</script>';	
	        echo '<script>location.href = "Gastos.php"</script>'; 
    					          
			break;

		case 'registrar':
			$alm->__SET('idgasto',                $_REQUEST['idgasto']);
			$alm->__SET('tipo_persona',           $_REQUEST['tipo_persona']);
			$alm->__SET('tipo_gasto',             $_REQUEST['tipo_gasto']);
			$alm->__SET('nombre',                 $_REQUEST['nombre']);
			$alm->__SET('tipo_documento',         $_REQUEST['tipo_documento']);
			$alm->__SET('num_documento',          $_REQUEST['num_documento']);
			$alm->__SET('tipo_pago',              $_REQUEST['tipo_pago']);
			$alm->__SET('descripcion',            $_REQUEST['descripcion']);			
			$alm->__SET('valor',                  $_REQUEST['valor']);

			$model->Registrar($alm);
			echo '<script>alert("Los datos han sido guardados con exito: Al sistema.")</script>';	
	        echo '<script>location.href = "Gastos.php"</script>';
			
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idgasto']);
			echo '<script>alert("Desea Eliminar los siguientes datos.")</script>';	
			echo '<script>alert("Se Elimino con exito.")</script>';
	        echo '<script>location.href = "Gastos.php"</script>';
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idgasto']);
			break;
	}
}
?>  


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pagos y Gastos</title>
  <!-- Tell the browser to be responsive to screen width -->
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../pagos/AdminLTE-2.3.7/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../pagos/AdminLTE-2.3.7/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../pagos/AdminLTE-2.3.7/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../pagos/AdminLTE-2.3.7/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../pagos/AdminLTE-2.3.7/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../pagos/AdminLTE-2.3.7/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../pagos/AdminLTE-2.3.7/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../pagos/AdminLTE-2.3.7/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../pagos/AdminLTE-2.3.7/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">


  <header class="main-header">   
  

      <!-- Small boxes (Stat box) -->
      
          
	

        <div class="box box-info">
            <div class="box-header with-border">
                
    <form action="?action=<?php echo $alm->idgasto > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idgasto" value="<?php echo $alm->__GET('idgasto'); ?>" />
                    
                    <table width="574" class="table table-striped table-bordered" style="width:500px;">
                        <tr>
                      <th style="text-align:left;">Tipo Persona</th>
        <td>
     <input name="tipo_persona" type="text" required class="form-control" style="width:100%;" value="<?php echo $alm->__GET('tipo_persona'); ?>" /></td>
                      <td>&nbsp;</td>
                      <td>
           <th style="text-align:left;">Tipo Gasto</th>
           </td>
                 <td> <select class="form-control" name="tipo_gasto" style="width:100%;">
     <option value="" <?php echo $alm->__GET('tipo_gasto') == 1 ? 'selected' : ''; ?>>seleccione</option>
     <option value="Sueldos empleados" <?php echo $alm->__GET('tipo_gasto') == 2 ? 'selected' : ''; ?>>Sueldos empleados</option>
     <option value="Alquiler de Oficinas" <?php echo $alm->__GET('tipo_gasto') == 3 ? 'selected' : ''; ?>>Alquiler de Oficinas</option>
     <option value="Sueldos empleados" <?php echo $alm->__GET('tipo_gasto') == 4 ? 'selected' : ''; ?>>Sueldos empleados</option>
     <option value="Luz" <?php echo $alm->__GET('tipo_gasto') == 5 ? 'selected' : ''; ?>>Luz</option>
     <option value="Agua" <?php echo $alm->__GET('tipo_gasto') == 6 ? 'selected' : ''; ?>>Agua</option>
     <option value="Telefono Fax e Internet Cable" <?php echo $alm->__GET('tipo_gasto') == 7 ? 'selected' : ''; ?>>Telefono Fax e Internet       Cable</option>
     <option value="Luz" <?php echo $alm->__GET('tipo_gasto') == 8 ? 'selected' : ''; ?>>Seguros</option>
     <option value="Gastos de administración" <?php echo $alm->__GET('tipo_gasto') == 9 ? 'selected' : ''; ?>>Gastos de administración</option>
     <option value="Materiales de oficina" <?php echo $alm->__GET('tipo_gasto') == 10 ? 'selected' : ''; ?>>Materiales de oficina</option>
                            </select>
                 
                          </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nombre y apellidos</th>
                            <td>
       <input name="nombre" type="text" required class="form-control" style="width:100%;" value="<?php echo $alm->__GET('nombre'); ?>" /></td>
                            <td>&nbsp;</td>
                            <td>
                            <th style="text-align:left;">Tipo Documento</th>
                            </td>
                            <td><select class="form-control" name="tipo_documento" style="width:100%;">
                             <option value="" <?php echo $alm->__GET('tipo_documento') == 1 ? 'selected' : ''; ?>>Seleccione</option>
                     <option value="Factura" <?php echo $alm->__GET('tipo_documento') == 2 ? 'selected' : ''; ?>>Factura</option>
                  <option value="Boleta" <?php echo $alm->__GET('tipo_documento') == 3 ? 'selected' : ''; ?>>Boleta</option>
                <option value="Recibo Honorario" <?php echo $alm->__GET('tipo_documento') == 4 ? 'selected' : ''; ?>>Recibo Honorario</option>
                            </select></td>
                        </tr>
                       
                        <tr>
                    <th style="text-align:left;">Numero Docuemnto</th>
                  <td>
<input class="form-control" type="text" name="num_documento" value="<?php echo $alm->__GET('num_documento'); ?>" style="width:100%;" /></td>
                    <td>&nbsp;</td>
                    <td><th style="text-align:left;">Tipo Pago</th></td>
                 <td><select class="form-control" name="tipo_pago" style="width:100%;">
                 <option value="" <?php echo $alm->__GET('tipo_pago') == 1 ? 'selected' : ''; ?>>Seleccione</option>
                   <option value="2" <?php echo $alm->__GET('tipo_pago') == 2 ? 'selected' : ''; ?>>contado</option>
                   <option value="3" <?php echo $alm->__GET('tipo_pago') == 3 ? 'selected' : ''; ?>>credito</option>
                 </select></td>
                        </tr>
                        
                         <tr>
                  <th style="text-align:left;">Descripcion</th>
   <td><input class="form-control" type="text" name="descripcion" value="<?php echo $alm->__GET('descripcion'); ?>" style="width:100%;" /></td>
                  <td>&nbsp;</td>
                  <td><th style="text-align:left;">valor  S./</th></td>
                  <td>
                    <input class="form-control" type="text" name="valor" value="<?php echo $alm->__GET('valor'); ?>" style="width:100%;" /></td>
                        </tr>
                        
                       <!-- <tr>
                            <th style="text-align:left;">Fecha</th>
                            <td><input type="text" name="fecha" value="<?php echo $alm->__GET('fecha'); ?>" style="width:100%;" /></td>
                        </tr>-->
                        
                        <tr>
                            <td colspan="6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="table-responsive">
                 <!-- Main row -->
               <div class="box box-success">            
                <table class="table no-margin">
                    <thead>
                        <tr> 
                            <th style="text-align:left;">Nª</th>
                            <th style="text-align:left;">Tipo persona</th>
                            <th style="text-align:left;">Tipo gasto</th>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Tipo documento</th>
                            <th style="text-align:left;">Num Documento</th>
                            <th style="text-align:left;">Tipo de pago</th>
                            <th style="text-align:left;">Descripcion</th>
                            <th style="text-align:left;">Fecha y hora</th>
                            <th style="text-align:left;">Valor Total</th>
                            <th class="btn-linkedin" colspan="2" align="center">Opciones</th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('idgasto'); ?></td>
                            <td><?php echo $r->__GET('tipo_persona'); ?></td>
                            <td><?php echo $r->__GET('tipo_gasto'); ?></td>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('tipo_documento'); ?></td>
                            <td><?php echo $r->__GET('num_documento'); ?></td>
                            <td><?php echo $r->__GET('tipo_pago')== 1 ? 'Contado' : 'Credito' ;  ?></td>
                            <td><?php echo $r->__GET('descripcion'); ?></td>
                            <td><?php echo $r->__GET('fecha'); ?></td>
                            <td><?php echo $r->__GET('valor'); ?></td>
                            <td>
        <a class="btn btn-success" href="?action=editar&idgasto=<?php echo $r->idgasto; ?>"><i class="fa fa-edit"></i>Actualizar</a>
                            </td>
                            <td>
                                <a class="btn pull-right bg-red" href="?action=eliminar&idgasto=<?php echo $r->idgasto; ?>"> <i class="fa fa-close"></i> Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total</th>                         
                            
                            <th class="btn-vk"><?=$total?></th>
                        </tr>
                    </tfoot>
                </table>  
                </div>  
                </div> 
              
            </div>
        </div>      
      
      <div class="row">       
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">      
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <!-- Control Sidebar --> 

</body>
</html>


