
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/barra_lateral.php'; ?>

	<!--===================================
	=    CATEGORIA CON ENTRADAS POR ID    =
	====================================-->
	<div id="caja-principal">

		<?php $categoria = buscarIdCategoria($db, $_GET['id']);

			# Si no Existe categoria
			if (empty($categoria)) { header('location: index.php'); }
		?>
		
		<h1><?= $categoria['nombre']; ?> </h1>

		<!-- Mostrar Entradas -->	
		<?php

			$entradas = mostrarEntradas($db, null, $_GET['id']);

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
						
					</article>	

		<?php 	endwhile; 

			else : 
		?>
			<br>

			<div class="alerta alerta-404">!Ooops no hay entradas en este momento. </div>

		<?php endif; ?>		
		
	</div>

<?php require_once 'includes/pie.php'; ?>
		
		