
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/barra_lateral.php'; ?>

	<!--===================================
	=            CAJA PRINCIPAL           =
	====================================-->
	<div id="caja-principal">

		<h1>Ultimas entradas</h1>

		<!-- Mostrar Entradas -->	
		<?php

			$entradas = mostrarEntradas($db,'ultimas');

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

		<?php endif; 

			# Validar hay mas de 4 entradas
			$entradas_all = mostrarEntradas($db);

			if ($entradas_all && mysqli_num_rows($entradas_all) > 5) :			
		?>

			<!-- Boton Ver Todas las Entradas -->	
			<div id="ver-todas">

				<a href="entradas.php">Ver todas las entradas</a>
				
			</div>

		<?php endif; ?>
		
	</div>

<?php require_once 'includes/pie.php'; ?>
		
		