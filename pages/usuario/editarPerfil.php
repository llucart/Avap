<link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../public/css/style.css">

<div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
	<div class="form-group" id="formLogin">
		<form class="form-group" action="../../controllers/usuario/editPerfil.php" method="post">
			<input type="hidden" name="id_usuario" value="<?php echo base64_decode($_GET['id']); ?>">
			<div class="form-group">
				<input type="text" class="form-control" value="<?php echo base64_decode($_GET['c']); ?>" name="cuenta">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="clave" placeholder="Colocar nueva clave">
			</div>
			<input type="submit" class="btn btn-primary" value="Salvar">
			<a class="btn btn-warning" href="../perfil?id=<?php echo $_GET['id']; ?>">Volver al perfil</a>
		</form>
	</div>
</div>
<script src="../../public/js/jquery-2.2.4.min.js"></script>
<script src="../../public/js/bootstrap.min.js"></script>