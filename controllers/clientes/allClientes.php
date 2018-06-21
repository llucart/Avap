<?php 

require_once '../models/cliente.php';

	$cliente = new Cliente();
	$clientes = $cliente->getClientes();