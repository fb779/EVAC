<?php
	// echo "string";
	// $qCap = $conn->query("SELECT * FROM capitulo_i WHERE vigencia = $vig AND C1_nordemp = $numero");
	// foreach ($qCap AS $row) {
	// 	$a=1;
	// }

	$tipousu = $_SESSION['tipou'];
	$estadObs = ($tipousu != "FU" ? "readonly" : "");

	// $qCapitulo = $conn->prepare("SELECT * FROM capitulo_i WHERE C1_nordemp = :nFuente AND vigencia = :periodo");
	// $qCapitulo->execute(array('nFuente'=>$numero, 'periodo'=>$vig));
	$qCapitulo = $conn->query("SELECT * FROM capitulo_i WHERE C1_nordemp = $numero AND vigencia = $vig");
	$row = $qCapitulo->fetch(PDO::FETCH_ASSOC);

	// $rowDisLink = $conn->query("SELECT id_displab from capitulo_i_displab WHERE C1_nordemp = $numero AND vigencia = $vig;");
	$rowDisCont = $conn->query("SELECT id_displab, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14 from capitulo_i_displab WHERE C1_nordemp = $numero AND vigencia = $vig;");

?>


<div class='container'>

	<input type="hidden" name="C1_nordemp" id="numero" value="<?php echo $numero ?>" />
	<input type="hidden" name="C1_numdisp" id="C1_numdisp" value="" />
	<fieldset style='border-style: solid; border-width: 1px'>
		<div>
			<h5 style='font-family: arial'><b>
				1. Durante el periodo de referencia
			</b></h5>
		</div>

		<div class="">
			<table>
				<tr>
					<td>
						<label class="col-xs-12 col-sm-7" >¿tuvo alguna vacante abierta a candidatos no vinculados con la empresa?</label>
					</td>
					<td>
						<?php
							if ($row['i1r1c1'] == 1){
								echo "Si";
							} elseif ($row['i1r1c1'] == 2){
								echo "No";
							}
						?>
					</td>
				</tr>
			</table>
		</div>
	</fieldset>

	<fieldset style='border-style: solid; border-width: 1px'>
		<div>
			<h5 style='font-family: arial'><b>2. Clasificacion de vacantes abiertas.</b></h5>
		</div>
		<div>
			Clasifique las vacantes abiertas durante el trimestre de referencia De acuerdo a las siguientes caracter&iacute;sticas: &Aacute;rea funcional, M&iacute;nimo nivel educativo requerido, &Aacute;rea de formaci&oacute;n, Experiencia en meses, Modalidad de contrataci&oacute;n, Salarios u honorarios y edad:
		</div>
		<div>
			<table>
				<tr>
					<td> <label class="">Total Vacantes</label> </td>
					<td> <label class="">Total Vacantes Cubiertas</label> </td>
					<td> <label class="">Total Vacantes No Cubiertas</label> </td>
				</tr>
				<tr>
					<td>
						<input type='text' value = "<?php echo $row['i1r1c2'];?>" />
					</td>
					<td>
						<input type='text' value = "<?php echo $row['i1r1c3']; ?>"  />
					</td>
					<td>
						<input type='text' value = "<?php echo $row['i1r1c4']; ?>"  />
					</td>
				</tr>
			</table>
		</div>

		<?php if  ( $rowDisCont->rowCount() == 0){ ?>
			<div>
				<label for="">No existen disponibilidades registradas para el "<?php echo $nomPeriodo;?>"</label>
			</div>
		<?php } ?>
		<?php $c=0; foreach ($rowDisCont as $dispc){ $c++; ?>
			<div>
				<label for="">Este módulo  determina la cantidad de vacantes durante el "<?php echo $nomPeriodo;?>" e  identifica sus características.</label>
			</div>
			<div>
				<table>
					<tr>
						<td colspan="3"> Disp <?php echo $c;?> </td>
					</tr>
					<tr>
						<td> <label class="">Cantidad de vacantes abiertas</label> </td>
						<td> <label class="">&Aacute;rea funcional</label> </td>
						<td> <label class="">Mínimo nivel educativo requerido</label> </td>
					</tr>
					<tr>
						<td>
							<input type='text' value = "<?php echo $dispc['i1r2c1'];?>"/>
							<?php //echo $dispc['i1r2c1'];?>
						</td>
						<td>
							<?php
								if ($dispc['i1r2c2'] == 1) { $dtAreaFuncional = 'Área de dirección general'; }
								elseif ($dispc['i1r2c2'] == 2) { $dtAreaFuncional = 'Área de administración'; }
								elseif ($dispc['i1r2c2'] == 3) { $dtAreaFuncional = 'Área de mercadeo/ventas'; }
								elseif ($dispc['i1r2c2'] == 4) { $dtAreaFuncional = 'Área de producción'; }
								elseif ($dispc['i1r2c2'] == 5) { $dtAreaFuncional = 'Área de contabilidad y finanzas'; }
								elseif ($dispc['i1r2c2'] == 6) { $dtAreaFuncional = 'Personal de Investigación y desarrollo'; }
								elseif ($dispc['i1r2c2'] == 7) { $dtAreaFuncional = 'Personal de apoyo'; }
							?>
							<input type="text" value="<?php echo $dtAreaFuncional; ?>">
							<?php //echo $dtAreaFuncional; ?>
						</td>
						<td>
							<?php
							 if ($dispc['i1r2c3'] == 1) { $dtnivelEducaivo = 'No bachiller'; }
							 elseif ($dispc['i1r2c3'] == 2) { $dtnivelEducaivo = 'Educación básica secundaria (6° - 9°)'; }
							 elseif ($dispc['i1r2c3'] == 3) { $dtnivelEducaivo = 'Educación media   (10° - 13°)'; }
							 elseif ($dispc['i1r2c3'] == 4) { $dtnivelEducaivo = 'Técnico laboral'; }
							 elseif ($dispc['i1r2c3'] == 5) { $dtnivelEducaivo = 'Técnico profesional'; }
							 elseif ($dispc['i1r2c3'] == 6) { $dtnivelEducaivo = 'Tecnólogo'; }
							 elseif ($dispc['i1r2c3'] == 7) { $dtnivelEducaivo = 'Estudiante universitario'; }
							 elseif ($dispc['i1r2c3'] == 8) { $dtnivelEducaivo = 'Profesional universitario'; }
							 elseif ($dispc['i1r2c3'] == 9) { $dtnivelEducaivo = 'Especialización '; }
							 elseif ($dispc['i1r2c3'] == 10) { $dtnivelEducaivo = 'Maestría'; }
							 elseif ($dispc['i1r2c3'] == 11) { $dtnivelEducaivo = 'Doctorado'; }
							 elseif ($dispc['i1r2c3'] == 12) { $dtnivelEducaivo = 'No requiere estudios'; }
							?>
							<input type="text" value="<?php echo $dtnivelEducaivo; ?>">
							<?php //echo $dtnivelEducaivo; ?>
						</td>
					</tr>
					<tr>
						<td> <label class="">Área de Formación</label> </td>
						<td> <label class="">Experiencia en meses</label> </td>
						<td> <label class="">Modalidad de Contratación</label> </td>
					</tr>
					<tr>
						<td>
							<?php
								if ( $dispc['i1r2c4'] == 1 ) { $dtAreaFun = 'Economía, Administración y Contaduría';}
								elseif ( $dispc['i1r2c4'] == 2 ) { $dtAreaFun = 'Ingeniería, Arquitectura Urbanismo y afines';}
								elseif ( $dispc['i1r2c4'] == 3 ) { $dtAreaFun = 'Ciencias Sociales y humanas';}
								elseif ( $dispc['i1r2c4'] == 4 ) { $dtAreaFun = 'Ciencias de la educación';}
								elseif ( $dispc['i1r2c4'] == 5 ) { $dtAreaFun = 'Ciencias de la salud';}
								elseif ( $dispc['i1r2c4'] == 6 ) { $dtAreaFun = 'Bellas artes';}
								elseif ( $dispc['i1r2c4'] == 7 ) { $dtAreaFun = 'Agronomía, Veterinaria';}
								elseif ( $dispc['i1r2c4'] == 8 ) { $dtAreaFun = 'Matemáticas y ciencias naturales';}
								elseif ( $dispc['i1r2c4'] == 9 ) { $dtAreaFun = 'No aplica';}
							?>
							<input type="text" value="<?php echo $dtAreaFun; ?>">
							<?php //echo $dtAreaFun; ?>
						</td>
						<td>
							<input type='text' value = "<?php echo $dispc['i1r2c5']; ?>" />
							<?php //echo $dispc['i1r2c5']; ?>
						</td>
						<td>
							<?php
								if ($dispc['i1r2c6'] == 1) { $dtModaContra = 'Término Indefinido'; }
								elseif ($dispc['i1r2c6'] == 2) { $dtModaContra = 'Término  Fijo'; }
								elseif ($dispc['i1r2c6'] == 3) { $dtModaContra = 'Prestación de servicios'; }
								elseif ($dispc['i1r2c6'] == 4) { $dtModaContra = 'Por  obra  o  labor  contratada'; }
								elseif ($dispc['i1r2c6'] == 5) { $dtModaContra = 'Ocasional ó Transitorio'; }
							?>
							<input type="text" value="<?php echo $dtModaContra; ?>">
							<?php //echo $dtModaContra; ?>
						</td>
					</tr>
					<tr>
						<td> <label class="">Salario u honorarios mensuales</label> </td>
						<td> <label class="">Edad</label> </td>
						<td> <label class="">De las vacantes ¿Cuántas logró cubrir?</label> </td>
					</tr>
					<tr>
						<td>
							<input type='text' value = "<?php echo $dispc['i1r2c7']; ?>" />
							<?php //echo $dispc['i1r2c7']; ?>
						</td>
						<td>
							<?php
								if ($dispc['i1r2c8'] == 1) { $dtEdad = '15 - 20'; }
								elseif ($dispc['i1r2c8'] == 2) { $dtEdad = '20 - 25'; }
								elseif ($dispc['i1r2c8'] == 3) { $dtEdad = '25 - 30'; }
								elseif ($dispc['i1r2c8'] == 4) { $dtEdad = '30 - 35'; }
								elseif ($dispc['i1r2c8'] == 5) { $dtEdad = '35 - 40'; }
								elseif ($dispc['i1r2c8'] == 6) { $dtEdad = '40 - 45'; }
								elseif ($dispc['i1r2c8'] == 7) { $dtEdad = '45 - 50'; }
								elseif ($dispc['i1r2c8'] == 8) { $dtEdad = '50 - 55'; }
								elseif ($dispc['i1r2c8'] == 9) { $dtEdad = '55 - 60'; }
								elseif ($dispc['i1r2c8'] == 10) { $dtEdad = '60 - 65'; }
								elseif ($dispc['i1r2c8'] == 11) { $dtEdad = '65 - 70'; }
								elseif ($dispc['i1r2c8'] == 12) { $dtEdad = '70 - 75'; }
								elseif ($dispc['i1r2c8'] == 13) { $dtEdad = '75 - 80'; }
								elseif ($dispc['i1r2c8'] == 14) { $dtEdad = '80 - 85'; }
								elseif ($dispc['i1r2c8'] == 15) { $dtEdad = '85 - 90'; }
								elseif ($dispc['i1r2c8'] == 16) { $dtEdad = 'Indiferente'; }
							?>
							<input type="text" value="<?php echo $dtEdad; ?>">
							<?php //echo $dtEdad; ?>
						</td>
						<td>
							<input type='text' value = "<?php echo $dispc['i1r2c9']; ?>"/>
							<?php //echo $dispc['i1r2c9']; ?>
						</td>
					</tr>
					<tr>
						<td> <label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label> </td>
						<td> <label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label> </td>
						<td> <label class="">De las vacantes ¿Cuántas NO logró cubrir? </label> </td>
					</tr>
					<tr>
						<td>
							<input type='text' value = "<?php echo $dispc['i1r2c10']; ?>" />
							<?php //echo $dispc['i1r2c10']; ?>
						</td>
						<td>
							<input type='text' value = "<?php echo $dispc['i1r2c11']; ?>" />
							<?php //echo $dispc['i1r2c11']; ?>
						</td>
						<td>
							<input type='text' value = "<?php echo $dispc['i1r2c12'];?>" />
							<?php //echo $dispc['i1r2c12'];?>
						</td>
					</tr>
					<tr>
						<td> <label>De las vacantes NO cubiertas ¿Cuáles fueron las causas?</label> </td>
						<td colspan="2"> <label class="">Cual?</label> </td>
					</tr>
					<tr>
						<td >
							<?php
								if ($dispc['i1r2c13'] == 1) { $dtNoCubiertas = 'La remuneración ofrecida era insuficiente';}
								elseif ($dispc['i1r2c13'] == 2) { $dtNoCubiertas = 'Postulantes sub-calificados';}
								elseif ($dispc['i1r2c13'] == 3) { $dtNoCubiertas = 'Postulantes sobre-calificados';}
								elseif ($dispc['i1r2c13'] == 4) { $dtNoCubiertas = 'Falta de experiencia o conocimiento específico';}
								elseif ($dispc['i1r2c13'] == 5) { $dtNoCubiertas = 'Los postulantes no dominaban otros idiomas';}
								elseif ($dispc['i1r2c13'] == 6) { $dtNoCubiertas = 'Pocos postulantes';}
								elseif ($dispc['i1r2c13'] == 7) { $dtNoCubiertas = 'Otra';}
								else { $dtNoCubiertas = 'No aplica'; }
							?>
							<input type="text" value="<?php echo $dtNoCubiertas; ?>">
							<?php //echo $dtNoCubiertas; ?>
						</td>
						<td colspan="2">
							<input type='text' value="<?php echo $dispc['i1r2c14']; ?>" />
							<?php //echo $dispc['i1r2c14']; ?>
						</td>
					</tr>
				</table>
			</div>
		<?php } ?>
	</fieldset>

	<fieldset style='border-style: solid; border-width: 1px'>
		<div>
			<h5 style='font-family: arial'><b>
				3. Para  las vacantes mencionadas en el numeral 1, Seleccione  el (los) medio(s) de publicación utilizado(s):
			</b></h5>
		</div>
		<table id="medios">
			<tr>
				<td>
					<label>
						<input type="checkbox" <?php echo ($row['i1r3c1'] == 1) ? 'checked' : ''?> required>
						Medios de comunicación (prensa,radio,tv)
					</label>
				</td>
				<td>
					<label>
						<input type="checkbox" <?php echo ($row['i1r3c2'] == 1) ? 'checked' : ''?> required>
						Servicio Público de Empleo
					</label>
				</td>
				<td>
					<label>
						<input type="checkbox" <?php echo ($row['i1r3c3'] == 1) ? 'checked' : ''?> required>
						Portales laborales WEB
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<input type="checkbox" id="idi1r3c4" class="chkbx" name="i1r3c4" value="<?php echo $row['i1r3c4']?>" <?php echo ($row['i1r3c4'] == 1) ? 'checked' : ''?> required>
						Agencias / bolsas de empleo / headhunters / firmas cazatalentos
					</label>
				</td>
				<td>
					<label>
						<input type="checkbox" id="idi1r3c5" class="chkbx" name="i1r3c5" value="<?php echo $row['i1r3c5']?>" <?php echo ($row['i1r3c5'] == 1) ? 'checked' : ''?> required>
						Universidades  e  instituciones educativas (oficinas de egresados)
					</label>
				</td>
				<td>
					<label>
						<input type="checkbox" id="idi1r3c6" class="chkbx" name="i1r3c6" value="<?php echo $row['i1r3c6']?>" <?php echo ($row['i1r3c6'] == 1) ? 'checked' : ''?> required>
						Contactos no  formales (colegas, amigos, empleados)
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<input type="checkbox" id="idi1r3c7" class="chkbx" name="i1r3c7" value="<?php echo $row['i1r3c7']?>" <?php echo ($row['i1r3c7'] == 1) ? 'checked' : ''?> required>
						Redes sociales o aplicaciones
					</label>
				</td>
				<td>
					<label>
						<input type="checkbox" id="idi1r3c8" class="chkbx" name="i1r3c8" value="<?php echo $row['i1r3c8']?>" <?php echo ($row['i1r3c8'] == 1) ? 'checked' : ''?> required>
						Otra no mencionada anteriormente
					</label>
				</td>
				<td>
					<label class="">Cual?</label>
					<div>
						<input type='text' class='form-control input-sm' id='idi1r3c9' name='i1r3c9' value = "<?php echo $row['i1r3c9']?>"  maxlength="50" required/>
					</div>
				</td>
			</tr>
		</table>
	</fieldset>

	<fieldset style='border-style: solid; border-width: 1px' id="" class="<?php //echo $estadoII3; ?>" >
		<div>
			<h5 style='font-family: arial'><b>
				<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?>
				4. De las vacantes mencionadas en el numeral 1.
			</b></h5>
		</div>
		<div >
			<table>
				<tr>
					<td><label class="">¿Cuántas requerían de una competencia certificada?</label></td>
					<td>
						<input type='text' class='form-control input-sm solo-numero' id='idi1r4c1' name='i1r4c1' value = "<?php echo $row['i1r4c1']; ?>" maxlength="3" required />
					</td>
				</tr>
			</table>
		</div>
	</fieldset>
	<fieldset style='border-style: solid; border-width: 1px'>
		<div><h4 style='font-family: arial'>Observaciones</h4></div>
		<div class='col-sm-6' style='padding-bottom: 10px'>
			<textarea class='form-control' rows='2' name='observaciones' id='obsfte' <?php echo $estadObs ?>><?php echo $row['OBSERVACIONES'] ?></textarea>
		</div>
	</fieldset>
</div>



