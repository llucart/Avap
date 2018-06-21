<?php 
require_once '../../models/nota_entrega.php';

$nota = new NotaEntrega();

if(!empty($_POST)){
	$nota->editNotaEnvio($_POST['id_nota_entrega'], $_POST['new_codigo'], $_POST['new_empresa'], $_POST['new_nro_guia'], $_POST['new_costo_envio'], $_POST['new_estado'], $_POST['new_fecha_envio'], $_POST['new_fecha_entrega']);
	header("Location: ../../pages/notaEntrega?semodifica");
}