<?php 
require_once '../../models/usuario.php';
$usuario = new Usuario();

if(!empty($_POST)){
	$usuario->getUsuarioExist($_POST['nombre'],$_POST['apellido'],$_POST['cuenta'], $_POST['clave'], $_POST['rol']);
}