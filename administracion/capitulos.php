<?php
	 if (session_id() == "") {
		session_start();
	 }

	$region = $_SESSION['region'];
	$nombre = $_SESSION['nombreu'];
	$pagina = "DESCARGA DE ARCHIVOS";
	$vig = $_SESSION['vigencia'];

	include '../conecta.php';

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
		<title> <?php echo $_SESSION['titulo'] . 'Descargas de archivos'; ?> </title>
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
	<body>
		<div class='container' style='padding-top: 80px'>
			<div class="col-md-8 col-md-offset-2">
				<table class='table table-condensed table-hover table-bordered'>
					<thead>
						<tr>
							<th class="text-center">TABLA</th>
						</tr>
					</thead>
					<tbody>
						<tr><td><a href='xlscapdire.php'>DIRECTORIO DE EMPRESAS</a></td></tr>
						<tr><td><a href='xlscap1.php'>MODULO I</a></td></tr>
						<!-- <tr><td><a href='xlscap2.php'>CAPITULO II</a></td></tr>
						<tr><td><a href='xlscap3.php'>CAPITULO III</a></td></tr>
						<tr><td><a href='xlscap4.php'>CAPITULO IV</a></td></tr>
						<tr><td><a href='xlscap5.php'>CAPITULO V</a></td></tr>
						<tr><td><a href='xlscap6.php'>CAPITULO VI</a></td></tr>
						<tr><td><a href='xlscap7.php'>EVALUACION</a></td></tr> -->
						<tr><td><a href='xlsObser.php'>OBSERVACIONES CR&Iacute;TICO</a></td></tr>
						<tr><td><a href='xlsactiv.php'>LISTADO DE ACTIVIDADES</a></td></tr>
						<tr><td><a href='xlscontrol.php'>TABLA DE CONTROL</a></td></tr>
					</tbody>
				</table>
			</div>
		</div>
 	</body>
 </html>
