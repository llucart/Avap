<?php 

require_once '../models/vehiculo.php';

	$vehiculo = new Vehiculo();
	$vehiculos = $vehiculo->getVehiculo();