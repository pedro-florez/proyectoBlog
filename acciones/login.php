<?php
	/*
	|--------------------------------------------------------------------------|
	| 					 		   Ingreso de Usuarios					       |
	|--------------------------------------------------------------------------|
	*/ 

	# Validar Formulario de Login
	if (isset($_POST['login'])) {

		require_once '../includes/conexion.php';

		# Eliminar Errores de la Sesion Antigua Si Existen
		if (isset($_SESSION['error_login'])) { unset($_SESSION['error_login']); }		

		$email = trim($_POST['email']);
		$password = $_POST['password'];

		# Buscar email 
		$sql = mysqli_query($db, "SELECT * FROM usuarios WHERE email = '$email'");		

		# Verificar Si Existe Email
		if ($sql && mysqli_num_rows($sql) == 1) {

			# Mostrar Datos del Usuario
			$usuario = mysqli_fetch_assoc($sql);

			# Verificar la Password
			$verifica = password_verify($password, $usuario['password']);

			# $verifica = true
			if ($verifica) {

				# Almacenar los Datos del Usuario en una Session 
				$_SESSION['usuario'] = $usuario;							
			}

			# $verifica = false
			else{

				$_SESSION['error_login'] = 'Error la contraseña es incorrecta';
			}
			
		} else {

			$_SESSION['error_login'] = 'Error el email no existe';
		}
					
	}

	header('location: ../index.php');	

?>