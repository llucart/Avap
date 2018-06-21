<?php 
require_once '../../models/factura.php';

$factura = new Factura();

if(!empty($_POST)){
	$factura->pagarFactura($_POST['id_factura'], $_POST['estado'],$_POST['fecha']);
	//header("Location: ../../pages/facturas");
}