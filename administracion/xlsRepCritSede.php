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

		if ( $dtSource[$key]['hisDevolucion'] > 0 || $dtSource[$key]['dane'] > 0 || $dtSource[$key]['aceptado'] > 0 ){
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

	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=Reporte_critico.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>EDIT - Descarga de Archivos</title>
	</head>
	<body>
		<table>
			<thead>
				<tr>
					<th rowspan="2">Sede</th>
					<th rowspan="2">Directorio Asignado</th>
					<th rowspan="2">Sin digitar</th>
					<th rowspan="2">%</th>
					<th rowspan="2">En digitaci&oacute;n</th>
					<th rowspan="2">%</th>
					<th rowspan="2">Grabados</th>
					<th rowspan="2">%</th>
					<th colspan="4">Devoluciones</th>
					<th rowspan="2">Criticados</th>
					<th rowspan="2">%</th>
					<th rowspan="2">Aprobados</th>
					<th rowspan="2">%</th>
					<th rowspan="2">Novedades</th>
					<th rowspan="2">%</th>
					<th rowspan="2">Deuda</th>
					<th rowspan="2">%</th>
					<th rowspan="2">Recolectados</th>
					<th rowspan="2">%</th>
					<th rowspan="2">indicador Calidad</th>
				</tr>

				<tr>
					<th>Devueltos</th>
					<th>%</th>
					<th>Historico</th>
					<th>%</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($dtSource as $dt) { ?>
					<tr name="<?php echo $dt['ident'] ?>">
						<td><?php echo $dt['nombre']; ?></td>
						<td><?php echo $dt['totalUsu']; ?> </td>
						<td><?php echo $dt['sinDIgitar']; ?>
						<td><?php echo porcentaje($dt['totalUsu'],$dt['sinDIgitar']); ?></td>
						<td><?php echo $dt['digitacion']; ?>
						<td><?php echo porcentaje($dt['totalUsu'],$dt['digitacion']); ?></td>
						<td><?php echo $dt['grabados']; ?>
						<td><?php echo porcentaje($dt['totalUsu'],$dt['grabados']); ?></td>
						<td><?php echo $dt['devueltos']; ?>
						<td><?php echo porcentaje($dt['totalUsu'],$dt['devueltos']); ?></td>
						<td><?php echo $dt['hisDevolucion']; ?>
						<td><?php echo porcentaje($dt['totalUsu'],$dt['hisDevolucion']); ?></td>
						<td><?php echo $dt['dane']; ?>
						<td><?php echo porcentaje($dt['totalUsu'],$dt['dane']); ?></td>
						<td><?php echo $dt['aceptado']; ?>
						<td><?php echo porcentaje($dt['totalUsu'],$dt['aceptado']); ?></td>
						<td><?php echo $dt['novedad']; ?>
						<td><?php echo porcentaje($dt['totalUsu'],$dt['novedad']); ?></td>
						<td><?php echo $dt['deuda']; ?>
						<td><?php echo porcentaje($dt['totalUsu'],$dt['deuda']); ?></td>
						<td><?php echo $dt['recolectados']; ?>
						<td><?php echo porcentaje($dt['totalUsu'],$dt['recolectados']); ?></td>
						<td><?php echo $dt['calidad']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
 	</body>
</html>
