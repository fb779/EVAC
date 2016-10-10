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
	$sind = 0; $dist = ">0"; $digi = 2; $digit = 3; $crit = 4; $verif = 5; $acepta = 6; $nove = 7; $totalG=0; $novedades = "1,2,3,4,6,10,12,13,97,41,19";

	if (isset($_GET['regi'])) {
		$regOpe = $_GET['regi'];
		$sedes = '';
	}
	else {
		$regOpe = $region;
		$sedes = $regOpe;
	}
	if ($regOpe == 99) {
		$campoUsu = "codsede";
		$campDevol = "coddev";
	}
	else {
		$campoUsu = "codsede";
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
		 "total" => 'TOTAL'
	);

	$qSedes = $conn->query("SELECT codis, nombre FROM regionales ORDER BY codis");
	// $qUsu = $conn->query("SELECT ident, nombre FROM usuarios WHERE region = $regOpe AND tipo = 'CR' ORDER BY ident");

	/* crear datos para alimentar la tabla */
	$dtSource = array();
	foreach($qSedes as $key=>$lSede) {
		$sede = $lSede['codis'];
		$qControl = $conn->query("SELECT IFNULL(estado, 'TOTAL') AS estado, COUNT( estado ) AS grpestado FROM `control` WHERE codsede in ($sede) AND vigencia = $vig AND novedad NOT IN ($novedades) GROUP BY estado WITH ROLLUP");

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

		$qNovedad = $conn->query("SELECT COUNT(nordemp) AS nove FROM control WHERE vigencia = $vig AND codsede = '$sede' AND novedad IN ($novedades)")->fetch(PDO::FETCH_ASSOC);
		$valnov = $qNovedad['nove'];

		$devolucion = $conn->query("SELECT COUNT(*) AS devolucion FROM devoluciones AS dv WHERE dv.vigencia = $vig AND dv.codsede = '$sede' AND tipo IN ('DEV')")->fetch(PDO::FETCH_ASSOC);
		$dtSource[$key]['devueltos'] = $devolucion['devolucion'];

		$hisDevoluciones = $conn->query("SELECT COUNT(*) AS hisdevo FROM devoluciones AS dv WHERE dv.vigencia = $vig AND dv.codsede = '$sede' AND tipo IN ('RV')")->fetch(PDO::FETCH_ASSOC);
		$dtSource[$key]['hisDevolucion'] = $hisDevoluciones['hisdevo'];

		$dtSource[$key]['ident'] = $lSede['codis'];
		$dtSource[$key]['nombre'] = $lSede['nombre'];
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
			$dtSource[$key]['calidad'] = round( ( 1-( ($dtSource[$key]['devueltos']+$dtSource[$key]['hisDevolucion'])/($dtSource[$key]['hisDevolucion']+$dtSource[$key]['dane']+$dtSource[$key]['aceptado']) ) )*100, 2, PHP_ROUND_HALF_DOWN).'%';
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

		<link href="../bootstrap/css/jquery.dataTables.min.css" rel="stylesheet">
		<script type="text/javascript" charset="utf8" src="../bootstrap/js/jquery.dataTables.min.js"></script>

		<link href="../bootstrap/css/bootstrap-dialog.css" rel="stylesheet">
		<script type="text/javascript" src="../js/bootstrap-dialog.min.js"></script>

		<style type="text/css">
			p {font-size: 13px !important;}
			#mdalReport{
				width: 98% !important;
				/*font-size: 0.85em;*/
			}

			/*#mdalReport table.dataTable tbody {
				font-size: 0.8em;
			}*/

			/*#mdalReport.btn{
				font-size: 0.6em;
			}*/
			table.dataTable {
				font-size: 0.8em;
			}

			table.dataTable thead th, table.dataTable tbody td {
				vertical-align: middle;
				/*text-align: center;*/
			}

			.text-center {
				vertical-align: middle;
			}

			.fondo {
				background-color: #ccc;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				var $sedeCons = '';
				var $tpCons = '';
				// var $tbReporte = $('#repCriticos').DataTable( {
				// 	language:{ "url": "../js/Spanish.json" },
				// 	responsive: true,
				// 	retrieve: true,
				// });

				$('[data-toggle="tooltip"]').tooltip();

				$('#example').DataTable( {
					language:{ "url": "../js/Spanish.json" },
					responsive: true,
					// "pagingType": "numbers",
					// "search": {
					// 	"caseInsensitive": true
					// }
				});

				$(".rpCritico").click(function(){
					$sedeCons = $(this).parent().parent().attr('name');
					$tpCons = $(this).attr('name');
					$("#modalReportes").modal("show");
			    });


				$("#modalReportes").on('show.bs.modal', function () {
					var $tbody = $('#repCriticos tbody');

					$.ajax({
						async: false,
						cache: false,
						url: '../persistencia/reporteCriticoNacional.php',
						type: 'POST',
						dataType: 'json',
						data: {'sede': $sedeCons, 'tpConsulta': $tpCons, 'region': '<?php echo $regOpe; ?>'},
					})
					.done(function(data) {
						if (data.success){
							var $empresas = data.data;
							var $title = $('.modal-header div');
							$title.html('<h4 class="modal-title text-center"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> &nbsp; REPORTE DE CRITICOS</h4>');

							$title.append('<h5 class="modal-title text-center"> <strong> Sede: </strong>'+ data.critico +'</h5>');

							$.each($empresas,function(i, item){
								$tbody.append('<tr class="text-center"> <td>'+item.nordemp+'</td> <td class="text-left">'+item.nombre+'</td> <td>'+item.depto+'</td> <td>'+item.mpio+'</td> <td>'+item.ciiu+'</td> <td>'+item.categoriaCiiu+'</td> <td>'+item.regional+'</td> <td>'+item.territorial+'</td> <td>'+item.codsede+'</td> <td>'+item.inclusion+'</td> <td>'+item.novedad+'</td> <td>'+item.estado+'</td> <td>'+item.devolucion+'</td> <td>'+item.fecha+'</td> <td>'+item.dias+'</td> <td>'+item.critico+'</td> <td> <button class="observa btn btn-link" name="'+item.nordemp+'" type="">Observaciones</button></td> </tr>');
							});
						}

						$('#repCriticos').DataTable( {
							language:{ "url": "../js/Spanish.json" },
							responsive: true,
							retrieve: true,
						});
					});

					$("#modalReportes").on('hidden.bs.modal', function () {
						$sedeCons = '';
						$tpCons = '';

						$('#repCriticos').DataTable().clear().draw();
						$('#repCriticos').DataTable().destroy();
					});

				});

				$('#repCriticos').on('click', '.observa', function() {
					var $item = $(this);
					BootstrapDialog.show({
						size: BootstrapDialog.SIZE_WIDE,
						title: 'Observaciones de la empresa: '+$item.attr('name'),
						message: function(dialogRef){
							// dialogRef.setTitle('Observaciones de la empresa ' $);
							var $message = $('<div></div>');
							$message.append('<div class="row well well-sm text-center"> <div class="col-xs-1">Fecha</div> <div class="col-xs-1">Usuario</div> <div class="col-xs-3">Critico</div> <div class="col-xs-7">Observaciones</div> </div>')
							var $datos = '';
							$.ajax({
								async: false,
								cache: false,
								url: '../persistencia/cargaObservaciones.php',
								type: 'POST',
								dataType: 'json',
								data: {'empresa': $item.attr('name')},
							}).done(function(data) {
								// debugger;
								if (data.success){
									dialogRef.getModalDialog().css('width','70%');
									dialogRef.getModalHeader().addClass('text-center')
									var $observa = data.data;

									$.each($observa, function(i, item) {
										$message.append('<div class="row"> <div class="col-xs-1">'+item.fecha+'</div> <div class="col-xs-1">'+item.ident+'</div> <div class="col-xs-3">'+item.nombre+'</div> <div class="col-xs-7">'+item.observacion+'</div> </div>');
									});

								}
							});

							return $message;
						},
						closable: false,
						// onshow: function(){

						// },
						buttons: [{
							label: 'Cerrar',
							action: function(dialog) {
								dialog.close();
							}
						}]
					});

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
					<div class="panel-heading">Reporte de criticos nacional  </div>
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
								<!-- <tr>
									<th colspan="" class="text-left">TOTAL</th>
									<th class="text-center"> <?php echo $totalG ?> </th>
									<th colspan="11">&nbsp;</th>
								</tr> -->
							</tfoot>
							<tbody>
								<?php foreach($dtSource as $dt) { ?>
									<tr name="<?php echo $dt['ident'] ?>">
										<td class="text-left"><?php echo $dt['nombre']; ?></td>
										<td class="text-center"> <button name="dr" class="rpCritico btn btn-link"> <?php echo $dt['totalUsu']; ?> </button></td>
										<td class="text-center"> <button name="sd" class="rpCritico btn btn-link"> <?php echo $dt['sinDIgitar'] . '</button> - <strong>' . porcentaje($dt['totalUsu'],$dt['sinDIgitar']).'</strong>'; ?></td>
										<td class="text-center"> <button name="dg" class="rpCritico btn btn-link"> <?php echo $dt['digitacion'] . '</button> - <strong>' . porcentaje($dt['totalUsu'],$dt['digitacion']).'</strong>'; ?></td>
										<td class="text-center"> <button name="gb" class="rpCritico btn btn-link"> <?php echo $dt['grabados'] . '</button> - <strong>' . porcentaje($dt['totalUsu'],$dt['grabados']).'</strong>'; ?></td>
										<td class="text-center"> <button name="dv" class="rpCritico btn btn-link"> <?php echo $dt['devueltos'] . '</button> - <strong>' . porcentaje($dt['totalUsu'],$dt['devueltos']).'</strong>'; ?></td>
										<td class="text-center"> <button name="hdv" class="rpCritico btn btn-link"> <?php echo $dt['hisDevolucion'] . '</button> - <strong>' . porcentaje($dt['totalUsu'],$dt['hisDevolucion']).'</strong>'; ?></td>
										<td class="text-center"> <button name="cr" class="rpCritico btn btn-link"> <?php echo $dt['dane'] . '</button> - <strong>' . porcentaje($dt['totalUsu'],$dt['dane']).'</strong>'; ?></td>
										<td class="text-center"> <button name="ap" class="rpCritico btn btn-link"> <?php echo $dt['aceptado'] . '</button> - <strong>' . porcentaje($dt['totalUsu'],$dt['aceptado']).'</strong>'; ?></td>
										<td class="text-center"> <button name="nv" class="rpCritico btn btn-link"> <?php echo $dt['novedad'] . '</button> - <strong>' . porcentaje($dt['totalUsu'],$dt['novedad']).'</strong>'; ?></td>
										<td class="text-center"> <button name="de" class="rpCritico btn btn-link"> <?php echo $dt['deuda'] . '</button> - <strong>' . porcentaje($dt['totalUsu'],$dt['deuda']).'</strong>'; ?></td>
										<td class="text-center"> <button name="re" class="rpCritico btn btn-link"> <?php echo $dt['recolectados'] . '</button> - <strong>' . porcentaje($dt['totalUsu'],$dt['recolectados']).'</strong>'; ?></td>
										<td class="text-center"><strong><?php echo $dt['calidad'] ?><strong></td>
									</tr>
									<!-- <tr>
										<td class="text-left" rowspan="2"><?php echo $dt['nombre']; ?></td>
										<td class="text-center" rowspan="2"> <button name="dr" class="btn btn-link"> <?php echo $dt['totalUsu']; ?> </button></td>
										<td class="text-center"> <button name="sd" class="btn btn-link"> <?php echo $dt['sinDIgitar'] . '</button>'; ?></td>
										<td class="text-center"> <button name="dg" class="btn btn-link"> <?php echo $dt['digitacion'] . '</button>'; ?></td>
										<td class="text-center"> <button name="gb" class="btn btn-link"> <?php echo $dt['grabados'] . '</button> '; ?></td>
										<td class="text-center"> <button name="dv" class="btn btn-link"> <?php echo $dt['devueltos'] . '</button> '; ?></td>
										<td class="text-center"> <button name="hdv" class="btn btn-link"> <?php echo $dt['hisDevolucion'] . '</button> '; ?></td>
										<td class="text-center"> <button name="cr" class="btn btn-link"> <?php echo $dt['dane'] . '</button> '; ?></td>
										<td class="text-center"> <button name="ap" class="btn btn-link"> <?php echo $dt['aceptado'] . '</button>'; ?></td>
										<td class="text-center"> <button name="nv" class="btn btn-link"> <?php echo $dt['novedad'] . '</button> '; ?></td>
										<td class="text-center"> <button name="de" class="btn btn-link"> <?php echo $dt['deuda'] . '</button> '; ?></td>
										<td class="text-center"> <button name="re" class="btn btn-link"> <?php echo $dt['recolectados'] . '</button>'; ?></td>
										<td class="text-center" rowspan="2"><strong><?php echo $dt['calidad'] ?><strong></td>
									</tr>

									<tr>
										<td class="text-center"> <?php echo ' <stron>' . porcentaje($dt['totalUsu'],$dt['sinDIgitar']).'</strong>'; ?></td>
										<td class="text-center"> <?php echo ' <stron>' . porcentaje($dt['totalUsu'],$dt['digitacion']).'</strong>'; ?></td>
										<td class="text-center"> <?php echo ' <stron>' . porcentaje($dt['totalUsu'],$dt['grabados']).'</strong>'; ?></td>
										<td class="text-center"> <?php echo ' <stron>' . porcentaje($dt['totalUsu'],$dt['devueltos']).'</strong>'; ?></td>
										<td class="text-center"> <?php echo ' <stron>' . porcentaje($dt['totalUsu'],$dt['hisDevolucion']).'</strong>'; ?></td>
										<td class="text-center"> <?php echo ' <stron>' . porcentaje($dt['totalUsu'],$dt['dane']).'</strong>'; ?></td>
										<td class="text-center"> <?php echo ' <stron>' . porcentaje($dt['totalUsu'],$dt['aceptado']).'</strong>'; ?></td>
										<td class="text-center"> <?php echo ' <stron>' . porcentaje($dt['totalUsu'],$dt['novedad']).'</strong>'; ?></td>
										<td class="text-center"> <?php echo ' <stron>' . porcentaje($dt['totalUsu'],$dt['deuda']).'</strong>'; ?></td>
										<td class="text-center"> <?php echo ' <stron>' . porcentaje($dt['totalUsu'],$dt['recolectados']).'</strong>'; ?></td>
									</tr> -->
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

		<!-- creacion y manejo de modal para reporte de empresas para critico -->
		<div class="modal fade" id="modalReportes" role="dialog">
			<div id="mdalReport" class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<div class="text-center">
						</div>
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
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">

						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

 	</body>
 </html>
