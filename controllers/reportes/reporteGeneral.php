<?php

require_once '../../controllers/usuario/check.php';
require_once '../../models/factura.php';
require_once '../../models/nota_entrega.php';
require_once '../../lib/fpdf.php';

date_default_timezone_set('America/Caracas');
setlocale(LC_ALL, "esp");

if ($_POST) {
$anio=$_POST['anio'];
$mes=$_POST['mes'];

$mes1 = strftime("%B");
$anio1 = date("Y");
$dia = date("d");

$factura = new factura();
$factura_repuesto = new factura();
$nota = new NotaEntrega();
//DATOS GENERALES DE FACTURA
$result = $factura->getFacturasMes($mes,$anio);
for($i=0; $i<count($result); $i++){ $rs = $result[$i]; }

$resultN = $nota->getNotasMes($mes,$anio);
for($i=0; $i<count($resultN); $i++){ $rs1 = $resultN[$i]; }
//INICIO DE PDF
$pdf = new FPDF();
$pdf->Ln(20);
$pdf->AddPage();
//$pdf->SetTitle( utf8_decode("Factura: N° {$rs['id_factura']}"));
$pdf->SetFont('Arial','B', 9);
//IMAGEN DE FACTURA
$pdf->Image('http://127.0.0.1:1337/Avap/public/img/cabeceraF.jpg',7,10,80);
$pdf->SetFont('Arial','B', 9);
$pdf->SetXY( 125, 10);{
$pdf->Cell( 55, 5, utf8_decode("FECHA: {$dia} de {$mes1} de {$anio1}"), 1, 1, 'C');
$pdf->Ln(20);

//DATOS DEL REPORTE
//FACTURAS
	//DATOS PARA FACTURAS
	do{
			$a=0;
			$b=0;
			$c=0;
			$d=0;
			$listaFacP;
			$listaFacN;
			$listaFacA;
			$IVA=0;
			$IngresoN=0;
			$TOTALES=0;
			$CuentaPC=0;
			$CantFacP=0;
			$CantFacN=0;
			$CantFacA=0;
				for($k=0;$k<count($result);$k++){
						$d++;
						if ($result[$k]['estado']=='1') {
							$CantFacP++;
							$listaFacP[$a++]=$result[$k]['id_factura'];
							$TOTALES=$TOTALES+$result[$k]['total'];
							$IVA=$IVA+$result[$k]['iva'];
						}
						else if ($result[$k]['estado']=='2') {
							$CantFacN++;
							$CuentaPC=$CuentaPC+$result[$k]['total'];
							$listaFacN[$b++]=$result[$k]['id_factura'];
							$TOTALES=$TOTALES+$result[$k]['total'];
							$IVA=$IVA+$result[$k]['iva'];
						}
						else if ($result[$k]['estado']=='3') {
							$CantFacA++;
							$listaFacA[$c++]=$result[$k]['id_factura'];
						}
				}
						if ($a=='0') {
							$listaFacP=0;
						}
						if ($b=='0') {
							$listaFacN=0;
						}
						if ($c=='0') {
							$listaFacA=0;
						}
						if ($d=='0'){

						}
			$IngresoN=$TOTALES-$IVA;
			break;
		}while($row = $result );
//var_dump($listaFacP);
//var_dump($listaFacN);
//var_dump($listaFacA);
//SUMAS
$pdf->SetFont('Arial','BU', 11);
$pdf->SetXY( 10, 65);
$pdf->Cell( 88, 10, "FACTURACION ", 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','I', 9);
$pdf->Cell( 59, 10,utf8_decode('CANTIDAD DE FACTURAS DEL MES:'), 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$k"), 1, 1, 'C');
//$pdf->SetXY( 10, 100);
$pdf->Cell( 59, 10, utf8_decode('FACTURAS PAGADAS:'), 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$CantFacP"), 1, 1, 'C');
//$pdf->SetXY( 10, 95);
$pdf->Cell( 59, 10, "FACTURAS NO PAGADAS:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$CantFacN"), 1, 1, 'C');
//$pdf->SetXY( 10, 100);
$pdf->Cell( 59, 10, "FACTURAS ANULADAS:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$CantFacA"), 1, 1, 'C');
//$pdf->SetXY( 10, 105);
$pdf->Cell( 59, 10, "INGRESOS TOTALES:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$TOTALES Bs"), 1, 1, 'R');
//$pdf->SetXY( 10, 110);
$pdf->Cell( 59, 10,utf8_decode('IVA DEL MES:'), 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$IVA Bs"), 1, 1, 'R');
//$pdf->SetXY( 10, 115);
$pdf->Cell( 59, 10, utf8_decode('INGRESOS NETO:'), 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$IngresoN Bs"), 1, 1, 'R');
//$pdf->SetXY( 10, 120);
$pdf->Cell( 59, 10, "CUENTAS POR COBRAR:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$CuentaPC Bs"), 1, 1, 'R');

//ENVIOS
//DATOS ENVIOS
	do{
			$ListaEnviosE;
			$ListaEnviosET;
			$ListaEnviosEX;
			$ListaEnviosD;
			$a=0;
			$b=0;
			$c=0;
			$d=0;
			$EnviosE=0;
			$EnviosET=0;
			$EnviosD=0;
			$EnviosEx=0;
			$GastoTotalEnvio=0;
			$PerdiadasEnvio=0;
				for($i=0;$i<count($resultN);$i++){
					$GastoTotalEnvio=$GastoTotalEnvio+$resultN[$i]['costo_envio'];
						if ($resultN[$i]['estado']=='1') {
							$EnviosET++;
							$ListaEnviosET[$a++]=$resultN[$i]['cod_nota_entrega'];
						}
						else if ($resultN[$i]['estado']=='2') {
							$EnviosE++;
							$ListaEnviosE[$b++]=$resultN[$i]['cod_nota_entrega'];
						}
						else if ($resultN[$i]['estado']=='3') {
							$EnviosEx++;
							$PerdiadasEnvio=$PerdiadasEnvio+$resultN[$i]['costo_envio'];
							$ListaEnviosEX[$c++]=$resultN[$i]['cod_nota_entrega'];
						}
						else if ($resultN[$i]['estado']=='4') {
							$EnviosD++;
							$PerdiadasEnvio=$PerdiadasEnvio+$resultN[$i]['costo_envio'];
							$ListaEnviosD[$d++]=$resultN[$i]['cod_nota_entrega'];
						}
						
				}
						if ($a=='0') {
							$ListaEnviosET=0;
						}
						if ($b=='0') {
							$ListaEnviosE=0;
						}
						if ($c=='0') {
							$ListaEnviosEX=0;
						}
						if ($d=='0') {
							$ListaEnviosD=0;
						}
			break;
		}while($row1 = $resultN );
//var_dump($d);
//$pdf->SetXY( 10, 125);
$pdf->Ln();
$pdf->SetFont('Arial','BU', 11);
$pdf->Cell( 42, 10, "ENVIOS ", 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','I', 9);
$pdf->Cell( 42, 10, "ENVIOS REALIZADOS:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$i"), 1, 1, 'C');
//$pdf->SetXY( 10, 130);
$pdf->Cell( 42, 10, "ENVIOS ENTREGADOS:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$EnviosE"), 1, 1, 'C');
//$pdf->SetXY( 10, 140);
$pdf->Cell( 42, 10, "ENVIOS EN TRANSITO:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$EnviosET"), 1, 1, 'C');
//$pdf->SetXY( 10, 145);
$pdf->Cell( 42, 10, "ENVIOS DEVUELTOS:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$EnviosD"), 1, 1, 'C');
//$pdf->SetXY( 10, 150);
$pdf->Cell( 42, 10, "ENVIOS EXTRAVIADOS:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$EnviosEx"), 1, 1, 'C');
//$pdf->SetXY( 10, 150);
$pdf->Cell( 42, 10, "GASTOS DE ENVIOS:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$GastoTotalEnvio Bs"), 1, 1, 'R');
//$pdf->SetXY( 10, 150);
$pdf->Cell( 42, 10, "PERDIDAS EN ENVIOS:", 1, 0, 'L');
$pdf->Cell( 29, 10, utf8_decode("$PerdiadasEnvio Bs"), 1, 1, 'R');
}

//LISTAS FACTURAS
$pdf->SetFont('Arial','BU', 11);
//PAGADAS
$pdf->SetXY( 100, 85);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell( 15, 10,utf8_decode('CODIGO:'), 1, 0, 'L');
for ($j=0; $j <count($listaFacP) ; $j++) { 
	$pdf->Cell( 7, 10, $listaFacP[$j], 1, 0, 'C');
}
//NO PAGADAS
$pdf->SetXY( 100, 95);
$pdf->Cell( 15, 10,utf8_decode('CODIGO:'), 1, 0, 'L');
for ($j=0; $j <count($listaFacN) ; $j++) { 
	$pdf->Cell( 7, 10, $listaFacN[$j], 1, 0, 'C');
}
//NO ANULADAS
$pdf->SetXY( 100, 105);
$pdf->Cell( 15, 10,utf8_decode('CODIGO:'), 1, 0, 'L');
for ($j=0; $j <count($listaFacA) ; $j++) { 
	$pdf->Cell( 7, 10, $listaFacA[$j], 1, 0, 'C');
}

//LISTAS ENVIOS
$pdf->SetFont('Arial','BU', 11);
//ENTREGADOS
$pdf->SetXY( 85, 185);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell( 15, 10,utf8_decode('CODIGO:'), 1, 0, 'L');
for ($j=0; $j <count($ListaEnviosE) ; $j++) { 
	$pdf->Cell( 9, 10, $ListaEnviosE[$j], 1, 0, 'C');
}
//EN TRANSITO
$pdf->SetXY( 85, 195);
$pdf->Cell( 15, 10,utf8_decode('CODIGO:'), 1, 0, 'L');
for ($j=0; $j <count($ListaEnviosET) ; $j++) { 
	$pdf->Cell( 9, 10, $ListaEnviosET[$j], 1, 0, 'C');
}
//DEVUELTOS
$pdf->SetXY( 85, 205);
$pdf->Cell( 15, 10,utf8_decode('CODIGO:'), 1, 0, 'L');
for ($j=0; $j <count($ListaEnviosEX) ; $j++) { 
	$pdf->Cell( 9, 10, $ListaEnviosEX[$j], 1, 0, 'C');
}
//EXTRAVIDADOS
$pdf->SetXY( 85, 215);
$pdf->Cell( 15, 10,utf8_decode('CODIGO:'), 1, 0, 'L');
for ($j=0; $j <count($ListaEnviosD) ; $j++) { 
	$pdf->Cell( 9, 10, $ListaEnviosD[$j], 1, 0, 'C');
}



//$pdf->Cell(60,10, utf8_decode("Elaborado por: {$rs['cuenta']}"),1);
$pdf->Output();
}
