<?php

	include '../conecta.php';
	$numero = $_GET['numord'];
	$vig = $_GET['vigencia'];


/**########################**/
	// verificacion para la carga de informacion del formulario y creacion de registros para la informacion
	/** Carga de informacion del capitulo 1 disponibilidades */
	$nomPeriodo = $conn->query("select nomperiodo from periodoactivo where id = $vig")->fetch(PDO::FETCH_ASSOC);
	$qCapitulo = $conn->query("SELECT * FROM capitulo_i WHERE C1_nordemp = $numero AND vigencia = $vig");
	$row = $qCapitulo->fetch(PDO::FETCH_ASSOC);
	$rowDisCont = $conn->query("SELECT id_displab, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14, i1r2c15, i1r2c16, i1r2c17, i1r2c18, i1r2c19, i1r2c20, i1r2c21 from capitulo_i_displab WHERE C1_nordemp = $numero AND vigencia = $vig");
/**########################**/
?>

<!DOCTYPE html>
<html>
	<head>
		<style type="text/css" media="screen">
			body {
				font: normal 12px/1 "Times New Roman", Times, serif;
				-o-text-overflow: ellipsis;
				text-overflow: ellipsis;

			}

			div {
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				position: relative;
				margin: auto;
			}

			input[type=text], select {
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				margin: 5px;
				padding: 2px;
				overflow: hidden;
				border: 1px solid #b7b7b7;
				-webkit-border-radius: 3px;
				border-radius: 3px;
				color: rgba(0,142,198,1);
				text-align: center;
				-o-text-overflow: clip;
				text-overflow: clip;
				/*background: rgba(252,252,252,1);*/
				width: 90%;
			}

			.campTextarea {
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				margin: 5px;
				padding: 5px;
				overflow: hidden;
				border: 1px solid #b7b7b7;
				-webkit-border-radius: 5px;
				border-radius: 5px;
				color: rgba(0,142,198,1);
				text-align: center;
				-o-text-overflow: clip;
				text-overflow: clip;
				/*background-color: rgba(252,252,252,1);*/
				width: 90%;
			}

			table {
				-webkit-box-sizing: content-box;
				-moz-box-sizing: content-box;
				box-sizing: content-box;
				width: 100%;
				margin: 10px auto;
				border-collapse: collapse;
			}

			td {
				padding: 5px 10px;
			}

			.contenido {
				text-align: center;
				padding: 0px 15px;
			}

			.datagrid {-webkit-box-sizing: content-box; -moz-box-sizing: content-box; box-sizing: content-box; font: normal 12px/100% Arial, Helvetica, sans-serif; background: #ffffff; border: solid 1px #000000; overflow: hidden;  margin-bottom: 2em;}
			.datagrid table { border-collapse: collapse; border-spacing: 0px; margin: 0 auto; text-align: center; }
			.datagrid table thead th {background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; text-align: center; }
			.datagrid table td, .datagrid table th { padding: 5px 1px; }
			.datagrid table tbody td { color: #00557F; border-left: 1px solid #E1EEF4;font-size: 12px; font-weight: normal; }
			.datagrid table tbody .alt td { background: #E1EEf4; color: #00557F; }
			.datagrid table tbody td:first-child { border-left: none; }
			.datagrid table tbody tr:last-child td { border-bottom: none; }

			.ptitle{
				-webkit-box-sizing: content-box;
				-moz-box-sizing: content-box;
				box-sizing: content-box;
				padding: 10px;
				/*overflow: hidden;*/
				-webkit-border-radius: 8px 8px 0 0;
				border-radius: 8px 8px 0 0;
				/*color: rgba(255,255,255,1);*/
				text-align: center;
				-o-text-overflow: ellipsis;
				/*text-overflow: ellipsis;*/
				/*background-color: #0199d9;*/
			}

			.pconten{
				margin-bottom: 0;
				/*background-color: #B1C8EA;*/
				padding: 10px;
			}

			.panel {
				margin: 0 auto 20px;
				width: 100%;
			}

			.medios table {
				text-align: left;
			}

		</style>

	</head>
	<body>

 		<div class="contenido">
 			<div>
				<h4>Este m&oacute;dulo determina la cantidad de vacantes durante el "<?php echo $nomPeriodo['nomperiodo'];?>" e identifica sus caracter&iacute;sticas.</h4>
 			</div>

			<div class="panel">
				<div class="ptitle">
					<b>1. Durante el periodo de referencia </b>
				</div>
				<div class="pconten">
					<div>
						<table>
							<tr>
								<td colspan="3"> <label for=""> ¿tuvo alguna vacante abierta a candidatos no vinculados con la empresa? </label> </td>
							</tr>
							<tr>
								<td></td>
								<td>
									<?php
										$dt_i1r1c1 = '&nbsp;';
										if ($row['i1r1c1'] == 1) { $dt_i1r1c1 = "Si"; }
										else if ($row['i1r1c1'] == 2) { $dt_i1r1c1 = "No"; }
									?>
									<input type="text" value="<?php echo $dt_i1r1c1; ?>"></input>
								</td>
								<td></td>
							</tr>
						</table>
					</div>


				</div>
			</div>

			<div class="panel">
				<div class="ptitle">
					<h4><b>
						2. Clasifique las vacantes abiertas durante el trimestre de referencia de acuerdo a las siguientes caracter&iacute;sticas: </br> &Aacute;rea funcional, M&iacute;nimo nivel educativo requerido, &Aacute;rea de formaci&oacute;n, Experiencia en meses, Modalidad de contrataci&oacute;n, Salarios u honorarios y edad:
					</b></h4>
				</div>
				<div class="pconten">
					<div>
						<label for="">Este módulo  determina la cantidad de vacantes durante el "<?php echo $nomPeriodo['nomperiodo'];?>" e  identifica sus características.</label>
					</div>
					<div id="totales" class="col-xs-12 col-sm-12">
						<table>
							<tr>
								<td> <label class="">Total Vacantes</label> </td>
								<td> <label class="">Total Vacantes Cubiertas</label> </td>
								<td> <label class="">Total Vacantes No Cubiertas</label> </td>
							</tr>
							<tr>
								<td>
									<input type='text' value = "<?php echo $row['i1r1c2']; ?>" />
								</td>
								<td>
									<input type='text' value = "<?php echo $row['i1r1c3']; ?>" />
								</td>
								<td>
									<input type='text' value = "<?php echo $row['i1r1c4']; ?>" />
								</td>
							</tr>
						</table>
					</div>


					<?php $c=0; foreach ($rowDisCont as $dispc){ $c++; ?>
					<div class="datagrid">
						<table>
							<thead>
								<tr>
									<th colspan="3"> VACANTE <?php echo $c;?> </th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td> <label class="">Cantidad de vacantes abiertas</label> </td>
									<td> <label class="">&Aacute;rea funcional</label> </td>
									<td> <label class="">Mínimo nivel educativo requerido</label> </td>
								</tr>
								<tr class="alt">
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
								<tr class="alt">
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
								<tr class="alt">
									<td>
										<input type='text' value = "<?php echo $dispc['i1r2c7']; ?>" />
										<?php //echo $dispc['i1r2c7']; ?>
									</td>
									<td>
										<table>
											<tr>
												<td><span class="input-group-addon" id="sizing-addon1">Desde</span></td>
												<td><span class="input-group-addon" id="sizing-addon1">Hasta</span></td>
											</tr>
											<tr>
												<td>
													<input type="text" value = "<?php echo $dispc['i1r2c8']; ?>">
												</td>
												<td>
													<input type="text" value = "<?php echo $dispc['i1r2c9']; ?>">
												</td>
											</tr>
										</table>
									</td>
									<td>
										<input type='text' value = "<?php echo $dispc['i1r2c10']; ?>"/>
										<?php //echo $dispc['i1r2c9']; ?>
									</td>
								</tr>
								<tr>
									<td> <label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label> </td>
									<td> <label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label> </td>
									<td> <label class="">De las vacantes ¿Cuántas NO logró cubrir? </label> </td>
								</tr>
								<tr class="alt">
									<td>
										<input type='text' value = "<?php echo $dispc['i1r2c11']; ?>" />
										<?php //echo $dispc['i1r2c10']; ?>
									</td>
									<td>
										<input type='text' value = "<?php echo $dispc['i1r2c12']; ?>" />
										<?php //echo $dispc['i1r2c11']; ?>
									</td>
									<td>
										<input type='text' value = "<?php echo $dispc['i1r2c13'];?>" />
										<?php //echo $dispc['i1r2c12'];?>
									</td>
								</tr>
								<tr>
									<td colspan="3"> <label>De las vacantes NO cubiertas ¿Cuáles fueron las causas?</label> </td>
									<!-- <td colspan="2"> <label class="">Cual?</label> </td> -->
								</tr>
								<tr class="alt">
									<td colspan="3" >
										<table>
											<tr>
												<td>
													<label>
														<input type="checkbox" <?php echo ($dispc['i1r2c14'] == 1) ? 'checked' : ''?> >
														La remuneración ofrecida era insuficiente
													</label>
												</td>
												<td>
													<label>
														<input type="checkbox" <?php echo ($dispc['i1r2c15'] == 1) ? 'checked' : ''?> >
														Postulantes sub-calificados
													</label>
												</td>
												<td>
													<label>
														<input type="checkbox" <?php echo ($dispc['i1r2c16'] == 1) ? 'checked' : ''?> >
														Postulantes sobre-calificados
													</label>
												</td>
											</tr>
											<tr>
												<td>
													<label>
														<input type="checkbox" <?php echo ($dispc['i1r2c17'] == 1) ? 'checked' : ''?> >
														Falta de experiencia o conocimiento específico
													</label>
												</td>
												<td>
													<label>
														<input type="checkbox" <?php echo ($dispc['i1r2c18'] == 1) ? 'checked' : ''?> >
														Los postulantes no dominaban otros idiomas
													</label>
												</td>
												<td>
													<label>
														<input type="checkbox" <?php echo ($dispc['i1r2c19'] == 1) ? 'checked' : ''?> >
														Pocos postulantes
													</label>
												</td>
											</tr>
											<tr>
												<td>
													<label>
														<input type="checkbox" <?php echo ($dispc['i1r2c20'] == 1) ? 'checked' : ''?> >
														Otra
													</label>
												</td>
												<td colspan="2">
													<span>Cual?</span> <br>
													<input type='text' id="noCual" value="<?php echo ($dispc['i1r2c21'] != '') ? $dispc['i1r2c21'] : '&nbsp;'; ?>" />
												</td>
												<td></td>
											</tr>
										</table>

									</td>

								</tr>
							</tbody>
						</table>
					</div>

				<?php } ?>

				</div>
			</div>

			<div class="panel">
				<div class="ptitle">
					<b>3. Para  las vacantes mencionadas en el numeral 1, Seleccione  el (los) medio(s) de publicación utilizado(s)</b>
				</div>
				<div class="pconten">
					<div class="medios">
						<table>
							<tr>
								<td>
									<label>
										<input type="checkbox" <?php echo ($row['i1r3c1'] == 1) ? 'checked' : ''?> >
										Medios de comunicación (prensa,radio,tv)
									</label>
								</td>
								<td>
									<label>
										<input type="checkbox"  <?php echo ($row['i1r3c2'] == 1) ? 'checked' : ''?> >
										Servicio Público de Empleo
									</label>
								</td>
								<td>
									<label>
										<input type="checkbox"  <?php echo ($row['i1r3c3'] == 1) ? 'checked' : ''?> >
										Portales laborales WEB
									</label>
								</td>
							</tr>
							<tr>
								<td>
									<label>
										<input type="checkbox" <?php echo ($row['i1r3c4'] == 1) ? 'checked' : ''?> >
										Agencias / bolsas de empleo / headhunters / firmas cazatalentos
									</label>
								</td>
								<td>
									<label>
										<input type="checkbox"  <?php echo ($row['i1r3c5'] == 1) ? 'checked' : ''?> >
										Universidades  e  instituciones educativas (oficinas de egresados)
									</label>
								</td>
								<td>
									<label>
										<input type="checkbox"  <?php echo ($row['i1r3c6'] == 1) ? 'checked' : ''?> >
										Contactos no  formales (colegas, amigos, empleados)
									</label>
								</td>
							</tr>
							<tr>
								<td>
									<label>
										<input type="checkbox" <?php echo ($row['i1r3c7'] == 1) ? 'checked' : ''?> >
										Redes sociales o aplicaciones
									</label>
								</td>
								<td>
									<label>
										<input type="checkbox"<?php echo ($row['i1r3c8'] == 1) ? 'checked' : ''?> >
										Otra no mencionada anteriormente
									</label>
								</td>
								<td>
									<label class="">Cual?</label>
									<div>
										<input type='text' id="noCual" value="<?php echo ($row['i1r3c9'] != '') ? $row['i1r3c9'] : '&nbsp;'; ?>" />
									</div>
								</td>
							</tr>
						</table>
					</div>


				</div>
			</div>

			<div class="panel">
				<div class="ptitle">
					<b>4. De las vacantes mencionadas en el numeral 1. </b>
				</div>
				<div class="pconten">
					<div>
						<table>
							<tr>
								<td colspan="3"> <label for=""> ¿Cuántas requerían de una competencia certificada? </label> </td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type='text' value="<?php echo ($row['i1r4c1'] != '') ? $row['i1r4c1'] : '&nbsp;'; ?>" />

								</td>
								<td></td>
							</tr>
						</table>
					</div>


				</div>
			</div>

			<div class="panel">
				<div class="ptitle">
					<b>Observaciones </b>
				</div>
				<div class="pconten">
					<table>
						<tr>
							<td>
								<div class='campTextarea' style='padding-bottom: 10px'>
									<?php echo ($row['OBSERVACIONES'] != '') ? $row['OBSERVACIONES'] : '&nbsp;'; ?>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
 		</div>
</body>
 </html>
