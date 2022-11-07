<?php 

	/*
	|--------------------------------------------------------------------------|
	| 					 		   	 Borrar Entradas 					       |
	|--------------------------------------------------------------------------|
	*/

	require_once '../includes/conexion.php';

	if (isset($_SESSION['usuario']) && isset($_GET['idEntrada'])) {

		$idUsuario = $_SESSION['usuario']['id'];
		$idEntrada = $_GET['idEntrada'];

		$sql = "DELETE FROM entradas WHERE usuario_id = $idUsuario AND id = $idEntrada";

		$borrar = mysqli_query($db, $sql);

		# Validar el Borrado
		if ($borrar) {

			$_SESSION['borrado-ok'] = 'La entrada ha sido borrada con éxito';	

		}else{

			$_SESSION['errores']['borrar-entrada'] = 'Error al borrar la entrada';
		}
	}	

	#Redireccionar
	header('location: ../mis-entradas.php');

?>