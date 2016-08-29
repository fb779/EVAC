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
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</head>
	<body>
		<?php
			include 'menuRet.php';
		?>
		<div class="container" style="margin-top: 10px; padding-top: 60px">
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
		</div>
 	</body>
 </html>
