<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	include '../conecta.php';
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='cap1';
	$vig=$_SESSION['vigencia'];
	$estadObs = ($tipousu != "FU" ? "readonly" : "");
	$consLog = ($region == 99 ? true : false);
	
	$cLog = "<span class='glyphicon glyphicon-time' style='color: blue; font-size: 14px;'></span>";

	$anterior = $vig-1;
	$tabla = 'capitulo_i';
	//$tabla = 'capitulo_i_other';
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$grabaOK = false;
	include '../persistencia/cargaDato.php';
	
	
	
/**########################**/
	// verificacion para la carga de informacion de l formulario y creacion de registros para la informacion
	/** Carga de informacion del capitulo 1 */
// 	$llave = "C1_nordemp"; // campo de relacion para la empresa
	$rowDisLink = $conn->query("SELECT id_displab from capitulo_i_displab WHERE C1_nordemp = $numero AND vigencia = $vig;");
	$rowDisCont = $conn->query("SELECT id_displab, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14 from capitulo_i_displab WHERE C1_nordemp = $numero AND vigencia = $vig;");
// 	$qDispo->execute(array('nFuente'=>$numero, 'periodo'=>$vig));
// 	$rowDis = $qDispo->fetch(PDO::FETCH_ASSOC);
	
// 	$qControl = $conn->prepare("SELECT a.*, b.desc_estado FROM control a, estados b WHERE a.nordemp = :nFuente AND a.vigencia = :periodo
// 			AND a.estado = b.idestados");
// 	$qControl->execute(array('nFuente'=>$numero, 'periodo'=>$vig));
// 	$rowCtl = $qControl->fetch(PDO::FETCH_ASSOC);
	
// 	$nom = ["C1_nordemp" => "15", "C1_numdisp" => "", "i1r1c1" => "1", "i1r1c2" => "10", "i1r1c3" => "8", "i1r1c4" => "2",
// 			"i1r2c10" => "10", "i1r2c11" => "1", "i1r2c12" => "1", "i1r2c13" => "1", "i1r2c14" => "12", "i1r2c15" => "2", "i1r2c16" => "1500000", "i1r2c17" => "2", "i1r2c18" => "8", "i1r2c19" => "4", "i1r2c110" => "4",
// 			"i1r2c111" => "2", "i1r2c112" => "7", "i1r2c113" => "por que a", 
// 			"i1r2c20" => "0", "i1r2c21" => "", "i1r2c22" => "", "i1r2c23" => "", "i1r2c24" => "",  "i1r2c25" => "", "i1r2c26" => "", "i1r2c27" => "", "i1r2c28" => "0", "i1r2c29" => "0", "i1r2c210" => "0", "i1r2c211" => "0",
// 			"i1r2c30" => "0", "i1r2c31" => "", "i1r2c32" => "", "i1r2c33" => "", "i1r2c34" => "", "i1r2c35" => "", "i1r2c36" => "", "i1r2c37" => "", "i1r2c38" => "0", "i1r2c39" => "0", "i1r2c310" => "0", "i1r2c311" => "0", 
// 			"i1r3c5" => "1",  "i1r4c1" => "23", "observaciones" => ""];
	
// // 	$pnl = 3;
// 	$lineaINS = 'INSERT INTO capitulo_i_displab (C1_nordemp, vigencia, i1r2c1, i1r2c2, i1r2c3, i1r2c4, i1r2c5, i1r2c6, i1r2c7, i1r2c8, i1r2c9, i1r2c10, i1r2c11, i1r2c12, i1r2c13, i1r2c14) values ';
// 	$pnl = 2;
// 	$tem = '';
// 	for ($i=1; $i<= $pnl; $i++){
// 		$tem .= '(' . $numero . ',' . $vig . ',' ;
// 		for ($j=0; $j<14; $j++){
// 			$nc = 'i1r2c' . $i . $j;
// 			$c1n2[] = $nc;
// 			echo $nc . ' - ';
// 			if (isset($dt[$nc]) && $nom[$nc] != ''){
// 				$tem .= "'" .$nom[$nc] . "',";
// 			}else{
// 				$tem .= "'NULL',";
// 			}
// 		}
// 		$tem = rtrim($tem, ", ") .  '),';
// 	}
	
// 	$lineaINS .= rtrim($tem, ", ");
	
	
// 	for ($i=1; $i<= $pnl; $i++){
// 		$tem .= '(' . $numero . ',' . $vig . ',' ;
// 		for ($j=0; $j<14; $j++){
// 			$nc = 'i1r2c' . $i . $j;
// 			$c1n2[] = $nc;
// 			if (in_array(($nc), $nombres )){
// 				$tem .= $dt[$nc] . ',';
// 			}else{
// 				$tem .= 'NULL,';
// 			}
// 		}
// 		$tem = rtrim($tem, ", ") .  '),';
// 	}
	
/**########################**/
	
// 	$estadoI1R4C2N = ''; $estadoI1R4C2M = ''; $estadoI2 = ''; $estadoI7 = ''; $estadoI9R1 = 'disabled'; $estadoI9R2 = 'disabled';
// 	$estadoI10 = 'disabled';
	
// 	$estadoI4R1C1 = ''; $estadoI4R2C1 = ''; $estadoI4R3C1 = ''; $estadoI4R4C1 = ''; $estadoI4R1C2 = ''; $estadoI4R2C2 = ''; $estadoI4R3C2 = ''; $estadoI4R4C2 = '';
	
// 	$row = ['i1r1c1' => 1, /*'i1r1c1' => 2,*/ 'i1r1c2' => 25,
// 			'i1r3c1' => 1,'i1r3c2' => 0,'i1r3c3' => 1,'i1r3c4' => 0,'i1r3c5' => 1,'i1r3c6' => 0,'i1r3c7' => 1,'i1r3c8' => 0, 'i1r3c9' => 'Medio de publicacion adicional',
// 			'i1r4c1' => 1,
// 			'OBSERVACIONES' => 'Observaciones de la fuente para el estado de la fuente'
// 	];
	
	if ($tipousu != "FU") {
		$txtEstado = " - estado - " . $rowCtl['desc_estado'];
	}
	else {
		$txtEstado = "";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - Formulario Electr&oacute;nico</title>
		<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../bootstrap/css/custom.css" rel="stylesheet">
		<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">		
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/cargaDato.js"></script>
	 	<script type="text/javascript" src="../js/valida1.js"></script>
		<script type="text/javascript" src="../js/validaForm1.js"></script>
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<style>
			.modal-width {
				width: 90%;
			}
			.textoB {
				font-weight: bold;
			}
		</style>
		<script type="text/javascript">
			var retorno = 0;
			var inputText = ['i1r1c2', 'i1r4c1']
			function validaFormOther() {
				retorno = 0;
				var cont = 0;
				/**Validar radio buttons vacantes */
				if (!$('input[name="i1r1c1"]').is(':checked')) {
					$('input[name="i1r1c1"]').parent().parent().addClass('text-danger');
			        retorno += 1;
			    }
			    				
				if ($('[name="i1r1c1"]:checked').val() == 1){ /* Valor del radiobutton en si */
					for (i=0; i<inputText.length; i++) {
						if ($('[name="'+ inputText[i] +'"]').val() == ''){
							$('[name="'+ inputText[i] +'"]').parent().addClass('text-danger');
							retorno += 1;
						}
					}

					if($('[name="i1r3c8"]').is(':checked')){
						if ($('[name="i1r3c9"]').val() == ''){
							$('[name="i1r3c9"]').parent().addClass('text-danger');
							retorno += 1;
						}
					}

					$(':checkbox').each(function(){ 
					  if($(this).is(':checked')){
					    cont ++;
					  }
					});

					if (cont == 0){ 
					  $('#ii3contenido').removeClass('hidden');
					  retorno += 1;
					}else{
					  $('#ii3contenido').addClass('hidden');
					}

					
// 	 				$('#listDisForm').children().each(function(){
// 		 				var pnal = $(this).attr('id').substring(4);
// 						var vacNoCub = 'i1r2c' + pnal + '11';
// 						var vacNoCubCa = 'i1r2c' + pnal + '12';
// 		    			var cual = 'i1r2c' + pnal + '13';
// 						$(this).find(':input,select').each(function(){
// 							switch($(this).attr('name')){
// 								case vacNoCubCa:{
// 									var vnc = parseInt($('[name="'+ vacNoCub +'"]').val());
// 									if ( vnc > 0){
// 										if( $(this).val() == '' ){
// 											retorno += 1;
// 										}
// 									}
// 								}break;
								
// 								case cual:{
// 									if( $(this).val() == '' ){
										
// 									}
// 								}break;
								
// 								default: {}break;
// 							}
	
// 							console.log('campo '+ $(this).attr('name') +': ' + $(this).val());   
// 						}); 
// 					});
						
				}

				// cantidad de disponibilidades agregadas
				$('#C1_numdisp').val( $('#listDisForm').children().length );
				
				return retorno;
			}
			
			$(document).ready(function() {
				
				$("#capitulo1").submit(function(event) {
	                event.preventDefault();
// 	                retorno = validaFormOther();
// 	                if (retorno == 0){
		                $.ajax({
		                    url: "../persistencia/grabacapi.php",
		                    type: "POST",
		                    beforeSend: validaFormOther(),
		                    data: $(this).serialize(),
		                    success: function(dato) {
								if (retorno==0) {
									$("#btn_cont").show();
									$("#idmsg").show();
									$(function() {
										$.ajax({
										url: "../persistencia/grabactl.php",
										type: "POST",
										data: {modulo: "m1", estado: "2", numero: $("#numero").val(), capitulo: "C1"},
										success: function(dato) {
										}
									});
									});
									if ($("#idTipo").val() == "CR") {
										$("#idObs1").modal('show');
									}
								}
								else {
									//retorno = "id"+retorno;
									//$("[name='" + retorno + "']").focus();
									//document.getElementById(retorno).focus();
									$(function() {
										$.ajax({
											url: "../persistencia/grabactl.php",
											type: "POST",
											data: {modulo: "m1", estado: "1", numero: $("#numero").val(), capitulo: "C1"},
											success: function(dato) {
											}
										});
									});
								}
							}
		                });
// 	                }
	            });
			});
			
			$(document).ready(function(){
	    		$('[data-toggle="tooltip"]').tooltip();   
			});
			
			$(window).on('hidden.bs.modal', function() {
				$.ajax({
					url: "../persistencia/grabactl.php",
					type: "POST",
					data: {obser: "obs", numero: $("#numero").val(), capit: "1", observa: $("#obscrit").val()},
					success: function(dato) {
					}
				});
			});
			
			$(function() {
				$("#wc1").affix({
					offset: {top: 10}
				});
			});

			
			$(document).ready(function(){
				var $fr = $('#capitulo1');
				
				if ($('[name="i1r1c1"]:checked').val() == 2){
					$(':input,select', $fr ).each(function(){
						$(this).prop('disabled', true);
					});
					$('#btnGuardar').prop('disabled', false);
					$('#idTipo').prop('disabled', false);
					$('#numero').prop('disabled', false);
					$('[name="i1r1c1"]').prop('disabled', false);
			    }

				
				/** Variables para el manejo de las caracterizaciones dinamicas */
				var lista = $("#listDisTab"); // Div del listado de la navbar
			    var conte = $("#listDisForm"); // Div contenedor para agregar la caracterización
			    var total = $('#disTotales'); // Div del contenedor de los campos de totales
			    var carac = $('#caracterizacion'); // Div con los campos de la caracterizacion fuera del form
			    /** Variables para el manejo de las caracterizaciones dinamicas */


				
				$('[name="i1r1c1"]').on('change',function(){
					if ( parseInt($(this).val()) == 2 ){
						
						// retiramos los vicculos de la caracterización
						lista.children().each(function(){ 
							$(this).remove() 
						});

						conte.children().each(function(){ 
							$(this).remove() 
						});
						
						$(':input,select', $fr).each(function(){
							$(this).prop('disabled', true);
						});
						
						validar_totales();
					}else{
						$(':input,select', $fr ).each(function(){
							$(this).prop('disabled', false);
						});
						
						$('#idir3c9').prop('disabled', true)
					}
					
					$('#btnGuardar').prop('disabled', false);
					$('#idTipo').prop('disabled', false);
					$('#numero').prop('disabled', false);
					$('[name="i1r1c1"]').prop('disabled', false);
				});
				
				
				$('[type="checkbox"]').change(function(){
					var item = $(this);
					if(item.is(':checked')){
						item.val(1);
						if(item.attr('name') ==  'i1r3c8'){
							$('[name="i1r3c9"]').prop('disabled', false);
						}
					}else{ 
						item.val(0);
						if(item.attr('name') ==  'i1r3c8'){
							$('[name="i1r3c9"]').val('');
							$('[name="i1r3c9"]').prop('disabled', true);
						} 
					}
				});

				if ($('[name="i1r3c8"]').is(':checked')){
					$('input[name="i1r3c9"]').prop('disabled', false);
				}else{
					$('input[name="i1r3c9"]').val('');
					$('input[name="i1r3c9"]').prop('disabled', true);
				}

			/** Funcionalidad paran el maenjo de las caracterizaciones dinamicas **/
				
			    /** Habilita o deshabilita el boton de eliminar caracterizaciones */
			    if (lista.children().length > 0 && conte.children().length > 0){
			    	$('#removeDisp').prop('disabled', false);
			    	//lista.removeClass('hidden');
			    }else {
			    	$('#removeDisp').prop('disabled', true);
			    	//lista.addClass('hidden');
			    }

				/** Boton para agregar caracterizacion nueva */
			    $('#addDisp').click(function(){
			    	var x = lista.children().length + 1;
			    	var vinculo = '<li class="'+ ((x==1)?'active':'') +'"><a href="#disp'+ x +'" data-toggle="tab">Disp '+ x +'</a></li>'
//			    	var panel = '<div class="tab-pane '+ ((x==1)?'active':'') +'" id="disp'+x+'"><div class="col-xs-12"> <h3> '+ $('#tituloDisp').val() +' </h3> </div> </div>';
			    	var panel = '<div class="tab-pane '+ ((x==1)?'active':'') +'" id="disp'+x+'"> <div class="col-xs-12"> </div></div>';
			    	
			    	lista.append(vinculo);
			    	conte.append(panel)
			    	
			    	var item = carac.clone();
			    	item.removeClass('hidden');
			    	item.attr('id', 'caracteriza' + x);
			    	item.find('input, select').each(function(index, element){
			    		$(element).addClass('validar');
			    		$(element).attr('name', $(element).attr('name') + x + index);
			    	});
			    	$('#disp' + x).append(item);
			    	
			    	if (lista.length > 0 && conte.length > 0){
			    		$('#removeDisp').prop('disabled', false); 
			    		lista.removeClass('hidden');
			    	}
			    	validar_totales();
			    	
				});

				/** Boton para eliminar caracterizacion */
			    $('#removeDisp').click(function(){
			    	if (lista.children().length > 0 && conte.children().length > 0){
			    		lista.children(':last-child').remove();
			    		conte.children(':last-child').remove();
			    	}
			    	
			    	if (lista.children().length == 0 && conte.children().length == 0){
			    		//$('#removeDisp').addClass('disabled');
			    		$('#removeDisp').prop('disabled', true);
			    		lista.addClass('hidden');
			    	}

			    	validar_totales();
			    });

			    /** Funciona para validar los cambios y comportamientos de cada input */
			    $('#listDisForm').on('change', '.validar', function(){
				    
				    var $ele = $('#listDisForm');
				    //console.log($(this, $ele).parents('div .active').attr('id'));
					var pnal = $(this, $ele).parents('div .active').attr('id').substring(4);
		    		var vacAbi = 'i1r2c' + pnal + '0';
	    			var vacCub = 'i1r2c' + pnal + '8';
	    			var vacHom = 'i1r2c' + pnal + '9';
	    			var vacMuj = 'i1r2c' + pnal + '10';
	    			var vacNoCub = 'i1r2c' + pnal + '11';
	    			var vacNoCubCa = 'i1r2c' + pnal + '12';
	    			var cual = 'i1r2c' + pnal + '13';
	    			//var tvac = ($('#idi1r2ctv').val()!='') ? parseInt($('#idi1r2ctv').val()):0;
	    			//var tvac = subVacantes();
					
	    			//debugger;
	    			
	    			if( $(this).attr('name') === vacAbi){ /** interaccion con el total de vacantes por disponibilidad */
	    				var vac = parseInt($(this).val());
		    			
		    			if ( !isNaN(vac) ){
		    				//if (tvac <= parseInt($('[name="i1r1c2"]').val())){
		    					if ( vac < parseInt($('[name="'+vacCub+'"').val()) ){
			    					$('[name="'+vacCub+'"').val('0');
			    					$('[name="'+vacHom+'"').val('0');
			    					$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($('[name="'+vacHom+'"').val()) );
			    					$('[name="'+vacNoCub+'"').val( parseInt( $('[name="'+vacAbi+'"').val()) - parseInt($('[name="'+vacCub+'"').val()) ); // vacantes no cubiertas
			    				}else{
			    					$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($('[name="'+vacHom+'"').val()) );
			    					$('[name="'+vacNoCub+'"').val( vac - parseInt($('[name="'+vacCub+'"').val()) ); // vacantes no cubiertas
	
				    			}
		    					
		    					if (parseInt($('[name="'+vacNoCub+'"').val()) > 0){ // validacion para activar la seleccion de vacantes no cubiertas
		    		    			$('[name="'+vacNoCubCa+'"]').prop('disabled', false);
		    		    		}else{
		    		    			$('[name="'+vacNoCubCa+'"]').prop('disabled', true);
		    			    	}

// 		    				}else{
// 		    					$('[name="'+vacAbi+'"').val('0');
// 		    					alert('La cantidad de vacantes debe ser menor a la cantidad de vacantes totales registradas');
// 		    				}
	    					//$('[name="'+vacAbi+'"').val('0');
		    			}else{
		    				$('[name="'+vacAbi+'"').val('0');
		    				$('[name="'+vacCub+'"').val('0');
	    					$('[name="'+vacHom+'"').val('0');
	    					$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($('[name="'+vacHom+'"').val()) );
	    					$('[name="'+vacNoCub+'"').val( parseInt( $('[name="'+vacAbi+'"').val()) - parseInt($('[name="'+vacCub+'"').val()) ); // vacantes no cubiertas
		    				
	    					alert('Debe ingresar un valor numerico en el campo');
				    	}
	    			}

	    			if( $(this).attr('name') === vacCub ){ /** interaccion con el total de vacantes cubiertas por disponibilidad */
		    			var vacCu = parseInt($(this).val());
		    			if ( !isNaN(vacCu) ){
		    				if( vacCu <= parseInt($('[name="'+vacAbi+'"]').val()) ){
			    				if (vacCu >= parseInt($('[name="'+vacHom+'"').val()) ){
			    					$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($('[name="'+vacHom+'"').val()) );
			    					$('[name="'+vacNoCub+'"').val( parseInt( $('[name="'+vacAbi+'"').val()) - parseInt($('[name="'+vacCub+'"').val()) ); // vacantes no cubiertas
				    			}else {
				    				$('[name="'+vacHom+'"').val('0');
			    					$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($('[name="'+vacHom+'"').val()) );
			    					$('[name="'+vacNoCub+'"').val( parseInt( $('[name="'+vacAbi+'"').val()) - parseInt($('[name="'+vacCub+'"').val()) ); // vacantes no cubiertas
					    		}
					    		
		    					if (parseInt($('[name="'+vacNoCub+'"').val()) > 0){
		    		    			$('[name="'+vacNoCubCa+'"]').prop('disabled', false);
		    		    		}else{
		    		    			$('[name="'+vacNoCubCa+'"]').prop('disabled', true);
		    			    	}
		    					
		    				}else{
		    					$('[name="'+vacCub+'"').val('0');
		    					$('[name="'+vacHom+'"').val('0');
		    					$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($('[name="'+vacHom+'"').val()) );
		    					$('[name="'+vacNoCub+'"').val( parseInt( $('[name="'+vacAbi+'"').val()) - parseInt($('[name="'+vacCub+'"').val()) ); // vacantes no cubiertas
		    					alert('Debe ingresar un valor menor o igual al numero de vacantes abiertas');
		    				}
		    				
			    		}else{
			    			$('[name="'+vacCub+'"').val('0');
	    					$('[name="'+vacHom+'"').val('0');
	    					$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($('[name="'+vacHom+'"').val()) );
	    					$('[name="'+vacNoCub+'"').val( parseInt( $('[name="'+vacAbi+'"').val()) - parseInt($('[name="'+vacCub+'"').val()) ); // vacantes no cubiertas
	    					alert('Debe ingresar un valor numerico en el campo');
				    	}
			    		
	    				
	    				
	    			}
	    			
	    			if( $(this).attr('name') === vacHom ){ /** interaccion con el total de vacantes cubiertas por disponibilidad */
	    				var vacHo = parseInt($(this).val());
		    			if ( !isNaN(vacHo) ){
		    				if ( vacHo <= parseInt($('[name="'+vacCub+'"').val()) ){
		    					$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($(this).val()) );
		    				}else{
		    					$(this).val('0');
		    					$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($(this).val()) );
		    					alert('Debe ingresar un valor menor o igual al numero de vacantes cubiertas');
		    				}
			    		}else{
			    			$(this).val('0');
	    					$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($(this).val()) );
	    					alert('Debe ingresar un valor numerico en el campo');
				    	}
	    				
	    					
	    			}
					
					if( $(this).attr('name') === vacNoCubCa  ){
						if ($('[name="'+vacNoCubCa+'"').val() == '7'){
			    			$('[name="'+cual+'"]').prop('disabled', false);
			    			$('[name="'+cual+'"]').prop('required', true);
			    		} else {
			    			$('[name="'+cual+'"]').prop('disabled', true);
			    			$('[name="'+cual+'"]').prop('required', false);
				    	}
					}

					validar_totales();
			    });
			}); //$(document).ready()

			function subVacantes(){ /** Metodo para sumar el total de vacantes abiertas dinamicamente */
				var $ele = $('#listDisForm');
				var suma = 0;
				$('.subVac', $ele).each(function(){
					suma += ($(this).val()!='')?parseInt($(this).val()):0;
				});
				return suma;
			}
			
			function validar_totales(){
		    	/** Actualizacion de total de vacantes */
		    	var sumTotVac = 0, sumTotVacCub = 0, sumTotVacNoCub = 0;
		    	$('#listDisForm').children().each(function(){
		    		var pnal = $(this).attr('id').substring(4);
		    		var vacantes = 'i1r2c' + pnal + '0';
	    			var vacCubiertas = 'i1r2c' + pnal + '8';
	    			var vacNoCubiertas = 'i1r2c' + pnal + '11';
		    		$(this).find(':input,select').each(function(){
		    			if ($(this).attr('name') == vacantes && $(this).val() != '' ){
		    				sumTotVac += parseInt($(this).val());
		    			}
		    			if ($(this).attr('name') == vacCubiertas && $(this).val() != '' ){
		    				sumTotVacCub += parseInt($(this).val());
		    			}
		    			if ($(this).attr('name') == vacNoCubiertas && $(this).val() != '' ){
		    				sumTotVacNoCub += parseInt($(this).val());
		    			}
		    		});
		    	});
		    	$('#idi1r2ctv').val(sumTotVac);
		    	$('#idi1r2ctvcb').val(sumTotVacCub);
		    	$('#idi1r2ctvnocb').val(sumTotVacNoCub);
			}
		</script>
	</head>
	<?php
			include 'menuFuente.php';
/*			
			if ($tipousu != "FU") {
				echo "<script type='text/javascript'>";
				echo "$(function() {";
				echo "$(window).load(function(){";
			    echo "$('#avisoCrit').modal('show');";
			    echo "});});";
			    echo "</script>";
			}
*/			
		?>
		<div class="well well-sm" style="font-size: 12px; padding-top: 60px; z-index: 1;" id="wc2">
 			<?php echo $numero . "-" . $nombre?> - CAP&Iacute;TULO I - CARACTERIZAC&Oacute;N DE VACANTES ABIERTAS <?php echo $anterior . "-" . $vig . " . " . $txtEstado ?> 
 			<!-- Informacion de prueba BORRAR  --> 			
 				<?php //echo '<br/> consulta de datos: '; print_r($row); ?>
 				<?php //echo '<br/> consulta de control: '; print_r($rowCtl); ?>
 				<?php //echo '<br/>'; print_r($c1n2) ;?>
 				<?php echo '<br/>'; print_r($rowDisCont); ?>
 			<!-- Informacion de prueba BORRAR  -->
 		</div>
 		
 		<div class="container text-justify" style="font-size: 12px">
			Este m&oacute;dulo  determina la cantidad de vacantes durante el "I trimestre del año <?php echo $vig;?>" e  identifica sus caracter&iacute;sticas.s
 		</div>

		<input type="hidden" name="tipousu" id="idTipo" value="<?php echo $tipousu ?>" />
		<form class='form-horizontal' role='form' data-toggle='validator' name="capitulo1" id="capitulo1" method="post" disabled>
			<div class='container'>
				<input type="hidden" name="C1_nordemp" id="numero" value="<?php echo $numero ?>" />
				<input type="hidden" name="C1_numdisp" id="C1_numdisp" value="" />
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend>
						<h5 style='font-family: arial'><b>
							<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii1&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?>
							1. Durante el periodo de referencia
						</b></h5>
					</legend>
					
					<div class="form-group form-group-sm col-xs-12 col-sm-11 col-sm-offset-1">
						<label class="col-xs-12 col-sm-7" >¿tuvo alguna vacante abierta a candidatos no vinculados con la empresa?</label>
						<div class="col-xs-12 col-sm-2 ">
							<label class="radio-inline">
							  <input type="radio" name="i1r1c1" id="idi1r1c1si" value="1" <?php echo ($row['i1r1c1'] == 1) ? 'checked' : ''; ?> required > Si
							</label>
							<label class="radio-inline">
							  <input type="radio" name="i1r1c1" id="idi1r1c1no" value="2" <?php echo ($row['i1r1c1'] == 2) ? 'checked' : ''; ?>  > No
							</label>
						</div>
					</div>
					
					<!--div class="form-group form-group-sm col-xs-12 col-sm-11 col-sm-offset-1 ">
						<label class="col-xs-12 col-sm-4">Indique la  cantidad total  de  vacantes abiertas</label>
						<div class='col-xs-12 col-sm-3 small'>
							<input type='text' class='form-control input-sm text-center' id='idi1r1c2' name='i1r1c2' value = "<?php echo $row['i1r1c2']; ?>" maxlength="9" required />
						</div>
					</div-->
				</fieldset>
				
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend>
						<h5 style='font-family: arial'><b><?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii2&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> 
							2. Clasifique las vacantes abiertas durante el trimestre de referencia de acuerdo a las siguientes caracter&iacute;sticas: </br>
						 		&Aacute;rea funcional, M&iacute;nimo nivel educativo requerido, &Aacute;rea de formaci&oacute;n, Experiencia en meses, Modalidad de contrataci&oacute;n, Salarios u honorarios y edad:
						 </b></h5>
						 <div style="color:red;"><h6 > Nota: Si más de una vacante presenta las mismas características relacionelas en una sola fila, si alguna de ellas difiere agregue otra. </h6></div>
					</legend>
					<div class="container-fluid">
						<div class="col-xs-12 col-sm-12">
							<label for="">Este módulo  determina la cantidad de vacantes durante el "I trimestre del año 2016" e  identifica sus características.</label>
						</div>
						<div id="contenido" class="col-xs-12 col-sm-12">
							<button id="addDisp" type="button" class="btn btn-default" aria-label="Left Align">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
							
							<button id="removeDisp" type="button" class="btn btn-danger" aria-label="Left Align">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button>
						</div>
						<div id="totales" class="col-xs-12 col-sm-12">
							<p> 
							<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
								<label class="">Total Vacantes</label>
								<div class='small'>
									<input type='text' class='form-control input-sm text-right' id='idi1r2ctv' name='i1r1c2' value = "<?php echo $row['i1r1c2']; //echo $row['i1r2ctvc']?>" readonly  />
								</div>
							</div>
							<div class="col-xs-1"></div>
							<div class="form-group form-group-sm col-xs-12 col-sm-3">
								<label class="">Total Vacantes Cubiertas</label>
								<div class='small'>
									<input type='text' class='form-control input-sm text-right' id='idi1r2ctvcb' name='i1r1c3' value = "<?php echo $row['i1r1c3']; //echo $row['i1r2ctvc']?>" readonly  />
								</div>
							</div>
							<div class="col-xs-1"></div>
							<div class="form-group form-group-sm col-xs-12 col-sm-3">
								<label class="">Total Vacantes No Cubiertas</label>
								<div class='small'>
									<input type='text' class='form-control input-sm text-right' id='idi1r2ctvnocb' name='i1r1c4' value = "<?php echo $row['i1r1c4']; //echo $row['i1r2ctvc']?>" readonly  />
								</div>
							</div>
							</p>
						</div>
						<div class="col-xs-12 col-sm-12">
							<p>
								<ul id="listDisTab" class="nav nav-tabs" >
								<?php $c = 1; foreach ($rowDisLink as $displ){  ?>
									<li class="<?php echo ($c==1)?'active':''; ?>"><a href="#disp<?php echo $c;?>" data-toggle="tab">Disp <?php echo $c;?></a></li>
								<?php $c++; } ?>
								</ul>
							</p>
							<p>
								<div id="listDisForm" class="tab-content">
								<?php $z = 1; ?>
								<?php foreach ($rowDisCont as $dispc){  ?>
									<?php $ncam = 'i1r2c' . $z; ?>
									<div class="tab-pane <?php echo ($z==1)?'active':''; ?>" id="disp<?php echo $z; ?>">
										<div class="col-xs-12">
											 <div id="carateriza<?php echo $z; ?>" class="">
												<div class="container-fluid">		
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">Cantidad de vacantes abiertas</label>
														<div class='small'>
															<input type='text' class='form-control input-sm text-right subVac validar' id='' name="<?php echo $ncam; ?>0" value = "<?php echo $dispc['i1r2c1'];?>" maxlength="9"  required/>
														</div>
													</div>
													<div class="col-xs-12 col-sm-1"></div>
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">&Aacute;rea funcional</label>
														<div class='small'>
															<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>1" required>
																<option value=""> Seleccione una opción</option>
																<option value="1" <?php echo ($dispc['i1r2c2'] == 1) ? 'selected' : '';  ?> >Área de dirección general</option>
																<option value="2" <?php echo ($dispc['i1r2c2'] == 2) ? 'selected' : '';  ?> >Área de administración</option>
																<option value="3" <?php echo ($dispc['i1r2c2'] == 3) ? 'selected' : '';  ?> >Área de mercadeo/ventas</option>
																<option value="4" <?php echo ($dispc['i1r2c2'] == 4) ? 'selected' : '';  ?> >Área de producción</option>
																<option value="5" <?php echo ($dispc['i1r2c2'] == 5) ? 'selected' : '';  ?> >Área de contabilidad y finanzas</option>
																<option value="6" <?php echo ($dispc['i1r2c2'] == 6) ? 'selected' : '';  ?> >Personal de Investigación y desarrollo</option>
																<option value="7" <?php echo ($dispc['i1r2c2'] == 7) ? 'selected' : '';  ?> >Personal de apoyo</option>
															</select>								
														</div>
													</div>
													<div class="col-xs-12 col-sm-1"></div>
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">Mínimo nivel educativo requerido</label>
														<div class='small'>
															<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>2" required>
																<option value="" > Seleccione una opción</option>
																<option value="1" <?php echo ($dispc['i1r2c3'] == 1) ? 'selected' : '';  ?> >No bachiller</option>
																<option value="2" <?php echo ($dispc['i1r2c3'] == 2) ? 'selected' : '';  ?> >Educación básica secundaria (6° - 9°)</option>
																<option value="3" <?php echo ($dispc['i1r2c3'] == 3) ? 'selected' : '';  ?> >Educación media   (10° - 13°)</option>
																<option value="4" <?php echo ($dispc['i1r2c3'] == 4) ? 'selected' : '';  ?> >Técnico laboral</option>
																<option value="5" <?php echo ($dispc['i1r2c3'] == 5) ? 'selected' : '';  ?> >Técnico profesional</option>
																<option value="6" <?php echo ($dispc['i1r2c3'] == 6) ? 'selected' : '';  ?> >Tecnológo</option>
																<option value="7" <?php echo ($dispc['i1r2c3'] == 7) ? 'selected' : '';  ?> >Estudiante universitario</option>
																<option value="8" <?php echo ($dispc['i1r2c3'] == 8) ? 'selected' : '';  ?> >Profesional universitario</option>
																<option value="9" <?php echo ($dispc['i1r2c3'] == 9) ? 'selected' : '';  ?> >Especialización </option>
																<option value="10" <?php echo ($dispc['i1r2c3'] == 10) ? 'selected' : '';  ?> >Maestría</option>
																<option value="11" <?php echo ($dispc['i1r2c3'] == 11) ? 'selected' : '';  ?> >Doctorado</option>
																<option value="12" <?php echo ($dispc['i1r2c3'] == 12) ? 'selected' : '';  ?> >No requiere estudios</option>
															</select>
														</div>
													</div>
												</div>
			
												<div class="container-fluid">
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">Área de Formación</label>
														<div class='small'>
															<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>3" required>
																<option value="" > Seleccione una opción</option>
																<option value="1" <?php echo ($dispc['i1r2c4'] == 1) ? 'selected' : '';  ?> >Economía, Administración y Contaduría</option>
																<option value="2" <?php echo ($dispc['i1r2c4'] == 2) ? 'selected' : '';  ?> >Ingeniería, Arquitectura Urbanismo y afines</option>
																<option value="3" <?php echo ($dispc['i1r2c4'] == 3) ? 'selected' : '';  ?> >Ciencias Sociales y humanas</option>
																<option value="4" <?php echo ($dispc['i1r2c4'] == 4) ? 'selected' : '';  ?> >Ciencias de la educación</option>
																<option value="5" <?php echo ($dispc['i1r2c4'] == 5) ? 'selected' : '';  ?> >Ciencias de la salud</option>
																<option value="6" <?php echo ($dispc['i1r2c4'] == 6) ? 'selected' : '';  ?> >Bellas artes</option>
																<option value="7" <?php echo ($dispc['i1r2c4'] == 7) ? 'selected' : '';  ?> >Agronomía, Veterinaria</option>
																<option value="8" <?php echo ($dispc['i1r2c4'] == 8) ? 'selected' : '';  ?> >Matemáticas y ciencias naturales</option>
																<option value="9" <?php echo ($dispc['i1r2c4'] == 9) ? 'selected' : '';  ?> >No aplica</option>
															</select>
														</div>
													</div>
													<div class="col-xs-12 col-sm-1"></div>
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">Experiencia en meses</label>
														<div class='small'>
															<input type='text' class='form-control input-sm text-right validar' id='' name='<?php echo $ncam; ?>4' value = "<?php echo $dispc['i1r2c5']?>" maxlength="9" required />
														</div>
													</div>
													<div class="col-xs-12 col-sm-1"></div>
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">Modalidad de Contratación</label>
														<div class='small'>
															<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>5" required>
																<option value="" > Seleccione una opción</option>
																<option value="1" <?php echo ($dispc['i1r2c6'] == 1) ? 'selected' : '';  ?> >Término Indefinido</option>
																<option value="2" <?php echo ($dispc['i1r2c6'] == 2) ? 'selected' : '';  ?> >Término  Fijo</option>
																<option value="3" <?php echo ($dispc['i1r2c6'] == 3) ? 'selected' : '';  ?> >Prestación de servicios</option>
																<option value="4" <?php echo ($dispc['i1r2c6'] == 4) ? 'selected' : '';  ?> >Por  obra  o  labor  contratada</option>
																<option value="5" <?php echo ($dispc['i1r2c6'] == 5) ? 'selected' : '';  ?> >Ocasional ó Transitorio</option>
															</select>
														</div>
													</div>
												</div>
			
												<div class="container-fluid">
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">Salario u honorarios mensuales</label>
														<div class='small'>
															<input type='text' class='form-control input-sm text-right validar' id='' name='<?php echo $ncam; ?>6' value = "<?php echo $dispc['i1r2c7']?>" maxlength="9" required />
														</div>
													</div>
													<div class="col-xs-12 col-sm-1"></div>
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">Edad</label>
														<div class='small'>
															<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>7" required>
																<option value="" > Seleccione una opción</option>
																<option value="1" <?php echo ($dispc['i1r2c8'] == 1) ? 'selected' : '';  ?> >15 - 20</option>
																<option value="2" <?php echo ($dispc['i1r2c8'] == 2) ? 'selected' : '';  ?> >20 - 25</option>
																<option value="3" <?php echo ($dispc['i1r2c8'] == 3) ? 'selected' : '';  ?> >25 - 30</option>
																<option value="4" <?php echo ($dispc['i1r2c8'] == 4) ? 'selected' : '';  ?> >30 - 35</option>
																<option value="5" <?php echo ($dispc['i1r2c8'] == 5) ? 'selected' : '';  ?> >35 - 40</option>
																<option value="6" <?php echo ($dispc['i1r2c8'] == 6) ? 'selected' : '';  ?> >40 - 45</option>
																<option value="7" <?php echo ($dispc['i1r2c8'] == 7) ? 'selected' : '';  ?> >45 - 50</option>
																<option value="8" <?php echo ($dispc['i1r2c8'] == 8) ? 'selected' : '';  ?> >50 - 55</option>
																<option value="9" <?php echo ($dispc['i1r2c8'] == 9) ? 'selected' : '';  ?> >55 - 60</option>
																<option value="10" <?php echo ($dispc['i1r2c8'] == 10) ? 'selected' : '';  ?> >60 - 65</option>
																<option value="11" <?php echo ($dispc['i1r2c8'] == 11) ? 'selected' : '';  ?> >65 - 70</option>
																<option value="12" <?php echo ($dispc['i1r2c8'] == 12) ? 'selected' : '';  ?> >70 - 75</option>
																<option value="13" <?php echo ($dispc['i1r2c8'] == 13) ? 'selected' : '';  ?> >75 - 80</option>
																<option value="14" <?php echo ($dispc['i1r2c8'] == 14) ? 'selected' : '';  ?> >80 - 85</option>
																<option value="15" <?php echo ($dispc['i1r2c8'] == 15) ? 'selected' : '';  ?> >85 - 90</option>
																<option value="16" <?php echo ($dispc['i1r2c8'] == 16) ? 'selected' : '';  ?> >Indiferente</option>
															</select>
														</div>
													</div>
													<div class="col-xs-12 col-sm-1"></div>
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">De las vacantes ¿Cuántas logró cubrir?</label>
														<div class='small'>
															<input type='text' class='form-control input-sm text-right validar' id='' name='<?php echo $ncam; ?>8' value = "<?php echo $dispc['i1r2c9']?>" maxlength="9" required />
														</div>
													</div>
												</div>
			
												<div class="container-fluid">
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label>
														<div class='small'>
															<input type='text' class='form-control input-sm text-right validar' id='' name='<?php echo $ncam; ?>9' value = "<?php echo $dispc['i1r2c10']?>" maxlength="9" required />
														</div>
													</div>
													<div class="col-xs-12 col-sm-1"></div>
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label>
														<div class='small'>
															<input type='text' class='form-control input-sm text-right validar' id='' name='<?php echo $ncam; ?>10' value = "<?php echo $dispc['i1r2c11']?>" maxlength="9" readonly required />
														</div>
													</div>
													<div class="col-xs-12 col-sm-1"></div>
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label class="">De las vacantes ¿Cuántas NO logró cubrir? </label>
														<div class='small'>
															<input type='text' class='form-control input-sm text-right validar' id='' name='<?php echo $ncam; ?>11' value = "<?php echo $dispc['i1r2c12']?>" maxlength="9" readonly required />
														</div>
													</div>
													
												</div>
			
												<div class="container-fluid">
													<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
														<label>De las vacantes NO cubiertas ¿Cuáles fueron las causas? </label>
														<div class="small">
															<select class='form-control input-sm validar' id="" name="<?php echo $ncam; ?>12" <?php echo ($dispc['i1r2c13']>0)?'':'disabled' ?>>
																<option value="" > Seleccione una opción</option>
																<option value="1" <?php echo ($dispc['i1r2c13'] == 1) ? 'checked' : '';  ?> >La remuneración ofrecida era insuficiente</option>
																<option value="2" <?php echo ($dispc['i1r2c13'] == 2) ? 'checked' : '';  ?> >Postulantes sub-calificados</option>
																<option value="3" <?php echo ($dispc['i1r2c13'] == 3) ? 'checked' : '';  ?> >Postulantes sobre-calificados</option>
																<option value="4" <?php echo ($dispc['i1r2c13'] == 4) ? 'checked' : '';  ?> >Falta de experiencia o conocimiento específico</option>
																<option value="5" <?php echo ($dispc['i1r2c13'] == 5) ? 'checked' : '';  ?> >Los postulantes no dominaban otros idiomas</option>
																<option value="6" <?php echo ($dispc['i1r2c13'] == 6) ? 'checked' : '';  ?> >Pocos postulantes</option>
																<option value="7" <?php echo ($dispc['i1r2c13'] == 7) ? 'checked' : '';  ?> >Otra</option>
															</select>
														</div>
													</div>
													<div class="col-xs-12 col-sm-1"></div>
													<div class="form-group form-group-sm col-xs-12 col-sm-7">
														<label class="">Cual?</label>
														<input type='text' class='form-control input-sm validar' id='' name='<?php echo $ncam; ?>13' value = "<?php echo $dispc['i1r2c14']?>" <?php echo ($dispc['i1r2c13']!='')?'':'disabled' ?> />
													</div>
												</div>
											</div>
											 
											 
											 
										</div>
									</div>
								<?php $z++; } ?>
								</div>
								
							</p>
						</div>
						
						
				</fieldset>
				
				<fieldset style='border-style: solid; border-width: 1px' id="ii3" class="<?php //echo $estadoII3; ?>" >
					<legend>
						<h5 style='font-family: arial'><b>
							<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> 
							3. Para  las <?php echo $row['i1r1c2']; ?> vacantes mencionadas en el numeral 1, Seleccione  el (los) medio(s) de publicación utilizado(s):
						</b></h5>
					</legend>
					<div id="ii3contenido" class="container-fluid hidden">
						<div class="col-sx-12 text-danger"> <h4>Debe seleccionar alguno de los valores </h4> </div>
					</div>
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c1" name="i1r3c1" value="<?php echo $row['i1r3c1']?>" <?php echo ($row['i1r3c1'] == 1) ? 'checked' : ''?> >
							    Medios de comunicación (prensa,radio,tv)
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c2" name="i1r3c2" value="<?php echo $row['i1r3c2']?>" <?php echo ($row['i1r3c2'] == 1) ? 'checked' : ''?> >
							    Servicio Público de Empleo
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c3" name="i1r3c3" value="<?php echo $row['i1r3c3']?>" <?php echo ($row['i1r3c3'] == 1) ? 'checked' : ''?> >
							    Portales laborales WEB
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c4" name="i1r3c4" value="<?php echo $row['i1r3c4']?>" <?php echo ($row['i1r3c4'] == 1) ? 'checked' : ''?> >
							    Agencias / bolsas de empleo / headhunters / firmas cazatalentos
							  </label>
							</div>
						</div>
					</div>
						
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox" >
							  <label>
							    <input type="checkbox" id="i1r3c5" name="i1r3c5" value="<?php echo $row['i1r3c5']?>" <?php echo ($row['i1r3c5'] == 1) ? 'checked' : ''?> >
							    Universidades  e  instituciones educativas (oficinas de egresados)
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c6" name="i1r3c6" value="<?php echo $row['i1r3c6']?>" <?php echo ($row['i1r3c6'] == 1) ? 'checked' : ''?> >
							     Contactos no  formales (colegas, amigos, empleados)
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2 ">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c7" name="i1r3c7" value="<?php echo $row['i1r3c7']?>" <?php echo ($row['i1r3c7'] == 1) ? 'checked' : ''?> >
							    Redes sociales o aplicaciones
							  </label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-2">
							<div class="checkbox">
							  <label>
							    <input type="checkbox" id="i1r3c8" name="i1r3c8" value="<?php echo $row['i1r3c8']?>" <?php echo ($row['i1r3c8'] == 1) ? 'checked' : ''?> >
							    Otra no mencionada anteriormente
							  </label>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="col-xs-12 col-sm-1"></div>
						<div class="form-group form-group-sm col-xs-12 col-sm-12">
							<label class="">Cual?</label>
							<input type='text' class='form-control input-sm' id='idir3c9' name='i1r3c9' value = "<?php echo $row['i1r3c9']?>"  maxlength="9" />
						</div>
					</div>
				</fieldset>
				
				<fieldset style='border-style: solid; border-width: 1px' id="ii3" class="<?php //echo $estadoII3; ?>" >
					<legend>
						<h5 style='font-family: arial'><b>
							<?php //echo ($consLog ? "<a href='../administracion/listaLog.php?idl=ii3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> 
							4. De las <?php echo $row['i1r1c2']; ?> vacantes mencionadas en el numeral 1.
						</b></h5>
					</legend>
					
					<div class="container-fluid">
						<div class="form-group form-group-sm col-xs-12">
							<label class="">¿Cuántas requerían de una competencia certificada?</label>
							<input type='text' class='form-control input-sm' id='idi1r4c1' name='i1r4c1' value = "<?php echo $row['i1r4c1']?>" maxlength="9" required />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h4 style='font-family: arial'>Observaciones</h4></legend>
					<div class='col-sm-6' style='padding-bottom: 10px'>
						<textarea class='form-control' rows='2' name='observaciones' id='obsfte' <?php echo $estadObs ?>><?php echo $row['OBSERVACIONES'] ?></textarea>
					</div>
				</fieldset>
				<?php if ($grabaOK) { ?>
				<div class='form-group form-group-sm'>
					<div class='col-md-8'>
						<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Cap&iacute;tulo I Actualizado Correctamente</p>
					</div>
					<div class='col-sm-1 small pull-right' id="btn_cont" style="display: none;" >
						<!-- a href='capitulo2.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente cap&iacute;tulo' >Continuar</a-->
						<a href='../administracion/envio.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente cap&iacute;tulo'>Continuar</a>
					</div>
					<div class='col-sm-1 small pull-right'>
						<button type='submit' id="btnGuardar" class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar informaci&oacute;n Cap&iacute;tulo I'>Grabar</button>
					</div>
				</div>
				<?php } ?>
			</div>
 		</form>
 		
		<div id="idObs1" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Observaciones</h4>
					  </div>
					  <div class="modal-body">
						<textarea class='form-control' rows='2' name='observaCrit' id='obscrit'></textarea>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" id="conf">Grabar</button>
					  </div>
				</div>
			</div>
		</div>
		
		<?php //include 'modalediteas.php' ?>
		
		<!-- Contenedor de la caracterizacion -->
		<div id="caracterizacion" class="hidden">
			<div class="container-fluid">		
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Cantidad de vacantes abiertas</label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right subVac' id='' name='i1r2c' value = "0" maxlength="9"  required/>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">&Aacute;rea funcional</label>
					<div class='small'>
						<select class='form-control input-sm' id="" name="i1r2c" required>
							<option value=""> Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >Área de dirección general</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >Área de administración</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >Área de mercadeo/ventas</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >Área de producción</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >Área de contabilidad y finanzas</option>
							<option value="6" <?php //echo ($row['i1r2c'] == 6) ? 'checked' : '';  ?> >Personal de Investigación y desarrollo</option>
							<option value="7" <?php //echo ($row['i1r2c'] == 7) ? 'checked' : '';  ?> >Personal de apoyo</option>
						</select>								
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Mínimo nivel educativo requerido</label>
					<div class='small'>
						<select class='form-control input-sm' id="" name="i1r2c" required>
							<option value="" > Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >No bachiller</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >Educación básica secundaria (6° - 9°)</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >Educación media   (10° - 13°)</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >Técnico laboral</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >Técnico profesional</option>
							<option value="6" <?php //echo ($row['i1r2c'] == 6) ? 'checked' : '';  ?> >Tecnológo</option>
							<option value="7" <?php //echo ($row['i1r2c'] == 7) ? 'checked' : '';  ?> >Estudiante universitario</option>
							<option value="8" <?php //echo ($row['i1r2c'] == 8) ? 'checked' : '';  ?> >Profesional universitario</option>
							<option value="9" <?php //echo ($row['i1r2c'] == 9) ? 'checked' : '';  ?> >Especialización </option>
							<option value="10" <?php //echo ($row['i1r2c'] == 10) ? 'checked' : '';  ?> >Maestría</option>
							<option value="11" <?php //echo ($row['i1r2c'] == 11) ? 'checked' : '';  ?> >Doctorado</option>
							<option value="12" <?php //echo ($row['i1r2c'] == 12) ? 'checked' : '';  ?> >No requiere estudios</option>
						</select>
					</div>
				</div>
				
			</div>
			
			<div class="container-fluid">
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Área de Formación</label>
					<div class='small'>
						<select class='form-control input-sm' id="" name="i1r2c" required>
							<option value="" > Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >Economía, Administración y Contaduría</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >Ingeniería, Arquitectura Urbanismo y afines</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >Ciencias Sociales y humanas</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >Ciencias de la educación</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >Ciencias de la salud</option>
							<option value="6" <?php //echo ($row['i1r2c'] == 6) ? 'checked' : '';  ?> >Bellas artes</option>
							<option value="7" <?php //echo ($row['i1r2c'] == 7) ? 'checked' : '';  ?> >Agronomía, Veterinaria</option>
							<option value="8" <?php //echo ($row['i1r2c'] == 8) ? 'checked' : '';  ?> >Matemáticas y ciencias naturales</option>
							<option value="9" <?php //echo ($row['i1r2c'] == 9) ? 'checked' : '';  ?> >No aplica</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Experiencia en meses</label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right' id='' name='i1r2c' value = "<?php //echo $row['i1r2c']?>" maxlength="9" required />
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Modalidad de Contratación</label>
					<div class='small'>
						<select class='form-control input-sm' id="" name="i1r2c" required>
							<option value="" > Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >Término Indefinido</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >Término  Fijo</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >Prestación de servicios</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >Por  obra  o  labor  contratada</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >Ocasional ó Transitorio</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="container-fluid">
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Salario u honorarios mensuales</label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right' id='' name='i1r2c' value = "<?php //echo $row['i1r2c']?>" maxlength="9" required />
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Edad</label>
					<div class='small'>
						<select class='form-control input-sm' id="" name="i1r2c" required>
							<option value="" > Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >15 - 20</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >20 - 25</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >25 - 30</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >30 - 35</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >35 - 40</option>
							<option value="6" <?php //echo ($row['i1r2c'] == 6) ? 'checked' : '';  ?> >40 - 45</option>
							<option value="7" <?php //echo ($row['i1r2c'] == 7) ? 'checked' : '';  ?> >45 - 50</option>
							<option value="8" <?php //echo ($row['i1r2c'] == 8) ? 'checked' : '';  ?> >50 - 55</option>
							<option value="9" <?php //echo ($row['i1r2c'] == 9) ? 'checked' : '';  ?> >55 - 60</option>
							<option value="10" <?php //echo ($row['i1r2c'] == 10) ? 'checked' : '';  ?> >60 - 65</option>
							<option value="11" <?php //echo ($row['i1r2c'] == 11) ? 'checked' : '';  ?> >65 - 70</option>
							<option value="12" <?php //echo ($row['i1r2c'] == 12) ? 'checked' : '';  ?> >70 - 75</option>
							<option value="13" <?php //echo ($row['i1r2c'] == 13) ? 'checked' : '';  ?> >75 - 80</option>
							<option value="14" <?php //echo ($row['i1r2c'] == 14) ? 'checked' : '';  ?> >80 - 85</option>
							<option value="15" <?php //echo ($row['i1r2c'] == 15) ? 'checked' : '';  ?> >85 - 90</option>
							<option value="16" <?php //echo ($row['i1r2c'] == 16) ? 'checked' : '';  ?> >Indiferente</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">De las vacantes ¿Cuántas logró cubrir?</label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right' id='' name='i1r2c' value = "0" maxlength="9" required />
					</div>
				</div>
			</div>
			
			<div class="container-fluid">
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right' id='' name='i1r2c' value = "0" maxlength="9" required />
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right' id='' name='i1r2c' value = "0" maxlength="9" readonly required />
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">De las vacantes ¿Cuántas NO logró cubrir? </label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right' id='' name='i1r2c' value = "0" maxlength="9" readonly required />
					</div>
				</div>
				
			</div>
			
			<div class="container-fluid">
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label>De las vacantes NO cubiertas ¿Cuáles fueron las causas?</label>
					<div class="small">
						<select class='form-control input-sm ' id="" name="i1r2c" disabled>
							<option value="" > Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >La remuneración ofrecida era insuficiente</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >Postulantes sub-calificados</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >Postulantes sobre-calificados</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >Falta de experiencia o conocimiento específico</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >Los postulantes no dominaban otros idiomas</option>
							<option value="6" <?php //echo ($row['i1r2c'] == 6) ? 'checked' : '';  ?> >Pocos postulantes</option>
							<option value="7" <?php //echo ($row['i1r2c'] == 7) ? 'checked' : '';  ?> >Otra</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-7">
					<label class="">Cual?</label>
					<input type='text' class='form-control input-sm text-right' id='' name='i1r2c' value = "<?php //echo $row['i1r2c']?>" maxlength="9" disabled />
				</div>
			</div>
		</div>
		<!-- Contenedor de la caracterizacion -->
		
 	</body>
 </html> 
