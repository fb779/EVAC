<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	include '../conecta.php';
	$region = $_SESSION['region'];
	$page='RESULTADO CASOS';
	$vig=$_SESSION['vigencia'];
	$periodo = $vig;
	$t1=true; $t2=true; $t3=true; $t4=true; $t5=true; $t6=true; $te=true; $tablas=''; $llaves = ''; $variables = ''; $tLlaves = 0; $noVig = false;
	$numCaso = $_GET['caso'];

	$qCasos = $conn->query("SELECT * FROM casos WHERE caso = $numCaso");
	
	foreach($qCasos AS $lCasos) {
		$condicion = $lCasos['condicion'];
	}
	
	$arreglo = explode(" ", $condicion);
	for ($i=0; $i<count($arreglo); $i++) {
		if (substr($arreglo[$i],0,3) == "C1.") {
			if ($t1) {
				$tablas .= "capitulo_i C1,";
				$llaves .= "C1.C1_nordemp,";
				$tLlaves += 1;
				$t1 = false;
			}
			$var = $arreglo[$i] . ",";
			$variables .= $var;
		}
		if (substr($arreglo[$i],0,3) == "C2.") {
			if ($t2) {
				$tablas .= "capitulo_ii C2,";
				$llaves .= "C2.C2_nordemp,";
				$tLlaves += 1;
				$t2 = false;
			}
			$var = $arreglo[$i] . ",";
			$variables .= $var;
		}
		if (substr($arreglo[$i],0,3) == "C3.") {
			if ($t3) {
				$tablas .= "capitulo_iii C3,";
				$llaves = "C3.C3_nordemp,";
				$tLlaves += 1;
				$t3 = false;
			}
			$var = $arreglo[$i] . ",";
			$variables .= $var;
		}
		if (substr($arreglo[$i],0,3) == "C4.") {
			if ($t4) {
				$tablas .= "capitulo_iv C4,";
				$llaves .= "C4.C4_nordemp,";
				$tLlaves += 1;
				$t4 = false;
			}
			$var = $arreglo[$i] . ",";
			$variables .= $var;
		}
		if (substr($arreglo[$i],0,3) == "C5.") {
			if ($t5) {
				$tablas .= "capitulo_v C5,";
				$llaves .= "C5.C5_nordemp,";
				$tLlaves += 1;
				$t5 = false;
			}
			$var = $arreglo[$i] . ",";
			$variables .= $var;
		}
		if (substr($arreglo[$i],0,3) == "C6.") {
			if ($t6) {
				$tablas .= "capitulo_vi C6,";
				$llaves .= "C6.C6_nordemp,";
				$tLlaves += 1;
				$t6 = false;
			}
			$var = $arreglo[$i] . ",";
			$variables .= $var;
		}
		if (substr($arreglo[$i],0,3) == "ES.") {
			if ($te) {
				$tablas .= "edit_eas ES,";
				$llaves .= "ES.nordemp,";
				$tLlaves += 1;
				$te = false;
				$noVig = true;
			}
			$var = $arreglo[$i] . ",";
			$variables .= $var;
		}
	}
	$tablas = rtrim($tablas, ",");
	$aLlaves = explode(",", $llaves);
	$orden = $aLlaves[0];
	if ($tLlaves > 1) {
		if (substr($arreglo[0],0,3) != "ES.") {
			$compLlaves = $aLlaves[0] . " = ";
			$nomVig = substr($aLlaves[0],0,3) . "vigencia";
		}
		for ($j=1; $j<count($aLlaves); $j++) {
			$compLlaves .= $aLlaves[$j] . " AND ";
		}
		$compLlaves = rtrim($compLlaves, " AND ");
	}
	else {
		$compLlaves = '';
		$nomVig = "vigencia";
	}
	if (substr($condicion,0,2) == "R.") {
		$parentesis = strrpos($condicion, ")");
		$varRes = substr($condicion, 2, $parentesis) . " AS Resulta";
		$variables .= $varRes;
		$condicion = substr($condicion,2);
	}
	$variables = rtrim($variables, ",");
	$varsel = $aLlaves[0] . "," . $variables;
	if ($tLlaves > 1) {
		if ($noVig) {
			$consulta = "SELECT $varsel FROM $tablas WHERE $condicion AND $compLlaves ORDER BY $orden";
		}
		else {
			$consulta = "SELECT $varsel FROM $tablas WHERE $condicion AND $compLlaves AND $nomVig = $periodo ORDER BY $orden";
		}
	}
	else {
		if ($noVig) {
			$consulta = "SELECT $varsel FROM $tablas WHERE $condicion ORDER BY $orden";
		}
		else {
			$consulta = "SELECT $varsel FROM $tablas WHERE $condicion AND $nomVig = $periodo ORDER BY $orden";
		}
	}
	$resulta = $conn->query($consulta);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
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
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
	</head>
	<body>
		<div class="container" style="padding-top: 60px;">
			<div class="col-md-12">
				<span class='text-center'><b><?php echo $lCasos['descripcion']?></b></span>
				<table class='table table-condensed table-hover table-bordered' style='font-size: 13px'>
					<thead>
						<tr>
							<th class="text-center">SEC.</th>
							<th class="text-center"><?php echo $orden ?></th>
							<?php
								$varTit = explode(",", $variables);
								for ($i=0; $i<count($varTit); $i++) {
									if (strpos($varTit[$i], "Resulta")) {
										$varTit[$i] = "Resultado";
									}
									echo "<th class='text-center'>" . $varTit[$i] . "</th>";
								}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
							$orden = substr($orden,3);
							$secuen = 0;
							foreach ($resulta AS $lResulta) {
								$secuen +=1;
								echo "<tr><td>" . $secuen . "</td>";
								echo "<td>" . $lResulta[$orden] . "</td>";
								for ($i=0; $i<count($varTit); $i++) {
									if ($varTit[$i] == "Resultado") {
										$columna = "Resulta";
									}
									else {
										$columna = substr($varTit[$i], 3);
									}
									echo "<td style='text-align: right'>" . number_format($lResulta[$columna],2) . "</td>";
								}
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html> 
