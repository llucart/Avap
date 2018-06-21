<?php  

require_once '../../models/usuario.php';

$usuario = new Usuario();

if(!empty($_POST)){
	$usuario->editPerfil($_POST['id_new_perfil'], $_POST['new_cuenta'], $_POST['new_clave']);
	$usuario->getSession($_POST['new_cuenta'], $_POST['new_clave']);
	header("Location: ../../pages/perfil?id=".base64_encode($_POST['id_new_perfil']));
	//var_dump($_POST);
}