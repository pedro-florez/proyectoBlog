<?php 

	# Funcion Validar Campos
	function validarCampo($texto, $valor){

		$error = 'ok';

		$the = 'El ';
		$fin = 'vacio';

		# Validar el Valor Vacio
		if (empty($valor)){

			if ($texto == 'apellidos') { 

				$the = 'Los '; 
				$fin = 'vacios';
			}

			if ($texto == 'password') { 

				$the = 'La ';  
				$texto = 'contraseña'; 
				$fin = 'vacia';
			}

			$error = $the.$texto.' no puede ir '.$fin;

		}else{ 

			# Validacion para Nombre, Apellidos
			if ($texto != 'email' && $texto != 'password' && !preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $valor)) {

				$final = 'es valido';

				if ($texto == 'apellidos') { 

					$the = 'Los '; 
					$final = 'son validos';
				}

				$error = $the.$texto.' no '.$final;					
			}

			# Validacion Email
			if ($texto == 'email' && !filter_var($valor, FILTER_VALIDATE_EMAIL)) {

				$error = 'El email no es valido';
			}

			# Validacion Contraseña
			if ($texto == 'password' && !preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $valor)) {

				$error = 'La contraseña no es valida';					
			}
		}			

		return $error;
	}

?>