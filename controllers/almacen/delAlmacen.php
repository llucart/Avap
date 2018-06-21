<?php 

require_once '../../models/almacen.php';

$almacen = new Almacen();
$almacen->delAlmacen($_GET['id']);
header("Location: ../../pages/almacen");