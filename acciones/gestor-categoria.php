<?php 
	/*
	|--------------------------------------------------------------------------|
	| 					 		   Crear Categoria						       |
	|--------------------------------------------------------------------------|
	*/

	# Validar Formulario de Crear Categoria
	if (isset($_POST['categoria'])) {

		require_once '../includes/conexion.php';	

		# Verificar nombre de categoria		
		$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

		# Array de Errores
		$errores = array();

		# Validar Nombre Categoria
			if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {

				$nombre_validado = true;

			} else {

				$nombre_validado = false;
				$errores['nombre-categoria'] = 'El nombre no es válido';
			}

		# Si no hay Errores 
		if (count($errores) == 0) {			
			
			# Guardar Categoria
			$sql = "INSERT INTO categorias VALUES(null, '$nombre', SYSDATE());";

			$guardar = mysqli_query($db, $sql);

			# Mostrar Error de base de dato
			//var_dump(mysqli_error($db));   die();

			# Validar el guardado
			if ($guardar) {

				$_SESSION['categoria-ok'] = 'La categoria ha sido creada con éxito';

			}else{

				$_SESSION['errores']['crear-categoria'] = 'Error al crear la categoria';
			}			

		}else{

			# Crear Sesion Errores
			$_SESSION['errores'] = $errores; 			
		}
	}

	# Redireccionar 
	header('location: ../crear-categoria.php');

?>