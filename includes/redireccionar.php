<?php 

	/*
	|--------------------------------------------------------------------------|
	| 					 		   Redireccionar Usuarios				       |
	|--------------------------------------------------------------------------|
	*/

	# Iniciar Sesion si no existe
	if (!isset($_SESSION)) {
		session_start();
	}	

	# Redireccionar si no esta logueado
	if (!isset($_SESSION['usuario'])) {
		header('location: index.php');
	}

?>