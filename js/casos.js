/**
 * @author USER
 */
var xmlCasos;
function limpiar() 
{
	document.getElementById("chk1").value = "";
	document.getElementById("chk2").value = "";
	document.getElementById("chk3").value = "";
	document.getElementById("chk4").value = "";
	document.getElementById("chk5").value = "";
	document.getElementById("chk6").value = "";
	document.getElementById("idcond").value = "";
	document.getElementById("iddesc").value = "";
	document.getElementById("idcaso").value = "";
	document.getElementById("idmodo").value = "ADIC";
	document.getElementById("idcond").focus();
}

function grabaCaso()
{
	var modo = document.getElementById("idmodo").value;
	var condi = document.getElementById("idcond").value;
	var descri = document.getElementById("iddesc").value;
	var idcaso = document.getElementById("idcaso").value;
	var tablas = "";
	if (document.getElementById("chk1").checked) {
		tablas = tablas+document.getElementById("chk1").value+",";
	}
	if (document.getElementById("chk2").checked) {
		tablas = tablas+document.getElementById("chk2").value+",";
	}
	if (document.getElementById("chk3").checked) {
		tablas = tablas+document.getElementById("chk3").value+",";
	}
	if (document.getElementById("chk4").checked) {
		tablas = tablas+document.getElementById("chk4").value+",";
	}
	if (document.getElementById("chk5").checked) {
		tablas = tablas+document.getElementById("chk5").value+",";
	}
	if (document.getElementById("chk6").checked) {
		tablas = tablas+document.getElementById("chk6").value+",";
	}
	alert(tablas);
	tablas = tablas.slice(0, -1);
	alert(tablas);
	alert(modo);
	
	xmlCasos=creaCaso();

	if (xmlCasos == null)
	{
		alert ("El explorador no soporta solicitudes HTTP");
		return;
	}
	var url="../persistencia/grabarcasos.php";
	queryString = "modo="+escape(modo)+"&condi="+escape(condi)+"&descri="+escape(descri)+"&tablas="+escape(tablas)+"&idcaso="+escape(idcaso);
	xmlCasos.open("POST", url, true);
	xmlCasos.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlCasos.onreadystatechange=estadoRetCasos;
	xmlCasos.send(queryString);
} 

function estadoRetCasos() 
{ 
	if (xmlCasos.readyState==4 || xmlCasos.readyState=="complete")
	{
		document.getElementById("idmsg").innerHTML = xmlCasos.responseText;
		document.getElementById("idmsg").style.display="block";
	}
}

function creaCaso()
{
	var xmlCasos = null;
	try
	{
  // Firefox, Opera 8.0+, Safari
		xmlCasos = new XMLHttpRequest();
	}
	catch (e)
	{
 // Internet Explorer
	try
    {
		xmlCasos = new ActiveXObject("Msxml2.XMLHTTP");
    }
	catch (e)
    {
		xmlCasos = new ActiveXObject("Microsoft.XMLHTTP");
    }
 }
  return xmlCasos;
}
