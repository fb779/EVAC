$(document).ready(function() {
	$('#newPeriodo').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */

		$.ajax({
			url: 'crearPeriodo.php',
			type: 'POST',
			dataType: 'json',
			data: {param1: 'value1'},
		})
		.done(function(data, textStatus, jqXHR) {
			debugger;
			if (data.success){
				location.reload();
			}
			console.log("success");
		})
		.fail(function(jqXHR, textStatus, errorThrown) {
			debugger;
			console.log("error");
		});
		
	});
});