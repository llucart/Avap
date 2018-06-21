<?php 
date_default_timezone_set('America/Caracas');
setlocale(LC_ALL, "esp");

require_once '../../models/factura.php';
require_once '../../models/estadistica.php';

$facturaEst1 = new Factura();
$facturaEst2 = new Factura();
$facturaEst3 = new Factura();
$facturaEst4 = new Factura();
$estadistica1 = $facturaEst1->mes1();
$estadistica2 = $facturaEst2->mes2();
$estadistica3 = $facturaEst3->mes3();
$estadistica4 = $facturaEst4->mes4();


$pagadas1 = 0;$nopagadas1 = 0;$anuladas1 = 0;$totalp1 = 0;$totalnp1 = 0;$totala1 = 0;
$pagadas2 = 0;$nopagadas2 = 0;$anuladas2 = 0;$totalp2 = 0;$totalnp2 = 0;$totala2 = 0;
$pagadas3 = 0;$nopagadas3 = 0;$anuladas3 = 0;$totalp3 = 0;$totalnp3 = 0;$totala3 = 0;
$pagadas4 = 0;$nopagadas4 = 0;$anuladas4 = 0;$totalp4 = 0;$totalnp4 = 0;$totala4 = 0;
$mes1 = strftime("%B");
$mes2 = strftime("%B", mktime(0, 0, 0, date("m")-1,date("d"),date("Y"))); 
$mes3 = strftime("%B", mktime(0, 0, 0, date("m")-2,date("d"),date("Y")));
$mes4 = strftime("%B", mktime(0, 0, 0, date("m")-3,date("d"),date("Y")));  
$anio = date("Y");


for($i=0; $i<count($estadistica1); $i++){ 
	$rs = $estadistica1[$i];
	if($rs['estado'] == '1'){
		$pagadas1 = $pagadas1 + 1;
		$totalp1 = $totalp1 + $rs['total'];
	}else if($rs['estado'] == '2'){
		$nopagadas1 = $nopagadas1 + 1;
		$totalnp1 = $totalnp1 + $rs['total'];
	}else if($rs['estado'] == '3'){
		$anuladas1 = $anuladas1 + 1;
		$totala1 = $totala1 + $rs['total'];
	}
}

for($i=0; $i<count($estadistica2); $i++){ 
	$rs = $estadistica2[$i];
	if($rs['estado'] == '1'){
		$pagadas2 = $pagadas2 + 1;
		$totalp2 = $totalp2 + $rs['total'];
	}else if($rs['estado'] == '2'){
		$nopagadas2 = $nopagadas2 + 1;
		$totalnp2 = $totalnp2 + $rs['total'];
	}else if($rs['estado'] == '3'){
		$anuladas2 = $anuladas2 + 1;
		$totala2 = $totala2 + $rs['total'];
	}
}

for($i=0; $i<count($estadistica3); $i++){ 
	$rs = $estadistica3[$i];
	if($rs['estado'] == '1'){
		$pagadas3 = $pagadas3 + 1;
		$totalp3 = $totalp3 + $rs['total'];
	}else if($rs['estado'] == '2'){
		$nopagadas3 = $nopagadas3 + 1;
		$totalnp3 = $totalnp3 + $rs['total'];
	}else if($rs['estado'] == '3'){
		$anuladas3 = $anuladas3 + 1;
		$totala3 = $totala3 + $rs['total'];
	}
}

for($i=0; $i<count($estadistica4); $i++){ 
	$rs = $estadistica4[$i];
	if($rs['estado'] == '1'){
		$pagadas4 = $pagadas4 + 1;
		$totalp4 = $totalp4 + $rs['total'];
	}else if($rs['estado'] == '2'){
		$nopagadas4 = $nopagadas4 + 1;
		$totalnp4 = $totalnp4 + $rs['total'];
	}else if($rs['estado'] == '3'){
		$anuladas4 = $anuladas4 + 1;
		$totala4 = $totala4 + $rs['total'];
	}
}



$grafico=array(
	array('anio'=>$anio,'mes'=>$mes4,'pagadas'=>$pagadas4,'nopagadas'=>$nopagadas4,'anuladas'=>$anuladas4,'totalp'=>$totalp4, 'totala'=>$totala4, 'totalnp'=>$totalnp4),
	array('anio'=>$anio,'mes'=>$mes3,'pagadas'=>$pagadas3,'nopagadas'=>$nopagadas3,'anuladas'=>$anuladas3,'totalp'=>$totalp3, 'totala'=>$totala3, 'totalnp'=>$totalnp3),
	array('anio'=>$anio,'mes'=>$mes2,'pagadas'=>$pagadas2,'nopagadas'=>$nopagadas2,'anuladas'=>$anuladas2,'totalp'=>$totalp2, 'totala'=>$totala2, 'totalnp'=>$totalnp2),
	array('anio'=>$anio,'mes'=>$mes1,'pagadas'=>$pagadas1,'nopagadas'=>$nopagadas1,'anuladas'=>$anuladas1,'totalp'=>$totalp1, 'totala'=>$totala1, 'totalnp'=>$totalnp1)
);

echo json_encode($grafico,JSON_NUMERIC_CHECK);
