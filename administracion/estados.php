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
	$pagina = "CAMBIO DE ESTADO";

	$qCtl = $conn->query("SELECT a.nordemp, b.nombre, c.desc_estado FROM control a, caratula b, estados c WHERE a.nordemp = $numero AND
		a.nordemp = b.nordemp AND a.estado = c.idestados");
	foreach ($qCtl AS $lCtl) {
		$a=1;
	}

	$qEstados = $conn->query("SELECT * FROM estados ORDER BY idestados");

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
		<title> <?php echo $_SESSION['titulo'] . 'Cambio de estado'; ?> </title>
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
		<style type="text/css"> p {font-size: 13px !important;}
		body { padding-top: 60px; }
		</style>
		<script type="text/javascript">
			$(document).ready(function() {

				if ($('#listaestados').val() == 0){
					var $btn = $('#idcambio');
					$btn.addClass('disabled');
				}
				$('#listaestados').on('change', function(){
					var $item = $(this);
					var $btn = $('#idcambio');
					if ( $item.val() == 0 ){
						$btn.addClass('disabled');
					} else {
						$btn.removeClass('disabled');
					}
				});

				$("#estados").submit(function(event) {
	                event.preventDefault();

	                $.ajax({
	                    url: "../persistencia/opFormulario.php",
	                    type: "POST",
	                    data: {accion: "cestado", numero: $("#numero").val(), nvoestado: $("#listaestados").val()},
	                    success: function(dato) {
	                    	alert('Estado modificado');
	                    	//$("#idcambio").text("");
							// $("#idcambio").prop("disabled", true);
							location.reload();
						}
					});
				});
			});
		</script>
	</head>
	<body style="padding-top: 60px;">
		<?php
			include 'menuRet.php';
		?>
			<div class="container">
				<form role='form' id="estados">
					<input type="hidden" name="numero" id="numero" value="<?php echo $numero ?>" />
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="panel-title">Cambiar Estado: <?php echo "<b>  " . $lCtl['nordemp'] . " - " . $lCtl['nombre'] . "</b>"?></span class="panel-title">
						</div>
						<div class="panel-body">
							<div class="row small">
								<div class="col-xs-12">
									<span for="">
										Estado Actual: <?php echo "<b>  " . $lCtl['desc_estado'] . "</b>"?>
									</span>
								</div>

								<div class='col-xs-12 text-center '>
									<label class='control-label' for='listaestados'>Cambiar a:</label>
								</div>

								<div class='col-sm-12'>
									<select class='form-control' id='listaestados' name = 'nvoestado'>
									<option value='0'>Seleccione estado...</option>";
									<?php
										foreach($qEstados AS $lEstados) {
											echo "<option value='" . $lEstados['idestados'] . "'>" . $lEstados['desc_estado'] . "</option>";
										}
									?>
								</select>
								</div>
							</div>
						</div>

						<div class="panel-footer">
							<div class="row ">
								<div class="col-xs-2 col-xs-offset-5">
									<button id ="idcambio" type='submit' class='btn btn-primary btn-md'>Confirma Cambio</button>
								</div>
							</div>

						</div>
					</div>
				</form>
			</div>
 	</body>
 </html>
