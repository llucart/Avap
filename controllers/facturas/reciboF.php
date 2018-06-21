<?php

require_once '../../controllers/usuario/check.php';
require_once '../../models/factura.php';
require_once '../../lib/fpdf.php';

date_default_timezone_set('America/Caracas');
setlocale(LC_ALL, "esp");

$id = isset($_GET['printFac']) ? $_GET['printFac'] : '';
$id2 = isset($_GET['printFac']) ? $_GET['printFac'] : '';
$factura = new factura();
$factura_repuesto = new factura();

//DATOS GENERALES DE FACTURA
$result = $factura->getFacturaId($id);
//var_dump($id);
for($i=0; $i<count($result); $i++){ $rs = $result[$i]; }
$headingOk = array('id_vehiculo', utf8_decode('razon_social'),'nombres', 'cuenta');
//$pagos = array('PLACA: ' . $rs['id_vehiculo'],'Razon Social: ' .utf8_decode($rs['razon_social']),'Cliente: ' . $rs['razon_social']);
if($rs['id_vehiculo']=='0'){ // isset($rs['id_vehiculo']) ? $rs['id_vehiculo'] : ''
	$rs['id_vehiculo']='N/A';
}else {}

if($rs['tipo_rif']=='1'){
	$tipo='V-';
}else if($rs['tipo_rif']=='2'){
	$tipo='J-';
}else if($rs['tipo_rif']=='3'){
	$tipo='G-';
}else if($rs['tipo_rif']=='4'){
	$tipo='E-';
}else if($rs['tipo_rif']=='5'){
	$tipo='P-';
}
//DATOS DE REPUESTOS
$result1 = $factura_repuesto->getFactura_RepuestoId($id2);
for($j=0; $j<count($result1); $j++){ $rs1 = $result1[$j]; }

//INICIO DE PDF
$pdf = new FPDF();
$pdf->Ln(20);
$pdf->AddPage();
$pdf->SetTitle( utf8_decode("Factura: N° {$rs['id_factura']}"));
$pdf->SetFont('Arial','B', 14);
//IMAGEN DE FACTURA
$pdf->Image('http://127.0.0.1:1337/Avap/public/img/cabeceraF.jpg',7,10,80);
$pdf->Ln(20);

$pdf->SetXY( 160, 15);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell( 40, 5, "RIF: J-31316162-4", 0, 1, 'L');
$pdf->Ln();
$pdf->SetXY( 160, 20);
$pdf->SetFont('Arial','I', 10);
$pdf->Cell( 40, 10, utf8_decode("Factura: N° {$rs['id_factura']}"), 1, 1, 'L');
$pdf->Ln();
$pdf->SetXY( 160, 30);
$pdf->SetFont('Arial','B', 10);
$pdf->Cell( 40, 10, "Fecha: {$rs['fecha']}", 1, 0, 'L');
$pdf->Ln();

//CAMPOS DE VEHICULO, POLIZA Y SINIESTRO
$pdf->SetFont('Arial','', 8);
$pdf->SetXY( 147, 60);
$pdf->Cell( 22, 5,utf8_decode('SINIESTRO N°'), 1, 0, 'L');
$pdf->Cell( 30, 5, utf8_decode("{$rs['n_siniestro']}"), 1, 1, 'L');
$pdf->SetXY( 147, 65);
$pdf->Cell( 22, 5, utf8_decode('PÓLIZA N°'), 1, 0, 'L');
$pdf->Cell( 30, 5, utf8_decode("{$rs['n_poliza']}"), 1, 1, 'L');
$pdf->SetXY( 147, 70);
$pdf->Cell( 22, 5, "MARCA", 1, 0, 'L');
$pdf->Cell( 30, 5, utf8_decode("{$rs['marca']}"), 1, 1, 'L');
$pdf->SetXY( 147, 75);
$pdf->Cell( 22, 5, "MODELO", 1, 0, 'L');
$pdf->Cell( 30, 5, utf8_decode("{$rs['modelo']}"), 1, 1, 'L');
$pdf->SetXY( 147, 80);
$pdf->Cell( 22, 5, "PLACA", 1, 0, 'L');
$pdf->Cell( 30, 5, utf8_decode("{$rs['id_vehiculo']}"), 1, 1, 'L');
$pdf->SetXY( 147, 85);
$pdf->Cell( 22, 5, utf8_decode('AÑO'), 1, 0, 'L');
$pdf->Cell( 30, 5, utf8_decode("{$rs['anio']}"), 1, 1, 'L');
$pdf->Ln(5);
//DATOS DEL CLIENTE
$pdf->SetFont('Arial','', 11);
$pdf->SetXY( 10, 60);
$pdf->Cell( 22, 5, utf8_decode("Razon social:"), 0, 0, 'L');
$pdf->SetXY( 35, 60);
$pdf->SetFont('Arial','BU', 11);
$pdf->MultiCell(100,5, utf8_decode("{$rs['razon_social']}"),0,'L',0);
//$pdf->Cell( 22, 5, utf8_decode("{$rs['razon_social']}"), 0, 0, 'L');
//DOMICILIO
$pdf->SetFont('Arial','', 11);
$pdf->SetXY( 10, 74);
$pdf->Cell( 22, 5, utf8_decode("Domicilio Fiscal:"), 0, 0, 'L');
$pdf->SetXY( 39, 74);
$pdf->SetFont('Arial','BU', 10);
$pdf->MultiCell(100,5, utf8_decode("{$rs['direccion']}"),0,'L',0);
//$pdf->Cell( 10, 5, utf8_decode("{$rs['direccion']}"), 0, 1, 'L');
//RIF
$pdf->SetFont('Arial','', 11);
$pdf->SetXY( 10, 67);
$pdf->Cell( 22, 5, utf8_decode("RIF: "), 0, 0, 'L');
$pdf->SetXY( 19, 67);
$pdf->SetFont('Arial','BU', 11);
$pdf->Cell( 22, 5,"{$tipo}{$rs['rif']}", 0, 0, 'L');
//TELEFONO
$pdf->SetFont('Arial','', 11);
$pdf->SetXY( 10, 95);
$pdf->Cell( 22, 5, utf8_decode("Telf: "), 0, 0, 'L');
$pdf->SetXY( 19, 95);
$pdf->SetFont('Arial','BU', 11);
$pdf->Cell( 30, 5,"{$rs['telefono']}", 0, 0, 'L');
//Correo:
$pdf->SetFont('Arial','', 11);
$pdf->SetXY( 10, 102);
$pdf->Cell( 22, 5, utf8_decode("Correo: "), 0, 0, 'L');
$pdf->SetXY( 25, 102);
$pdf->SetFont('Arial','BU', 11);
$pdf->Cell( 40, 5,"{$rs['correo']}", 0, 0, 'L');
$pdf->Ln(10);

//CABECERA 
$pdf->SetFont('times','', 12);
$pdf->Cell( 13, 8, "Cant", 1,'j','C');
$pdf->Cell( 116, 8,utf8_decode('Descripción'), 1,'j','C');
$pdf->Cell( 30, 8, "Precio u.", 1,'j','C');
$pdf->Cell( 30, 8, "Monto", 1,'j','C');

//IMPRESION DE DATOS DE REPUESTOS
	while($row3 = $result1 and $row4 = $result){
		$pdf->SetFont('times','', 12);
		$baseImponible=0;
		for($k=0;$k<count($row3);$k++){
	 		$pdf->Ln();
	 		$pdf->Cell(13,10,$row3[$k]['cantidad'],1);
			$pdf->Cell(116,10,$row3[$k]['descripcion'],1);
			$pdf->Cell(30,10,$row3[$k]['precio_unitario'],1,0,'C');
			$monto=$row3[$k]['cantidad']*$row3[$k]['precio_unitario'];
			$pdf->Cell(30,10,$monto,1,0,'C');
			$baseImponible=$baseImponible+$monto;
		}
		$pdf->Ln();
		$pdf->Cell(159,10,"Base Imponible",1,0,'R');
		$pdf->Cell(30,10,$baseImponible,1,0,'C');
		$pdf->Ln();
		$pdf->Cell(159,10,"IVA",1,0,'R');
		$pdf->Cell(30,10,$row4[0]["iva"],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(159,10,"Total",1,0,'R');
		$pdf->Cell(30,10, $row4[0]["total"],1,0,'C');
		$pdf->Ln();
	break;
	}
	$pdf->SetXY(5, 235);
	$pdf->Cell(60, 10, utf8_decode("Recibe Confome"), 0, 0, 'C');
	$pdf->SetXY(5, 250);
	$pdf->Cell(60, 10, utf8_decode("________________________"), 0, 0, 'C');
	
//MOSTRAR ESTADO DE FACTURA
	$estado=$rs['estado'];
	if($estado==1){
		$pdf->SetXY(160, 265);
		$pdf->Cell(40, 10, utf8_decode("Factura Pagada"), 1, 0, 'C');
	}
	else if($estado==2){
		$pdf->SetXY(160, 265);
		$pdf->Cell(40, 10, utf8_decode("Factura No Pagada"), 1, 0, 'C');
	}
	else if($estado==3){
		$pdf->SetXY(160, 265);
		$pdf->Cell(40, 10, utf8_decode("Factura Anulada"), 1, 0, 'C');
	}
$pdf->SetXY(10, 260);
$pdf->Cell(60,10, utf8_decode("Elaborado por: {$rs['nombre']} {$rs['apellido']}"),1);
$pdf->Output();