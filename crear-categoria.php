<?php require_once 'includes/redireccionar.php'; ?>	
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/barra_lateral.php'; ?>

<!--===================================
=            CREAR CATEGORIA          =
====================================-->
	<div id="caja-principal">

		<h1>Crear Categoria</h1>

		<!-- Alertas de Categoria -->	
		<?php if(isset($_SESSION['categoria-ok'])) : ?>

			<br>
			<div class="alerta alerta-exito">
				<?= $_SESSION['categoria-ok'] ?>				
			</div>

		<?php elseif(isset($_SESSION['errores']['crear-categoria'])) : ?>

			<br>
			<div class="alerta alerta-error">
				<?= $_SESSION['errores']['crear-categoria'] ?>				
			</div>

		<?php endif; ?>	

		<form action="acciones/gestor-categoria.php" method="POST">

			<p>
				Añade nuevas categorias al blog para que los usuarios puedan usarlas al crear sus entradas.				
			</p>

			<br>

			<label for="nombre">Nombre de Categoria : </label>
			<input type="text" name="nombre" placeholder="Ingresar nombre de la categoria" required>

			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre-categoria') : ''; ?>

			<input type="submit" name="categoria" value="Guardar">

		</form>

		<?php echo borrarError(); ?>

	</div>

<?php require_once 'includes/pie.php'; ?>
