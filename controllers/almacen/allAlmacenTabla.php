<?php 

require_once '../models/almacen.php';

	$almacen = new Almacen();
	$repuestos = $almacen->getAlmacen1();