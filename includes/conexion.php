
<?php 

	# Conectar a la Base de Datos	
		$server   = 'localhost';
		$username = 'root';
		$password = '';
		$database = 'blog_master';

		$db = mysqli_connect($server, $username, $password, $database);

	# Configurar los Caracteres especiales y Dias dela Semana en Español
		mysqli_query($db, "SET NAMES 'utf8', lc_time_names = 'es_ES'");

	# Iniciar Sesion si no Existe
		if (!isset($_SESSION)) {
			session_start();
		}
		
?>