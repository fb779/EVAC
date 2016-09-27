<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$id_usu = $_SESSION['idusu'];
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$devoluciones = false;
	$pagina = "REPORTE CRITICOS";
	$vig=$_SESSION['vigencia'];
	$sind = 0; $dist = ">0"; $digi = 2; $digit = 3; $crit = 4; $verif = 5; $acepta = 6; $nove = 7; $totalG=0; $novedades = "(1,2,3,4,6,10,12,13,97,41,19)";
	if (isset($_GET['regi'])) {
		$regOpe = $_GET['regi'];
	}
	else {
		$regOpe = $region;
	}
	if ($regOpe == 99) {
		$campoUsu = "usuario";
	}
	else {
		$campoUsu = "usuarioss";
	}

	$cols = array(
		 "Sin Distribuir"=>0,
		 "Distribuidos"=>1,
		 "Pendientes"=>2,
		 "En Digitaci&oacute;n"=>3,
		 "Digitados"=>4,
		 "An&aacute;lisis Verificaci&oacute;n"=>5,
		 "Verificados"=>6,
		 "Aceptados"=>7,
		 "Novedades"=>8);

	$qUsuarios = $conn->query("SELECT ident, nombre FROM usuarios WHERE region = $regOpe AND tipo = 'CR' ORDER BY ident");

	/* crear datos para alimentar la tabla */
	$dtSource = array();
	foreach($qUsuarios as $key=>$lUsuarios) {
		$usurep = $lUsuarios['ident'];
		$qControl = $conn->query("SELECT IFNULL(estado, 'TOTAL') AS estado, COUNT( estado ) AS grpestado FROM `control` WHERE $campoUsu = '$usurep' AND vigencia = $vig AND novedad NOT IN $novedades GROUP BY estado WITH ROLLUP");

		$valor1 =0; $valor2 =0; $valor3 =0; $valor4 =0; $valor5 =0; $valor6 =0; $valor7 =0; $valor8 =0; $valnov =0; $distri =0;
		foreach($qControl AS $lControl) {
			switch ($lControl['estado']) {
				case "0":
					$valor1 = $lControl['grpestado'];
					break;
				case "1":
					$distri += $lControl['grpestado'];
					$valor2 = $lControl['grpestado'];
					break;
				case "2":
					$distri += $lControl['grpestado'];
					$valor3 = $lControl['grpestado'];
					break;
				case "3":
					$distri += $lControl['grpestado'];
					$valor4 = $lControl['grpestado'];
					break;
				case "4":
					$distri += $lControl['grpestado'];
					$valor5 = $lControl['grpestado'];
					break;
				case "5":
					$distri += $lControl['grpestado'];
					$valor6 = $lControl['grpestado'];
					break;
				case "6":
					$distri += $lControl['grpestado'];
					$valor7 = $lControl['grpestado'];
					break;
				case "TOTAL":
					$valor8 = $lControl['grpestado'];
					break;
			}
		}
		$qNovedad = $conn->query("SELECT COUNT(nordemp) AS nove FROM control WHERE vigencia = $vig AND $campoUsu = '$usurep' AND novedad IN $novedades");
		foreach($qNovedad AS $lNovedad) {
			$valnov = $lNovedad['nove'];
		}

		$dtSource[$key]['ident'] = $lUsuarios['ident'];
		$dtSource[$key]['nombre'] = $lUsuarios['nombre'];

		if ($valor1 == 0) { $dtSource[$key]['val1'] = 0; }
		else { $dtSource[$key]['val1'] = $valor1; }

		if ($distri == 0) { $dtSource[$key]['val2'] = 0; }
		else { $dtSource[$key]['val2'] = $valor2; }

		if ($valor2 == 0) { $dtSource[$key]['val3'] = 0; }
		else { $dtSource[$key]['val3'] = $valor3; }

		if ($valor3 == 0) { $dtSource[$key]['val4'] = 0; }
		else { $dtSource[$key]['val4'] = $valor3; }

		if ($valor4 == 0) { $dtSource[$key]['val5'] = 0; }
		else { $dtSource[$key]['val5'] = $valor4; }

		if ($valor5 == 0) { $dtSource[$key]['val6'] = 0; }
		else { $dtSource[$key]['val6'] = $valor5; }

		if ($valor6 == 0) { $dtSource[$key]['val7'] = 0; }
		else { $dtSource[$key]['val7'] = $valor6; }

		if ($valor7 == 0) { $dtSource[$key]['val8'] = 0; }
		else { $dtSource[$key]['val8'] = $valor7; }

		if ($valnov == 0) {

			$dtSource[$key]['novedad'] = 0;
		}
		else {

			$dtSource[$key]['val1'] = $valor8;
		}

		$totalusu = $valor8+$valnov;
		$dtSource[$key]['totalUsu'] = $totalusu;

		$totalG = $totalG + $totalusu;
		// $dtSource['totalGlobal'] = $totalG;

		$totalusu =0;
	}

	$qNregion = $conn->prepare("SELECT nombre FROM regionales WHERE codis = :nRegion");
	$qNregion->execute(array(':nRegion'=>$region));
	$rowRegion = $qNregion->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title> <?php echo $_SESSION['titulo'] . 'Reporte criticos'; ?> </title>
		<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../bootstrap/css/custom.css" rel="stylesheet">
		<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<script type="text/javascript" src="../charts/amcharts/amcharts.js"></script>
		<script type="text/javascript" src="../charts/amcharts/serial.js"></script>

		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

		<style type="text/css"> p {font-size: 13px !important;}</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();

				$('#example').DataTable({
					language:{ "url": "../js/Spanish.json" }
				});
			});
		</script>
	</head>
	<body style="padding-top: 60px; ">
		<?php
			include 'menuRet.php';
		?>

		<div class="container-fluid">
			<div class="col-xs-12">


				<div class="panel panel-default">
					<div class="panel-heading">Titulo para la tabla de reporte</div>
					<div class="panel-body">
						<table id="example" class="display table table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th class="text-center">Usuario</th>
									<th class='text-center'>Nombre</th>
									<th class='text-center'>Sin Dist.</th>
									<!-- <th>%</th> -->
									<th class='text-center'>Distrib.</th>
									<!-- <th>%</th> -->
									<th class='text-center'>Pend.</th>
									<!-- <th>%</th> -->
									<th class='text-center'>En Dig.</th>
									<!-- <th>%</th> -->
									<th class='text-center'>Digit.</th>
									<!-- <th>%</th> -->
									<th class='text-center'>Revisi&oacute;n</th>
									<!-- <th>%</th> -->
									<th class='text-center'>Enviados DC.</th>
									<!-- <th>%</th> -->
									<th class='text-center'>Aceptados</th>
									<!-- <th>%</th> -->
									<th class='text-center'>Nove.</th>
									<!-- <th>%</th> -->
									<th class='text-center'>TOTAL</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th colspan="11" class="text-right">TOTAL</th>
									<th class="text-center"> <?php echo $totalG ?> </th>
								</tr>
							</tfoot>
							<tbody>
								<?php foreach($dtSource as $dt) { ?>
									<tr>
										<td class="text-center"><?php echo $dt['ident'] ?></td>
										<td class="text-left"><?php echo $dt['nombre'] ?></td>
										<td class="text-center"><?php echo $dt['val1'] ?></td>
										<td class="text-center"><?php echo $dt['val2'] ?></td>
										<td class="text-center"><?php echo $dt['val3'] ?></td>
										<td class="text-center"><?php echo $dt['val4'] ?></td>
										<td class="text-center"><?php echo $dt['val5'] ?></td>
										<td class="text-center"><?php echo $dt['val6'] ?></td>
										<td class="text-center"><?php echo $dt['val7'] ?></td>
										<td class="text-center"><?php echo $dt['val8'] ?></td>
										<td class="text-center"><?php echo $dt['novedad'] ?></td>
										<td class="text-center"><?php echo $dt['totalUsu'] ?></td>
									</tr>


							<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="panel-footer">
						<a href='xlsRepCrit.php' class='btn btn-primary btn-md' id="idxls" data-toggle='tooltip' title='Decargar a Excel'>
							<span class = "glyphicon glyphicon-download-alt"></span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- div class="container">
			<div class="col-md-12">
				<table class='table table-condensed table-hover hidden'>
					<thead>
						<tr>
							<th class="text-center">Usuario</th>
							<th class='text-center'>Nombre</th>
							<th class='text-right'>Sin Dist.</th>
							<th class='text-right'>Distrib.</th>
							<th class='text-right'>Pend.</th>
							<th class='text-right'>En Dig.</th>
							<th class='text-right'>Digit.</th>
							<th class='text-right'>Revisi&oacute;n</th>
							<th class='text-right'>Enviados DC.</th>
							<th class='text-right'>Aceptados</th>
							<th class='text-right'>Nove.</th>
							<th class='text-right'>TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($qUsuarios as $lUsuarios) {
								$usurep = $lUsuarios['ident'];
								$qControl = $conn->query("SELECT IFNULL(estado, 'TOTAL') AS estado, COUNT( estado ) AS grpestado FROM `control` WHERE $campoUsu = '$usurep'
									AND vigencia = $vig AND novedad NOT IN $novedades GROUP BY estado WITH ROLLUP");

								$valor1 =0; $valor2 =0; $valor3 =0; $valor4 =0; $valor5 =0; $valor6 =0; $valor7 =0; $valor8 =0; $valnov =0; $distri =0;
								foreach($qControl AS $lControl) {
									switch ($lControl['estado']) {
										case "0":
											$valor1 = $lControl['grpestado'];
											break;
										case "1":
											$distri += $lControl['grpestado'];
											$valor2 = $lControl['grpestado'];
											break;
										case "2":
											$distri += $lControl['grpestado'];
											$valor3 = $lControl['grpestado'];
											break;
										case "3":
											$distri += $lControl['grpestado'];
											$valor4 = $lControl['grpestado'];
											break;
										case "4":
											$distri += $lControl['grpestado'];
											$valor5 = $lControl['grpestado'];
											break;
										case "5":
											$distri += $lControl['grpestado'];
											$valor6 = $lControl['grpestado'];
											break;
										case "6":
											$distri += $lControl['grpestado'];
											$valor7 = $lControl['grpestado'];
											break;
										case "TOTAL":
											$valor8 = $lControl['grpestado'];
											break;
									}
								}
								$qNovedad = $conn->query("SELECT COUNT(nordemp) AS nove FROM control WHERE vigencia = $vig AND $campoUsu = '$usurep'
									AND novedad IN $novedades");
								foreach($qNovedad AS $lNovedad) {
									$valnov = $lNovedad['nove'];
								}
								echo "<tr>";
								echo "<td>" . $lUsuarios['ident'] . "</td>";
								echo "<td>" . $lUsuarios['nombre'] . "</td>";
								if ($valor1 == 0) {
									echo "<td class='text-center'>0</td>";
								}
								else {
									echo "<td class='text-center'><a href='listaRC.php?estado==0&usu=" . $usurep . "' target='_blank'>" . $valor1 . "</a></td>";
								}
								if ($distri == 0) {
									echo "<td class='text-center'>0</td>";
								}
								else {
									echo "<td class='text-center'><a href='listaRC.php?estado=>0&usu=" . $usurep . "' target='_blank'>" . $distri . "</a></td>";
								}
								if ($valor2 == 0) {
									echo "<td class='text-center'>0</td>";
								}
								else {
									echo "<td class='text-center'><a href='listaRC.php?estado==1&usu=" . $usurep . "' target='_blank'>" . $valor2 . "</a></td>";
								}
								if ($valor3 == 0) {
									echo "<td class='text-center'>0</td>";
								}
								else {
									echo "<td class='text-center'><a href='listaRC.php?estado==2&usu=" . $usurep . "' target='_blank'>" . $valor3 . "</a></td>";
								}
								if ($valor4 == 0) {
									echo "<td class='text-center'>0</td>";
								}
								else {
									echo "<td class='text-center'><a href='listaRC.php?estado==3&usu=" . $usurep . "' target='_blank'>" . $valor4 . "</a></td>";
								}
								if ($valor5 == 0) {
									echo "<td class='text-center'>0</td>";
								}
								else {
									echo "<td class='text-center'><a href='listaRC.php?estado==4&usu=" . $usurep . "' target='_blank'>" . $valor5 . "</a></td>";
								}
								if ($valor6 == 0) {
									echo "<td class='text-center'>0</td>";
								}
								else {
									echo "<td class='text-center'><a href='listaRC.php?estado==5&usu=" . $usurep . "' target='_blank'>" . $valor6 . "</a></td>";
								}
								if ($valor7 == 0) {
									echo "<td class='text-center'>0</td>";
								}
								else {
									echo "<td class='text-center'><a href='listaRC.php?estado==6&usu=" . $usurep . "' target='_blank'>" . $valor7 . "</a></td>";
								}
								if ($valnov == 0) {
									echo "<td class='text-center'>0</td>";
								}
								else {
									echo "<td class='text-center'><a href='listaRC.php?nove=SI&usu=" . $usurep . "' target='_blank'>" . $valnov . "</a></td>";
								}
								$totalusu = $valor8+$valnov;
								echo "<td class='text-center'>" . $totalusu . "</td>";
								$totalG = $totalG + $totalusu;
								echo "</tr>";
								$totalusu =0;
							}
							echo "<tr>";
							echo "<td colspan='11' class='text-right'><b>TOTAL</b></td>";
							echo "<td class='text-right'>" . $totalG . "</td>";
							echo "</tr>";
						?>
					</tbody>
				</table>
			</div>
			<div class='col-sm-1 small'>
				<a href='xlsRepCrit.php' class='btn btn-primary btn-md' id="idxls" data-toggle='tooltip' title='Decargar a Excel'>
					<span class = "glyphicon glyphicon-download-alt"></span>
				</a>
			</div>
		</div> -->
 	</body>
 </html>
