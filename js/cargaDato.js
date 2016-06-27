var xmlHttpMuni;
var contenedor;
var lista;
var nombreLista;
function cargaMuni(codDep, idCont, idLista, NomLista)
{
	var codigoDep = codDep;
	contenedor = idCont; lista = idLista; nombreLista = NomLista;
	xmlHttpMuni=creaLista();

	if (xmlHttpMuni == null)
	{
		alert ("El explorador no soporta solicitudes HTTP");
		return;
	}
	var url="../persistencia/cargaDato.php";
	url=url+"?codep="+escape(codigoDep)+"&idlista="+escape(lista)+"&nomlista="+escape(nombreLista)+"&mpio=mpio";
	url=url+"&sid="+Math.random();
	xmlHttpMuni.onreadystatechange=estadoLista;
	xmlHttpMuni.open("GET", url, true);
	xmlHttpMuni.send(null);
} 

function estadoLista() 
{ 
	if (xmlHttpMuni.readyState==4 || xmlHttpMuni.readyState=="complete")
	{
		document.getElementById(contenedor).innerHTML="";
		document.getElementById(contenedor).innerHTML=xmlHttpMuni.responseText;
	}
}

function creaLista()
{
	var xmlHttpMuni = null;
	try
	{
  // Firefox, Opera 8.0+, Safari
		xmlHttpMuni = new XMLHttpRequest();
	}
	catch (e)
	{
 // Internet Explorer
	try
    {
		xmlHttpMuni = new ActiveXObject("Msxml2.XMLHTTP");
    }
	catch (e)
    {
		xmlHttpMuni = new ActiveXObject("Microsoft.XMLHTTP");
    }
 }
  return xmlHttpMuni;
}