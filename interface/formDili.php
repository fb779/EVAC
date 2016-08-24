<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	include '../conecta.php';
	require_once "../dompdf/dompdf_config.inc.php";
	$region = $_SESSION['region'];
	$vig=$_SESSION['vigencia'];
	$nomPeriodo = $_SESSION['nomPeri'];
	$anterior = $vig-1;
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$qCtl = $conn->query("SELECT fecrev FROM control WHERE vigencia = $vig AND nordemp = $numero");
	foreach ($qCtl AS $rowCtl) {
		$fecha_env = $rowCtl['fecrev'];
	}
	$nombrefor = "Frm" . $numero . "EVAC" . $nomPeriodo . ".pdf";
	ob_start();
?>
<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - Formulario Electr&oacute;nico</title>
			<!-- Bootstrap -->
			<!-- <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="../bootstrap/css/custom.css" rel="stylesheet">
			<script type="text/javascript" src="../js/html5shiv.js"></script>
			<script type="text/javascript" src="../js/respond.js"></script>
			<script type="text/javascript" src="../js/css3-mediaqueries.js"></script> -->
			<style>
				body {
					font-family: (arial);
					font-size: 14x;
				}
				fieldset {
					-moz-box-sizing: border-box;
					-webkit-box-sizing: border-box;
					box-sizing: border-box;
					margin: auto;
					margin-bottom: 10px;
					padding: 5px 10px;
					width: 100%;
				}

				fieldset div {
					margin: auto;
					margin-bottom: 5px;
				}

				table {
					-moz-box-sizing: border-box;
					-webkit-box-sizing: border-box;
					box-sizing: border-box;
					font-size: 12px;
					margin: auto;
					margin-top: 20px;
					margin-bottom: 20px;
					/*width: 80%;*/
					text-align: center;
				}
				table td {
					padding: 5px;
				}

				input {
					-webkit-border-radius: 3px;
					-moz-border-radius: 3px;
					border-radius: 3px;
					font-size: 12px;
					padding: 5px;
					text-align: center;
					width: 100%;
				}

				table#medios td {
					text-align: left;

				}
				.nvapag {
					page-break-after: always;
				}
				#header {
					position: fixed;
					left: 10px; top: -45px;
					right: 0px;
					height: 40px;
					font-family: arial;
					font-size: 10px;
					border-bottom: solid; 0.5px; #000;
					margin-bottom: 10px;
				}
				#footer {
					position: fixed;
					left: 0px;
					bottom: -150px;
					right: 0px;
					height: 150px;
					font-family: arial;
					font-size: 10px;
					border-top: solid; 0.5px; #000;
				}
				.numeral {
					font-family: arial;
					font-size: 10px;
				}
			</style>
		</head>
		<body>
			<div id="header">
				Departamento Administrativo Nacional de Estad&iacute;stica - DANE<br>
				Encuesta de Disponibilidad Laboral - EVAC - <?php echo $nomPeriodo; ?><br>
	 			<?php echo $numero . "-" . $nombre; ?>
	 		</div>
			<?php
				include 'capi1PDF.php';
				// include 'capi1PDF_BT.php'
			?>
	 		<div id="footer">
	 			<?php echo "Fecha de Env&iacute;o: " . $fecha_env; ?>
	 		</div>
		</body>
	</html>
 <?php
	$html = ob_get_clean();
	$dompdf = new DOMPDF();
	// $dompdf->set_base_path('evac/bootstrap/css/');
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream($nombrefor);
?>
