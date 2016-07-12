<?php
if (session_id () == "") {
	session_start ();
}

ini_set ( 'default_charset', 'UTF-8' );
include '../conecta.php';
$region = $_SESSION ['region'];
$tipousu = $_SESSION ['tipou'];
$vig = $_SESSION ['vigencia'];
$page = 'cara';

if ($_SESSION ['tipou'] == "FU") {
	$numero = $_SESSION ['numero'];
} else {
	$numero = $_GET ['numero'];
	// Busqueda por nombre o numero
}
$qCaratula = $conn->prepare ( "SELECT * FROM caratula WHERE nordemp= :idNumero" );
$qCaratula->execute ( array ('idNumero' => $numero) );
$row = $qCaratula->fetch ( PDO::FETCH_ASSOC );

$qControl = $conn->prepare ( "SELECT a.*, b.desc_estado FROM control a, estados b WHERE a.nordemp= :idNumero AND a.vigencia = :idPeriodo
		AND a.estado = b.idestados" );
$qControl->execute ( array (
		'idNumero' => $numero,
		'idPeriodo' => $vig 
) );
$rowCtl = $qControl->fetch ( PDO::FETCH_ASSOC );

$nombre = $row ['nombre'];

$qDpto = $conn->query ( "SELECT DISTINCT dpto, ndpto FROM divipola" );
$qDptoN = $conn->query ( "SELECT DISTINCT dpto, ndpto FROM divipola" );

$qMpio = $conn->prepare ( "SELECT muni, nmuni FROM divipola WHERE dpto = :idDpto ORDER BY muni" );
$qMpio->execute ( array (
		'idDpto' => $row ['depto'] 
) );

$qMpioN = $conn->prepare ( "SELECT muni, nmuni FROM divipola WHERE dpto = :idDptoN ORDER BY muni" );
$qMpioN->execute ( array (
		'idDptoN' => $row ['depnotific'] 
) );

$qOrganiza = $conn->query ( "SELECT * FROM organiza" );
$qEstadoAct = $conn->query ( "SELECT * FROM estadoact" );

$actividad = $row ['ciiu3'];

$qActEmp = $conn->query ( "select ci.CODIGO, ci.DESCRIP from actiemp as ac inner join caratula as ct on ct.nordemp = ac.nordemp inner join ciiu3 as ci on ci.CODIGO = ac.actividad where ac.nordemp = '" . $numero . "'" );
// $qlisActi = $conn->query ( "select CODIGO, DESCRIP FROM ciiu3 where CODIGO not in (
// 		select ci.CODIGO from actiemp as ac inner join caratula as ct on ct.nordemp = ac.nordemp inner join ciiu3 as ci on ci.CODIGO = ac.actividad where ac.nordemp = '" . $numero . "')
// 		and CODIGO like '" . substr ( $actividad, 0, 2 ) . "%'" ); 

$qlisActi = $conn->query ( "select CODIGO, DESCRIP FROM ciiu3 where CODIGO not in (
		select ci.CODIGO from actiemp as ac inner join caratula as ct on ct.nordemp = ac.nordemp inner join ciiu3 as ci on ci.CODIGO = ac.actividad where ac.nordemp = '" . $numero . "')" );

$qCIIU3 = $conn->query ( "select CODIGO, DESCRIP FROM ciiu3" );

$qActividad = $conn->query ( "SELECT * FROM ciiu3 WHERE CODIGO = $actividad" );
foreach ( $qActividad as $lActividad ) {
	$codCiiu = $lActividad ['CODIGO'];
	$descripCiiu = $lActividad ['DESCRIP'];
}
if ($tipousu != "FU") {
	$txtEstado = " estado - " . $rowCtl ['desc_estado'];
	$txtActividad = $codCiiu . $descripCiiu;
} else {
	$txtEstado = "";
	$txtActividad = "";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica -
	Formulario Electr&oacute;nico</title>
<link href="../bootstrap/img/favicon.ico" rel="shortcut icon"
	type="image/vnd.microsoft.icon">
<!-- Bootstrap -->
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"
	media="screen">
<link href="../bootstrap/css/custom.css" rel="stylesheet">
<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-dialog.css" rel="stylesheet">
<link href="../js/anytime.5.1.2.css" rel="stylesheet">
<script src="../bootstrap/js/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/cargaDato.js"></script>
<script type="text/javascript" src="../js/validaCara.js"></script>
<script type="text/javascript" src="../js/validator.js"></script>
<script type="text/javascript" src="../js/html5shiv.js"></script>
<script type="text/javascript" src="../js/respond.js"></script>
<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
<script type="text/javascript" src="../js/bootstrap-dialog.min.js"></script>
<script type="text/javascript" src="../js/anytime.5.1.2.js"></script>
<style type="text/css">
p {
	font-size: 13px !important;
}
</style>

<style>
.textoB {
	font-weight: bold;
}
</style>

<script type="text/javascript">
			$(function(){
				$('.solo-numero').keyup(function (){
					this.value = (this.value + '').replace(/[^0-9]/g, '');
				});

				$("#idfechai, #idfechah").attr("tabindex","-1"); //Deshabilito cambiar foco.
				
				//Permitir solo caracteres numericos en la caja de texto del numero NIT.
				$("#ndoc, #ntele, #ntelen, #nfax, #nfaxn, #idteldil").keyup(function(){
					if ($(this).val() != "") {
						$(this).val( $(this).val().replace(/[^0-9]/g, '') );
					}
				});

				//Validar que la fecha del acta de constitucion sea una fecha valida
				$("#idfechai, #idfechah").bind("keypress",function(event){					
					if ($(this).val().length >= 10){
						if ((event.which == 8)||(event.which == 0)||(event.which == 45)){
							 return true;
						}
						return false;
					}
					else{
						if ((event.which == 8)||(event.which == 0)||(event.which == 45)){ 
							return true;
						}	
						else if ((event.which >=48)&&(event.which <=57)){ 
							return true;
						}
						else{
							return false;
						}
					}						
				});

				
				$("#idfechai, #idfechah").bind("blur",function(){
					var fechaf = $(this).val().split("-");
					if (fechaf.length < 2){						
						alert("Formato de Fecha Inv\xE1lido");
						$(this).css("border", "1px solid #FF0000");
						return false;						
					}
					else{											       
					    var year = fechaf[0];
					    var month = fechaf[1];
					    var day = fechaf[2];
					    if (parseInt(month)<0 || parseInt(month)>12){
						    alert("Fecha No V\xE1lida");
						    $(this).css("border", "1px solid #FF0000"); 
						    return false;
						}
					    else if (parseInt(day)<0 || parseInt(day)>31){
					    	alert("Fecha No V\xE1lida");
					    	$(this).css("border", "1px solid #FF0000");
						    return false;
						}
					}
					$(this).css("border", "1px solid #DFDFDF");										
				});

				
			});
			
			/* Funcion para campos dimamicos */
			$(document).ready(function() {
				var contenedor	= $("#actividades"); //ID del contenedor
			    var actividad	= $("#listActividad"); // ID div.body modal 
			    
			  	//interaccion para agregar el div de la acividad del modal a la pagina
			    $(actividad).on("click", ".addAct", function(e) {
			    	$(this).children().removeClass("glyphicon-plus");
					$(this).children().addClass("glyphicon-remove");
					$(this).removeClass("addAct"); // agregar clase eliminar al div.
					$(this).addClass("eliminar"); // agregar clase eliminar al div.
					$(contenedor).append($(this).parent().parent().parent())
				});
			    
			    // interaccion para remover el item de el listado de la pagina y regresarlo al modal
			    $(contenedor).on("click", ".eliminar", function(e) {
			    	var $that = $(this);
			    	$that.children().removeClass("glyphicon-remove");
			    	$that.children().addClass("glyphicon-plus");
			    	$that.removeClass("eliminar"); // agregar clase eliminar al div.
			    	$that.addClass("addAct"); // agregar clase eliminar al div.
			    	$(actividad).append($(this).parent().parent().parent())
			    	//$(actividad).append($(this).parents(".form-group"));
				});
			});
			/* Fin funcion campos dinamicos */
			
			$(document).ready(function(){
    			$('[data-toggle="tooltip"]').tooltip();   
			});

			var retorno = "";
			$(function() {
                $("#idcara").submit(function(event) {
                    debugger;
                    event.preventDefault();
 					var $items = $(this).serialize();
                    $.ajax({
                        url: "../persistencia/grabacara.php",
                        type: "POST",
					    dataType: "json",
						beforeSend: validaCara,
                        //data: $(this).serialize(),
                        data: $items,
                        success: function(dato) {
							if (retorno == "") {
								$("#idmsg").show();
							}
							else {
								document.getElementById(retorno).focus();
							}
                        }
                    });
                });
			});
			
			function confBorra(numero, nombre) {
				BootstrapDialog.show({
					type: BootstrapDialog.TYPE_WARNING,
					title: 'Limpiar Formulario',
					message: numero+' - '+nombre,
					buttons: [{
						label: 'Confirmar',
							action: function(borra) {
								$.ajax({
									url: "../persistencia/opFormulario.php",
									type: "POST",
									data: {accion: "limpiar", numero: numero},
									success: function(dato) {
										alert(dato);
										borra.setMessage(numero+' - '+nombre+' INFORMACI&Oacute;N ELIMINADA');
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
			$(document).ready(function() {
				$("#idfechai").AnyTime_picker(
					{ format: "%Y-%m-%d", labelTitle: "FECHA",
					labelYear: "A\xF1o", labelMonth: "Mes", labelDayOfMonth: "Dia del Mes", dayAbbreviations: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'], monthAbbreviations: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'], baseYear: "1800",
earliest: new Date(1800,0,1,0,0,0),
latest: new Date(2099,11,31,23,59,59)
				});
			});
			$(document).ready(function() {
				$("#idfechaf").AnyTime_picker(
					{ format: "%Y-%m-%d", labelTitle: "FECHA",
					labelYear: "A\xF1o", labelMonth: "Mes", labelDayOfMonth: "Dia del Mes", dayAbbreviations: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'], monthAbbreviations: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'], minYear: 2000,
earliest: new Date(2000,0,1,0,0,0),
latest: new Date(2099,11,31,23,59,59)
				});
			});
			$(document).ready(function() {
				$("#idfechad").AnyTime_picker(
					{ format: "%Y-%m-%d", labelTitle: "FECHA",
					labelYear: "A\xF1o", labelMonth: "Mes", labelDayOfMonth: "Dia del Mes", dayAbbreviations: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'], monthAbbreviations: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']
				});
			});
			$(function() {
				$("#btnFecha").click(function() {
					$("#idfechad").focus();
				});
			});

			$(function() {
				$("#btnFechaDesde").click(function() {
					$("#idfechai").focus();
				});
			});

			$(function() {
				$("#btnFechaHasta").click(function() {
					$("#idfechaf").focus();
				});
			});
			
			$(function() {
				$("#asigFecha").click(function() {
					$.ajax({
                        url: "../persistencia/opFormulario.php",
                        type: "POST",
                        data: {accion: "asigFecha", fecha: $("#idfechad").val(), numero: $("#numero").val()},
                        success: function(dato) {
							if (dato == "") {
								$("#asigFecha").text("Asignada");
								$("#asigFecha").prop("disabled", true);
							}
							else {
								alert(dato);
							}
	                    }
                    });
				});
			});

			$(document).ready(function(){
				/** Validacion campo ndoc Numero documento */
				$('#ndoc').on('blur', function() {
					var v = parseInt($(this).val());
					if (v <= 0){
						alert('El Numero de documento debe ser mayor a 0');
					}
				});

				/** Validacion campo ndiv Digito de verificacion */
				$('#ndv').on('blur', function() {
					if ($(this).val() == ''){
						$(this).parent().append('<span class="text-danger">Campo obligatorio</span>');
					}else{
						$(this).parent().children('span').remove();
					}
				});

				

				
			});
		</script>
</head>
<body>
		<?php
		include 'menuFuente.php';
		?>
		<div class='well well-sm' style='font-size: 12px; padding-top: 60px; z-index: 1;' id='wcara'>
		<?php
			//echo "<div class='well well-sm' style='font-size: 12px; padding-top: 60px; z-index: 1;' id='wcara'>";
			if ($tipousu == "CO" and $region == 99) {
				echo "<a href='#' onClick='confBorra(" . $numero . ", \"" . $nombre . "\");'>Limpiar Formulario</a> | ";
				echo "<a href='../administracion/traslados.php?numero=" . $numero . "'>Traslado de Sede</a> | ";
				echo "<a href='../administracion/estados.php?numero=" . $numero . "'>Cambiar Estado</a> | ";
			}
			if ($tipousu == "CO" or ($tipousu == "CR" and $region == 99)) {
				echo "<a href='../administracion/novedades.php?numero=" . $numero . "'>Asignar Novedad</a> | ";
			}
			//echo "</div>";
		?>
		</div>
		<div class='container'>
			<?php if ($tipousu == "FU") { ?>
			<div class='row'>
			<span class='pull-right'> <select class='form-control input-sm'
				onChange='window.location.href=this.value;'>
					<option value=''>Descarga Documentos</option>
					<option value='../documentos/FormularioEDITSVBorrador.pdf'>Formulario
						Borrador</option>
					<option
						value='../documentos/MANUALDEDILIGENCIAMIENTO_EDIT_SERVICIOS_2016.pdf'>Maual
						de Diligenciamiento</option>
					<option
						value='../documentos/GLOSARIODETERMINOS_EDIT_SERVICIOS_2016.pdf'>Glosario
						de T&eacute;rminos</option>
			</select>
			</span>
		</div>
			<?php } ?>
			<form class='form-horizontal' role='form' data-toggle='validator'
			name="formcara" id="idcara">
			<input type="hidden" name="numero" id="numero"
				value="<?php echo $numero ?>" />
			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>Car&aacute;tula &Uacute;nica - Numero de orden: <?php echo $row['nordemp'] . $txtEstado ?></h4>
				</legend>
				<div class='form-group form-group-sm'>
					<table class="table table-condensed"
						style="margin-left: 15px; margin-right: 15px">
						<tr>
							<td class="text-center" style="border: none"><b>Identificaci&oacute;n</b></td>
							<td class="text-center" style="border: none"><b>Numero</b></td>
							<td class="text-center" style="border: none"><b>DV</b></td>
							<td style="border: none"><b>Inscrip/Matricula/Renovaci&oacute;n</b></td>
							
						</tr>
						<tr>
							<td style="border: none">
								<label class='radio-inline'>
									<input type='radio' id='rnit' name='tipodoc' value='1' <?php echo ($row['tipodoc'] == 1) ? 'checked' : ''?> />Nit.
								</label>
								<label class='radio-inline'>
									<input type='radio' id='rcc' name='tipodoc' value='2' <?php echo ($row['tipodoc'] == 2) ? 'checked' : ''?> />C.C.
								</label>
								<label class='radio-inline'>
									<input type='radio' id='rce' name='tipodoc' value='3' <?php echo ($row['tipodoc'] == 3) ? 'checked' : ''?> />C.E.
								</label>
							</td>
							<td style="border: none">
								<input type="text" class='form-control input-sm solo-numero' style="width: 150px" id='ndoc' name='numdoc' value=<?php echo $row['numdoc']?> required />
								<div class="help-block with-errors"></div>
							</td>
							<td style="border: none">
								<input type='text' class='form-control text-center input-sm solo-numero' style='width: 50px' id='ndv' maxlength='1' name='dv' value=<?php echo $row['dv']?> />
							</td>
							<td style="border: none">
								<label class='radio-inline'>
									<input type='radio' id='mat1' name='registmat' value='1' <?php echo ($row['registmat'] == 1) ? 'checked' : ''?> disabled />Inscrip./Matr.
								</label>
								<label class='radio-inline'>
									<input type='radio' id='mat2' name='registmat' value='2' <?php echo ($row['registmat'] == 2) ? 'checked' : ''?> disabled/>Renovaci&oacute;n
								</label>
							</td>
						</tr>
						<tr>
							<td class="text-center" style="border: none"><b>C&aacute;mara</b></td>
							<td class="text-center" style="border: none"><b>Inscripci&oacute;n/Matricula</b></td>
							<td class="text-center" style="border: none"><b>CIIU</b></td>
							<td class="text-center" style="border: none"><b>Novedad</b></td>
						</tr>
						<tr>
							<td style="border: none">
								<input type="text" class='form-control input-sm' style="width: 100px" id="cam" name="camara" value="<?php echo $row['camara'] ?>" readonly />
							</td>
							<td style="border: none">
								<input type="text" class='form-control input-sm' style="width: 100px" id="reg" name="numeroreg" value="<?php echo $row['numeroreg'] ?>" readonly />
							</td>
							<td style="border: none">
								<!-- Cambiar este campo por un select para la eleccion de la CIIU -->
								<select class='form-control' id='listadep' name='ciiu3' style="width: 100px">
									<?php
										foreach ( $qCIIU3 as $ciiu3 ) {
											if ($ciiu3 ['CODIGO'] == $row ['ciiu3']) {
												echo "<option value='" . $ciiu3 ['CODIGO'] . "' selected>" . $ciiu3 ['DESCRIP'] . "</option>";
											} else {
												echo "<option value='" . $ciiu3 ['CODIGO'] . "'>" . $ciiu3 ['DESCRIP'] . "</option>";
											}
										}
									?>
								</select>
								<input type="text" class='form-control input-sm' style="width: 100px" id="ciiu" name="ciiu3" value="<?php echo $row['ciiu3']; ?>" />
							</td>
							<td style="border: none">
								<input type="text" class='form-control input-sm' style="width: 150px" id="novedad" name="novedad" maxlength='2' value="<?php echo $row['novedad']; ?>" readonly />
							</td>
						</tr>
					</table>
				</div>
			</fieldset>
			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>
						Ubicaci&oacute;n y Datos Generales <small><?php echo $txtActividad?></small>
					</h4>
				</legend>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='rs'>Raz&oacute;n Social:</label>
					</div>
					<div class='col-sm-8 small'>
						<input type='text' class='form-control input-sm' id='rs'
							name='nompropie' data-error='Diligencie Raz&oacute;n Social'
							value='<?php echo trim($row['nompropie']) ?>' required />
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='nc'>Nombre Comercial:</label>
					</div>
					<div class='col-sm-8 small'>
						<input type='text' class='form-control input-sm' id='nc'
							name='nombre' data-error='Diligencie Nombre Comercial'
							value='<?php echo trim($row['nombre']) ?>' required />
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='sig'>SIGLA:</label>
					</div>
					<div class='col-sm-4 small'>
						<input type='text' class='form-control input-sm' id='sig'
							name='sigla' value='<?php echo trim($row['sigla']) ?>' />
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='dire'>Direcci&oacute;n Gerencia:</label>
					</div>
					<div class='col-sm-8 small'>
						<input type='text' class='form-control input-sm' id='dire'
							name='direccion'
							data-error='Diligencie Direcci&oacute;n Gerencia'
							value='<?php echo trim($row['direccion']) ?>' required />
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='listadep'>Departamento:</label>
					</div>
					<div class='col-sm-2 small'>
						<select class='form-control' id='listadep' name='depto'
							onChange='cargaMuni(this.value, "cntMuni", "listamuni", "mpio")'>
								<?php
								foreach ( $qDpto as $lDpto ) {
									if ($lDpto ['dpto'] == $row ['depto']) {
										echo "<option value='" . $lDpto ['dpto'] . "' selected>" . $lDpto ['ndpto'] . "</option>";
									} else {
										echo "<option value='" . $lDpto ['dpto'] . "'>" . $lDpto ['ndpto'] . "</option>";
									}
								}
								?>
							</select>
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='listamuni'>Municipio:</label>
					</div>
					<div class='col-sm-2 small' id='cntMuni'>
						<select class='form-control' name='mpio' id='listamuni'>
								<?php
								foreach ( $qMpio as $lMpio ) {
									if ($lMpio ['muni'] == $row ['mpio']) {
										echo "<option value='" . $lMpio ['muni'] . "' selected>" . $lMpio ['nmuni'] . "</option>";
									} else {
										echo "<option value='" . $lMpio ['muni'] . "'>" . $lMpio ['nmuni'] . "</option>";
									}
								}
								?>
							</select>
					</div>
					<div class='col-sm-1 small text-right' style="width: 50px">
						<label class='control-label' for='ntele'>Tel.:</label>
					</div>
					<div class='col-sm-2 small' style="width: 150px">
						<input type='tel' class='form-control input-sm' id='ntele'
							name='telefono' data-error='Tel&eacute;fono Inv&aacute;lido'
							value='<?php echo $row['telefono'] ?>' requiered />
						<div class="help-block with-errors"></div>
					</div>

					<div class='col-sm-1 small text-right' style="width: 50px">
						<label class='control-label' for='nfax'>Fax:</label>
					</div>
					<div class='col-sm-2 small' style="width: 150px">
						<input type='text' class='form-control input-sm' id='nfax'
							name='fax' value='<?php echo $row['fax'] ?>' />
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idmail'>Email Empresa:</label>
					</div>
					<div class='col-sm-3 small'>
						<input type="email" class='form-control input-sm'
							style='text-transform: lowercase' id='idmail' name="emailemp"
							data-error='email incorrecto'
							value="<?php echo $row['emailemp'] ?>" required />
						<div class="help-block with-errors"></div>
					</div>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idweb'>Sitio Web:</label>
					</div>
					<div class='col-sm-3 small'>
						<input type="url" class='form-control input-sm'
							style='text-transform: lowercase' name="web" id="idweb"
							value="<?php echo $row['web'] ?>" /> * Si no tiene sitio web, por
						favor no diligencie este campo.
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='dirn'>Direcci&oacute;n
							Notificaci&oacute;n:</label>
					</div>
					<div class='col-sm-8 small'>
						<input type='text' class='form-control input-sm' id='dirn'
							name='dirnotifi'
							data-error='Diligencie Direcci&oacute;n de notificaci&oacute;n'
							value='<?php echo trim($row['dirnotifi']) ?>' required />
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='ldepn'>Depto Notif.:</label>
					</div>
					<div class='col-sm-2 small'>
						<select class='form-control' id='ldepn' name='depnotific'
							onChange='cargaMuni(this.value, "cntMuniN", "lmunin", "munnotific")'>
								<?php
								foreach ( $qDptoN as $lDptoN ) {
									if ($lDptoN ['dpto'] == $row ['depnotific']) {
										echo "<option value='" . $lDptoN ['dpto'] . "' selected>" . $lDptoN ['ndpto'] . "</option>";
									} else {
										echo "<option value='" . $lDptoN ['dpto'] . "'>" . $lDptoN ['ndpto'] . "</option>";
									}
								}
								?>
							</select>
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='lmunin'>M/pio Notif.:</label>
					</div>
					<div class='col-sm-2 small' id='cntMuniN'>
						<select class='form-control' name='munnotific' id='lmunin'>
								<?php
								foreach ( $qMpioN as $lMpioN ) {
									if ($lMpioN ['muni'] == $row ['munnotific']) {
										echo "<option value='" . $lMpioN ['muni'] . "' selected>" . $lMpioN ['nmuni'] . "</option>";
									} else {
										echo "<option value='" . $lMpioN ['muni'] . "'>" . $lMpioN ['nmuni'] . "</option>";
									}
								}
								?>
							</select>
					</div>
					<div class='col-sm-1 small text-right' style="width: 50px">
						<label class='control-label' for='ntelen'>Tel. Not:</label>
					</div>
					<div class='col-sm-2 small' style="width: 150px">
						<input type='text' class='form-control input-sm' id='ntelen'
							name='telenotific'
							data-error='Diligencie Tel&eacute;fono Notificaci&oacute;n'
							value='<?php echo $row['telenotific'] ?>' required />
						<div class="help-block with-errors"></div>
					</div>
					<div class='col-sm-1 small text-right' style="width: 50px">
						<label class='control-label' for='nfaxn'>Fax Not:</label>
					</div>
					<div class='col-sm-2 small' style="width: 150px">
						<input type='text' class='form-control input-sm' id='nfaxn'
							name='faxnotific' value='<?php echo $row['faxnotific'] ?>' />
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idmailn'>Email
							Notificaci&oacute;n:</label>
					</div>
					<div class='col-sm-3 small'>
						<input type="email" class='form-control input-sm'
							style='text-transform: lowercase' id='idmailn' name="emailnotif"
							data-error='Diligencie Email Notificaci&oacute;n'
							value="<?php echo $row['emailnotif'] ?>" required />
						<div class="help-block with-errors"></div>
					</div>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idwebn'>Sitio Web
							Notificaci&oacute;n:</label>
					</div>
					<div class='col-sm-3 small'>
						<input type="text" class='form-control input-sm'
							style='text-transform: lowercase' name="webnotif" id="idwebn"
							value="<?php echo $row['webnotif'] ?>" /> * Si no tiene sitio
						web, por favor no diligencie este campo.
					</div>
				</div>
			</fieldset>
			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>Organizaci&oacute;n Jur&iacute;dica
						y Fecha de Constituci&oacute;n</h4>
				</legend>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idorg'>Organizaci&oacute;n
							Jur&iacute;dica:</label>
					</div>
					<div class='col-sm-3' id='cntOrga'>
						<select class='form-control' name='orgju' id='idorg'>
								<?php
								foreach ( $qOrganiza as $lOrganiza ) {
									if ($lOrganiza ['codigo'] == $row ['orgju']) {
										echo "<option value='" . $lOrganiza ['codigo'] . "' selected>" . $lOrganiza ['nombre'] . "</option>";
									} else {
										echo "<option value='" . $lOrganiza ['codigo'] . "'>" . $lOrganiza ['nombre'] . "</option>";
									}
								}
								?>
							</select>
					</div>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idfechai'>Fecha
							Constituci&oacute;n Desde:</label>
					</div>
					<div class='col-sm-2 small date'>
						<div class='input-group input-append date' id='idFechaDesde'>
							<input type='text' class='form-control col-xs-1'
								name='fechaconst' id='idfechai'
								value=<?php echo $row['fechaconst']?> /> <span
								class='input-group-addon add-on'>
								<button type='button' id='btnFechaDesde'
									class='btn btn-default btn-xs'>
									<span class='glyphicon glyphicon-calendar'>
								
								</button>
							</span></span>
						</div>
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idfechaf'>Hasta:</label>
					</div>
					<div class='col-sm-2 small date'>
						<div class='input-group input-append date' id='idfechaH'>
							<input type='text' class='form-control col-xs-1'
								name='fechahasta' id="idfechaf"
								value=<?php echo $row['fechahasta']?> /> <span
								class='input-group-addon add-on'>
								<button type='button' id='btnFechaHasta'
									class='btn btn-default btn-xs'>
									<span class='glyphicon glyphicon-calendar'>
								
								</button>
							</span></span>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>Composici&oacute;n del Capital
						Social y Estado Actual</h4>
				</legend>
				<div class='form-group form-group-sm'>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idnalpub'>Nacional
							P&uacute;blico:</label>
					</div>
					<div class='col-sm-1 small'>
						<input type="text" class='form-control input-sm' id='idnalpub'
							name="capsocinpu" value="<?php echo $row['capsocinpu'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idnalpr'>Nacional Privado:</label>
					</div>
					<div class='col-sm-1 small'>
						<input type="text" class='form-control input-sm' name="capsocinpr"
							id="idnalpr" value="<?php echo $row['capsocinpr'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idexpub'>Extranjero
							P&uacute;blico:</label>
					</div>
					<div class='col-sm-1 small'>
						<input type="text" class='form-control input-sm' id='idexpub'
							name="capsociepu" value="<?php echo $row['capsociepu'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idexpr'>Extranjero Privado:</label>
					</div>
					<div class='col-sm-1 small'>
						<input type="text" class='form-control input-sm' name="capsociepr"
							id="idexpr" value="<?php echo $row['capsociepr'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idestado'>Estado Actual:</label>
					</div>
					<div class='col-sm-2' id='estadoAct'>
						<select class='form-control' name='estadoact' id='idestado'>
								<?php
								foreach ( $qEstadoAct as $lEstadoAct ) {
									if ($lEstadoAct ['codigo'] == $row ['estadoact']) {
										echo "<option value='" . $lEstadoAct ['codigo'] . "' selected>" . $lEstadoAct ['estado'] . "</option>";
									} else {
										echo "<option value='" . $lEstadoAct ['codigo'] . "'>" . $lEstadoAct ['estado'] . "</option>";
									}
								}
								?>
							</select>
					</div>
				</div>
			</fieldset>
			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>N&uacute;mero de Establecimientos
						que conforman la Empresa de acuerdo con la actividad
						Econ&oacute;mica</h4>
				</legend>
				<div class='form-group form-group-sm' style="margin-left: 20px">
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idagr' style="font-size: 10px">Agropecuarios:</label>
					</div>
					<div class='col-xs-1 small' style="width: 80px">
						<input type="text" class='form-control input-xs' id='idagr'
							name="estagrop" value="<?php echo $row['estagrop'] ?>" />
					</div>
					<div class='col-sm-1 small text-right' style="font-size: 10px">
						<label class='control-label' for='idmin'>Mineros:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idmin'
							name="estminero" value="<?php echo $row['estminero'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idmanu' style="font-size: 10px">Manufactureros:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idmanu'
							name="estind" value="<?php echo $row['estind'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idspu' style="font-size: 10px">Servicios
							P&uacute;blicos:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idspu'
							name="estservpub" value="<?php echo $row['estservpub'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idcons' style="font-size: 10px">Const.
							y Obras Civiles:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idcons'
							name="estconst" value="<?php echo $row['estconst'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idcom' style="font-size: 10px">Comerciales:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idcom'
							name="estcom" value="<?php echo $row['estcom'] ?>" />
					</div>
				</div>

				<div class='form-group form-group-sm' style="margin-left: 20px">
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idresh' style="font-size: 10px">Rest.
							y Hoteles:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idresh'
							name="estreshot" value="<?php echo $row['estreshot'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idtya' style="font-size: 10px">Transp.
							y Almacenamiento:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idtya'
							name="esttrans" value="<?php echo $row['esttrans'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idcyc' style="font-size: 10px">Comunicaci&oacute;n
							y Correo:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idcyc'
							name="estcomunic" value="<?php echo $row['estcomunic'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idfin' style="font-size: 10px">Financ.
							y Otros Serv.:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idfin'
							name="estfinanc" value="<?php echo $row['estfinanc'] ?>" />
					</div>
					<div class='col-sm-1 small text-right' style="font-size: 10px">
						<label class='control-label' for='idserc'>Servicios Comunales:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idserc'
							name="estservcom" value="<?php echo $row['estservcom'] ?>" />
					</div>
					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idaux' style="font-size: 10px">Unidades
							Auxiliares:</label>
					</div>
					<div class='col-sm-1 small' style="width: 80px">
						<input type="text" class='form-control input-sm' id='idaux'
							name="uniaux" value="<?php echo $row['uniaux'] ?>" />
					</div>
				</div>
			</fieldset>

			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>Actividades Economicas</h4>
				</legend>
				<div class='form-group form-group-sm'>
					<div class='col-xs-12 col-sm-2 small text-right'>
						<!-- label class='control-label' for='idrep'>Representante Legal:</label-->
						<!--a id="agregarCampo" class="btn btn-info" href="#">Agregar Campo</a-->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Actividades Economicas</button>

					</div>
					<div id="actividades"
						class='col-xs-12 col-sm-8 col-sm-offset-1 small'>
						<!-- Listado de actividades de la empresa -->
						<?php foreach ( $qActEmp as $actEmp ) { ?>
						<div class="form-group ">
							<div class="input-group ">
								<span class="input-group-btn">
									<button class="btn btn-default eliminar" type="button">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</button>
								</span> 
								<input type="text" class="form-control" id="<?php echo $actEmp['CODIGO']; ?>" name="<?php echo $actEmp['CODIGO']; ?>" 
										value="<?php echo $actEmp['CODIGO'] . ' - ' . $actEmp['DESCRIP']; ?>" readonly>
							</div>
						</div>
						<?php } ?>
					</div>

				</div>
			</fieldset>

			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>Datos del Informante</h4>
				</legend>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idrep'>Representante Legal:</label>
					</div>
					<div class='col-sm-6 small'>
						<input type="text" class='form-control input-sm' id='idrep'
							name="repleg" data-error='Diligencie Reoresentante Legal'
							value="<?php echo trim($row['repleg']) ?>" required />
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='iddil'>Persona que Diligencia:</label>
					</div>
					<div class='col-sm-6 small'>
						<input type="text" class='form-control input-sm' id='iddil'
							name="responde"
							data-error='Ingrese nombre Persona que Diligencia'
							value="<?php echo trim($row['responde']) ?>" required />
						<div class="help-block with-errors"></div>
					</div>

					<div class='col-sm-1 small text-right'>
						<label class='control-label' for='idteldil'>Tel&eacute;fono:</label>
					</div>
					<div class='col-sm-2 small'>
						<input type="text" class='form-control input-sm' id='idteldil'
							name="teler"
							data-error='Diligencie tel&eacute;fono Persona que diligencia'
							value="<?php echo $row['teler'] ?>" required />
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idemres'>Email Persona que
							diligencia:</label>
					</div>
					<div class='col-sm-6 small'>
						<input type="email" class='form-control input-sm'
							style='text-transform: lowercase' id='idemres' name="emailres"
							data-error='Ingrese Email persona que diligencia'
							value="<?php echo trim($row['emailres']) ?>" required />
						<div class="help-block with-errors"></div>
					</div>
				</div>
			</fieldset>
				<?php
				if ($tipousu == "CO" and $rowCtl ['estado'] == 0) {
					echo "<fieldset style='border-style: solid; border-width: 1px'>";
					echo "<legend><h4 style='font-family: arial'>Fecha de Distribuci&oacuten</h4></legend>";
					echo "<div class='form-group form-group-sm'>";
					echo "<div class='col-sm-2 col-sm-offset-2'>";
					echo "<div class='input-group input-append date' id='idFechaD'>";
					echo "<input type='text' class='form-control col-xs-1' name='fechadist' id='idfechad' value=" . date ( 'Y-m-d' ) . " />";
					echo "<span class='input-group-addon add-on'>";
					echo "<button type='button' id='btnFecha' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-calendar'></button></span></span>";
					echo "</div>";
					echo "</div>";
					echo "<button type='button' id='asigFecha' class='btn btn-default btn-sm'>Asignar Fecha</button>";
					echo "</div>";
					echo "</fieldset>";
				}
				?>
				<div class='form-group form-group-sm'>
				<div class='col-md-8'>
					<p class='bg-success text-center text-uppercase'
						style='display: none' id='idmsg'>Car&aacute;tula Actualizada
						Correctamente</p>
				</div>
				<div class='col-sm-1 small pull-right'>
					<a
						href='capitulo1.php?numord=<?php echo $numero . "&nombre=" . $nombre?>'
						class='btn btn-default' data-toggle='tooltip'
						title='Ir a siguiente cap&iacute;tulo'>Continuar</a>
				</div>
				<div class='col-sm-1 small pull-right'>
					<button type='submit' class='btn btn-primary btn-md'
						data-toggle='tooltip'
						title='Actualizar informaci&oacute;n Car&aacute;tula &uacute;nica'>Grabar</button>
				</div>
			</div>
		</form>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Modal title</h4>
				</div>
				<div id="listActividad" class="modal-body">
					<!-- Listado de actividades consultadas -->
					<?php foreach ( $qlisActi as $lsAct ) { ?>
					<div class="form-group">
						<div class="input-group ">
							<span class="input-group-btn">
								<button class="btn btn-default addAct" type="button">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>
							</span> 
							<input type="text" class="form-control" id="<?php echo $lsAct['CODIGO']; ?>" name="<?php echo $lsAct['CODIGO']; ?>" 
								value="<?php echo $lsAct['CODIGO'] . ' - ' . $lsAct['DESCRIP']; ?>" readonly>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
</body>
</html>