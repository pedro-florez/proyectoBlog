<?php require_once 'includes/redireccionar.php'; ?>	
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/barra_lateral.php'; ?>

<!--===================================
=             EDITAR CUENTA           =
====================================-->
	<div id="caja-principal">

		<h1>Mi Cuenta</h1>

		<!-- Alertas de Usuario -->	
		<?php if(isset($_SESSION['completado'])) : ?>

			<div class="alerta alerta-exito">
				<?= $_SESSION['completado'] ?>				
			</div>

		<?php elseif(isset($_SESSION['errores']['general'])) : ?>

			<div class="alerta alerta-error">
				<?= $_SESSION['errores']['general'] ?>				
			</div>

		<?php endif; ?>	

		<form action="acciones/actualizar-usuario.php" method="POST">

			<p>
				Aqui puedes modificar tus datos.
			</p> 

			<br>

			<label for="nombre">Editar Nombre :</label>
			<input type="text" name="nombre" placeholder="Ingresar Nombre" value="<?= $_SESSION['usuario']['nombre']; ?>">			
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

			<label for="apellidos">Editar Apellidos :</label>
			<input type="text" name="apellidos" placeholder="Ingresar Apellidos" value="<?= $_SESSION['usuario']['apellidos']; ?>">
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

			<label for="email">Editar Email :</label>
			<input type="email" name="email" placeholder="Ingresar correo" value="<?= $_SESSION['usuario']['email']; ?>">
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

			<label for="password">Cambiar Contraseña :</label>
			<input type="password" name="password" placeholder="Ingresar nueva contraseña">			

			<input type="submit" name="micuenta" value="Actualizar Datos">

		</form>	

		<?php echo borrarError(); ?>

	</div>

<?php require_once 'includes/pie.php'; ?>
