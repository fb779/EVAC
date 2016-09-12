<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$nombre = $_SESSION['nombreu'];
	$vig = $_SESSION['vigencia'];
	$pagina = "MANTENIMIENTO USUARIOS";
	$niveles = array("AT"=>"Asistente T&eacute;cnico", "CO"=>"Coordinador", "CR"=>"Cr&iacute;tico");

	if ($_GET['accion'] == "MOD") {
		$qUsuario = $conn->prepare("SELECT * FROM usuarios WHERE ident = :idUsuario");
		$qUsuario->execute(array(':idUsuario'=>$_GET['ident']));
		$rowUsuario = $qUsuario->fetch(PDO::FETCH_ASSOC);
		$idUsuario = $rowUsuario['ident'];
		$nomUsuario = $rowUsuario['nombre'];
		$tipoUsuario = $rowUsuario['tipo'];
		$regionUsuario = $rowUsuario['region'];
		$emailUsuario = $rowUsuario['email'];
	}
	else {
		$idUsuario = "";
		$nomUsuario = "";
		$tipoUsuario = "";
		$regionUsuario = "";
		$emailUsuario = "";
	}
	if ($tipousu == "CO" AND $region == 99) {
		$qRegion = $conn->query("SELECT codis, nombre FROM regionales ORDER BY codis");
	}
	else {
		if (($tipousu == "AT" || $tipousu == "CO") AND $region != 99) {
			$qRegion = $conn->query("SELECT codis, nombre FROM regionales WHERE codis = $region ORDER BY codis");
		}
	}
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
		<title> <?php echo $_SESSION['titulo'] . 'Usuarios'; ?> </title>
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
		<script type="text/javascript">
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});

			$(function() {
				$("#idusuario").submit(function(event) {
					event.preventDefault();
					$.ajax({
		                url: "../persistencia/grabarusu.php",
		                type: "POST",
		                data: $(this).serialize(),
		                success: function(dato) {
		                    alert(dato);
		                }
					});
				});
			});
		</script>
	</head>
	<body style="padding-top: 60px; ">
		<?php
			include 'menuRet.php';
		?>
		<form class='form-horizontal' role='form' data-toggle='validator' name="formusu" id="idusuario" >
			<input type="hidden" name="ident" id="idident" value="<?php echo $idUsuario ?>" />
			<div class='container'>
				<div class="col-md-8 col-md-offset-2">
					<fieldset style='border-style: solid; border-width: 1px'>
						<legend><h4 style='font-family: arial'>Usuarios</h4></legend>
							<div class='form-group form-group-sm'>
								<div class='col-sm-2 small text-right'>
									<label class='control-label' for='nu'>Nombre:</label>
								</div>
								<div class='col-sm-8 small'>
									<input type='text' class='form-control input-sm' id='nu' name='nombre' data-error='Diligencie Nombre Usuario' value='<?php echo $nomUsuario ?>' required />
								</div>
							</div>
							<div class="help-block with-errors"></div>
							<div class='form-group form-group-sm'>
								<div class='col-sm-2 small text-right'>
									<label class='control-label' for='nivel'>Nivel:</label>
								</div>
								<div class='col-sm-3 small'>
									<?php
										echo "<select class='form-control' name='tipo' id='Nivel'>";
										echo "<option value='0'>Seleccione opci&oacute;n...</option>";
										foreach($niveles AS $valor=>$descrip) {
											if ($valor == $tipoUsuario) {
												echo "<option value=" . $valor . " selected>" . $descrip . "</option>";
											}
											else {
												echo "<option value=" . $valor . ">" . $descrip . "</option>";
											}
										}
										echo "</select>";
									?>
								</div>
							</div>
							<div class='form-group form-group-sm'>
								<div class='col-sm-2 small text-right'>
									<label class='control-label small' for='sede'>Sede:</label>
								</div>
								<div class='col-sm-3 small'>
									<?php
										echo "<select class='form-control' name='region' id='Sede'>";
										echo "<option value='0'>Seleccione ...</option>";
										foreach($qRegion AS $lRegion) {
											if ($lRegion['codis'] == $regionUsuario) {
												echo "<option value=" . $lRegion['codis'] . " selected>" . $lRegion['nombre'] . "</option>";
											}
											else {
												echo "<option value=" . $lRegion['codis'] . ">" . $lRegion['nombre'] . "</option>";
											}
										}
										echo "</select>";
									?>
								</div>
							</div>
							<div class='form-group form-group-sm'>
								<div class='col-sm-2 small text-right'>
									<label class='control-label' for='idmail'>Email:</label>
								</div>
								<div class='col-sm-8 small'>
									<input type="email" class='form-control input-sm' id='idmail' name='email' data-error='Ingrese un email v&aacute;lido' value='<?php echo $emailUsuario ?>' required />
								</div>
								<div class="help-block with-errors"></div>
							</div>
					</fieldset>
					<div class='form-group form-group-sm'>
						<div class='col-md-8'>
							<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Usuario Actualizado</p>
						</div>
						<div class='col-sm-1 small pull-right'>
							<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar Usuario'>Grabar</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</body>
</html>