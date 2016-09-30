<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	include '../conecta.php';
	$id_usu = $_SESSION['idusu'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$pagina = "LISTA - ";

	if (isset($_GET['sede'])) {
		$id_region = $_GET['sede'];
	} else {
		$id_region = $_SESSION['region'];
	}

	if (!isset($_GET['noved']) AND !isset($_GET['estado']) AND !isset($_GET['bNom'])) {
		$pagina .= " TOTAL A RECOLECTAR";
	}

	if (isset($_GET['noved'])) {
		switch ($_GET['noved']) {
			case "No9":
				$pagina .= " Directorio Base";
				break;
			case 9:
				$pagina .= " Nuevos";
				break;
			case "novedad":
				$pagina .= " Pendientes";
				break;
			case "todo":
				$pagina .= " Novedades";
				break;
		}
	}

	if (isset($_GET['estado'])) {
		switch ($_GET['estado']) {
			case "0":
				$pagina .= " Sin Distribuir";
				break;
			case ">0":
				$pagina .= " Distribuidos";
				break;
			case 2:
				$pagina .= " En Digitaci&oacute;n";
				break;
			case 3:
				$pagina .= " Digitados";
				break;
			case 4:
				$pagina .= " An&aacute;lisis Verificaci&oacute;n";
				break;
			case 5:
				$pagina .= " Verificados";
				break;
			case 6:
				$pagina .= " Aceptados";
				break;
		}
	}

	$vig=$_SESSION['vigencia'];
	$anterior = $vig - 1;
	$nuevas=9;
	$deuda = 5;
	$novedades = "(1,2,3,4,6,10,12,13,97,41,19)";
	$rinden = "(99,5)";

	$sind = 0;
	$dist = 1;
	$digi = 2;
	$digit = 3;
	$crit = 4;
	$verif = 5;
	$acepta = 6;
	$porce = false;
	$valorBase = 0;

	$campoUsu = ($_SESSION['region'] == 99 ? "usuario" : "usuarioss");

	$condiN = ""; $condiP = ""; $condiE = "";
	if (!isset($_GET['bNom'])) {
		if (isset($_GET['noved'])) {
			if($_GET['noved'] == "todo") {
				// $condiN .= " AND a.novedad IN (1,2,3,4,6,10,12,13,97,41,19)";
				$condiN .= " AND a.novedad IN $novedades";
			}
//			if ($_GET['noved'] == 5) {
//				$condiN .= " AND a.novedad = 5";
//			}
			if ($_GET['noved'] == "novedad") {
				$condiN .= " AND a.novedad NOT IN $novedades AND (a.estado = 1 OR a.estado = 0)";
			}
			if ($_GET['noved'] == 9) {
				$condiN .= " AND a.novedad = 9";
			}
			if ($_GET['noved'] == "No9") {
				$condiN .= " AND a.novedad != 9";
			}
		}
		if (isset($_GET['prio'])) {
			if ($_GET['prio'] != "total") {
				$condiP = " AND prio2 = " . $_GET['prio'];
			}
		}
		if (isset($_GET['estado'])) {
			if ($_GET['estado'] != ">0") {
				$condiE = " AND estado = " . $_GET['estado'];
			}
			else {
				$condiE = " AND estado " . $_GET['estado'];
			}
		}
	}

	$lineas = array("Directorio Base"=>1,
		 "Nuevos"=>2,
		 "Total a Recolectar"=>3,
		 "Sin Distribuir"=>4,
		 "Distribuidos"=>5,
		 "En Deuda"=>6,
		 "En Digitación"=>7,
		 "Digitados"=>8,
		 "Análisis Verificación"=>9,
		 "Verificados"=>10,
		 "Aceptados"=>11,
		 "Novedades"=>12);

	$qNregion = $conn->prepare("SELECT nombre FROM regionales WHERE codis = :nRegion");
	$qNregion->execute(array(':nRegion'=>$id_region));
	$rowRegion = $qNregion->fetch(PDO::FETCH_ASSOC);

	if ($tipousu == "CO" OR $tipousu == "TE" OR $tipousu == "AT") {
		$query = "SELECT a.nordemp, b.nombre, c.desc_novedad, d.nombre AS sede FROM control a, caratula b, novedades c, regionales d WHERE a.vigencia = :periodo
			AND a.novedad = c.idnovedades AND a.codsede = d.codis";
		if ($id_region != 99) {
			$query .= " AND a.codsede = :region";
		}
		if (isset($_GET['bNom'])) {
			$query .= " AND b.nombre LIKE '%" . $_GET['texto'] . "%'";
		}
		else {
			if ($condiN != "") {
				$query .= $condiN;
			}
			if ($condiP != "") {
				$query .= $condiP;
			}
			if ($condiE != "") {
				$query .= $condiE;
			}
		}
		$query .= " AND a.nordemp = b.nordemp order by a.nordemp";
		$lista = $conn->prepare($query);
		if ($id_region != 99) {
			$lista->execute(array(':periodo'=>$vig, ':region'=>$id_region));
		}
		else {
			$lista->execute(array(':periodo'=>$vig));
		}
	}

	if ($tipousu == "CR") {
		$query = "SELECT a.nordemp, b.nombre, c.desc_novedad, d.nombre AS sede FROM control a, caratula b, novedades c, regionales d WHERE vigencia = :periodo AND $campoUsu = :idUsuario
			AND a.novedad = c.idnovedades AND a.codsede = d.codis";
		if ($id_region != 99) {
			$query .= " AND codsede = :region";
		}
		if (isset($_GET['bNom'])) {
			$query .= " AND b.nombre LIKE '%" . $_GET['texto'] . "%'";
		}
		else {
			if ($condiN != "") {
				$query .= $condiN;
			}
			if ($condiP != "") {
				$query .= $condiP;
			}
			if ($condiE != "") {
				$query .= $condiE;
			}
		}
		$query .= " AND a.nordemp = b.nordemp order by a.nordemp";
		$lista = $conn->prepare($query);
		if ($id_region != 99) {
			$lista->execute(array(':periodo'=>$vig, ':idUsuario'=>$id_usu, ':region'=>$id_region));
		}
		else {
			$lista->execute(array(':periodo'=>$vig, ':idUsuario'=>$id_usu));
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title> <?php echo $_SESSION['titulo'] . 'Directorio base'; ?> </title>
		<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../bootstrap/css/custom.css" rel="stylesheet">
		<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
	</head>
	<body>
		<?php
			include 'menuRet.php';
		?>
		<br><br><br>
			<div class="container">
				<div class="col-md-10 col-md-offset-1">
					<table class='table table-condensed table-hover table-bordered'>
						<thead>
							<tr>
								<th class="text-center">Sec.</th>
								<th class="text-right">Numero</th>
								<th class="text-center">Nombre</th>
								<th class="text-center">Novedad</th>
								<th class="text-center">Sede</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sec = 1;
								while ($row = $lista->fetch(PDO::FETCH_ASSOC)) {
									echo "<tr><td style='text-align: right'>" . $sec . "</td>";
									echo "<td style='text-align: right'>" . $row['nordemp'] . "</td>";
									echo "<td><a href='../interface/caratula.php?numero=" . $row['nordemp'] . "'>" . $row['nombre'] . "</td>";
									echo "<td>" . $row['desc_novedad'] . "</td>";
									echo "<td>" . $row['sede'] . "</td></tr>";
									$sec +=1;
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
 	</body>
 </html>

