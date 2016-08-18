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
	}
	$qCaratula = $conn->prepare ( "SELECT * FROM caratula WHERE nordemp= :idNumero" );
	$qCaratula->execute ( array ('idNumero' => $numero) );
	$row = $qCaratula->fetch ( PDO::FETCH_ASSOC );

	$qControl = $conn->prepare ( "SELECT a.*, b.desc_estado FROM control a, estados b WHERE a.nordemp= :idNumero AND a.vigencia = :idPeriodo AND a.estado = b.idestados" );
	$qControl->execute ( array ('idNumero' => $numero, 'idPeriodo' => $vig) );
	$rowCtl = $qControl->fetch ( PDO::FETCH_ASSOC );

	$nombre = $row ['nombre'];

	$qDpto = $conn->query ( "SELECT DISTINCT dpto, ndpto FROM divipola order by ndpto" );
	$qDptoN = $conn->query ( "SELECT DISTINCT dpto, ndpto FROM divipola order by ndpto" );

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

	try {
		$qPerac = $conn->query("SELECT * from control as ct inner join periodoactivo as pa on ct.vigencia = pa.id where ct.nordemp = '". $numero ."' order by ct.vigencia desc");
	} catch (Exception $e) {
		echo 'mensaje - ' .$e->getMessage();
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
<title> <?php echo $_SESSION['titulo'] . 'Caratula unica'; ?> </title>
<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
<!-- Bootstrap -->
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/custom.css" rel="stylesheet">
<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-dialog.css" rel="stylesheet">
<link href="../js/anytime.5.1.2.css" rel="stylesheet">
<script src="../bootstrap/js/jquery.js"></script>
<!-- script src="../bootstrap/js/transition.js"></script>
<script src="../bootstrap/js/collapse.js"></script-->
<script src="../bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../js/cargaDato.js"></script>
<!--script type="text/javascript" src="../js/validaCara.js"></script-->
<script type="text/javascript" src="../js/validator.js"></script>
<script type="text/javascript" src="../js/html5shiv.js"></script>
<script type="text/javascript" src="../js/respond.js"></script>
<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
<script type="text/javascript" src="../js/bootstrap-dialog.min.js"></script>
<script type="text/javascript" src="../js/anytime.5.1.2.js"></script>
<script type="text/javascript" src="../js/notSubmit.js"></script>
<script type="text/javascript" src="../js/periodo.js"></script>
<style type="text/css">
body {
	padding-top: 50px;
}
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
				$("#idfechai, #idfechah, #idfecdil").attr("tabindex","-1"); //Deshabilito cambiar foco.

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

	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});

	var retorno = "";
	$(function() {
		$("#idcara").submit(function(event) {
			event.preventDefault();
			// var $items = $(this).serialize();
			var $items = $(this).find(':input').not('#numero ,#actividades :input').serializeArray();
			var $activ = $('#actividades :input').serializeArray();
			debugger;
			$.ajax({
				url: "../persistencia/grabacara.php",
				type: "POST",
				dataType: "json",
				//beforeSend: validaCara,
                // data: $items,
                data: {'emp': $('#numero').val() ,'dtForm': JSON.stringify($items), 'dtActi': JSON.stringify($activ)},
                success: function(dato) {
                	debugger;
                	if (dato.success){
                		$("#idmsg").show();
                	}
                	if (retorno == "") {
                		$("#idmsg").show();
                	}
                	else {
                		document.getElementById(retorno).focus();
                	}
                },
                error: function(xhr, status, errorthrown){
                	debugger;
                	console.log(xhr);
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
				var oneDay = 24*60*60*1000; // Valor de 1 dia
				var oneMonth = 31*oneDay; // Valor de 1 mes
				var oneYear = 365*oneDay; // Valor de 1 año
				var Formato = "%Y-%m-%d"; // Formato de trabajo para las fechas
				var Convertidor = new AnyTime.Converter({format:Formato}); // Objeto para la conversion o parseo de fechas

				$("#idfechai").AnyTime_picker({
					format: Formato,
					labelTitle: "FECHA",
					labelYear: "A\xF1o",
					labelMonth: "Mes",
					labelDayOfMonth: "Día del Mes",
					dayAbbreviations: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
					monthAbbreviations: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
					baseYear: "1800",
					earliest: new Date(2000,0,1,0,0,0),
					latest: new Date(2099,11,31,23,59,59)
				});

				$("#idfechaf").AnyTime_picker({
					format: Formato,
					labelTitle: "FECHA",
					labelYear: "A\xF1o",
					labelMonth: "Mes",
					labelDayOfMonth: "Dia del Mes",
					dayAbbreviations: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
					monthAbbreviations: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
					minYear: 1800,
					//earliest: new Date(2000,0,1,0,0,0),
					earliest: new Date(Convertidor.parse($('#idfechai').val()).getTime()+oneDay),
					latest: new Date(2099,11,31,23,59,59)
				});


				$("#idfecdil").AnyTime_picker({
					format: Formato,
					labelTitle: "FECHA",
					labelYear: "A\xF1o",
					labelMonth: "Mes",
					labelDayOfMonth: "Día del Mes",
					dayAbbreviations: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
					monthAbbreviations: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
					baseYear: "1800",
					//earliest: new Date(2001,0,1,0,0,0),
					earliest: new Date(),
					latest: new Date(2099,11,31,23,59,59)
				});

				$("#idfechad").AnyTime_picker({
					format: Formato,
					labelTitle: "FECHA",
					labelYear: "A\xF1o",
					labelMonth: "Mes",
					labelDayOfMonth: "Dia del Mes",
					dayAbbreviations: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
					monthAbbreviations: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']
				});

				$("#btnFecha").click(function() {
					$("#idfechad").focus();
				});

				$("#btnFechaDesde").click(function() {
					$("#idfechai").focus();
				});

				$("#btnFechaHasta").click(function() {
					$("#idfechaf").focus();
				});

				$("#btnFechaDili").click(function() {
					$("#idfecdil").focus();
				});

				$("#idfechai").on('change',function(){
					var item = $(this);
					var feci = Convertidor.parse($('#idfechai').val()).getTime();
					var fecf = Convertidor.parse($('#idfechaf').val()).getTime();

					if (item.attr('id') == 'idfechai'){

						if (parseInt( $('#idfechai').val().replace(/-/g,'') ) > parseInt( $('#idfechaf').val().replace(/-/g,''))){
							var dayLater = new Date(feci+oneDay); // Se obtiene la fecha seleccionada y se agrega 1 dia
							dayLater.setHours(0,0,0,0);
							var moreDaysLater = new Date(feci+(2*oneYear)); // a la fecha seleccionada se le agrega 2 meses
							moreDaysLater.setHours(23,59,59,999)

							$('#idfechaf').
							AnyTime_noPicker().
							removeAttr("disabled").
							val(Convertidor.format(dayLater)).
							AnyTime_picker( {
								format: Formato,
								labelTitle: "FECHA",
								labelYear: "A\xF1o",
								labelMonth: "Mes",
								labelDayOfMonth: "Dia del Mes",
								dayAbbreviations: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
								monthAbbreviations: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
								earliest: dayLater,
								//latest: moreDaysLater
							});
						}else{
							var day = new Date(fecf);
							day.setHours(0,0,0,0);
							var dayLater = new Date(feci+oneDay); // Se obtiene la fecha seleccionada y se agrega 1 dia
							dayLater.setHours(0,0,0,0);

							$('#idfechaf').
							AnyTime_noPicker().
							removeAttr("disabled").
							val(Convertidor.format(day)).
							AnyTime_picker( {
								format: Formato,
								labelTitle: "FECHA",
								labelYear: "A\xF1o",
								labelMonth: "Mes",
								labelDayOfMonth: "Dia del Mes",
								dayAbbreviations: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
								monthAbbreviations: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
								earliest: dayLater
								//latest: moreDaysLater
							});
						}
					}

					// if (item.attr('id') == 'idfechaf'){
					// 	//console.log('Fecha final.');
					// }
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

/* Funciones para campos dimamicos */
$(document).ready(function() {
				var contenedor	= $("#actividades"); //ID del contenedor
			    var actividad	= $("#listActividad"); // ID div.body modal

			    contenedor.css('z-index', 0);
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

/** Validaciones de los campos de la caratula unica */
$(document).ready(function(){
	/** Convertir campos texto a mausculas */
	$('.mayusculas').on('keyup', function(){
		var v = $(this);
		v.val( v.val().toUpperCase());

	});

	/** Permitir solo numeros en los campos */
	$('.solo-numero').on('keyup',function (){
		this.value = (this.value + '').replace(/[^0-9]/g, '');
	});

	/** Evitar caracteres especiales */
	$('.no-especiales').on('keyup', function() {
		var regex = new RegExp("^[. 0-9a-zA-ZáéíóúñÁÉÍÓÚ\b]+$");
		var _this = this;

		var texto = $(_this).val();
		if(!regex.test(texto)) {
			$(_this).val(texto.substring(0, (texto.length-1)))
		}
	});

	/** Evitar caracteres especiales */
	$('.solo-letras').on('keyup', function() {
		var regex = new RegExp("^[ a-zA-ZáéíóúñÁÉÍÓÚ\b]+$");
		var _this = this;

		var texto = $(_this).val();
		if(!regex.test(texto)) {
			$(_this).val(texto.substring(0, (texto.length-1)))
		}
	});



	var color = '#a94442';
	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

	/** Validacion campo ndoc Numero documento */
	$('#ndoc').on('blur', function() {
		$(this).css('border',"");
		$(this).parent().parent().removeClass('text-danger');
		$(this).parent().children('span').remove();

		var v = parseInt($(this).val());
		if (!isNaN(v)){
			if (v <= 0){
				$(this).val('');
				$(this).parent().parent().addClass('text-danger');
				$(this).css('border',"1px solid" + color);
				$(this).parent().append('<span class="text-danger">El valor no puede ser 0</span>');

			}
		}else{
			$(this).parent().parent().addClass('text-danger');
			$(this).css('border',"1px solid" + color);
			$(this).parent().append('<span class="text-danger">Campo obligatorio</span>');
		}
	});

	/** Validacion campo ndiv Digito de verificacion */
	$('#ndv').on('blur', function() {
		$(this).parent().parent().removeClass('text-danger');
		$(this).css('border',"");
		$(this).parent().children('span').remove();
		if ($(this).val() == ''){
			$(this).parent().parent().addClass('text-danger');
			$(this).css('border',"1px solid" + color);
			$(this).parent().append('<span class="text-danger">Campo obligatorio</span>');
		}
	});

	/** Validacion campo Camara */
	$('#cam').on('blur', function() {
		$(this).css('border',"");
		$(this).parent().parent().removeClass('text-danger');
		$(this).parent().parent().removeClass('has-error');
		$(this).parent().children('span').remove();

		var v = parseInt($(this).val());
		if (!isNaN(v)){
			if (v <= 0){
				$(this).val('');
				$(this).parent().parent().addClass('text-danger');
				$(this).parent().parent().addClass('has-error');
							//$(this).css('border',"1px solid" + color);
							$(this).parent().append('<span class="text-danger">El valor no puede ser 0</span>');

						}
					}else{
						$(this).parent().parent().addClass('text-danger');
						$(this).parent().parent().addClass('has-error');
						//$(this).css('border',"1px solid" + color);
						$(this).parent().append('<span class="text-danger">Campo obligatorio</span>');
					}
				});

	/** Validacion campo Matricula */
	$('#reg').on('blur', function() {
		$(this).css('border',"");
		$(this).parent().parent().removeClass('text-danger');
		$(this).parent().parent().removeClass('has-error');
		$(this).parent().children('span').remove();

		var v = parseInt($(this).val());
		if (!isNaN(v)){
			if (v <= 0){
				$(this).val('');
				$(this).parent().parent().addClass('text-danger');
				$(this).parent().parent().addClass('has-error');
							//$(this).css('border',"1px solid" + color);
							$(this).parent().append('<span class="text-danger">El valor no puede ser 0</span>');

						}
					}else{
						$(this).parent().parent().addClass('text-danger');
						$(this).parent().parent().addClass('has-error');
						//$(this).css('border',"1px solid" + color);
						$(this).parent().append('<span class="text-danger">Campo obligatorio</span>');
					}
				});

	/** Validacion campo Razon social */
	$('#rs').on('blur', function() {
		$(this).parent().parent().removeClass('text-danger');
		$(this).css('border',"");
		$(this).parent().children('span').remove();
		if ($(this).val() == ''){
			$(this).parent().parent().addClass('text-danger');
			$(this).css('border',"1px solid" + color);
			$(this).parent().append('<span class="text-danger"><h6>Falta Rason social</h6></span>');
		}
	});

	/** Validacion nmombre comercial */
	$('#nc').on('blur', function() {
		$(this).parent().parent().removeClass('text-danger');
		$(this).css('border',"");
		$(this).parent().children('span').remove();
		if ($(this).val() == ''){
			$(this).parent().parent().addClass('text-danger');
			$(this).css('border',"1px solid" + color);
			$(this).parent().append('<span class="text-danger"><h6>Falta Nombre comercial</h6></span>');
		}
	});

	$('#dire').on('blur', function() {
		$(this).parent().parent().removeClass('text-danger');
		$(this).css('border',"");
		$(this).parent().children('span').remove();
		if ($(this).val() == ''){
			$(this).parent().parent().addClass('text-danger');
			$(this).css('border',"1px solid" + color);
			$(this).parent().append('<span class="text-danger"><h6>Falta La Dirección de Gerencia</h6></span>');
		}
	});

	/** Validacion email */
	$('#idmail').on('blur', function() {
		$(this).parent().parent().removeClass('text-danger');
		$(this).css('border',"");
		$(this).parent().children('span').remove();
				    // Se utiliza la funcion test() nativa de JavaScript
				    if ($(this).val() != ''){
				    	if (!regex.test($(this).val().trim()) ) {
				    		$(this).parent().parent().addClass('text-danger');
				    		$(this).css('border',"1px solid" + color);
				    		$(this).parent().append('<span class="text-danger">Correo invalido</span>');
				    	}
				    }else{
				    	$(this).parent().parent().addClass('text-danger');
				    	$(this).css('border',"1px solid" + color);
				    	$(this).parent().append('<span class="text-danger">Falta correo electrónico</span>');
				    }

				});

	/** Validacion direccion de notificacion */
	$('#dirn').on('blur', function() {
		$(this).parent().parent().removeClass('text-danger');
		$(this).css('border',"");
		$(this).parent().children('span').remove();
				    // Se utiliza la funcion test() nativa de JavaScript
				    if ($(this).val() == ''){
				    	$(this).parent().parent().addClass('text-danger');
				    	$(this).css('border',"1px solid" + color);
				    	$(this).parent().append('<span class="text-danger">Falta dirección de notificación</span>');
				    }
				});

	/** Validacion email notificacion */
	$('#idmailn').on('blur', function() {
		$(this).parent().parent().removeClass('text-danger');
		$(this).css('border',"");
		$(this).parent().children('span').remove();
				    // Se utiliza la funcion test() nativa de JavaScript
				    if ($(this).val() != ''){
				    	if (!regex.test($(this).val().trim()) ) {
				    		$(this).parent().parent().addClass('text-danger');
				    		$(this).css('border',"1px solid" + color);
				    		$(this).parent().append('<span class="text-danger">Correo invalido</span>');
				    	}
				    }else{
				    	$(this).parent().parent().addClass('text-danger');
				    	$(this).css('border',"1px solid" + color);
				    	$(this).parent().append('<span class="text-danger">Falta correo electrónico de notificación</span>');
				    }

				});

	/** Activacion del campo para una organización no existente */
	$('#idorg').on('change', function(){
		var v = $(this);
		if( v.val() == '99.1' || v.val() == '13' ){
			$('#idorgcual').prop('disabled',false);
			$('#idorgcual').prop('required',true);
			$('#idorgcual').parent().removeClass('hidden');
		}else{
			$('#idorgcual').prop('disabled', true);
			$('#idorgcual').parent().addClass('hidden');
			$('#idorgcual').val('');
		}
	});

	/** Validacion de organización inexistente en los listados */
	$('#idorgcual').on('blur', function() {
					//$(this).parent().removeClass('text-danger');
					$(this).css('border',"");
					$(this).parent().children('span').remove();
					// Se utiliza la funcion test() nativa de JavaScript
					if ($(this).val() == ''){
						$(this).parent().addClass('text-danger');
						$(this).css('border',"1px solid" + color);
						$(this).parent().append('<span class="text-danger">Debe espeficicar alguna organización</span>');
					}
				});

	/** Validacion para la composicion del capital social */
	$('#idnalpub, #idnalpr, #idexpub, #idexpr').on('blur', function(){
		var $item = $(this);
		var $msj = $('#msjCo');
		var $msj1 = $('#msjCo1');
		var npu = parseInt($('#idnalpub').val());
		var npr = parseInt($('#idnalpr').val());
		var epu = parseInt($('#idexpub').val());
		var epr = parseInt($('#idexpr').val());
		debugger;
		$item.parent().parent().removeClass('has-error');
		$item.parent().parent().children('div span').remove()
		$msj.children('span').remove();
		$msj1.children('span').remove();

		if ($item.val() === '' || parseInt($item.val()) > 100){
			clError($item);
		}else{

			if (!isNaN(npu) && !isNaN(npr) && npu > 0 && npr > 0 && (npu + npr) >= 100){
				$msj1.append('<span><p>La suma de el capital nacional publico y privado no puede sumar 100%</p></span>');
				clError($item);
				npu = parseInt($('#idnalpub').val());
				npr = parseInt($('#idnalpr').val());
			}

			if (!isNaN(npr) && !isNaN(epu) && npr > 0 && epu > 0 && (npr + epu) >= 100){
				$msj1.append('<span><p>La suma de el capital nacional privado y extranjero publico no puede sumar 100%</p></span>');
				clError($item);
				npr = parseInt($('#idnalpr').val());
				epu = parseInt($('#idexpub').val());
			}

			if (!isNaN(epu) && !isNaN(epr) && epu > 0 && epr > 0 && (epu + epr) >= 100){
				$msj1.append('<span><p>La suma de el capital extranjer publico y privado no puede sumar 100%</p></span>');
				clError($item);
				epu = parseInt($('#idexpub').val());
				epr = parseInt($('#idexpr').val());
			}

			if (!isNaN(npu) && !isNaN(npr) && !isNaN(epu) && !isNaN(epr) && (npu + npr + epu + epr) != 100){
				debugger;
				$msj.append('<span><p>La suma de la composición social debe ser 100%</p></span>');
				clError($item);
							//$(this).val('');
			} else if (sumaCampos() > 100){
				$msj.append('<span><p>La suma de la composición social debe ser 100%</p></span>');
				clError($item);
				//$(this).val('');
			}
		}
	});

	/** Validacion para el campo estado y activacion de la casilla adicional */
	$('#idestado').on('change', function(){
		var v = parseInt($(this).val());

		if (v == 7){
			$('#idestactotro').parent().parent().removeClass('hidden');
			$('#idestactotro').prop('disabled',false);
			$('#idestactotro').prop('required',true);
		}else{
			$('#idestactotro').parent().parent().addClass('hidden');
			$('#idestactotro').prop('required',false);
			$('#idestactotro').prop('disabled',true);
			$('#idestactotro').val(' ');
		}
	});

	/** Validación para la casilla adicional del estado */
	$('#idestactotro').on('change', function(){
		$(this).parent().parent().removeClass('text-danger');
		$(this).css('border',"");
		$(this).parent().children('span').remove();
		if ( $(this).val() == '' ){
			$(this).parent().parent().addClass('text-danger');
			$(this).css('border',"1px solid" + color);
			$(this).parent().append('<span class="text-danger">Describa cual es el otro estado actual de la empresa</span>');
		}
	});

	$('.numestab :input').on('change', function(){
		var v = $(this);
		v.parent().removeClass('text-danger');
		v.css('border',"");
		$(this).parent().children('span').remove();
		if (v.val() == ''){
						//v.val('0');
						v.parent().addClass('text-danger');
						v.css('border',"1px solid" + color);
						$(this).parent().append('<span class="text-danger">Debe digitar un valor entre 0-999</span>');
					}
				});
});

function clError($this){
	$this.parent().parent().addClass('has-error');
	$this.parent().parent().append('<span class="text-danger">El dato debe ser numerico de 0-100</span>');
	$this.val('');
}

function sumaCampos(){
	var suma = 0;
	$('#cocaso input').each(function(){
		var num = parseInt($(this).val());
		if (!isNaN(num)){  suma += num; }
	});
	return suma;
}
</script>
</head>
<body>
		<?php
		include 'menuFuente.php';
		?>
		<div class='well well-sm' style='font-size: 12px; /*padding-top: 60px;*/ z-index: 1;' id='wcara'>
		<?php
			if ($tipousu == "CO" and $region == 99) {
				echo "<a href='#' onClick='confBorra(" . $numero . ", \"" . $nombre . "\");'>Limpiar Formulario</a> | ";
				echo "<a href='../administracion/traslados.php?numero=" . $numero . "'>Traslado de Sede</a> | ";
				echo "<a href='../administracion/estados.php?numero=" . $numero . "'>Cambiar Estado</a> | ";
			}
			if ($tipousu == "CO" or ($tipousu == "CR" and $region == 99)) {
				echo "<a href='../administracion/novedades.php?numero=" . $numero . "'>Asignar Novedad</a> | ";
			}
		?>


		<div class="container">
			<div class="row col-xs-12">
				<?php if ( $tipousu == 'FU'){ ?>
				<div class="form-group form-group-sm col-xs-3">
					<label for="">Seleccione el periodo</label>
					<select class='form-control' id="periodo" name="periodo">
						<option value="">Periodo</option>
						<?php foreach ($qPerac as $per){?>
							<option value="<?php echo $per['id']; ?>"><?php echo $per['nomperiodo']; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="col-xs-4">
					<div class="panel panel-default">
						<!--div class="panel-heading">Periodo actual</div-->
						<div class="panel-body">
							<label>Periodo actual: </label>
							<span for=""><?php echo $_SESSION['nomPeri']; ?></span>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>


		</div>
		<div class='container'>
			<?php if ($tipousu == "FU") { ?>
			<div class='row'>
				<span class='pull-right'> <select class='form-control input-sm' onChange='window.location.href=this.value;'>
					<option value=''>Descarga Documentos</option>
					<option value='../documentos/FormularioEDITSVBorrador.pdf'>Formulario Borrador</option>
					<option value='../documentos/MANUALDEDILIGENCIAMIENTO_EDIT_SERVICIOS_2016.pdf'>Maual de Diligenciamiento</option>
					<option value='../documentos/GLOSARIODETERMINOS_EDIT_SERVICIOS_2016.pdf'>Glosario de T&eacute;rminos</option>
				</select>
				</span>
			</div>
			<?php } ?>

			<form class='form-horizontal' role='form' data-toggle='validator' name="formcara" id="idcara">
			<input type="hidden" name="numero" id="numero" value="<?php echo $numero ?>" />
			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>Car&aacute;tula &Uacute;nica - Numero de orden: <?php echo $row['nordemp'] . $txtEstado ?></h4>
				</legend>
				<div class="container-fluid small text-center">
					<div class="row">
						<div class="col-xs-12 col-sm-3" >
							<label for="">Identificación</label>
							<div class="form-group form-group-sm col">
								<label class='radio-inline'>
									<input type='radio' id='rnit' name='tipodoc' value='1' <?php echo ($row['tipodoc'] == 1 || ($row['tipodoc']!=2 && $row['tipodoc']!=3)) ? 'checked' : ''?> required />Nit.
								</label>
								<label class='radio-inline'>
									<input type='radio' id='rcc' name='tipodoc' value='2' <?php echo ($row['tipodoc'] == 2) ? 'checked' : ''?> required/>C.C.
								</label>
								<label class='radio-inline'>
									<input type='radio' id='rce' name='tipodoc' value='3' <?php echo ($row['tipodoc'] == 3) ? 'checked' : ''?> required/>C.E.
								</label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<label for="">Numero</label>
							<div class="from-group form-group-sm">
								<input type="text" class='form-control input-sm solo-numero' id='ndoc' name='numdoc' maxlength="11" value=<?php echo $row['numdoc']?> required />
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<label for="">DV</label>
							<div class="from-group form-group-sm">
								<input type='text' class='form-control text-center input-sm solo-numero' id='ndv' maxlength='1' name='dv' value=<?php echo $row['dv']?> required/>
							</div>
						</div>

						<div class="col-xs-12 col-sm-3">
							<label for="">Inscrip/Matricula/Renovaci&oacute;n</label>
							<div class="from-group form-group-sm">
								<label class='radio-inline'>
									<input type='radio' id='mat1' name='registmat' value='1' <?php echo ($row['registmat'] == 1 || $row['registmat'] != 2) ? 'checked' : ''?> required />Inscrip./Matr.
								</label>
								<label class='radio-inline'>
									<input type='radio' id='mat2' name='registmat' value='2' <?php echo ($row['registmat'] == 2) ? 'checked' : ''?> required/>Renovaci&oacute;n
								</label>
							</div>
						</div>
					</div>
					<div class="col-xs-0">&nbsp;</div>
					<div class="row">
						<div class="col-xs-12 col-sm-3">
							<label for="">C&aacute;mara</label>
							<div class="from-group form-group-sm">
								<input type="text" class='form-control input-sm solo-numero' id="cam" name="camara" value="<?php echo $row['camara'] ?>" maxlength="3" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<label for="">Inscripci&oacute;n/Matricula</label>
							<div class="from-group form-group-sm">
								<input type="text" class='form-control input-sm solo-numero' id="reg" name="numeroreg" value="<?php echo $row['numeroreg'] ?>" maxlength="11" />
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<label for="">CIIU</label>
							<div class="from-group form-group-sm">
								<select class='form-control' id='listadep' name='ciiu3'>
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
								<!-- input type="text" class='form-control input-sm' style="width: 100px" id="ciiu" name="ciiu3" value="<?php echo $row['ciiu3']; ?>" /-->
							</div>
						</div>
						<?php if ($tipousu != "FU") { ?>
						<div class="col-xs-12 col-sm-3">
							<label for="">Novedad</label>
							<div class="from-group form-group-sm">
								<input type="text" class='form-control input-sm' id="novedad" name="novedad" maxlength='2' value="<?php echo $rowCtl['novedad']; ?>" readonly />
							</div>
						</div>
						<?php } ?>
						<div class="col-xs-12">&nbsp;</div>
					</div>
				</div>
			</fieldset>

			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>
						Ubicaci&oacute;n y Datos Generales <small><?php echo $txtActividad?></small>
					</h4>
				</legend>

				<div class="container-fluid small">
					<div class="col-xs-12">
						<label class='col-xs-2 text-right' for='rs'>Raz&oacute;n Social:</label>
						<div class='col-xs-10 small'>
							<input type='text' class='form-control input-sm no-especiales mayusculas' id='rs' name='nompropie' maxlength="60" data-error='Diligencie Raz&oacute;n Social' value='<?php echo trim($row['nompropie']) ?>' required />
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="col-xs-12">
						<label class='col-xs-2 text-right' for='nc'>Nombre Comercial:</label>
						<div class='col-xs-10 small'>
							<input type='text' class='form-control input-sm no-especiales mayusculas' id='nc' name='nombre' maxlength="60" data-error='Diligencie Nombre Comercial' value='<?php echo trim($row['nombre']) ?>' required />
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="col-xs-12">
						<label class='col-xs-2 text-right' for='sig'>SIGLA:</label>
						<div class='col-xs-10 small'>
							<input type='text' class='form-control input-sm no-especiales mayusculas' id='sig' name='sigla' maxlength="20" value='<?php echo trim($row['sigla']) ?>' />
						</div>
					</div>
					<div class="col-xs-12">&nbsp;</div>
					<div class="col-xs-12">
						<label class='col-xs-2 text-right'  for='dire'>Direcci&oacute;n Gerencia General:</label>
						<div class='col-xs-10 small'>
							<input type='text' class='form-control input-sm' id='dire' name='direccion' maxlength="40" data-error='Falta la Direcci&oacute;n de la Gerencia General' value='<?php echo trim($row['direccion']) ?>' required />
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="col-xs-12">&nbsp;</div>
				</div>

				<div class="container-fluid small text-center">
					<div class="form-group col-xs-1"> &nbsp;</div>
					<div class="form-group form-group-sm col-xs-3">
						<label class='' for='listadep'>Departamento</label>
						<div class='small'>
							<select class='form-control' id='listadep' name='depto' onChange='cargaMuni(this.value, "cntMuni", "listamuni", "mpio")'>
								<?php
								foreach ( $qDpto as $lDpto ) {
									if ($lDpto ['dpto'] == $row ['depto']) {
										echo "<option value='" . $lDpto ['dpto'] . "' selected>" . $lDpto['ndpto'] . "</option>";
									} else {
										echo "<option value='" . $lDpto ['dpto'] . "'>" . $lDpto['ndpto'] . "</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group col-xs-1"> &nbsp;</div>
					<div class="form-group form-group-sm col-xs-3">
						<label class='' for='listamuni'>Municipio</label>
						<div class='small' id='cntMuni'>
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
					</div>
					<div class="form-group col-xs-1"> &nbsp;</div>
					<div class="form-group col-xs-2">
						<label class='control-label' for='ntele'>Telefono</label>
						<div class=''>
							<input type='tel' class='form-control input-sm' id='ntele' name='telefono' maxlength="10" data-error='Falta Tel&eacute;fono' value='<?php echo $row['telefono'] ?>' required />
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group col-xs-1"> &nbsp;</div>
					<div class="form-group col-xs-2">
						<label class='control-label' for='nfax'>Extensión:</label>
						<div class=''>
							<input type='text' class='form-control input-sm' id='nfax'  name='fax' maxlength="5" value='<?php echo $row['fax'] ?>' />
						</div>
					</div>
				</div>

				<div class="container-fluid small">
					<div class="form group form-group-sm col-xs-6">
						<label class='col-xs-4 text-right' for='idmail'>Email Empresa:</label>
						<div class='col-xs-8 small'>
							<input type="email" class='form-control input-sm' style='text-transform: lowercase' id='idmail' name="emailemp" maxlength="50" value="<?php echo $row['emailemp'] ?>" required />
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form group form-group-sm col-xs-6">
						<label class='col-xs-4 text-right' for='idweb'>Sitio Web:</label>
						<div class='col-sm-8 small'>
							<input type="url" class='form-control input-sm' style='text-transform: lowercase' name="web" id="idweb" maxlength="50" value="<?php echo $row['web'] ?>" />
						</div>
						<span class="col-xs-12 text-center">* Si no tiene sitio web, por favor no diligencie este campo. </span>
					</div>
					<div class="col-xs-12">&nbsp;</div>
				</div>

				<div class="container-fluid small text-center">
					<div class="col-xs-12">
						<label class='col-xs-2 text-right' for='dirn'>Direcci&oacute;n Notificaci&oacute;n:</label>
						<div class="col-xs-10">
							<input type='text' class='form-control input-sm' id='dirn' name='dirnotifi' maxlength="40" value='<?php echo trim($row['dirnotifi']) ?>' required />
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="col-xs-12">&nbsp;</div>
				</div>

				<div class="container-fluid small text-center">
					<div class="form-group col-xs-1"> &nbsp;</div>
					<div class="form-group form-group-sm col-xs-3">
						<label class='' for='ldepn'>Departamento Notificación</label>
						<div class='small'>
							<select class='form-control' id='ldepn' name='depnotific' onChange='cargaMuni(this.value, "cntMuniN", "lmunin", "munnotific")'>
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
					</div>
					<div class="form-group col-xs-1"> &nbsp;</div>
					<div class="form-group form-group-sm col-xs-3">
						<label class='' for='lmunin'>Municipio Notificación</label>
						<div class='small' id='cntMuniN'>
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
					</div>
					<div class="form-group col-xs-1"> &nbsp;</div>
					<div class="form-group col-xs-2">
						<label class='control-label' for='ntelen'>Tel. Not</label>
						<div class=''>
							<input type='text' class='form-control input-sm' id='ntelen' name='telenotific' maxlength="10" data-error='Falta Tel&eacute;fono Notificaci&oacute;n' value='<?php echo $row['telenotific'] ?>' required />
						<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group col-xs-1"> &nbsp;</div>
					<div class="form-group col-xs-2">
						<label class='control-label' for='nfaxn'>Ext. Not</label>
						<div class=''>
							<input type='text' class='form-control input-sm' id='nfaxn' name='faxnotific' maxlength="5" value='<?php echo $row['faxnotific'] ?>' />
						</div>
					</div>
				</div>

				<div class="container-fluid small">
					<div class="form group form-group-sm col-xs-6">
						<label class='col-xs-4 text-right' for='idmailn'>Email Notificaci&oacute;n:</label>
						<div class='col-xs-8 small'>
							<input type="email" class='form-control input-sm' style='text-transform: lowercase' id='idmailn' name="emailnotif" data-error='Diligencie Email Notificaci&oacute;n' value="<?php echo $row['emailnotif'] ?>" required />
						<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form group form-group-sm col-xs-6">
						<label class='col-xs-4 text-right' for='idwebn'>Sitio Web Notificaci&oacute;n:</label>
						<div class='col-sm-8'>
							<input type="text" class='form-control input-sm' style='text-transform: lowercase' name="webnotif" id="idwebn" value="<?php echo $row['webnotif'] ?>" />
						</div>
						<span class="col-xs-12 text-center">* Si no tiene sitio web, por favor no diligencie este campo. </span>
					</div>
					<div class="col-xs-12">&nbsp;</div>
				</div>
			</fieldset>

			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>Organizaci&oacute;n Jur&iacute;dica y Fecha de Constituci&oacute;n</h4>
				</legend>

				<div class="container-fluid small">
					<div class="form group form-group-sm col-xs-6">
						<label class='' for='idorg'>Tipo de organizaci&oacute;n Jur&iacute;dica:</label>
						<div class='' id='cntOrga'>
							<select class='form-control' name='orgju' id='idorg'>
								<?php
									foreach ( $qOrganiza as $lOrganiza ) {
										$algo = (substr($lOrganiza['codigo'],0,2) =='12') ? $lOrganiza['codigo']." - " : '';
										if ($lOrganiza ['codigo'] == $row ['orgju']) {
											echo "<option value='" . $lOrganiza ['codigo'] . "' selected>" . $algo . $lOrganiza ['nombre'] . substr($row['codigo'], 0,2). "</option>";
										} else {
											echo "<option value='" . $lOrganiza ['codigo'] . "'>" . $algo . $lOrganiza ['nombre'] . "</option>";
										}
									}
								?>
							</select>
						</div>
						<div class="col-xs-12">&nbsp;</div>
						<div class='hidden'>
							<input type="text" class='form-control ' name="orgjucual" id="idorgcual" maxlength="50" value="<?php echo $row['orgjucual'] ?>" placeholder="Cual ?" disabled/>
						</div>
						<div class="col-xs-12">&nbsp;</div>
					</div>

					<div class="form group form-group-sm col-xs-3">
						<label class='' for='idfechai'>Fecha Constituci&oacute;n Desde:</label>
						<div class='small date'>
							<div class='input-group input-append date' id='idFechaDesde'>
								<input type='text' class='form-control ' name='fechaconst' id='idfechai' value=<?php echo $row['fechaconst']?> />
									<span class='input-group-addon add-on'>
										<button type='button' id='btnFechaDesde' class='btn btn-default btn-xs'>
											<span class='glyphicon glyphicon-calendar'></span>
										</button>
									</span>
							</div>
						</div>
					</div>

					<div class="form group form-group-sm col-xs-3">
						<label class='' for='idfechaf'>Hasta:</label>
						<div class=' date'>

							<div class='input-group input-append date' id='idfechaH'>
								<input type='text' class='form-control ' name='fechahasta' id="idfechaf" value=<?php echo $row['fechahasta']?> />
								<div class='input-group-addon add-on'>
									<button type='button' id='btnFechaHasta' class='btn btn-default btn-xs'>
										<span class='glyphicon glyphicon-calendar'></span>
									</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</fieldset>
			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>Composici&oacute;n del Capital Social y Estado Actual</h4>
					<div ><h6 > Nota: La sigiente información esta representada en porcentaje %, la sumatoria de todos los campos debe representar el 100% </h6></div>
				</legend>

				<div id="cocaso" class="container-fluid small text-center">
					<div class="col-xs-12 text-danger" id="msjCo"></div>
					<div class="col-xs-12 text-danger" id="msjCo1"></div>
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-2">
						<label class='control-label' for='idnalpub'>Nacional P&uacute;blico:</label>
						<div class="input-group input-group-sm">
						  <input type="text" class='form-control input-sm solo-numero' id='idnalpub' name="capsocinpu" maxlength="3" value="<?php echo $row['capsocinpu'] ?>" required />
						  <span class="input-group-addon" id="sizing-addon1">%</span>
						</div>
					</div>
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-2">
						<label class='control-label' for='idnalpr'>Nacional Privado:</label>
						<div class="input-group input-group-sm">
							<input type="text" class='form-control input-sm solo-numero' name="capsocinpr" id="idnalpr" maxlength="3" value="<?php echo $row['capsocinpr'] ?>" required/>
							<span class="input-group-addon" id="sizing-addon1">%</span>
						</div>
					</div>
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-2">
						<label class='control-label' for='idexpub'>Extranjero P&uacute;blico:</label>
						<div class="input-group input-group-sm">
							<input type="text" class='form-control input-sm solo-numero' id='idexpub' name="capsociepu" maxlength="3" value="<?php echo $row['capsociepu'] ?>" required />
							<span class="input-group-addon" id="sizing-addon1">%</span>
						</div>
					</div>
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-2">
						<label class='control-label' for='idexpr'>Extranjero Privado:</label>
						<div class="input-group input-group-sm">
							<input type="text" class='form-control input-sm solo-numero' name="capsociepr" id="idexpr" maxlength="3" value="<?php echo $row['capsociepr'] ?>" required/>
							<span class="input-group-addon" id="sizing-addon1">%</span>
						</div>
					</div>
				</div>

				<div class="container-fluid">
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-5" id='estadoAct'>
						<label class='control-label' for='idestado'>Estado Actual:</label>
						<select class='form-control form-control-sm' name='estadoact' id='idestado'>
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
					<div class="col-xs-1"></div>
					<div class="form-group col-xs-5 <?php echo ($row['otro'] != '')?'':'hidden';  ?>">
						<label class='control-label' for='nfaxn'>Otro</label>
						<div class=''>
							<input type='text' class='form-control input-sm' id='idestactotro' name='otro' maxlength="50" value='<?php echo $row['otro'] ?>' required/>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>N&uacute;mero de Establecimientos que conforman la Empresa de acuerdo con la actividad Econ&oacute;mica</h4>
				</legend>
				<div class="container-fluid text-center small numestab">
					<div class="col-xs-12">
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Agropecuarios</label>
							<input type="text" class='form-control input-sm solo-numero' id='idagr' name="estagrop" maxlength="3" value="<?php echo $row['estagrop'] ?>" required />
						</div>
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Mineros</label>
							<input type="text" class='form-control input-sm solo-numero' id='idmin' name="estminero" maxlength="3" value="<?php echo $row['estminero'] ?>" required />
						</div>
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Manufactureros</label>
							<input type="text" class='form-control input-sm solo-numero' id='idmanu' name="estind" maxlength="3" value="<?php echo $row['estind'] ?>" required />
						</div>
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Servicios P&uacute;blicos</label>
							<input type="text" class='form-control input-sm solo-numero' id='idspu' name="estservpub" maxlength="3" value="<?php echo $row['estservpub'] ?>" required />
						</div>
						<div class="col-xs-1">&nbsp;</div>
					</div>

					<div class="col-xs-12">
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Const. y Obras Civiles</label>
							<input type="text" class='form-control input-sm solo-numero' id='idcons' name="estconst" maxlength="3" value="<?php echo $row['estconst'] ?>" required />
						</div>
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Comerciales</label>
							<input type="text" class='form-control input-sm solo-numero' id='idcom' name="estcom" maxlength="3" value="<?php echo $row['estcom'] ?>" required />
						</div>
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Rest. y Hoteles</label>
							<input type="text" class='form-control input-sm solo-numero' id='idresh' name="estreshot" maxlength="3" value="<?php echo $row['estreshot'] ?>" required/>
						</div>
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Transp y Almacenamiento</label>
							<input type="text" class='form-control input-sm solo-numero' id='idtya' name="esttrans" maxlength="3" value="<?php echo $row['esttrans'] ?>" required/>
						</div>
						<div class="col-xs-1">&nbsp;</div>
					</div>

					<div class="col-xs-12">
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Comunicaci&oacute;n y Correo</label>
							<input type="text" class='form-control input-sm solo-numero' id='idcyc' name="estcomunic" maxlength="3" value="<?php echo $row['estcomunic'] ?>" required/>
						</div>
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Financ. y Otros Serv.</label>
							<input type="text" class='form-control input-sm solo-numero' id='idfin' name="estfinanc" maxlength="3" value="<?php echo $row['estfinanc'] ?>" required />
						</div>
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Servicios Comunales</label>
							<input type="text" class='form-control input-sm solo-numero' id='idserc' name="estservcom" maxlength="3" value="<?php echo $row['estservcom'] ?>" required/>
						</div>
						<div class="col-xs-1">&nbsp;</div>
						<div class="form-group col-xs-2">
							<label for="">Unidades Auxiliares</label>
							<input type="text" class='form-control input-sm solo-numero' id='idaux' name="uniaux" maxlength="3" value="<?php echo $row['uniaux'] ?>" required />
						</div>
						<div class="col-xs-1">&nbsp;</div>
					</div>
				</div>
			</fieldset>

			<fieldset style='border-style: solid; border-width: 1px'>
				<legend>
					<h4 style='font-family: arial'>Actividades Economicas</h4>
				</legend>
				<div class="container-fluid text-center">
					<!-- div class="row">&nbsp; </div-->
					<div class='form-group col-xs-12 col-sm-3'>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Actividades Economicas</button>
					</div>

					<div id="actividades" class="col-xs-12 col-sm-9">
						<?php foreach ( $qActEmp as $actEmp ) { ?>
						<div class="form-group" >
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
					<h4 style='font-family: arial'>Datos de diligenciamiento</h4>
				</legend>
				<div class="form-group form-group-sm small">
					<div class="">
						<label class="col-sm-2 text-right" for="">Fecha de diligenciamiento</label>

						<div class="input-group col-sm-2 col-sm-offset-1">
							<input type="text" class="form-control" name='fechadili' id="idfecdil" value=<?php echo $row['fechadili']?>>
							<span class="input-group-btn">
								<button class="btn btn-default btn-sm" id='btnFechaDili' type="button">
									<span class="glyphicon glyphicon-calendar"></span>
								</button>
					      </span>
					    </div><!-- /input-group -->
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idrep'>Representante Legal:</label>
					</div>
					<div class='col-sm-6 small'>
						<input type="text" class='form-control input-sm solo-letras mayusculas no-especiales' id='idrep' name="repleg" data-error='Diligencie Reoresentante Legal' maxlength="50" value="<?php echo trim($row['repleg']) ?>" required />
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='iddil'>Persona que Diligencia:</label>
					</div>
					<div class='col-sm-6 small'>
						<input type="text" class='form-control input-sm solo-letras mayusculas no-especiales' id='iddil' name="responde" data-error='Ingrese nombre Persona que Diligencia' maxlength="50" value="<?php echo trim($row['responde']) ?>" required />
						<div class="help-block with-errors"></div>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='iddil'>Cargo Persona que Diligencia:</label>
					</div>
					<div class='col-sm-6 small'>
						<input type="text" class='form-control input-sm solo-letras  mayusculas no-especiales' id='idcadil' name="carresponde" data-error='Ingrese el cargo de la Persona que Diligencia' maxlength="50" value="<?php echo trim($row['carresponde']) ?>" required />
						<div class="help-block with-errors"></div>
					</div>
				</div>


				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idteldil'>Tel&eacute;fono:</label>
					</div>
					<div class='col-sm-2 small'>
						<input type="text" class='form-control input-sm solo-numero' id='idteldil' name="teler" maxlength="10" data-error='Diligencie tel&eacute;fono Persona que diligencia' value="<?php echo $row['teler'] ?>" required />
						<div class="help-block with-errors"></div>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idteldil'>Extensión:</label>
					</div>
					<div class='col-sm-2 small'>
						<input type="text" class='form-control input-sm solo-numero' id='idfaxdil' name="faxr" maxlength="5" data-error='Diligencie la Extensión de la Persona que diligencia' value="<?php echo $row['faxr'] ?>" />
						<div class="help-block with-errors"></div>
					</div>
				</div>

				<div class='form-group form-group-sm'>
					<div class='col-sm-2 small text-right'>
						<label class='control-label' for='idemres'>Email Persona que diligencia:</label>
					</div>
					<div class='col-sm-6 small'>
						<input type="email" class='form-control input-sm mayusculas' style='text-transform: lowercase' id='idemres' name="emailres" maxlength="50" data-error='Ingrese Email persona que diligencia' value="<?php echo trim($row['emailres']) ?>" required />
						<div class="help-block with-errors"></div>
					</div>
				</div>
			</fieldset>
			<?php if ($tipousu == "CO" and $rowCtl ['estado'] == 0) { ?>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend>
						<h4 style='font-family: arial'>Fecha de Distribuci&oacuten</h4>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 col-sm-offset-2'>
							<div class='input-group input-append date' id='idFechaD'>
								<input type='text' class='form-control col-xs-1' name='fechadist' id='idfechad' value=" . date ( 'Y-m-d' ) . " />
								<span class='input-group-addon add-on'>
									<button type='button' id='btnFecha' class='btn btn-default btn-xs'>
										<span class='glyphicon glyphicon-calendar'></span>
									</button>
								</span>
							</div>
						</div>
						<button type='button' id='asigFecha' class='btn btn-default btn-sm'>Asignar Fecha</button>
					</div>
				</fieldset>
			<?php } ?>

			<div class='form-group form-group-sm'>
				<div class='col-md-8'>
					<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Car&aacute;tula Actualizada Correctamente</p>
				</div>
				<div class='col-sm-1 small pull-right'>
					<a href='capitulo1.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente cap&iacute;tulo'>Continuar</a>
				</div>
				<div class='col-sm-1 small pull-right'>
					<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar informaci&oacute;n Car&aacute;tula &uacute;nica'>Grabar</button>
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