<!--===================================
=            BARRA LATERAL            =
====================================-->
<aside id="sidebar">

	<!-- Formulario de Busqueda -->				
	<div id="buscar" class="bloque">
		
		<h3>Buscar</h3>		

		<form action="buscar.php" method="POST">

			<input type="text" name="busqueda" placeholder="¿Qué estás buscando?">			
			<input type="submit" name="buscar" value="Buscar">

		</form>		

	</div>

	<!-- Panel de Control -->	
	<?php if(isset($_SESSION['usuario'])) : ?>
		
		<div id="panel" class="bloque">

			<h3> <?= 'Bienvenido, '.$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos']; ?> </h3>

			<!-- Boton Crear Entrada  -->	
			<a href="crear-entrada.php" class="boton">Crear Entrada</a>

			<!-- Boton Crear Categoria  -->	
			<a href="crear-categoria.php" class="boton boton-verde">Crear Categoria</a>

			<!-- Boton Mis Entradas-->	
			<a href="mis-entradas.php" class="boton boton-cris">Mis Entradas</a>

			<!-- Boton Mi Cuenta-->	
			<a href="micuenta.php" class="boton boton-celeste">Mi Cuenta</a>

			<!-- Boton Cerrar Sesion -->	
			<a href="acciones/salir.php" class="boton boton-rojo">Cerrar Sesion</a>

		</div>

	<?php endif; ?>

	<!-- Si no ha Iniciado Sesion -->	
	<?php if(!isset($_SESSION['usuario'])) : ?>

		<!-- Formulario de Ingreso -->				
		<div id="login" class="bloque">
			
			<h3>Iniciar Sesion</h3>		

			<form action="acciones/login.php" method="POST">

				<label for="email">Email</label>
				<input type="email" name="email" placeholder="Ingresar correo">

				<label for="password">Contraseña</label>
				<input type="password" name="password" placeholder="Ingresar contraseña">

				<?php if(isset($_SESSION['error_login'])) : ?>

					<div class="alerta alerta-error">
						<?= $_SESSION['error_login']; ?>				
					</div>

				<?php endif; ?>	
				
				<input type="submit" name="login" value="Entrar">

			</form>		

		</div>

		<!-- Formulario de Registro -->	
		<div id="register" class="bloque">
			
			<h3>Registrarse</h3>

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

			<form action="acciones/registro.php" method="POST">

				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" placeholder="Ingresar Nombre">			
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

				<label for="apellidos">Apellidos</label>
				<input type="text" name="apellidos" placeholder="Ingresar Apellidos">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

				<label for="email">Email</label>
				<input type="text" name="email" placeholder="Ingresar correo">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

				<label for="password">Contraseña</label>
				<input type="password" name="password" placeholder="Ingresar contraseña">
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

				<input type="submit" name="registrar" value="Registrar">

			</form>		

			<?php echo borrarError(); ?>

		</div>

	<?php endif; ?>
	
</aside>

