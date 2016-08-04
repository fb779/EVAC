<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$id_usu = $_SESSION['idusu'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$region = $_SESSION['region'];
	$pagina = "ASIGNACI&Oacute;N DE FUENTES";
	$vig = $_SESSION['vigencia'];

	if ($region == 99) {
		$qActividad = $conn->prepare("SELECT a.ciiu3, b.descrip, COUNT( a.ciiu3 ) AS asignar FROM control a, ciiu3 b WHERE a.vigencia =:periodo AND usuario = ''  AND a.ciiu3 = b.codigo GROUP BY a.ciiu3");
		$qActividad->execute(array(':periodo'=>$vig));
	}
	else {
		$qActividad = $conn->prepare("SELECT a.ciiu3, b.descrip, COUNT( a.ciiu3 ) AS asignar FROM control a, ciiu3 b WHERE a.vigencia =:periodo AND usuarioss = ''  AND a.ciiu3 = b.codigo AND a.codsede = :region GROUP BY a.ciiu3");
			$qActividad->execute(array(':periodo'=>$vig, ':region'=>$region));
	}

/*
	CODIGO PARA CASOS
	$input = "I1R1C1 <= I1R2C1";
	$campos = explode(" ", $input);
	echo $campos[0] . "<br>";
	echo strlen($campos[0]) . "<br>";
	echo $campos[1] . "<br>";
	echo strlen($campos[1]) . "<br>";
	echo $campos[2] . "<br>";
	echo strlen($campos[2]) . "<br>";
*/
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
		<title>Encuesta de Desarrollo e Innovación Tecnológica - Formulario Electrónico</title>
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
		<script type="text/javascript" src="../js/asignar.js"></script>
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
			echo '<br><br><br><br>' . $region;
		?>
		<div class="container" style="padding-top:60px">
			<h4 class="text-center" style="font-family: arial"><?php echo $_GET['ident'] . " - " . $_GET['nombre'] ?></h4>
				<?php
					while ($rowActividad = $qActividad->fetch(PDO::FETCH_ASSOC)) {
						echo "<div class='row'>";
						echo "<div class='col-md-8' style='font-size: 12px'>";
						echo "<a href='#' id='l" . $rowActividad['ciiu3'] . "' onClick='detalleActi(this.id, \"" .  $_GET['ident']  . "\")'>" .  $rowActividad['ciiu3'] . " - " . $rowActividad['descrip'] . "<b> [" . $rowActividad['asignar'] . "]</b></a>";
						echo "</div>";
						echo "<div class='col-md-1'>";
						echo "<input type='text' class='form-control text-right' id='n" . $rowActividad['ciiu3'] . "' value='0' />";
						echo "</div>";
						echo "<div class='col-md-3'>";
						echo "<button type='button' class='btn btn-default btn-sm' id='As" . $rowActividad['ciiu3'] . "' onClick='asigftestot(this.id, " . $rowActividad['ciiu3'] . ", \"" . $_GET['ident'] . "\");'>Asignar</button>";
						echo "</div>";
						echo "</div>";
						echo "<div class='col-md-8 col-md-offset-1' style='height: 15%; overflow: auto; display: none' id='det" . $rowActividad['ciiu3']  . "'>";
						echo "</div>";
					}
				?>
		</div>
 	</body>
 </html>