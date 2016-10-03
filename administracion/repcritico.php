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
		$campDevol = "coddev";
	}
	else {
		$campoUsu = "usuarioss";
		$campDevol = "codcrit";
	}

	$estados = array(
		 "sinDistribuir" => '0',
		 "distribuidos" => '1',
		 "digitacion" => '2',
		 "grabados" => '3',
		 "verificacion" => '4',
		 "danecentral" => '5',
		 "aceptado" => '6',
		 "novedades" => '7',
		 "total" => 'TOTAL'
	);

	$qUsuarios = $conn->query("SELECT ident, nombre FROM usuarios WHERE region = $regOpe AND tipo = 'CR' ORDER BY ident");
	$qUsu = $conn->query("SELECT ident, nombre FROM usuarios WHERE region = $regOpe AND tipo = 'CR' ORDER BY ident");
	/* crear datos para alimentar la tabla */
	$dtSource = array();
	foreach($qUsuarios as $key=>$lUsuarios) {
		$usurep = $lUsuarios['ident'];
		$qControl = $conn->query("SELECT IFNULL(estado, 'TOTAL') AS estado, COUNT( estado ) AS grpestado FROM `control` WHERE $campoUsu = '$usurep' AND vigencia = $vig AND novedad NOT IN $novedades GROUP BY estado WITH ROLLUP");

		$sinDistribuir =0; $distribuidos =0; $digitacion =0; $grabados =0; $criticados =0; $dane =0; $aceptado =0; $tUsuario =0; $valnov =0; $distri =0;
		foreach($qControl AS $lControl) {
			switch ($lControl['estado']) {
				case $estados['sinDistribuir']:
					$sinDistribuir = $lControl['grpestado'];
					break;
				case $estados['distribuidos']:
					// $distri += $lControl['grpestado'];
					$distribuidos = $lControl['grpestado'];
					break;
				case $estados['digitacion']:
					// $distri += $lControl['grpestado'];
					$digitacion = $lControl['grpestado'];
					break;
				case $estados['grabados']:
					// $distri += $lControl['grpestado'];
					$grabados = $lControl['grpestado'];
					break;
				case $estados['verificacion']:
					// $distri += $lControl['grpestado'];
					$criticados = $lControl['grpestado'];
					break;
				case $estados['danecentral']:
					// $distri += $lControl['grpestado'];
					$dane = $lControl['grpestado'];
					break;
				case $estados['aceptado']:
					// $distri += $lControl['grpestado'];
					$aceptado = $lControl['grpestado'];
					break;
				case $estados['total']:
					$tUsuario = $lControl['grpestado'];
					break;
			}
		}

		$qNovedad = $conn->query("SELECT COUNT(nordemp) AS nove FROM control WHERE vigencia = $vig AND $campoUsu = '$usurep' AND novedad IN $novedades")->fetch(PDO::FETCH_ASSOC);
		$valnov = $qNovedad['nove'];

		$devolucion = $conn->query("SELECT count(*) as devolucion FROM devoluciones WHERE vigencia = $vig AND $campDevol = '$usurep' AND tipo IN ('DEV')")->fetch(PDO::FETCH_ASSOC);
		$dtSource[$key]['devueltos'] = $devolucion['devolucion'];

		$hisDevoluciones = $conn->query("SELECT count(*) as hisdevo FROM devoluciones WHERE vigencia = $vig AND $campDevol = '$usurep' AND tipo IN ('RV')")->fetch(PDO::FETCH_ASSOC);
		$dtSource[$key]['hisDevolucion'] = $hisDevoluciones['hisdevo'];

		$dtSource[$key]['ident'] = $lUsuarios['ident'];
		$dtSource[$key]['nombre'] = $lUsuarios['nombre'];
		$dtSource[$key]['totalUsu'] = $tUsuario+$valnov;

		if (($sinDistribuir + $distribuidos) == 0) { $dtSource[$key]['sinDIgitar'] = 0; }
		else { $dtSource[$key]['sinDIgitar'] = $sinDistribuir + $distribuidos; }

		if ($digitacion == 0) { $dtSource[$key]['digitacion'] = 0; }
		else { $dtSource[$key]['digitacion'] = $digitacion; }

		if ($grabados + $criticados == 0) { $dtSource[$key]['grabados'] = 0; }
		else { $dtSource[$key]['grabados'] = $grabados + $criticados; }

		if ($dane == 0) { $dtSource[$key]['dane'] = 0; }
		else { $dtSource[$key]['dane'] = $dane; }

		if ($aceptado == 0) { $dtSource[$key]['aceptado'] = 0; }
		else { $dtSource[$key]['aceptado'] = $aceptado; }

		$dtSource[$key]['novedad'] = $valnov;

		$dtSource[$key]['deuda'] = ($dtSource[$key]['totalUsu'] - ($dtSource[$key]['dane'] + $dtSource[$key]['aceptado'] + $dtSource[$key]['novedad'] ));
		$dtSource[$key]['recolectados'] = ($dtSource[$key]['dane'] + $dtSource[$key]['aceptado'] + $dtSource[$key]['novedad'] );

		if ( $dtSource[$key]['hisDevolucion'] > 0 || $dtSource[$key]['dane'] > 0 && $dtSource[$key]['aceptado'] > 0 ){
			$dtSource[$key]['calidad'] = round((1-(($dtSource[$key]['devueltos']+$dtSource[$key]['hisDevolucion'])/($dtSource[$key]['hisDevolucion']+$dtSource[$key]['dane']+$dtSource[$key]['aceptado'])))*100,2,PHP_ROUND_HALF_DOWN).'%';
		} else{
			$dtSource[$key]['calidad'] = round(0,2,PHP_ROUND_HALF_DOWN).'%';
		}

		$totalG += $dtSource[$key]['totalUsu'];
		$totalusu =0;
	}

	$qNregion = $conn->prepare("SELECT nombre FROM regionales WHERE codis = :nRegion");
	$qNregion->execute(array(':nRegion'=>$region));
	$rowRegion = $qNregion->fetch(PDO::FETCH_ASSOC);

	function porcentaje($muestra, $valor){
		if ($muestra>0){
			$porcentaje = ($valor * 100)/$muestra;
		}else {
			$porcentaje = ($valor * 100)/1;
		}

		return round($porcentaje, 2, PHP_ROUND_HALF_DOWN) . '%';
	}
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

		<style type="text/css">
			p {font-size: 13px !important;}
			#mdalReport{
				width: 99% !important;
			}

			table.dataTable {
				font-size: 0.8em;
			}
			table.dataTable thead th, table.dataTable tbody td {
				vertical-align: middle;
				text-align: center;
			}

			.text-center {
				vertical-align: middle;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();

				$('#example').DataTable( {
					language:{ "url": "../js/Spanish.json" },
					responsive: true,
					// "pagingType": "numbers",
					// "search": {
					// 	"caseInsensitive": true
					// }
				});

				// $('#repCriticos').DataTable( {
				// 	language:{ "url": "../js/Spanish.json" },
				// 	responsive: true,
				// 	// "pagingType": "numbers",
				// 	// "search": {
				// 	// 	"caseInsensitive": true
				// 	// }
				// });

				$("#myBtn").click(function(){
			        // $("#myModal").modal("show");
					$("#modalReportes").modal("show");
			    });

				$("#modalReportes").on('show.bs.modal', function () {
					// debugger;
					$('#repCriticos').DataTable( {
						language:{ "url": "../js/Spanish.json" },
						// responsive: true,
						"ajax": "../persistencia/reporteCriticoListado.php",
				        "columns": [
				            {'data':'nordemp'},
							{'data':'nombre'},
							{'data':'depto'},
							{'data':'mpio'},
							{'data':'ciiu'},
							{'data':'categoriaCiiu'},
							{'data':'regional'},
							{'data':'territorial'},
							{'data':'codsede'},
							{'data':'inclusion'},
							{'data':'novedad'},
							{'data':'estado'},
							{'data':'devolucion'},
							{'data':'fecha'},
							{'data':'dias'},
							{'data':'critico'},
							{'data':'observacion'},
				        ]
						// "pagingType": "numbers",
						// "search": {
						// 	"caseInsensitive": true
						// }
					});
					console.log('si entre al evento del modal....');
					// alert('The modal is about to be shown.');
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
				<button type="button" class="btn btn-info btn-lg" id="myBtn">Open Modal</button>
			</div>
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">Titulo para la tabla de reporte</div>
					<div class="panel-body">
						<table id="example" class="display table table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th class="text-center" rowspan="2">Nombre Critico</th>
									<th class="text-center" rowspan="2">Directorio Asignado</th>
									<th class="text-center" rowspan="2">Sin digitar</th>
									<th class="text-center" rowspan="2">En digitaci&oacute;n</th>
									<th class="text-center" rowspan="2">Grabados</th>
									<th class="text-center" colspan="2">Devoluciones</th>
									<th class="text-center" rowspan="2">Criticados</th>
									<th class="text-center" rowspan="2">Aprobados</th>
									<th class="text-center" rowspan="2">Novedades</th>
									<th class="text-center" rowspan="2">Deuda</th>
									<th class="text-center" rowspan="2">Recolectados</th>
									<th class="text-center" rowspan="2">indicador Calidad</th>
									<!-- <th>13</th> -->
								</tr>

								<tr class="text-center">
									<th>Devueltos</th>
									<th>Historico</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th colspan="" class="text-left">TOTAL</th>
									<th class="text-center"> <?php echo $totalG ?> </th>
									<th colspan="11">&nbsp;</th>
								</tr>
							</tfoot>
							<tbody>
								<?php foreach($dtSource as $dt) { ?>
									<tr>
										<td class="text-left"><?php echo $dt['nombre']; ?></td>
										<td class="text-center"><?php echo $dt['totalUsu']; ?></td>
										<td class="text-center"><?php echo $dt['sinDIgitar'] . ' - <strong>' . porcentaje($dt['totalUsu'],$dt['sinDIgitar']).'</strong>'; ?></td>
										<td class="text-center"><?php echo $dt['digitacion'] . ' - <strong>' . porcentaje($dt['totalUsu'],$dt['digitacion']).'</strong>'; ?></td>
										<td class="text-center"><?php echo $dt['grabados'] . ' - <strong>' . porcentaje($dt['totalUsu'],$dt['grabados']).'</strong>'; ?></td>
										<td class="text-center"><?php echo $dt['devueltos'] . ' - <strong>' . porcentaje($dt['totalUsu'],$dt['devueltos']).'</strong>'; ?></td>
										<td class="text-center"><?php echo $dt['hisDevolucion'] . ' - <strong>' . porcentaje($dt['totalUsu'],$dt['hisDevolucion']).'</strong>'; ?></td>
										<td class="text-center"><?php echo $dt['dane'] . ' - <strong>' . porcentaje($dt['totalUsu'],$dt['dane']).'</strong>'; ?></td>
										<td class="text-center"><?php echo $dt['aceptado'] . ' - <strong>' . porcentaje($dt['totalUsu'],$dt['aceptado']).'</strong>'; ?></td>
										<td class="text-center"><?php echo $dt['novedad'] . ' - <strong>' . porcentaje($dt['totalUsu'],$dt['novedad']).'</strong>'; ?></td>
										<td class="text-center"><?php echo $dt['deuda'] . ' - <strong>' . porcentaje($dt['totalUsu'],$dt['deuda']).'</strong>'; ?></td>
										<td class="text-center"><?php echo $dt['recolectados'] . ' - <strong>' . porcentaje($dt['totalUsu'],$dt['recolectados']).'</strong>'; ?></td>
										<td class="text-center"><strong><?php echo $dt['calidad'] ?><strong></td>
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

		<div class="container">
			<div class="col-md-12">
				<table class='table table-condensed table-hover'>
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
							foreach($qUsu as $lUsuarios) {
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
		</div>

		<!-- creacion y manejo de modal para reporte de empresas para critico -->
		<div class="modal fade" id="modalReportes" role="dialog">
			<div id="mdalReport" class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class=" text-center"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> REPORTE DE CRITICOS</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12">
								<table id="repCriticos">
									<thead>
										<tr>
											<th  class="text-center">N. Orden</th>
											<th  class="text-center">Nombre</th>
											<th  class="text-center">Departamento</th>
											<th  class="text-center">Municipio</th>
											<th  class="text-center">Ciiu4</th>
											<th  class="text-center">Clase Ciiu4</th>
											<th  class="text-center">Regional Dane</th>
											<th  class="text-center">Dir Territorial - recolecta</th>
											<th  class="text-center">Sede</th>
											<th  class="text-center">Inclusión</th>
											<th  class="text-center">Novedad</th>
											<th  class="text-center">Estado</th>
											<th  class="text-center">Devuelto acumulado</th>
											<th  class="text-center">Fecha ultima devolución</th>
											<th  class="text-center">Diías hasta hoy</th>
											<th  class="text-center">Critico</th>
											<th  class="text-center">Observaciones</th>
										</tr>
									</thead>
									<!-- <tbody>
										<tr>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
										</tr>
										<tr>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>sir t amot.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
											<td>Lorem ipsum dolor sit amet.</td>
										</tr>
									</tbody> -->
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">

						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>

 	</body>
 </html>
