<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once '../controllers/usuario/isDirector.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>
<?php require_once '../controllers/facturas/allFacturas.php';?>
<?php require_once '../controllers/clientes/allClientes.php';?>
<?php require_once '../controllers/almacen/allAlmacen.php';?>
<?php require_once '../views/facturas/nuevo.phtml';?>
<?php require_once '../views/facturas/editar.phtml';?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<a href="./crearFactura" onclick="/*nuevaFactura();*/">Nueva factura</a>
		<?php 
			if(isset($_GET['editada'])){
				echo'<script type="text/javascript">';
 				echo 'setTimeout(function () { swal("LISTO","SE EDITO LA FACTURA","success");';
 				echo '}, 100);</script>';
			}	
		?>
		<div>
			<div class="form-group">
				<input type="text" id="searchFactura" class="form-control" onkeypress="return numeroyletras(event)" placeholder="Buscar facturas">
			</div>
		</div>
		<table class="table table-responsive" id="tablaFactura">
			<tr>
				<th>Id</th>
				<th>Fecha</th>
				<th>Cliente</th>
				<th>Orden de Compra</th>
				<th>Nro Poliza</th>
				<th>Nro Siniestro</th>
				<th>Placa Vehiculo</th>
				<th>Modelo</th>
				<th>Fecha de Pago</th>
				<th>Estado</th>
				<th>Opciones</th>
			</tr>
			<?php for($i=0; $i<count($facturas); $i++){ $rs = $facturas[$i]; ?>
			<tr>
				<td><?php echo $rs['id_factura']; ?></td>
				<td><?php echo $rs['fecha']; ?></td>
				<td><?php echo $rs['razon_social']; ?></td>
				<td><?php echo $rs['ordenCompra']; ?></td>
				<td><?php echo $rs['n_poliza']; ?></td>
				<td><?php echo $rs['n_siniestro']; ?></td>
				
				<td>
				<?php if($rs['id_vehiculo'] != '0'){
						echo $rs['id_vehiculo'];
					} else echo 'N/A' ?>
				</td>

				<td>
				<?php if($rs['modelo'] != '0'){
						echo $rs['modelo'];
					} else echo 'N/A' ?>
				</td>

				<td><?php echo $rs['fechaPago']; ?></td>

				<td>
					
					<?php if($rs['estado'] == '1'){
						echo 'Pagada';
					}else if($rs['estado'] == '2'){
						echo 'No pagada';
					}else if($rs['estado'] == '3'){
						echo 'Anulada';
					} ?>
				</td>
				<td>
					<a href="#" onclick="editarFactura(this, <?php echo $rs['id_cliente']; ?>,<?php echo $rs['estado']; ?>);" title="Editar factura" class="btn btn-default glyphicon glyphicon-edit"></a>
					<a target="_blank" href="../controllers/facturas/reciboF?printFac=<?php echo $rs['id_factura']; ?>" title="Imprimir factura" class="btn btn-default glyphicon glyphicon-print"></a>	
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>
<?php require_once 'layout/footer.php'; ?>