
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/barra_lateral.php'; ?>

	<!--===================================
	=         VER TODAS LAS ENTRADAS      =
	====================================-->
	<div id="caja-principal">

		<h1>Todas las entradas</h1>

		<!-- Mostrar Entradas -->	
		<?php

			$entradas = mostrarEntradas($db);

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

		<?php 	endwhile; endif; ?>		
		
	</div>

<?php require_once 'includes/pie.php'; ?>
		
		