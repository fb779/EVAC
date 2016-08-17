<?php
	if (session_id() == "") {
		session_start();

	}
	include 'conecta.php';
	ini_set('default_charset', 'UTF-8');
	if (isset($_POST['btnIngresar'])) {
// 		$qVigencia = $conn->query("SELECT vigencia FROM control LIMIT 1");
// 		foreach($qVigencia AS $lVigencia) {
// 			$vigencia = $lVigencia['vigencia'];
// 		}

		// $qPeriodoac = $conn->query("SELECT id, codPeriodo, anioperiodo, nomperiodo FROM periodoactivo where estperiodo = 'ac';")->fetch(PDO::FETCH_ASSOC);
		$qPeriodoac = $conn->query("SELECT id, codPeriodo, anioperiodo, nomperiodo FROM periodoactivo where estperiodo = 'ac';");
		if ($qPeriodoac->rowCount() > 0 ){
			$qPeriodoac = $qPeriodoac->fetch(PDO::FETCH_ASSOC);
			$vigActiva = $qPeriodoac['id'];
			$namVigAct = $qPeriodoac['nomperiodo'];
		} else{
			$vigActiva = 0;
			$namVigAct = '';
		}

		$qUsuario = $conn->prepare('SELECT * FROM usuarios WHERE ident LIKE BINARY :idUsu AND clave LIKE BINARY :pwdUsu');
		$qUsuario->execute(array('idUsu' => $_POST['inputLogin'], 'pwdUsu' => $_POST['inputPassword']));

		$rUsuario = $qUsuario->fetchAll();
		if (count($rUsuario)) {
			foreach ($rUsuario as $row) {
				$_SESSION['nombreu'] = $row['nombre'];
				$_SESSION['tipou'] = $row['tipo'];
				$_SESSION['idusu'] = $row['ident'];
				$_SESSION['numero'] = $row['numemp'];
				$_SESSION['region'] = $row['region'];
				//$_SESSION['vigencia'] = $vigencia;
				$_SESSION['vigencia'] = $vigActiva;
				$_SESSION['nomPeri'] = $namVigAct;
				$_SESSION['periodoAct'] = $vigActiva;
				$_SESSION['nomPeriAct'] = $namVigAct;
				$_SESSION['titulo'] = 'DANE EVAC - ';
			}

			if ($row['tipo'] == 'FU') {
				header("location: interface/caratula.php");
			}
			else {
				header("location: administracion/operativo.php");
			}
		}
		else {
			$mensaje = "Usuario y/o Contraseña Errónea";
		}
	} else {
		session_unset();
		session_destroy();
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
	    <!-- Google fonts open Sans	 -->
		<!-- link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700|Roboto+Slab' rel='stylesheet' type='text/css'-->
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>DANE EVAC - Encuesta de Disponibilidad Laboral</title>
		<link href="bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/custom.css" rel="stylesheet">
		<link href="bootstrap/css/sticky-footer.css" rel="stylesheet">
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/notSubmit.js"></script>
        <script src="js/prueba.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container-fluid navbar navbar-default navbar-fixed-top">
			<div class="topview1 row">
				<div class="col-sm-4 col-md-4 hidden-xs col-md-offset-1" id="dane-logo">
					<img src="bootstrap/img/logo_dane.png" class="img-responsive" alt="Logo Dane">
				</div>
                <div class="col-sm-3 col-md-3 hidden-xs">
					<h4 style="margin-top:40px"><center><br>DANE</center></h4>
                </div>
				<div class="col-xs-12 visible-xs" id="dane-logo">
					<img src="bootstrap/img/logo_dane_mobile.png" class="img-responsive" alt="Logo Dane">
				</div>
				<div class="col-sm-1 col-md-3">
					<div class="clearfix"></div>

					<div class="hidden-xs hidden-sm" id="redes">
						<div class="col-md-11">
							<a href="http://www.youtube.com/DaneColombia" target="_blank"><div id="icon-net" class="yt"></div></a>
							<a href="https://www.facebook.com/DANEColombia" target="_blank"><div id="icon-net" class="fb"></div></a>
							<a href="https://twitter.com/DANE_Colombia" target="_blank"><div id="icon-net" class="tw"></div></a>
							<a href="https://mail.dane.gov.co/" target="_blank"><div id="icon-net" class="ml"></div></a>
						</div>
					</div>
				</div>
		  	</div>
			<!-- Menu fijo -->
			<nav class="topview2 hidden container navbar navbar-default navbar-fixed-top">
				<div class="row container-fluid">
					<div class="navbar-header col-xs-2 col-md-1">
						<a class="navbar-brand" href="#">
							<img src="bootstrap/img/dane_icon.png">
						</a>
					</div>
					<div class="row col-xs-11 col-sm-9 col-md-11" id="bar">
						<div class="row hidden hidden-xs col-sm-12 col-md-4 pull-right" id="fecha">
							<div class="row col-sm-10 col-md-10">
								<small>Viernes, 20 de marzo de 2.015</small>
							</div>
							<div class="row col-sm-3 col-md-3 pull-right" id="idioma">
								<small><a class="btn-link" href="#">English</a></small>
							</div>
						</div>
						<div class="row hidden-xs col-md-3 pull-left" id="redes">
							<div class="">
								<div id="icon-net" class="yt"></div>
								<div id="icon-net" class="fb"></div>
								<div id="icon-net" class="tw"></div>
								<div id="icon-net" class="ml"></div>
							</div>
						</div>
						<div class="row hidden col-sm-8 col-md-4" id="search">
							<div class="input-group" id="busqueda">
							  <input type="text" class="form-control">
							  <span class="input-group-addon glyphicon glyphicon-search" aria-hidden="true"></span>
							</div>
						</div>
					</div>
				</div>
			</nav>
			<!-- Fin menu fijo -->
		  	<div class="row" id="colorbar">
				<div class="row col-md-offset-4 col-md-5 hidden-xs" id="color_container">
					<div id="color1"></div>
					<div id="color2"></div>
					<div id="color3"></div>
					<div id="color4"></div>
					<div id="color5"></div>
					<div id="color6"></div>
				</div>
		  	</div>

			<div class="clearfix"></div>
		</div>
		<div class="container">
		<?php
			include 'login.php';
		?>
		</div>
		<footer class="footer">
		 <div class="container">
			<div>
				<h5 class="text-center">Departamento Administrativo Nacional de Estad&iacute;stica - DANE &copy; 2015 v2</h5>
			</div>
			<div class="col-sm-4 col-md-5">
				<div>
					<div>
						<div class="row col-md-3" id="contact_icon">
							<img class="img-responsive" src="bootstrap/img/bt_contactenos.png">
						</div>
						<div class="col-md-9">

						<?php
						//var_dump($_SESSION);

						?>

							<h6>Call Center</h6>
							(57 1) 595 3525 • 01 8000 952525<br>
							Conmutador: (571) 597 8300<br>
							Fax: (571) 597 8399<br>
							L&iacute;nea gratuita de atenci&oacute;n:<br>
							01 8000 912002<br>
							ó (571) 597 8300 Exts. 2532 - 2605<br>
							<ul class="hidden list-inline">
								<li>
									<a href="#"><img src="bootstrap/img/arrow_003.png'; ?>"> Chat</a>
								</li>
								<li>
								<a href="#"><img src="bootstrap/img/arrow_003.png'; ?>"> PQR  </a>
								</li>
							</ul>
						</div>
						<div class="clearfix">
						</div>
					</div>
      			</div>
			</div>
			<div class="col-sm-4 col-md-7" id="footer_alterno">
				<div class="col-md-6">
					<address>
						<h6>Horario de atenci&oacute;n</h6>
						Lunes a viernes 8:00 a 17:00<br>
						<br>
						Carrera 59 No. 26-70 Interior I - CAN
						<br>
						C&oacute;digo postal 111321
						<br>
						Apartado A&eacute;reo 80043
						<br>
						Bogot&aacute; D.C., Colombia - Suram&eacute;rica
					</address>
				</div>
				<div class="col-md-6">
					<div id="geoportal_map">
						<a href="http://www.dane.gov.co/geoportal">
							<img class="img-responsive" src="bootstrap/img/geoportal_map.png">
						</a>
					</div>
					<ul class="list-inline">
						<li>
							<a href="http://www.dane.gov.co/geoportal/web/guest/sedes-dane" target="_blank"><img src="bootstrap/img/arrow_003.png"> Sedes y subsedes Dane</a>
						</li>
					</ul>
				</div>
			</div>
      </div>
    </footer>

	</body>
</html>
