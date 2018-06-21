<?php 

require_once '../models/usuario.php';

	$usuario = new Usuario();
	$usuarios = $usuario->getUsuarios();