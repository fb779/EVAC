<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	include '../conecta.php';
	require_once "../dompdf/dompdf_config.inc.php";
	$region = $_SESSION['region'];
	$vig=$_SESSION['vigencia'];
	$anterior = $vig-1;
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$qCtl = $conn->query("SELECT fecrev FROM control WHERE vigencia = $vig AND nordemp = $numero");
	foreach ($qCtl AS $rowCtl) {
		$fecha_env = $rowCtl['fecrev'];
	}
	$nombrefor = "Frm" . $numero . "EDIT" . $vig . ".pdf";
	$gradoI = array("1"=>"ALTO", "2"=>"MEDIO", "3"=>"BAJO", ""=>'N/A', "0"=>"N/A");
	$c3n5 = array("1"=>"Obtuvo beneficios tributarios", "2"=>"Solicit&oacute; beneficios tributarios, pero no los obtuvo", "3"=>"Tuvo la intenci&oacute;n de solicitar beneficios tributarios, pero no lo hizo", "4"=>"No quiso solicitar beneficios tributarios", "0"=>"N/A", ""=>"N/A");
	ob_start();
?>
<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - Formulario Electr&oacute;nico</title>
			<!-- Bootstrap -->
			<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="../bootstrap/css/custom.css" rel="stylesheet">
			<script type="text/javascript" src="../js/html5shiv.js"></script>
			<script type="text/javascript" src="../js/respond.js"></script>
			<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
			<style>
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
				Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - EDIT - <?php echo $anterior . " - " . $vig ?><br>
	 			<?php echo $numero . "-" . $nombre?>
	 		</div>
	 		<div id="footer">
	 			<?php echo "Fecha de Env&iacute;o: " . $fecha_env; ?>
	 		</div>
			<?php
				include 'capi1PDF.php';
				include 'capi2PDF.php';
				include 'capi3PDF.php';
				include 'capi4PDF.php';
				include 'capi5PDF.php';
				include 'capi6PDF.php';
			?>
		</body>
	</html>
<?php
	$html = ob_get_clean();
	$dompdf = new DOMPDF();
	$dompdf->set_base_path('editsv/bootstrap/css/');
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream($nombrefor);
?>
