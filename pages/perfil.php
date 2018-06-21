<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>
<?php require_once '../controllers/usuario/usuarioId.php';?>
<?php require_once '../views/perfil/editar.phtml';?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php 
			if(isset($_GET['correcto'])){
				echo'<script type="text/javascript">';
 				echo 'setTimeout(function () { swal("LISTO","CLIENTE AGREGADO","success");';
 				echo '}, 1000);</script>';
			}	
		?>
		<table class="table table-responsive" id="tablaPerfil">
			<tr>
				<th>Id</th>
				<th>Cuenta</th>
				<th>Rol</th>
				<th>Opcion para editar</th>
			</tr>
			<?php for($i=0; $i<count($usuarios); $i++){ $rs = $usuarios[$i]; ?>
			<tr>
				<td><?php echo $rs['id_usuario']; ?></td>
				<td><?php echo $rs['cuenta']; ?></td>
				<td><?php echo $rs['rol']; ?></td>
				<td>
					<a href="#" onclick="editarPerfil(this);" title="Editar perfil" class="btn btn-default glyphicon glyphicon-edit"></a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>

	<div class=" col-sm-4 col-md-10  ">
		<img src="../public/img/usuario.jpg">
	</div>
<?php require_once 'layout/footer.php'; ?>