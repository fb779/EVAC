function validaForm4() {
//NUMERAL1
	retorno = "";
	var valores1 = ["iv1r1c1","iv1r2c1","iv1r3c1","iv1r4c1","iv1r5c1","iv1r6c1","iv1r7c1","iv1r8c1","iv1r9c1","iv1r10c1"];
	var valores12 = ["iv1r1c2","iv1r2c2","iv1r3c2","iv1r4c2","iv1r5c2","iv1r6c2","iv1r7c2","iv1r8c2","iv1r9c2","iv1r10c2"];
	var valores13 = ["iv1r1c3","iv1r2c3","iv1r3c3","iv1r4c3","iv1r5c3","iv1r6c3","iv1r7c3","iv1r8c3","iv1r9c3","iv1r10c3"];
	var valores14 = ["iv1r1c4","iv1r2c4","iv1r3c4","iv1r4c4","iv1r5c4","iv1r6c4","iv1r7c4","iv1r8c4","iv1r9c4","iv1r10c4"];
	var textos4 = ["txtn11","txtn12","txtn13","txtn14","txtn15","txtn16","txtn17","txtn18","txtn19","txtn110"];
	for (i=0; i<valores13.length; i++) {
		if (parseInt(document.capitulo4[valores13[i]].value) > parseInt(document.capitulo4[valores1[i]].value)) {
			retorno = valores13[i];
			alert("NUMERAL 1  "+document.getElementById(textos4[i]).textContent.trim()+ " Columna 3 mayor que Columna 1");
			return retorno;
		}
	}
	for (i=0; i<valores14.length; i++) {
		if (parseInt(document.capitulo4[valores14[i]].value) > parseInt(document.capitulo4[valores12[i]].value)) {
			retorno = valores14[i];
			alert("NUMERAL 1: "+document.getElementById(textos4[i]).textContent.trim()+ " Columna 4 mayor que Columna 2");
			return retorno;
		}
	}
	var compara = 0; var sumar = false;
	for (i=0; i<valores1.length; i++) {
		if (document.capitulo4[valores1[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo4[valores1[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo4.iv1r11c1.value)) {
			retorno = "iv1r11c1";
			alert("Por favor diligencie el campo NUMERAL 1: Revisar que el total concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	
	var compara = 0; var sumar = false;
	for (i=0; i<valores12.length; i++) {
		if (document.capitulo4[valores12[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo4[valores12[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo4.iv1r11c2.value)) {
			retorno = "iv1r11c2";
			alert("Por favor diligencie el campo NUMERAL 1 Revisar que el total concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	
	var compara = 0; var sumar = false;
	for (i=0; i<valores13.length; i++) {
		if (document.capitulo4[valores13[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo4[valores13[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo4.iv1r11c3.value)) {
			retorno = "iv1r11c3";
			alert("Por favor diligencie el campo NUMERAL 1 Revisar que el total concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	
	var compara = 0; var sumar = false;
	for (i=0; i<valores14.length; i++) {
		if (document.capitulo4[valores14[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo4[valores14[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo4.iv1r11c4.value)) {
			retorno = "iv1r11c4";
			alert("Por favor diligencie el campo NUMERAL 1 Revisar la sumatoria de los ítems y verifique que todos los campos estén registrados con el valor correspondiente, si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
//NUMERAL2
	var valores2 = ["iv2r1c1","iv2r2c1","iv2r3c1","iv2r4c1","iv2r5c1","iv2r6c1","iv2r7c1","iv2r8c1","iv2r9c1","iv2r10c1","iv2r11c1","iv2r12c1","iv2r13c1","iv2r14c1","iv2r15c1","iv2r16c1","iv2r17c1","iv2r18c1","iv2r19c1","iv2r20c1","iv2r21c1","iv2r22c1","iv2r23c1","iv2r24c1","iv2r25c1","iv2r26c1","iv2r27c1","iv2r28c1","iv2r29c1","iv2r30c1","iv2r31c1","iv2r32c1","iv2r33c1"];
	var valores22 = ["iv2r1c2","iv2r2c2","iv2r3c2","iv2r4c2","iv2r5c2","iv2r6c2","iv2r7c2","iv2r8c2","iv2r9c2","iv2r10c2","iv2r11c2","iv2r12c2","iv2r13c2","iv2r14c2","iv2r15c2","iv2r16c2","iv2r17c2","iv2r18c2","iv2r19c2","iv2r20c2","iv2r21c2","iv2r22c2","iv2r23c2","iv2r24c2","iv2r25c2","iv2r26c2","iv2r27c2","iv2r28c2","iv2r29c2","iv2r30c2","iv2r31c2","iv2r32c2","iv2r33c2"];
	if (document.capitulo4.iv2r34c1.disabled == false) {
		var compara = 0; var sumar = false;
		for (i=0; i<valores2.length; i++) {
			if (document.capitulo4[valores2[i]].disabled == false) {
				compara = parseInt(compara)+parseInt(document.capitulo4[valores2[i]].value);
				sumar = true;
			}
		}
		if (sumar) {
			if (parseInt(compara) != parseInt(document.capitulo4.iv2r34c1.value)) {
				retorno = "iv2r34c1";
				alert("NUMERAL 2: " + document.getElementById("txtn234").textContent.trim() + " INVALIDO");
				return retorno;
			}
		}
		if (document.capitulo4.iv2r34c1.value != document.capitulo4.iv1r11c3.value) {
			retorno = "iv2r34c1";
			alert("NUMERAL 2: Total columna 1 debe ser igual que total columna 3 numeral 1");
			return retorno;
		}
	}
	if (document.capitulo4.iv2r34c2.disabled == false) {
		var compara = 0; var sumar = false;
		for (i=0; i<valores22.length; i++) {
			if (document.capitulo4[valores22[i]].disabled == false) {
				compara = parseInt(compara)+parseInt(document.capitulo4[valores22[i]].value);
				sumar = true;
			}
		}
		if (sumar) {
			if (parseInt(compara) != parseInt(document.capitulo4.iv2r34c2.value)) {
				retorno = "iv2r34c2";
				alert("NUMERAL 2: " + document.getElementById("txtn234").textContent.trim() + " INVALIDO");
				return retorno;
			}
		}
		if (document.capitulo4.iv2r34c2.value != document.capitulo4.iv1r11c4.value) {
			retorno = "iv2r34c2";
			alert("NUMERAL 2: Total columna 2 debe ser igual que total columna 4 numeral 1");
			return retorno;
		}
	}
//NUMERAL 3
	if (parseInt(document.capitulo4.iv3r1c1.value) > parseInt(document.capitulo4.iv1r11c1.value)) {
		retorno = "iv3r1c1";
		alert("NUMERAL 3: Valor debe ser menor o igual que total columna 1 numeral 1");
		return retorno;
	}
	if (parseInt(document.capitulo4.iv3r1c2.value) > parseInt(document.capitulo4.iv1r11c2.value)) {
		retorno = "iv3r1c2";
		alert("NUMERAL 3: Valor debe ser menor o igual que total columna 2 numeral 1");
		return retorno;
	}
//NUMERAL4
	var valores4 = ["iv4r1c1","iv4r2c1","iv4r3c1","iv4r4c1","iv4r5c1","iv4r6c1"];
	var valores42 = ["iv4r1c2","iv4r2c2","iv4r3c2","iv4r4c2","iv4r5c2","iv4r6c2"];
	var valores43 = ["iv4r7c1","iv4r8c1","iv4r9c1","iv4r10c1"];
	var valores44 = ["iv4r7c2","iv4r8c2","iv4r9c2","iv4r10c2"];
	var compara = 0; var sumar = false;
	for (i=0; i<valores4.length; i++) {
		if (document.capitulo4[valores4[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo4[valores4[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo4.iv4r11c1.value)) {
			retorno = "iv4r11c1";
			alert("NUMERAL 4: " + document.getElementById("txtn411").textContent.trim() + " INVALIDO");
			return retorno;
		}
	}
	
	var compara = 0; var sumar = false;
	for (i=0; i<valores42.length; i++) {
		if (document.capitulo4[valores42[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo4[valores42[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo4.iv4r11c2.value)) {
			retorno = "iv4r11c2";
			alert("NUMERAL 4: " + document.getElementById("txtn411").textContent.trim() + " INVALIDO");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r1c1.disabled == false) {
		if ((parseInt(document.capitulo4.iv4r1c1.value)+parseInt(document.capitulo4.iv4r1c2.value))!=parseInt(document.capitulo4.iv4r1c3.value)) {
			retorno = "iv4r1c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r2c1.disabled == false) {
		if ((parseInt(document.capitulo4.iv4r2c1.value)+parseInt(document.capitulo4.iv4r2c2.value))!=parseInt(document.capitulo4.iv4r2c3.value)) {
			retorno = "iv4r2c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r3c1.disabled == false) {
		if ((parseInt(document.capitulo4.iv4r3c1.value)+parseInt(document.capitulo4.iv4r3c2.value))!=parseInt(document.capitulo4.iv4r3c3.value)) {
			retorno = "iv4r3c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r4c1.disabled == false) {
		if ((parseInt(document.capitulo4.iv4r4c1.value)+parseInt(document.capitulo4.iv4r4c2.value))!=parseInt(document.capitulo4.iv4r4c3.value)) {
			retorno = "iv4r4c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r5c1.disabled == false) {
		if ((parseInt(document.capitulo4.iv4r5c1.value)+parseInt(document.capitulo4.iv4r5c2.value))!=parseInt(document.capitulo4.iv4r5c3.value)) {
			retorno = "iv4r5c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r6c1.disabled == false) {
		if ((parseInt(document.capitulo4.iv4r6c1.value)+parseInt(document.capitulo4.iv4r6c2.value))!=parseInt(document.capitulo4.iv4r6c3.value)) {
			retorno = "iv4r6c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r7c1.disabled == false) {
		if (isNaN(parseInt(document.capitulo4.iv4r7c1.value))) {
			v1=0;
		}
		else {
			v1=parseInt(document.capitulo4.iv4r7c1.value);
		}
		if (isNaN(parseInt(document.capitulo4.iv4r7c2.value))) {
			v2=0;
		}
		else {
			v2=parseInt(document.capitulo4.iv4r7c2.value);
		}
		if (v1+v2!=parseInt(document.capitulo4.iv4r7c3.value)) {
			retorno = "iv4r7c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r8c1.disabled == false) {
		if (isNaN(parseInt(document.capitulo4.iv4r8c1.value))) {
			v1=0;
		}
		else {
			v1=parseInt(document.capitulo4.iv4r8c1.value);
		}
		if (isNaN(parseInt(document.capitulo4.iv4r8c2.value))) {
			v2=0;
		}
		else {
			v2=parseInt(document.capitulo4.iv4r8c2.value);
		}
		if (v1+v2!=parseInt(document.capitulo4.iv4r8c3.value)) {
			retorno = "iv4r8c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r9c1.disabled == false) {
		if (isNaN(parseInt(document.capitulo4.iv4r9c1.value))) {
			v1=0;
		}
		else {
			v1=parseInt(document.capitulo4.iv4r9c1.value);
		}
		if (isNaN(parseInt(document.capitulo4.iv4r9c2.value))) {
			v2=0;
		}
		else {
			v2=parseInt(document.capitulo4.iv4r9c2.value);
		}
		if (v1+v2!=parseInt(document.capitulo4.iv4r9c3.value)) {
			retorno = "iv4r9c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r10c1.disabled == false) {
		if (isNaN(parseInt(document.capitulo4.iv4r10c1.value))) {
			v1=0;
		}
		else {
			v1=parseInt(document.capitulo4.iv4r10c1.value);
		}
		if (isNaN(parseInt(document.capitulo4.iv4r10c2.value))) {
			v2=0;
		}
		else {
			v2=parseInt(document.capitulo4.iv4r10c2.value);
		}
		if (v1+v2!=parseInt(document.capitulo4.iv4r10c3.value)) {
			retorno = "iv4r10c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r11c1.disabled == false) {
		if ((parseInt(document.capitulo4.iv4r11c1.value)+parseInt(document.capitulo4.iv4r11c2.value))!=parseInt(document.capitulo4.iv4r11c3.value)) {
			retorno = "iv4r11c3";
			alert("Por favor diligencie el campo NUMERAL 4 Revisar que el total de fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
			return retorno;
		}
	}
	var compara = 0; var sumar = false;
	for (i=0; i<valores43.length; i++) {
		if (document.capitulo4[valores43[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo4[valores43[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo4.iv4r6c1.value)) {
			retorno = "iv4r6c1";
			alert("NUMERAL 4: " + document.getElementById("txtn46").textContent.trim() + " INVALIDO");
			return retorno;
		}
	}
	var compara = 0; var sumar = false;
	for (i=0; i<valores44.length; i++) {
		if (document.capitulo4[valores44[i]].disabled == false) {
			compara = parseInt(compara)+parseInt(document.capitulo4[valores44[i]].value);
			sumar = true;
		}
	}
	if (sumar) {
		if (parseInt(compara) != parseInt(document.capitulo4.iv4r6c2.value)) {
			retorno = "iv4r6c2";
			alert("NUMERAL 4: " + document.getElementById("txtn46").textContent.trim() + " INVALIDO");
			return retorno;
		}
	}
	if (document.capitulo4.iv4r11c3.disabled == false) {
		if (document.capitulo4.iv4r11c3.value != document.capitulo4.iv1r11c4.value) {
			retorno = "iv4r11c3";
			alert("NUMERAL 4: "+document.getElementById("txtn411").textContent.trim()+ "debe ser igual a numeral 1 total columna 4");
			return retorno;
		}
	}
//NUMERAL 5	
	if (document.getElementById("iv5").disabled == false) {
		if (document.capitulo4.iv5r1c1.value=="") {
			retorno = "iv5r1c1";
			alert("NUMERAL 5: DILIGENCIAR "+document.getElementById("txtn51").textContent.trim());
			return retorno;
		}
		if (document.capitulo4.iv5r1c1.value=="1") {
			if (document.capitulo4.iv5r1c2.value==0 && document.capitulo4.iv5r1c3.value==0) {
				retorno = "iv5r1c2";
				alert("NUMERAL 5: DILIGENCIAR "+document.getElementById("txtn51").textContent.trim());
				return retorno;
			}
		}
	}
//NUMERAL 6
	if (document.getElementById("iv6").disabled == false) {
		var valores6 = ["iv6r1c1","iv6r2c1","iv6r3c1","iv6r4c1","iv6r5c1","iv6r6c1","iv6r7c1"];
		var textos6 = ["txtn61","txtn62","txtn63","txtn64","txtn65","txtn66","txtn67"];
		var compara = 0; var sumar = false;
		for (i=0; i<valores6.length; i++) {
			if (document.capitulo4[valores6[i]].disabled == false) {
				compara = parseInt(compara)+parseInt(document.capitulo4[valores6[i]].value);
				sumar = true;
			}
		}
		if (sumar) {
			if (parseInt(compara) != parseInt(document.capitulo4.iv6r8c1.value)) {
				retorno = "iv6r8c1";
				alert("NUMERAL 6: " + document.getElementById("txtn68").textContent.trim() + " INVALIDO");
				return retorno;
			}
		}
		var valores62 = ["iv6r1c2","iv6r2c2","iv6r3c2","iv6r4c2","iv6r5c2","iv6r6c2","iv6r7c2"];
		var compara = 0; var sumar = false;
		for (i=0; i<valores62.length; i++) {
			if (document.capitulo4[valores62[i]].disabled == false) {
				compara = parseInt(compara)+parseInt(document.capitulo4[valores62[i]].value);
				sumar = true;
			}
		}
		if (sumar) {
			if (parseInt(compara) != parseInt(document.capitulo4.iv6r8c2.value)) {
				retorno = "iv6r8c2";
				alert("NUMERAL 6: " + document.getElementById("txtn68").textContent.trim() + " INVALIDO");
				return retorno;
			}
		}
		if (document.capitulo4.iv6r1c1.disabled == false) {
			if ((parseInt(document.capitulo4.iv6r1c1.value)+parseInt(document.capitulo4.iv6r1c2.value))!=parseInt(document.capitulo4.iv6r1c3.value)) {
				retorno = "iv6r1c3";
				alert("Por favor diligencie el campo NUMERAL 6 Revisar que el total de la fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
				return retorno;
			}
		}
		if (document.capitulo4.iv6r2c1.disabled == false) {
			if ((parseInt(document.capitulo4.iv6r2c1.value)+parseInt(document.capitulo4.iv6r2c2.value))!=parseInt(document.capitulo4.iv6r2c3.value)) {
				retorno = "iv6r2c3";
				alert("Por favor diligencie el campo NUMERAL 6 Revisar que el total de la fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
				return retorno;
			}
		}
		if (document.capitulo4.iv6r3c1.disabled == false) {
			if ((parseInt(document.capitulo4.iv6r3c1.value)+parseInt(document.capitulo4.iv6r3c2.value))!=parseInt(document.capitulo4.iv6r3c3.value)) {
				retorno = "iv6r3c3";
				alert("Por favor diligencie el campo NUMERAL 6 Revisar que el total de la fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
				return retorno;
			}
		}
		if (document.capitulo4.iv6r4c1.disabled == false) {
			if ((parseInt(document.capitulo4.iv6r4c1.value)+parseInt(document.capitulo4.iv6r4c2.value))!=parseInt(document.capitulo4.iv6r4c3.value)) {
				retorno = "iv6r4c3";
				alert("Por favor diligencie el campo NUMERAL 6 Revisar que el total de la fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
				return retorno;
			}
		}
		if (document.capitulo4.iv6r5c1.disabled == false) {
			if ((parseInt(document.capitulo4.iv6r5c1.value)+parseInt(document.capitulo4.iv6r5c2.value))!=parseInt(document.capitulo4.iv6r5c3.value)) {
				retorno = "iv6r5c3";
				alert("Por favor diligencie el campo NUMERAL 6 Revisar que el total de la fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
				return retorno;
			}
		}
		if (document.capitulo4.iv6r6c1.disabled == false) {
			if ((parseInt(document.capitulo4.iv6r6c1.value)+parseInt(document.capitulo4.iv6r6c2.value))!=parseInt(document.capitulo4.iv6r6c3.value)) {
				retorno = "iv6r6c3";
				alert("Por favor diligencie el campo NUMERAL 6 Revisar que el total de la fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
				return retorno;
			}
		}
		if (document.capitulo4.iv6r7c1.disabled == false) {
			if ((parseInt(document.capitulo4.iv6r7c1.value)+parseInt(document.capitulo4.iv6r7c2.value))!=parseInt(document.capitulo4.iv6r7c3.value)) {
				retorno = "iv6r7c3";
				alert("Por favor diligencie el campo NUMERAL 6 Revisar que el total de la fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
				return retorno;
			}
		}
		if (document.capitulo4.iv6r8c1.disabled == false) {
			if ((parseInt(document.capitulo4.iv6r8c1.value)+parseInt(document.capitulo4.iv6r8c2.value))!=parseInt(document.capitulo4.iv6r8c3.value)) {
				retorno = "iv6r8c3";
				alert("Por favor diligencie el campo NUMERAL 6 Revisar que el total de la fila concuerde con la sumatoria de los ítems, verifique que todos los campos estén registrados con el valor reportado o si no ha involucrado personal registre cero (0).");
				return retorno;
			}
			
			if(parseInt(document.capitulo4.iv6r8c1.value) > parseInt(document.capitulo4.iv4r11c1.value)){
				retorno = "iv6r8c1";
				alert("El total hombres de la pregunta 6 debe ser inferior al total hombres de la pregunta 4.");
				return retorno;
			}
		}
		
		if (document.capitulo4.iv6r8c2.disabled == false) {
			if(parseInt(document.capitulo4.iv6r8c2.value) > parseInt(document.capitulo4.iv4r11c2.value)){
				retorno = "iv6r8c2";
				alert("El total mujeres de la pregunta 6 debe ser inferior al total mujeres de la pregunta 4.");
				return retorno;
			}
		}
		
		if (document.capitulo4.iv6r8c3.disabled == false) {
			if ((parseInt(document.capitulo4.iv1r1c4.value)+parseInt(document.capitulo4.iv1r2c4.value)+parseInt(document.capitulo4.iv1r3c4.value)+parseInt(document.capitulo4.iv1r4c4.value)+parseInt(document.capitulo4.iv1r5c4.value)+parseInt(document.capitulo4.iv1r6c4.value))!=parseInt(document.capitulo4.iv6r8c3.value)) {
				retorno = "iv6r8c3";
				alert("NUMERAL 6: " + document.getElementById("txtn68").textContent.trim() + " Debe se igual que suma numeral 1 columna 4 renglones 1 a 6");
				return retorno;
			}
		}
	}
//NUMERAL 7
	if (document.getElementById("iv7").disabled == false) {
		var valores7 = ["iv7r1c1","iv7r2c1","iv7r3c1","iv7r4c1"];
		var valores72 = ["iv7r1c2","iv7r2c2","iv7r3c2","iv7r4c2"];
		var compara = 0; var sumar = false;
		for (i=0; i<valores7.length; i++) {
			if (document.capitulo4[valores7[i]].disabled == false) {
				compara = parseInt(compara)+parseInt(document.capitulo4[valores7[i]].value);
				sumar = true;
			}
		}
		if (sumar) {
			if (parseInt(compara) != parseInt(document.capitulo4.iv7r5c1.value) || parseInt(document.capitulo4.iv7r5c1.value) == 0) {
				retorno = "iv7r5c1";
				alert("NUMERAL 7: " + document.getElementById("txtn75").textContent.trim() + " INVALIDO o IGUAL A CERO");
				return retorno;
			}
		}
		var compara = 0; var sumar = false;
		for (i=0; i<valores72.length; i++) {
			if (document.capitulo4[valores72[i]].disabled == false) {
				compara = parseInt(compara)+parseInt(document.capitulo4[valores72[i]].value);
				sumar = true;
			}
		}
		if (sumar) {
			if (parseInt(compara) != parseInt(document.capitulo4.iv7r5c2.value) || parseInt(document.capitulo4.iv7r5c2.value) == 0) {
				retorno = "iv7r5c2";
				alert("NUMERAL 7: " + document.getElementById("txtn75").textContent.trim() + " INVALIDO o IGUAL A CERO");
				return retorno;
			}
		}
	}
}
