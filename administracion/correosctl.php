<?php
	include '../conecta.php';
	
	date_default_timezone_set('America/Bogota');
	
	$autoriza = 1; $creado = 0;
	
	$documento = $_GET['b04f60'];
	$dv = $_GET['5f458dc406e8'];
	$numero = $_GET['b0a6a243b5fe'];
	//$vig = $_SESSION['vigencia'];
	$vig = 2015;

	$qNnombre = $conn->query("SELECT nombre, numdoc, dv, emailnotif FROM caratula WHERE nordemp = " . $numero);
	foreach($qNnombre AS $lnombre) {
		$a=1;
	}
	
	$qControl = $conn->query("SELECT estado FROM control WHERE nordemp = $numero AND vigencia = $vig");
	foreach($qControl AS $lControl) {
		$estado_comp=$lControl['estado'];
	}
	

	if ($lnombre['numdoc'] != $documento OR $lnombre['dv'] != $dv) {
		$autoriza = 2;
	}
	else {
		$busu = $conn->query("SELECT ident, clave FROM usuarios WHERE tipo = 'FU' AND numemp = " . $numero);
		if ($busu) {
			$creado = 1;
			foreach($busu AS $lusuario) {
				$id_usuario = $lusuario['ident'];
				$pwd = $lusuario['clave'];
			}
		}
	}
	if ($autoriza == 1 AND $creado == 0) {
		$vowels = 'aeuyAEUY';
		$length=8;
		$strength=4;
		$consonants = 'bdghjmnpqrstvzBDGHJLMNPQRSTVWXZ23456789';
		$cero = 0;
		
		$id_usuario = "F" . $numero;
		$verificar = $conn->query("SELECT * FROM usuarios WHERE ident = '" . $id_usuario . "'");
		if ($verificar) {
			$lverif = $verificar;
		}
		else {
			$pwd = '';
			$alt = time() % 2;
			for ($i = 0; $i < $length; $i++) {
				if ($alt == 1) {
					$pwd .= $consonants[(rand() % strlen($consonants))];
					$alt = 0;
				} else {
					$pwd .= $vowels[(rand() % strlen($vowels))];
					$alt = 1;
				}
			}
			$cadenapass = "'" . $pwd . "'";
			$nombre = '"' . $lnombre['nombre'] . '"';
			$nivel = "FU";
			$email = "'" . $lnombre['emailnotif'] . "'";
			
			$cadenains = $conn->prepare("INSERT INTO usuarios (ident, nombre, tipo, numemp, clave, fcrea, fexpi, primera, region, ciiu3, email) VALUES ('" .
				$id_usuario . "', " . $nombre . ", '" . $nivel . "', " . $numero . ", " . $cadenapass . ", CURDATE(), " . "DATE_ADD(CURDATE(), INTERVAL 1 YEAR), " . $cero . ", " .
				$cero . ", " . $cero . ", " . $email . ")");
			$cadenains->execute();
			
			//ACTUALIZA CARATULA Y CONTROL
			$actualiza = $conn->prepare("UPDATE caratula SET vericorr = 1 WHERE nordemp = " . $numero);
			$actualiza->execute();
			//ACTUALIZAR CONTROL A DISTRIBUIDO
			$actuctl = $conn->prepare("UPDATE control SET estado = 1, fecdist = CURDATE() WHERE periodo = " . $vig .  " AND nordemp = " . $numero);
			$actuctl->execute();
		}
	}
	//ACTUALIZA CARATULA Y CONTROL
	$actualiza = $conn->prepare("UPDATE caratula SET vericorr = 1 WHERE nordemp = " . $numero);
	$actualiza->execute();
	//ACTUALIZAR CONTROL A DISTRIBUIDO
	if ($estado_comp == 0) {
		$actuctl = $conn->prepare("UPDATE control SET estado = 1, fecdist = CURDATE() WHERE vigencia = " . $vig .  " AND nordemp = " . $numero);
		$actuctl->execute();
	}
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
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
	</head>
	<body>
		<div class="container">
			<div class="col-md-8 col-md-offset-2">
				<?php
					if ($autoriza == 1) {
						echo "<table>";
						echo "<tr><td colspan='2'><img src='../images/banner_top.png' width='800' height='100' /></td></tr>";
						echo "<tr><td colspan='2' style='text-align: center; font-family: arial; font-size: 15px; font-weight: bold'>DANE - ENCUESTA DE DESARROLLO E INNOVACIÓN TECNOLÓGICA - CREACIÓN DE USUARIOS<br />" . $lnombre['nombre'] . "</td></tr>";
						echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
						echo "<tr><td style='text-align: center; background-color: #FFFF00'>USUARIO: <b>" . $id_usuario . "</b></td><td style='text-align: center; background-color: #FFFF00;'>CLAVE: <b>" . $pwd . "</b></td></tr>";
						echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
						echo "<tr><td colspan='2' style='text-align: justify; font-family: arial; font-size: 15px; padding: 10px;'><p><b>Señor Empresario</b></p>
						<p>Al ingresar al formulario electrónico de la EDIT por favor cambie y guarde la clave <i>(Esquina superior derecha del Formulario)</i></p>
						<p>Recuerde que tiene un plazo de 10 días calendario para el reporte de la información, contados a partir del recibo de esta notificación.</p>
						<p>En caso de ser necesario ingresando nuevamente al correo recibido,  y activando el link <b>GENERAR SU USUARIO Y CONTRASEÑA</b>, podrá recuperar su usuario
						y contraseña.</p>
						<p>Para resolver  cualquier inquietud  por favor  comuníquese  a los números telefónicos  registrados  en el correo de notificación, allí le atenderá el responsable de la investigación en cada ciudad.</p></td></tr>";
						echo "</table>";
					}
					else {
						if ($autoriza == 2) {
							echo "<span style ='width: 100%; border: solid 1px #FF0000; color: #FF0000'>INGRESO NO AUTORIZADO</span>";
						}
					}
				?>
			</div>
		</div>
	</body>
</html>
