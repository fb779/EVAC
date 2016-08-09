<nav class="navbar navbar-default navbar-fixed-top small">
	<div class="container-fluid">
	    	<div class="navbar-header">
	        	<span class="navbar-brand">EVAC DISPONIBILIDAD LABORAL - <?php echo $rowRegion['nombre'] . " " . $pagina ?></span>
	        </div>
		<div id="navbar" class="navbar-collapse collapse">
	          	<ul class="nav navbar-nav navbar-right">
	          		<?php
	          			if (strpos($pagina, "DEVOL")) {
	          				echo "<li><a href='xlsListaDev.php'>Hist&oacute;rico Devoluciones</a></li>";
	          			}
	          		?>
	          		<?php
	          		if (strpos($pagina, "LISTA")===false) {
	          		?>
					<li><a href="operativo.php"  data-toggle='tooltip' title='Volver a operativo'>Volver a Inicio</a></li>
			        <li><a href="../navbar-static-top/"  data-toggle='tooltip' title='Cambiar Clave'><?php echo $nombre ?></a></li>
			        <li><a href="../index.php">Finalizar Sesi&oacute;n <span class="sr-only">(current)</span></a></li>
			        <?php
	          		}
			        ?>
	        	</ul>
		</div>
	</div>
</nav>