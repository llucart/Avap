<?php 

require_once '../../models/factura.php';
$factura = new Factura();

var_dump($factura->addFacturaRepuesto(2, 33, 22));