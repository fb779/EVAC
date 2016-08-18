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
	$numero = $_GET['numero'];
	$vig = $_SESSION['vigencia'];
	$pagina = "ASIGNAR NOVEDAD";
	$nombre = $_SESSION['nombreu'];
	$regOpe = $_SESSION['region'];
	$txtObserva = "";

	$qCaratula = $conn->prepare("SELECT a.nordemp, a.nombre, b.novedad FROM caratula a, control b WHERE a.nordemp= :idNumero AND a.nordemp = b.nordemp");
	$qCaratula->execute(array(':idNumero'=>$numero));
	$row = $qCaratula->fetch(PDO::FETCH_ASSOC);

	//$rowRegion = $conn->query('select nombre')

	if ($row['novedad'] != 99 AND $row['novedad'] != 5) {
		$qObserva = $conn->prepare("SELECT * FROM observaciones WHERE nordemp = :idNumero AND capitulo = 99 ORDER BY fecha DESC LIMIT 1");
		$qObserva->execute(array(':idNumero'=>$numero));
		$rowObs = $qObserva->fetch(PDO::FETCH_ASSOC);
		$txtObserva = $rowObs['observacion'];
	}

	$qNovedad = $conn->query("SELECT * FROM novedades WHERE idnovedades NOT IN (9, 99,98)");
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
		<title>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - Formulario Electr&oacute;nico</title>
		<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
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

	            $("#novedad").submit(function(event) {
	                event.preventDefault();

	                $.ajax({
	                    url: "../persistencia/opFormulario.php",
	                    type: "POST",
	                    data: {accion: "novedad", numero: $("#numero").val(), nove: $("#listanov").val(), obsnov: $("#idObsN").val()},
	                    success: function(dato) {
							alert(dato);
						}
					});
				});

				function comprobarArchivo() {
					var val = document.getElementById('archivo').value;
					if (val == '') {
						alert("Seleccione un archivo primero: ");
						return false;
					}
					return true;
				}

				function borraSoporte(id, numero, nombre) {
					BootstrapDialog.show({
						type: BootstrapDialog.TYPE_WARNING,
						title: 'Eliminar Soporte',
						message: numero+' - '+nombre,
						buttons: [{
							label: 'Confirmar',
								action: function(borra) {
									$.ajax({
										url: "soporteNov.php",
										type: "GET",
										data: {id: id, numero: numero, opcion_soporte: 2},
										success: function(dato) {
											borra.setMessage(numero+' - '+nombre+' SOPORTE ELIMINADO');
										}
									});
								}
						}, {
							label: 'Cancelar',
								action: function(cerrar) {
								cerrar.close();
							}
						}]
					});
				}
			});


		</script>
	</head>
	<body>
		<?php
			include 'menuRet.php';
		?>
		<div class="container" style="padding-top: 80px">
			<form role='form' id="novedad" data-toggle="validator">
				<input type="hidden" name="numero" id="numero" value="<?php echo $numero ?>" />

				<div class="panel panel-default">
						<div class="panel-heading">
							<span class="panel-title">Fuente: <?php echo "<b>  " . $row['nordemp'] . " - " . $row['nombre'] . "</b>"?></span class="panel-title">
						</div>
						<div class="panel-body">
							<div class="row small">
								<div class='form-group form-group-sm col-xs-12'>
									<label class='control-label' for='listareg'>Asignar novedad:</label>
									<select class='form-control' id='listanov' name = 'sede'>
										<option value='0'>Seleccione una novedad...</option>";
										<?php
											foreach($qNovedad AS $lNovedad) {
												if ($lNovedad['idnovedades'] == $row['novedad']) {
													echo "<option value='" . $lNovedad['idnovedades'] . "' selected>" . $lNovedad['desc_novedad'] . "</option>";
												}
												else {
													echo "<option value='" . $lNovedad['idnovedades'] . "'>" . $lNovedad['desc_novedad'] . "</option>";
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="row small">
								<div class="form-group col-xs-12">
										<label class='control-label' for='obsnov'>Observaci&oacute;n:</label>
										<textarea class="form-control" id="idObsN" rows="3" required ><?php echo $txtObserva ?></textarea>
								</div>
							</div>
						</div>

						<div class="panel-footer">
							<div class="row ">
								<div class="col-xs-2 col-xs-offset-5">
									<button type='submit' class='btn btn-primary btn-md'>Asignar Novedad</button>
								</div>
							</div>

						</div>
					</div>
			</form>
		</div>
		<div class="container" id="detallest">
			<form enctype="multipart/form-data" method="post" action="soporteNov.php?opcion_soporte=3" onSubmit="return comprobarArchivo();">
				<input type = 'hidden' name='numero' value='<?php echo $numero?>'/>
				<fieldset>
					<legend><b>Soportes Novedad</b></legend>
					<div class="form-group form-group-sm">
						<div class="col-sm-2 small">
							<label class="control-label" for="archivo">Seleccionar Archivo:</label>
						</div>
						<div class='col-sm-4 small'>
							<input type="file" name="archivo" id="archivo" size="30">
						</div>
						<div class='col-sm-1 small'>
							<input type="submit" name="submit" value="Subir archivo">
						</div>
						<div class='col-sm-4 small'>
							Tipos Soportados: JPG, GIF, PNG, PDF -- Tama&ntilde;o Max. 2MB.
						</div>
					</div>
				</fieldset>
			</form>



			<?php
				$sql = $conn->query("SELECT id,numemp,soporte_nombre,soporte_tipo,soporte_peso FROM soportes WHERE numemp='$numero'");
				if ($sql->rowCount()>0) {
					echo "<div class='container'>";
					echo "<table class='table table-condensed table-hover table-bordered' style='font-size: 11px'>";
					foreach($sql AS $lSoporte) {
						$idDoc = $lSoporte['id'];
						echo "<tr>";
						echo "<td style='text-align: center'><a href='soporteNov.php?id=".$idDoc."&opcion_soporte=1&numero=$numero' target='_blank' title='Ver imagen'><span class='glyphicon glyphicon-eye-open'></span></a></td>";
						echo "<td style='text-align: center'><a href='#' onClick='borraSoporte(" . $idDoc . ", " . $numero . ", \"" . $lSoporte['soporte_nombre'] . "\");' title='Eliminar imagen'><span class='glyphicon glyphicon-remove' style='color: red'></span></a></td>";
						echo "<td>".$lSoporte['soporte_nombre']."</td>";
						echo "<td>".$lSoporte['soporte_tipo']."</td>";
						echo "<td>".$lSoporte['soporte_peso']."</td>";
						echo "</tr>";
					}
					echo "</table>";
					echo "</div>";
				}
			?>
		</div>
 	</body>
</html>
