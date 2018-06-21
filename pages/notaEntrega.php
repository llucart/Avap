<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once '../controllers/usuario/isDirorVer.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>
<?php require_once '../controllers/notaEntrega/allNota.php';?>
<?php require_once '../views/notaEntrega/editar.phtml';?>


	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php 
			if(isset($_GET['semodifica'])){
				echo'<script type="text/javascript">';
 				echo 'setTimeout(function () { swal("LISTO","SE GUARDARON LOS CAMBIOS","success");';
 				echo '}, 1000);</script>';
			}	
		?>
		<div>
			<div class="form-group">
				<input type="text" id="searchNota" class="form-control" onkeypress="return numeroyletras(event)" placeholder="Buscar nota de entrega">
			</div>
		</div>
		<table class="table table-responsive" id="tablaNotaEntrega">
			<tr>
				<th>Id</th>
				<th>Codigo</th>
				<th>Empresa de Envio</th>
				<th>Nro de Guia</th>
				<th>Costo de Envio</th>
				<th>Fecha de Envio</th>
				<th>Fecha de Entrega</th>
				<th>Estado</th>
				
			</tr>
			<?php for($i=0; $i<count($nota_entrega); $i++){ $rs = $nota_entrega[$i]; ?>
			<tr>
				<td><?php echo $rs['id_nota_entrega']; ?></td>
				<td><?php echo $rs['cod_nota_entrega']; ?></td>
				<td><?php echo $rs['empresa_envio']; ?></td>
				<td><?php echo $rs['guia']; ?></td>
				<td><?php echo $rs['costo_envio']; ?></td>
				<td><?php echo $rs['fecha_envio']; ?></td>
				<td><?php echo $rs['fechaEntrega']; ?></td>
				<td>
					<?php if($rs['estado'] == '1'){
						echo 'Enviado';
					}else if($rs['estado'] == '2') {
						echo 'Recibido';
					}else if($rs['estado'] == '3'){
						echo 'Extraviado';
					}else if($rs['estado'] == '4'){
						echo 'Devuelto';
					} ?>
				</td>
				<td>
					<a href="#" onclick="editNotaEntrega(this,<?php echo $rs['estado']; ?>);" title="Editar nota de entrega" class="btn btn-default glyphicon glyphicon-edit"></a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>
<?php require_once 'layout/footer.php'; ?>