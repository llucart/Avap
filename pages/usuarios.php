<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once '../controllers/usuario/isAdmin.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>
<?php require_once '../controllers/usuario/allUsuarios.php';?>
<?php require_once '../views/usuarios/nuevo.phtml';?>
<?php require_once '../views/usuarios/editar.phtml';?>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<a href="#" onclick="nuevoUsuario();">Nuevo usuario</a>
		<div>
			<div class="form-group">
				<input type="text" id="searchUsuario" class="form-control" onkeypress="return numeroyletras(event)" placeholder="Buscar Usuario">
			</div>
		</div>
		<table class="table table-responsive" id="tablaUsuario">
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Cuenta</th>
				<th>Rol</th>
				<th>Fecha de creacion</th>
				<th>Opciones</th>
			</tr>
			<?php for($i=0; $i<count($usuarios); $i++){ $rs = $usuarios[$i]; ?>
			<tr>
				<td><?php echo $rs['id_usuario']; ?></td>
				<td><?php echo $rs['nombre']; ?></td>
				<td><?php echo $rs['apellido']; ?></td>
				<td><?php echo $rs['cuenta']; ?></td>
				<td><?php echo $rs['rol']; ?></td>
				<td><?php echo $rs['fecha_log']; ?></td>
				<td>
					<!--<a href="#" onclick="editUsuario(this);" title="Editar perfil" class="btn btn-default glyphicon glyphicon-edit"></a>-->
					<a href="#" onclick="delUsuario(this);" title="Eliminar usuario" class="btn btn-default glyphicon glyphicon-trash"></a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>
<?php require_once 'layout/footer.php'; ?>