<?php 

require_once '../../models/almacen.php';

	$almacen = new Almacen();
	$almacenes = $almacen->getAlmacenId($_GET['id']);
	echo json_encode($almacenes, JSON_NUMERIC_CHECK);