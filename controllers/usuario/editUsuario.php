<?php 
require_once '../../models/usuario.php';

$usuario = new Usuario();

if(!empty($_POST)){
	$usuario->editUsuario($_POST['id_new_usuario'], $_POST['new_cuenta'], $_POST['new_clave'], $_POST['new_rol']);
	header("Location: ../../pages/usuarios");
	//var_dump($_POST);
}