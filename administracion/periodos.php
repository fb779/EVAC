<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';

	ini_set('default_charset', 'UTF-8');

	$id_usu = $_SESSION['idusu'];
	$id_region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$region = $_SESSION['region'];
	$nombre = $_SESSION['nombreu'];
	$devoluciones = false;
	$vig=$_SESSION['vigencia'];

	$rowRegion = $conn->query("SELECT nombre FROM regionales WHERE codis = $region")->fetch(PDO::FETCH_ASSOC);
	$qPeriodos = $conn->query('select * from periodoactivo order by id desc');
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
	<script src="../js/crearPeriodo.js" type="text/javascript"></script>


	<style type="text/css">
		div { margin-bottom: 10px; }
		p {font-size: 13px !important;}
	</style>
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php
		include 'menuCOCR.php';
		if ($tipousu == "CO") {
			echo "<br><br>";
			include 'menuCO.php';
		}

	?>
	<div class="container">
		<!-- <div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">Datos perdidos</div>
					<div class="panel-body">
						<?php /*$fecActual = getdate(); echo $fecActual['year'] ;*/ ?>
						<?php //echo print_r($_SESSION); ?>
					</div>
				</div>
			</div>
		</div> -->

		<div class="row">
			<div class="col-xs-12 text-center"><h3>Administracion de periodos</h3></div>
		</div>

		<div class="row small">
			<div class="col-xs-6">
				<div class="panel panel-default">
					<div class="panel-heading">Periodo Activo</div>
					<div class="panel-body">
						<span for=""><?php echo $_SESSION['nomPeriAct']; ?> </span>
					</div>
				</div>
			</div>

			<div class="col-xs-6">
				<div class="panel panel-default">
					<div class="panel-heading">Periodo actual</div>
					<div class="panel-body">
						<span for=""><?php echo $_SESSION['nomPeri']; ?></span>
					</div>
				</div>
			</div>
		</div>

		<?php if ($tipousu == 'CO' && $region == 99) { ?>
		<div class="row">
			<div class="col-xs-12">
				<button id="newPeriodo" type="button" class="btn btn-default" aria-label="Left Align">
					<span class="glyphicon glyphicon-plus text-primary" aria-hidden="true"></span> Crear Nuevo Periodo
				</button>
			</div>
		</div>
		<?php } ?>

		<div class="row small">
			<div class="col-xs-12">
				<?php if ($qPeriodos->rowCount() > 0) { ?>
					<div class="table-responsive">
						<table class="table table-striped text-center">
							<thead>
								<tr>
									<td>#</td>
									<td>Nombre Periodo</td>
									<td>A&ntilde;o Periodo</td>
									<td>estado periodo</td>
									<td>Fecha Creacion</td>

								</tr>
							</thead>
							<tbody>
								<?php foreach ($qPeriodos as $key => $value) { ?>
									<tr>
										<td> <?php echo $key+1; ?> </td>
										<td> <?php echo $value['nomperiodo'] ?> </td>
										<td> <?php echo $value['anioperiodo'] ?> </td>
										<td> <?php echo $value['estperiodo'] ?> </td>
										<td> <?php echo $value['feccreacion'] ?> </td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } else {?>
					<div class="panel panel-default">
						<div class="panel-heading"><h5> Mensaje de sistema</h5></div>
						<div class="panel-body text-center">
							<label for="">No se an creado periodos</label>
							<span for=""></span>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

</body>
</html>