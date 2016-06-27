function activaTexto(id1, id2, id3)
{
	if (id2!="nada") {
		document.getElementById(id2).disabled = false;
		document.getElementById(id2).focus();
	}
	
	if (id3 != "nada") {
		document.getElementById(id3).disabled = false;
		document.getElementById("i2").disabled = false;
	}
	if (id1 != "idi7r1c1") {
		document.getElementById("idi7r1c1").checked = false;
		document.getElementById("idi7r1c12").checked = false;
		document.getElementById("idi7r1c1").disabled = true;
		document.getElementById("idi7r1c12").disabled = true;
	}
	
	if (id1=="idi1r4c1" || id1=="idi1r5c1" || id1=="idi1r6c1" || id1=="idi7r1c1") {
		var activax = "no";
	}
	else {
		if (document.getElementById("idi8r1c12").checked == false) {
			document.getElementById("idi9r1c1").disabled = false;
			document.getElementById("idi9r1c12").disabled = false;
		}
		if (document.getElementById("idi8r2c12").checked == false) {
			document.getElementById("idi9r2c1").disabled = false;
			document.getElementById("idi9r2c12").disabled = false;
		}
	}
	
	if (id1 == "idi1r1c1n" || id1 == "idi1r1c1m") {
		if (document.getElementById("idi3r2c1").value>0) {
			document.getElementById("idi4r1c1").disabled = false;
		}
		if (document.getElementById("idi3r2c2").value>0) {
			document.getElementById("idi4r1c2").disabled = false;
		}
	}
	if (id1 == "idi1r2c1n" || id1 == "idi1r2c1m") {
		if (document.getElementById("idi3r2c1").value>0) {
			document.getElementById("idi4r2c1").disabled = false;
		}
		if (document.getElementById("idi3r2c2").value>0) {
			document.getElementById("idi4r2c2").disabled = false;
		}
	}
	
	if (id1 == "idi1r3c1n" || id1 == "idi1r3c1m") {
		if (document.getElementById("idi3r2c1").value>0) {
			document.getElementById("idi4r3c1").disabled = false;
		}
		if (document.getElementById("idi3r2c2").value>0) {
			document.getElementById("idi4r3c2").disabled = false;
		}
	}
	document.getElementById("i10").disabled = false; 
	$("input[name='i10r1c1']").prop("disabled", false);
	$("input[name='i10r2c1']").prop("disabled", false);
	$("input[name='i10r3c1']").prop("disabled", false);
	$("input[name='i10r4c1']").prop("disabled", false);
	$("input[name='i10r5c1']").prop("disabled", false);
	$("input[name='i10r6c1']").prop("disabled", false);
	$("input[name='i10r7c1']").prop("disabled", false);
	$("input[name='i10r8c1']").prop("disabled", false);
	$("input[name='i10r9c1']").prop("disabled", false);
	$("input[name='i10r10c1']").prop("disabled", false);
	$("input[name='i10r11c1']").prop("disabled", false);
	$("input[name='i10r12c1']").prop("disabled", false);
	$("input[name='i10r13c1']").prop("disabled", false);
	$("input[name='i10r14c1']").prop("disabled", false);
}


function desactivaTexto(id1,id2,id3)
 {
	if (id2!="nada") {
		document.getElementById(id2).disabled = true;
		document.getElementById(id2).value = '';
	}
	if ((id1=="idi1r1c1n2" || id1=="idi1r2c1n2" || id1=="idi1r3c1n2") && document.getElementById("idi1r1c1n2").checked && document.getElementById("idi1r2c1n2").checked && document.getElementById("idi1r3c1n2").checked) {
		document.getElementById(id3).disabled = true;
		document.getElementById(id3).value = '';
	}
	if ((id1=="idi1r1c1m2" || id1=="idi1r2c1m2" || id1=="idi1r3c1m2") && document.getElementById("idi1r1c1m2").checked && document.getElementById("idi1r2c1m2").checked && document.getElementById("idi1r3c1m2").checked) {
		document.getElementById(id3).disabled = true;
		document.getElementById(id3).value = '';
	}
	var veriNO = ["idi1r1c1n2","idi1r2c1n2","idi1r3c1n2","idi1r1c1m2","idi1r2c1m2","idi1r3c1m2","idi1r4c12","idi1r5c12","idi1r6c12","idi5r1c12","idi6r1c12"];
	var todoNO = true;
	for (i=0; i<veriNO.length; i++) {
		if (!document.getElementById(veriNO[i]).checked) {
			todoNO = false;
			break;
		}
	}
	if (todoNO) {
		document.getElementById("idi7r1c1").disabled = false;
		document.getElementById("idi7r1c12").disabled = false;
	}
	
	var veriNO10 = ["idi1r1c1n2","idi1r2c1n2","idi1r3c1n2","idi1r1c1m2","idi1r2c1m2","idi1r3c1m2","idi1r4c12","idi1r5c12","idi1r6c12","idi5r1c12","idi6r1c12","idi7r1c12"];
	var todoNO10 = true;
	for (i=0; i<veriNO10.length; i++) {
		if (!document.getElementById(veriNO10[i]).checked) {
			todoNO10 = false;
			break;
		}
	}
	if (todoNO10) {
		$("input[name='i10r1c1']").prop("checked", false);
		$("input[name='i10r2c1']").prop("checked", false);
		$("input[name='i10r3c1']").prop("checked", false);
		$("input[name='i10r4c1']").prop("checked", false);
		$("input[name='i10r5c1']").prop("checked", false);
		$("input[name='i10r6c1']").prop("checked", false);
		$("input[name='i10r7c1']").prop("checked", false);
		$("input[name='i10r8c1']").prop("checked", false);
		$("input[name='i10r9c1']").prop("checked", false);
		$("input[name='i10r10c1']").prop("checked", false);
		$("input[name='i10r11c1']").prop("checked", false);
		$("input[name='i10r12c1']").prop("checked", false);
		$("input[name='i10r13c1']").prop("checked", false);
		$("input[name='i10r14c1']").prop("checked", false);
		document.getElementById("i10").disabled = true;
	}
	
	var veriNO9 = ["idi1r1c1n2","idi1r2c1n2","idi1r3c1n2","idi1r1c1m2","idi1r2c1m2","idi1r3c1m2"];
	var todoNO9 = true;
	for (i=0; i<veriNO9.length; i++) {
		if (!document.getElementById(veriNO9[i]).checked) {
			todoNO9 = false;
			break;
		}
	}
	if (todoNO9) {
		document.getElementById("idi9r1c1").disabled = true;
		document.getElementById("idi9r1c12").disabled = true;
		document.getElementById("idi9r2c1").disabled = true;
		document.getElementById("idi9r2c12").disabled = true;
		document.getElementById("idi9r1c1").checked = false;
		document.getElementById("idi9r1c12").checked = false;
		document.getElementById("idi9r2c1").checked = false;
		document.getElementById("idi9r2c12").checked = false;
	}
	if (id1 == "idi1r1c1n2" && document.getElementById("idi1r1c1m2").checked == true) {
		document.getElementById("idi4r1c1").disabled = true;
		document.getElementById("idi4r1c1").value = '';
	}
	if (id1 == "idi1r1c1m2" && document.getElementById("idi1r1c1n2").checked == true) {
		document.getElementById("idi4r1c1").disabled = true;
		document.getElementById("idi4r1c1").value = '';
	}
	
	if (id1 == "idi1r2c1n2" && document.getElementById("idi1r2c1m2").checked == true) {
		document.getElementById("idi4r2c1").disabled = true;
		document.getElementById("idi4r2c1").value = '';
	}
	if (id1 == "idi1r2c1m2" && document.getElementById("idi1r2c1n2").checked == true) {
		document.getElementById("idi4r2c1").disabled = true;
		document.getElementById("idi4r2c1").value = '';
	}
	if (id1 == "idi1r3c1n2" && document.getElementById("idi1r3c1m2").checked == true) {
		document.getElementById("idi4r3c1").disabled = true;
		document.getElementById("idi4r3c1").value = '';
	}
	
	if (id1 == "idi1r3c1m2" && document.getElementById("idi1r3c1n2").checked == true) {
		document.getElementById("idi4r3c1").disabled = true;
		document.getElementById("idi4r3c1").value = '';
	}
	
	if (id1 == "idi1r1c1n2" && document.getElementById("idi1r1c1m2").checked == true) {
		document.getElementById("idi4r1c2").disabled = true;
		document.getElementById("idi4r1c2").value = '';
	}
	if (id1 == "idi1r1c1m2" && document.getElementById("idi1r1c1n2").checked == true) {
		document.getElementById("idi4r1c2").disabled = true;
		document.getElementById("idi4r1c2").value = '';
	}
	
	if (id1 == "idi1r2c1n2" && document.getElementById("idi1r2c1m2").checked == true) {
		document.getElementById("idi4r2c2").disabled = true;
		document.getElementById("idi4r2c2").value = '';
	}
	if (id1 == "idi1r2c1m2" && document.getElementById("idi1r2c1n2").checked == true) {
		document.getElementById("idi4r2c2").disabled = true;
		document.getElementById("idi4r2c2").value = '';
	}
	if (id1 == "idi1r3c1n2" && document.getElementById("idi1r3c1m2").checked == true) {
		document.getElementById("idi4r3c2").disabled = true;
		document.getElementById("idi4r3c2").value = '';
	}
	
	if (id1 == "idi1r3c1m2" && document.getElementById("idi1r3c1n2").checked == true) {
		document.getElementById("idi4r3c2").disabled = true;
		document.getElementById("idi4r3c2").value = '';
	}
}

function activaTextoII(id1, id2, id3)
{
	if (document.getElementById(id1).value == 1) {
		document.getElementById(id2).disabled = false;
		document.getElementById(id2).focus();
		if (id3 != "nada") {
			document.getElementById(id3).disabled = false;
		}
		if ((id1 != "idvi6r1c1" || id1 != "idvi7r1c1") || (id1 == "idvi6r1c12" || id1 == "idvi7r1c12")) {
			document.getElementById("id69").disabled = false;
		}
		else{
			document.getElementById("id69").disabled = true;
		}
	}
	else {
		document.getElementById(id2).disabled = true;
		document.getElementById(id2).value = '';
		/*if (id1 == "idvi6r1c12" || id1 == "idvi7r1c12") {
			document.getElementById("id69").disabled = true;
		}
		else{
			document.getElementById("id69").disabled = false;
		}*/
	}
}

function veriIV(id3)  {
	if (id3=="idi3r2c1" && document.getElementById(id3).value>0) {
		document.getElementById("idi4r4c1").disabled = false;
		document.getElementById("idi4r5c1").disabled = false;
		if (document.getElementById("idi1r1c1n").checked || document.getElementById("idi1r1c1m").checked) {
			document.getElementById("idi4r1c1").disabled = false;
		}
		if (document.getElementById("idi1r2c1n").checked || document.getElementById("idi1r2c1m").checked) {
			document.getElementById("idi4r2c1").disabled = false;
		}
		if (document.getElementById("idi1r3c1n").checked || document.getElementById("idi1r3c1m").checked) {
			document.getElementById("idi4r3c1").disabled = false;
		}
	}
	if (id3=="idi3r2c1" && document.getElementById(id3).value==0) {
		document.getElementById("idi4r4c1").disabled = true; document.getElementById("idi4r4c1").value = "";
		document.getElementById("idi4r5c1").disabled = true; document.getElementById("idi4r5c1").value = "";
		document.getElementById("idi4r1c1").disabled = true; document.getElementById("idi4r1c1").value = "";
		document.getElementById("idi4r2c1").disabled = true; document.getElementById("idi4r2c1").value = "";
		document.getElementById("idi4r3c1").disabled = true; document.getElementById("idi4r3c1").value = "";
	}
	if (id3=="idi3r2c2" && document.getElementById(id3).value>0) {
		document.getElementById("idi4r4c2").disabled = false;
		document.getElementById("idi4r5c2").disabled = false;
		if (document.getElementById("idi1r1c1n").checked || document.getElementById("idi1r1c1m").checked) {
			document.getElementById("idi4r1c2").disabled = false;
		}
		if (document.getElementById("idi1r2c1n").checked || document.getElementById("idi1r2c1m").checked) {
			document.getElementById("idi4r2c2").disabled = false;
		}
		if (document.getElementById("idi1r3c1n").checked || document.getElementById("idi1r3c1m").checked) {
			document.getElementById("idi4r3c2").disabled = false;
		}
	}
	if (id3=="idi3r2c2" && document.getElementById(id3).value==0) {
		document.getElementById("idi4r4c2").disabled = true; document.getElementById("idi4r4c2").value = "";
		document.getElementById("idi4r5c2").disabled = true; document.getElementById("idi4r5c2").value = "";
		document.getElementById("idi4r1c2").disabled = true; document.getElementById("idi4r1c2").value = "";
		document.getElementById("idi4r2c2").disabled = true; document.getElementById("idi4r2c2").value = "";
		document.getElementById("idi4r3c2").disabled = true; document.getElementById("idi4r3c2").value = "";
	}
}

function valida12(id1, id2, coln) {
	if (parseInt(document.getElementById(id1).value) > parseInt(document.getElementById(id2).value)) {
		alert("VALOR DEBE SER MENOR O IGUAL QUE "+coln);
	}
}

$(function(){
	$("#idi1r1c2n,#idi1r2c2n,#idi1r3c2n,#idi1r1c2m,#idi1r2c2m,#idi1r3c2m,#idi1r4c2,#idi1r5c2,#idi1r6c2").blur(function() {
		if ($(this).val() <= 0) {
			alert ("VALOR DEBE SER MAYOR QUE CERO (0)");
			setTimeout(function() {
				$(this).focus(), 1500;
			});
		}
	});
});
