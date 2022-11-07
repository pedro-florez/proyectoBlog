
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="utf-8">
		<title>Blog | Master</title>

		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	</head>

	<body>

		<!--==============================
		=            CABECERA            =
		===============================-->
		<header id="cabecera">

			<!-- LOGOTIPO -->			
			<div id="logo">
				<a href="index.php">
					Blog de Videojuegos
				</a>
			</div>

			<!-- MENU -->			
			<nav id="menu">
				<ul>
					<li><a href="index.php">Inicio </a></li>

					<!-- Mostrar Categorias -->	
					<?php 					

						$categorias = mostrarCategorias($db); 

						if(!empty($categorias)) :

							while ($categoria = mysqli_fetch_assoc($categorias)) :
					?>
								<li>
									<a href="categoria.php?id=<?= $categoria['id'];?>"> 
										<?= $categoria['nombre']; ?> 
									</a>
								</li>
								
					<?php  endwhile; endif; ?>

					<li><a href=""> Sobre Mi </a></li>
					<li><a href=""> Contacto </a></li>
				</ul>				
			</nav>

			<div class="clearfix"></div>

		</header>

		<!--===================================
		=              CONTENIDO              =
		====================================-->
		<div id="contenedor">