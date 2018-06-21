<?php

require_once '../controllers/usuario/check.php';
require_once '../controllers/usuario/logout.php';

$usuario = new Usuario();
$usuario->delSession();