<?php
	require_once '../views/notaEntrega/entregar.phtml';
	require_once '../models/nota_entrega.php';
    $notificacion = new NotaEntrega();
    $notificaciones = $notificacion->notificacionN();

    $contarN = 0;
    $a = 0;

    foreach($notificaciones as $value=>$item){  //$i=0; $i<count($notificaciones); $i++
    	//$value = $notificaciones[$i];
    	$valor = $item['notificacion'];

    	if($valor >= 3){
    		$contarN = $contarN += 1;
    		$arreglo1[$a++] = array(
    			$fechaE = $item['fecha_envio'],
    			$cod = $item['cod_nota_entrega'],
                $id = $item['id_nota_entrega']
    		);
    	}
    }