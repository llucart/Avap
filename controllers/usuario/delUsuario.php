<?php 

require_once '../../models/usuario.php';

if(!empty($_POST)){
	$usuario = new Usuario();
	$usuario->deleteUsuario($_POST['id_usuario']);
}