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
	
	$qUsuarios = $conn->query("SELECT ident, nombre FROM usuarios WHERE region = $regOpe AND tipo = 'CR' ORDER BY ident");
	
	$qNregion = $conn->prepare("SELECT nombre FROM regionales WHERE codis = :nRegion");
	$qNregion->execute(array(':nRegion'=>$region));
	$rowRegion = $qNregion->fetch(PDO::FETCH_ASSOC);
	
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
		<?php echo "<table>";
		echo "<thead><tr>";
		echo "<th>Usuario</th>";
		echo "<th>Nombre</th>";
		echo "<th>Sin Dist.</th>";
		echo "<th>Distrib.</th>";
		echo "<th>Pend.</th>";
		echo "<th>En Dig.</th>";
		echo "<th>Digit.</th>";
		echo "<th>Revisi&oacute;n</th>";
		echo "<th>Eviados DC.</th>";
		echo "<th>Aceptados</th>";
		echo "<th>Nove.</th>";
		echo "<th>TOTAL</th></tr></thead>";
		echo "<tbody>";
		foreach($qUsuarios as $lUsuarios) {
			$usurep = $lUsuarios['ident'];
			$control = "SELECT IFNULL(estado, 'TOTAL') AS estado, COUNT( estado ) AS grpestado FROM `control` WHERE $campoUsu = '$usurep'
				AND vigencia = $vig AND novedad NOT IN $novedades GROUP BY estado WITH ROLLUP";
			
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
				echo "<td>0</td>";
			}
			else {
				echo "<td>" . $valor1 . "</td>";
			}
			if ($distri == 0) {
				echo "<td >0</td>";
			}
			else {
				echo "<td>" . $distri . "</td>";
			}
			if ($valor2 == 0) {
				echo "<td >0</td>";
			}
			else {
				echo "<td>" . $valor2 . "</td>";
			}
			if ($valor3 == 0) {
				echo "<td >0</td>";
			}
			else {
				echo "<td>" . $valor3 . "</td>";
			}
			if ($valor4 == 0) {
				echo "<td >0</td>";
			}
			else {
				echo "<td>" . $valor4 . "</td>";
			}
			if ($valor5 == 0) {
				echo "<td >0</td>";
			}
			else {
				echo "<td>" . $valor5 . "</td>";
			}
			if ($valor6 == 0) {
				echo "<td >0</td>";
			}
			else {
				echo "<td>" . $valor6 . "</td>";
			}
			if ($valor7 == 0) {
				echo "<td >0</td>";
			}
			else {
				echo "<td>" . $valor7 . "</td>";
			}
			if ($valnov == 0) {
				echo "<td >0</td>";
			}
			else {
				echo "<td>" . $valnov . "</td>";
			}
			$totalusu = $valor8+$valnov;
			echo "<td>" . $totalusu . "</td>";
			$totalG = $totalG + $totalusu;
			echo "</tr>";
			$totalusu =0;
		}
		echo "<tr>";
		echo "<td colspan='11'><b>TOTAL</b></td>";
		echo "<td>" . $totalG . "</td>";
		echo "</tr>";
		echo "</tbody>";
		echo "</table>"; ?>
 	</body>
</html> 
