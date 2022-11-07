<?php 
	/*
	|--------------------------------------------------------------------------|
	| 					 		  Actualizar Usuarios					       |
	|--------------------------------------------------------------------------|
	*/

	# Validar Formulario de Actualizar Usuario
	if (isset($_POST['micuenta'])) {

		require_once '../includes/conexion.php';	

		# Verificar datos POST
		$idUsuario  = $_SESSION['usuario']['id'];
		$nombre     = isset($_POST['nombre'])    ? mysqli_real_escape_string($db, $_POST['nombre'])    : false;
		$apellidos  = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
		$email		= isset($_POST['email'])     ? mysqli_real_escape_string($db, $_POST['email'])     : false;
		$password   = isset($_POST['password'])  ? mysqli_real_escape_string($db, $_POST['password'])  : false;	

		# Array de Errores
		$errores = array();

		# Validar Nombre
			if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {

				$nombre_validado = true;

			} else {

				$nombre_validado = false;
				$errores['nombre'] = 'El nombre no es válido';
			}

		# Validar Apellidos
			if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {

				$apellidos_validados = true;

			} else {
				
				$apellidos_validados = false;
				$errores['apellidos'] = 'Los apellidos no son válidos';
			}

		# Validar Email
			if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$email_validado = true;

			} else {
				
				$email_validado = false;
				$errores['email'] = 'El email no es válido';
			}

		# Validar Password
			if (!empty($password)) {

				# Encriptar Password
				$encriptar = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

			}else{

				# Guardar el que esta en la base de tados
				$encriptar = $_SESSION['usuario']['password'];
			}

		# Si no hay Errores 
		if (count($errores) == 0) {	

			# Validar Email Repetido
			$sqlemail = mysqli_query($db, "SELECT id, email FROM usuarios WHERE email = '$email'");
			$repetido = mysqli_fetch_assoc($sqlemail);

			# Verificar si id es igual al idUsuario
			if ($repetido['id'] == $idUsuario || empty($repetido)) {

				# Actualizar Usuario
				$sql = "UPDATE usuarios SET ".
					   "nombre = '$nombre', ".
					   "apellidos = '$apellidos', ".
					   "email = '$email', ".
					   "password = '$encriptar' ".
					   "WHERE id = ".$idUsuario;

				$guardar = mysqli_query($db, $sql);

				# Mostrar Error de base de dato
				//var_dump(mysqli_error($db));   die();

				# Validar el guardado
				if ($guardar) {

					# Actualizar la Variable de Sesion
					$_SESSION['usuario']['nombre']    = $nombre;
					$_SESSION['usuario']['apellidos'] = $apellidos;
					$_SESSION['usuario']['email']     = $email;
					$_SESSION['usuario']['password']  = $password;

					$_SESSION['completado'] = 'Los datos han sido guardados con éxito';	
				}else{

					$_SESSION['errores']['general'] = 'Error al actualizar datos';
				}
			
			}else{				

				$errores['email'] = 'El email '.$email.' ya existe';

				# Crear Sesion Errores
				$_SESSION['errores'] = $errores;
			}						

		}else{

			# Crear Sesion Errores
			$_SESSION['errores'] = $errores; 			
		}
	}

	# Redireccionar 
	header('location: ../micuenta.php');

?>