function validaForm5() {
//NUMERAL1
	retorno = "";
	var valores1 = ["v1r1c1","v1r2c1","v1r3c1","v1r4c1","v1r5c1","v1r6c1","v1r7c1","v1r8c1","v1r9c1","v1r10c1","v1r11c1","v1r12c1","v1r13c1","v1r14c1","v1r15c1","v1r16c1","v1r17c1","v1r18c1","v1r19c1","v1r20c1","v1r21c1","v1r22c1","v1r23c1","v1r24c1","v1r25c1","v1r26c1","v1r27c1","v1r28c1","v1r29c1","v1r30c1","v1r31c1","v1r32c1"];
	var valores2 = ["v1r9c2","v1r10c2","v1r11c2","v1r12c2","v1r13c2","v1r14c2","v1r15c2","v1r16c2","v1r17c2","v1r18c2","v1r19c2","v1r20c2","v1r21c2","v1r22c2","v1r23c2","v1r24c2","v1r25c2","v1r26c2","v1r27c2","v1r28c2","v1r29c2","v1r30c2","v1r31c2","v1r32c2"];
	var valores22 = ["v1r9c3","v1r10c3","v1r11c3","v1r12c3","v1r13c3","v1r14c3","v1r15c3","v1r16c3","v1r17c3","v1r18c3","v1r19c3","v1r20c3","v1r21c3","v1r22c3","v1r23c3","v1r24c3","v1r25c3","v1r26c3","v1r27c3","v1r28c3","v1r29c3","v1r30c3","v1r31c3","v1r32c3"];
	var textos1 = ["txtn11","txtn12","txtn13","txtn14","txtn15","txtn16","txtn17","txtn18","txtn19","txtn110","txtn111","txtn112","txtn113","txtn114","txtn115","txtn116","txtn117","txtn118","txtn119","txtn120","txtn121","txtn122","txtn123","txtn124","txtn125","txtn126","txtn127","txtn128","txtn129","txtn130","txtn131","txtn132"];
	for (i=0; i<valores1.length; i++) {
		if (document.capitulo5[valores1[i]][0].disabled == false) {
			if (document.capitulo5[valores1[i]][0].checked == false && document.capitulo5[valores1[i]][1].checked == false) {
				retorno = valores1[i];
				alert ("NUMERAL 1 DILIGENCIAR: "+document.getElementById(textos1[i]).textContent.trim());
				return retorno;
			}
		}
	}
	var letras = 8;
	for (i=0; i<valores2.length; i++) {
		if (document.capitulo5[valores2[i]].disabled == false) {
			if (document.capitulo5[valores2[i]].checked == false && document.capitulo5[valores22[i]].checked == false) {
				retorno = valores2[i];
				alert ("Por favor diligencie NUMERAL 1 Rengl�n "+document.getElementById(textos1[letras]).textContent.trim()+"  - PROCEDENCIA Nacional - Extranjera");
				return retorno;
			}
		}
		letras+=1;
	}
	
	var todoNO = true;
	for (i=0; i<valores1.length; i++){
		if (document.capitulo5[valores1[i]][0].disabled == false) {
			if (document.capitulo5[valores1[i]][0].checked == true) {
				todoNO = false;
				break;
			}
		}
	}
	
	if (todoNO) {
		retorno = "v1r1c1";
		alert("NUMERAL 1. Debe resporder por lo menos un [SI]");
		return retorno;
	}
//NUMERAL 2
	var valores2 = ["v2r1c1","v2r2c1","v2r3c1","v2r4c1","v2r5c1","v2r6c1","v2r7c1","v2r8c1","v2r9c1","v2r10c1","v2r11c1","v2r12c1","v2r13c1","v2r14c1","v2r15c1","v2r16c1","v2r17c1","v2r18c1","v2r19c1"];
	var textos2 = ["txtn21","txtn22","txtn23","txtn24","txtn25","txtn26","txtn27","txtn28","txtn29","txtn210","txtn211","txtn212","txtn213","txtn214","txtn215","txtn216","txtn217","txtn218","txtn219"];
	for (i=0; i<valores2.length; i++) {
		if (document.capitulo5[valores2[i]][0].disabled == false) {
			if (document.capitulo5[valores2[i]][0].checked == false && document.capitulo5[valores2[i]][1].checked == false) {
				retorno = valores2[i];
				alert ("NUMERAL 2 DILIGENCIAR: "+document.getElementById(textos2[i]).textContent.trim());
				return retorno;
			}
		}
	}
//NUMERAL 3
	var valores3 = ["v3r1c1","v3r2c1","v3r3c1","v3r4c1","v3r5c1","v3r6c1","v3r7c1","v3r8c1","v3r9c1","v3r10c1","v3r11c1","v3r12c1"];
	var textos3 = ["txtn31","txtn32","txtn33","txtn34","txtn35","txtn36","txtn37","txtn38","txtn39","txtn310","txtn311","txtn312"];
	var nalext0 = ["v3r1c2","v3r1c3"];
	var opcion0 = ["v3r1c4","v3r1c5","v3r1c6","v3r1c7","v3r1c8","v3r1c9","v3r1c10","v3r1c11"];
	var nalext1 = ["v3r2c2","v3r2c3"];
	var opcion1 = ["v3r2c4","v3r2c5","v3r2c6","v3r2c7","v3r2c8","v3r2c9","v3r2c10","v3r2c11"];
	var nalext2 = ["v3r3c2","v3r3c3"];
	var opcion2 = ["v3r3c4","v3r3c5","v3r3c6","v3r3c7","v3r3c8","v3r3c9","v3r3c10","v3r3c11"];
	var nalext3 = ["v3r4c2","v3r4c3"];
	var opcion3 = ["v3r4c4","v3r4c5","v3r4c6","v3r4c7","v3r4c8","v3r4c9","v3r4c10","v3r4c11"];
	var nalext4 = ["v3r5c2","v3r5c3"];
	var opcion4 = ["v3r5c4","v3r5c5","v3r5c6","v3r5c7","v3r5c8","v3r5c9","v3r5c10","v3r5c11"];
	var nalext5 = ["v3r6c2","v3r6c3"];
	var opcion5 = ["v3r6c4","v3r6c5","v3r6c6","v3r6c7","v3r6c8","v3r6c9","v3r6c10","v3r6c11"];
	var nalext6 = ["v3r7c2","v3r7c3"];
	var opcion6 = ["v3r7c4","v3r7c5","v3r7c6","v3r7c7","v3r7c8","v3r7c9","v3r7c10","v3r7c11"];
	var nalext7 = ["v3r8c2","v3r8c3"];
	var opcion7 = ["v3r8c4","v3r8c5","v3r8c6","v3r8c7","v3r8c8","v3r8c9","v3r8c10","v3r8c11"];
	var nalext8 = ["v3r9c2","v3r9c3"];
	var opcion8 = ["v3r9c4","v3r9c5","v3r9c6","v3r9c7","v3r9c8","v3r9c9","v3r9c10","v3r9c11"];
	var nalext9 = ["v3r10c2","v3r10c3"];
	var opcion9 = ["v3r10c4","v3r10c5","v3r10c6","v3r10c7","v3r10c8","v3r10c9","v3r10c10","v3r10c11"];
	var nalext10 = ["v3r11c2","v3r11c3"];
	var opcion10 = ["v3r11c4","v3r11c5","v3r11c6","v3r11c7","v3r11c8","v3r11c9","v3r11c10","v3r11c11"];
	var nalext11 = ["v3r12c2","v3r12c3"];
	var opcion11 = ["v3r12c4","v3r12c5","v3r12c6","v3r12c7","v3r12c8","v3r12c9","v3r12c10","v3r12c11"];
	for (i=0; i<valores3.length; i++) {
		/*if (document.capitulo5[valores3[i]].value == "") {
			retorno = valores3[i];
			alert ("Registro Exitoso");
			return retorno;
			//marcanal = true;
		}*/
		if (document.capitulo5[valores3[i]].value == 0) {
			if (document.capitulo5[valores3[i]].value != "") {
				retorno = valores3[i];
				alert ("NUMERAL 3 DILIGENCIAR: "+document.getElementById(textos3[i]).textContent.trim());
				return retorno;
				//marcanal = true;
			}
		}
		else {
			if (document.capitulo5[valores3[i]].value == 1) {
				switch (i) {
					case 0:
						var marcanal = false;
						for (j=0; j<nalext0.length; j++) {
							if (document.capitulo5[nalext0[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion0.length; k++) {
							if (document.capitulo5[opcion0[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 1:
						var marcanal = false;
						for (j=0; j<nalext1.length; j++) {
							if (document.capitulo5[nalext1[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion1.length; k++) {
							if (document.capitulo5[opcion1[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 2:
						var marcanal = false;
						for (j=0; j<nalext2.length; j++) {
							if (document.capitulo5[nalext2[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion2.length; k++) {
							if (document.capitulo5[opcion2[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 3:
						var marcanal = false;
						for (j=0; j<nalext3.length; j++) {
							if (document.capitulo5[nalext3[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion3.length; k++) {
							if (document.capitulo5[opcion3[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 4:
						var marcanal = false;
						for (j=0; j<nalext4.length; j++) {
							if (document.capitulo5[nalext4[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion4.length; k++) {
							if (document.capitulo5[opcion4[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 5:
						var marcanal = false;
						for (j=0; j<nalext5.length; j++) {
							if (document.capitulo5[nalext5[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion5.length; k++) {
							if (document.capitulo5[opcion5[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 6:
						var marcanal = false;
						for (j=0; j<nalext6.length; j++) {
							if (document.capitulo5[nalext6[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion6.length; k++) {
							if (document.capitulo5[opcion6[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 7:
						var marcanal = false;
						for (j=0; j<nalext7.length; j++) {
							if (document.capitulo5[nalext7[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion7.length; k++) {
							if (document.capitulo5[opcion7[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 8:
						var marcanal = false;
						for (j=0; j<nalext8.length; j++) {
							if (document.capitulo5[nalext8[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion8.length; k++) {
							if (document.capitulo5[opcion8[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 9:
						var marcanal = false;
						for (j=0; j<nalext9.length; j++) {
							if (document.capitulo5[nalext9[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion9.length; k++) {
							if (document.capitulo5[opcion9[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 10:
						var marcanal = false;
						for (j=0; j<nalext10.length; j++) {
							if (document.capitulo5[nalext10[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion10.length; k++) {
							if (document.capitulo5[opcion10[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
					case 11:
						var marcanal = false;
						for (j=0; j<nalext11.length; j++) {
							if (document.capitulo5[nalext11[j]].checked == true) {
								marcanal = true;
							}
						}
						if (!marcanal) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DILIGENCIAR Nacional o Extranjero: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						var marcaop = false;
						for (k=0; k<opcion11.length; k++) {
							if (document.capitulo5[opcion11[k]].checked == true) {
								marcaop = true;
							}
						}
						if (!marcaop) {
							retorno = valores3[i];
							alert ("NUMERAL 3 DEBE DILIGENCIAR por lo menos una opción: "+document.getElementById(textos3[i]).textContent.trim());
							return retorno;
						}
						break;
				}
			}
		}
	}
}
