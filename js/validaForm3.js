function validaForm3() {
//NUMERAL1
	retorno = "";
	var valores1 = ["iii1r1c1","iii1r2c1","iii1r3c1","iii1r4c1","iii1r4c2","iii1r5c1","iii1r5c2","iii1r6c1","iii1r6c2","iii1r7c1","iii1r7c2"];
	var valores12 = ["iii1r1c2","iii1r2c2","iii1r3c2","iii1r4c3","iii1r4c4","iii1r5c3","iii1r5c4","iii1r6c3","iii1r6c4","iii1r7c3","iii1r7c4"];
	var compara = 0;
	for (i=0; i<valores1.length; i++) {
		compara = parseInt(compara)+parseInt(document.capitulo3[valores1[i]].value);
	}
	if (parseInt(compara) != parseInt(document.capitulo3.iii1r8c1.value)) {
		retorno = "iii1r8c1";
		alert("Por favor diligencie el campo NUMERAL 1 Revisar que el total concuerde con la sumatoria de los \xEDtems, verifique que todos los campos est\xE9n registrados con el valor reportado o el n\xFAmero cero si no ha realizado inversi\xF3n en alguno de estos.");
		return retorno;
	}
	var compara = 0;
	for (i=0; i<valores12.length; i++) {
		compara = parseInt(compara)+parseInt(document.capitulo3[valores12[i]].value);
	}
	if (parseInt(compara) != parseInt(document.capitulo3.iii1r8c2.value)) {
		retorno = "iii1r8c2";
		alert("Por favor diligencie el campo NUMERAL 1 Revisar que el total concuerde con la sumatoria de los \xEDtems, verifique que todos los campos est\xE9n registrados con el valor reportado o el n\xFAmero cero si no ha realizado inversi\xF3n en alguno de estos.");
		return retorno;
	}
	if (parseInt(document.capitulo3.iii1r8c1.value) != parseInt(document.getElementById("idii1r10c1").value)) {
		alert("Total numeral 1 columna 1 es diferente de Total Capítulo 2 numeral 1 columna 1");
		retorno = "iii1r8c1";
		return retorno;
	}
	if (parseInt(document.capitulo3.iii1r8c2.value) != parseInt(document.getElementById("idii1r10c2").value)) {
		alert("Total numeral 1 columna 2 es diferente de Total Capítulo 2 numeral 1 columna 2");
		retorno = "iii1r8c2";
		return retorno;
	}
//NUMERAL2
	var valores2 = ["iii2r1c1","iii2r2c1","iii2r3c1","iii2r4c1","iii2r5c1","iii2r6c1","iii2r7c1","iii2r8c1","iii2r9c1"];
	var compara = 0; var sumar = false;
	for (i=0; i<valores2.length; i++) {
		if (document.capitulo3[valores2[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo3[valores2[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo3.iii2r10c1.value)) {
			retorno = "iii2r10c1";
			alert("NUMERAL 2: " + document.getElementById("txtn210").textContent.trim() + " INVALIDO");
			return retorno;
		}
		if (parseInt(document.capitulo3.iii2r10c1.value) != parseInt(document.capitulo3.iii1r3c1.value)) {
			retorno = "iii2r10c1";
			alert("NUMERAL 2: " + document.getElementById("txtn210").textContent.trim() + " debe ser igual a renglon 3 del numeral 1");
			return retorno;
		}
	}
	var valores22 = ["iii2r1c2","iii2r2c2","iii2r3c2","iii2r4c2","iii2r5c2","iii2r6c2","iii2r7c2","iii2r8c2","iii2r9c2"];
	var compara = 0; var sumar = false;
	for (i=0; i<valores22.length; i++) {
		if (document.capitulo3[valores22[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo3[valores22[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo3.iii2r10c2.value)) {
			retorno = "iii2r10c2";
			alert("NUMERAL 2: " + document.getElementById("txtn210").textContent.trim() + " INVALIDO");
			return retorno;
		}
		if (parseInt(document.capitulo3.iii2r10c2.value) != parseInt(document.capitulo3.iii1r3c2.value)) {
			retorno = "iii2r10c2";
			alert("NUMERAL 2: " + document.getElementById("txtn210").textContent.trim() + " debe ser igual a renglon 3 del numeral 1");
			return retorno;
		}
	}
//NUMERAL 3
	if (document.capitulo3.iii3r1c1[0].disabled == false) {
		if (document.capitulo3.iii3r1c1.value == "") {
			retorno = "iii3r1c1";
			alert("NUMERAL 3 DILIGENCIAR: "+document.getElementById("txtn31").textContent.trim());
			return retorno;
		}
	}
//NUMERAL 4
	if (document.getElementById("iii4").disabled == false) {
		var valores4 = ["iii4r1c1","iii4r2c1","iii4r3c1","iii4r4c1","iii4r5c1","iii4r6c1"];
		var textos4 = ["txtn41","txtn42","txtn43","txtn44","txtn45","txtn46"];
		for (i=0; i<valores4.length; i++) {
			if (document.capitulo3[valores4[i]].value == "") {
				retorno = valores4[i];
				alert("NUMERAL 4 DILIGENCIAR: "+document.getElementById(textos4[i]).textContent.trim());
				return retorno;
			}
		}
	}
//NUMERAL 5	
	if (document.capitulo3.iii5r1c1[0].disabled == false) {
		if (document.capitulo3.iii5r1c1.value == "") {
			retorno = "iii5r1c1";
			alert("NUMERAL 5 DILIGENCIAR: "+document.getElementById("txtn51").textContent.trim());
			return retorno;
		}
	}
//NUMERAL 6
	if (document.getElementById("iii6").disabled == false) {
		var valores61 = ["iii6r1c1","iii6r2c1","iii6r3c1","iii6r4c1","iii6r5c1","iii6r6c1","iii6r7c1"];
		var valores62 = ["iii6r1c2","iii6r2c2","iii6r3c2","iii6r4c2","iii6r5c2","iii6r6c2","iii6r7c2"];
		if (document.capitulo3.iii6r8c1.checked == false) {
			var nocheck = true;
			for (i=0; i<valores61.length; i++) {
				if (document.capitulo3[valores61[i]].checked == true) {
					nocheck = false;
					break;
				}
			}
			if (nocheck) {
				retorno = "iii6r1c1";
				alert("NUMERAL 6 COLUMNA 1 Debe diligenciar alguna de las opciones");
				return retorno;
			}
		}
		if (document.capitulo3.iii6r8c2.checked == false) {
			var nocheck = true;
			for (i=0; i<valores62.length; i++) {
				if (document.capitulo3[valores62[i]].checked == true) {
					nocheck = false;
					break;
				}
			}
			if (nocheck) {
				retorno = "iii6r1c2";
				alert("NUMERAL 6 COLUMNA 2 Debe diligenciar alguna de las opciones");
				return retorno;
			}
		}
	}
}
