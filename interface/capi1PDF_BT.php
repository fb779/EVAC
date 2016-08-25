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
	$rowDisCont = $conn->query("SELECT id_displab, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14 from capitulo_i_displab WHERE C1_nordemp = $numero AND vigencia = $vig;");
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
				background: rgba(252,252,252,1);
				width: 90%;
			}



			table {
				margin: 10px auto;
				border-collapse: collapse;
				/*border: solid 1px #7BEAFB;*/
			}
			tr {
				/*border: solid 1px #7BEAFB;*/
			}
			td {
				padding: 5px 10px;
				border: solid 1px #7BEAFB;
			}

			.contenido {
				text-align: center;
				padding: 0px 15px;
			}

			.datagrid {font: normal 12px/100% Arial, Helvetica, sans-serif;  overflow: hidden;  margin-bottom: 2em;}
			.datagrid table { border-collapse: collapse; margin: 0 auto; text-align: center; background: #fff; border: 1px solid #006699; }
			.datagrid table thead th {background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; text-align: center; }
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
				color: rgba(255,255,255,1);
				text-align: center;
				-o-text-overflow: ellipsis;
				/*text-overflow: ellipsis;*/
				background-color: #0199d9;
			}

			.pconten{
				margin-bottom: 0;
				background-color: #B1C8EA;
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

					<?php if  ( $rowDisCont->rowCount() == 0){ ?>
						<div>
							<label for="">No existen disponibilidades registradas para el "<?php echo $nomPeriodo;?>"</label>
						</div>
					<?php } ?>
					<?php $c=0; foreach ($rowDisCont as $dispc){ $c++; ?>
					<div class="datagrid">
						<table>
							<thead>
								<tr>
									<th colspan="3"> Disp <?php echo $c;?> </th>
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
								<tr class="alt">
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
								<tr class="alt">
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
										<input type='text' id="noCual" value="<?php echo ($dispc['i1r2c14'] != '') ? $dispc['i1r2c14'] : '&nbsp;'; ?>" />
										<?php //echo $dispc['i1r2c14']; ?>
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
										<input type='text' value = "<?php echo ($row['i1r3c9'] != '') ? $row['i1r3c9'] : '&nbsp;'; ?>" />
									</div>
								</td>
							</tr>
						</table>
					</div>


				</div>
			</div>
 		</div>


			<div class='container'>

				<fieldset style='border-style: solid; border-width: 1px' id="" class="<?php //echo $estadoII3; ?>" >
					<legend>
						<h5 style='font-family: arial'><b>
							:
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

				<fieldset style='border-style: solid; border-width: 1px' id="" >
					<legend>
						<h5 style='font-family: arial'><b>
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
						<textarea class='form-control' rows='2' name='OBSERVACIONES' id='obsfte' value="<?php echo $row['OBSERVACIONES'] ?>" ><?php echo $row['OBSERVACIONES'] ?></textarea>
					</div>
				</fieldset>

			</div>

</body>
 </html>
