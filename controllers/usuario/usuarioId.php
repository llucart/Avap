<?php 

require_once '../models/usuario.php';

if(!empty($_GET['id'])){
	$usuario = new Usuario();
	$usuarios = $usuario->getUsuarioId(base64_decode($_GET['id']));
}