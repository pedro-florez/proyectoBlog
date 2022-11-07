<?php require_once 'includes/redireccionar.php'; ?>	
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/barra_lateral.php'; ?>

<!--===================================
=             CREAR ENTRADA           =
====================================-->
	<div id="caja-principal">

		<h1>Crear Entrada</h1>

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

		<form action="acciones/gestor-entrada.php" method="POST">

			<p>
				Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.	
			</p>

			<br>

			<label for="categoria">Categoria : </label>
			<select name="categoria" class="seleccionar">

				<option value="">-Seleccionar-</option>
				<!-- Mostrar Categorias -->	
				<?php 					

					$categorias = mostrarCategorias($db); 

					if(!empty($categorias)) :

						while ($categoria = mysqli_fetch_assoc($categorias)) :
				?>
							<option value="<?= $categoria['id']; ?>"><?= $categoria['nombre']; ?></option>
							
				<?php  endwhile; endif; ?>			

			</select>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria-entrada') : ''; ?>

			<label for="titulo">Titulo de la Entrada : </label>
			<input type="text" name="titulo" placeholder="Ingresar titulo de la entrada">
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'titulo-entrada') : ''; ?>

			<label for="descripcion">Descripción : </label>
			<textarea name="descripcion" cols="94" rows="6" placeholder="Ingresar descripción de la entrada"></textarea>
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'descripcion-entrada') : ''; ?>	

			<input type="submit" name="entrada" value="Guardar">

		</form>

		<?php echo borrarError(); ?>

	</div>

<?php require_once 'includes/pie.php'; ?>
