<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	include '../conecta.php';
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='cap1';
	$vig=$_SESSION['vigencia'];
	$nomPeriodo = $_SESSION['nomPeri'];
	$estadObs = ($tipousu != "FU" ? "readonly" : "");
	$consLog = ($region == 99 ? true : false);

	$cLog = "<span class='glyphicon glyphicon-time' style='color: blue; font-size: 14px;'></span>";

	$anterior = $vig-1;
	$tabla = 'capitulo_i';
	//$tabla = 'capitulo_i_other';
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$grabaOK = false;
	include '../persistencia/cargaDato.php';



/**########################**/
	// verificacion para la carga de informacion del formulario y creacion de registros para la informacion
	/** Carga de informacion del capitulo 1 disponibilidades */
	$rowDisLink = $conn->query("SELECT id_displab from capitulo_i_displab WHERE C1_nordemp = $numero AND vigencia = $vig;");
	$rowDisCont = $conn->query("SELECT id_displab, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14 from capitulo_i_displab WHERE C1_nordemp = $numero AND vigencia = $vig ORDER BY id_displab;");
/**########################**/

	if ($tipousu != "FU") {
		$txtEstado = " - estado - " . $rowCtl['desc_estado'];
	}
	else {
		$txtEstado = "";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title> <?php echo $_SESSION['titulo'] . 'Capitulo 1'; ?> </title>
		<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../bootstrap/css/custom.css" rel="stylesheet">
		<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/cargaDato.js"></script>
	 	<!--script type="text/javascript" src="../js/valida1.js"></script-->
		<!--script type="text/javascript" src="../js/validaForm1.js"></script-->
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/capitulo1.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<script type="text/javascript" src="../js/notSubmit.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<style>
			body {
				padding-top: 50px;
			}

			legend {
				font: normal 16px/2;
			}
			.modal-width {
				width: 90%;
			}
			.textoB {
				font-weight: bold;
			}

		</style>
	</head>
	<body>
	<?php
			include 'menuFuente.php';
/*
			if ($tipousu != "FU") {
				echo "<script type='text/javascript'>";
				echo "$(function() {";
				echo "$(window).load(function(){";
			    echo "$('#avisoCrit').modal('show');";
			    echo "});});";
			    echo "</script>";
			}
*/
		?>
		<div class="well well-sm" style="font-size: 12px; /*padding-top: 60px;*/ z-index: 1;" id="wc2">
 			<?php echo $numero . " - " . $nombre?> - CAP&Iacute;TULO I - CARACTERIZACI&Oacute;N DE VACANTES ABIERTAS <?php echo strtoupper($nomPeriodo); //echo $anterior . "-" . $vig . " . " . $txtEstado ?>
 			<!-- Informacion de prueba BORRAR  -->
 			<?php echo $rowDisCont->rowCount(); ?>
 			<!-- Informacion de prueba BORRAR  -->
 		</div>

 		<div class="container text-justify" style="font-size: 12px">
 			<h4>Este m&oacute;dulo  determina la cantidad de vacantes durante el "<?php echo $nomPeriodo;?>" e  identifica sus caracter&iacute;sticas.</h4>

 		</div>

		<input type="hidden" name="tipousu" id="idTipo" value="<?php echo $tipousu ?>" />
		<form class='form-horizontal' role='form'  name="capitulo1" id="capitulo1" method="post" disabled>
			<div class='container'>
				<input type="hidden" name="C1_nordemp" id="numero" value="<?php echo $numero ?>" />
				<input type="hidden" name="C1_numdisp" id="C1_numdisp" value="" />
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend>
						<h5 style='font-family: arial'><b>
							<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii1&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?>
							1. Durante el periodo de referencia ¿tuvo alguna vacante abierta a candidatos no vinculados con la empresa?
						</b></h5>
					</legend>

					<div class="form-group form-group-sm col-xs-12 col-sm-11 col-sm-offset-1">
						<!-- <label class="col-xs-12 col-sm-7" >¿tuvo alguna vacante abierta a candidatos no vinculados con la empresa?</label> -->
						<div class="col-xs-12 col-sm-12 text-center">
							<label class="radio-inline">
							  <input type="radio" name="i1r1c1" id="idi1r1c1si" value="1" <?php echo ($row['i1r1c1'] == 1) ? 'checked' : ''; ?> required > Si
							</label>
							<label class="radio-inline">
							  <input type="radio" name="i1r1c1" id="idi1r1c1no" value="2" <?php echo ($row['i1r1c1'] == 2) ? 'checked' : ''; ?>  > No
							</label>
						</div>
					</div>

					<!--div class="form-group form-group-sm col-xs-12 col-sm-11 col-sm-offset-1 ">
						<label class="col-xs-12 col-sm-4">Indique la  cantidad total  de  vacantes abiertas</label>
						<div class='col-xs-12 col-sm-3 small'>
							<input type='text' class='form-control input-sm text-center' id='idi1r1c2' name='i1r1c2' value = "<?php //echo $row['i1r1c2']; ?>" maxlength="9" required />
						</div>
					</div-->
				</fieldset>

				<fieldset style='border-style: solid; border-width: 1px'>
					<legend>
						<h5 style='font-family: arial'><b>
							2. Clasifique las vacantes abiertas durante el trimestre de referencia de acuerdo a las siguientes caracter&iacute;sticas: </br>
						 </b></h5>
					 		<h6 style="font: normal 14px/2 arial" > <b> &Aacute;rea funcional, M&iacute;nimo nivel educativo requerido, &Aacute;rea de formaci&oacute;n, Experiencia en meses, Modalidad de contrataci&oacute;n, Salarios u honorarios y edad. </b></h6 >
						 <div style="color:red;"><h6 > Nota: Si más de una vacante presenta las mismas características relacionelas en una pestaña, si alguna de ellas difiere agregue otra. </h6></div>
					</legend>
					<div class="container-fluid">
						<!-- <div class="col-xs-12 col-sm-12">
							<label for="">Este módulo  determina la cantidad de vacantes durante el "<?php echo $nomPeriodo;?>" e  identifica sus características.</label>
						</div> -->
						<div class="col-xs-12">
							<div id="disNoti" class="alert alert-warning text-center hidden" role="alert">
								<!-- button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button-->
								<div id="diNoMensaje" class="row">
								</div>
							</div>
						</div>
						<?php if ($grabaOK) { ?>
							<div id="contenido" class="col-xs-12 col-sm-12">
								<button id="addDisp" type="button" class="btn btn-default" aria-label="Left Align">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar vacante
								</button>
								<button id="saveDisp" type="button" class="btn btn-default" aria-label="Left Align">
									<span class="glyphicon glyphicon-save text-primary" aria-hidden="true"></span> Grabaci&oacute;n parcial
								</button>
								<button id="removeDisp" type="button" class="btn btn-danger" aria-label="Left Align">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar ultima vacante
								</button>
							</div>
						<?php } ?>
						<div id="totales" class="col-xs-12 col-sm-12">
							<p>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Total Vacantes</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right' id='idi1r2ctv' name='i1r1c2' value = "<?php echo $row['i1r1c2']; //echo $row['i1r2ctvc']?>" readonly  />
									</div>
								</div>
								<div class="col-xs-1"></div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3">
									<label class="">Total Vacantes Cubiertas</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right' id='idi1r2ctvcb' name='i1r1c3' value = "<?php echo $row['i1r1c3']; //echo $row['i1r2ctvc']?>" readonly  />
									</div>
								</div>
								<div class="col-xs-1"></div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3">
									<label class="">Total Vacantes No Cubiertas</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right' id='idi1r2ctvnocb' name='i1r1c4' value = "<?php echo $row['i1r1c4']; //echo $row['i1r2ctvc']?>" readonly  />
									</div>
								</div>
							</p>
						</div>
						<div class="col-xs-12 col-sm-12">
							<p>
								<ul id="listDisTab" class="nav nav-tabs" >
								<?php $c = 1; foreach ($rowDisLink as $displ){  ?>
									<li class="<?php echo ($c==1)?'active':''; ?>"><a href="#disp<?php echo $c;?>" data-toggle="tab">Vacante <?php echo $c;?></a></li>
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
													<label class="">Cantidad de vacantes abiertas</label>
													<div class='small'>
														<input type='text' class='form-control input-sm text-right subVac solo-numero validar' id='' name="<?php echo $ncam; ?>_0" value = "<?php echo $dispc['i1r2c1'];?>" maxlength="3" required/>
													</div>
												</div>
												<div class="col-xs-12 col-sm-1"></div>
												<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
													<label class="">&Aacute;rea funcional</label>
													<div class='small'>
														<select class='form-control input-sm validar' name="<?php echo $ncam ?>_1" required>
															<option value=""> Seleccione una opción</option>
															<option value="1" <?php echo ($dispc['i1r2c2'] == 1) ? 'selected' : '';  ?> >Área de dirección general</option>
															<option value="2" <?php echo ($dispc['i1r2c2'] == 2) ? 'selected' : '';  ?> >Área de administración</option>
															<option value="3" <?php echo ($dispc['i1r2c2'] == 3) ? 'selected' : '';  ?> >Área de mercadeo/ventas</option>
															<option value="4" <?php echo ($dispc['i1r2c2'] == 4) ? 'selected' : '';  ?> >Área de producción</option>
															<option value="5" <?php echo ($dispc['i1r2c2'] == 5) ? 'selected' : '';  ?> >Área de contabilidad y finanzas</option>
															<option value="6" <?php echo ($dispc['i1r2c2'] == 6) ? 'selected' : '';  ?> >Personal de Investigación y desarrollo</option>
															<option value="7" <?php echo ($dispc['i1r2c2'] == 7) ? 'selected' : '';  ?> >Personal de apoyo</option>
														</select>
													</div>
												</div>
												<div class="col-xs-12 col-sm-1"></div>
												<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
													<label class="">Mínimo nivel educativo requerido</label>
													<div class='small'>
														<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>_2" required>
															<option value="" > Seleccione una opción</option>
															<option value="1" <?php echo ($dispc['i1r2c3'] == 1) ? 'selected' : '';  ?> >No bachiller</option>
															<option value="2" <?php echo ($dispc['i1r2c3'] == 2) ? 'selected' : '';  ?> >Educación básica secundaria (6° - 9°)</option>
															<option value="3" <?php echo ($dispc['i1r2c3'] == 3) ? 'selected' : '';  ?> >Educación media   (10° - 13°)</option>
															<option value="4" <?php echo ($dispc['i1r2c3'] == 4) ? 'selected' : '';  ?> >Técnico laboral</option>
															<option value="5" <?php echo ($dispc['i1r2c3'] == 5) ? 'selected' : '';  ?> >Técnico profesional</option>
															<option value="6" <?php echo ($dispc['i1r2c3'] == 6) ? 'selected' : '';  ?> >Tecnólogo</option>
															<option value="7" <?php echo ($dispc['i1r2c3'] == 7) ? 'selected' : '';  ?> >Estudiante universitario</option>
															<option value="8" <?php echo ($dispc['i1r2c3'] == 8) ? 'selected' : '';  ?> >Profesional universitario</option>
															<option value="9" <?php echo ($dispc['i1r2c3'] == 9) ? 'selected' : '';  ?> >Especialización </option>
															<option value="10" <?php echo ($dispc['i1r2c3'] == 10) ? 'selected' : '';  ?> >Maestría</option>
															<option value="11" <?php echo ($dispc['i1r2c3'] == 11) ? 'selected' : '';  ?> >Doctorado</option>
															<option value="12" <?php echo ($dispc['i1r2c3'] == 12) ? 'selected' : '';  ?> >No requiere estudios</option>
														</select>
													</div>
												</div>
											</div>
											<div class="container-fluid small">
												<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
													<label class="">Área de Formación</label>
													<div class='small'>
														<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>_3" required>
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
														<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php echo $ncam; ?>_4' value = "<?php echo $dispc['i1r2c5']?>" maxlength="3" required />
													</div>
												</div>
												<div class="col-xs-12 col-sm-1"></div>
												<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
													<label class="">Modalidad de Contratación</label>
													<div class='small'>
														<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>_5" required>
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
														<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php echo $ncam; ?>_6' value = "<?php echo $dispc['i1r2c7']?>" maxlength="9" placeholder="Valor digitado en pesos" required />
													</div>
												</div>
												<div class="col-xs-12 col-sm-1"></div>
												<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
													<label class="">Edad</label>
													<div class='small'>
														<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>_7" required>
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
														<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php echo $ncam; ?>_8' value = "<?php echo $dispc['i1r2c9']?>" maxlength="9" required />
													</div>
												</div>
											</div>
											<div class="container-fluid small">
												<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
													<label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label>
													<div class='small'>
														<input type='text' class='form-control input-sm text-right validar' id='' name='<?php echo $ncam; ?>_9' value = "<?php echo $dispc['i1r2c10']?>" maxlength="9" required />
													</div>
												</div>
												<div class="col-xs-12 col-sm-1"></div>
												<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
													<label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label>
													<div class='small'>
														<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php echo $ncam; ?>_10' value = "<?php echo $dispc['i1r2c11']?>" maxlength="9" readonly required />
													</div>
												</div>
												<div class="col-xs-12 col-sm-1"></div>
												<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
													<label class="">De las vacantes ¿Cuántas NO logró cubrir? </label>
													<div class='small'>
														<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php echo $ncam; ?>_11' value = "<?php echo $dispc['i1r2c12']?>" maxlength="9" readonly required />
													</div>
												</div>
											</div>
											<div class="container-fluid small">
												<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
													<label>De las vacantes NO cubiertas ¿Cuáles fueron las causas?</label>
													<div class="small">
														<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>_12" <?php echo ($dispc['i1r2c13']>0)?'':'disabled' ?>>
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
														<input type='text' class='form-control input-sm validar' id='' name='<?php echo $ncam; ?>_13' maxlength="50" value="<?php echo $dispc['i1r2c14']?>" <?php echo (isset($dispc['i1r2c14']))?'':'disabled' ?> />
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
				<fieldset style='border-style: solid; border-width: 1px' id="" class="<?php //echo $estadoII3; ?>" >
					<legend>
						<h5 style='font-family: arial'><b>
							<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?>
							3. Para  las <span class="dttotalvacantes"><?php echo $row['i1r1c2'] ?></span> vacantes mencionadas en la pregunta 2, Seleccione  el (los) medio(s) de publicación utilizado(s):
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
									<input type='text' class='form-control input-sm' id='idi1r3c9' name='i1r3c9' value = "<?php echo $row['i1r3c9']?>"  maxlength="60" required/>
								</div>
							</div>
						</div>
					</div>
				</fieldset>

				<fieldset style='border-style: solid; border-width: 1px' id="" class="<?php //echo $estadoII3; ?>" >
					<legend>
						<h5 style='font-family: arial'><b>
							<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?>
							4. De las <span class="dttotalvacantes"><?php echo $row['i1r1c2'] ?></span> vacantes mencionadas en la pregunta 2. ¿Cuántas requerían de una competencia certificada?
						</b></h5>
					</legend>

					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-4 ">
							<label class=""></label>
							<div>
								<input type='text' class='form-control input-sm solo-numero' id='idi1r4c1' name='i1r4c1' value = "<?php echo $row['i1r4c1']; ?>" maxlength="3" required />
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h4 style='font-family: arial'>Observaciones</h4></legend>
					<div class='col-sm-6' style='padding-bottom: 10px'>
						<textarea class='form-control' rows='2' name='OBSERVACIONES' id='obsfte' <?php echo $estadObs ?>><?php echo $row['OBSERVACIONES'] ?></textarea>
					</div>
				</fieldset>
				<?php if ($grabaOK) { ?>
				<div class='form-group form-group-sm'>
					<div class='col-md-8'>
						<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Modulo I Actualizado Correctamente</p>
					</div>
					<div class='col-sm-1 small pull-right' id="btn_cont" style="display: none;" >
						<!-- a href='capitulo2.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente cap&iacute;tulo' >Continuar</a-->
						<a href='../administracion/envio.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente modulo'>Continuar</a>
					</div>
					<div class='col-sm-1 small pull-right'>
						<button type='submit' id="btnGuardar" class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar informaci&oacute;n Modulo I'>Grabar</button>
					</div>
				</div>
				<?php } ?>
			</div>
 		</form>

		<div id="idObs1" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Observaciones</h4>
					  </div>
					  <div class="modal-body">
						<textarea class='form-control' rows='2' name='observaCrit' id='obscrit'></textarea>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" id="crObser"  data-dismiss="modal">Grabar</button>
					  </div>
				</div>
			</div>
		</div>

		<?php //include 'modalediteas.php' ?>
		<?php include 'caracterizacion.php' ?>

		<!-- Modal -->
		<div class="modal fade" id="mNotificacion" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<!-- button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button-->
						<div id="mHeader"></div>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 text-center">
								<div id="mNoti" class="alert alert-dismissible hidden" role="alert">
								</div>
								<div id="mContent"></div>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" id="mSave" class="btn btn-default">Guardar</button>
						<button type="button" id="mClose" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		<!-- fin modal3 -->

</body>
 </html>
