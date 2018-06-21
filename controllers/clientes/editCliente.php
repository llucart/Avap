<?php 
require_once '../../models/cliente.php';

$cliente = new Cliente();

if(!empty($_POST)){
	$cliente->editCliente($_POST['id_cliente'], $_POST['new_razon'], $_POST['new_tipo_rif'], $_POST['new_Nrif'], $_POST['new_correo'], $_POST['new_direccion'], $_POST['new_telefono']);
	header("Location: ../../pages/clientes?cambio");
}