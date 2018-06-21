<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once '../controllers/usuario/isDirorVer.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>
<?php require_once '../controllers/clientes/allClientes.php';?>
<?php require_once '../views/clientes/nuevo.phtml';?>
<?php require_once '../views/clientes/editar.phtml';?>

	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<a href="#" onclick="nuevoCliente();">Nuevo cliente</a>
		<?php 
			if(isset($_GET['error'])){
				echo'<script type="text/javascript">';
 				echo 'setTimeout(function () { swal("ERROR!","EL RIF YA EXISTE","error");';
 				echo '}, 1000);</script>';
			}
			else if(isset($_GET['correcto'])){
				echo'<script type="text/javascript">';
 				echo 'setTimeout(function () { swal("LISTO","CLIENTE AGREGADO","success");';
 				echo '}, 1000);</script>';
			}
			?>
		<?php 
			if(isset($_GET['cambio'])){
				echo'<script type="text/javascript">';
 				echo 'setTimeout(function () { swal("LISTO","SE GUARDARON LOS CAMBIOS","success");';
 				echo '}, 1000);</script>';
			}	
		?>
		<div>
			<div class="form-group">
				<input type="text" id="searchCliente" class="form-control" onkeypress="return numeroyletras(event)" placeholder="Buscar Cliente">
			</div>
		</div>
		<table class="table table-responsive" id="tablaCliente">
			<tr>
				<th>Id</th>
				<th>Razon Social</th>
				<th>Tipo RIF</th>
				<th>Numero</th>
				<th>Correo</th>
				<th>Dirección</th>
				<th>Telefono</th>
				<th>Opciones</th>
			</tr>
			<?php for($i=0; $i<count($clientes); $i++){ $rs = $clientes[$i]; ?>
			<tr>
				<td><?php echo $rs['id_cliente']; ?></td>
				<td><?php echo $rs['razon_social']; ?></td>
				<td>
					<?php if($rs['tipo_rif'] == '1'){
						echo 'V-';
					}else if($rs['tipo_rif'] == '2'){
						echo 'J-';
					}else if($rs['tipo_rif'] == '3'){
						echo 'G-';
					}else if($rs['tipo_rif'] == '4'){
						echo 'E-';
					}else if($rs['tipo_rif'] == '2'){
						echo 'P-'; 
					}?>
				</td>
				<td><?php echo $rs['rif']; ?></td>
				<td><?php echo $rs['correo']; ?></td>
				<td><?php echo $rs['direccion']; ?></td>
				<td><?php echo $rs['telefono']; ?></td>
				<td>
					<a href="#" onclick="editarCliente(this,<?php echo $rs['tipo_rif']; ?>);" title="Editar cliente" class="btn btn-default glyphicon glyphicon-edit"></a>

				</td>
				
			</tr>
			<?php } ?>
		</table>
		
	</div>
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 pull-right">
		<?php require_once '../views/publicidad/publicidadClientes.php'; ?>
	</div>
<?php require_once 'layout/footer.php'; ?>