<?php 

require_once '../../models/factura.php';
require_once '../../models/estadistica.php';

//$factura = new Factura();
//echo json_encode($factura->allFacturas(), JSON_NUMERIC_CHECK);

$estadistica = new Estadistica();
echo json_encode($estadistica->getEstadistica(), JSON_NUMERIC_CHECK);