<?php 

require_once '../models/nota_entrega.php';

	$nota = new NotaEntrega();
	$nota_entrega = $nota->getNotaEnvio();