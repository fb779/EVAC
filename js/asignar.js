/**
 * @author USER
 */
var xmlAsigna;
var xmlAsigTot;
var xmlAsigUno;
var idDetalle;
function detalleActi(codiAct, usuario)
{
	var actividad = codiAct.substr(1);
	var idUsuario = usuario;
	idDetalle = "det"+actividad;
	if (document.getElementById(idDetalle).style.display=="none") {
		document.getElementById(idDetalle).style.display="block";
	}
	else {
		document.getElementById(idDetalle).style.display="none";
	}
	xmlAsigna=creaAsigna();

	if (xmlAsigna == null)
	{
		alert ("El explorador no soporta solicitudes HTTP");
		return;
	}
	var url="asignacion.php";
	queryString = "usuario="+escape(idUsuario)+"&activ="+escape(actividad);
	xmlAsigna.open("POST", url, true);
	xmlAsigna.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlAsigna.onreadystatechange=estadoRetAsigna;
	xmlAsigna.send(queryString);
} 

function estadoRetAsigna() 
{ 
	if (xmlAsigna.readyState==4 || xmlAsigna.readyState=="complete")
	{
		document.getElementById(idDetalle).innerHTML="";
		document.getElementById(idDetalle).innerHTML=xmlAsigna.responseText;
	}
}

var btnId;
function asigftestot(id, actividad, usuario)
{
	var idFtes = "n"+actividad;
	var ftesasig = document.getElementById(idFtes).value;
	btnId = id;
	lkId = "l"+actividad;
	xmlAsigTot=creaAsigna();

	if (xmlAsigTot == null)
	{
		alert ("El explorador no soporta solicitudes HTTP");
		return;
	}
	var url="asignacion.php";
	queryString = "tipo=asigtot&usuario="+escape(usuario)+"&activ="+escape(actividad)+"&fuentes="+escape(ftesasig);
	xmlAsigTot.open("POST", url, true);
	xmlAsigTot.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlAsigTot.onreadystatechange=estadoRetAsigtot;
	xmlAsigTot.send(queryString);
}

function estadoRetAsigtot() 
{ 
	if (xmlAsigTot.readyState==4 || xmlAsigTot.readyState=="complete")
	{
		document.getElementById(btnId).innerHTML="Asignados";
		document.getElementById(btnId).disabled = true;
	}
}

var btnUno;
function asigftesuno(id, actividad, numero, usuario)
{
	xmlAsigUno=creaAsigna();
	btnUno = id;

	if (xmlAsigUno == null)
	{
		alert ("El explorador no soporta solicitudes HTTP");
		return;
	}
	var url="asignacion.php";
	queryString = "tipo=asiguno&usuario="+escape(usuario)+"&activ="+escape(actividad)+"&numero="+escape(numero);
	xmlAsigUno.open("POST", url, true);
	xmlAsigUno.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlAsigUno.onreadystatechange=estadoRetAsiguno;
	xmlAsigUno.send(queryString);
}

function estadoRetAsiguno() 
{ 
	if (xmlAsigUno.readyState==4 || xmlAsigUno.readyState=="complete")
	{
		document.getElementById(btnUno).innerHTML="Asignado";
		document.getElementById(btnUno).disabled = true;
	}
}

function creaAsigna()
{
	var xmlAsigna = null;
	try
	{
  // Firefox, Opera 8.0+, Safari
		xmlAsigna = new XMLHttpRequest();
	}
	catch (e)
	{
 // Internet Explorer
	try
    {
		xmlAsigna = new ActiveXObject("Msxml2.XMLHTTP");
    }
	catch (e)
    {
		xmlAsigna = new ActiveXObject("Microsoft.XMLHTTP");
    }
 }
  return xmlAsigna;
}
