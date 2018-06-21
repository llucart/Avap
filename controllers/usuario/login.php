<?php 

require_once '../../models/usuario.php';

$usuario = new Usuario();

if(!empty($_POST)){
	$usuario->getSession($_POST['cuenta'], $_POST['clave']);
}