<?php 
require_once '../../models/almacen.php';
$almacen = new Almacen();

if(!empty($_POST)){
	$almacen->editAlmacen($_POST['id_repuesto'], $_POST['new_descripcion'], $_POST['new_detalle'],$_POST['new_tipo'], $_POST['new_precio_unitario'], $_POST['new_stock']);
	header("Location: ../../pages/almacen?editado");
}