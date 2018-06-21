<?php 

require_once '../../models/factura.php';

$factura = new Factura();
$factura->delFactura($_GET['id']);
$factura->delFacturaRepuesto($_GET['id']);
header("Location: ../../pages/facturas");