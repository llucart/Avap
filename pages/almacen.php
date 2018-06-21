<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once '../controllers/usuario/isAdmin.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>
<?php require_once '../controllers/almacen/allAlmacenTabla.php';?>
<?php require_once '../views/almacen/nuevo.phtml';?>
<?php require_once '../views/almacen/editar.phtml';?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<a href="#" onclick="nuevoRepuesto();">Nuevo repuesto</a>
		<?php 
			if(isset($_GET['agregado'])){
				echo'<script type="text/javascript">';
 				echo 'setTimeout(function () { swal("LISTO","REPUESTO AGREGADO","success");';
 				echo '}, 1000);</script>';
			}
			if(isset($_GET['editado'])){
				echo'<script type="text/javascript">';
 				echo 'setTimeout(function () { swal("LISTO","REPUESTO MODIFICADO","success");';
 				echo '}, 1000);</script>';
			}	
		?>
		<div>
			<div class="form-group">
				<input type="text" id="searchRepuesto" class="form-control" onkeypress="return numeroyletras(event)" placeholder="Buscar Repuesto">
			</div>
		</div>
		<table class="table table-responsive" id="tablaRepuesto">
			<tr>
				<th>Id</th>
				<th>Tipo</th>
				<th>Descripción</th>
				<th>Detalle</th>
				<th>Precio unitario</th>
				<th>Stock</th>
				<th>Opcion para editar</th>
			</tr>
			<?php for($i=0; $i<count($repuestos); $i++){ $rs = $repuestos[$i]; ?>
			<tr>
				<td><?php echo $rs['id_repuesto']; ?></td>
				<td>
					<?php if($rs['tipo'] == '1'){
						echo 'Original';
					}else if($rs['tipo'] == '2'){
						echo 'Generico';
					}else{
						echo 'Oportunidad';
					} ?>
				</td>
				<td><?php echo $rs['descripcion']; ?></td>
				<td><?php echo $rs['detalle']; ?></td>
				<td><?php echo $rs['precio_unitario']; ?></td>
				<td><?php echo $rs['stock']; ?></td>
				<td>
					<a href="#" onclick="editarRepuesto(this, <?php echo $rs['tipo']; ?>);" title="Editar repuesto" class="btn btn-default glyphicon glyphicon-edit"></a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>
<?php require_once 'layout/footer.php'; ?>