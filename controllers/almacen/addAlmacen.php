<?php 
require_once '../../models/almacen.php';
$almacen = new Almacen();

if(!empty($_POST)){
	$almacen->addAlmacen($_POST['descripcion'], $_POST['detalle'],$_POST['tipo'], $_POST['precio_unitario'], $_POST['stock']);
	header("Location: ../../pages/almacen?agregado");
}