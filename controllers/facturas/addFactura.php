<?php 

session_start();
require_once '../../models/factura.php';
require_once '../../models/vehiculo.php';
require_once '../../models/nota_entrega.php';
require_once '../../models/almacen.php';
require_once '../../models/estadistica.php';

$factura = new Factura();
$vehiculo = new Vehiculo();
$nota_entrega = new NotaEntrega();
$factura_repuesto = new Almacen();
$estadistica = new Estadistica();

if(!empty($_POST)){

	$fecha = $_POST['fecha'];
	$cliente = $_POST['cliente'];
	$ordenCompra = $_POST['ordenCompra'];
	$n_poliza = $_POST['n_poliza'];
	$n_siniestro = $_POST['n_siniestro'];
	$marca = $_POST['marca'] ? $_POST['marca'] : '0';
	$modelo = $_POST['modelo'] ? $_POST['modelo'] : '0';
	$anio = $_POST['anio'] ? $_POST['anio'] : '0';
	$placa = $_POST['placa'] ? $_POST['placa'] : '0';

	//Nota entrega
	$codigo = $_POST['codigo'];
	$empresa_envio = $_POST['empresa_envio'];
	$guia = $_POST['guia'];
	$costo_envio = $_POST['costo_envio'];
	$estado_nota = $_POST['estado_nota'];
	$fecha_envio = $_POST['fecha_envio'];

	$repuesto = $_POST['repuesto'];

	$iva = $_POST['iva'];
	$total = $_POST['total'];
	$estado = $_POST['estado'];
	
	$factura->addFactura($placa, $_SESSION['id_usuario'], $cliente, $iva, $total, $ordenCompra, $n_poliza, $n_siniestro, $fecha, $estado);
	
	//PARA GUARDAR VEHICULO
	if(!empty($placa)){
		$vehiculo->addVehiculo($placa, $marca, $modelo, $placa, $anio);
	}
	//PARA GUARDAR NOTA DE ENTREGA
	if(!empty($codigo)){
		if($factura->getFacturas()[0]['id_factura'] != ''){
			$facturaId = $factura->getFacturas()[0]['id_factura'];
			$nota_entrega->addNotaEntrega($codigo, $facturaId, $empresa_envio, $guia, $costo_envio, $estado_nota, $fecha_envio);
	}
}
	if($factura->getFacturas()[0]['id_factura'] != ''){
		$facturaId = $factura->getFacturas()[0]['id_factura'];
		$estadistica->addEstadistica($facturaId, $total, $fecha, $estado);
		
		for($i=0; $i<count($repuesto); $i++){
			$factura->addFacturaRepuesto($repuesto[$i]['Id'], $facturaId, $repuesto[$i]['Cantidad']);
			$factura_repuesto->editAlmacenStock($repuesto[$i]['Id'], $repuesto[$i]['Cantidad']);
		}
	}
}