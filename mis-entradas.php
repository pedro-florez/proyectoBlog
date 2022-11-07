<?php require_once 'includes/redireccionar.php'; ?>	
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/barra_lateral.php'; ?>

	<!--===================================
	=        ENTRADA POR ID_USUARIO       =
	====================================-->
	<div id="caja-principal">

		<h1>Mis Entradas</h1>

		<!-- Alertas de Entradas -->	
		<?php if(isset($_SESSION['borrado-ok'])) : ?>

			<div class="alerta alerta-exito">
				<?= $_SESSION['borrado-ok'] ?>				
			</div>

		<?php elseif(isset($_SESSION['errores']['borrar-entrada'])) : ?>

			<div class="alerta alerta-error">
				<?= $_SESSION['errores']['borrar-entrada'] ?>				
			</div>

		<?php endif; ?>	

		<!-- Mostrar Entradas -->	
		<?php

			$idUsuario = $_SESSION['usuario']['id'];

			$entradas = mostrarEntradas($db, null, null, $idUsuario);

			if(!empty($entradas)) :

				while ($entrada = mysqli_fetch_assoc($entradas)) :
		?>
					<article class="entradas">

						<a href="info-entrada.php?id=<?= $entrada['id']; ?>">

							<h2> <?= $entrada['titulo']; ?> </h2>
							<span class="fecha"> 
								<?= $entrada['categoria'].' | '.$entrada['fecha']; ?> 
							</span>

							<p>
							    <?php if(strlen($entrada['descripcion']) > 180): ?>

							        <?=substr($entrada['descripcion'], 0, 180)."..."?>

							    <?php else: ?>

							        <?=$entrada['descripcion']?>

							    <?php endif; ?>
							</p>
														
						</a>

						<!-- Boton Editar Entrada-->	
						<a href="editar-entrada.php?id=<?= $entrada['id'] ?>" class="boton boton-naranja min-boton">Editar</a>

						<!-- Boton Borrar Entrada-->	
						<a href="acciones/borrar-entrada.php?idEntrada=<?= $entrada['id'] ?>" class="boton boton-rojo min-boton">Borrar</a>
						
					</article>

		<?php 	endwhile; 

			else : 
		?>
			<br>

			<div class="alerta alerta-404">!Ooops Aun no has creado ninguna entrada. </div>

		<?php  endif;  echo borrarError(); ?>				
		
	</div>

<?php require_once 'includes/pie.php'; ?>
		
		