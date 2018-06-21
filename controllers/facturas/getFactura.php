<?php 

require_once '../models/factura.php';

	$factura = new Factura();
	$facturas = $factura->getFacturas();