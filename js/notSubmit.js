/** Evita el envio del formulario con la pulsacion de la tecla enter para los inputs*/
$(document).ready(function() {
	$('input').on('keypress', function(e) {
		if (e == 13) {
			return false;
		}
		
		if (e.which == 13) {
			return false;
		}
	});
	
	$('#listDisForm input').on('keypress', '.validar', function(e){
		if (e == 13) {
			return false;
		}
		
		if (e.which == 13) {
			return false;
		}
	});

});