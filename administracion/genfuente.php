<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$vowels = 'aeuyAEUY';
	$length=8;
	$strength=4;
	$consonants = 'bdghjmnpqrstvzBDGHJLMNPQRSTVWXZ23456789';
	$cero = 0;
	$cuenta = 0;
	$qCaratula = $conn->query("SELECT nordemp, nombre, emailnotif FROM caratula");
	foreach ($qCaratula AS $lNumero) {
		$numero = $lNumero['nordemp'];
		$nombre = $lNumero['nombre'];
		$id_usuario = "F" . $numero;
		$qUsuario = $conn->query("SELECT * FROM usuarios WHERE ident = '$id_usuario'");
		if ($qUsuario->rowCount() == 0) {
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
			$cadenapass = $pwd;
			$nombreFte = "'" . $nombre . "'";
			$nivel = "FU";
			$email = "'" . $lNumero['emailnotif'] . "'";

			$cadenains = $conn->prepare("INSERT INTO usuarios (ident, nombre, tipo, numemp, clave, fcrea, fexpi, primera, region, ciiu3, email)
				VALUES (:idUsu, :nombre, :nivel, :numFte, :passw, 'CURDATE()', 'DATE_ADD(CURDATE(), INTERVAL 1 YEAR)', '0','0','0', :email)");
			$cadenains->execute(array(':idUsu'=>$id_usuario,
				':nombre'=>$nombre,
				':nivel'=>$nivel,
				':numFte'=>$numero,
				':passw'=>$cadenapass,
				':email'=>$email));
			$cuenta++;
		}
	}
	echo "CLAVES GENERADAS: " . $cuenta;
?>