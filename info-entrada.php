
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/barra_lateral.php'; ?>

	<!--===================================
	=            ENTRADA POR ID           =
	====================================-->
	<div id="caja-principal">

		<?php  $entrada = buscarIdEntrada($db, $_GET['id']);

			# Si no Existe entrada
			if (empty($entrada)) { header('location: index.php'); }
		?>

		<h1><?= $entrada['titulo']; ?></h1>

		<a href="categoria.php?id=<?= $entrada['idCategoria']; ?>">
			<h2><?= $entrada['categoria']; ?></h2>
		</a>

		<h4 style="color: #9e9e9e;"><?= $entrada['fecha']; ?> por @<?= $entrada['autor']; ?></h4>

		<p>
			<?= $entrada['descripcion']; ?>
		</p>			
		
	</div>

<?php require_once 'includes/pie.php'; ?>
		
		