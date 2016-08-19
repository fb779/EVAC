<?php
	$qCap = $conn->query("SELECT * FROM capitulo_i WHERE vigencia = $vig AND C1_nordemp = $numero");
	foreach ($qCap AS $row) {
		$a=1;
	}

	$tipousu = $_SESSION['tipou'];
	$estadObs = ($tipousu != "FU" ? "readonly" : "");

	$qCapitulo = $conn->prepare("SELECT * FROM capitulo_i WHERE C1_nordemp = :nFuente AND vigencia = :periodo");
	$qCapitulo->execute(array('nFuente'=>$numero, 'periodo'=>$vig));
	$row = $qCapitulo->fetch(PDO::FETCH_ASSOC);

	$rowDisLink = $conn->query("SELECT id_displab from capitulo_i_displab WHERE C1_nordemp = $numero AND vigencia = $vig;");
	$rowDisCont = $conn->query("SELECT id_displab, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14 from capitulo_i_displab WHERE C1_nordemp = $numero AND vigencia = $vig;");

	// print_r($row);
?>


<div class='container'>

	<input type="hidden" name="C1_nordemp" id="numero" value="<?php echo $numero ?>" />
	<input type="hidden" name="C1_numdisp" id="C1_numdisp" value="" />
	<fieldset style='border-style: solid; border-width: 1px'>
		<legend>
			<h5 style='font-family: arial'><b>
				<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii1&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?>
				1. Durante el periodo de referencia
			</b></h5>
		</legend>

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
		<legend>
			<h5 style='font-family: arial'><b><?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii2&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?>
				2. Clasifique las vacantes abiertas durante el trimestre de referencia de acuerdo a las siguientes caracter&iacute;sticas: </br>
				&Aacute;rea funcional, M&iacute;nimo nivel educativo requerido, &Aacute;rea de formaci&oacute;n, Experiencia en meses, Modalidad de contrataci&oacute;n, Salarios u honorarios y edad:
			</b></h5>
			<div style="color:red;"><h6 > Nota: Si más de una vacante presenta las mismas características relacionelas en una sola fila, si alguna de ellas difiere agregue otra. </h6></div>
		</legend>
			<div>
				<table>
					<tr>
						<td> <label class="">Total Vacantes</label> </td>
						<td> <label class="">Total Vacantes Cubiertas</label> </td>
						<td> <label class="">Total Vacantes No Cubiertas</label> </td>
					</tr>
					<tr>
						<td>
							<input type='text' value = "<?php echo $row['i1r1c2'];?>" readonly />
						</td>
						<td>
							<input type='text' value = "<?php echo $row['i1r1c3']; ?>" readonly  />
						</td>
						<td>
							<input type='text' value = "<?php echo $row['i1r1c4']; ?>" readonly  />
						</td>
					</tr>
				</table>
			</div>


		<div class="container-fluid">
			<div class="col-xs-12 col-sm-12">
				<label for="">Este módulo  determina la cantidad de vacantes durante el "<?php echo $nomPeriodo;?>" e  identifica sus características.</label>
			</div>
			<div class="col-xs-12">
				<div id="disNoti" class="alert alert-warning text-center hidden" role="alert">
					<!-- button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button-->
					<div id="diNoMensaje" class="row">
					</div>
				</div>
			</div>
			<?php foreach ($rowDisCont as $dispc){  ?>
				<div>
					<table border="">
						<tr>
							<td colspan="4">
								Disp <?php //echo $c;?>
							</td>
						</tr>
						<tr>
							<td> <label class="">Cantidad de vacantes abiertas</label> </td>
							<td> <label class="">&Aacute;rea funcional</label> </td>
							<td> <label class="">Mínimo nivel educativo requerido</label> </td>
							<td></td>
						</tr>
						<tr>
							<td>
								<input type='text' value = "<?php //echo $dispc['i1r2c1'];?>" required/>
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
							</td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td colspan="3"></td>
						</tr>
						<tr>
							<td ></td>
							<td colspan="3"></td>
						</tr>
					</table>
				</div>
			<?php } ?>

			<div class="col-xs-12 col-sm-12">
				<p>
					<ul id="listDisTab" class="nav nav-tabs" >
						<?php $c = 1; foreach ($rowDisLink as $displ){  ?>
						<li class="<?php echo ($c==1)?'active':''; ?>"><a href="#disp<?php echo $c;?>" data-toggle="tab">Disp <?php echo $c;?></a></li>
						<?php $c++; } ?>
					</ul>
				</p>
				<p>
					<div id="listDisForm" class="tab-content">
						<?php $z = 1; ?>
						<?php foreach ($rowDisCont as $dispc){  ?>
						<?php $ncam = 'i1r2c' . $z; ?>
						<div class="tab-pane <?php echo ($z==1)?'active':''; ?>" id="disp<?php echo $z; ?>">
							<div class="col-xs-12">
								<h4 class="text-danger">Todos los campos son obligatorios</h4>
							</div>
							<div id="carateriza<?php echo $z; ?>" class="text-center">
								<div class="container-fluid small">
									<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
										<label class="">Área de Formación</label>
										<div class='small'>
											<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>3" required>
												<option value="" > Seleccione una opción</option>
												<option value="1" <?php echo ($dispc['i1r2c4'] == 1) ? 'selected' : '';  ?> >Economía, Administración y Contaduría</option>
												<option value="2" <?php echo ($dispc['i1r2c4'] == 2) ? 'selected' : '';  ?> >Ingeniería, Arquitectura Urbanismo y afines</option>
												<option value="3" <?php echo ($dispc['i1r2c4'] == 3) ? 'selected' : '';  ?> >Ciencias Sociales y humanas</option>
												<option value="4" <?php echo ($dispc['i1r2c4'] == 4) ? 'selected' : '';  ?> >Ciencias de la educación</option>
												<option value="5" <?php echo ($dispc['i1r2c4'] == 5) ? 'selected' : '';  ?> >Ciencias de la salud</option>
												<option value="6" <?php echo ($dispc['i1r2c4'] == 6) ? 'selected' : '';  ?> >Bellas artes</option>
												<option value="7" <?php echo ($dispc['i1r2c4'] == 7) ? 'selected' : '';  ?> >Agronomía, Veterinaria</option>
												<option value="8" <?php echo ($dispc['i1r2c4'] == 8) ? 'selected' : '';  ?> >Matemáticas y ciencias naturales</option>
												<option value="9" <?php echo ($dispc['i1r2c4'] == 9) ? 'selected' : '';  ?> >No aplica</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-1"></div>
									<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
										<label class="">Experiencia en meses</label>
										<div class='small'>
											<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php echo $ncam; ?>4' value = "<?php echo $dispc['i1r2c5']?>" maxlength="3" required />
										</div>
									</div>
									<div class="col-xs-12 col-sm-1"></div>
									<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
										<label class="">Modalidad de Contratación</label>
										<div class='small'>
											<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>5" required>
												<option value="" > Seleccione una opción</option>
												<option value="1" <?php echo ($dispc['i1r2c6'] == 1) ? 'selected' : '';  ?> >Término Indefinido</option>
												<option value="2" <?php echo ($dispc['i1r2c6'] == 2) ? 'selected' : '';  ?> >Término  Fijo</option>
												<option value="3" <?php echo ($dispc['i1r2c6'] == 3) ? 'selected' : '';  ?> >Prestación de servicios</option>
												<option value="4" <?php echo ($dispc['i1r2c6'] == 4) ? 'selected' : '';  ?> >Por  obra  o  labor  contratada</option>
												<option value="5" <?php echo ($dispc['i1r2c6'] == 5) ? 'selected' : '';  ?> >Ocasional ó Transitorio</option>
											</select>
										</div>
									</div>
								</div>
								<div class="container-fluid small">
									<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
										<label class="">Salario u honorarios mensuales</label>
										<div class='input-group input-group-sm'>
											<span class="input-group-addon" id="sizing-addon1">$</span>
											<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php echo $ncam; ?>6' value = "<?php echo $dispc['i1r2c7']?>" maxlength="9" required />
										</div>
									</div>
									<div class="col-xs-12 col-sm-1"></div>
									<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
										<label class="">Edad</label>
										<div class='small'>
											<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>7" required>
												<option value="" > Seleccione una opción</option>
												<option value="1" <?php echo ($dispc['i1r2c8'] == 1) ? 'selected' : '';  ?> >15 - 20</option>
												<option value="2" <?php echo ($dispc['i1r2c8'] == 2) ? 'selected' : '';  ?> >20 - 25</option>
												<option value="3" <?php echo ($dispc['i1r2c8'] == 3) ? 'selected' : '';  ?> >25 - 30</option>
												<option value="4" <?php echo ($dispc['i1r2c8'] == 4) ? 'selected' : '';  ?> >30 - 35</option>
												<option value="5" <?php echo ($dispc['i1r2c8'] == 5) ? 'selected' : '';  ?> >35 - 40</option>
												<option value="6" <?php echo ($dispc['i1r2c8'] == 6) ? 'selected' : '';  ?> >40 - 45</option>
												<option value="7" <?php echo ($dispc['i1r2c8'] == 7) ? 'selected' : '';  ?> >45 - 50</option>
												<option value="8" <?php echo ($dispc['i1r2c8'] == 8) ? 'selected' : '';  ?> >50 - 55</option>
												<option value="9" <?php echo ($dispc['i1r2c8'] == 9) ? 'selected' : '';  ?> >55 - 60</option>
												<option value="10" <?php echo ($dispc['i1r2c8'] == 10) ? 'selected' : '';  ?> >60 - 65</option>
												<option value="11" <?php echo ($dispc['i1r2c8'] == 11) ? 'selected' : '';  ?> >65 - 70</option>
												<option value="12" <?php echo ($dispc['i1r2c8'] == 12) ? 'selected' : '';  ?> >70 - 75</option>
												<option value="13" <?php echo ($dispc['i1r2c8'] == 13) ? 'selected' : '';  ?> >75 - 80</option>
												<option value="14" <?php echo ($dispc['i1r2c8'] == 14) ? 'selected' : '';  ?> >80 - 85</option>
												<option value="15" <?php echo ($dispc['i1r2c8'] == 15) ? 'selected' : '';  ?> >85 - 90</option>
												<option value="16" <?php echo ($dispc['i1r2c8'] == 16) ? 'selected' : '';  ?> >Indiferente</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-1"></div>
									<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
										<label class="">De las vacantes ¿Cuántas logró cubrir?</label>
										<div class='small'>
											<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php echo $ncam; ?>8' value = "<?php echo $dispc['i1r2c9']?>" maxlength="9" required />
										</div>
									</div>
								</div>
								<div class="container-fluid small">
									<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
										<label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label>
										<div class='small'>
											<input type='text' class='form-control input-sm text-right validar' id='' name='<?php echo $ncam; ?>9' value = "<?php echo $dispc['i1r2c10']?>" maxlength="9" required />
										</div>
									</div>
									<div class="col-xs-12 col-sm-1"></div>
									<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
										<label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label>
										<div class='small'>
											<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php echo $ncam; ?>10' value = "<?php echo $dispc['i1r2c11']?>" maxlength="9" readonly required />
										</div>
									</div>
									<div class="col-xs-12 col-sm-1"></div>
									<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
										<label class="">De las vacantes ¿Cuántas NO logró cubrir? </label>
										<div class='small'>
											<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php echo $ncam; ?>11' value = "<?php echo $dispc['i1r2c12']?>" maxlength="9" readonly required />
										</div>
									</div>
								</div>
								<div class="container-fluid small">
									<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
										<label>De las vacantes NO cubiertas ¿Cuáles fueron las causas?</label>
										<div class="small">
											<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>12" <?php echo ($dispc['i1r2c13']>0)?'':'disabled' ?>>
												<option value="" > Seleccione una opción</option>
												<option value="1" <?php echo ($dispc['i1r2c13'] == 1) ? 'selected' : '';  ?> >La remuneración ofrecida era insuficiente</option>
												<option value="2" <?php echo ($dispc['i1r2c13'] == 2) ? 'selected' : '';  ?> >Postulantes sub-calificados</option>
												<option value="3" <?php echo ($dispc['i1r2c13'] == 3) ? 'selected' : '';  ?> >Postulantes sobre-calificados</option>
												<option value="4" <?php echo ($dispc['i1r2c13'] == 4) ? 'selected' : '';  ?> >Falta de experiencia o conocimiento específico</option>
												<option value="5" <?php echo ($dispc['i1r2c13'] == 5) ? 'selected' : '';  ?> >Los postulantes no dominaban otros idiomas</option>
												<option value="6" <?php echo ($dispc['i1r2c13'] == 6) ? 'selected' : '';  ?> >Pocos postulantes</option>
												<option value="7" <?php echo ($dispc['i1r2c13'] == 7) ? 'selected' : '';  ?> >Otra</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-1"></div>
									<div class="form-group form-group-sm col-xs-12 col-sm-7">
										<label class="">Cual?</label>
										<div>
											<input type='text' class='form-control input-sm validar' id='' name='<?php echo $ncam; ?>13' maxlength="50" value="<?php echo $dispc['i1r2c14']?>" <?php echo (isset($dispc['i1r2c14']))?'':'disabled' ?> />
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php $z++; } ?>
					</div>
				</p>
			</div>
	</fieldset>
	<fieldset style='border-style: solid; border-width: 1px' id="">
		<legend>
			<h5 style='font-family: arial'><b>
				3. Para  las vacantes mencionadas en el numeral 1, Seleccione  el (los) medio(s) de publicación utilizado(s):
			</b></h5>
		</legend>
		<div id="ii3contenido" class="container-fluid hidden">
			<div class="col-sx-12 text-danger"> <h4>Debe seleccionar alguno de los valores </h4> </div>
		</div>
		<div id="msCheck" class="container-fluid text-danger text-center"></div>
		<div id="medPub">
			<div class="container-fluid">
				<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="idi1r3c1" class="chkbx" name="i1r3c1" value="<?php echo $row['i1r3c1']?>" <?php echo ($row['i1r3c1'] == 1) ? 'checked' : ''?> required>
							Medios de comunicación (prensa,radio,tv)
						</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-2">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="idi1r3c2" class="chkbx" name="i1r3c2" value="<?php echo $row['i1r3c2']?>" <?php echo ($row['i1r3c2'] == 1) ? 'checked' : ''?> required>
							Servicio Público de Empleo
						</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="idi1r3c3" class="chkbx" name="i1r3c3" value="<?php echo $row['i1r3c3']?>" <?php echo ($row['i1r3c3'] == 1) ? 'checked' : ''?> required>
							Portales laborales WEB
						</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-2">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="idi1r3c4" class="chkbx" name="i1r3c4" value="<?php echo $row['i1r3c4']?>" <?php echo ($row['i1r3c4'] == 1) ? 'checked' : ''?> required>
							Agencias / bolsas de empleo / headhunters / firmas cazatalentos
						</label>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
					<div class="checkbox" >
						<label>
							<input type="checkbox" id="idi1r3c5" class="chkbx" name="i1r3c5" value="<?php echo $row['i1r3c5']?>" <?php echo ($row['i1r3c5'] == 1) ? 'checked' : ''?> required>
							Universidades  e  instituciones educativas (oficinas de egresados)
						</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-2">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="idi1r3c6" class="chkbx" name="i1r3c6" value="<?php echo $row['i1r3c6']?>" <?php echo ($row['i1r3c6'] == 1) ? 'checked' : ''?> required>
							Contactos no  formales (colegas, amigos, empleados)
						</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="idi1r3c7" class="chkbx" name="i1r3c7" value="<?php echo $row['i1r3c7']?>" <?php echo ($row['i1r3c7'] == 1) ? 'checked' : ''?> required>
							Redes sociales o aplicaciones
						</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-2">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="idi1r3c8" class="chkbx" name="i1r3c8" value="<?php echo $row['i1r3c8']?>" <?php echo ($row['i1r3c8'] == 1) ? 'checked' : ''?> required>
							Otra no mencionada anteriormente
						</label>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-12">
					<label class="">Cual?</label>
					<div>
						<input type='text' class='form-control input-sm' id='idi1r3c9' name='i1r3c9' value = "<?php echo $row['i1r3c9']?>"  maxlength="50" required/>
					</div>
				</div>
			</div>
		</div>
	</fieldset>

	<fieldset style='border-style: solid; border-width: 1px' id="" class="<?php //echo $estadoII3; ?>" >
		<legend>
			<h5 style='font-family: arial'><b>
				<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?>
				4. De las vacantes mencionadas en el numeral 1.
			</b></h5>
		</legend>

		<div class="container-fluid">
			<div class="form-group form-group-sm col-xs-12">
				<label class="">¿Cuántas requerían de una competencia certificada?</label>
				<div>
					<input type='text' class='form-control input-sm solo-numero' id='idi1r4c1' name='i1r4c1' value = "<?php echo $row['i1r4c1']; ?>" maxlength="3" required />
				</div>
			</div>
		</div>
	</fieldset>
	<fieldset style='border-style: solid; border-width: 1px'>
		<legend><h4 style='font-family: arial'>Observaciones</h4></legend>
		<div class='col-sm-6' style='padding-bottom: 10px'>
			<textarea class='form-control' rows='2' name='observaciones' id='obsfte' <?php echo $estadObs ?>><?php echo $row['OBSERVACIONES'] ?></textarea>
		</div>
	</fieldset>
</div>

