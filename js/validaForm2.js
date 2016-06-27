function validaForm2() {
//NUMERAL1
	retorno = "";
	var textos1 = ["txtn11","txtn12","txtn13","txtn14","txtn15","txtn16","txtn17","txtn18","txtn19"];
	var valores1 = ["ii1r1c1","ii1r2c1","ii1r3c1","ii1r4c1","ii1r5c1","ii1r6c1","ii1r7c1","ii1r8c1","ii1r9c1"];
	for (i=0; i<valores1.length; i++) {
		if (document.capitulo2[valores1[i]].value == "") {
			retorno = valores1[i];
			alert("NUMERAL 1: DILIGENCIAR "+document.getElementById(textos1[i]).textContent.trim());
			return retorno;
		}
	}
	var valores12 = ["ii1r1c2","ii1r2c2","ii1r3c2","ii1r4c2","ii1r5c2","ii1r6c2","ii1r7c2","ii1r8c2","ii1r9c2"];
	for (i=0; i<valores12.length; i++) {
		if (document.capitulo2[valores12[i]].value == "") {
			retorno = valores12[i];
			alert("NUMERAL 1: DILIGENCIAR "+document.getElementById(textos1[i]).textContent.trim());
			return retorno;
		}
	}
	var compara = 0;
	for (i=0; i<valores1.length; i++) {
		compara = parseInt(compara)+parseInt(document.capitulo2[valores1[i]].value);
	}
	if (parseInt(compara) != parseInt(document.capitulo2.ii1r10c1.value)) {
		retorno = "ii1r10c1";
		alert("Por favor diligencie el campo NUMERAL 1: Revisar que el total concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o el número cero si no ha realizado inversión en alguno de estos.");
		return retorno;
	}
	var compara = 0;
	for (i=0; i<valores12.length; i++) {
		compara = parseInt(compara)+parseInt(document.capitulo2[valores12[i]].value);
	}
	if (parseInt(compara) != parseInt(document.capitulo2.ii1r10c2.value)) {
		retorno = "ii1r10c2";
		alert("Por favor diligencie el campo NUMERAL 1: Revisar que el total concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o el número cero si no ha realizado inversión en alguno de estos.");
		return retorno;
	}
//NUMERAL2
	if(document.capitulo2.ii2r1c1[0].disabled == false && document.capitulo2.ii2r1c1[1].disabled == false) {
		if (document.capitulo2.ii2r1c1.value == "") {
			retorno = "ii2r1c1";
			alert("NUMERAL 2: DILIGENCIAR "+document.getElementById("txtn21").textContent.trim());
			return retorno;
		}
	}
//NUMERAL3
	if (document.capitulo2.ii3r1c1.disabled == false && document.capitulo2.ii3r1c2.disabled == false) {
		if (document.capitulo2.ii3r1c1.value <= 0 && document.capitulo2.ii3r1c2.value <= 0) {
			retorno = "ii3r1c1";
			alert("NUMERAL 3: "+document.getElementById("txtn31").textContent.trim()+" DEBE SER MAYOR QUE CERO");
			return retorno;
		}
	}
	else {
		if (document.capitulo2.ii3r1c1.disabled == false && document.capitulo2.ii3r1c2.disabled == true) {
			if (document.capitulo2.ii3r1c1.value <= 0) {
				retorno = "ii3r1c1";
				alert("NUMERAL 3: "+document.getElementById("txtn31").textContent.trim()+" DEBE SER MAYOR QUE CERO");
				return retorno;
			}
		}
		else {
			if (document.capitulo2.ii3r1c1.disabled == true && document.capitulo2.ii3r1c2.disabled == false) {
				if (document.capitulo2.ii3r1c2.value <= 0) {
					retorno = "ii3r1c2";
					alert("NUMERAL 3: "+document.getElementById("txtn32").textContent.trim()+" DEBE SER MAYOR QUE CERO");
					return retorno;
				}
			}
		}
	}
	if (document.capitulo2.ii3r1c1.disabled == false) {
		if (parseInt(document.capitulo2.ii3r1c1.value) > parseInt(document.capitulo2.ii1r10c1.value)) {
			retorno = "ii3r1c1";
			alert("NUMERAL 3: "+document.getElementById("txtn31").textContent.trim()+" debe ser menor o igual que total Numeral 1");
			return retorno;
		}
	}
	if (document.capitulo2.ii3r1c2.disabled == false) {
		if (parseInt(document.capitulo2.ii3r1c2.value) > parseInt(document.capitulo2.ii1r10c2.value)) {
			retorno = "ii3r1c2";
			alert("NUMERAL 3: "+document.getElementById("txtn32").textContent.trim()+" debe ser menor o igual que total Numeral 1");
			return retorno;
		}
	}
}
