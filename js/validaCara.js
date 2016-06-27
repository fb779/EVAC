function validaCara() {
//CAPITAL SOCIAL
	retorno = "";
	var capital = parseInt(document.getElementById("idnalpub").value)+parseInt(document.getElementById("idnalpr").value)+parseInt(document.getElementById("idexpub").value)+parseInt(document.getElementById("idexpr").value);
	if (parseInt(capital)!=100) {
		alert("Por favor revise Composición del capital social debe ser igual a 100");
		retorno = "idnalpr";
		return retorno;
	}
//FECHA CONSTITUCION	
	if (document.getElementById("idfechai").value == "0000-00-00" || document.getElementById("idfechai").value == "") {
		alert("Por favor diligencie la Fecha de Constitución");
		retorno = "idfechai";
		return retorno;
	}
//REPRESENTANTE
	var nomrep = document.getElementById("idrep").value;
	var nomdil = document.getElementById("iddil").value;
	if (nomrep.length < 6) {
		alert("Nombre Representante legal INVALIDO");
		retorno = "idrep";
		return retorno;
	}
	if (nomdil.length < 6) {
		alert("Nombre persona que diligencia INVALIDO");
		retorno = "iddil";
		return retorno;
	}
}
