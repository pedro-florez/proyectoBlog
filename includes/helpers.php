<?php 

	# Mostrar Errores del Formulario
	function mostrarError($errores, $campo){

		$alerta = '';

		# Mostrar Session[Errores] si Existen y si no esta Vacio el campo
		if (isset($errores[$campo]) && !empty($campo)) {

			$alerta = '<div class="alerta alerta-error">'.$errores[$campo].'</div>';
		}

		return $alerta;		
	}

	# Borrar Errores del Formulario
	function borrarError(){

		# Eliminar Mensaje de Errores
		if (isset($_SESSION['errores'])) {

			$_SESSION['errores'] = null;
    		unset($_SESSION['errores']);			
		}

		# Eliminar Mensaje de Exito al Registrar Usuario
		if (isset($_SESSION['completado'])) {

			$_SESSION['completado'] = null;
    		unset($_SESSION['completado']);
		}	

		# Eliminar Mensaje de Exito al Crear Categoria
		if (isset($_SESSION['categoria-ok'])) {

			$_SESSION['categoria-ok'] = null;
    		unset($_SESSION['categoria-ok']);
		}

		# Eliminar Mensaje de Exito al Crear Entrada
		if (isset($_SESSION['entrada-ok'])) {

			$_SESSION['entrada-ok'] = null;
    		unset($_SESSION['entrada-ok']);
		}

		# Eliminar Mensaje de Exito al Borrar Entrada
		if (isset($_SESSION['borrado-ok'])) {

			$_SESSION['borrado-ok'] = null;
    		unset($_SESSION['borrado-ok']);
		}	

		return;		
	}

	# Mostrar Categorias
	function mostrarCategorias($conexion){

		$result = array();

		# Buscar las categorias
		$categorias = mysqli_query($conexion, 'SELECT * FROM categorias ORDER BY id ASC');

		# Validar si hay categorias
		if ($categorias && mysqli_num_rows($categorias) >= 1) {

			# enviar resultado
			$result = $categorias;
		}

		return $result;
	}

	# Buscar Categoria por ID
	function buscarIdCategoria($conexion, $id){

		$result = array();

		# Buscar las categorias
		$categoria = mysqli_query($conexion, "SELECT * FROM categorias WHERE id = $id;");

		# Validar si hay categorias
		if ($categoria && mysqli_num_rows($categoria) >= 1) {

			# enviar resultado
			$result = mysqli_fetch_assoc($categoria);
		}

		return $result;
	}

	# Mostrar Entradas 
	function mostrarEntradas($conexion, $item = null, $idCategoria = null, $idUsuario = null, $busqueda = null){

		$result = array();

		# Mostrar Todas las entradas
		$sql = "SELECT * , DATE_FORMAT(fecha, '%d %M %Y') AS fecha FROM entrdas_vistas ";

		# Mostrar Entradas por idCategoria
		if (!empty($idCategoria)) {
			$sql .= "WHERE idCategoria = $idCategoria ";
		}

		# Mostrar Entradas por idUsuario
		if (!empty($idUsuario)) {
			$sql .= "WHERE idUsuario = $idUsuario ";
		}

		# Mostrar Entradas por Busqueda
		if (!empty($busqueda)) {
			$sql .= "WHERE titulo LIKE '%$busqueda%' ";
		}

		# Ordenar por id modo Descendente
		$sql .= "ORDER BY id DESC ";

		# Mostrar Ultimas Entradas
		if ($item == 'ultimas') {
			$sql .= "LIMIT 5";
		}

		$entradas = mysqli_query($conexion, $sql);	

		# Validar si hay Entradas
		if ($entradas && mysqli_num_rows($entradas) >= 1) {

			# enviar resultado
			$result = $entradas;
		}

		return $result;
	}

	# Buscar Categoria por ID
	function buscarIdEntrada($conexion, $id){

		$result = array();

		# Buscar la entrada
		$entrada = mysqli_query($conexion, "SELECT *, DATE_FORMAT(fecha, '%d %M %Y') AS fecha FROM entrdas_vistas WHERE id = $id;");

		# Validar si hay entrada
		if ($entrada && mysqli_num_rows($entrada) >= 1) {

			# enviar resultado
			$result = mysqli_fetch_assoc($entrada);
		}

		return $result;
	}

?>