$(document).ready(function(){
	/** Definicion de variables  */
		/** Variables para el manejo de las caracterizaciones dinamicas */
		var lista = $("#listDisTab"); // Div del listado de la navbar
		var conte = $("#listDisForm"); // Div contenedor para agregar la caracterización
		var total = $('#disTotales'); // Div del contenedor de los campos de totales
		var carac = $('#caracterizacion'); // Div con los campos de la caracterizacion fuera del form
		/** Otras variables */
		var $fr = $('#capitulo1'); // Form formulario
		var color = '#a94442'; // Define el color para el borde del campo
		var $btnGuardar = $('#btnGuardar'); // Boton de guardado general
		var $chk = $('#medPub .chkbx [type="checkbox"]');
	/** Definicion de variables  */

	/** Validar los campos con la carga de la pagina */
		valida_todo(); 

	/** Validacion del campo radibutton i1r1c1 */
		/** validacion del campo en la carga de la pagina */
		if ($('[name="i1r1c1"]:checked').val() == 2){
			$(':input,select',$fr).each(function(){
				$(this).prop('disabled', true);
			});
			$btnGuardar.prop('disabled', false);
			$('#idTipo').prop('disabled', false);
			$('#numero').prop('disabled', false);
			$('[name="i1r1c1"]').prop('disabled', false);
		}

		/** Funcion que valida el cambio del radio button */
		$('[name="i1r1c1"]').on('change',function(){
			if ( parseInt($(this).val()) == 2 ){
				/** retiramos los vicculos de la caracterización */
				lista.children().each(function(){ 
					$(this).remove();
				});
				/** retiramos las caracterizaciones existentes */
				conte.children().each(function(){ 
					$(this).remove();
				});
				/**deshabilitamos todos los campos del formulario */
				$(':input,select', $fr).each(function(){
					$(this).prop('disabled', true);
				});
				
				$('#obsfte').val('');
				$('#idi1r4c1').val('');
				validar_totales();
			}else if ( parseInt($(this).val()) == 1 ) {
				/** habilitamos todos los campos del formulario */
				$(':input,select', $fr ).each(function(){
					$(this).prop('disabled', false);
				});
				$('#removeDisp').prop('disabled', true);
				$('#idi1r3c9').prop('disabled', true);
			}
			$btnGuardar.prop('disabled', false);
			$('#idTipo').prop('disabled', false);
			$('#numero').prop('disabled', false);
			$('[name="i1r1c1"]').prop('disabled', false);
			//$('#idi1r3c9').prop('disabled',true)
		});
	/** Validacion del campo radibutton i1r1c1 */

	/** Validacion de los checkbox de medios de publicacion i1r3c1-9 */
		/** Validacion de los checkbox con la carga de la pagina */
		if (!valCheckbox()){ $chk.prop('required',true); }
		else{ $chk.prop('required',false); }

		/** Validacion de los checkbox con el cambio de alguno de ellos */
		$('#medPub').on('change', '.chkbx', function(){
			$('#msCheck').children('label').remove();
			var item = $(this);
			if(item.prop('checked')){
				item.val(1);
				if(item.attr('name') ==  'i1r3c8'){
					$('[name="i1r3c9"]').prop('disabled', false);
				}
			}else{ 
				item.val('');
				if(item.attr('name') ==  'i1r3c8'){
					$('[name="i1r3c9"]').val('');
					$('[name="i1r3c9"]').parent().parent().removeClass('text-danger');
					$('[name="i1r3c9"]').parent().parent().removeClass('has-error');
					$('[name="i1r3c9"]').css('border',"");
					$('[name="i1r3c9"]').parent().parent().children('span').remove();
					$('[name="i1r3c9"]').prop('disabled', true);
				}
			}
			var $chk = $('[type="checkbox"]', '#medPub ');
			if (!valCheckbox()){	
				$chk.prop('required',true);
				$chk.parent().parent().parent().parent().addClass('has-error');
				$('#msCheck').append('<label class="col-xs-12">Debe seleccionar almeno una de las opciones</label>');
				
			}else{
				$chk.prop('required',false);
				$chk.parent().parent().parent().parent().removeClass('has-error');
				$chk.parent().parent().parent().removeClass('has-error');
			}
			
		});
		/** Valida el cambio del campo 'cual' cuando esta activo */
		$('#idi1r3c9').on('blur', function(){
			$(this).parent().parent().removeClass('text-danger');
			$(this).parent().parent().removeClass('has-error');
			$(this).css('border',"");
			$(this).parent().parent().children('span').remove();
			
			if ( $(this).val() === '' ){
				$(this).parent().parent().addClass('text-danger');
				$(this).css('border',"1px solid "+color);
				$(this).parent().parent().append('<span> Debe diligenciar el campo</span>');
			}
		});
	/** Validacion de los checkbox de medios de publicacion i1r3c1-9 */

	/** Validacion del campo certificacion i1r4c1 */
		/** Validacion del campo i1r4c1 con la carga de la pagina */
		if ($('[name="i1r3c8"]').is(':checked')){
			$('input[name="i1r3c9"]').prop('disabled', false);
		}else{
			$('[name="i1r3c9"]').val('');
			$('[name="i1r3c9"]').parent().parent().removeClass('text-danger');
			$('[name="i1r3c9"]').parent().parent().children('span').remove();
			$('[name="i1r3c9"]').prop('disabled', true);
		}
		/** Validacion del cambio de campo i1r4c1 */
		$('#idi1r4c1').on('blur', function(){
			$(this).css('border',"");
			$(this).parent().parent().removeClass('text-danger');
			$(this).parent().parent().children('span').remove();
			var val = parseInt($(this).val());
			var vac = parseInt($('#idi1r2ctv').val());
			if ( !isNaN(val) ){
				if( val > vac ){
					$(this).val('');
					$(this).css('border',"solid 0.5px "+color);
					$(this).parent().parent().addClass('text-danger');
					$(this).parent().parent().append('<span class="">El valor del campo no puede ser mayor al total de vacantes</span>');
				}
			}else{
				$(this).css('border',"solid 1px "+color);
				$(this).parent().parent().addClass('text-danger');
				$(this).parent().parent().append('<span class="">Debe ingresar un valor de 0 - 999 en el campo</span>');
			}
			
			var $chk = $('#medPub [type="checkbox"]');
			if (!valCheckbox()){
				$chk.prop('required',true);
				$chk.parent().parent().parent().parent().addClass('has-error');
				$('#msCheck').children('label').remove();
				$('#msCheck').append('<label class="col-xs-12">Debe seleccionar almeno una de las opciones</label>');
			}
		});
	/** Validacion del campo certificacion i1r4c1 */

	/** Funcionalidad paran el maenjo de las caracterizaciones dinamicas **/
		/** Habilita o deshabilita el boton de eliminar caracterizaciones en la carga de la pagina */
		if (lista.children().length > 0 && conte.children().length > 0){
			$('#removeDisp').prop('disabled', false);
			//lista.removeClass('hidden');
		}else {
			$('#removeDisp').prop('disabled', true);
			//lista.addClass('hidden');
		}

		/** Boton para agregar caracterizacion nueva */
		$('#addDisp').click(function(){
			if (validar_disponibilidad()){
				var x = lista.children().length + 1;
				var vinculo = '<li class="'+ ((x==1)?'active':'') +'"><a href="#disp'+ x +'" data-toggle="tab">Disp '+ x +'</a></li>';
				var panel = '<div class="tab-pane '+ ((x==1)?'active':'') +'" id="disp'+x+'"> <div class="col-xs-12"> <h4 class="text-danger">Todos los campos son obligatorios</h4> </div></div>';
				
				lista.append(vinculo);
				conte.append(panel);
				
				var item = carac.clone();
				item.removeClass('hidden');
				item.attr('id', 'caracteriza' + x);
				item.find('input, select').each(function(index, element){
					//$(element).addClass('validar');
					$(element).attr('name', $(element).attr('name') + x + index);
				});
				$('#disp' + x).append(item);
				
				if (lista.length > 0 && conte.length > 0){
					$btnGuardar.prop('disabled', true);
					$('#removeDisp').prop('disabled', false);
					lista.removeClass('hidden');
				}
				validar_totales();
			}		
		});
		/** Boton para eliminar caracterizacion */
		$('#removeDisp').click(function(){
			if (lista.children().length > 0 && conte.children().length > 0){
				lista.children(':last-child').remove();
				conte.children(':last-child').remove();
			}

			if (lista.children().length === 0 && conte.children().length === 0){
				//$('#removeDisp').addClass('disabled');
				$('#removeDisp').prop('disabled', true);
				lista.addClass('hidden');

			}

			validar_totales();

			
			var val = parseInt($('#idi1r4c1').val());
			var vac = parseInt($('#idi1r2ctv').val());
			if ( !isNaN(val) ){
				if( val > vac ){
					$('#idi1r4c1').val('');
					$('#idi1r4c1').css('border',"solid 0.5px "+color);
					$('#idi1r4c1').parent().parent().addClass('text-danger');
					$('#idi1r4c1').parent().parent().append('<span class="">El valor del campo no puede ser mayor al total de vacantes</span>');
				}
			}

			//validar_disponibilidad();
			valida_todo();
			
		});

		/** Funcion que valida los errores y mensajes de los campos dinamicos */
		$('#listDisForm').on('change, blur', '.validar', function(){
			$(this).css('border',"");
			$(this).parent().parent().removeClass('text-danger');
			$(this).parent().parent().children('span').remove();

			var $ele = $('#listDisForm');
			var pnal = $(this, $ele).parents('div .active').attr('id').substring(4);
			var vacAbi = 'i1r2c' + pnal + '0';
			var vacCub = 'i1r2c' + pnal + '8';
			var vacHom = 'i1r2c' + pnal + '9';
			var vacMuj = 'i1r2c' + pnal + '10';
			var vacNoCub = 'i1r2c' + pnal + '11';
			var vacNoCubCa = 'i1r2c' + pnal + '12';
			var edad = 'i1r2c' + pnal + '4';
			var sal = 'i1r2c' + pnal + '6';
			var cual = 'i1r2c' + pnal + '13';

			if( $(this).attr('name') === vacAbi){
				/** interaccion con el total de vacantes abiertas por disponibilidad */
				var vac = parseInt($(this).val());
				
				if ( !isNaN(vac) && vac > 0 ){
					if ( vac < parseInt($('[name="'+vacCub+'"').val()) ){
						$('[name="'+vacCub+'"').val('0');
						$('[name="'+vacHom+'"').val('0');
						$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($('[name="'+vacHom+'"').val()) );
						$('[name="'+vacNoCub+'"').val( parseInt( $('[name="'+vacAbi+'"').val()) - parseInt($('[name="'+vacCub+'"').val()) ); // vacantes no cubiertas
					}else if( !isNaN(parseInt($('[name="'+vacCub+'"').val())) && !isNaN(parseInt($('[name="'+vacHom+'"').val())) ){
						$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($('[name="'+vacHom+'"').val()) );
						$('[name="'+vacNoCub+'"').val( vac - parseInt($('[name="'+vacCub+'"').val()) ); // vacantes no cubiertas
					}
					
					if (parseInt($('[name="'+vacNoCub+'"').val()) > 0){ // validacion para activar la seleccion de vacantes no cubiertas
						$('[name="'+vacNoCubCa+'"]').prop('disabled', false);
						$('[name="'+vacNoCubCa+'"]').prop('required', true);
					}else{
						$('[name="'+vacNoCubCa+'"]').val('');
						$('[name="'+vacNoCubCa+'"]').parent().parent().removeClass('text-danger');
						$('[name="'+vacNoCubCa+'"]').parent().parent().children('span').remove();
						$('[name="'+vacNoCubCa+'"]').css('border',"");
						$('[name="'+vacNoCubCa+'"]').prop('disabled', true);
						$('[name="'+cual+'"]').parent().parent().removeClass('text-danger');
						$('[name="'+cual+'"]').parent().parent().children('span').remove();
						$('[name="'+cual+'"]').parent().parent().removeClass('has-error');
						$('[name="'+cual+'"]').css('border',"");
						$('[name="'+cual+'"]').prop('required', false);
						$('[name="'+cual+'"]').prop('disabled', true);
					}
				}else{
					$(this).val('');
					$('[name="'+vacCub+'"').val('');
					$('[name="'+vacHom+'"').val('');
					$('[name="'+vacMuj+'"').val('');
					$('[name="'+vacNoCub+'"').val(''); // vacantes no cubiertas

					$('[name="'+vacNoCubCa+'"]').val('');
					$('[name="'+vacNoCubCa+'"]').parent().parent().removeClass('text-danger');
					$('[name="'+vacNoCubCa+'"]').parent().parent().children('span').remove();
					$('[name="'+vacNoCubCa+'"]').css('border',"");
					$('[name="'+vacNoCubCa+'"]').prop('disabled', true);
					$('[name="'+cual+'"]').parent().parent().removeClass('text-danger');
					$('[name="'+cual+'"]').parent().parent().children('span').remove();
					$('[name="'+cual+'"]').parent().parent().removeClass('has-error');
					$('[name="'+cual+'"]').css('border',"");
					$('[name="'+cual+'"]').prop('required', false);
					$('[name="'+cual+'"]').prop('disabled', true);
					
					$(this).parent().parent().addClass('text-danger');
					$(this).css('border',"1px solid" + color);
					$(this).parent().parent().append('<span class="text-danger">Debe ingresar un valor numerico de 1 - 999 en el campo</span>');
				}
			}else if ( $(this).attr('name') === vacCub ){
				/** interaccion con el total de vacantes cubiertas por disponibilidad */
				var vacCu = parseInt($(this).val());
				if ( !isNaN(vacCu)  ){
					if( vacCu <= parseInt($('[name="'+vacAbi+'"]').val()) && !isNaN(parseInt($('[name="'+vacAbi+'"]').val()))  ){
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
							$('[name="'+vacNoCubCa+'"]').prop('required', true);
						}else{
							$('[name="'+vacNoCubCa+'"]').val('');
							$('[name="'+vacNoCubCa+'"]').parent().parent().removeClass('text-danger');
							$('[name="'+vacNoCubCa+'"]').parent().parent().children('span').remove();
							$('[name="'+vacNoCubCa+'"]').css('border',"");
							$('[name="'+vacNoCubCa+'"]').prop('disabled', true);		    		    			
							$('[name="'+cual+'"]').parent().parent().removeClass('text-danger');
							$('[name="'+cual+'"]').parent().parent().children('span').remove();
							$('[name="'+cual+'"]').parent().parent().removeClass('has-error');
							$('[name="'+cual+'"]').css('border',"");
							$('[name="'+cual+'"]').prop('required', false);
							$('[name="'+cual+'"]').prop('disabled', true);
						}
					}else{
						$(this).val('');
						$('[name="'+vacHom+'"').val('');
						$('[name="'+vacMuj+'"').val('');
						$('[name="'+vacNoCub+'"').val('');
						$('[name="'+vacNoCubCa+'"]').val('');
						$('[name="'+vacNoCubCa+'"]').parent().parent().removeClass('text-danger');
						$('[name="'+vacNoCubCa+'"]').parent().parent().children('span').remove();
						$('[name="'+vacNoCubCa+'"]').css('border',"");
						$('[name="'+vacNoCubCa+'"]').prop('disabled', true);
						$('[name="'+cual+'"]').parent().parent().removeClass('text-danger');
						$('[name="'+cual+'"]').parent().parent().children('span').remove();
						$('[name="'+cual+'"]').parent().parent().removeClass('has-error');
						$('[name="'+cual+'"]').css('border',"");
						$('[name="'+cual+'"]').prop('required', false);
						$('[name="'+cual+'"]').prop('disabled', true);
						$(this).parent().parent().addClass('text-danger');
						$(this).css('border',"1px solid" + color);
						$(this).parent().parent().append('<span>Debe ingresar un valor menor o igual al numero de vacantes abiertas</span>');
					}
					
				}else{
					$('[name="'+vacCub+'"').val('');
					$('[name="'+vacHom+'"').val('');
					$('[name="'+vacMuj+'"').val('');
					$('[name="'+vacNoCub+'"').val(''); // vacantes no cubiertas
					$('[name="'+cual+'"]').prop('disabled', true);
					$('[name="'+vacNoCubCa+'"]').prop('disabled', true);
					$(this).parent().parent().addClass('text-danger');
					$(this).css('border',"1px solid" + color);
					$(this).parent().parent().append('<span class="text-danger">Debe ingresar un valor numerico de 0 - 999 en el campo</span>');
				}
			}else if( $(this).attr('name') === vacHom ){
				/** interaccion con el total de vacantes cubiertas por hombres */
				var vacHo = parseInt($(this).val());
				if ( !isNaN(vacHo) ){
					if ( vacHo <= parseInt($('[name="'+vacCub+'"').val()) ){
						$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($(this).val()) );
					}else{
						$(this).val('');
						$('[name="'+vacMuj+'"').val( parseInt( $('[name="'+vacCub+'"').val()) - parseInt($(this).val()) );
						$(this).parent().parent().addClass('text-danger');
						$(this).css('border',"1px solid" + color);
						$(this).parent().parent().append('<span class="text-danger">Debe ingresar un valor menor o igual al numero de vacantes cubiertas</span>');
					}
				}else{
					//$(this).val('0');
					$('[name="'+vacMuj+'"').val('');
					$(this).parent().parent().addClass('text-danger');
					$(this).css('border',"1px solid" + color);
					$(this).parent().parent().append('<span class="text-danger">Debe ingresar un valor numerico de 0 - 999 en el campo</span>');
				}
			}else if( $(this).attr('name') === vacNoCubCa && $(this).val()!==''){
				/** interaccion con el campo Causas de las vacantes no cubiertas por disponibilidad */
				if ($('[name="'+vacNoCubCa+'"').val() == '7'){
					$('[name="'+cual+'"]').prop('disabled', false);
					$('[name="'+cual+'"]').prop('required', true);
				} else {
					$('[name="'+cual+'"]').val('');
					$('[name="'+cual+'"]').parent().parent().removeClass('text-danger');
					$('[name="'+cual+'"]').parent().parent().children('span').remove();
					$('[name="'+cual+'"]').parent().parent().removeClass('has-error');
					$('[name="'+cual+'"]').css('border',"");
					$('[name="'+cual+'"]').prop('required', false);
					$('[name="'+cual+'"]').prop('disabled', true);
				}
			}else{
				if($(this).val() === ''){
					$(this).parent().parent().addClass('text-danger');
					$(this).css('border',"1px solid" + color);
					if ($(this).is('select')){
						$(this).parent().parent().append('<span class="text-danger">Debe seleccionar una opcion</span>');
					}else if( $(this).attr('name') == edad ){
						$(this).parent().parent().append('<span class="text-danger">Debe ingresar un valor numerico de 0 - 999 en el campo</span>');
					}else if( $(this).attr('name') == sal ){
						$(this).parent().parent().append('<span class="text-danger">Debe ingresar un valor en el campo de 0 - 999999999 en el campo</span>');
					}else if( $(this).attr('name') == cual ){
						$(this).parent().parent().append('<span class="text-danger">El campo no puede estar vacio</span>');
					}else if( $(this).attr('name') == vacMuj ){
						$(this).parent().parent().removeClass('text-danger');
						$(this).css('border',"");
					}else if( $(this).attr('name') == vacNoCub ){
						$(this).parent().parent().removeClass('text-danger');
						$(this).css('border',"");
					}
				}
			}

			validar_totales();
			validar_disponibilidad();
		});
		/** Funcion que valida los errores y mensajes de los campos dinamicos */

		/** Funcion que lanza un modal de confirmacion para el guardado parcial de la información */
		$('#saveDisp').on('click', function(){
			// e.preventDefault();
			var hd = '<h4>Guardado de informacion parcial de disponibilidad laboral</h4>';
			var ct = ['<p><h4 class="text-danger">Las disponibilidades que no esten completas no seran guardadas</h4></p>','<p><h4>Desea guardar las disponibilidades creadas hasta el momento ?<h4></p>'];
			$('#mHeader').append(hd);
			$('#mContent').append(ct[0],ct[1]);
			$("#mNotificacion").modal();
		});

		/** Realiza el guardado parcial de las disponibilidades completamente diligenciadas */
		$("#mSave").click(function(e){
			//$("#mNotificacion").modal('hide');
			e.preventDefault();
			var $datos = $('#listDisForm');
			var $dtAct = $('#listDisForm').children('.active');
			var $campos = $(':input,select', $datos);
			var $cmps = [];

			$datos.children().each(function(){
				var $cm = $(':input,select',$(this));
				$cmps.push( $cm.serializeArray() );
			});

			if ($datos.children().length > 0){
				$.ajax({
					url: "../persistencia/parcial.php",
					type: "POST",
					dataType: "json",
					data: {'C1': $('#numero').val(),'dtSe': JSON.stringify($cmps)},
					success: function(dato) {
						var ct = ['<p>La informacion se guardo con éxito</p>','<p>La informacion no se guardo con éxito</p>'];
						if (dato.success){
							//location.reload();
							$('#mNoti').addClass('alert-success');
							$('#mNoti').append(ct[0]);
							$('#mNoti').removeClass('hidden');
							$("#mSave").addClass('hidden');

						}else{
							$('#mNoti').addClass('alert-danger');
							$('#mNoti').append(ct[1]);
							$('#mNoti').removeClass('hidden');
							$("#mSave").addClass('hidden');
						}

					},
					// error: function(xhr, status, erroThrown){
					// },
			});
			}
		});

		/** Evento de cierre del modal para la grabacion parcial */
		$("#mNotificacion").on('hidden.bs.modal', function () {
			$('#mHeader').children().remove();
			$('#mNoti').children().remove();
			$('#mContent').children().remove();
			$('#mNoti').addClass('hidden');
			$("#mSave").removeClass('hidden');
			// location.reload();
		});
	/** Funcionalidad paran el maenjo de las caracterizaciones dinamicas **/

	/** Funcion para la validacion de todos los campos del formulario */
		$('#capitulo1').find(':input, checkbox').not('.validar, [type="hidden"]').on('change', function(){
			if ($('[name="i1r1c1"]:checked').val() == 1){ valida_todo(); }
		});
	/** Funcion para la validacion de todos los campos del formulario */

	/** Funcion para el evento submit del formulario del capitulo 1 */
		$("#capitulo1").on('submit', function(event) {
			event.preventDefault();
			$('#C1_numdisp').val( $('#listDisForm').children().length);
			$.ajax({
				url: "../persistencia/grabacapi.php",
				type: "POST",
				dataType: "json",
				//beforeSend: validaFormOther,
				data: $(this).serialize(),
				success: function(dato) {
					if (dato.success) {
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
							$("#idObs1").on('shown.bs.modal', function () {
								$('#crObser').on('click', function(){
									$.ajax({
										url: "../persistencia/grabactl.php",
										type: "POST",
										data: {obser: "obs", numero: $("#numero").val(), capit: "1", observa: $("#obscrit").val()},
										success: function(dato) {

										}
									});

								});
							});
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
		});
	/** Funcion para el evento submit del formulario del capitulo 1 */

	/** Evento para lanzar un tooltip  */
		$('[data-toggle="tooltip"]').tooltip();

	/** Funciones genericas de manipulacion de los campos */
		/** Funcion que convierte letras en mayuscula */
		$('.mayusculas').on('keyup', function(){
			var v = $(this);
			v.val( v.val().toUpperCase());
		});

		/** Permitir solo numeros en los campos */
		$('.solo-numero').on('keyup', function (){
			this.value = (this.value + '').replace(/[^0-9]/g, '');
		});

		/** Evitar caracteres especiales */
		$('.no-especiales').on('keyup', function() {
			var regex = new RegExp("^[. 0-9a-zA-ZáéíóúñÁÉÍÓÚ\b]+$");
			var _this = this;

			var texto = $(_this).val();
			if(!regex.test(texto)) {
				$(_this).val(texto.substring(0, (texto.length-1)));
			}
		});

		/** Evitar caracteres especiales */
		$('.solo-letras').on('keyup', function() {
			var regex = new RegExp("^[ a-zA-ZáéíóúñÁÉÍÓÚ\b]+$");
			var _this = this;

			var texto = $(_this).val();
			if(!regex.test(texto)) {
				$(_this).val(texto.substring(0, (texto.length-1)));
			}
		});
	/** Funciones genericas de manipulacion de los campos */

	/** Funciones de validaciones */
		/** Metodo para validar la seleccion de uno de los checkbox */
		function valCheckbox(){
			var ct = 0;
			var $ch = $('#medPub [type="checkbox"]');
			$ch.each(function(){ 
				if($(this).prop('checked')){ ct ++; }
			});

			if (ct > 0){
				$ch.prop('required', false);
			}else{ 
				$ch.prop('required', true);
			}

			
			return (ct>0) ? true:false;
		}

		/** Actualizacion de total de vacantes */
		function validar_totales(){
			var sumTotVac = 0, sumTotVacCub = 0, sumTotVacNoCub = 0;
			$('#listDisForm').children().each(function(){
				var pnal = $(this).attr('id').substring(4);
				var vacantes = 'i1r2c' + pnal + '0';
				var vacCubiertas = 'i1r2c' + pnal + '8';
				var vacNoCubiertas = 'i1r2c' + pnal + '11';
				$(this).find(':input').each(function(){
					if ($(this).attr('name') == vacantes && $(this).val() !== '' ){
						sumTotVac += parseInt($(this).val());
					}
					if ($(this).attr('name') == vacCubiertas && $(this).val() !== '' ){
						sumTotVacCub += parseInt($(this).val());
					}
					if ($(this).attr('name') == vacNoCubiertas && $(this).val() !== '' ){
						sumTotVacNoCub += parseInt($(this).val());
					}
				});
			});
			$('#idi1r2ctv').val(sumTotVac);
			$('#idi1r2ctvcb').val(sumTotVacCub);
			$('#idi1r2ctvnocb').val(sumTotVacNoCub);
		}

		/** Funcion que valida los campos para las disponibilidades creadas */
		function validar_disponibilidad(){
			var $diNoMsj = $('#diNoMensaje');
			$diNoMsj.children('p').remove();
			$('#listDisForm').children().each(function(){	
				var $item = $(this);
				var con = 0;
				var pnal = $item.attr('id').substring(4);
				var vacantes = 'i1r2c' + pnal + '0';	    			
				var vacNoCubiertas = 'i1r2c' + pnal + '11';
				var vacCausa = 'i1r2c' + pnal + '12';
				var vacCual = 'i1r2c' + pnal + '13';
				var $vacNoCu = $('[name="'+vacNoCubiertas+'"]');
				var $vacCaus = $('[name="'+vacCausa+'"]');
				var $vacCual = $('[name="'+vacCual+'"]');

				$item.find(':input').each(function(){
		    		var $input = $(this);

					if ($input.val() === ''){
						if ($input.attr('name') == vacCausa && parseInt($vacNoCu.val()) > 0){
							con++;
						}else if ($input.attr('name') == vacCual && parseInt($vacCaus.val()) == 7){
							con++;
						}else if ($input.attr('name') != vacCausa && $input.attr('name') != vacCual){
							con++;
						}
					}
				});

				if (con > 0){
					// $diNoMsj.append('<p id="msj'+pnal+'" class="col-xs-3">Falta campos por diligenciar en la disponibilidad '+ pnal +'</p>');
					$diNoMsj.append('<p id="msj'+pnal+'">Falta campos por diligenciar en la disponibilidad '+ pnal +'</p>');
		    	}
			});
			
			if ($diNoMsj.children().length > 0){
				$diNoMsj.parent().removeClass('hidden');
				$btnGuardar.prop('disabled', true);
				return false;
		    }else{
		    	$diNoMsj.parent().addClass('hidden');
		    	$btnGuardar.prop('disabled', false);
		    	return true;
			}
		}

		/** Funciona para validar que los campos dinamicos solo reciban numeros */
		$('#listDisForm').on('keyup', '.validar', function(){
			if ($(this).hasClass('solo-numero')){
				this.value = (this.value + '').replace(/[^0-9]/g, '');
			}
		});

		/** Funcio que valida todos los campos del formulario */
		function valida_todo(){
			var $c = 0;
			if ( $('#idi1r3c9').val() === '' && $('#idir3c8').prop('checked') ){ $c++; }
			if ( $('#idi1r4c1').val() === '' ){ $c++; }
			//if ( $('#idi1r4c1').val() !== '' && parseInt($('#idi1r4c1').val()) > parseInt($('#idi1r2ctv').val()) ) { $('#idi1r4c1').val(''); $c++; }
			if (!valCheckbox()){ $c++; }
			if (!validar_disponibilidad()) { $c++;}
			if ($c > 0){ $btnGuardar.prop('disabled', true); }
			else { $btnGuardar.prop('disabled', false); }
		}
	/** Funciones de validaciones */
});
