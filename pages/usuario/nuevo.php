<?php require_once '../../controllers/usuario/check.php'; ?>
<link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../public/css/style.css">
<?php 
require_once '../../models/usuario.php';
$usuario = new Usuario();
//$usuarios = $usuario->getUsuarioId(base64_decode($_GET['id']));

//for($i=0; $i<count($usuarios); $i++){ $rs = $usuarios[$i]; }

if(!empty($_POST)){
	$usuario->addUsuario($_POST['cuenta'], $_POST['clave'], $_POST['rol']);
	header("Location: ../usuarios");
	//var_dump($_POST);
}
?>
<div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
	<div class="form-group" id="formLogin">
		<form class="form-group" action="" method="post">
			<div class="form-group">
				<input type="text" class="form-control" name="cuenta" required placeholder="Coloca la cuenta">
			</div>
			<div class="form-group">
				<select name="rol" id="rol" class="form-control" required >
					<option value="">Selecciona un nuevo rol</option>
					<option value="1">Presidente</option>
					<option value="2">Director Administrativo</option>
					<option value="3">Vendedor</option>
					<option value="4">Administrador del sistema</option>
				</select>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="clave" required placeholder="Colocar la contraseña">
			</div>
			<input type="submit" class="btn btn-primary" value="Salvar">
			<a class="btn btn-warning" href="../usuarios">Volver</a>
		</form>
	</div>
</div>
<script src="../../public/js/jquery-2.2.4.min.js"></script>
<script src="../../public/js/bootstrap.min.js"></script>