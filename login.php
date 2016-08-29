<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="panel panel-danger">
	            	<div class="panel-heading">
	              		<h3 class="panel-title">Ingreso de Usuarios</h3>
	            	</div>
	            	<div class="panel-body">
 	              		<form class="form-signin" method="post" action="index.php">
			    			<label for="inputLogin" >Usuario</label>
			    			<input type="text" id="inputLogin" name="inputLogin" class="form-control" placeholder="Usuario" required autofocus>
			    			<br/>
			    			<label for="inputPassword" >Contrase&ntilde;a</label>
			    			<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Contrase&ntilde;a" required>
			    			<br/>
			    			<button type="submit" id="btnIngresar" name="btnIngresar" class="btn btn-danger btn-block">Ingresar</button>
			    			<br/>
			    			<div class="text-center">
				    			<?php if (isset($mensaje)) {
				    				echo '<label class="text-danger">' . $mensaje .'</label>';

								}?>
			    			</div>

				  		</form>
				  		<br/>
				  		<p align="center">
<!-- 			  			<a href="<?php //echo site_url("/login/usuario"); ?>">Crear Usuarios</a><br/>  -->
<!-- 			  			<a href="<?php //echo site_url("/login/recordatorio"); ?>">&iquest; Olvid&oacute; su contrase&ntilde;a ?</a>  -->
				  		</p>
	            	</div>
	          	</div>
			</div>
			<div class="col-xs-12 col-sm-8">
				 <div class="jumbotron text-justify">
		        	 <h2>ENCUESTA DE VACANTES -EVAC</h2>
		        	 <h4>Se&ntilde;or Empresario:</h4>
					 <p>
						El Departamento Administrativo Nacional de Estad&iacute;stica DANE, en el marco de su plan de modernizaci&oacute;n de los instrumentos de recolecci&oacute;n de las encuestas econ&oacute;micas y con el prop&oacute;sito de agilizar y facilitar el reporte correcto y oportuno de los datos estad&iacute;sticos requeridos por la Encuesta de Vacantes - EVAC, pone a su disposici&oacute;n el presente formulario electr&oacute;nico, con el cual podrá diligenciar y verificar en linea la consistencia de su informaci&oacute;n.
					 </p>

					 <p>
					 	Un funcionario de nuestra entidad, estar&aacute; en todo momento atento para prestarle la asesor&iacute;a y orientaci&oacute;n necesaria.
					 </p>

					 <p><strong>
					 	Importante: Los datos que el DANE solicita en este formulario son estrictamente confidenciales y en ningún caso tienen fines fiscales ni pueden utilizarce como prueba judicial (Art. 5° Ley 79/93).

					 </strong></p>
	        	</div>

		   </div>
	   </div>
