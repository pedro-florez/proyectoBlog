<?php 

	/*
	|--------------------------------------------------------------------------|
	| 					 		   	 Cerrar Sesion						       |
	|--------------------------------------------------------------------------|
	*/
	
	# Iniciar Sesion si no Existe
	if (!isset($_SESSION)) {
		session_start();
	}

	# Eliminar Sesion
	if (isset($_SESSION['usuario'])) { session_destroy(); }

	#Redireccionar
	header('location: ../index.php');

?>