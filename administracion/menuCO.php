<nav class="navbar small"  style="padding-top: 50px">
	<div class="container">
		<div class="row col-xs-12">
	        <div id="navbar" class="navbar-collapse navbar-default collapse">
	        	<ul class="nav navbar-nav">
	            	<li><a href="usuarios.php">Usuarios</a></li>
	            	<li><a href="notificar.php">Notificaciones</a></li>
					<li><a href="repcritico.php?regi=<?php echo $regOpe ?>">Reporte Cr&iacute;ticos</a></li>
	            	<?php if ($id_region == 99) { ?>
		            	<li><a href="capitulos.php">Descargar Archivos</a></li>
		            	<li><a href="repproc.php">Reporte Procesos</a></li>
		            	<li><a href="repaudit.php">Control Cambios</a></li>
		            	<!--li><a href="casos.php">Mantenimiento Casos</a></li-->
		            	<li><a href="periodos.php">Admin Periodos</a></li>
	            	<?php } ?>
	            	
	            	
	            	
	          	</ul>
	       </div><!--/.nav-collapse -->
       </div>
	</div>
</nav>
