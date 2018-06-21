<?php 
require_once '../../models/cliente.php';
$cliente = new Cliente();

if(!empty($_POST)){
	$cliente->getClienteExist($_POST['Lrif'],  $_POST['correo'], $_POST['razon'], $_POST['telefono'], $_POST['Nrif'], $_POST['direccion']);	
}