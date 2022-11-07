<?php require_once 'includes/redireccionar.php'; ?>	
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/barra_lateral.php'; ?>

<!--===================================
=             EDITAR ENTRADA          =
====================================-->
	<div id="caja-principal">

		<?php  

			$usuario;

			$entrada = buscarIdEntrada($db, $_GET['id']);

			# Si no Existe entrada
			if (empty($entrada)) { 
				
				header('location: mis-entradas.php'); 
			}else{

				$idEntrada   = $entrada['id'];
				$idCategoria = $entrada['idCategoria'];
			}
		?>

		<h1>Editar Entrada (<?= $entrada['titulo']; ?>)</h1>

		<!-- Alertas de Entrada -->	
		<?php if(isset($_SESSION['entrada-ok'])) : ?>

			<br>
			<div class="alerta alerta-exito">
				<?= $_SESSION['entrada-ok'] ?>				
			</div>

		<?php elseif(isset($_SESSION['errores']['no-entrada'])) : ?>

			<br>
			<div class="alerta alerta-error">
				<?= $_SESSION['errores']['no-entrada'] ?>				
			</div>

		<?php endif; ?>			

		<form action="acciones/gestor-entrada.php?editar=<?= $idEntrada; ?>" method="POST">

			<p>
				Aqui puedes editar o modificar tu entrada.	
			</p>

			<br>

			<label for="categoria">Categoria : </label>
			<select name="categoria" class="seleccionar">

				<!-- Mostrar Categorias -->	
				<?php 					

					$categorias = mostrarCategorias($db); 

					if(!empty($categorias)) :

						while ($categoria = mysqli_fetch_assoc($categorias)) :
				?>
							<option value="<?= $categoria['id']; ?>" 
								<?= ($categoria['id'] == $idCategoria ? 'selected' : '') ?> >
								<?= $categoria['nombre']; ?>									
							</option>
							
				<?php  endwhile; endif; ?>	

			</select>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria-entrada') : ''; ?>

			<label for="titulo">Titulo de la Entrada : </label>
			<input type="text" name="titulo" value="<?= $entrada['titulo']; ?>" placeholder="Ingresar titulo de la entrada">
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'titulo-entrada') : ''; ?>

			<label for="descripcion">Descripción : </label>
			<textarea name="descripcion" cols="94" rows="6" placeholder="Ingresar descripción de la entrada"><?= $entrada['descripcion']; ?></textarea>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'descripcion-entrada') : ''; ?>	

			<input type="submit" name="entrada" value="Actualizar">

		</form>

		<?php echo borrarError(); ?>

	</div>

<?php require_once 'includes/pie.php'; ?>
