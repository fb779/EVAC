<?<?php 
	require_once "../dompdf/dompdf_config.inc.php";
	ob_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - Formulario Electr&oacute;nico</title>
	<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
	<!-- Bootstrap -->
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../bootstrap/css/custom.css" rel="stylesheet">
	<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">		
	<script src="../bootstrap/js/jquery.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css"> p {font-size: 13px !important;}</style>
	<style type="text/css" media="screen">
		
		fieldset {
			border: solid 0.5px black;
			margin-bottom: 5px;
		}
		
		legend{
			font-size: 1em;
		}

		div {
			margin-bottom: 10px;
		}
			
		
	</style>
	<title></title>
	<link rel="stylesheet" href="">		
</head>
<body>
	<div class="container">
		<fieldset  class="container-fluid">
			<legend>1. Durante el periodo de referencia</legend>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-2">
					¿tuvo alguna vacante abierta a candidatos no vinculados con la empresa?
				</div>
				<div class="col-xs-2">
					<label class="radio-inline">
					  <input type="radio" name="i1r1c1" id="idi1r1c1si" value="1" <?php //echo ($row['i1r1c1'] == 1 || $row['i1r1c1'] == '') ? 'checked' : ''; ?> disabled > Si
					</label>
					<label class="radio-inline">
					  <input type="radio" name="i1r1c1" id="idi1r1c1no" value="2" <?php //echo ($row['i1r1c1'] == 2) ? 'checked' : ''; ?>  > No
					</label>
				</div>
			</div>
		</fieldset>
		
		<fieldset class="container-fluid">
			<legend>2 Clasifique las vacantes abiertas durante el trimestre de referencia de acuerdo a las siguientes caracter&iacute;sticas: <br>
						&Aacute;rea funcional, M&iacute;nimo nivel educativo requerido, &Aacute;rea de formaci&oacute;n, Experiencia en meses, Modalidad de contrataci&oacute;n, Salarios u honorarios y edad:</legend>
			<div class="row">
				<div class="col-xs-12">
					Este módulo  determina la cantidad de vacantes durante el "<?php //echo $nomPeriodo;?> - " e  identifica sus características.		
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-12 text-center">
			
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Total Vacantes</label>
					<div class=''>
						<input type='text' class='form-control input-sm text-right' id='idi1r2ctv' name='i1r1c2' value = "<?php //echo $row['i1r1c2']; //echo $row['i1r2ctvc']?>" disabled  />
					</div>
				</div>
				<div class="col-xs-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3">
					<label class="">Total Vacantes Cubiertas</label>
					<div class=''>
						<input type='text' class='form-control input-sm text-right' id='idi1r2ctvcb' name='i1r1c3' value = "<?php //echo $row['i1r1c3']; //echo $row['i1r2ctvc']?>" disabled  />
					</div>
				</div>
				<div class="col-xs-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3">
					<label class="">Total Vacantes No Cubiertas</label>
					<div class=''>
						<input type='text' class='form-control input-sm text-right' id='idi1r2ctvnocb' name='i1r1c4' value = "<?php //echo $row['i1r1c4']; //echo $row['i1r2ctvc']?>" disabled  />
					</div>
				</div>
			</div>
			
			<div class="row">

				<div class="col-xs-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Disponibilidad 1</h3>
						</div>
						<div class="panel-body text-center">
							<div class="row">
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Cantidad de vacantes abiertas</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right subVac solo-numero validar' id='' name="<?php //echo $ncam; ?>0" value = "<?php //echo $dispc['i1r2c1'];?>" maxlength="3"  disabled/>
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">&Aacute;rea funcional</label>
									<div class='small'>
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>1" disabled>
											<option value=""> Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c2'] == 1) ? 'selected' : '';  ?> >Área de dirección general</option>
											<option value="2" <?php //echo ($dispc['i1r2c2'] == 2) ? 'selected' : '';  ?> >Área de administración</option>
											<option value="3" <?php //echo ($dispc['i1r2c2'] == 3) ? 'selected' : '';  ?> >Área de mercadeo/ventas</option>
											<option value="4" <?php //echo ($dispc['i1r2c2'] == 4) ? 'selected' : '';  ?> >Área de producción</option>
											<option value="5" <?php //echo ($dispc['i1r2c2'] == 5) ? 'selected' : '';  ?> >Área de contabilidad y finanzas</option>
											<option value="6" <?php //echo ($dispc['i1r2c2'] == 6) ? 'selected' : '';  ?> >Personal de Investigación y desarrollo</option>
											<option value="7" <?php //echo ($dispc['i1r2c2'] == 7) ? 'selected' : '';  ?> >Personal de apoyo</option>
										</select>								
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Mínimo nivel educativo requerido</label>
									<div class='small'>
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>2" disabled>
											<option value="" > Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c3'] == 1) ? 'selected' : '';  ?> >No bachiller</option>
											<option value="2" <?php //echo ($dispc['i1r2c3'] == 2) ? 'selected' : '';  ?> >Educación básica secundaria (6° - 9°)</option>
											<option value="3" <?php //echo ($dispc['i1r2c3'] == 3) ? 'selected' : '';  ?> >Educación media   (10° - 13°)</option>
											<option value="4" <?php //echo ($dispc['i1r2c3'] == 4) ? 'selected' : '';  ?> >Técnico laboral</option>
											<option value="5" <?php //echo ($dispc['i1r2c3'] == 5) ? 'selected' : '';  ?> >Técnico profesional</option>
											<option value="6" <?php //echo ($dispc['i1r2c3'] == 6) ? 'selected' : '';  ?> >Tecnólogo</option>
											<option value="7" <?php //echo ($dispc['i1r2c3'] == 7) ? 'selected' : '';  ?> >Estudiante universitario</option>
											<option value="8" <?php //echo ($dispc['i1r2c3'] == 8) ? 'selected' : '';  ?> >Profesional universitario</option>
											<option value="9" <?php //echo ($dispc['i1r2c3'] == 9) ? 'selected' : '';  ?> >Especialización </option>
											<option value="10" <?php //echo ($dispc['i1r2c3'] == 10) ? 'selected' : '';  ?> >Maestría</option>
											<option value="11" <?php //echo ($dispc['i1r2c3'] == 11) ? 'selected' : '';  ?> >Doctorado</option>
											<option value="12" <?php //echo ($dispc['i1r2c3'] == 12) ? 'selected' : '';  ?> >No requiere estudios</option>
										</select>
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Área de Formación</label>
									<div class='small'>
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>3" disabled>
											<option value="" > Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c4'] == 1) ? 'selected' : '';  ?> >Economía, Administración y Contaduría</option>
											<option value="2" <?php //echo ($dispc['i1r2c4'] == 2) ? 'selected' : '';  ?> >Ingeniería, Arquitectura Urbanismo y afines</option>
											<option value="3" <?php //echo ($dispc['i1r2c4'] == 3) ? 'selected' : '';  ?> >Ciencias Sociales y humanas</option>
											<option value="4" <?php //echo ($dispc['i1r2c4'] == 4) ? 'selected' : '';  ?> >Ciencias de la educación</option>
											<option value="5" <?php //echo ($dispc['i1r2c4'] == 5) ? 'selected' : '';  ?> >Ciencias de la salud</option>
											<option value="6" <?php //echo ($dispc['i1r2c4'] == 6) ? 'selected' : '';  ?> >Bellas artes</option>
											<option value="7" <?php //echo ($dispc['i1r2c4'] == 7) ? 'selected' : '';  ?> >Agronomía, Veterinaria</option>
											<option value="8" <?php //echo ($dispc['i1r2c4'] == 8) ? 'selected' : '';  ?> >Matemáticas y ciencias naturales</option>
											<option value="9" <?php //echo ($dispc['i1r2c4'] == 9) ? 'selected' : '';  ?> >No aplica</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Experiencia en meses</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php //echo $ncam; ?>4' value = "<?php //echo $dispc['i1r2c5']?>" maxlength="3" disabled />
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Modalidad de Contratación</label>
									<div class='small'>
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>5" disabled>
											<option value="" > Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c6'] == 1) ? 'selected' : '';  ?> >Término Indefinido</option>
											<option value="2" <?php //echo ($dispc['i1r2c6'] == 2) ? 'selected' : '';  ?> >Término  Fijo</option>
											<option value="3" <?php //echo ($dispc['i1r2c6'] == 3) ? 'selected' : '';  ?> >Prestación de servicios</option>
											<option value="4" <?php //echo ($dispc['i1r2c6'] == 4) ? 'selected' : '';  ?> >Por  obra  o  labor  contratada</option>
											<option value="5" <?php //echo ($dispc['i1r2c6'] == 5) ? 'selected' : '';  ?> >Ocasional ó Transitorio</option>
										</select>
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Salario u honorarios mensuales</label>
									<div class='input-group input-group-sm'>
										<span class="input-group-addon" id="sizing-addon1">$</span>
										<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php //echo $ncam; ?>6' value = "<?php //echo $dispc['i1r2c7']?>" maxlength="9" disabled />
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Edad</label>
									<div class='small'>
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>7" disabled>
											<option value="" > Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c8'] == 1) ? 'selected' : '';  ?> >15 - 20</option>
											<option value="2" <?php //echo ($dispc['i1r2c8'] == 2) ? 'selected' : '';  ?> >20 - 25</option>
											<option value="3" <?php //echo ($dispc['i1r2c8'] == 3) ? 'selected' : '';  ?> >25 - 30</option>
											<option value="4" <?php //echo ($dispc['i1r2c8'] == 4) ? 'selected' : '';  ?> >30 - 35</option>
											<option value="5" <?php //echo ($dispc['i1r2c8'] == 5) ? 'selected' : '';  ?> >35 - 40</option>
											<option value="6" <?php //echo ($dispc['i1r2c8'] == 6) ? 'selected' : '';  ?> >40 - 45</option>
											<option value="7" <?php //echo ($dispc['i1r2c8'] == 7) ? 'selected' : '';  ?> >45 - 50</option>
											<option value="8" <?php //echo ($dispc['i1r2c8'] == 8) ? 'selected' : '';  ?> >50 - 55</option>
											<option value="9" <?php //echo ($dispc['i1r2c8'] == 9) ? 'selected' : '';  ?> >55 - 60</option>
											<option value="10" <?php //echo ($dispc['i1r2c8'] == 10) ? 'selected' : '';  ?> >60 - 65</option>
											<option value="11" <?php //echo ($dispc['i1r2c8'] == 11) ? 'selected' : '';  ?> >65 - 70</option>
											<option value="12" <?php //echo ($dispc['i1r2c8'] == 12) ? 'selected' : '';  ?> >70 - 75</option>
											<option value="13" <?php //echo ($dispc['i1r2c8'] == 13) ? 'selected' : '';  ?> >75 - 80</option>
											<option value="14" <?php //echo ($dispc['i1r2c8'] == 14) ? 'selected' : '';  ?> >80 - 85</option>
											<option value="15" <?php //echo ($dispc['i1r2c8'] == 15) ? 'selected' : '';  ?> >85 - 90</option>
											<option value="16" <?php //echo ($dispc['i1r2c8'] == 16) ? 'selected' : '';  ?> >Indiferente</option>
										</select>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">De las vacantes ¿Cuántas logró cubrir?</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php //echo $ncam; ?>8' value = "<?php //echo $dispc['i1r2c9']?>" maxlength="9" disabled />
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right validar' id='' name='<?php //echo $ncam; ?>9' value = "<?php //echo $dispc['i1r2c10']?>" maxlength="9" disabled />
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php //echo $ncam; ?>10' value = "<?php //echo $dispc['i1r2c11']?>" maxlength="9" readonly disabled />
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">De las vacantes ¿Cuántas NO logró cubrir? </label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php //echo $ncam; ?>11' value = "<?php //echo $dispc['i1r2c12']?>" maxlength="9" readonly disabled />
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="form-group form-group-sm col-xs-12 col-sm-5 ">
									<label>De las vacantes NO cubiertas ¿Cuáles fueron las causas?</label>
									<div class="small">
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>12" disabled >
											<option value="" > Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c13'] == 1) ? 'selected' : '';  ?> >La remuneración ofrecida era insuficiente</option>
											<option value="2" <?php //echo ($dispc['i1r2c13'] == 2) ? 'selected' : '';  ?> >Postulantes sub-calificados</option>
											<option value="3" <?php //echo ($dispc['i1r2c13'] == 3) ? 'selected' : '';  ?> >Postulantes sobre-calificados</option>
											<option value="4" <?php //echo ($dispc['i1r2c13'] == 4) ? 'selected' : '';  ?> >Falta de experiencia o conocimiento específico</option>
											<option value="5" <?php //echo ($dispc['i1r2c13'] == 5) ? 'selected' : '';  ?> >Los postulantes no dominaban otros idiomas</option>
											<option value="6" <?php //echo ($dispc['i1r2c13'] == 6) ? 'selected' : '';  ?> >Pocos postulantes</option>
											<option value="7" <?php //echo ($dispc['i1r2c13'] == 7) ? 'selected' : '';  ?> >Otra</option>
										</select>
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-7">
									<label class="">Cual?</label>
									<div>
										<input type='text' class='form-control input-sm validar' id='' name='<?php //echo $ncam; ?>13' maxlength="50" value="<?php //echo $dispc['i1r2c14']?>" disabled/>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Disponibilidad 1</h3>
						</div>
						<div class="panel-body text-center">
							<div class="row">
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Cantidad de vacantes abiertas</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right subVac solo-numero validar' id='' name="<?php //echo $ncam; ?>0" value = "<?php //echo $dispc['i1r2c1'];?>" maxlength="3"  disabled/>
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">&Aacute;rea funcional</label>
									<div class='small'>
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>1" disabled>
											<option value=""> Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c2'] == 1) ? 'selected' : '';  ?> >Área de dirección general</option>
											<option value="2" <?php //echo ($dispc['i1r2c2'] == 2) ? 'selected' : '';  ?> >Área de administración</option>
											<option value="3" <?php //echo ($dispc['i1r2c2'] == 3) ? 'selected' : '';  ?> >Área de mercadeo/ventas</option>
											<option value="4" <?php //echo ($dispc['i1r2c2'] == 4) ? 'selected' : '';  ?> >Área de producción</option>
											<option value="5" <?php //echo ($dispc['i1r2c2'] == 5) ? 'selected' : '';  ?> >Área de contabilidad y finanzas</option>
											<option value="6" <?php //echo ($dispc['i1r2c2'] == 6) ? 'selected' : '';  ?> >Personal de Investigación y desarrollo</option>
											<option value="7" <?php //echo ($dispc['i1r2c2'] == 7) ? 'selected' : '';  ?> >Personal de apoyo</option>
										</select>								
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Mínimo nivel educativo requerido</label>
									<div class='small'>
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>2" disabled>
											<option value="" > Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c3'] == 1) ? 'selected' : '';  ?> >No bachiller</option>
											<option value="2" <?php //echo ($dispc['i1r2c3'] == 2) ? 'selected' : '';  ?> >Educación básica secundaria (6° - 9°)</option>
											<option value="3" <?php //echo ($dispc['i1r2c3'] == 3) ? 'selected' : '';  ?> >Educación media   (10° - 13°)</option>
											<option value="4" <?php //echo ($dispc['i1r2c3'] == 4) ? 'selected' : '';  ?> >Técnico laboral</option>
											<option value="5" <?php //echo ($dispc['i1r2c3'] == 5) ? 'selected' : '';  ?> >Técnico profesional</option>
											<option value="6" <?php //echo ($dispc['i1r2c3'] == 6) ? 'selected' : '';  ?> >Tecnólogo</option>
											<option value="7" <?php //echo ($dispc['i1r2c3'] == 7) ? 'selected' : '';  ?> >Estudiante universitario</option>
											<option value="8" <?php //echo ($dispc['i1r2c3'] == 8) ? 'selected' : '';  ?> >Profesional universitario</option>
											<option value="9" <?php //echo ($dispc['i1r2c3'] == 9) ? 'selected' : '';  ?> >Especialización </option>
											<option value="10" <?php //echo ($dispc['i1r2c3'] == 10) ? 'selected' : '';  ?> >Maestría</option>
											<option value="11" <?php //echo ($dispc['i1r2c3'] == 11) ? 'selected' : '';  ?> >Doctorado</option>
											<option value="12" <?php //echo ($dispc['i1r2c3'] == 12) ? 'selected' : '';  ?> >No requiere estudios</option>
										</select>
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Área de Formación</label>
									<div class='small'>
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>3" disabled>
											<option value="" > Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c4'] == 1) ? 'selected' : '';  ?> >Economía, Administración y Contaduría</option>
											<option value="2" <?php //echo ($dispc['i1r2c4'] == 2) ? 'selected' : '';  ?> >Ingeniería, Arquitectura Urbanismo y afines</option>
											<option value="3" <?php //echo ($dispc['i1r2c4'] == 3) ? 'selected' : '';  ?> >Ciencias Sociales y humanas</option>
											<option value="4" <?php //echo ($dispc['i1r2c4'] == 4) ? 'selected' : '';  ?> >Ciencias de la educación</option>
											<option value="5" <?php //echo ($dispc['i1r2c4'] == 5) ? 'selected' : '';  ?> >Ciencias de la salud</option>
											<option value="6" <?php //echo ($dispc['i1r2c4'] == 6) ? 'selected' : '';  ?> >Bellas artes</option>
											<option value="7" <?php //echo ($dispc['i1r2c4'] == 7) ? 'selected' : '';  ?> >Agronomía, Veterinaria</option>
											<option value="8" <?php //echo ($dispc['i1r2c4'] == 8) ? 'selected' : '';  ?> >Matemáticas y ciencias naturales</option>
											<option value="9" <?php //echo ($dispc['i1r2c4'] == 9) ? 'selected' : '';  ?> >No aplica</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Experiencia en meses</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php //echo $ncam; ?>4' value = "<?php //echo $dispc['i1r2c5']?>" maxlength="3" disabled />
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Modalidad de Contratación</label>
									<div class='small'>
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>5" disabled>
											<option value="" > Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c6'] == 1) ? 'selected' : '';  ?> >Término Indefinido</option>
											<option value="2" <?php //echo ($dispc['i1r2c6'] == 2) ? 'selected' : '';  ?> >Término  Fijo</option>
											<option value="3" <?php //echo ($dispc['i1r2c6'] == 3) ? 'selected' : '';  ?> >Prestación de servicios</option>
											<option value="4" <?php //echo ($dispc['i1r2c6'] == 4) ? 'selected' : '';  ?> >Por  obra  o  labor  contratada</option>
											<option value="5" <?php //echo ($dispc['i1r2c6'] == 5) ? 'selected' : '';  ?> >Ocasional ó Transitorio</option>
										</select>
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Salario u honorarios mensuales</label>
									<div class='input-group input-group-sm'>
										<span class="input-group-addon" id="sizing-addon1">$</span>
										<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php //echo $ncam; ?>6' value = "<?php //echo $dispc['i1r2c7']?>" maxlength="9" disabled />
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">Edad</label>
									<div class='small'>
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>7" disabled>
											<option value="" > Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c8'] == 1) ? 'selected' : '';  ?> >15 - 20</option>
											<option value="2" <?php //echo ($dispc['i1r2c8'] == 2) ? 'selected' : '';  ?> >20 - 25</option>
											<option value="3" <?php //echo ($dispc['i1r2c8'] == 3) ? 'selected' : '';  ?> >25 - 30</option>
											<option value="4" <?php //echo ($dispc['i1r2c8'] == 4) ? 'selected' : '';  ?> >30 - 35</option>
											<option value="5" <?php //echo ($dispc['i1r2c8'] == 5) ? 'selected' : '';  ?> >35 - 40</option>
											<option value="6" <?php //echo ($dispc['i1r2c8'] == 6) ? 'selected' : '';  ?> >40 - 45</option>
											<option value="7" <?php //echo ($dispc['i1r2c8'] == 7) ? 'selected' : '';  ?> >45 - 50</option>
											<option value="8" <?php //echo ($dispc['i1r2c8'] == 8) ? 'selected' : '';  ?> >50 - 55</option>
											<option value="9" <?php //echo ($dispc['i1r2c8'] == 9) ? 'selected' : '';  ?> >55 - 60</option>
											<option value="10" <?php //echo ($dispc['i1r2c8'] == 10) ? 'selected' : '';  ?> >60 - 65</option>
											<option value="11" <?php //echo ($dispc['i1r2c8'] == 11) ? 'selected' : '';  ?> >65 - 70</option>
											<option value="12" <?php //echo ($dispc['i1r2c8'] == 12) ? 'selected' : '';  ?> >70 - 75</option>
											<option value="13" <?php //echo ($dispc['i1r2c8'] == 13) ? 'selected' : '';  ?> >75 - 80</option>
											<option value="14" <?php //echo ($dispc['i1r2c8'] == 14) ? 'selected' : '';  ?> >80 - 85</option>
											<option value="15" <?php //echo ($dispc['i1r2c8'] == 15) ? 'selected' : '';  ?> >85 - 90</option>
											<option value="16" <?php //echo ($dispc['i1r2c8'] == 16) ? 'selected' : '';  ?> >Indiferente</option>
										</select>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">De las vacantes ¿Cuántas logró cubrir?</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php //echo $ncam; ?>8' value = "<?php //echo $dispc['i1r2c9']?>" maxlength="9" disabled />
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right validar' id='' name='<?php //echo $ncam; ?>9' value = "<?php //echo $dispc['i1r2c10']?>" maxlength="9" disabled />
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php //echo $ncam; ?>10' value = "<?php //echo $dispc['i1r2c11']?>" maxlength="9" readonly disabled />
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
									<label class="">De las vacantes ¿Cuántas NO logró cubrir? </label>
									<div class='small'>
										<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='<?php //echo $ncam; ?>11' value = "<?php //echo $dispc['i1r2c12']?>" maxlength="9" readonly disabled />
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="form-group form-group-sm col-xs-12 col-sm-5 ">
									<label>De las vacantes NO cubiertas ¿Cuáles fueron las causas?</label>
									<div class="small">
										<select class='form-control input-sm validar' id="" name="<?php //echo $ncam; ?>12" disabled >
											<option value="" > Seleccione una opción</option>
											<option value="1" <?php //echo ($dispc['i1r2c13'] == 1) ? 'selected' : '';  ?> >La remuneración ofrecida era insuficiente</option>
											<option value="2" <?php //echo ($dispc['i1r2c13'] == 2) ? 'selected' : '';  ?> >Postulantes sub-calificados</option>
											<option value="3" <?php //echo ($dispc['i1r2c13'] == 3) ? 'selected' : '';  ?> >Postulantes sobre-calificados</option>
											<option value="4" <?php //echo ($dispc['i1r2c13'] == 4) ? 'selected' : '';  ?> >Falta de experiencia o conocimiento específico</option>
											<option value="5" <?php //echo ($dispc['i1r2c13'] == 5) ? 'selected' : '';  ?> >Los postulantes no dominaban otros idiomas</option>
											<option value="6" <?php //echo ($dispc['i1r2c13'] == 6) ? 'selected' : '';  ?> >Pocos postulantes</option>
											<option value="7" <?php //echo ($dispc['i1r2c13'] == 7) ? 'selected' : '';  ?> >Otra</option>
										</select>
									</div>
								</div>
								<div class="form-group form-group-sm col-xs-12 col-sm-7">
									<label class="">Cual?</label>
									<div>
										<input type='text' class='form-control input-sm validar' id='' name='<?php //echo $ncam; ?>13' maxlength="50" value="<?php //echo $dispc['i1r2c14']?>" disabled/>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>

			<!--div id="tabla" class="row text-center">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<td>Cantidad de vacantes abiertas</td>
									<td>&Aacute;rea funcional</td>
									<td>Mínimo nivel educativo requerido</td>
									<td>Área de Formación</td>
									<td>Experiencia en meses</td>
									<td>Modalidad de Contratación</td>
									<td>Salario u honorarios mensuales</td>
									<td>Edad</td>
									<td>¿Cuántas logró cubrir?</td>
									<td>¿cuantas se ocuparon con hombres?</td>
									<td>¿Cuántas se ocuparon con mujeres?</td>
									<td>¿Cuántas NO logró cubrir?</td>
									<td>¿Cuáles fueron las causas?</td>
									<td>Cual?</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>con:1</td>
									<td>con:2</td>
									<td>con:3</td>
									<td>con:4</td>
									<td>con:5</td>
									<td>con:6</td>
									<td>con:7</td>
									<td>con:8</td>
									<td>con:9</td>
									<td>con:10</td>
									<td>con:11</td>
									<td>con:12</td>
									<td>con:13</td>
									<td>con:14</td>
								</tr>
								<tr>
									<td>con:1</td>
									<td>con:2</td>
									<td>con:3</td>
									<td>con:4</td>
									<td>con:5</td>
									<td>con:6</td>
									<td>con:7</td>
									<td>con:8</td>
									<td>con:9</td>
									<td>con:10</td>
									<td>con:11</td>
									<td>con:12</td>
									<td>con:13</td>
									<td>con:14</td>
								</tr>
								<tr>
									<td>con:1</td>
									<td>con:2</td>
									<td>con:3</td>
									<td>con:4</td>
									<td>con:5</td>
									<td>con:6</td>
									<td>con:7</td>
									<td>con:8</td>
									<td>con:9</td>
									<td>con:10</td>
									<td>con:11</td>
									<td>con:12</td>
									<td>con:13</td>
									<td>con:14</td>
								</tr>
								<tr>
									<td>con:1</td>
									<td>con:2</td>
									<td>con:3</td>
									<td>con:4</td>
									<td>con:5</td>
									<td>con:6</td>
									<td>con:7</td>
									<td>con:8</td>
									<td>con:9</td>
									<td>con:10</td>
									<td>con:11</td>
									<td>con:12</td>
									<td>con:13</td>
									<td>con:14</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div-->

		</fieldset>

		<fieldset class="container-fluid">
			<legend>2</legend>
			<div class="row">
				<div class="col-xs-12">Contenido para filas de prueba 2</div>
			</div>
		</fieldset>

		<fieldset class="container-fluid">
			<legend>3</legend>
			<div class="row">
				<div class="col-xs-12">Contenido para filas de prueba 3</div>
			</div>
		</fieldset>

	</div>
</body>
</html>
<?php
	$html = ob_get_clean();
	$dompdf = new DOMPDF();
	$dompdf->set_base_path('editsv/bootstrap/css/');
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream($nombrefor);
?>