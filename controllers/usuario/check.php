<?php 

session_start();
	if(!isset($_SESSION["cuenta"])){
		header('Location:../pages/login');
		die();
	}