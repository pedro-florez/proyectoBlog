<?php 
	/*
	|--------------------------------------------------------------------------|
	| 					 		   Crear Entrada						       |
	|--------------------------------------------------------------------------|
	*/

	# Validar Formulario de Crear Entrada
	if (isset($_POST['entrada'])) {

		require_once '../includes/conexion.php';

		# Verificar los POST
		$usuario   = $_SESSION['usuario']['id'];
		$categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
		$titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
		$descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;

		# Array de Errores
		$errores = array();		

		# Validar Categoria
			if (empty($categoria)) {
				$errores['categoria-entrada'] = 'Debe seleccionar una categoria';
			}

		# Validar Titulo Entrada
			if (empty($titulo)) {
				$errores['titulo-entrada'] = 'El titulo esta vacio';
			}

		# Validar Descripción Entrada
			if (empty($descripcion)) {
				$errores['descripcion-entrada'] = 'La Descripcion esta vacia';
			}

		# Si no hay Errores 
		if (count($errores) == 0) {	

			$mensaje1 = '';
			$mensaje2 = '';

			# Si Existe $_GET['editar']
			if (isset($_GET['editar']) ) {

				# Variable enviada desde el action del formulario
				$idEntrada = $_GET['editar'];	

				# Editar Entrada
				$sql = "UPDATE entradas SET categoria_id=$categoria, titulo='$titulo', descripcion='$descripcion' ".
					   "WHERE id = $idEntrada AND usuario_id = $usuario;";	

				# mensaje de Actualizar	
				$mensaje1 = 'actualizada';	 
				$mensaje2 = 'actualizar';  

			}else{

				# Guardar Entrada
				$sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria, '$titulo', '$descripcion', SYSDATE());";

				# mensaje de Crear	
				$mensaje1 = 'creada';
				$mensaje2 = 'crear'; 
			}			

			$guardar = mysqli_query($db, $sql);

			# Mostrar Error de base de dato
			//var_dump(mysqli_error($db));   die();

			# Validar el guardado
			if ($guardar) {

				$_SESSION['entrada-ok'] = 'La entrada ha sido '.$mensaje1.' con éxito';

			}else{

				$_SESSION['errores']['no-entrada'] = 'Error al '.$mensaje2.' la entrada';
			}			

		}else{

			# Crear Sesion Errores
			$_SESSION['errores'] = $errores; 			
		}
	}

	# Si Existe $_GET['editar']
	if (isset($_GET['editar']) ) {

		# Redireccionar a Editar Entrada
		header('location: ../editar-entrada.php?id='.$_GET['editar']);

	}else{

		# Redireccionar a Crear Entrada
		header('location: ../crear-entrada.php');
	}	

?>