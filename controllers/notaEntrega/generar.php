<?php 
date_default_timezone_set('America/Caracas');
setlocale(LC_ALL, "esp");

require_once '../../models/nota_entrega.php';
require_once '../../models/estadistica.php';

$notaEst1 = new NotaEntrega();
$notaEst2 = new NotaEntrega();
$notaEst3 = new NotaEntrega();
$notaEst4 = new NotaEntrega();
$estadistica1 = $notaEst1->mes1();
$estadistica2 = $notaEst2->mes2();
$estadistica3 = $notaEst3->mes3();
$estadistica4 = $notaEst4->mes4();

$enviados1 = 0;$recibidos1 = 0;$extraviados1 = 0;$devueltos1 = 0;  
$enviados2 = 0;$recibidos2 = 0;$extraviados2 = 0;$devueltos2 = 0;  
$enviados3 = 0;$recibidos3 = 0;$extraviados3 = 0;$devueltos3 = 0;  
$enviados4 = 0;$recibidos4 = 0;$extraviados4 = 0;$devueltos4 = 0;

$costoE1 = 0; $costoR1 = 0; $costoEx1 = 0; $costoD1 = 0;//$totala1 = 0;
$costoE2 = 0; $costoR2 = 0; $costoEx2 = 0; $costoD2 = 0;//$totala2 = 0;
$costoE3 = 0; $costoR3 = 0; $costoEx3 = 0; $costoD3 = 0;//$totala3 = 0;
$costoE4 = 0; $costoR4 = 0; $costoEx4 = 0; $costoD4 = 0;//$totala4 = 0;  
$costot1 = 0;
$costot2 = 0;
$costot3 = 0;
$costot4 = 0;

$mes1 = strftime("%B");
$mes2 = strftime("%B", mktime(0, 0, 0, date("m")-1,date("d"),date("Y"))); 
$mes3 = strftime("%B", mktime(0, 0, 0, date("m")-2,date("d"),date("Y")));
$mes4 = strftime("%B", mktime(0, 0, 0, date("m")-3,date("d"),date("Y")));  
$anio = date("Y");

for($i=0; $i<count($estadistica1); $i++){ 
	$rs = $estadistica1[$i];
	if($rs['estado'] == '1'){
		$enviados1 = $enviados1 + 1;
		$costoE1 = $costoE1 + $rs['costo_envio'];
	}else if($rs['estado'] == '2'){
		$recibidos1 = $recibidos1 + 1;
		$costoR1 = $costoR1 + $rs['costo_envio'];
	}else if($rs['estado'] == '3'){
		$extraviados1 = $extraviados1 + 1;
		$costoEx1 = $costoEx1 + $rs['costo_envio'];
	}
	else if($rs['estado'] == '4'){
		$devueltos1 = $devueltos1 + 1;
		$costoD1 = $costoD1 + $rs['costo_envio'];
	}
}
$costot1=$costoE1+$costoR1+$costoEx1+$costoD1;

for($i=0; $i<count($estadistica2); $i++){ 
	$rs = $estadistica2[$i];
	if($rs['estado'] == '1'){
		$enviados2 = $enviados2 + 1;
		$costoE2 = $costoE2 + $rs['costo_envio'];
	}else if($rs['estado'] == '2'){
		$recibidos2 = $recibidos2 + 1;
		$costoR2 = $costoR2 + $rs['costo_envio'];
	}else if($rs['estado'] == '3'){
		$extraviados2 = $extraviados2 + 1;
		$costoEx2 = $costoEx2 + $rs['costo_envio'];
	}
	else if($rs['estado'] == '3'){
		$devueltos2 = $devueltos2 + 1;
		$costoD2 = $costoD2 + $rs['costo_envio'];
	}
}
$costot2=$costoE2+$costoR2+$costoEx2+$costoD2;

for($i=0; $i<count($estadistica3); $i++){ 
	$rs = $estadistica3[$i];
	if($rs['estado'] == '1'){
		$enviados3 = $enviados3 + 1;
		$costoE3 = $costoE3 + $rs['costo_envio'];
	}else if($rs['estado'] == '2'){
		$recibidos3 = $recibidos3 + 1;
		$costoR3 = $costoR3 + $rs['costo_envio'];
	}else if($rs['estado'] == '3'){
		$extraviados3 = $extraviados3 + 1;
		$costoEx3 = $costoEx3 + $rs['costo_envio'];
	}
	else if($rs['estado'] == '4'){
		$devueltos3 = $devueltos3 + 1;
		$costoD3 = $costoD3 + $rs['costo_envio'];
	}
}
$costot3=$costoE3+$costoR3+$costoEx3+$costoD3;

for($i=0; $i<count($estadistica4); $i++){ 
	$rs = $estadistica4[$i];
	if($rs['estado'] == '1'){
		$enviados4 = $enviados4 + 1;
		$costoE4 = $costoE4 + $rs['costo_envio'];
	}else if($rs['estado'] == '2'){
		$recibidos4 = $recibidos4 + 1;
		$costoR4 = $costoR4 + $rs['costo_envio'];
	}else if($rs['estado'] == '3'){
		$extraviados4 = $extraviados4 + 1;
		$costoEx4 = $costoEx4 + $rs['costo_envio'];
	}
	else if($rs['estado'] == '4'){
		$devueltos4 = $devueltos4 + 1;
		$costoD4 = $costoD4 + $rs['costo_envio'];
	}
}
$costot4=$costoE4+$costoR4+$costoEx4+$costoD4;

// echo '<pre>';
// //MES1 
//var_dump($costot1);
//var_dump($costot2);
//var_dump($costot3);
//var_dump($costot4);


// var_dump($pagadas1);
// var_dump($totalp1);
// var_dump($nopagadas1);
// var_dump($totalnp1);
// var_dump($anuladas1);
// //MES2
// var_dump($mes2);
// var_dump($pagadas2);
// var_dump($totalp1);
// var_dump($nopagadas2);
// var_dump($totalnp2);
// var_dump($anuladas2);
// //MES3 
// var_dump($mes3);
// var_dump($pagadas3);
// var_dump($totalp3);
// var_dump($nopagadas3);
// var_dump($totalnp3);
// var_dump($anuladas3);
// //MES4 
// var_dump($mes4);
// var_dump($pagadas4);
// var_dump($totalp4);
// var_dump($nopagadas4);
// var_dump($totalnp4);
// var_dump($anuladas4);


$grafico1=array(
	array('anio'=>$anio,'mes'=>$mes4,'enviados'=>$enviados4,'recibidos'=>$recibidos4,'extraviados'=>$extraviados4,'devueltos'=>$devueltos4,'costoE'=>$costoE4,'costoR'=>$costoR4,'costoEx'=>$costoEx4,'costoD'=>$costoD4,'costot'=>$costot4),
	array('anio'=>$anio,'mes'=>$mes3,'enviados'=>$enviados3,'recibidos'=>$recibidos3,'extraviados'=>$extraviados3,'devueltos'=>$devueltos3,'costoE'=>$costoE3,'costoR'=>$costoR3,'costoEx'=>$costoEx3,'costoD'=>$costoD3,'costot'=>$costot3),
	array('anio'=>$anio,'mes'=>$mes2,'enviados'=>$enviados2,'recibidos'=>$recibidos2,'extraviados'=>$extraviados2,'devueltos'=>$devueltos2,'costoE'=>$costoE2,'costoR'=>$costoR2,'costoEx'=>$costoEx2,'costoD'=>$costoD2,'costot'=>$costot2),
	array('anio'=>$anio,'mes'=>$mes1,'enviados'=>$enviados1,'recibidos'=>$recibidos1,'extraviados'=>$extraviados1,'devueltos'=>$devueltos1,'costoE'=>$costoE1,'costoR'=>$costoR1,'costoEx'=>$costoEx1,'costoD'=>$costoD1,'costot'=>$costot1)
);

echo json_encode($grafico1,JSON_NUMERIC_CHECK);
