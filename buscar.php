
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/barra_lateral.php'; ?>

	<!--===================================
	=                BUSCAR              =
	====================================-->
	<div id="caja-principal">	

		<?php if (empty($_POST['busqueda'])) { header('location: index.php'); } # Validar la busqueda ?>	
		
		<h1>Busqueda: <?= $_POST['busqueda']; ?> </h1>

		<!-- Mostrar Entradas -->	
		<?php

			$entradas = mostrarEntradas($db, null, null, null, $_POST['busqueda']);

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

			<div class="alerta alerta-404">!Ooops no se encontraron resultados. </div>

		<?php endif; ?>		
		
	</div>

<?php require_once 'includes/pie.php'; ?>
		
		