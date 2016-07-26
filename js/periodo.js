$(document).ready(function(){
	$('#periodo').on('change', function(e){
		e.preventDefault();
		$.ajax({
		    url: "cambioperiodo.php",
		    type: "POST",
		    dataType: "json",
		    data: {"newPer" : $(this).val()},
		    success: function(dato) {
			    if (dato.success){
					location.reload();
				}
			},
			error: function(xhr, status, erroThrown){
					
			}
		});
	});
});