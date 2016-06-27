function validaForm6() {
//NUMERAL1
//VALIDA RADIOS
	retorno = "";
	var textos = ["txtn11","txtn12","txtn13","txtn14","txtn15","txtn16","txtn17"];
	var radio1 = ["vi1r1c1","vi1r2c1","vi1r3c1","vi1r4c1","vi1r5c1","vi1r6c1","vi1r7c1"];
	for (i=0; i<radio1.length; i++) {
		if (document.capitulo6[radio1[i]].value == "") {
			retorno = radio1[i];
			alert("NUMERAL 1: DILIGENCIAR "+document.getElementById(textos[i]).textContent.trim());
			return retorno;
		}
	}
	var valores1 = ["vi1r1c2","vi1r2c2","vi1r3c2","vi1r4c2","vi1r5c2","vi1r6c2","vi1r7c2"]; 
	for (i=0; i<valores1.length; i++) {
		if (document.capitulo6[valores1[i]].disabled == false) {
			if (document.capitulo6[valores1[i]].value == "" || document.capitulo6[valores1[i]].value == 0) {
				retorno = valores1[i];
				alert("NUMERAL 1: " + document.getElementById(textos[i]).textContent.trim() + " Debe se mayor que cero(0)");
				return retorno;
			}
		}
	}
	var compara = 0; var sumar = false;
	for (i=0; i<valores1.length; i++) {
		if (document.capitulo6[valores1[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo6[valores1[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo6.vi1r8c2.value)) {
			retorno = "vi1r8c2";
			alert("NUMERAL 1: " + document.getElementById("txtn18").textContent.trim() + " INVALIDO");
			return retorno;
		}
	}
//NUMERAL 2
	var textos2 = ["txtn21","txtn22","txtn23","txtn24","txtn25","txtn26","txtn27"];
	var radio2 = ["vi2r1c1","vi2r2c1","vi2r3c1","vi2r4c1","vi2r5c1","vi2r6c1","vi2r7c1"];
	for (i=0; i<radio2.length; i++) {
		if (document.capitulo6[radio2[i]].value == "") {
			retorno = radio2[i];
			alert("NUMERAL 2: DILIGENCIAR "+document.getElementById(textos2[i]).textContent.trim());
			return retorno;
		}
	}
	var valores2 = ["vi2r1c2","vi2r2c2","vi2r3c2","vi2r4c2","vi2r5c2","vi2r6c2","vi2r7c2"]; 
	for (i=0; i<valores2.length; i++) {
		if (document.capitulo6[valores2[i]].disabled == false) {
			if (document.capitulo6[valores2[i]].value == "" || document.capitulo6[valores2[i]].value == 0) {
				retorno = valores2[i];
				alert("NUMERAL 2: " + document.getElementById(textos2[i]).textContent.trim() + " Debe se mayor que cero(0)");
				return retorno;
			}
		}
	}
	var compara = 0; var sumar = false;
	for (i=0; i<valores2.length; i++) {
		if (document.capitulo6[valores2[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo6[valores2[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo6.vi2r8c2.value)) {
			retorno = "vi2r8c2";
			alert("NUMERAL 2: " + document.getElementById("txtn28").textContent.trim() + " INVALIDO");
			return retorno;
		}
	}
//NUMERAL 3
	var textos3 = ["txtn31","txtn32","txtn33","txtn34"];
	var radio3 = ["vi3r1c1","vi3r2c1","vi3r3c1","vi3r4c1"];
	for (i=0; i<radio3.length; i++) {
		if (document.capitulo6[radio3[i]].value == "") {
			retorno = radio3[i];
			alert("NUMERAL 3: DILIGENCIAR "+document.getElementById(textos3[i]).textContent.trim());
			return retorno;
		}
	}
	var valores3 = ["vi3r1c2","vi3r2c2","vi3r3c2","vi3r4c2"]; 
	for (i=0; i<valores3.length; i++) {
		if (document.capitulo6[valores3[i]].disabled == false) {
			if (document.capitulo6[valores3[i]].value == "" || document.capitulo6[valores3[i]].value == 0) {
				retorno = valores3[i];
				alert("NUMERAL 3: " + document.getElementById(textos3[i]).textContent.trim() + " Debe se mayor que cero(0)");
				return retorno;
			}
		}
	}
	var compara = 0; var sumar = false;
	for (i=0; i<valores3.length; i++) {
		if (document.capitulo6[valores3[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo6[valores3[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo6.vi3r5c2.value)) {
			retorno = "vi3r5c2";
			alert("NUMERAL 3: " + document.getElementById("txtn35").textContent.trim() + " INVALIDO");
			return retorno;
		}
	}
//NUMERAL4
	if (document.capitulo6.vi4r1c1[0].disabled == false && document.capitulo6.vi4r1c1[1].disabled == false) {
		if (document.capitulo6.vi4r1c1.value == "") {
			retorno = "vi4r1c1";
			alert("NUMERAL 4: DILIGENCIAR "+document.getElementById("txtn41").textContent.trim());
			return retorno;
		}
	}
//NUMERAL5
	if (document.getElementById("id65").disabled == false) {
		var valores5 = ["vi5r1c1","vi5r2c1","vi5r3c1","vi5r4c1","vi5r5c1","vi5r6c1","vi5r7c1"];
		var textos5 = ["txtn51","txtn52","txtn53","txtn54","txtn55","txtn56","txtn57"];
		for (i=0; i<valores5.length; i++) {
			if (document.capitulo6[valores5[i]].value == "") {
				retorno = valores5[i];
				alert("NUMERAL 5: DILIGENCIAR "+document.getElementById(textos5[i]).textContent.trim());
				return retorno;
			}
		}
	}
//NUMERAL6
	if (document.capitulo6.vi6r1c1[0].disabled == false && document.capitulo6.vi6r1c1[1].disabled == false) {
		if (document.capitulo6.vi6r1c1.value == "") {
			retorno = "vi6r1c1";
			alert("NUMERAL 6: DILIGENCIAR "+document.getElementById("txtn61").textContent.trim());
			return retorno;
		}
	}
	if (document.capitulo6.vi6r1c2.disabled == false) {
		if (document.capitulo6.vi6r1c2.value == "" || document.capitulo6.vi6r1c2.value == 0) {
			retorno = "vi6r1c2";
			alert("NUMERAL 6: " + document.getElementById("txtn61").textContent.trim() + " Debe se mayor que cero(0)");
			return retorno;
		}
	}
//NUMERAL7
	if (document.capitulo6.vi7r1c1[0].disabled == false && document.capitulo6.vi7r1c1[1].disabled == false) {
		if (document.capitulo6.vi7r1c1.value == "") {
			retorno = "vi7r1c1";
			alert("NUMERAL 7: DILIGENCIAR "+document.getElementById("txtn71").textContent.trim());
			return retorno;
		}
	}
	if (document.capitulo6.vi7r1c2.disabled == false) {
		if (document.capitulo6.vi7r1c2.value == "" || document.capitulo6.vi7r1c2.value == 0) {
			retorno = "vi7r1c2";
			alert("NUMERAL 7: " + document.getElementById("txtn71").textContent.trim() + " Debe se mayor que cero(0)");
			return retorno;
		}
	}
//NUMERAL8
	if (document.capitulo6.vi8r1c1[0].disabled == false && document.capitulo6.vi8r1c1[1].disabled == false) {
		if (document.capitulo6.vi8r1c1.value == "") {
			retorno = "vi8r1c1";
			alert("NUMERAL 8: DILIGENCIAR "+document.getElementById("txtn81").textContent.trim());
			return retorno;
		}
	}
//NUMERAL5
	if (document.getElementById("id69").disabled == false) {
		var valores9 = ["vi9r1c1","vi9r2c1","vi9r3c1","vi9r4c1","vi9r5c1","vi9r6c1","vi9r7c1"];
		var textos9 = ["txtn91","txtn92","txtn93","txtn94","txtn95","txtn96","txtn97"];
		for (i=0; i<valores9.length; i++) {
			if (document.capitulo6[valores9[i]].value == "") {
				retorno = valores9[i];
				alert("NUMERAL 9: DILIGENCIAR "+document.getElementById(textos9[i]).textContent.trim());
				return retorno;
			}
		}
	}
}
