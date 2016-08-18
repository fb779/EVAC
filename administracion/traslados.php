<?php
	if(session_id() == "") {
		session_start();
	}
	$mensaje = "";
	if (!isset($_SESSION['tipou'])) {
		echo "<h2 style='text-align: center; font-family: arial'>SESI&Oacute;N HA FINALIZADO. DEBE AUTENTICARSE DE NUEVO</h2>";
		return;
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$nombre = $_SESSION['nombreu'];
	$numero = $_GET['numero'];
	$regOpe = $_SESSION['region'];
	$pagina = "TRASLADO DE SEDE";

	$qCaratula = $conn->prepare("SELECT a.nordemp, a.regional, a.nombre, b.nombre AS nomsede FROM caratula a, regionales b WHERE a.nordemp= :idNumero AND a.regional = b.codis");
	$qCaratula->execute(array(':idNumero'=>$numero));
	$row = $qCaratula->fetch(PDO::FETCH_ASSOC);
	$codSede = $row['regional'];

	$qSedes = $conn->query("SELECT codis, nombre FROM regionales WHERE codis != $codSede");

	$qNregion = $conn->prepare("SELECT nombre FROM regionales WHERE codis = :nRegion");
	$qNregion->execute(array(':nRegion'=>$regOpe));
	$rowRegion = $qNregion->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title> <?php echo $_SESSION['titulo'] . 'Traslados'; ?> </title>
		<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../bootstrap/css/custom.css" rel="stylesheet">
		<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">
		<link href="../bootstrap/css/bootstrap-dialog.css" rel="stylesheet">
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<script type="text/javascript" src="../js/bootstrap-dialog.min.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<script type="text/javascript">
			$(document).ready(function() {
				if ($('#listareg').val() == 0){
					var $btn = $('#btEnvio');
					$btn.addClass('disabled');
				}
				$('#listareg').on('change', function(){
					var $item = $(this);
					var $btn = $('#btEnvio');
					if ( $item.val() == 0 ){
						$btn.addClass('disabled');
					} else {
						$btn.removeClass('disabled');
					}
				});
				/* Funcion de envio del formulario*/
				$("#traslado").submit(function(event) {
					event.preventDefault();
					$.ajax({
						url: "../persistencia/opFormulario.php",
						type: "POST",
						data: {accion: "traslado", numero: $("#numero").val(), sede: $("#listareg").val()},
						success: function(dato) {
							alert(dato);
							location.reload();
						}
					});
				});
			});

		</script>
	</head>
	<body>
		<?php
			include 'menuRet.php';
		?>
			<div class="container" style="padding-top: 80px">
				<form role='form' id="traslado">
					<input type="hidden" name="numero" id="numero" value="<?php echo $numero ?>" />
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="panel-title">Traslado de fuente: <?php echo "<b>" . $row['nordemp'] . " - " . $row['nombre'] . "</b>"?></span class="panel-title">
						</div>
						<div class="panel-body">
							<div class="row small">
								<div class="col-xs-12">
									<span for="">
										Sede actual: <?php echo "<b> " . $row['nomsede'] . "</b>"?>
									</span>
								</div>

								<div class='col-xs-12 text-center '>
									<label class='control-label' for='listareg'>Trasladar a:</label>
								</div>

								<div class='col-sm-12'>
									<select class='form-control' id='listareg' name = 'sede'>
										<option value='0'>Seleccione una sede...</option>";
										<?php
											foreach($qSedes AS $lSedes) {
												echo "<option value='" . $lSedes['codis'] . "'>" . $lSedes['nombre'] . "</option>";
											}
										?>
									</select>
								</div>
							</div>
						</div>

						<div class="panel-footer">
							<div class="row ">
								<div class="col-xs-2 col-xs-offset-5">
									<button id="btEnvio" type='submit' class='btn btn-primary btn-md'>Confirma Traslado</button>
								</div>
							</div>

						</div>
					</div>
				</form>
			</div>
 	</body>
 </html>
