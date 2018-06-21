<?php
	require_once '../views/facturas/pagar.phtml';
	require_once '../models/factura.php';
    $notificacion = new Factura();
    $notificaciones = $notificacion->notificacion();

    $contar = 0;
    $j = 0;

    foreach($notificaciones as $value=>$item){  //$i=0; $i<count($notificaciones); $i++
    	//$value = $notificaciones[$i];
    	$valor = $item['notificacion'];
    	//$fecha = $item['fecha'];
    	//$id = $value[$item['id_factura']];

    	if($valor >= 15){
    		$contar = $contar += 1;
    		$arreglo[$j++] = array(
    			$fecha = $item['fecha'],
    			$id = $item['id_factura']
    		);
    	}
    }