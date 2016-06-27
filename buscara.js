/**
 * @author USER
 */
function busCaratula(per)
{
	if (isNaN(document.getElementById('txtb').value))
	{
		document.frmbusca.action = "rescaratula.php";
		
	}
	else {
		document.frmbusca.action = "caratula.php";
	}
	return true;
}

function buscaFormu(per)
{
	document.frmbusca.action = "buscar.php?periodo="+per;
	return true;
}

function borraInf(cod, per)
{
	Borrado = confirm('¿Confirma la eliminación?');
	if (Borrado){
		document.frmborra.action = "borrar.php?periodo="+per+"&clase="+cod;
		return true;
	}
	else {
		alert('No se eliminarán los registros');
	}
}

function reloadope(region, per)
{
	var newloc = "operativo.php?nreg="+region+"&periodo="+per;
	window.location = newloc;
}

function reloadmenu(nombre)
{
	var newloc = "menu.php?nomest="+nombre;
	window.location = newloc;
}
