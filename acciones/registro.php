<?php 
	/*
	|--------------------------------------------------------------------------|
	| 					 		  Registrar Usuarios					       |
	|--------------------------------------------------------------------------|
	*/

	# Validar Formulario de Registro
	if (isset($_POST['registrar'])) {

		require_once '../includes/conexion.php';
		require_once '../includes/validar_campo.php';

		# Iniciar Sesion si no existe
		if (!isset($_SESSION)) { session_start(); }		

		# Operador Ternario => { isset() Si existe ? valor $_POST['nombre'] Si no : False }
		# Escapar Datos => mysqli_real_escape_string($db, $_POST['nombre']); 
		$nombre     = isset($_POST['nombre'])    ? mysqli_real_escape_string($db, $_POST['nombre'])    : false;
		$apellidos  = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
		$email		= isset($_POST['email'])     ? mysqli_real_escape_string($db, $_POST['email'])     : false;
		$password   = isset($_POST['password'])  ? mysqli_real_escape_string($db, $_POST['password'])  : false;	

		# Array de Errores
		$errores = array();	

		# Validar Campos del formulario
		$validarNombre    = validarCampo('nombre', $nombre);
		$validarApellidos = validarCampo('apellidos', $apellidos);
		$validarEmail     = validarCampo('email', $email);
		$validarPassword  = validarCampo('password', $password);

		# Agregar Array de Errors si no es igual a OK
		if ($validarNombre != 'ok')    { $errores['nombre']     = $validarNombre; }
		if ($validarApellidos != 'ok') { $errores['apellidos']  = $validarApellidos; }
		if ($validarEmail != 'ok')     { $errores['email']      = $validarEmail; }
		if ($validarPassword != 'ok')  { $errores['password']   = $validarPassword; }		

		# Si no hay Valores en el Array Errores 
		if (count($errores) == 0) {

			# Encriptar Password
			$encriptar = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);		

			# Registrar	Usuario
			$sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$encriptar', SYSDATE());";

			$guardar = mysqli_query($db, $sql);

			# Mostrar Error de base de dato
			//var_dump(mysqli_error($db));   die();

			# Validar el guardado
			if ($guardar) {

				$_SESSION['completado'] = 'El registro ha sido guardado con éxito';	
			}else{

				$_SESSION['errores']['general'] = 'Error al registrar usuario';
			}			

		}else{

			# Crear Sesion Errores
			$_SESSION['errores'] = $errores; 			
		}
	}

	# Redireccionar 
	header('location: ../index.php');

?>