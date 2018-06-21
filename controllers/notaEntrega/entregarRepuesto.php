<?php 
require_once '../../models/nota_entrega.php';

$nota = new NotaEntrega();

if(!empty($_POST)){
	$nota->entregaRepuesto($_POST['id_nota_entrega'], $_POST['estado'],$_POST['fecha']);
}