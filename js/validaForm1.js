function validaForm1() {
//NUMERAL1
//VALIDA RADIOS
	retorno = "";
	var textos = ["txtn11","txtn12","txtn13","txtn14","txtn15","txtn16","txtn17","txtn18","txtn19"];
	var radio1 = ["i1r1c1n","i1r2c1n","i1r3c1n","i1r1c1m","i1r2c1m","i1r3c1m","i1r4c1","i1r5c1","i1r6c1"];
	for (i=0; i<radio1.length; i++) {
		if (document.capitulo1[radio1[i]].value == "") {
			retorno = radio1[i];
			alert("Por favor diligencie el campo NUMERAL 1 indique SI o NO "+document.getElementById(textos[i]).textContent.trim());
			return retorno;
		}
	}
	var valores1 = ["i1r1c2n","i1r2c2n","i1r3c2n","i1r1c2m","i1r2c2m","i1r3c2m","i1r4c2","i1r5c2","i1r6c2"]; 
	for (i=0; i<valores1.length; i++) {
		if (document.capitulo1[valores1[i]].disabled == false) {
			if (document.capitulo1[valores1[i]].value == "" || document.capitulo1[valores1[i]].value == 0) {
				retorno = valores1[i];
				alert("Por favor NUMERAL 1 indique el numero " + document.getElementById(textos[i]).textContent.trim());
				return retorno;
			}
		}
	}
	var total11 = ["i1r1c2n","i1r2c2n","i1r3c2n"];
	var compara = 0; var sumar = false;
	for (i=0; i<total11.length; i++) {
		if (document.capitulo1[total11[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo1[total11[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo1.i1r4c2n.value)) {
			retorno = "i1r4c2n";
			alert("Por favor Verifique la sumatoria NUMERAL 1: " + document.getElementById("txttotal11").textContent.trim() + " INVALIDO");
			return retorno;
		}
	}
	var total12 = ["i1r1c2m","i1r2c2m","i1r3c2m"];
	var compara = 0; var sumar2 = false;
	for (i=0; i<total12.length; i++) {
		if (document.capitulo1[total12[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo1[total12[i]].value);
			sumar2 = true;
		}
	}
	if (sumar2) {
		if (parseInt(compara) != parseInt(document.capitulo1.i1r4c2m.value)) {
			retorno = "i1r4c2m";
			alert("Por favor verifique sumatoria NUMERAL 1: " + document.getElementById("txttotal12").textContent.trim() + " INVALIDO");
			return retorno;
		}
	}
//NUMERAL2
	if (document.getElementById("i2").disabled == false) {
		var textos2 = ["txtn21","txtn22","txtn23","txtn24","txtn25","txtn26","txtn27","txtn28","txtn29","txtn210","txtn211","txtn212","txtn213","txtn214","txtn215"];
		var radio2 = ["i2r1c1","i2r2c1","i2r3c1","i2r4c1","i2r5c1","i2r6c1","i2r7c1","i2r8c1","i2r9c1","i2r10c1","i2r11c1","i2r12c1","i2r13c1","i2r14c1","i2r15c1"];
		for (i=0; i<radio2.length; i++) {
			if (document.capitulo1[radio2[i]].value == "") {
				retorno = radio2[i];
				alert("NUMERAL 2 Indique el grado de importancia "+document.getElementById(textos2[i]).textContent.trim());
				return retorno;
			}
		}
	}
//NUMERAL3
	var valores3 = ["i3r1c1","i3r1c2","i3r2c1","i3r2c2"];
	var textos3 = ["txtn31","txtn32","txtn33","txtn33"];
	for (i=0; i<valores3.length; i++) {
		if (document.capitulo1[valores3[i]].value == "") {
			retorno = valores3[i];
			alert("Por favor diligencie el campo NUMERAL 3 indique "+document.getElementById(textos3[i]).textContent.trim() + " valor en miles de pesos");
			return retorno;
		}
	}
//NUMERAL4
	var valores4 = ["i4r1c1","i4r2c1","i4r3c1","i4r4c1"];
	var valores42 = ["i4r1c2","i4r2c2","i4r3c2","i4r4c2"];
	var textos4 = ["txtn41","txtn42","txtn43","txtn44"];
	for (i=0; i<valores4.length; i++) {
		if (document.capitulo1[valores4[i]].disabled == false) {
			if (document.capitulo1[valores4[i]].value == "") {
				retorno = valores4[i];
				alert("Por favor diligencie el campo NUMERAL4 Indique el porcentaje de las ventas nacionales de 2015 provenientes de: " + document.getElementById(textos4[i]).textContent.trim());
				return retorno;
			}
		}
	}
	for (i=0; i<valores42.length; i++) {
		if (document.capitulo1[valores42[i]].disabled == false) {
			if (document.capitulo1[valores42[i]].value == "") {
				retorno = valores42[i];
				alert("Por favor diligencie el campo NUMERAL4 Indique el porcentaje de las exportaciones de 2015 provenientes de: " + document.getElementById(textos4[i]).textContent.trim());
				return retorno;
			}
		}
	}
	for (i=0; i<valores4.length; i++) {
		if (document.capitulo1[valores4[i]].value<0 || document.capitulo1[valores4[i]].value>100) {
			retorno = valores4[i];
			alert("Por favor verifique el valor de NUMERAL4 ventas nacionales de 2015 provenientes de: " + document.getElementById(textos4[i]).textContent.trim()+ " valor debe ser mayor o igual a cero y menor o = 100");
			return retorno;
		}
	}
	for (i=0; i<valores42.length; i++) {
		if (document.capitulo1[valores42[i]].value<0 || document.capitulo1[valores42[i]].value>100) {
			retorno = valores42[i];
			alert("Por favor verifique el valor de NUMERAL4 exportaciones de 2015 provenientes de:" + document.getElementById(textos4[i]).textContent.trim()+ " valor debe ser mayor o igual a cero y menor o = 100");
			return retorno;
		}
	}
	var compara = 0; var sumar = false;
	for (i=0; i<valores4.length; i++) {
		if (document.capitulo1[valores4[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo1[valores4[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if ((parseInt(compara) != parseInt(document.capitulo1.i4r5c1.value)) || (parseInt(document.capitulo1.i4r5c1.value) < 0) || (parseInt(document.capitulo1.i4r5c1.value) != 100)) {
			retorno = "i4r5c1";
			alert("Por favor verifique los porcentajes de ventas nacionales de 2015 frente al total el cual debe ser igual a 100%");
			return retorno;
		}
	}
	var compara = 0; var sumar = false;
	for (i=0; i<valores42.length; i++) {
		if (document.capitulo1[valores42[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo1[valores42[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if ((parseInt(compara) != parseInt(document.capitulo1.i4r5c2.value)) || (parseInt(document.capitulo1.i4r5c2.value) < 0) || (parseInt(document.capitulo1.i4r5c2.value) != 100)) {
			retorno = "i4r5c2";
			alert("Por favor verifique los porcentajes de exportaciones de 2015 frente al total el cual debe ser igual a 100%");
			return retorno;
		}
	}
//NUMERAL567
	var valores567 = ["i5r1c1","i6r1c1","i7r1c1"];
	var textos567 = ["txtn51","txtn61","txtn71"];
	var numeral = "";
	for (i=0; i<valores567.length; i++) {
		if (document.capitulo1[valores567[i]][0].disabled == false && document.capitulo1[valores567[i]][1].disabled == false) {
			if (document.capitulo1[valores567[i]].value == "") {
				retorno = valores567[i];
				switch (i) {
					case 0:
						numeral = "NUMERAL 5";
						break;
					case 1:
						numeral = "NUMERAL 6";
						break;
					case 2:
						numeral = "NUMERAL 7";
						break;
				}
				alert("Por favor diligencie el campo "+numeral+" indique SI o NO " + document.getElementById(textos567[i]).textContent.trim());
				return retorno;
			}
		}
	}
	
//NUMERAL8
	var valores8 = ["i8r1c1","i8r2c1"];
	var textos8 = ["txtn81","txtn82"];
	for (i=0; i<valores8.length; i++) {
		if (document.capitulo1[valores8[i]][0].disabled == false && document.capitulo1[valores8[i]][1].disabled == false) {
			if (document.capitulo1[valores8[i]].value == "") {
				retorno = valores8[i];
				alert("Por favor diligencie el campo NUMERAL 8 indique SI o NO En el período 2014 - 2015, su empresa obtuvo algún contrato para proveer servicios o bienes a: " + document.getElementById(textos8[i]).textContent.trim());
				return retorno;
			}
		}
	}
	
//NUMERAL9
	var valores9 = ["i9r1c1","i9r2c1"];
	var textos9 = ["txtn91","txtn92"];
	for (i=0; i<valores9.length; i++) {
		if (document.capitulo1[valores9[i]][0].disabled == false && document.capitulo1[valores9[i]][1].disabled == false) {
			if (document.capitulo1[valores9[i]].value == "") {
				retorno = valores9[i];
				alert("Por favor diligencie el campo NUMERAL 9 indique SI o NO Dentro de los contratos que su empresa realizó con entidades del sector público (pregunta I.8) ¿se estableció el suministro de alguno(s) de los servicios o bienes nuevos o significativamente mejorados que su empresa introdujo durante el período 2014 - 2015 a: " + document.getElementById(textos9[i]).textContent.trim());
				return retorno;
			}
		}
	}
	
//NUMERAL10
	if (document.getElementById("i10").disabled == false) {
		var valores10 = ["i10r1c1","i10r2c1","i10r3c1","i10r4c1","i10r5c1","i10r6c1","i10r7c1","i10r8c1","i10r9c1","i10r10c1","i10r11c1","i10r12c1","i10r13c1","i10r14c1"];
		var textos10 = ["txtn101","txtn102","txtn103","txtn104","txtn105","txtn106","txtn107","txtn108","txtn109","txtn1010","txtn1011","txtn1012","txtn1013","txtn1014"];
		for (i=0; i<valores10.length; i++) {
			if (document.capitulo1[valores10[i]].value == "") {
				retorno = valores10[i];
				alert("Por favor diligencie el campo NUMERAL 10 indique el grado de importancia ALTA, MEDIA, NULA, de Obstáculos asociados a información y capacidades internas: " + document.getElementById(textos10[i]).textContent.trim());
				return retorno;
			}
		}
	}
	
/*	var nombreCampo="i1r4c2n";
	alert("VOY A VALIDAR");
	alert(document.getElementById("idi1r1c1n").checked);
	alert(document.getElementById("idi1r1c1n2").checked);
	alert(document.getElementById("idi1r1c2n").disabled);
	alert("prueba " + document.getElementsByName("i1r1c1n")[0].checked);
	var radios = document.getElementsByName("i1r1c1n");
	alert(document.capitulo1.i2r3c1.value);
	alert("Estado: "+document.capitulo1[nombreCampo].disabled);
*/
}