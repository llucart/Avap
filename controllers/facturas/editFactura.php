<?php 
require_once '../../models/factura.php';

$factura = new Factura();

if(!empty($_POST)){
	$factura->editFactura($_POST['id_new_factura'], $_POST['id_new_cliente'], $_POST['new_fecha'], $_POST['new_factura_estado'], $_POST['new_siniestro'], $_POST['new_ordenCompra'], $_POST['new_poliza']); 
	header("Location: ../../pages/facturas?editada");
}