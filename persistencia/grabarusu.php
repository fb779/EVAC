<?php
	if(session_id()  == "") {
		session_start();
	}

	if (!isset($_SESSION['tipou'])) {
		echo "<h2 style='text-align: center; font-family: arial'>SESIÓN HA FINALIZADO. DEBE AUTENTICARSE DE NUEVO</h2>";
		return;
	}

	include '../conecta.php';

	$region = $_SESSION['region'];

	$vig = $_SESSION['vigencia'];

	if (isset($_POST['borrar'])) {
		$usuarioB = $_POST['idBorrar'];
		$qBorrar = $conn->prepare("DELETE FROM usuarios WHERE ident = :idUsuario");
		$qBorrar->execute(array(':idUsuario'=>$usuarioB));

		if (substr($usuarioB,2,2)=='99') {
			$qLimpia = $conn->prepare("UPDATE control SET usuario = '' WHERE usuario = :idUsuario");
		}
		else {
			$qLimpia = $conn->prepare("UPDATE control SET usuarioss = '' WHERE usuarioss = :idUsuario");
		}
		$qLimpia->execute(array(':idUsuario'=>$usuarioB));
		echo "Eliminacion exitosa.";
	}
	else {
		if (isset($_POST['cambio'])) {
			$tipomant = "ccla";
		}
		else {
			if ($_POST['ident'] == "") {
				$tipomant = "adic";
			}
			else {
				$tipomant = "actu";
			}
		}

		if ($tipomant=="adic") {
			$vowels = 'aeuyAEUY';
			$length=8;
			$strength=4;
			$consonants = 'bdghjmnpqrstvzBDGHJLMNPQRSTVWXZ23456789';
			$nombre = "'" . $_POST['nombre'] . "'";
			$nivel = $_POST['tipo'];
			$codreg = $_POST['region'];
			$email = "'" . $_POST['email'] . "'";
		}

		if ($tipomant=="ccla") {
			$claveactual = $_POST['actual'];
			$nuevaclave = $_POST['nueva'];
			$confirma = $_POST['confirma'];
			$idusuario = $_POST['idUsuario'];
		}

		if ($tipomant=="actu") {
			$usuactu="'" . $_POST['ident'] . "'";
			$nombre = "'" . $_POST['nombre'] . "'";
			$nivel = $_POST['tipo'];
			$codreg = $_POST['region'];
			$email = "'" . $_POST['email'] . "'";
		}

		if ($tipomant=="adic") {
			$ultimo = $conn->query("SELECT ident FROM usuarios WHERE tipo = '" . $nivel . "' AND region=" . $codreg . " ORDER BY ident DESC LIMIT 1");
			if($ultimo->rowCount() == 0) {
				$nuevo = 1;
				$nuevaid = $nuevaid = "'" . $nivel . str_pad($codreg, 2, "0", STR_PAD_LEFT) . str_pad($nuevo, 3, "00", STR_PAD_LEFT) . "'";
			}
			else {
				foreach($ultimo AS $ultsec) {
					$base = substr($ultsec['ident'], 4, 3);
					$nuevo = 1 + $base;
					$nuevaid = "'" . $nivel . str_pad($codreg, 2, "0", STR_PAD_LEFT) . str_pad($nuevo, 3, "00", STR_PAD_LEFT) . "'";
				}
			}
			$cero = 0;
			$password = '';
			$alt = time() % 2;
			for ($i = 0; $i < $length; $i++) {
				if ($alt == 1) {
					$password .= $consonants[(rand() % strlen($consonants))];
					$alt = 0;
				} else {
					$password .= $vowels[(rand() % strlen($vowels))];
					$alt = 1;
				}
			}
			$cadenapass = "'" . $password . "'";
			$cadenains = $conn->prepare("INSERT INTO usuarios (ident, nombre, tipo, numemp, clave, fcrea, fexpi, primera, region, ciiu3, email) VALUES (" .
				$nuevaid . ", " . $nombre . ", '" . $nivel . "', " . $cero . ", " . $cadenapass . ", CURDATE(), " . "DATE_ADD(CURDATE(), INTERVAL 1 YEAR), " . $cero . ", " .
				$codreg . ", " . $cero . ", " . $email . ")");
			$cadenains->execute();

			echo "Usuario Creado ";
			echo htmlentities("Identificación: " . $nuevaid . " ");
			echo "Clave: " . $password;
		}

		if ($tipomant=="ccla") {
			$qVerifica = $conn->query("SELECT * FROM usuarios WHERE ident LIKE BINARY '$idusuario'");
			foreach ($qVerifica AS $lVerifica) {
				if ($lVerifica['clave'] === $claveactual) {
					if ($nuevaclave === $confirma) {
						$qCambiar = $conn->query("UPDATE usuarios SET clave = '$nuevaclave' WHERE ident LIKE BINARY '$idusuario'");
						echo "CLAVE ACTUALIZADA";
					}
					else {
						echo "La nueva clave y la confirmación no coinciden";
					}
				}
				else {
					echo "CLAVE ACTUAL INVALIDA";
				}
			}
		}

		if ($tipomant=="actu") {
			$lineactu = $conn->prepare("UPDATE usuarios SET nombre = " . $nombre . ", tipo = '" . $nivel . "', region = " . $codreg . ", email = " . $email . " WHERE ident LIKE BINARY " . $usuactu);
			$lineactu->execute();
			echo "INFORMACIÓN ACTUALIZADA";
		}
	}
?>
