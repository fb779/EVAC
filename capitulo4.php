<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript">
	$(function(){

		$("#IV1R1C4, #IV1R2C4, #IV1R3C4, #IV1R4C4, #IV1R5C4, #IV1R6C4").bind("blur",function(){
			var suma = parseInt($("#IV1R1C4").val()) + parseInt($("#IV1R2C4").val()) + parseInt($("#IV1R3C4").val()) + parseInt($("#IV1R4C4").val()) + parseInt($("#IV1R5C4").val()) + parseInt($("#IV1R6C4").val());
			if (suma==0){
				//Bloquear campos
				for (var i=1; i<=8; i++){
					var campoC1 = "#IV5R"+i+"C1N";
					var campoC2 = "#IV5R"+i+"C2N";
					var campoC3 = "#IV5R"+i+"C3N";			
					$(campoC1).val("0").attr("disabled",true);
					$(campoC2).val("0").attr("disabled",true);
					$(campoC3).val("0").attr("disabled",true);
				}
			} 
			else{
				//Desbloquear campos
				for (var i=1; i<=8; i++){
					var campoC1 = "#IV5R"+i+"C1N";
					var campoC2 = "#IV5R"+i+"C2N";
					var campoC3 = "#IV5R"+i+"C3N";			
					$(campoC1).val("0").attr("disabled",false);
					$(campoC2).val("0").attr("disabled",false);
					$(campoC3).val("0").attr("disabled",false);
				}
			}
		});
		
	});
</script>



<link href="formelec.css" rel="stylesheet" type="text/css">
<link href="popup.css" rel="stylesheet" type="text/css">
<?
//$vig='2013';
$ident_capitulo = 4;
$idest= $_REQUEST['idest'];
$inter = "SELECT * FROM capitulo_ii WHERE nordemp = " . $empresa ." AND vigencia=".$vig." ";
$inter_result = mysql_query($inter, $con);
$lineas = mysql_num_rows($inter_result);
$lineaest = mysql_fetch_array($inter_result);

$condepa = "SELECT * FROM capitulo_iva WHERE nordemp = " . $empresa . " AND vigencia = " . $vig;
$rdepa = mysql_query($condepa);
$ldep = mysql_fetch_array($rdepa);

$muestra462011 = ''; $muestra462012 = '';
if ($lineaest['II1R9C1'] == 0) {
	$muestra462011 = "disabled = 'disabled'";
}
if ($lineaest['II1R9C2'] == 0) {
	$muestra462012 = "disabled = 'disabled'";
}
$II1R9C1H = $lineaest['II1R9C1'];
$inter = "SELECT * FROM capitulo_ii WHERE nordemp = " . $empresa ." AND vigencia=".$vig." ";
$inter_result = mysql_query($inter, $con);
$lineas = mysql_num_rows($inter_result);
$lineaest = mysql_fetch_array($inter_result);
$II1R9C2H = $lineaest['II1R9C2'];

$grabareste = 1;
$concapi = "SELECT * FROM capitulo_i WHERE nordemp = " . $idest . " AND vigencia = " . $vig;
$rescapi = mysql_query($concapi, $con);
$mcol1 = ''; $mcol2 = ''; $mcol3 = ''; $colnum3 = ''; $estado12 = ''; $estado13 = '';
if(mysql_num_rows($rescapi)==0) {;
	$grabareste = 0;
	$colnum3 = 'disabled = "disabled"';
	$mcol1 = 'disabled = "disabled"'; $mcol2 = 'disabled = "disabled"'; $mcol3 = 'disabled = "disabled"';
}
else {
	$lcapi = mysql_fetch_array($rescapi);	
}

if ($grabareste == 1) {
	if ($lcapi['I1R1C1']!=1 AND $lcapi['I1R2C1']!=1 AND $lcapi['I1R3C1'] != 1 AND $lcapi['I1R4C1'] !=1 AND
		$lcapi['I1R5C1']!=1 AND $lcapi['I1R6C1']!=1 AND $lcapi['I1R9C1N']!=1 AND $lcapi['I1R10C1N']!=1 AND 
		$lcapi['I1R11C1N']!=1 AND $lcapi['I4R1C1']!=1 AND $lcapi['I5R1C1']!=1) {
		$grabareste = 0;
		$colnum3 = 'disabled = "disabled"';
		$mcol1 = 'disabled = "disabled"'; $mcol2 = 'disabled = "disabled"'; $mcol3 = 'disabled = "disabled"';
		$limpia4 = "UPDATE capitulo_iv SET IV1R1C3=0,IV1R1C4=0,IV1R2C3=0,IV1R2C4=0,IV3R1C1N=0,IV3R1C2N=0,IV3R1C3N=0,
			IV3R2C1N=0,IV3R2C3N=0,IV3R3C1N=0,IV3R3C2N=0,IV3R3C3N=0,IV3R4C1N=0,IV3R4C2N=0,IV3R4C3N=0,IV3R5C1N=0,
			IV3R5C2N=0,IV3R5C3N=0,IV3R6C1N=0,IV3R6C2N=0,IV3R6C3N=0,IV3R7C1N=0,IV3R7C2N=0,IV3R7C3N=0,IV3R8C1N=0,
			IV3R8C2N=0,IV3R8C3N=0,IV3R9C1N=0,IV3R9C2N=0,IV3R9C3N=0,IV3R10C1N=0,IV3R10C2N=0,IV3R10C3N=0,IV3R11C1N=0,
			IV3R11C2N=0,IV3R11C3N=0,IV4R1C1N=0,IV4R1C2N=0,IV4R1C3N=0,IV5R1C1N=0,IV5R1C2N=0,IV5R1C3N=0,IV5R2C1N=0,
			IV5R2C2N=0,IV5R2C3N=0,IV5R3C1N=0,IV5R3C2N=0,IV5R3C3N=0,IV5R4C1N=0,IV5R4C2N=0,IV5R4C3N=0,IV5R5C1N=0,
			IV5R5C2N=0,IV5R5C3N=0,IV5R6C1N=0,IV5R6C2N=0,IV5R6C3N=0,IV5R7C1N=0,IV5R7C2N=0,IV5R7C3N=0,IV5R8C1N=0,
			IV5R8C2N=0,IV5R8C3N=0,IV1R3C3=0,IV1R3C4=0,IV1R4C3=0,IV1R4C4=0,IV1R5C3=0,IV1R5C4=0,IV1R6C3=0,IV1R6C4=0,
			IV1R7C3=0,IV1R7C4=0,IV1R8C3=0,IV1R8C4=0,IV1R9C3=0,IV1R9C4=0,IV1R10C3=0,IV1R10C4=0,IV1R11C3=0,IV1R11C4=0,
			IV2R1C1=0,IV2R1C2=0,IV2R1C3=0,IV2R1C4=0,IV2R1C5=0,IV2R1C6=0,IV2R2C1=0,IV2R2C2=0,IV2R2C3=0,IV2R2C4=0,
			IV2R2C5=0,IV2R2C6=0,IV2R3C1=0,IV2R3C2=0,IV2R3C3=0,IV2R3C4=0,IV2R3C5=0,IV2R3C6=0,IV2R4C1=0,IV2R4C2=0,
			IV2R4C3=0,IV2R4C4=0,IV2R4C5=0,IV2R4C6=0,IV2R5C1=0,IV2R5C2=0,IV2R5C3=0,IV2R5C4=0,IV2R5C5=0,IV2R5C6=0,
			IV2R6C1=0,IV2R6C2=0,IV2R6C3=0,IV2R6C4=0,IV2R6C5=0,IV2R6C6=0,IV2R7C1=0,IV2R7C2=0,IV2R7C3=0,IV2R7C4=0,
			IV2R7C5=0,IV2R7C6=0,IV3R1C1=0,IV3R1C2=0,IV3R1C3=0,IV3R1C4=0,IV3R1C5=0,IV3R1C6=0,IV3R2C1=0,IV3R2C2=0,
			IV3R2C3=0,IV3R2C4=0,IV3R2C5=0,IV3R2C6=0,IV3R3C1=0,IV3R3C2=0,IV3R3C3=0,IV3R3C4=0,IV3R3C5=0,IV3R3C6=0,
			IV3R4C1=0,IV3R4C2=0,IV3R4C3=0,IV3R4C4=0,IV3R4C5=0,IV3R4C6=0,IV3R5C1=0,IV3R5C2=0,IV3R5C3=0,IV3R5C4=0,
			IV3R5C5=0,IV3R5C6=0,IV3R6C1=0,IV3R6C2=0,IV3R6C3=0,IV3R6C4=0,IV3R6C5=0,IV3R6C6=0,IV3R7C1=0,IV3R7C2=0,
			IV3R7C3=0,IV3R7C4=0,IV3R7C5=0,IV3R7C6=0,IV3R8C1=0,IV3R8C2=0,IV3R8C3=0,IV3R8C4=0,IV3R8C5=0,IV3R8C6=0,
			IV4R1C1=0,IV4R1C2=0,IV4R1C3=0,IV4R1C4=0,IV4R1C5=0,IV4R1C6=0,IV4R2C1=0,IV4R2C2=0,IV4R2C3=0,IV4R2C4=0,
			IV4R2C5=0,IV4R2C6=0,IV4R3C1=0,IV4R3C2=0,IV4R3C3=0,IV4R3C4=0,IV4R3C5=0,IV4R3C6=0,IV4R4C1=0,IV4R4C2=0,
			IV4R4C3=0,IV4R4C4=0,IV4R4C5=0,IV4R4C6=0,IV4R5C1=0,IV4R5C2=0,IV4R5C3=0,IV4R5C4=0,IV4R5C5=0,IV4R5C6=0,
			IV4R6C1=0,IV4R6C2=0,IV4R6C3=0,IV4R6C4=0,IV4R6C5=0,IV4R6C6=0,IV4R7C1=0,IV4R7C2=0,IV4R7C3=0,IV4R7C4=0,
			IV4R7C5=0,IV4R7C6=0,IV4R8C1=0,IV4R8C2=0,IV4R8C3=0,IV4R8C4=0,IV4R8C5=0,IV4R8C6=0,
			IV5R2C1=0,IV5R2C2=0,IV5R3C1=0,IV5R3C2=0,IV5R4C1=0,IV5R4C2=0,IV3R1C6N=0,IV3R2C6N=0,IV3R3C6N=0,IV3R4C6N=0,
			IV3R5C6N=0,IV3R6C6N=0,IV3R7C6N=0,IV4R1C6N=0,IV4R2C6N=0,IV4R3C6N=0,IV4R4C6N=0,IV4R5C6N=0,IV4R6C6N=0,
			IV4R7C6N=0,IV4R8C6N=0 WHERE nordemp = " . $empresa . " AND vigencia = " . $vig;
		$rlimpia4 =  mysql_query($limpia4);

		$limpia4a = "UPDATE capitulo_iva SET VI7R1C1=0,VI7R1C2=0,VI7R1C3=0,VI7R1C4=0,VI7R1C5=0,VI7R1C6=0,VI7R2C1=0,VI7R2C2=0,
			VI7R2C3=0,VI7R2C4=0,VI7R2C5=0,VI7R2C6=0,VI7R3C1=0,VI7R3C2=0,VI7R3C3=0,VI7R3C4=0,VI7R3C5=0,VI7R3C6=0,
			VI7R4C1=0,VI7R4C2=0,VI7R4C3=0,VI7R4C4=0,VI7R4C5=0,VI7R4C6=0,VI7R5C1=0,VI7R5C2=0,VI7R5C3=0,VI7R5C4=0,
			VI7R5C5=0,VI7R5C6=0,VI7R6C1=0,VI7R6C2=0,VI7R6C3=0,VI7R6C4=0,VI7R6C5=0,VI7R6C6=0,VI7R7C1=0,VI7R7C2=0,
			VI7R7C3=0,VI7R7C4=0,VI7R7C5=0,VI7R7C6=0,VI7R8C1=0,VI7R8C2=0,VI7R8C3=0,VI7R8C4=0,VI7R8C5=0,VI7R8C6=0,
			VI7R9C1=0,VI7R9C2=0,VI7R9C3=0,VI7R9C4=0,VI7R9C5=0,VI7R9C6=0,VI7R10C1=0,VI7R10C2=0,VI7R10C3=0,
			VI7R10C4=0,VI7R10C5=0,VI7R10C6=0,VI7R11C1=0,VI7R11C2=0,VI7R11C3=0,VI7R11C4=0,VI7R11C5=0,VI7R11C6=0,
			VI7R12C5=0,VI7R12C6=0 WHERE nordemp = " . $empresa . " AND vigencia = " . $vig;
		$rlimpia4a =  mysql_query($limpia4a);
		
		$limpia4_b = "UPDATE capitulo_iv SET IV3R1C1N=0,IV3R1C2N=0,IV3R1C3N=0,IV3R2C1N=0,IV3R2C2N=0,IV3R2C3N=0,IV3R3C1N=0,IV3R3C2N=0,
			IV3R3C3N=0,IV3R4C1N=0,IV3R4C2N=0,IV3R4C3N=0,IV3R5C1N=0,IV3R5C2N=0,IV3R5C3N=0,IV3R6C1N=0,IV3R6C2N=0,IV3R6C3N=0,IV3R7C1N=0,
			IV3R7C2N=0,IV3R7C3N=0,IV3R8C1N=0,IV3R8C2N=0,IV3R8C3N=0,IV3R9C1N=0,IV3R9C2N=0,IV3R9C3N=0,IV3R10C1N=0,IV3R10C2N=0,IV3R10C3N=0,
			IV3R11C1N=0,IV3R11C2N=0,IV3R11C3N=0 WHERE nordemp = " . $empresa . " AND vigencia = " . $vig;
		$rlimpia4_b =  mysql_query($limpia4_b);
		$condepa = "SELECT * FROM capitulo_iva WHERE nordemp = " . $empresa . " AND vigencia = " . $vig;
		$rdepa = mysql_query($condepa);
		$ldep = mysql_fetch_array($rdepa);
	}
/*	else {
		//include('vistas/mensaje.php');
	}*/
}

if ($grabareste == 1) {
	if ($row['IV3R6C1N'] == 0) {
		$mcol1 = 'disabled = "disabled"';
	}
	if ($row['IV3R6C2N'] == 0) { 
		$mcol2 = 'disabled = "disabled"';
	}
	if ($row['IV3R6C3N'] == 0) {
		$mcol3 = 'disabled = "disabled"';
	}
}

if ($row['IV1R11C4'] == 0 OR $row['IV1R11C4'] == '') {
	$colnum3 = "disabled='disabled'";
	$estado13 = "disabled='disabled'";
	$mcol1 = 'disabled = "disabled"'; $mcol2 = 'disabled = "disabled"'; $mcol3 = 'disabled = "disabled"';
}

if ($row['IV1R11C3'] == 0 OR $row['IV1R11C3'] == '') {
	$estado12 = "disabled='disabled'";
}
?>

<script language="javascript" src="include/validaciones.js"></script>
<script>
function validar_formulario(formulario)
{

var sw=0;
//COL 1
var IV1R1C1 = trim(document.capitulo4.IV1R1C1.value);
var IV1R2C1 = trim(document.capitulo4.IV1R2C1.value);
var IV1R3C1 = trim(document.capitulo4.IV1R3C1.value);
var IV1R4C1 = trim(document.capitulo4.IV1R4C1.value);
var IV1R5C1 = trim(document.capitulo4.IV1R5C1.value);
var IV1R6C1 = trim(document.capitulo4.IV1R6C1.value);
var IV1R7C1 = trim(document.capitulo4.IV1R7C1.value);
var IV1R8C1 = trim(document.capitulo4.IV1R8C1.value);
var IV1R9C1 = trim(document.capitulo4.IV1R9C1.value);
var IV1R10C1 = trim(document.capitulo4.IV1R10C1.value);
var IV1R11C1 = trim(document.capitulo4.IV1R11C1.value);
var TOTAL_COL1=parseInt(IV1R1C1)+parseInt(IV1R2C1)+parseInt(IV1R3C1)+parseInt(IV1R4C1)+parseInt(IV1R5C1)+parseInt(IV1R6C1)+parseInt(IV1R7C1)+parseInt(IV1R8C1)+parseInt(IV1R9C1)+parseInt(IV1R10C1);
/*COL 2*/
var IV1R1C2 = trim(document.capitulo4.IV1R1C2.value);
var IV1R2C2 = trim(document.capitulo4.IV1R2C2.value);
var IV1R3C2 = trim(document.capitulo4.IV1R3C2.value);
var IV1R4C2 = trim(document.capitulo4.IV1R4C2.value);
var IV1R5C2 = trim(document.capitulo4.IV1R5C2.value);
var IV1R6C2 = trim(document.capitulo4.IV1R6C2.value);
var IV1R7C2 = trim(document.capitulo4.IV1R7C2.value);
var IV1R8C2 = trim(document.capitulo4.IV1R8C2.value);
var IV1R9C2 = trim(document.capitulo4.IV1R9C2.value);
var IV1R10C2 = trim(document.capitulo4.IV1R10C2.value);
var IV1R11C2 = trim(document.capitulo4.IV1R11C2.value);
var TOTAL_COL2=parseInt(IV1R1C2)+parseInt(IV1R2C2)+parseInt(IV1R3C2)+parseInt(IV1R4C2)+parseInt(IV1R5C2)+parseInt(IV1R6C2)+parseInt(IV1R7C2)+parseInt(IV1R8C2)+parseInt(IV1R9C2)+parseInt(IV1R10C2);
var TOTAL_PARCIAL=parseInt(IV1R1C2)+parseInt(IV1R2C2)+parseInt(IV1R3C2)+parseInt(IV1R4C2)+parseInt(IV1R5C2)+parseInt(IV1R6C2);
//var TOTAL_TEC=parseInt(IV1R5C2)+parseInt(IV1R6C2);
/*COL 3*/
var IV1R1C3 = trim(document.capitulo4.IV1R1C3.value);
var IV1R2C3 = trim(document.capitulo4.IV1R2C3.value);
var IV1R3C3 = trim(document.capitulo4.IV1R3C3.value);
var IV1R4C3 = trim(document.capitulo4.IV1R4C3.value);
var IV1R5C3 = trim(document.capitulo4.IV1R5C3.value);
var IV1R6C3 = trim(document.capitulo4.IV1R6C3.value);
var IV1R7C3 = trim(document.capitulo4.IV1R7C3.value);
var IV1R8C3 = trim(document.capitulo4.IV1R8C3.value);
var IV1R9C3 = trim(document.capitulo4.IV1R9C3.value);
var IV1R10C3 = trim(document.capitulo4.IV1R10C3.value);
var IV1R11C3 = trim(document.capitulo4.IV1R11C3.value);
var TOTAL_COL3=parseInt(IV1R1C3)+parseInt(IV1R2C3)+parseInt(IV1R3C3)+parseInt(IV1R4C3)+parseInt(IV1R5C3)+parseInt(IV1R6C3)+parseInt(IV1R7C3)+parseInt(IV1R8C3)+parseInt(IV1R9C3)+parseInt(IV1R10C3);
/*COL 4*/
var IV1R1C4 = trim(document.capitulo4.IV1R1C4.value);
var IV1R2C4 = trim(document.capitulo4.IV1R2C4.value);
var IV1R3C4 = trim(document.capitulo4.IV1R3C4.value);
var IV1R4C4 = trim(document.capitulo4.IV1R4C4.value);
var IV1R5C4 = trim(document.capitulo4.IV1R5C4.value);
var IV1R6C4 = trim(document.capitulo4.IV1R6C4.value);
var IV1R7C4 = trim(document.capitulo4.IV1R7C4.value);
var IV1R8C4 = trim(document.capitulo4.IV1R8C4.value);
var IV1R9C4 = trim(document.capitulo4.IV1R9C4.value);
var IV1R10C4 = trim(document.capitulo4.IV1R10C4.value);
//var IV1R11C4 = trim(document.capitulo4.IV1R11C4.value);
var IV1R11C4 = document.capitulo4.IV1R11C4.value;
var TOTAL_COL4=parseInt(IV1R1C4)+parseInt(IV1R2C4)+parseInt(IV1R3C4)+parseInt(IV1R4C4)+parseInt(IV1R5C4)+parseInt(IV1R6C4)+parseInt(IV1R7C4)+parseInt(IV1R8C4)+parseInt(IV1R9C4)+parseInt(IV1R10C4);
var col4vs5 = parseInt(IV1R1C4)+parseInt(IV1R2C4)+parseInt(IV1R3C4)+parseInt(IV1R4C4)+parseInt(IV1R5C4)+parseInt(IV1R6C4);
//CAPITULO 4 NUMERAL 3
//NUMERAL 3 COLUMNA DOCTORADO

/*COL 1 NUM 2*/ 
/*var IV2R1C1 = trim(document.capitulo4.IV2R1C1.value);
var IV2R2C1 = trim(document.capitulo4.IV2R2C1.value);
var IV2R3C1 = trim(document.capitulo4.IV2R3C1.value);
var IV2R4C1 = trim(document.capitulo4.IV2R4C1.value);
var IV2R5C1 = trim(document.capitulo4.IV2R5C1.value);
var IV2R6C1 = trim(document.capitulo4.IV2R6C1.value);
var IV2R7C1 = trim(document.capitulo4.IV2R7C1.value);
var TOTAL_COL1_2=parseInt(IV2R1C1)+parseInt(IV2R2C1)+parseInt(IV2R3C1)+parseInt(IV2R4C1)+parseInt(IV2R5C1)+parseInt(IV2R6C1);*/


//NUMERAL 3 COLUMNA MAESTRIA
/*COL 2 NUM 2*/ 
/*var IV2R1C2 = trim(document.capitulo4.IV2R1C2.value);
var IV2R2C2 = trim(document.capitulo4.IV2R2C2.value);
var IV2R3C2 = trim(document.capitulo4.IV2R3C2.value);
var IV2R4C2 = trim(document.capitulo4.IV2R4C2.value);
var IV2R5C2 = trim(document.capitulo4.IV2R5C2.value);
var IV2R6C2 = trim(document.capitulo4.IV2R6C2.value);
var IV2R7C2 = trim(document.capitulo4.IV2R7C2.value);
var TOTAL_COL2_2=parseInt(IV2R1C2)+parseInt(IV2R2C2)+parseInt(IV2R3C2)+parseInt(IV2R4C2)+parseInt(IV2R5C2)+parseInt(IV2R6C2);*/
//NUMERAL 3 COLUMNA ESPECIALIZACION
/*COL 3 NUM 2*/
/*var IV2R1C3 = trim(document.capitulo4.IV2R1C3.value);
var IV2R2C3 = trim(document.capitulo4.IV2R2C3.value);
var IV2R3C3 = trim(document.capitulo4.IV2R3C3.value);
var IV2R4C3 = trim(document.capitulo4.IV2R4C3.value);
var IV2R5C3 = trim(document.capitulo4.IV2R5C3.value);
var IV2R6C3 = trim(document.capitulo4.IV2R6C3.value);
var IV2R7C3 = trim(document.capitulo4.IV2R7C3.value);
var TOTAL_COL3_2=parseInt(IV2R1C3)+parseInt(IV2R2C3)+parseInt(IV2R3C3)+parseInt(IV2R4C3)+parseInt(IV2R5C3)+parseInt(IV2R6C3);*/
//NUMERAL 3 COLUMNA UNIVERSITARIO
/*COL 4 NUM 2*/
/*var IV2R1C4 = trim(document.capitulo4.IV2R1C4.value);
var IV2R2C4 = trim(document.capitulo4.IV2R2C4.value);
var IV2R3C4 = trim(document.capitulo4.IV2R3C4.value);
var IV2R4C4 = trim(document.capitulo4.IV2R4C4.value);
var IV2R5C4 = trim(document.capitulo4.IV2R5C4.value);
var IV2R6C4 = trim(document.capitulo4.IV2R6C4.value);
var IV2R7C4 = trim(document.capitulo4.IV2R7C4.value);
var TOTAL_COL4_2=parseInt(IV2R1C4)+parseInt(IV2R2C4)+parseInt(IV2R3C4)+parseInt(IV2R4C4)+parseInt(IV2R5C4)+parseInt(IV2R6C4);/Â¿*/
//NUMERAL 3 COLUMNA TECNOLOGO
/*COL 5 NUM 2*/
/*var IV2R1C5 = trim(document.capitulo4.IV2R1C5.value);
var IV2R2C5 = trim(document.capitulo4.IV2R2C5.value);
var IV2R3C5 = trim(document.capitulo4.IV2R3C5.value);
var IV2R4C5 = trim(document.capitulo4.IV2R4C5.value);
var IV2R5C5 = trim(document.capitulo4.IV2R5C5.value);
var IV2R6C5 = trim(document.capitulo4.IV2R6C5.value);
var IV2R7C5 = trim(document.capitulo4.IV2R7C5.value);
var TOTAL_COL5_2=parseInt(IV2R1C5)+parseInt(IV2R2C5)+parseInt(IV2R3C5)+parseInt(IV2R4C5)+parseInt(IV2R5C5)+parseInt(IV2R6C5);*/
//NUMERAL 3 COLUMNA TECNICO
/*COL 6 NUM 2*/
/*var IV3R1C6N = trim(document.capitulo4.IV3R1C6N.value);
var IV3R2C6N = trim(document.capitulo4.IV3R2C6N.value);
var IV3R3C6N = trim(document.capitulo4.IV3R3C6N.value);
var IV3R4C6N = trim(document.capitulo4.IV3R4C6N.value);
var IV3R5C6N = trim(document.capitulo4.IV3R5C6N.value);
var IV3R6C6N = trim(document.capitulo4.IV3R6C6N.value);
var IV3R7C6N = trim(document.capitulo4.IV3R7C6N.value);
var TOTAL_COL6_2=parseInt(IV3R1C6N)+parseInt(IV3R2C6N)+parseInt(IV3R3C6N)+parseInt(IV3R4C6N)+parseInt(IV3R5C6N)+parseInt(IV3R6C6N);*/
//NUMERAL 3 FILA DIRECCION GENERAL
/*FILA 1 NUM 2*/
/*var IV2R1C6 = trim(document.capitulo4.IV2R1C6.value);
var TOTAL_FIL1_2=parseInt(IV2R1C1)+parseInt(IV2R1C2)+parseInt(IV2R1C3)+parseInt(IV2R1C4)+parseInt(IV2R1C5)+parseInt(IV3R1C6N);*/
//NUMERAL 3 FILA ADMINISTRACION
/*FILA 2 NUM 2*/
/*var IV2R2C6 = trim(document.capitulo4.IV2R2C6.value);
var TOTAL_FIL2_2=parseInt(IV2R2C1)+parseInt(IV2R2C2)+parseInt(IV2R2C3)+parseInt(IV2R2C4)+parseInt(IV2R2C5)+parseInt(IV3R2C6N);*/
//NUMERAL 3 FILA MERCADEO Y VENTAS
/*FILA 3 NUM 2*/
/*var IV2R3C6 = trim(document.capitulo4.IV2R3C6.value);
var TOTAL_FIL3_2=parseInt(IV2R3C1)+parseInt(IV2R3C2)+parseInt(IV2R3C3)+parseInt(IV2R3C4)+parseInt(IV2R3C5)+parseInt(IV3R3C6N);*/
//NUMERAL 3 FILA PRODUCCION
/*FILA 4 NUM 2*/
/*var IV2R4C6 = trim(document.capitulo4.IV2R4C6.value);
var TOTAL_FIL4_2=parseInt(IV2R4C1)+parseInt(IV2R4C2)+parseInt(IV2R4C3)+parseInt(IV2R4C4)+parseInt(IV2R4C5)+parseInt(IV3R4C6N);*/
//NUMERAL 3 FILA CONTABLE Y FINANCIERA
/*FILA 5 NUM 2*/
/*var IV2R5C6 = trim(document.capitulo4.IV2R5C6.value);
var TOTAL_FIL5_2=parseInt(IV2R5C1)+parseInt(IV2R5C2)+parseInt(IV2R5C3)+parseInt(IV2R5C4)+parseInt(IV2R5C5)+parseInt(IV3R5C6N);*/
//NUMERAL 3 FILA INVESTIGACION Y DESARROLLO
/*FILA 6 NUM 2*/
/*var IV2R6C6 = trim(document.capitulo4.IV2R6C6.value);
var TOTAL_FIL6_2=parseInt(IV2R6C1)+parseInt(IV2R6C2)+parseInt(IV2R6C3)+parseInt(IV2R6C4)+parseInt(IV2R6C5)+parseInt(IV3R6C6N);*/
//NUMERAL 3 FILA TOTAL PERSONAL NIVEL EDUCATIVO
/*FILA 7 NUM 2*/
/*var IV2R7C6 = trim(document.capitulo4.IV2R7C6.value);
var TOTAL_FIL7_2=parseInt(IV2R7C1)+parseInt(IV2R7C2)+parseInt(IV2R7C3)+parseInt(IV2R7C4)+parseInt(IV2R7C5)+parseInt(IV3R7C6N);*/

//CAPITULO 4 NUMERAL 4
//NUMERAL 4 COLUMNA DOCTORADO
/*COL 1 NUM 3*/
/*var IV3R1C1 = trim(document.capitulo4.IV3R1C1.value);
var IV3R2C1 = trim(document.capitulo4.IV3R2C1.value);
var IV3R3C1 = trim(document.capitulo4.IV3R3C1.value);
var IV3R4C1 = trim(document.capitulo4.IV3R4C1.value);
var IV3R5C1 = trim(document.capitulo4.IV3R5C1.value);
var IV3R6C1 = trim(document.capitulo4.IV3R6C1.value);
var IV3R7C1 = trim(document.capitulo4.IV3R7C1.value);
var IV3R8C1 = trim(document.capitulo4.IV3R8C1.value);
var TOTAL_COL1_3=parseInt(IV3R1C1)+parseInt(IV3R2C1)+parseInt(IV3R3C1)+parseInt(IV3R4C1)+parseInt(IV3R5C1)+parseInt(IV3R6C1)+parseInt(IV3R7C1);/
//NUMERAL 4 COLUMNA MAESTRIA
/*COL 2 NUM 3*/
/*var IV3R1C2 = trim(document.capitulo4.IV3R1C2.value);
var IV3R2C2 = trim(document.capitulo4.IV3R2C2.value);
var IV3R3C2 = trim(document.capitulo4.IV3R3C2.value);
var IV3R4C2 = trim(document.capitulo4.IV3R4C2.value);
var IV3R5C2 = trim(document.capitulo4.IV3R5C2.value);
var IV3R6C2 = trim(document.capitulo4.IV3R6C2.value);
var IV3R7C2 = trim(document.capitulo4.IV3R7C2.value);
var IV3R8C2 = trim(document.capitulo4.IV3R8C2.value);
var TOTAL_COL2_3=parseInt(IV3R1C2)+parseInt(IV3R2C2)+parseInt(IV3R3C2)+parseInt(IV3R4C2)+parseInt(IV3R5C2)+parseInt(IV3R6C2)+parseInt(IV3R7C2);*/
//NUMERAL 4 COLUMNA ESPECIALIZACION
/*COL 3 NUM 3*/
/*var IV3R1C3 = trim(document.capitulo4.IV3R1C3.value);
var IV3R2C3 = trim(document.capitulo4.IV3R2C3.value);
var IV3R3C3 = trim(document.capitulo4.IV3R3C3.value);
var IV3R4C3 = trim(document.capitulo4.IV3R4C3.value);
var IV3R5C3 = trim(document.capitulo4.IV3R5C3.value);
var IV3R6C3 = trim(document.capitulo4.IV3R6C3.value);
var IV3R7C3 = trim(document.capitulo4.IV3R7C3.value);
var IV3R8C3 = trim(document.capitulo4.IV3R8C3.value);
var TOTAL_COL3_3=parseInt(IV3R1C3)+parseInt(IV3R2C3)+parseInt(IV3R3C3)+parseInt(IV3R4C3)+parseInt(IV3R5C3)+parseInt(IV3R6C3)+parseInt(IV3R7C3);*/
//NUMERAL 4 COLUMNA UNIVERSITARIO
/*COL 4 NUM 3*/
/*var IV3R1C4 = trim(document.capitulo4.IV3R1C4.value);
var IV3R2C4 = trim(document.capitulo4.IV3R2C4.value);
var IV3R3C4 = trim(document.capitulo4.IV3R3C4.value);
var IV3R4C4 = trim(document.capitulo4.IV3R4C4.value);
var IV3R5C4 = trim(document.capitulo4.IV3R5C4.value);
var IV3R6C4 = trim(document.capitulo4.IV3R6C4.value);
var IV3R7C4 = trim(document.capitulo4.IV3R7C4.value);
var IV3R8C4 = trim(document.capitulo4.IV3R8C4.value);
var TOTAL_COL4_3=parseInt(IV3R1C4)+parseInt(IV3R2C4)+parseInt(IV3R3C4)+parseInt(IV3R4C4)+parseInt(IV3R5C4)+parseInt(IV3R6C4)+parseInt(IV3R7C4);*/
//NUMERAL 4 COLUMNA TECNOLOGO
/*COL 5 NUM 3*/
/*var IV3R1C5 = trim(document.capitulo4.IV3R1C5.value);
var IV3R2C5 = trim(document.capitulo4.IV3R2C5.value);
var IV3R3C5 = trim(document.capitulo4.IV3R3C5.value);
var IV3R4C5 = trim(document.capitulo4.IV3R4C5.value);
var IV3R5C5 = trim(document.capitulo4.IV3R5C5.value);
var IV3R6C5 = trim(document.capitulo4.IV3R6C5.value);
var IV3R7C5 = trim(document.capitulo4.IV3R7C5.value);
var IV3R8C5 = trim(document.capitulo4.IV3R8C5.value);
var TOTAL_COL5_3=parseInt(IV3R1C5)+parseInt(IV3R2C5)+parseInt(IV3R3C5)+parseInt(IV3R4C5)+parseInt(IV3R5C5)+parseInt(IV3R6C5)+parseInt(IV3R7C5);*/
//NUMERAL 4 COLUMNA TECNICO
/*COL 6 NUM 3*/
/*var IV4R1C6N = trim(document.capitulo4.IV4R1C6N.value);
var IV4R2C6N = trim(document.capitulo4.IV4R2C6N.value);
var IV4R3C6N = trim(document.capitulo4.IV4R3C6N.value);
var IV4R4C6N = trim(document.capitulo4.IV4R4C6N.value);
var IV4R5C6N = trim(document.capitulo4.IV4R5C6N.value);
var IV4R6C6N = trim(document.capitulo4.IV4R6C6N.value);
var IV4R7C6N = trim(document.capitulo4.IV4R7C6N.value);
var IV4R8C6N = trim(document.capitulo4.IV4R8C6N.value);
var TOTAL_COL6_3=parseInt(IV4R1C6N)+parseInt(IV4R2C6N)+parseInt(IV4R3C6N)+parseInt(IV4R4C6N)+parseInt(IV4R5C6N)+parseInt(IV4R6C6N)+parseInt(IV4R7C6N);*/

//NUMERAL 4 FILA CIENCIAS EXACTAS
/*FILA 1 NUM 3*/
/*var IV3R1C6 = trim(document.capitulo4.IV3R1C6.value);
var TOTAL_FIL1_3=parseInt(IV3R1C1)+parseInt(IV3R1C2)+parseInt(IV3R1C3)+parseInt(IV3R1C4)+parseInt(IV3R1C5)+parseInt(IV4R1C6N);*/
//NUMERAL 4 FILA CIENCIAS NATURALES
/*FILA 2 NUM 3*/
/*var IV3R2C6 = trim(document.capitulo4.IV3R2C6.value);
var TOTAL_FIL2_3=parseInt(IV3R2C1)+parseInt(IV3R2C2)+parseInt(IV3R2C3)+parseInt(IV3R2C4)+parseInt(IV3R2C5)+parseInt(IV4R2C6N);*/
//NUMERAL 4 FILA CIENCIAS DE LA SALUD
/*FILA 3 NUM 3*/
/*var IV3R3C6 = trim(document.capitulo4.IV3R3C6.value);
var TOTAL_FIL3_3=parseInt(IV3R3C1)+parseInt(IV3R3C2)+parseInt(IV3R3C3)+parseInt(IV3R3C4)+parseInt(IV3R3C5)+parseInt(IV4R3C6N);*/
//NUMERAL 4 FILA INGENIERIA ARQ, URBA Y AFINES
/*FILA 4 NUM 3*/
/*var IV3R4C6 = trim(document.capitulo4.IV3R4C6.value);
var TOTAL_FIL4_3=parseInt(IV3R4C1)+parseInt(IV3R4C2)+parseInt(IV3R4C3)+parseInt(IV3R4C4)+parseInt(IV3R4C5)+parseInt(IV4R4C6N);*/
//NUMERAL 4 FILA AGRONOMIA VETERINARIA Y AFINES
/*FILA 5 NUM 3*/
/*var IV3R5C6 = trim(document.capitulo4.IV3R5C6.value);
var TOTAL_FIL5_3=parseInt(IV3R5C1)+parseInt(IV3R5C2)+parseInt(IV3R5C3)+parseInt(IV3R5C4)+parseInt(IV3R5C5)+parseInt(IV4R5C6N);*/
//NUMERAL 4 FILA CIENCIAS SOCIALES
/*FILA 6 NUM 3*/
/*var IV3R6C6 = trim(document.capitulo4.IV3R6C6.value);
var TOTAL_FIL6_3=parseInt(IV3R6C1)+parseInt(IV3R6C2)+parseInt(IV3R6C3)+parseInt(IV3R6C4)+parseInt(IV3R6C5)+parseInt(IV4R6C6N);*/
//NUMERAL 4 FILA CIENCIAS HUMANAS
/*FILA 7 NUM 3*/
/*var IV3R7C6 = trim(document.capitulo4.IV3R7C6.value);
var TOTAL_FIL7_3=parseInt(IV3R7C1)+parseInt(IV3R7C2)+parseInt(IV3R7C3)+parseInt(IV3R7C4)+parseInt(IV3R7C5)+parseInt(IV4R7C6N);*/
//NUMERAL 4 FILA TOTAL PERSONAL SEGUN NIVEL EDUCATIVO
/*FILA 8 NUM 3*/
/*var IV3R8C6 = trim(document.capitulo4.IV3R8C6.value);
var TOTAL_FIL8_3=parseInt(IV3R8C1)+parseInt(IV3R8C2)+parseInt(IV3R8C3)+parseInt(IV3R8C4)+parseInt(IV3R8C5)+parseInt(IV4R8C6N);*/

//CAPITULO 4 NUMERAL 5
/*COL 1 NUM 4*/
var IV4R1C1 = trim(document.capitulo4.IV4R1C1.value);
var IV4R2C1 = trim(document.capitulo4.IV4R2C1.value);
var IV4R3C1 = trim(document.capitulo4.IV4R3C1.value);
var IV4R4C1 = trim(document.capitulo4.IV4R4C1.value);
var VARIABLEVERF = trim(document.capitulo4.IV4R4C1.value);
var TOTAL_COL1_4=parseInt(IV4R1C1)+parseInt(IV4R2C1)+parseInt(IV4R3C1);
/*COL 2 NUM 4*/
var IV4R1C2 = trim(document.capitulo4.IV4R1C2.value);
var IV4R2C2 = trim(document.capitulo4.IV4R2C2.value);
var IV4R3C2 = trim(document.capitulo4.IV4R3C2.value);
var IV4R4C2 = trim(document.capitulo4.IV4R4C2.value);
var VARIABLEVERF2 = trim(document.capitulo4.IV4R4C2.value);
var TOTAL_COL2_4=parseInt(IV4R1C2)+parseInt(IV4R2C2)+parseInt(IV4R3C2);



///////////*****VALIDACION NUEVA IV ******///////
///////////******VALIDACIONES DEL CAPITULO 4 NUMERAL 3**************///////////


var IV3R1C1N = trim(document.capitulo4.IV3R1C1N.value);
var IV3R1C2N = trim(document.capitulo4.IV3R1C2N.value);
var IV3R1C3N = trim(document.capitulo4.IV3R1C3N.value);
var TOTIV3R1C3N = parseInt(IV3R1C1N)+ parseInt(IV3R1C2N);

var IV3R2C1N = trim(document.capitulo4.IV3R2C1N.value);
var IV3R2C2N = trim(document.capitulo4.IV3R2C2N.value);
var IV3R2C3N = trim(document.capitulo4.IV3R2C3N.value);
var TOTIV3R2C3N = parseInt(IV3R2C1N)+ parseInt(IV3R2C2N);

var IV3R3C1N = trim(document.capitulo4.IV3R3C1N.value);
var IV3R3C2N = trim(document.capitulo4.IV3R3C2N.value);
var IV3R3C3N = trim(document.capitulo4.IV3R3C3N.value);
var TOTIV3R3C3N = parseInt(IV3R3C1N)+ parseInt(IV3R3C2N);

var IV3R4C1N = trim(document.capitulo4.IV3R4C1N.value);
var IV3R4C2N = trim(document.capitulo4.IV3R4C2N.value);
var IV3R4C3N = trim(document.capitulo4.IV3R4C3N.value);
var TOTIV3R4C3N = parseInt(IV3R4C1N)+ parseInt(IV3R4C2N);

var IV3R5C1N = trim(document.capitulo4.IV3R5C1N.value);
var IV3R5C2N = trim(document.capitulo4.IV3R5C2N.value);
var IV3R5C3N = trim(document.capitulo4.IV3R5C3N.value);
var TOTIV3R5C3N = parseInt(IV3R5C1N)+ parseInt(IV3R5C2N);

var IV3R6C1N = trim(document.capitulo4.IV3R6C1N.value);
var IV3R6C2N = trim(document.capitulo4.IV3R6C2N.value);
var IV3R6C3N = trim(document.capitulo4.IV3R6C3N.value);
var TOTIV3R6C3N = parseInt(IV3R6C1N)+ parseInt(IV3R6C2N);


var IV3R7C1N = trim(document.capitulo4.IV3R7C1N.value);
var IV3R7C2N = trim(document.capitulo4.IV3R7C2N.value);
var IV3R7C3N = trim(document.capitulo4.IV3R7C3N.value);
var TOTIV3R7C3N = parseInt(IV3R7C1N)+ parseInt(IV3R7C2N);

var IV3R8C1N = trim(document.capitulo4.IV3R8C1N.value);
var IV3R8C2N = trim(document.capitulo4.IV3R8C2N.value);
var IV3R8C3N = trim(document.capitulo4.IV3R8C3N.value);
var TOTIV3R8C3N = parseInt(IV3R8C1N)+ parseInt(IV3R8C2N);

var IV3R9C1N = trim(document.capitulo4.IV3R9C1N.value);
var IV3R9C2N = trim(document.capitulo4.IV3R9C2N.value);
var IV3R9C3N = trim(document.capitulo4.IV3R9C3N.value);
var TOTIV3R9C3N = parseInt(IV3R9C1N)+ parseInt(IV3R9C2N);

var IV3R10C1N = trim(document.capitulo4.IV3R10C1N.value);
var IV3R10C2N = trim(document.capitulo4.IV3R10C2N.value);
var IV3R10C3N = trim(document.capitulo4.IV3R10C3N.value);
var TOTIV3R10C3N = parseInt(IV3R10C1N)+ parseInt(IV3R10C2N);


var SUBTOT_IV3R6C1N = parseInt(IV3R7C1N)+ parseInt(IV3R8C1N) + parseInt(IV3R9C1N)+ parseInt(IV3R10C1N);
var SUBTOT_IV3R6C2N = parseInt(IV3R7C2N)+ parseInt(IV3R8C2N) + parseInt(IV3R9C2N)+ parseInt(IV3R10C2N);
var SUBTOT_IV3R6C3N = parseInt(IV3R7C3N)+ parseInt(IV3R8C3N) + parseInt(IV3R9C3N)+ parseInt(IV3R10C3N);

	
var IV3R11C1N = trim(document.capitulo4.IV3R11C1N.value);
var IV3R11C2N = trim(document.capitulo4.IV3R11C2N.value);
var IV3R11C3N = trim(document.capitulo4.IV3R11C3N.value);
var TOTIV3R11C3N = parseInt(IV3R11C1N)+ parseInt(IV3R11C2N);

var sumhom = parseInt(IV3R1C1N)+ parseInt(IV3R2C1N)+ parseInt(IV3R3C1N)+ parseInt(IV3R4C1N)+
						 parseInt(IV3R5C1N)+ parseInt(IV3R6C1N);


var summuj = parseInt(IV3R1C2N)+ parseInt(IV3R2C2N)+ parseInt(IV3R3C2N)+ parseInt(IV3R4C2N)+
						 parseInt(IV3R5C2N)+ parseInt(IV3R6C2N);

/////////////******VALIDACIONES DEL CAPITULO 4 NUMERAL 4**************///////////
var IV4R1C1N = trim(document.capitulo4.IV4R1C1N.value);
var IV4R1C2N = trim(document.capitulo4.IV4R1C2N.value);
var IV4R1C3N = trim(document.capitulo4.IV4R1C3N.value);

var sum1 = parseInt(IV4R1C2N)+ parseInt(IV4R1C3N);


/////////////******VALIDACIONES DEL CAPITULO 4 NUMERAL 5**************///////////
var IV5R1C1N = trim(document.capitulo4.IV5R1C1N.value);
var IV5R1C2N = trim(document.capitulo4.IV5R1C2N.value);
var IV5R1C3N = trim(document.capitulo4.IV5R1C3N.value);
var TOTIV5R1C3N = parseInt(IV5R1C1N)+ parseInt(IV5R1C2N);

var IV5R2C1N = trim(document.capitulo4.IV5R2C1N.value);
var IV5R2C2N = trim(document.capitulo4.IV5R2C2N.value);
var IV5R2C3N = trim(document.capitulo4.IV5R2C3N.value);
var TOTIV5R2C3N = parseInt(IV5R2C1N)+ parseInt(IV5R2C2N);

var IV5R3C1N = trim(document.capitulo4.IV5R3C1N.value);
var IV5R3C2N = trim(document.capitulo4.IV5R3C2N.value);
var IV5R3C3N = trim(document.capitulo4.IV5R3C3N.value);
var TOTIV5R3C3N = parseInt(IV5R3C1N)+ parseInt(IV5R3C2N);

var IV5R4C1N = trim(document.capitulo4.IV5R4C1N.value);
var IV5R4C2N = trim(document.capitulo4.IV5R4C2N.value);
var IV5R4C3N = trim(document.capitulo4.IV5R4C3N.value);
var TOTIV5R4C3N = parseInt(IV5R4C1N)+ parseInt(IV5R4C2N);

var IV5R5C1N = trim(document.capitulo4.IV5R5C1N.value);
var IV5R5C2N = trim(document.capitulo4.IV5R5C2N.value);
var IV5R5C3N = trim(document.capitulo4.IV5R5C3N.value);
var TOTIV5R5C3N = parseInt(IV5R5C1N)+ parseInt(IV5R5C2N);

var IV5R6C1N = trim(document.capitulo4.IV5R6C1N.value);
var IV5R6C2N = trim(document.capitulo4.IV5R6C2N.value);
var IV5R6C3N = trim(document.capitulo4.IV5R6C3N.value);
var TOTIV5R6C3N = parseInt(IV5R6C1N)+ parseInt(IV5R6C2N);

var IV5R7C1N = trim(document.capitulo4.IV5R7C1N.value);
var IV5R7C2N = trim(document.capitulo4.IV5R7C2N.value);
var IV5R7C3N = trim(document.capitulo4.IV5R7C3N.value);
var TOTIV5R7C3N = parseInt(IV5R7C1N)+ parseInt(IV5R7C2N);

var IV5R8C1N = trim(document.capitulo4.IV5R8C1N.value);
var IV5R8C2N = trim(document.capitulo4.IV5R8C2N.value);
var IV5R8C3N = trim(document.capitulo4.IV5R8C3N.value);
var TOTIV5R8C3N = parseInt(IV5R8C1N)+ parseInt(IV5R8C2N);

//variables departamentos

var VI7R1C1 = document.getElementById('VI7R1C1').value;
var VI7R1C3 = document.getElementById('VI7R1C3').value;
var VI7R1C5 = document.getElementById('VI7R1C5').value;
var VI7R2C1 = document.getElementById('VI7R2C1').value;
var VI7R2C3 = document.getElementById('VI7R2C3').value;
var VI7R2C5 = document.getElementById('VI7R2C5').value;
var VI7R3C1 = document.getElementById('VI7R3C1').value;
var VI7R3C3 = document.getElementById('VI7R3C3').value;
var VI7R3C5 = document.getElementById('VI7R3C5').value;
var VI7R4C1 = document.getElementById('VI7R4C1').value;
var VI7R4C3 = document.getElementById('VI7R4C3').value;
var VI7R4C5 = document.getElementById('VI7R4C5').value;
var VI7R5C1 = document.getElementById('VI7R5C1').value;
var VI7R5C3 = document.getElementById('VI7R5C3').value;
var VI7R5C5 = document.getElementById('VI7R5C5').value;
var VI7R6C1 = document.getElementById('VI7R6C1').value;
var VI7R6C3 = document.getElementById('VI7R6C3').value;
var VI7R6C5 = document.getElementById('VI7R6C5').value;
var VI7R7C1 = document.getElementById('VI7R7C1').value;
var VI7R7C3 = document.getElementById('VI7R7C3').value;
var VI7R7C5 = document.getElementById('VI7R7C5').value;
var VI7R8C1 = document.getElementById('VI7R8C1').value;
var VI7R8C3 = document.getElementById('VI7R8C3').value;
var VI7R8C5 = document.getElementById('VI7R8C5').value;
var VI7R9C1 = document.getElementById('VI7R9C1').value;
var VI7R9C3 = document.getElementById('VI7R9C3').value;
var VI7R9C5 = document.getElementById('VI7R9C5').value;
var VI7R10C1 = document.getElementById('VI7R10C1').value;
var VI7R10C3 = document.getElementById('VI7R10C3').value;
var VI7R10C5 = document.getElementById('VI7R10C5').value;
var VI7R11C1 = document.getElementById('VI7R11C1').value;
var VI7R11C3 = document.getElementById('VI7R11C3').value;
var VI7R11C5 = document.getElementById('VI7R11C5').value;

var VI7R1C2 = document.getElementById('VI7R1C2').value;
var VI7R1C4 = document.getElementById('VI7R1C4').value;
var VI7R1C6 = document.getElementById('VI7R1C6').value;
var VI7R2C2 = document.getElementById('VI7R2C2').value;
var VI7R2C4 = document.getElementById('VI7R2C4').value;
var VI7R2C6 = document.getElementById('VI7R2C6').value;
var VI7R3C2 = document.getElementById('VI7R3C2').value;
var VI7R3C4 = document.getElementById('VI7R3C4').value;
var VI7R3C6 = document.getElementById('VI7R3C6').value;
var VI7R4C2 = document.getElementById('VI7R4C2').value;
var VI7R4C4 = document.getElementById('VI7R4C4').value;
var VI7R4C6 = document.getElementById('VI7R4C6').value;
var VI7R5C2 = document.getElementById('VI7R5C2').value;
var VI7R5C4 = document.getElementById('VI7R5C4').value;
var VI7R5C6 = document.getElementById('VI7R5C6').value;
var VI7R6C2 = document.getElementById('VI7R6C2').value;
var VI7R6C4 = document.getElementById('VI7R6C4').value;
var VI7R6C6 = document.getElementById('VI7R6C6').value;
var VI7R7C2 = document.getElementById('VI7R7C2').value;
var VI7R7C4 = document.getElementById('VI7R7C4').value;
var VI7R7C6 = document.getElementById('VI7R7C6').value;
var VI7R8C2 = document.getElementById('VI7R8C2').value;
var VI7R8C4 = document.getElementById('VI7R8C4').value;
var VI7R8C6 = document.getElementById('VI7R8C6').value;
var VI7R9C2 = document.getElementById('VI7R9C2').value;
var VI7R9C4 = document.getElementById('VI7R9C4').value;
var VI7R9C6 = document.getElementById('VI7R9C6').value;
var VI7R10C2 = document.getElementById('VI7R10C2').value;
var VI7R10C4 = document.getElementById('VI7R10C4').value;
var VI7R10C6 = document.getElementById('VI7R10C6').value;
var VI7R11C2 = document.getElementById('VI7R11C2').value;
var VI7R11C4 = document.getElementById('VI7R11C4').value;
var VI7R11C6 = document.getElementById('VI7R11C6').value;

var total_dep12 = parseInt(VI7R1C1)+parseInt(VI7R1C3)+parseInt(VI7R1C5)+parseInt(VI7R2C1)+parseInt(VI7R2C3)+parseInt(VI7R2C5)+
	parseInt(VI7R3C1)+parseInt(VI7R3C3)+parseInt(VI7R3C5)+parseInt(VI7R4C1)+parseInt(VI7R4C3)+parseInt(VI7R4C5)+
	parseInt(VI7R5C1)+parseInt(VI7R5C3)+parseInt(VI7R5C5)+parseInt(VI7R6C1)+parseInt(VI7R6C3)+parseInt(VI7R6C5)+
	parseInt(VI7R7C1)+parseInt(VI7R7C3)+parseInt(VI7R7C5)+parseInt(VI7R8C1)+parseInt(VI7R8C3)+parseInt(VI7R8C5)+
	parseInt(VI7R9C1)+parseInt(VI7R9C3)+parseInt(VI7R9C5)+parseInt(VI7R10C1)+parseInt(VI7R10C3)+parseInt(VI7R10C5)+
	parseInt(VI7R11C1)+parseInt(VI7R11C3)+parseInt(VI7R11C5);

var total_dep13 = parseInt(VI7R1C2)+parseInt(VI7R1C4)+parseInt(VI7R1C6)+parseInt(VI7R2C2)+parseInt(VI7R2C4)+parseInt(VI7R2C6)+
	parseInt(VI7R3C2)+parseInt(VI7R3C4)+parseInt(VI7R3C6)+parseInt(VI7R4C2)+parseInt(VI7R4C4)+parseInt(VI7R4C6)+
	parseInt(VI7R5C2)+parseInt(VI7R5C4)+parseInt(VI7R5C6)+parseInt(VI7R6C2)+parseInt(VI7R6C4)+parseInt(VI7R6C6)+
	parseInt(VI7R7C2)+parseInt(VI7R7C4)+parseInt(VI7R7C6)+parseInt(VI7R8C2)+parseInt(VI7R8C4)+parseInt(VI7R8C6)+
	parseInt(VI7R9C2)+parseInt(VI7R9C4)+parseInt(VI7R9C6)+parseInt(VI7R10C2)+parseInt(VI7R10C4)+parseInt(VI7R10C6)+
	parseInt(VI7R11C2)+parseInt(VI7R11C4)+parseInt(VI7R11C6);

var sumhom2 = parseInt(IV5R1C1N)+ parseInt(IV5R2C1N) + parseInt(IV5R3C1N)+ parseInt(IV5R4C1N) + parseInt(IV5R5C1N)+ parseInt(IV5R6C1N) + parseInt(IV5R7C1N);
var summuj2 = parseInt(IV5R1C2N)+ parseInt(IV5R2C2N) + parseInt(IV5R3C2N)+ parseInt(IV5R4C2N) + parseInt(IV5R5C2N)+ parseInt(IV5R6C2N) + parseInt(IV5R7C2N);

		for(j=0 ;  j <= document.capitulo4.elements.length-1; j++ ){	
			if(document.capitulo4.elements[j].value=='' && document.capitulo4.elements[j].type!='hidden' && document.capitulo4.elements[j].type!="textarea" &&  document.capitulo4.elements[j].disabled !=true){
	 			alert('Por favor diligencie el campo: '+document.capitulo4.elements[j].title);
				document.capitulo4.elements[j].focus();
				return (false);
				sw=1;
    		}
	    if( document.capitulo4.elements[j].name=='IV1R11C1' && IV1R11C1!='' && IV1R11C1 != TOTAL_COL1 ){
			alert ("Cap. 4 Num. 1 - Por favor verifique la suma del total de empleados que laboraron en la empresa durante el <?php echo $_SESSION['anioant'] ?> y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV1R11C1.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV1R11C2' && IV1R11C2!='' && IV1R11C2 != TOTAL_COL2 ){
			alert ("Cap. 4 Num. 1 - Por favor verifique la suma del total de empleados que laboraron en la empresa durante el <?php echo $_SESSION['vigencia'] ?> y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV1R11C2.focus();
			return (false);
			sw=1;
		}
		 if( document.capitulo4.elements[j].name=='IV1R1C1' && parseInt(IV1R1C3) > parseInt(IV1R1C1) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Doctorado para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R1C1.focus();
			return (false);
			sw=1;
		}
		
			if( document.capitulo4.elements[j].name=='IV1R2C1' &&  parseInt(IV1R2C3) > parseInt(IV1R2C1) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Maestría para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R2C1.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R3C1' && parseInt(IV1R3C3) >  parseInt(IV1R3C1)){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Especializaci\u00f3n para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R3C1.focus();
			return (false);
			sw=1;
		}

			if( document.capitulo4.elements[j].name=='IV1R4C1' && parseInt(IV1R4C1) < parseInt(IV1R4C3) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Universitario para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R4C1.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R5C1' && parseInt(IV1R5C1) < parseInt(IV1R5C3) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Tecn\u00f3logo para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R5C1.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R6C1' && parseInt(IV1R6C1) < parseInt(IV1R6C3) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Tecnico para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R6C1.focus();
			return (false);
			sw=1;
		}
		
			if( document.capitulo4.elements[j].name=='IV1R7C1' && parseInt(IV1R7C1) < parseInt(IV1R7C3) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Educaci\u00f3n Secundaria para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R7C1.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R8C1' && parseInt(IV1R8C1) < parseInt(IV1R8C3) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Educaci\u00f3n Primaria para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R8C1.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R9C1' && parseInt(IV1R9C1) < parseInt(IV1R9C3) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Trabajador Calificado - SENA para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R9C1.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R10C1' && parseInt(IV1R10C1) < parseInt(IV1R10C3) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado en el nivel Ninguno para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R10C1.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R11C1' && parseInt(IV1R11C1) < parseInt(IV1R11C3) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Total personal empleado para el <?php echo $_SESSION['anioant'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['anioant'] ?>.");
			document.capitulo4.IV1R11C1.focus();
			return (false);
			sw=1;
		}		
			if( document.capitulo4.elements[j].name=='IV1R1C2' && parseInt(IV1R1C2) < parseInt(IV1R1C4 )){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Doctorado para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R1C2.focus();
			return (false);
			sw=1;
		}		
			if( document.capitulo4.elements[j].name=='IV1R2C2' &&  parseInt(IV1R2C4)> parseInt(IV1R2C2) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Maestria para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R2C2.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R3C2' && parseInt(IV1R3C2) < parseInt(IV1R3C4) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Especializaci\u00f3n para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R3C2.focus();
			return (false);
			sw=1;
		}

			if( document.capitulo4.elements[j].name=='IV1R4C2' && parseInt(IV1R4C2) < parseInt(IV1R4C4) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Universitario para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R4C2.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R5C2' && parseInt(IV1R5C2) < parseInt(IV1R5C4) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Tecn\u00f3logo para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R5C2.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R6C2' && parseInt(IV1R6C2) < parseInt(IV1R6C4) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Tecnico para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R6C2.focus();
			return (false);
			sw=1;
		}
		
			if( document.capitulo4.elements[j].name=='IV1R7C2' && parseInt(IV1R7C2) < parseInt(IV1R7C4) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Educaci\u00f3n Secundaria para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R7C2.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R8C2' && parseInt(IV1R8C2) < parseInt(IV1R8C4 )){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Educaci\u00f3n Primaria para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R8C2.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R9C2' && parseInt(IV1R9C2) < parseInt(IV1R9C4) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Trabajador Calificado - SENA para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R9C2.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R10C2' && parseInt(IV1R10C2) < parseInt(IV1R10C4) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado en el nivel Ninguno para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R10C2.focus();
			return (false);
			sw=1;
		}
			if( document.capitulo4.elements[j].name=='IV1R11C2' && parseInt(IV1R11C2) < parseInt(IV1R11C4) ){
			alert ("Cap. 4 Num. 1 - Por favor verifique el valor asignado para Total personal empleado para el <?php echo $_SESSION['vigencia'] ?> en el No. de empleados que participó en la realización de actividades científicas, este debe ser menor o igual al No. de empleados  -  tiempo completo o permanente para el <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV1R11C2.focus();
			return (false);
			sw=1;
		}
		
	    if( document.capitulo4.elements[j].name=='IV1R11C3' && IV1R11C3!='' && IV1R11C3 != TOTAL_COL3 &&  		document.capitulo4.elements[j].disabled !=true){
			alert ("Cap. 4 Num. 1 - Por favor verifique la suma del total de empleados que particip\u00f3 en la realizaci\u00f3n de actividades cient\u00edficas, tecnol\u00f3gicas y de innovaci\u00f3n durante el <?php echo $_SESSION['anioant'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV1R11C3.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV1R11C4' && IV1R11C4!='' && IV1R11C4 != TOTAL_COL4 &&  		document.capitulo4.elements[j].disabled !=true){
			alert ("Cap. 4 Num. 1 - Por favor verifique la suma del total de empleados que particip\u00f3 en la realizaci\u00f3n de actividades cient\u00edficas, tecnol\u00f3gicas y de innovaci\u00f3n durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV1R11C4.focus();
			return (false);
			sw=1;
		}
	    /*if( document.capitulo4.elements[j].name=='IV2R7C1' && IV2R7C1 != '' && IV2R7C1 != TOTAL_COL1_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de doctorado durante el 2011, y/o verifique los valores consignados en cada una de los &aacute;reas funcionales que componen este total.");
			document.capitulo4.IV2R7C1.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV2R7C2'  && IV2R7C2 != '' && IV2R7C2 != TOTAL_COL2_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de Maestr&iacute;a durante el 2011, y/o verifique los valores consignados en cada una de los &aacute;reas funcionales que componen este total.");
			document.capitulo4.IV2R7C2.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV2R7C3'  && IV2R7C3 != '' && IV2R7C3 != TOTAL_COL3_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de Especializaci&oacute;n durante el 2011, y/o verifique los valores consignados en cada una de los &aacute;reas funcionales que componen este total.");
			document.capitulo4.IV2R7C3.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV2R7C4'  && IV2R7C4 != ''&& IV2R7C4 != TOTAL_COL4_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de Universitario (t&iacute; Profesional) durante el 2011, y/o verifique los valores consignados en cada una de los &aacute;reas funcionales que componen este total.");
			document.capitulo4.IV2R7C4.focus();
			return (false);
			sw=1;
		}*/
			//tecnologo capitulo 4 numeral 3
			if( document.capitulo4.elements[j].name=='IV2R7C5'  && IV2R7C5 != ''&& IV2R7C5 != TOTAL_COL5_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m\u00e1ximo educativo es Tecn\u00f3logo durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de los \u00e1reas funcionales que componen este total.");
			document.capitulo4.IV2R7C5.focus();
			return (false);
			sw=1;
		}
		    //tecnologo capitulo 4 numeral 3
			if( document.capitulo4.elements[j].name=='IV2R7C5'  && IV2R7C5 != IV1R5C2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron durante el <?php echo $_SESSION['vigencia'] ?> y cuyo nivel educativo es Tecn\u00f3logo, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total en el Numeral 1 Item 5 y 6.");
			document.capitulo4.IV2R7C5.focus();
			return (false);
			sw=1;
		}
			//tecnico capitulo 4 numeral 3
			if( document.capitulo4.elements[j].name=='IV3R7C6N'  && IV3R7C6N != ''&& IV3R7C6N != TOTAL_COL6_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m\u00e1ximo educativo es Tecnico durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de los \u00e1reas funcionales que componen este total.");
			document.capitulo4.IV3R7C6N.focus();
			return (false);
			sw=1;
		}
		    //tecnico capitulo 4 numeral 3
			if( document.capitulo4.elements[j].name=='IV3R7C6N'  && IV3R7C6N != IV1R6C2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron durante el <?php echo $_SESSION['vigencia'] ?> y cuyo nivel educativo es Tecnico, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total en el Numeral 1 Item 5 y 6.");
			document.capitulo4.IV3R7C6N.focus();
			return (false);
			sw=1;
		}
		
		
	    if( document.capitulo4.elements[j].name=='IV2R1C6'  && IV2R1C6 != TOTAL_FIL1_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en el \u00e1rea de direcci\u00f3n general durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV2R1C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV2R2C6'  && IV2R2C6 != TOTAL_FIL2_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en el \u00e1rea de administraci\u00f3n durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV2R2C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV2R3C6'  && IV2R3C6 != TOTAL_FIL3_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en el \u00e1rea de mercadeo y ventas durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV2R3C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV2R4C6' && IV2R4C6 != TOTAL_FIL4_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en el \u00e1rea contable y financiera durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV2R4C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV2R5C6' && IV2R5C6 != TOTAL_FIL5_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en el \u00e1rea contable y financiera durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV2R5C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV2R6C6' && IV2R6C6 != TOTAL_FIL6_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en el \u00e1rea de investigaci\u00f3n y desarrollo  durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV2R6C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV2R7C6' && IV2R7C6 != TOTAL_FIL7_2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en la empresa durante el <?php echo $_SESSION['vigencia'] ?> y/o verifique los valores consignados en cada una de las cantidades de empleados in gresados en el numeral 1 de este capitulo en los titulo Doctorado, Maestria, Especializacion Universitario, Tecnico y Tecn\u00f3logo al a\u00f1o <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV2R7C6.focus();
			return (false);
			sw=1;
		}
		
		if( document.capitulo4.elements[j].name=='IV2R7C6' && IV2R7C6 != TOTAL_PARCIAL ){
			alert ("Cap. 4 Num. 3 - Por favor verifique el valor total consignado frente a la sumatoria de los valores ingresados para los niveles educativos Doctorado, Mestria, Especializaci\u00f3n, Universitario, Tecnico y Tecn\u00f3logo del Numeral 1 A\u00f1o <?php echo $_SESSION['vigencia'] ?>.");
			document.capitulo4.IV2R7C6.focus();
			return (false);
			sw=1;
		}
		
		/*if( IV2R7C1 == TOTAL_COL1_2 &&  IV2R7C1!='' && IV2R7C1 != IV1R1C2 ){
			alert ("Por favor verifique: Doctorado - Cap. 4 Num.3 - Por favor indique el n&uacute;mero verifique la suma del total de empleados capacitados y/o financiados por la empresa durante el 2011, y/o verifique los valores consignados en cada uno de los niveles de capacitaci&oacute;n que componen este total.");
			document.capitulo4.IV2R7C1.focus();
			return (false);
			sw=1;
		}
		if(  IV2R7C2 == TOTAL_COL2_2 &&  IV2R7C2!='' && IV2R7C2 != IV1R2C2 ){
			alert ("Por favor verifique: Maestria - Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de Maestr&iacute;a durante el 2011, y/o verifique los valores consignados en cada una de los &aacute;reas funcionales que componen este total.");
			document.capitulo4.IV2R7C2.focus();
			return (false);
			sw=1;
		}
		if(  IV2R7C3 == TOTAL_COL3_2 &&  IV2R7C3!='' &&  IV2R7C3 != IV1R3C2 ){
			alert ("Por favor verifique: Especializaci&oacute;n  - Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de Especializaci&oacute;n durante el 2011, y/o verifique los valores consignados en cada una de los &aacute;reas funcionales que componen este total.");
			document.capitulo4.IV2R7C3.focus();
			return (false);
			sw=1;
		}
		if(    IV2R7C4 == TOTAL_COL4_2 &&  IV2R7C4!='' &&  IV2R7C4 != IV1R4C2 ){
			alert ("Por favor verifique: Universitario (t&iacute; Profesional)  - Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de Universitario (t&iacute; Profesional) durante el 2011, y/o verifique los valores consignados en cada una de los &aacute;reas funcionales que componen este total.");
			document.capitulo4.IV2R7C4.focus();
			return (false);
			sw=1;
		}*/
		
		if( document.capitulo4.elements[j].name=='IV3R8C1' && IV3R8C1!='' && IV3R8C1 != TOTAL_COL1_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m\u00e1ximo educativo de doctorado durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de los \u00e1reas de formaci\u00f3n que componen este total.");
			document.capitulo4.IV3R8C1.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV3R8C2' && IV3R8C2!='' && IV3R8C2 != TOTAL_COL2_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m\u00e1ximo educativo de Maestr\u00eda durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de los \u00e1reas de formaci\u00f3n que componen este total.");
			document.capitulo4.IV3R8C2.focus();
			return (false);

			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV3R8C3' && IV3R8C3!='' && IV3R8C3 != TOTAL_COL3_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m\u00e1ximo educativo de Especializaci\u00f3n durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de los \u00e1reas de formaci\u00f3n que componen este total.");
			document.capitulo4.IV3R8C3.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV3R8C4' && IV3R8C4!='' && IV3R8C4 != TOTAL_COL4_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m\u00e1ximo educativo de Universitario (T\u00edtulo Profesional) durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de los \u00e1reas de formaci\u00f3n que componen este total.");
			document.capitulo4.IV3R8C4.focus();
			return (false);
			sw=1;
		}
		    //Tecnologo capitulo 4 numeral 4
			if( document.capitulo4.elements[j].name=='IV3R8C5' && IV3R8C5!='' && IV3R8C5 != TOTAL_COL5_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m\u00e1ximo educativo de Tecn\u00f3logo durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de los \u00e1reas de formaci\u00f3n que componen este total.");
			document.capitulo4.IV3R8C5.focus();
			return (false);
			sw=1;
		}
			//Tecnologo capitulo 4 numeral 4 contra tecnologo del numeral 1
		    if( document.capitulo4.elements[j].name=='IV3R8C5'  && IV3R8C5 != IV1R5C2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron durante el <?php echo $_SESSION['vigencia'] ?> y cuyo nivel educativo es Tecn\u00f3logo, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total en el Numeral 1 Item 5 y 6.");
			document.capitulo4.IV3R8C5.focus();
			return (false);
			sw=1;
		}
			//Tecnico capitulo 4 numeral 4 
			if( document.capitulo4.elements[j].name=='IV4R8C6N' && IV4R8C6N!='' && IV4R8C6N != TOTAL_COL6_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m\u00e1ximo educativo de Tecnico durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de los \u00e1reas de formaci\u00f3n que componen este total.");
			document.capitulo4.IV4R8C6N.focus();
			return (false);
			sw=1;
		}
			//Tecnico capitulo 4 numeral 4 contra tecnico del numeral 1
		    if( document.capitulo4.elements[j].name=='IV4R8C6N'  && IV4R8C6N != IV1R6C2 ){
			alert ("Cap. 4 Num. 3 - Por favor verifique la suma del total de empleados que laboraron durante el <?php echo $_SESSION['vigencia'] ?> y cuyo nivel educativo es Tecnico, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total en el Numeral 1 Item 5 y 6.");
			document.capitulo4.IV4R8C6N.focus();
			return (false);
			sw=1;
		}
		
		
		if( document.capitulo4.elements[j].name=='IV3R1C6' && IV3R1C6!='' && IV3R1C6 != TOTAL_FIL1_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron la empresa con formaci\u00f3n en ciencias exactas asociadas a la qu\u00edmica o f\u00edsica durante el <?php echo $_SESSION['anioant'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV3R1C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV3R2C6' && IV3R2C6!='' && IV3R2C6 != TOTAL_FIL2_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron la empresa con formaci\u00f3n en ciencias naturales durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV3R2C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV3R3C6' && IV3R3C6!='' && IV3R3C6 != TOTAL_FIL3_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron la empresa con formaci\u00f3n en ciencias de la salud durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV3R3C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV3R4C6' && IV3R4C6!='' && IV3R4C6 != TOTAL_FIL4_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron la empresa con formaci\u00f3n en Ingenier\u00eda, Arquitectura, Urbanismo y afines durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV3R4C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV3R5C6' && IV3R5C6!='' && IV3R5C6 != TOTAL_FIL5_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron la empresa con formaci\u00f3n en Agronom\u00eda, veterinaria y afines durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV3R5C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV3R6C6' && IV3R6C6!='' && IV3R6C6 != TOTAL_FIL6_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron la empresa con formaci\u00f3n en ciencias sociales durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV3R6C6.focus();
			return (false);
			sw=1;
		}
	    if( document.capitulo4.elements[j].name=='IV3R7C6' && IV3R7C6!='' && IV3R7C6 != TOTAL_FIL7_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron la empresa con formaci\u00f3n en ciencias humanas y bellas artes durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total.");
			document.capitulo4.IV3R7C6.focus();
			return (false);
			sw=1;
		}
			
	    if( document.capitulo4.elements[j].name=='IV3R8C6' && IV3R8C6!='' && IV3R8C6 != TOTAL_FIL8_3 ){
			alert ("Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa durante el <?php echo $_SESSION['vigencia'] ?> y/o verifique los valores consignados en cada una de las \u00e1reas de formaci\u00f3n seg\u00fan el nivel educativo que componen este total.");
			document.capitulo4.IV3R8C6.focus();
			return (false);
			sw=1;
		}
		/*if( document.capitulo4.elements[j].name=='IV3R8C1' && IV3R8C1 != IV2R7C1 ){
			alert ("Por favor verifique: Doctorado - Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de doctorado durante el <?php echo $_SESSION['anioant'] ?>, y/o verifique los valores consignados en cada una de los &aacute;reas de formaci&oacute;n que componen este total.");
			document.capitulo4.IV3R8C1.focus();
			return (false);
			sw=1;
		}
		if( document.capitulo4.elements[j].name=='IV3R8C2' && IV3R8C2 != IV2R7C2 ){
			alert ("Por favor verifique: Maestria - Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de Maestr&iacute;a durante el <?php echo $_SESSION['anioant'] ?> y/o verifique los valores consignados en cada una de los &aacute;reas de formaci&oacute;n que componen este total.");
			document.capitulo4.IV3R8C2.focus();
			return (false);
			sw=1;
		}
		if( document.capitulo4.elements[j].name=='IV3R8C3' && IV3R8C3 != IV2R7C3 ){
			alert ("Por favor verifique: Especializaci&oacute;n  - Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de Especializaci&oacute;n durante el <?php echo $_SESSION['anioant'] ?>, y/o verifique los valores consignados en cada una de los &aacute;reas de formaci&oacute;n que componen este total.");
			document.capitulo4.IV3R8C3.focus();
			return (false);
			sw=1;
		}
		if( document.capitulo4.elements[j].name=='IV3R8C4' && IV3R8C4 != IV2R7C4 ){
			alert ("Por favor verifique: Universitario (t&iacute; Profesional)  - Cap. 4 Num.4 - Por favor verifique la suma del total de empleados que laboraron en la empresa con nivel m&aacute;ximo educativo de Universitario (t&iacute; Profesional) durante el <?php echo $_SESSION['anioant'] ?>, y/o verifique los valores consignados en cada una de los &aacute;reas de formaci&oacute;n que componen este total.");
			document.capitulo4.IV3R8C4.focus();
			return (false);
			sw=1;
		}*/
		if(  document.capitulo4.elements[j].name=='' && IV4R4C1!='' && IV4R4C1 != TOTAL_COL1_4 ){
			alert ("Cap. 4 Num.7 - Por favor indique el n\u00famero verifique la suma del total de empleados capacitados y/o financiados por la empresa durante el <?php echo $_SESSION['anioant'] ?>, y/o verifique los valores consignados en cada uno de los niveles de capacitaci\u00f3n que componen este total.");
			document.capitulo4.IV4R4C1.focus();
			return (false);
			sw=1;
		}
		
	  if( document.capitulo4.elements[j].name=='IV4R4C2' && IV4R4C2!='' && IV4R4C2 != TOTAL_COL2_4 ){
			alert ("Cap. 4 Num.7 - Por favor indique el n\u00famero verifique la suma del total de empleados capacitados y/o financiados por la empresa durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles de capacitaci\u00f3n que componen este total.");
			document.capitulo4.IV4R4C1.value=IV4R4C1;
			document.capitulo4.IV4R4C2.focus();			
			return (false);
			sw=1;
		}
		

        if( document.capitulo4.elements[j].name=='IV4R4C1'  && parseInt(document.capitulo4.IV4R4C1.value) > parseInt(document.capitulo4.IV1R11C1.value) ){
			alert ("Cap. 4 Num.7 - El valor debe ser menor o igual al registrado en el numeral 1 (Total personal empleado)");
			document.capitulo4.IV4R4C1.focus();
			return (false);
			sw=1;
		}
		
		if( document.capitulo4.elements[j].name=='IV4R4C1'  && (document.capitulo4.IV4R4C1.value > 0) &&  (document.capitulo4.II1R9C1H.value < 1)  )
			{
			alert ("Cap. 4 Num.7 - El n\u00famero de empleados que recibieron algun tipo de capacitacion en el <?php echo $_SESSION['anioant'] ?> no corresponde con el valor diligenciado en el Capitulo 2 Numeral 1 Item 9");
			document.capitulo4.IV4R4C1.focus();
			return (false);
			sw=1;
		    } 
			
		if( document.capitulo4.elements[j].name=='IV4R4C1'  && (document.capitulo4.IV4R4C1.value = 0) &&  (document.capitulo4.II1R9C1H.value > 0 ) )
			{
			alert ("Cap. 4 Num.7 - El n\u00famero de empleados que recibieron algun tipo de capacitacion en el <?php echo $_SESSION['anioant'] ?> no corresponde con el valor diligenciado en el Capitulo 2 Numeral 1 Item 9");
			document.capitulo4.IV4R4C1.focus();
			return (false);
			sw=1;
		    }
			
			
		if( document.capitulo4.elements[j].name=='IV4R4C2'  && (document.capitulo4.IV4R4C2.value > 0) &&  (document.capitulo4.II1R9C2H.value < 1)  )
			{
			alert ("Cap. 4 Num.7 - El n\u00famero de empleados que recibieron algun tipo de capacitacion en el <?php echo $_SESSION['vigencia'] ?> no corresponde con el valor diligenciado en el Capitulo 2 Numeral 1 Item 9");
			document.capitulo4.IV4R4C2.focus();
			return (false);
			sw=1;
		    }
			
		if( document.capitulo4.elements[j].name=='IV4R4C2'  && (document.capitulo4.IV4R4C2.value = 0) &&  (document.capitulo4.II1R9C2H.value > 0)  )
			{
			alert ("Cap. 4 Num.7 - El n\u00famero de empleados que recibieron algun tipo de capacitacion en el <?php echo $_SESSION['vigencia'] ?> no corresponde con el valor diligenciado en el Capitulo 2 Numeral 1 Item 9");
			document.capitulo4.IV4R4C2.focus();
			return (false);
			sw=1;
		    }
			
			
	    if( document.capitulo4.elements[j].name=='IV4R4C2'  && parseInt(document.capitulo4.IV4R4C2.value) > parseInt(document.capitulo4.IV1R11C2.value) ){
			alert ("Cap. 4 Num.7 - El valor debe ser menor o igual al registrado en el numeral 1 (Total personal empleado)");
			document.capitulo4.IV4R4C2.focus();
			return (false);
			sw=1;
		}
		
		 if( TOTAL_COL2_4 > TOTAL_COL2){
			alert ("Cap. 4 Num.7 - El valor debe ser menor o igual al registrado en el numeral 1 (Total personal empleado)");
			document.capitulo4.IV4R4C2.focus();			
			return (false);
			sw=1;
		}
		
			if( document.capitulo4.elements[j].name=='IV5R1C1'  && parseInt(document.capitulo4.IV5R1C1.value) > parseInt(document.capitulo4.IV1R11C1.value) )
			{
			alert ("Cap. 4 Num.3 - El n\u00famero promedio de empleados con certificaciones debe ser menor o igual al numero total de empleados para el <?php echo $_SESSION['anioant'] ?>");
			document.capitulo4.IV5R1C1.focus();
			return (false);
			sw=1;
		    }
			
			if( document.capitulo4.elements[j].name=='IV5R1C2'  && parseInt(document.capitulo4.IV5R1C2.value) > parseInt(document.capitulo4.IV1R11C2.value) )
			{
			alert ("Cap. 4 Num.3 - El n\u00famero promedio de empleados con certificaciones debe ser menor o igual al numero total de empleados para el <?php echo $_SESSION['vigencia'] ?>");
			document.capitulo4.IV5R1C2.focus();
			return (false);
			sw=1;
		    }
      ////////////*******matriz del numeral 3 del capitulo 4***********//////////////
		 if( document.capitulo4.elements[j].name=='IV3R1C3N' && IV3R1C3N != TOTIV3R1C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R1C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R2C3N' && IV3R2C3N != TOTIV3R2C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R2C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R3C3N' && IV3R3C3N != TOTIV3R3C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R3C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R4C3N' && IV3R4C3N != TOTIV3R4C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R4C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R5C3N' && IV3R5C3N != TOTIV3R5C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R5C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R6C3N' && IV3R6C3N != TOTIV3R6C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R6C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R7C3N' && IV3R7C3N != TOTIV3R7C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R7C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R8C3N' && IV3R8C3N != TOTIV3R8C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R8C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R9C3N' && IV3R9C3N != TOTIV3R9C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R9C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R10C3N' && IV3R10C3N != TOTIV3R10C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R10C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R11C3N' && IV3R11C3N != TOTIV3R11C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R11C3N.focus();
				return (false);
				sw=1;
			}

		 if (!isNaN(TOTAL_COL4)) {
			 if( document.capitulo4.elements[j].name=='IV3R11C3N' && IV3R11C3N != IV1R11C4 ){
					//alert("TOTAL NUMERAL 3 COLUMNA 3 DIFERENTE DE TOTAL NUMERAL 1 COLUMNA 4");
					alert("El total de personal según área funcional y sexo debe ser igual al personal promedio que participó en actividades científicas, tecnológicas y de innovación para el <?php echo $_SESSION['vigencia'] ?> (Pregunta 1, total columna 4)");
					document.capitulo4.IV3R11C3N.focus();
					return (false);
					sw=1;
				}
		 }

		 if( document.capitulo4.elements[j].name=='IV3R11C1N' && IV3R11C1N != sumhom ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R11C1N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R11C2N' && IV3R11C2N != summuj ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R11C2N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R6C1N' && IV3R6C1N != SUBTOT_IV3R6C1N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R6C1N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R6C2N' && IV3R6C2N != SUBTOT_IV3R6C2N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R6C2N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV3R6C3N' && IV3R6C3N != SUBTOT_IV3R6C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV3R6C3N.focus();
				return (false);
				sw=1;
			}

		 ////////////*******numeral 4 del capitulo 4***********//////////////
		 
		 if( document.capitulo4.elements[j].name=='IV4R1C2N' && (sum1<=0) && IV4R1C1N==1 ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV4R1C2N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV4R1C3N' && (sum1<=0) && IV4R1C1N==1){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV4R1C3N.focus();
				return (false);
				sw=1;
			}

		 ////////////*******numeral 5 del capitulo 4***********//////////////

		 if( document.capitulo4.elements[j].name=='IV5R1C3N' && IV5R1C3N != TOTIV5R1C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R1C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV5R2C3N' && IV5R2C3N != TOTIV5R2C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R2C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV5R3C3N' && IV5R3C3N != TOTIV5R3C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R3C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV5R4C3N' && IV5R4C3N != TOTIV5R4C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R4C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV5R5C3N' && IV5R5C3N != TOTIV5R5C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R5C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV5R6C3N' && IV5R6C3N != TOTIV5R6C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R6C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV5R7C3N' && IV5R7C3N != TOTIV5R7C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R7C3N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV5R8C1N' && IV5R8C1N != sumhom2 ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R8C1N.focus();
				return (false);
				sw=1;
			}

		 if( document.capitulo4.elements[j].name=='IV5R8C2N' && IV5R8C2N != summuj2 ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R8C2N.focus();
				return (false);
				sw=1;
			}


		 if( document.capitulo4.elements[j].name=='IV5R8C3N' && IV5R8C3N != TOTIV5R8C3N ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R8C3N.focus();
				return (false);
				sw=1;
			}
/*
		 if( document.capitulo4.elements[j].name=='IV5R8C3N' && IV5R8C3N != IV1R11C4 ){
				alert(document.capitulo4.elements[j].title);
				document.capitulo4.IV5R8C3N.focus();
				return (false);
				sw=1;
			}
*/
		if(!isNaN(col4vs5)) {
			if (IV5R8C3N != col4vs5) {
				alert("El personal según área de formación y sexo debe ser igual al total de personal promedio con nivel de educación superior involucrado en actividades científicas, tecnológicas y de innovación para el <?php echo $_SESSION['vigencia'] ?> (Pregunta 1, total renglones 1 a 6 de la columna 4. )");
				document.capitulo4.IV5R8C3N.focus();
				return (false);
				sw=1;
			}
		}

		if (document.getElementById('VI7R12C5').disabled == false) {
			if (parseInt(document.getElementById('VI7R12C5').value) != parseInt(total_dep12)) {
				alert("Cap. 4 Num. 2 Col. 5 - Por favor verifique la suma del total de empleados promedio que participó en la realización de actividades científicas, tecnológicas y de innovación  durante <?php echo $_SESSION['anioant'] ?>  frente a su desagregación y/o verfique que no existan casillas en blanco");
				document.capitulo4.VI7R12C5.focus();
				return false;
				sw=1;
			}
			if (parseInt(document.getElementById('VI7R12C5').value) != parseInt(document.getElementById('IV1R11C3').value)) {
				alert("Cap. 4 Num. 2 Col. 5 - Por favor verifique Total del año <?php echo $_SESSION['anioant'] ?> sea igual al personal ocupado promedio que participó en actividades científicas, tecnológicas y de información en <?php echo $_SESSION['anioant'] ?> (pregunta IV.1 columna 3)");
				document.capitulo4.VI7R12C5.focus();
				return false;
				sw=1;
			}
		}
		if (document.getElementById('VI7R12C6').disabled == false) {
			if (parseInt(document.getElementById('VI7R12C6').value) != parseInt(total_dep13)) {
				alert("Cap. 4 Num. 2 Col. 6 - Por favor verifique la suma del total de empleados promedio que participó en la realización de actividades cientifícas, tecnológicas y de innovación  durante <?php echo $_SESSION['vigencia'] ?>  frente a su desagregación y/o verfique que no existan casillas en blanco");
				document.capitulo4.VI7R12C6.focus();
				return false;
				sw=1;
			}
			if (parseInt(document.getElementById('VI7R12C6').value) != parseInt(document.getElementById('IV1R11C4').value)) {
				alert("Cap. 4 Num. 2 Col. 6 - Por favor verifique Total del año <?php echo $_SESSION['VIGENCIA'] ?> sea igual al personal ocupado promedio que participó en actividades científicas, tecnológicas y de información en <?php echo $_SESSION['VIGENCIA'] ?> (pregunta IV.1 columna 4)");
				document.capitulo4.VI7R12C6.focus();
				return false;
				sw=1;
			}
		}

		/*if( document.capitulo4.IV4R1C1.value==0 && document.capitulo4.II1R9C1H.value > 0)
			{
			alert ("Cap. 4 Num.5 - El n&uacute;mero de empleados que recibieron algun tipo de capacitacion en el 2011 no corresponde con el valor diligenciado en el Capitulo 2 Numeral 1 Item 9");
			document.capitulo4.IV4R1C1.focus();
			return (false);
			sw=1;
		    }
			if( document.capitulo4.IV4R1C2.value==0 && document.capitulo4.II1R9C2H.value > 0)
			{
			alert ("Cap. 4 Num.5 - El n&uacute;mero de empleados que recibieron algun tipo de capacitacion en el 2012 no corresponde con el valor diligenciado en el Capitulo 2 Numeral 1 Item 9");
			document.capitulo4.IV4R1C2.focus();
			return (false);
			sw=1;
		    }*/


document.capitulo4.IV4R4C1.value=VARIABLEVERF;
document.capitulo4.IV4R4C2.value=VARIABLEVERF2;
	
}

if (sumhom < sumhom2) {
	alert("Total hombres pregunta 6 debe ser menor o igual que total hombres pregunta 4");
	document.capitulo4.IV3R11C1N.focus();
	return false;
	sw=1;
}

if (summuj < summuj2) {
	alert("Total mujeres pregunta 6 debe ser menor o igual que total mujeres pregunta 4");
	document.capitulo4.IV3R11C2N.focus();
	return false;
	sw=1;
}
	
if(sw==0)
   {
	   //alert ("Est\u00f1 siiii");
	   if (confirm('Est\u00e1 seguro de enviar los datos actualizados? Pulse: \n\n * Aceptar: S\u00ed su respuesta es afirmativa.\n\n  Una vez enviado solo podr\u00e1 consultarlo'))
		  //document.capitulo4.submit();
		
		  return 3;
	  else
	     return (false);
   }
}
function showhide(capa)
{
obj=document.getElementById(capa);
obj.style.display=obj.style.display=='none'?'block':'none';
}

function sum (valor, id)
{
	var val=valor;
	var nom=id;
	//alert (id+"---"+valor);
}
function activa_campos (valor)
{
	var val=valor;
	if (val!=2)
	{
		//alert ("aqui primero");
			document.forms[0].IV4R1C2N.disabled= false;
			document.forms[0].IV4R1C3N.disabled= false;
	}
	else 
	{
		//alert ("despues");
		document.forms[0].IV4R1C2N.disabled= true;
		document.forms[0].IV4R1C3N.disabled= true;

		document.forms[0].IV4R1C2N.value = 0;
		document.forms[0].IV4R1C3N.value = 0;
				
	}
}

function inactivar_col(columna)
{
	switch (columna)
	{
	case "IV3R6C1N":
		if (document.getElementById("IV3R6C1N").value > 0) {
			document.getElementById("IV3R7C1N").disabled = false;
			document.getElementById("IV3R8C1N").disabled = false;
			document.getElementById("IV3R9C1N").disabled = false;
			document.getElementById("IV3R10C1N").disabled = false;
		}
		else {
			document.getElementById("IV3R7C1N").disabled = true;
			document.getElementById("IV3R8C1N").disabled = true;
			document.getElementById("IV3R9C1N").disabled = true;
			document.getElementById("IV3R10C1N").disabled = true;
			document.getElementById("IV3R7C1N").value = 0;
			document.getElementById("IV3R8C1N").value = 0;
			document.getElementById("IV3R9C1N").value = 0;
			document.getElementById("IV3R10C1N").value = 0;
		}
	case "IV3R6C2N":
		if (document.getElementById("IV3R6C2N").value > 0) {
			document.getElementById("IV3R7C2N").disabled = false;
			document.getElementById("IV3R8C2N").disabled = false;
			document.getElementById("IV3R9C2N").disabled = false;
			document.getElementById("IV3R10C2N").disabled = false;
		}
		else {
			document.getElementById("IV3R7C2N").disabled = true;
			document.getElementById("IV3R8C2N").disabled = true;
			document.getElementById("IV3R9C2N").disabled = true;
			document.getElementById("IV3R10C2N").disabled = true;
			document.getElementById("IV3R7C2N").value = 0;
			document.getElementById("IV3R8C2N").value = 0;
			document.getElementById("IV3R9C2N").value = 0;
			document.getElementById("IV3R10C2N").value = 0;
		}
	case "IV3R6C3N":
		if (document.getElementById("IV3R6C3N").value > 0) {
			document.getElementById("IV3R7C3N").disabled = false;
			document.getElementById("IV3R8C3N").disabled = false;
			document.getElementById("IV3R9C3N").disabled = false;
			document.getElementById("IV3R10C3N").disabled = false;
		}
		else {
			document.getElementById("IV3R7C3N").disabled = true;
			document.getElementById("IV3R8C3N").disabled = true;
			document.getElementById("IV3R9C3N").disabled = true;
			document.getElementById("IV3R10C3N").disabled = true;
			document.getElementById("IV3R7C3N").value = 0;
			document.getElementById("IV3R8C3N").value = 0;
			document.getElementById("IV3R9C3N").value = 0;
			document.getElementById("IV3R10C3N").value = 0;
		}
	}
}

function activa35()
{
	if (document.getElementById("IV1R11C4").value == 0) {
		document.getElementById("IV3R1C1N").disabled = true;
		document.getElementById("IV3R1C2N").disabled = true;
		document.getElementById("IV3R1C3N").disabled = true;
		document.getElementById("IV3R2C1N").disabled = true;
		document.getElementById("IV3R2C2N").disabled = true;
		document.getElementById("IV3R2C3N").disabled = true;
		document.getElementById("IV3R3C1N").disabled = true;
		document.getElementById("IV3R3C2N").disabled = true;
		document.getElementById("IV3R3C3N").disabled = true;
		document.getElementById("IV3R4C1N").disabled = true;
		document.getElementById("IV3R4C2N").disabled = true;
		document.getElementById("IV3R4C3N").disabled = true;
		document.getElementById("IV3R5C1N").disabled = true;
		document.getElementById("IV3R5C2N").disabled = true;
		document.getElementById("IV3R5C3N").disabled = true;
		document.getElementById("IV3R6C1N").disabled = true;
		document.getElementById("IV3R6C2N").disabled = true;
		document.getElementById("IV3R6C3N").disabled = true;
		document.getElementById("IV3R7C1N").disabled = true;
		document.getElementById("IV3R7C2N").disabled = true;
		document.getElementById("IV3R7C3N").disabled = true;
		document.getElementById("IV3R8C1N").disabled = true;
		document.getElementById("IV3R8C2N").disabled = true;
		document.getElementById("IV3R8C3N").disabled = true;
		document.getElementById("IV3R9C1N").disabled = true;
		document.getElementById("IV3R9C2N").disabled = true;
		document.getElementById("IV3R9C3N").disabled = true;
		document.getElementById("IV3R10C1N").disabled = true;
		document.getElementById("IV3R10C2N").disabled = true;
		document.getElementById("IV3R10C3N").disabled = true;
		document.getElementById("IV3R11C1N").disabled = true;
		document.getElementById("IV3R11C2N").disabled = true;
		document.getElementById("IV3R11C3N").disabled = true;

		document.getElementById("IV3R1C1N").value = 0;
		document.getElementById("IV3R1C2N").value = 0;
		document.getElementById("IV3R1C3N").value = 0;
		document.getElementById("IV3R2C1N").value = 0;
		document.getElementById("IV3R2C2N").value = 0;
		document.getElementById("IV3R2C3N").value = 0;
		document.getElementById("IV3R3C1N").value = 0;
		document.getElementById("IV3R3C2N").value = 0;
		document.getElementById("IV3R3C3N").value = 0;
		document.getElementById("IV3R4C1N").value = 0;
		document.getElementById("IV3R4C2N").value = 0;
		document.getElementById("IV3R4C3N").value = 0;
		document.getElementById("IV3R5C1N").value = 0;
		document.getElementById("IV3R5C2N").value = 0;
		document.getElementById("IV3R5C3N").value = 0;
		document.getElementById("IV3R6C1N").value = 0;
		document.getElementById("IV3R6C2N").value = 0;
		document.getElementById("IV3R6C3N").value = 0;
		document.getElementById("IV3R7C1N").value = 0;
		document.getElementById("IV3R7C2N").value = 0;
		document.getElementById("IV3R7C3N").value = 0;
		document.getElementById("IV3R8C1N").value = 0;
		document.getElementById("IV3R8C2N").value = 0;
		document.getElementById("IV3R8C3N").value = 0;
		document.getElementById("IV3R9C1N").value = 0;
		document.getElementById("IV3R9C2N").value = 0;
		document.getElementById("IV3R9C3N").value = 0;
		document.getElementById("IV3R10C1N").value = 0;
		document.getElementById("IV3R10C2N").value = 0;
		document.getElementById("IV3R10C3N").value = 0;
		document.getElementById("IV3R11C1N").value = 0;
		document.getElementById("IV3R11C2N").value = 0;
		document.getElementById("IV3R11C3N").value = 0;

		//Bloque para la pregunta 6. 
		var field41 = parseInt($("#IV1R1C4").val()); 	
		var field42 = parseInt($("#IV1R2C4").val());
		var field43 = parseInt($("#IV1R3C4").val());
		var field44 = parseInt($("#IV1R4C4").val());
		var field45 = parseInt($("#IV1R5C4").val());
		var field46 = parseInt($("#IV1R6C4").val());

		if ((field41==0)&&(field42==0)&&(field43==0)&&(field44==0)&&(field45==0)&&(field46==0)){
			document.getElementById("IV5R1C1N").disabled = true;
			document.getElementById("IV5R1C2N").disabled = true;
			document.getElementById("IV5R1C3N").disabled = true;
			document.getElementById("IV5R2C1N").disabled = true;
			document.getElementById("IV5R2C2N").disabled = true;
			document.getElementById("IV5R2C3N").disabled = true;
			document.getElementById("IV5R3C1N").disabled = true;
			document.getElementById("IV5R3C2N").disabled = true;
			document.getElementById("IV5R3C3N").disabled = true;
			document.getElementById("IV5R4C1N").disabled = true;
			document.getElementById("IV5R4C2N").disabled = true;
			document.getElementById("IV5R4C3N").disabled = true;
			document.getElementById("IV5R5C1N").disabled = true;
			document.getElementById("IV5R5C2N").disabled = true;
			document.getElementById("IV5R5C3N").disabled = true;
			document.getElementById("IV5R6C1N").disabled = true;
			document.getElementById("IV5R6C2N").disabled = true;
			document.getElementById("IV5R6C3N").disabled = true;
			document.getElementById("IV5R7C1N").disabled = true;
			document.getElementById("IV5R7C2N").disabled = true;
			document.getElementById("IV5R7C3N").disabled = true;
			document.getElementById("IV5R8C1N").disabled = true;
			document.getElementById("IV5R8C2N").disabled = true;
			document.getElementById("IV5R8C3N").disabled = true;
		}
		
		document.getElementById("IV5R1C1N").value = 0;
		document.getElementById("IV5R1C2N").value = 0;
		document.getElementById("IV5R1C3N").value = 0;
		document.getElementById("IV5R2C1N").value = 0;
		document.getElementById("IV5R2C2N").value = 0;
		document.getElementById("IV5R2C3N").value = 0;
		document.getElementById("IV5R3C1N").value = 0;
		document.getElementById("IV5R3C2N").value = 0;
		document.getElementById("IV5R3C3N").value = 0;
		document.getElementById("IV5R4C1N").value = 0;
		document.getElementById("IV5R4C2N").value = 0;
		document.getElementById("IV5R4C3N").value = 0;
		document.getElementById("IV5R5C1N").value = 0;
		document.getElementById("IV5R5C2N").value = 0;
		document.getElementById("IV5R5C3N").value = 0;
		document.getElementById("IV5R6C1N").value = 0;
		document.getElementById("IV5R6C2N").value = 0;
		document.getElementById("IV5R6C3N").value = 0;
		document.getElementById("IV5R7C1N").value = 0;
		document.getElementById("IV5R7C2N").value = 0;
		document.getElementById("IV5R7C3N").value = 0;
		document.getElementById("IV5R8C1N").value = 0;
		document.getElementById("IV5R8C2N").value = 0;
		document.getElementById("IV5R8C3N").value = 0;

		document.getElementById("VI7R1C2").disabled = true;
		document.getElementById("VI7R1C4").disabled = true;
		document.getElementById("VI7R1C6").disabled = true;
		document.getElementById("VI7R2C2").disabled = true;
		document.getElementById("VI7R2C4").disabled = true;
		document.getElementById("VI7R2C6").disabled = true;
		document.getElementById("VI7R3C2").disabled = true;
		document.getElementById("VI7R3C4").disabled = true;
		document.getElementById("VI7R3C6").disabled = true;
		document.getElementById("VI7R4C2").disabled = true;
		document.getElementById("VI7R4C4").disabled = true;
		document.getElementById("VI7R4C6").disabled = true;
		document.getElementById("VI7R5C2").disabled = true;
		document.getElementById("VI7R5C4").disabled = true;
		document.getElementById("VI7R5C6").disabled = true;
		document.getElementById("VI7R6C2").disabled = true;
		document.getElementById("VI7R6C4").disabled = true;
		document.getElementById("VI7R6C6").disabled = true;
		document.getElementById("VI7R7C2").disabled = true;
		document.getElementById("VI7R7C4").disabled = true;
		document.getElementById("VI7R7C6").disabled = true;
		document.getElementById("VI7R8C2").disabled = true;
		document.getElementById("VI7R8C4").disabled = true;
		document.getElementById("VI7R8C6").disabled = true;
		document.getElementById("VI7R9C2").disabled = true;
		document.getElementById("VI7R9C4").disabled = true;
		document.getElementById("VI7R9C6").disabled = true;
		document.getElementById("VI7R10C2").disabled = true;
		document.getElementById("VI7R10C4").disabled = true;
		document.getElementById("VI7R10C6").disabled = true;
		document.getElementById("VI7R11C2").disabled = true;
		document.getElementById("VI7R11C4").disabled = true;
		document.getElementById("VI7R11C6").disabled = true;
		document.getElementById("VI7R12C6").disabled = true;

		document.getElementById("VI7R1C2").value = 0;
		document.getElementById("VI7R1C4").value = 0;
		document.getElementById("VI7R1C6").value = 0;
		document.getElementById("VI7R2C2").value = 0;
		document.getElementById("VI7R2C4").value = 0;
		document.getElementById("VI7R2C6").value = 0;
		document.getElementById("VI7R3C2").value = 0;
		document.getElementById("VI7R3C4").value = 0;
		document.getElementById("VI7R3C6").value = 0;
		document.getElementById("VI7R4C2").value = 0;
		document.getElementById("VI7R4C4").value = 0;
		document.getElementById("VI7R4C6").value = 0;
		document.getElementById("VI7R5C2").value = 0;
		document.getElementById("VI7R5C4").value = 0;
		document.getElementById("VI7R5C6").value = 0;
		document.getElementById("VI7R6C2").value = 0;
		document.getElementById("VI7R6C4").value = 0;
		document.getElementById("VI7R6C6").value = 0;
		document.getElementById("VI7R7C2").value = 0;
		document.getElementById("VI7R7C4").value = 0;
		document.getElementById("VI7R7C6").value = 0;
		document.getElementById("VI7R8C2").value = 0;
		document.getElementById("VI7R8C4").value = 0;
		document.getElementById("VI7R8C6").value = 0;
		document.getElementById("VI7R9C2").value = 0;
		document.getElementById("VI7R9C4").value = 0;
		document.getElementById("VI7R9C6").value = 0;
		document.getElementById("VI7R10C2").value = 0;
		document.getElementById("VI7R10C4").value = 0;
		document.getElementById("VI7R10C6").value = 0;
		document.getElementById("VI7R11C2").value = 0;
		document.getElementById("VI7R11C4").value = 0;
		document.getElementById("VI7R11C6").value = 0;
		document.getElementById("VI7R12C6").value = 0;
	}
	else {
		document.getElementById("IV3R1C1N").disabled = false;
		document.getElementById("IV3R1C2N").disabled = false;
		document.getElementById("IV3R1C3N").disabled = false;
		document.getElementById("IV3R2C1N").disabled = false;
		document.getElementById("IV3R2C2N").disabled = false;
		document.getElementById("IV3R2C3N").disabled = false;
		document.getElementById("IV3R3C1N").disabled = false;
		document.getElementById("IV3R3C2N").disabled = false;
		document.getElementById("IV3R3C3N").disabled = false;
		document.getElementById("IV3R4C1N").disabled = false;
		document.getElementById("IV3R4C2N").disabled = false;
		document.getElementById("IV3R4C3N").disabled = false;
		document.getElementById("IV3R5C1N").disabled = false;
		document.getElementById("IV3R5C2N").disabled = false;
		document.getElementById("IV3R5C3N").disabled = false;
		document.getElementById("IV3R6C1N").disabled = false;
		document.getElementById("IV3R6C2N").disabled = false;
		document.getElementById("IV3R6C3N").disabled = false;
		document.getElementById("IV3R7C1N").disabled = false;
		document.getElementById("IV3R7C2N").disabled = false;
		document.getElementById("IV3R7C3N").disabled = false;
		document.getElementById("IV3R8C1N").disabled = false;
		document.getElementById("IV3R8C2N").disabled = false;
		document.getElementById("IV3R8C3N").disabled = false;
		document.getElementById("IV3R9C1N").disabled = false;
		document.getElementById("IV3R9C2N").disabled = false;
		document.getElementById("IV3R9C3N").disabled = false;
		document.getElementById("IV3R10C1N").disabled = false;
		document.getElementById("IV3R10C2N").disabled = false;
		document.getElementById("IV3R10C3N").disabled = false;
		document.getElementById("IV3R11C1N").disabled = false;
		document.getElementById("IV3R11C2N").disabled = false;
		document.getElementById("IV3R11C3N").disabled = false;

		//Bloque para la pregunta 6. 
		var field41 = parseInt($("#IV1R1C4").val()); 	
		var field42 = parseInt($("#IV1R2C4").val());
		var field43 = parseInt($("#IV1R3C4").val());
		var field44 = parseInt($("#IV1R4C4").val());
		var field45 = parseInt($("#IV1R5C4").val());
		var field46 = parseInt($("#IV1R6C4").val());

		if ((field41!=0)||(field42!=0)||(field43!=0)||(field44!=0)||(field45!=0)||(field46!=0)){
			document.getElementById("IV5R1C1N").disabled = false;
			document.getElementById("IV5R1C2N").disabled = false;
			document.getElementById("IV5R1C3N").disabled = false;
			document.getElementById("IV5R2C1N").disabled = false;
			document.getElementById("IV5R2C2N").disabled = false;
			document.getElementById("IV5R2C3N").disabled = false;
			document.getElementById("IV5R3C1N").disabled = false;
			document.getElementById("IV5R3C2N").disabled = false;
			document.getElementById("IV5R3C3N").disabled = false;
			document.getElementById("IV5R4C1N").disabled = false;
			document.getElementById("IV5R4C2N").disabled = false;
			document.getElementById("IV5R4C3N").disabled = false;
			document.getElementById("IV5R5C1N").disabled = false;
			document.getElementById("IV5R5C2N").disabled = false;
			document.getElementById("IV5R5C3N").disabled = false;
			document.getElementById("IV5R6C1N").disabled = false;
			document.getElementById("IV5R6C2N").disabled = false;
			document.getElementById("IV5R6C3N").disabled = false;
			document.getElementById("IV5R7C1N").disabled = false;
			document.getElementById("IV5R7C2N").disabled = false;
			document.getElementById("IV5R7C3N").disabled = false;
			document.getElementById("IV5R8C1N").disabled = false;
			document.getElementById("IV5R8C2N").disabled = false;
			document.getElementById("IV5R8C3N").disabled = false;
		}	

		document.getElementById("VI7R1C2").disabled = false;
		document.getElementById("VI7R1C4").disabled = false;
		document.getElementById("VI7R1C6").disabled = false;
		document.getElementById("VI7R2C2").disabled = false;
		document.getElementById("VI7R2C4").disabled = false;
		document.getElementById("VI7R2C6").disabled = false;
		document.getElementById("VI7R3C2").disabled = false;
		document.getElementById("VI7R3C4").disabled = false;
		document.getElementById("VI7R3C6").disabled = false;
		document.getElementById("VI7R4C2").disabled = false;
		document.getElementById("VI7R4C4").disabled = false;
		document.getElementById("VI7R4C6").disabled = false;
		document.getElementById("VI7R5C2").disabled = false;
		document.getElementById("VI7R5C4").disabled = false;
		document.getElementById("VI7R5C6").disabled = false;
		document.getElementById("VI7R6C2").disabled = false;
		document.getElementById("VI7R6C4").disabled = false;
		document.getElementById("VI7R6C6").disabled = false;
		document.getElementById("VI7R7C2").disabled = false;
		document.getElementById("VI7R7C4").disabled = false;
		document.getElementById("VI7R7C6").disabled = false;
		document.getElementById("VI7R8C2").disabled = false;
		document.getElementById("VI7R8C4").disabled = false;
		document.getElementById("VI7R8C6").disabled = false;
		document.getElementById("VI7R9C2").disabled = false;
		document.getElementById("VI7R9C4").disabled = false;
		document.getElementById("VI7R9C6").disabled = false;
		document.getElementById("VI7R10C2").disabled = false;
		document.getElementById("VI7R10C4").disabled = false;
		document.getElementById("VI7R10C6").disabled = false;
		document.getElementById("VI7R11C2").disabled = false;
		document.getElementById("VI7R11C4").disabled = false;
		document.getElementById("VI7R11C6").disabled = false;
		document.getElementById("VI7R12C6").disabled = false;
	}		
}

function activacol12()
{
	if (document.getElementById("IV1R11C3").value == 0) {
		document.getElementById("VI7R1C1").disabled = true;
		document.getElementById("VI7R1C3").disabled = true;
		document.getElementById("VI7R1C5").disabled = true;
		document.getElementById("VI7R2C1").disabled = true;
		document.getElementById("VI7R2C3").disabled = true;
		document.getElementById("VI7R2C5").disabled = true;
		document.getElementById("VI7R3C1").disabled = true;
		document.getElementById("VI7R3C3").disabled = true;
		document.getElementById("VI7R3C5").disabled = true;
		document.getElementById("VI7R4C1").disabled = true;
		document.getElementById("VI7R4C3").disabled = true;
		document.getElementById("VI7R4C5").disabled = true;
		document.getElementById("VI7R5C1").disabled = true;
		document.getElementById("VI7R5C3").disabled = true;
		document.getElementById("VI7R5C5").disabled = true;
		document.getElementById("VI7R6C1").disabled = true;
		document.getElementById("VI7R6C3").disabled = true;
		document.getElementById("VI7R6C5").disabled = true;
		document.getElementById("VI7R7C1").disabled = true;
		document.getElementById("VI7R7C3").disabled = true;
		document.getElementById("VI7R7C5").disabled = true;
		document.getElementById("VI7R8C1").disabled = true;
		document.getElementById("VI7R8C3").disabled = true;
		document.getElementById("VI7R8C5").disabled = true;
		document.getElementById("VI7R9C1").disabled = true;
		document.getElementById("VI7R9C3").disabled = true;
		document.getElementById("VI7R9C5").disabled = true;
		document.getElementById("VI7R10C1").disabled = true;
		document.getElementById("VI7R10C3").disabled = true;
		document.getElementById("VI7R10C5").disabled = true;
		document.getElementById("VI7R11C1").disabled = true;
		document.getElementById("VI7R11C3").disabled = true;
		document.getElementById("VI7R11C5").disabled = true;
		document.getElementById("VI7R12C5").disabled = true;

		document.getElementById("VI7R1C1").value = 0;
		document.getElementById("VI7R1C3").value = 0;
		document.getElementById("VI7R1C5").value = 0;
		document.getElementById("VI7R2C1").value = 0;
		document.getElementById("VI7R2C3").value = 0;
		document.getElementById("VI7R2C5").value = 0;
		document.getElementById("VI7R3C1").value = 0;
		document.getElementById("VI7R3C3").value = 0;
		document.getElementById("VI7R3C5").value = 0;
		document.getElementById("VI7R4C1").value = 0;
		document.getElementById("VI7R4C3").value = 0;
		document.getElementById("VI7R4C5").value = 0;
		document.getElementById("VI7R5C1").value = 0;
		document.getElementById("VI7R5C3").value = 0;
		document.getElementById("VI7R5C5").value = 0;
		document.getElementById("VI7R6C1").value = 0;
		document.getElementById("VI7R6C3").value = 0;
		document.getElementById("VI7R6C5").value = 0;
		document.getElementById("VI7R7C1").value = 0;
		document.getElementById("VI7R7C3").value = 0;
		document.getElementById("VI7R7C5").value = 0;
		document.getElementById("VI7R8C1").value = 0;
		document.getElementById("VI7R8C3").value = 0;
		document.getElementById("VI7R8C5").value = 0;
		document.getElementById("VI7R9C1").value = 0;
		document.getElementById("VI7R9C3").value = 0;
		document.getElementById("VI7R9C5").value = 0;
		document.getElementById("VI7R10C1").value = 0;
		document.getElementById("VI7R10C3").value = 0;
		document.getElementById("VI7R10C5").value = 0;
		document.getElementById("VI7R11C1").value = 0;
		document.getElementById("VI7R11C3").value = 0;
		document.getElementById("VI7R11C5").value = 0;
		document.getElementById("VI7R12C5").value = 0;
	}
	else {
		document.getElementById("VI7R1C1").disabled = false;
		document.getElementById("VI7R1C3").disabled = false;
		document.getElementById("VI7R1C5").disabled = false;
		document.getElementById("VI7R2C1").disabled = false;
		document.getElementById("VI7R2C3").disabled = false;
		document.getElementById("VI7R2C5").disabled = false;
		document.getElementById("VI7R3C1").disabled = false;
		document.getElementById("VI7R3C3").disabled = false;
		document.getElementById("VI7R3C5").disabled = false;
		document.getElementById("VI7R4C1").disabled = false;
		document.getElementById("VI7R4C3").disabled = false;
		document.getElementById("VI7R4C5").disabled = false;
		document.getElementById("VI7R5C1").disabled = false;
		document.getElementById("VI7R5C3").disabled = false;
		document.getElementById("VI7R5C5").disabled = false;
		document.getElementById("VI7R6C1").disabled = false;
		document.getElementById("VI7R6C3").disabled = false;
		document.getElementById("VI7R6C5").disabled = false;
		document.getElementById("VI7R7C1").disabled = false;
		document.getElementById("VI7R7C3").disabled = false;
		document.getElementById("VI7R7C5").disabled = false;
		document.getElementById("VI7R8C1").disabled = false;
		document.getElementById("VI7R8C3").disabled = false;
		document.getElementById("VI7R8C5").disabled = false;
		document.getElementById("VI7R9C1").disabled = false;
		document.getElementById("VI7R9C3").disabled = false;
		document.getElementById("VI7R9C5").disabled = false;
		document.getElementById("VI7R10C1").disabled = false;
		document.getElementById("VI7R10C3").disabled = false;
		document.getElementById("VI7R10C5").disabled = false;
		document.getElementById("VI7R11C1").disabled = false;
		document.getElementById("VI7R11C3").disabled = false;
		document.getElementById("VI7R11C5").disabled = false;
		document.getElementById("VI7R12C5").disabled = false;
	}		
}

</script>

<?
if ($_SESSION['tipou'] == "CR") {
	include('vistas/mensaje.php');
}
else {
	include('mensaje_capitulo4.php');	
}

?>
<form name="capitulo4" id="capitulo4" method="post" action="" enctype="multipart/form-data" onSubmit="return validar_formulario(this)" >
  <div class="fondoformu"> 
    <input name="II1R9C1H" type="hidden" id="II1R9C1H" value="<? echo $II1R9C1H;?>">
	<input name="II1R9C2H" type="hidden" id="II1R9C2H" value="<? echo $II1R9C2H;?>">
  <table width="100%" border="0" cellpadding="5">
    <tr> 
      <td colspan="3" class="titulosMayor">CAP&Iacute;TULO IV- PERSONAL OCUPADO 
        PROMEDIO EN LOS A&Ntilde;OS <?php echo $_SESSION['anioant'] . " y " . $_SESSION['vigencia'] ?></td>
    </tr>
    <tr> 
      <td colspan="3"  class="ayudas">El personal ocupado promedio en el a&ntilde;o por la empresa corresponde al que, desarrollando la actividad
      econ&oacute;mica por la cual est&aacute; rindiendo informaci&oacute;n en la encuesta, ejerce su fuerza laboral independientemente del tipo de
      contrataci&oacute;n ya sean propietarios, permanentes, temporal contratado directamente o a trav&eacute;s de agencias, personal aprendiz o
      pasantes en etapa pr&aacute;ctica o personal por prestaci&oacute;n de servicios, con excepci&oacute;n de los consultores externos contratados
      para la realización de Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n.<br><br> 
       
      El personal que participa en actividades cient&iacute;ficas, 
      tecnol&oacute;gicas y de innovaci&oacute;n, corresponde al que desarrolla ya sea en dedicaci&oacute;n 
      permanente o parcial, actividades dentro de la empresa dirigidas a la producci&oacute;n, 
      promoci&oacute;n, difusi&oacute;n y aplicaci&oacute;n de conocimientos cient&iacute;ficos y t&eacute;cnicos; y al 
      desarrollo o introducci&oacute;n de bienes o servicios nuevos o significativamente 
      mejorados, de procesos nuevos o significativamente mejorados, de m&eacute;todos organizativos 
      nuevos, o de t&eacute;cnicas de comercializaci&oacute;n nuevas.</td>
    </tr>
    <tr> 
      <td colspan="3" class="textoNormal" >&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3" class="ayudas"><strong>&iquest;Qui&eacute;n deber&iacute;a 
        responder este cap&iacute;tulo? </strong><br>
        Personas del &aacute;rea de recursos humanos y con acceso a informaci&oacute;n 
        de los empleados de la empresa.</td>
    </tr>
    <tr> 
      <td colspan="3" class="textoNormal" >&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="3" class="titulos">IV.1 Indique el personal ocupado promedio que labor&oacute; 
      en su empresa en los a&ntilde;os <?php echo $_SESSION['anioant'] . " y " . $_SESSION['vigencia'] ?>. De &eacute;ste, especifique el n&uacute;mero que particip&oacute; en 
      la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en los a&ntilde;os 
      <?php echo $_SESSION['anioant'] . " y " . $_SESSION['vigencia'] ?>, de acuerdo con el m&aacute;ximo nivel educativo alcanzado y con t&iacute;tulo obtenido.</td>
    </tr>
    <tr> 
      <td colspan="3" class="textoNormal"><table width="100%" border="0">
          <tr> 
            <td align="center" width="20%" ><font class="textoNormal" ><strong>M&aacute;ximo 
              Nivel Educativo Alcanzado</strong></font></td>
            <td colspan="2" width="40%" align="center" ><font class="textoNormal" ><strong>Personal ocupado promedio
 							 <br>
              (tiempo completo permanente y temporal) </strong></font></td>
            <td colspan="2" width="40%" align="center" ><font class="textoNormal" ><strong>Personal ocupado 
            promedio que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, 
            tecnol&oacute;gicas y de innovaci&oacute;n</strong></font></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td align="center"><font class="textoNormal"><strong><?php echo $_SESSION['anioant'] ?></strong></font></td>
            <td align="center"><font class="textoNormal"><strong><?php echo $_SESSION['vigencia'] ?></strong></font></td>
            <td align="center"><font class="textoNormal"><strong><?php echo $_SESSION['anioant'] ?></strong></font></td>
            <td align="center"><font class="textoNormal"><strong><?php echo $_SESSION['vigencia'] ?></strong></font></td>
          </tr>
          <tr> 
            <td class="textoNormal">1. Doctorado </td>
            <td align="center"><input tabindex="1" name="IV1R1C1" type="text" class="alinearEdit"   id="IV1R1C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R1C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de doctorado." ></td>
            <td align="center"><input tabindex="2" name="IV1R1C2" type="text" class="alinearEdit"   id="IV1R1C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R1C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de doctorado." ></td>
            <td align="center"><input tabindex="3"  name="IV1R1C3" type="text" class="alinearEdit"   id="IV1R1C3"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R1C3'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de doctorado" ></td>
            <td align="center"><input  tabindex="4" name="IV1R1C4" type="text" class="alinearEdit"   id="IV1R1C4"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{ echo $row['IV1R1C4']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de doctorado" ></td>
          </tr>																																																																								
          <tr> 
            <td class="textoNormal">2. Maestr&iacute;a </td>
            <td align="center"><input  tabindex="5" name="IV1R2C1" type="text" class="alinearEdit"   id="IV1R2C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R2C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Maestr&iacute;a." ></td>
            <td align="center"><input  tabindex="6" name="IV1R2C2" type="text" class="alinearEdit"   id="IV1R2C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R2C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Maestr&iacute;a." ></td>
            <td align="center"><input  tabindex="7" name="IV1R2C3" type="text" class="alinearEdit"   id="IV1R2C3"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R2C3'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Maestr&iacute;a"></td>
            <td align="center"><input  tabindex="8" name="IV1R2C4" type="text" class="alinearEdit"   id="IV1R2C4"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R2C4'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Maestr&iacute;a" ></td>
          </tr>
          <tr> 
            <td class="textoNormal">3. Especializaci&oacute;n </td>
            <td align="center"><input  tabindex="9" name="IV1R3C1" type="text" class="alinearEdit"   id="IV1R3C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R3C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Especializaci&oacute;n." ></td>
            <td align="center"><input  tabindex="10" name="IV1R3C2" type="text" class="alinearEdit"   id="IV1R3C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R3C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Especializaci&oacute;n." ></td>
            <td align="center"><input  tabindex="11" name="IV1R3C3" type="text" class="alinearEdit"   id="IV1R3C3"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R3C3'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Especializaci&oacute;n" ></td>
            <td align="center"><input  tabindex="12" name="IV1R3C4" type="text" class="alinearEdit"   id="IV1R3C4"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R3C4'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Especializaci&oacute;n" ></td>
          </tr>
          <tr> 
            <td class="textoNormal">4. Universitario (Profesional)</td>
            <td align="center"><input  tabindex="13" name="IV1R4C1" type="text" class="alinearEdit"   id="IV1R4C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R4C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Universitario (t&iacute;tulo Profesional)." ></td>
            <td align="center"><input  tabindex="14" name="IV1R4C2" type="text" class="alinearEdit"   id="IV1R4C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R4C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Universitario (t&iacute;tulo Profesional)."></td>
            <td align="center"><input tabindex="15" name="IV1R4C3" type="text" class="alinearEdit"   id="IV1R4C3"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R4C3'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Universitario (t&iacute;tulo Profesional)." ></td>
            <td align="center"><input tabindex="16" name="IV1R4C4" type="text" class="alinearEdit"   id="IV1R4C4"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R4C4'];} ?>" maxlength="5" size="4"  title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Universitario (t&iacute;tulo Profesional)"></td>
          </tr>
          <tr> 
            <td class="textoNormal">5. Tecn&oacute;logo </td>
            <td align="center"><input tabindex="17" name="IV1R5C1" type="text" class="alinearEdit"   id="IV1R5C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R5C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Tecn&oacute;logo." ></td>
            <td align="center"><input tabindex="18" name="IV1R5C2" type="text" class="alinearEdit"   id="IV1R5C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R5C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Tecn&oacute;logo." ></td>
            <td align="center"><input tabindex="19" name="IV1R5C3" type="text" class="alinearEdit"   id="IV1R5C3"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R5C3'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Tecn&oacute;logo" ></td>
            <td align="center"><input tabindex="20" name="IV1R5C4" type="text" class="alinearEdit"   id="IV1R5C4"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R5C4'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Tecn&oacute;logo" ></td>
          </tr>
          <tr> 
            <td class="textoNormal">6. T&eacute;cnico Profesional</td>
            <td align="center"><input tabindex="21" name="IV1R6C1" type="text" class="alinearEdit"   id="IV1R6C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R6C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de T&eacute;cnico." ></td>
            <td align="center"><input tabindex="22" name="IV1R6C2" type="text" class="alinearEdit"   id="IV1R6C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R6C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de T&eacute;cnico." ></td>
            <td align="center"><input tabindex="23" name="IV1R6C3" type="text" class="alinearEdit"   id="IV1R6C3"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R6C3'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de T&eacute;cnico." ></td>
            <td align="center"><input tabindex="24" name="IV1R6C4" type="text" class="alinearEdit"   id="IV1R6C4"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R6C4'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de T&eacute;cnico." ></td>
          </tr>
          <tr> 
            <td class="textoNormal">7. Educaci&oacute;n secundaria (Completa) </td>
            <td align="center"><input tabindex="25" name="IV1R7C1" type="text" class="alinearEdit"   id="IV1R7C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R7C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Educaci&oacute;n Secundaria." ></td>
            <td align="center"><input tabindex="26" name="IV1R7C2" type="text" class="alinearEdit"   id="IV1R7C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R7C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Educaci&oacute;n Secundaria." ></td>
            <td align="center"><input tabindex="27" name="IV1R7C3" type="text" class="alinearEdit"   id="IV1R7C3"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R7C3'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Educaci&oacute;n secundaria." ></td>
            <td align="center"><input tabindex="28" name="IV1R7C4" type="text" class="alinearEdit"   id="IV1R7C4"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R7C4'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Educaci&oacute;n secundaria." ></td>
          </tr>
          <tr> 
            <td class="textoNormal">8. Educaci&oacute;n primaria</td>
            <td align="center"><input tabindex="29" name="IV1R8C1" type="text" class="alinearEdit"   id="IV1R8C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R8C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Educaci&oacute;n Primaria." ></td>
            <td align="center"><input tabindex="30" name="IV1R8C2" type="text" class="alinearEdit"   id="IV1R8C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R8C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Educaci&oacute;n Primaria." ></td>
            <td align="center"><input tabindex="31" name="IV1R8C3" type="text" class="alinearEdit"   id="IV1R8C3"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R8C3'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Educaci&oacute;n Primaria." ></td>
            <td align="center"><input tabindex="32" name="IV1R8C4" type="text" class="alinearEdit"   id="IV1R8C4"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R8C4'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Educaci&oacute;n Primaria." ></td>
          </tr>
          <tr> 
            <td class="textoNormal"><img src="image/mas.png" width="15" height="15" title="Ayuda" onClick="showhide('ayuda_ext1')" align="absmiddle" >9. 
              Formaci&oacute;n Profesional Integra - SENA </td>
            <td align="center"><input tabindex="33" name="IV1R9C1" type="text" class="alinearEdit"   id="IV1R9C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R9C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Trabajador Calificado." ></td>
            <td align="center"><input tabindex="34" name="IV1R9C2" type="text" class="alinearEdit"   id="IV1R9C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R9C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Trabajador Calificado." ></td>
            <td align="center"><input tabindex="35" name="IV1R9C3" type="text" class="alinearEdit"   id="IV1R9C3"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R9C3'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['anioant'] ?> con t&iacute;tulo de Trabajador Calificado." ></td>
            <td align="center"><input tabindex="36" name="IV1R9C4" type="text" class="alinearEdit"   id="IV1R9C4"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R9C4'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['vigencia'] ?> con t&iacute;tulo de Trabajador Calificado." ></td>
          </tr>
          <tr> 
            <td class="textoNormal" colspan="5"><div id="ayuda_ext1"  style='position:relative; display:none; visibility: visible;'  > 
                <div align="left"> 
                  <table width="100%" border="0">
                    <tr> 
                      <td class="ayudas2">Formaci&oacute;n para ocupaciones que requieren 
                        haber cumplido un programa de aprendizaje, educaci&oacute;n b&aacute;sica 
                        secundaria m&aacute;s cursos de capacitaci&oacute;n, entrenamiento en 
                        el trabajo o experiencia. Los alumnos reciben el Certificado 
                        de Aptitud Universitario (T&iacute;tulo Profesional) (CAP) del 
                        SENA. </td>
                    </tr>
                  </table>
                </div>
              </div></td>
          </tr>
          <tr> 
            <td class="textoNormal"><img src="image/mas.png" width="15" height="15" title="Ayuda" onClick="showhide('ayuda_ext2')" align="absmiddle" >10. 
              Ninguno</td>
            <td align="center"><input tabindex="37" name="IV1R10C1" type="text" class="alinearEdit"   id="IV1R10C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R10C1']; ?>" maxlength="5" size="4"  title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['anioant'] ?> con ning&uacute;n  nivel de Educaci&oacute;n"></td>
            <td align="center"><input tabindex="38" name="IV1R10C2" type="text" class="alinearEdit"   id="IV1R10C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R10C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el n&uacute;mero de empleados que laboraron en la empresa (tiempo completo permanente y temporal) durante el <?php echo $_SESSION['vigencia'] ?> con ning&uacute;n  nivel de Educaci&oacute;n"></td>
            <td align="center"><input tabindex="39" name="IV1R10C3" type="text" class="alinearEdit"   id="IV1R10C3"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R10C3'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['anioant'] ?> con  ning&uacute;n  nivel de Educaci&oacute;n"></td>
            <td align="center"><input tabindex="40" name="IV1R10C4" type="text" class="alinearEdit"   id="IV1R10C4"   onKeypress="return acepta_numero(event)" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R10C4'];} ?>" maxlength="5" size="4" title="Cap. 4 Num. 1 - Indique el No. de empleados  que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, durante el <?php echo $_SESSION['vigencia'] ?> con  ning&uacute;n  nivel de Educaci&oacute;n" ></td>
          </tr>
          <tr> 
            <td class="textoNormal" colspan="5"><div id="ayuda_ext2"  style='position:relative; display:none; visibility: visible;'  > 
                <div align="left"> 
                  <table width="100%" border="0">
                    <tr> 
                      <td class="ayudas2">Programas que otorgan un nivel educativo 
                        no identificado en la lista anterior. </td>
                    </tr>
                  </table>
                </div>
              </div></td>
          </tr>
          <tr> 
            <td class="textoNormal"><strong>Total personal ocupado promedio</strong></td>
            <td align="center"><input tabindex="41" name="IV1R11C1" type="text" class="alinearEdit"   id="IV1R11C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R11C1']; ?>" maxlength="5" size="5" title="Cap. 4 Num. 1 - Por favor verifique la suma del total de empleados que laboraron en la empresa durante el <?php echo $_SESSION['anioant'] ?> y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total." ></td>
            <td align="center"><input tabindex="42" name="IV1R11C2" type="text" class="alinearEdit"   id="IV1R11C2"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV1R11C2']; ?>" maxlength="5" size="5" title="Cap. 4 Num. 1 - Por favor verifique la suma del total de empleados que laboraron en la empresa durante el <?php echo $_SESSION['vigencia'] ?> y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total." ></td>
            <td align="center"><input tabindex="43" name="IV1R11C3" type="text" class="alinearEdit"   id="IV1R11C3"   onKeypress="return acepta_numero(event)" onBlur="activacol12();" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R11C3'];} ?>" maxlength="5" size="5" title="Cap. 4 Num. 1 - Por favor verifique la suma del total de empleados que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['anioant'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total." ></td>
            <td align="center"><input tabindex="44" name="IV1R11C4" type="text" class="alinearEdit"   id="IV1R11C4"   onKeypress="return acepta_numero(event)" onBlur="activa35();" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> value="<?php if($grabareste == 0){echo "";}else{echo $row['IV1R11C4'];} ?>" maxlength="5" size="5" title="Cap. 4 Num. 1 - Por favor verifique la suma del total de empleados que particip&oacute; en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles educativos que componen este total." ></td>
          </tr>
        </table></td>
    </tr>
    <tr>
    	<td colspan='3' class='titulos'>
    		IV.2 Distribuya el personal ocupado promedio que particip&oacute; en Actividades Cientificas, Tecnol&oacute;gicas y de 
    		Innovaci&oacute;n en su empresa en los a&ntilde;os <?php echo $_SESSION['anioant'] . " y " . $_SESSION['vigencia'] ?> 
    		(pregunta IV.1), seg&uacute;n el (los) departamento(s) donde se desarrollaron y ejecutaron dichas actividades de innovaci&oacute;n:
    	</td>
    </tr>
    <tr>
    	<td colspan='3' class='textoNormal'>
    		<table width: "100%" border="0">
    		<tr>
    			<td style='font-family: arial; font-size: 10px; font-weight: bold; width: 15%'>Departamento</td>
    			<td style='font-family: arial; font-size: 10px; font-weight: bold; width: 11%; text-align: center'><?php echo $_SESSION['anioant'] ?></td>
    			<td style='font-family: arial; font-size: 10px; font-weight: bold; width: 11%; text-align: center'><?php echo $_SESSION['vigencia'] ?></td>
    			<td style='font-family: arial; font-size: 10px; font-weight: bold; width: 15%'>Departamento</td>
    			<td style='font-family: arial; font-size: 10px; font-weight: bold; width: 11%; text-align: center'><?php echo $_SESSION['anioant'] ?></td>
    			<td style='font-family: arial; font-size: 10px; font-weight: bold; width: 11%; text-align: center'><?php echo $_SESSION['vigencia'] ?></td>
    			<td style='font-family: arial; font-size: 10px; font-weight: bold; width: 15%'>Departamento</td>
    			<td style='font-family: arial; font-size: 10px; font-weight: bold; width: 11%; text-align: center'><?php echo $_SESSION['anioant'] ?></td>
    			<td style='font-family: arial; font-size: 10px; font-weight: bold; width: 11%; text-align: center'><?php echo $_SESSION['vigencia'] ?></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>1.Amazonas</td>
    			<td align="center"><input tabindex="45" name="VI7R1C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R1C1" onKeypress="return acepta_numero(event)" value="<?php echo is_null($ldep['VI7R1C1']) ? '0' : $ldep['VI7R1C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R1C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R1C2" onKeypress="return acepta_numero(event)" value="<?php echo is_null($ldep['VI7R1C2']) ? '0' : $ldep['VI7R1C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>12.Cesar</td>
    			<td align="center"><input tabindex="45" name="VI7R1C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R1C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R1C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R1C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R1C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R1C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>23.Norte de Santander</td>
    			<td align="center"><input tabindex="45" name="VI7R1C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R1C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R1C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R1C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R1C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R1C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>2.Antioquia</td>
    			<td align="center"><input tabindex="45" name="VI7R2C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R2C1" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R2C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R2C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R2C2" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R2C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>13.Choco</td>
    			<td align="center"><input tabindex="45" name="VI7R2C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R2C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R2C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R2C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R2C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R2C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>24.Putumayo</td>
    			<td align="center"><input tabindex="45" name="VI7R2C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R2C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R2C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R2C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R2C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R2C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>3.Arauca</td>
    			<td align="center"><input tabindex="45" name="VI7R3C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R3C1" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R3C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R3C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R3C2" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R3C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>14.C&oacute;rdoba</td>
    			<td align="center"><input tabindex="45" name="VI7R3C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R3C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R3C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R3C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R3C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R3C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>25.Quindio</td>
    			<td align="center"><input tabindex="45" name="VI7R3C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R3C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R3C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R3C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R3C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R3C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>4.Atl&aacute;ntico</td>
    			<td align="center"><input tabindex="45" name="VI7R4C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R4C1" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R4C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R4C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R4C2" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R4C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>15.Cundinamarca</td>
    			<td align="center"><input tabindex="45" name="VI7R4C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R4C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R4C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R4C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R4C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R4C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>26.Risaralda</td>
    			<td align="center"><input tabindex="45" name="VI7R4C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R4C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R4C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R4C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R4C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R4C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>5.Bogot&aacute; D.C.</td>
    			<td align="center"><input tabindex="45" name="VI7R5C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R5C1" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R5C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R5C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R5C2" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R5C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>16.Guainia</td>
    			<td align="center"><input tabindex="45" name="VI7R5C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R5C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R5C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R5C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R5C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R5C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>27.San Andres y Providencia</td>
    			<td align="center"><input tabindex="45" name="VI7R5C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R5C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R5C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R5C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R5C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R5C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>6.Bolivar</td>
    			<td align="center"><input tabindex="45" name="VI7R6C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R6C1" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R6C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R6C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R6C2" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R6C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>17.Guaviare</td>
    			<td align="center"><input tabindex="45" name="VI7R6C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R6C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R6C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R6C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R6C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R6C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>28.Santander</td>
    			<td align="center"><input tabindex="45" name="VI7R6C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R6C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R6C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R6C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R6C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R6C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>7.Boyac&aacute;</td>
    			<td align="center"><input tabindex="45" name="VI7R7C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R7C1" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R7C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R7C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R7C2" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R7C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>18.Huila</td>
    			<td align="center"><input tabindex="45" name="VI7R7C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R7C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R7C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R7C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R7C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R7C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>29.Sucre</td>
    			<td align="center"><input tabindex="45" name="VI7R7C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R7C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R7C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R7C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R7C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R7C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>8.Caldas</td>
    			<td align="center"><input tabindex="45" name="VI7R8C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R8C1" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R8C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R8C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R8C2" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R8C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>19.La Guajira</td>
    			<td align="center"><input tabindex="45" name="VI7R8C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R8C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R8C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R8C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R8C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R8C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>30.Tolima</td>
    			<td align="center"><input tabindex="45" name="VI7R8C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R8C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R8C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R8C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R8C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R8C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>9.Caquet&aacute;</td>
    			<td align="center"><input tabindex="45" name="VI7R9C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R9C1" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R9C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R9C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R9C2" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R9C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>20.Magdalena</td>
    			<td align="center"><input tabindex="45" name="VI7R9C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R9C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R9C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R9C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R9C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R9C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>31.Valle del Cauca</td>
    			<td align="center"><input tabindex="45" name="VI7R9C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R9C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R9C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R9C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R9C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R9C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>10.Casanare</td>
    			<td align="center"><input tabindex="45" name="VI7R10C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R10C1" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R10C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R10C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R10C2" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R10C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>21.Meta</td>
    			<td align="center"><input tabindex="45" name="VI7R10C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R10C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R10C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R10C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R10C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R10C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>32.Vaup&eacute;s</td>
    			<td align="center"><input tabindex="45" name="VI7R10C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R10C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R10C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R10C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R10C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R10C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td class='textoNormal'>11.Cauca</td>
    			<td align="center"><input tabindex="45" name="VI7R11C1" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R11C1" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R11C1']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R11C2" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R11C2" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R11C2']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>22.Nari&ntilde;o</td>
    			<td align="center"><input tabindex="45" name="VI7R11C3" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R11C3" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R11C3']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R11C4" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R11C4" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R11C4']; ?>" maxlength="5" size="5"></td>
    			<td class='textoNormal'>33.Vichada</td>
    			<td align="center"><input tabindex="45" name="VI7R11C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R11C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R11C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R11C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R11C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R11C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    		<tr>
    			<td colspan='6' class='textoNormal'>&nbsp;</td>
    			<td class='textoNormal'><b>TOTAL (suma items 1 al 33)</b></td>
    			<td align="center"><input tabindex="45" name="VI7R12C5" type="text" class="alinearEdit" <?php echo $estado12 ?> id="VI7R12C5" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R12C5']; ?>" maxlength="5" size="5"></td>
    			<td align="center"><input tabindex="45" name="VI7R12C6" type="text" class="alinearEdit" <?php echo $estado13 ?> id="VI7R12C6" onKeypress="return acepta_numero(event)" value="<?php echo $ldep['VI7R12C6']; ?>" maxlength="5" size="5"></td>
    		</tr>
    	</table>
    	</td>
    </tr>
    
    <tr> 
      <td colspan="3" class="titulos">IV.3 Indique el n&uacute;mero promedio de empleados 
        con certificaciones de competencias laborales inherentes a la actividad(es) principal(es) que desarrolla la empresa:</td>
    </tr>
    <tr> 
      <td colspan="3" class="celdaBlanca"> <table width="18%" border="0" align="center">
          <tr> 
            <td width="51%" align="center"><font class="textoNormal"><strong><?php echo $_SESSION['anioant'] ?></strong></font></td>
            <td width="49%" align="center"><font class="textoNormal"><strong><?php echo $_SESSION['vigencia'] ?></strong></font></td>
          </tr>
          <tr> 
            <td align="center" class="celdaBlanca"><input tabindex="120" name="IV5R1C1" type="text" class="alinearEdit"  id="IV5R1C1"   onKeypress="return acepta_numero(event)" value="<?php echo $row['IV5R1C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num.3 - Por favor indique el n&uacute;mero de empleados con certificaciones de competencias laborales relevantes para la empresa durante el a&ntilde;o <?php echo $_SESSION['anioant'] ?>" ></td>
            <td align="center" class="celdaBlanca"><input tabindex="121" name="IV5R1C2" type="text" class="alinearEdit"  id="IV5R1C2" onKeypress="return acepta_numero(event)" value="<?php echo $row['IV5R1C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num.3 - Por favor indique el n&uacute;mero de empleados con certificaciones de competencias laborales relevantes para la empresa durante el a&ntilde;o <?php echo $_SESSION['vigencia'] ?>" > 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="3" class="titulos">IV.4 Distribuya el personal ocupado promedio que particip&oacute; en 
      Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n en su empresa durante <?php echo $_SESSION['vigencia'] ?> 
      (pregunta IV.1), seg&uacute;n su &aacute;rea funcional principal y sexo:</td>
    </tr>
    <tr> 
      <td colspan="3" class="celdaBlanca"><table width="100%" border="0">
          <tr> 
            <td>&nbsp;</td>
            <td align="center"><font class="textoNormal"><strong>Hombres</strong></font></td>
			<td  width="87" >&nbsp;</td>
			<td  align="center"><font class="textoNormal"><strong>Mujeres</strong></font></td>  
            <td  width="87">&nbsp;</td>
            <td  align="center"><font class="textoNormal"><strong>Total </strong></font></td>
            <td  width="87">&nbsp;</td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left">1. Direcci&oacute;n General</div></td>
            <td align="center"><input tabindex="49" name="IV3R1C1N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R1C1N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R1C1N']; }?> " maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de hombres ocupados promedio involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Direcci&oacute;n general." ></td>
			<td>&nbsp;</td>
            <td align="center"><input tabindex="49" name="IV3R1C2N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R1C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R1C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de mujeres ocupadas promedio involucradas en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Direcci&oacute;n general." ></td>
			<td>&nbsp;</td>
			<td align="center"><input tabindex="49" name="IV3R1C3N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R1C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R1C3N']; }?>"  onBlur="sum(this.value, this.id);" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma total de hombres y mujeres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante <?php echo $_SESSION['vigencia'] ?> en Direcci&oacute;n General, y/o verifique los valores que componen este total." ></td>
			<td>&nbsp;</td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left">2. Administraci&oacute;n</div></td>
            <td align="center"><input tabindex="54" name="IV3R2C1N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R2C1N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R2C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de hombres ocupados promedio involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Administraci&oacute;n." ></td>
            <td>&nbsp;</td>
			<td align="center"><input tabindex="54" name="IV3R2C2N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R2C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R2C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de mujeres ocupadas promedio involucradas en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Administraci&oacute;n." ></td>
			<td>&nbsp;</td>
            <td align="center"><input tabindex="54" name="IV3R2C3N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R2C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R2C3N']; }?>" maxlength="5" size="4" title=" Cap. 4 Num. 4 - Por favor verifique la suma total de hombres y mujeres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante <?php echo $_SESSION['vigencia'] ?> en Administraci&oacute;n, y/o verifique los valores que componen este total." ></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left">3. Mercadeo y ventas</div></td>
            <td align="center"><input tabindex="59" name="IV3R3C1N" type="text" class="alinearEdit"  <?php echo $colnum3 ?>  id="IV3R3C1N" onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R3C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de hombres ocupados promedio involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Mercadeo y Ventas." ></td>
            <td>&nbsp;</td>
			<td align="center"><input tabindex="59" name="IV3R3C2N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R3C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R3C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de mujeres ocupadas promedio involucradas en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Mercadeo y Ventas." ></td>
			<td>&nbsp;</td>
            <td align="center"><input tabindex="59" name="IV3R3C3N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R3C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R3C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma total de hombres y mujeres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante <?php echo $_SESSION['vigencia'] ?> en Mercadeo y Ventas, y/o verifique los valores que componen este total." ></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left">4. Producci&oacute;n</div></td>
            <td align="center"><input tabindex="64" name="IV3R4C1N" type="text" class="alinearEdit"  <?php echo $colnum3 ?> id="IV3R4C1N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R4C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de hombres ocupados promedio involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Producci&oacute;n." ></td>
            <td>&nbsp;</td>
			<td align="center"><input tabindex="64" name="IV3R4C2N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R4C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R4C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de mujeres ocupadas promedio involucradas en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Producci&oacute;n." ></td>
			<td>&nbsp;</td>
            <td align="center"><input tabindex="64" name="IV3R4C3N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R4C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R4C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma total de hombres y mujeres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante <?php echo $_SESSION['vigencia'] ?> en Producci&oacute;n, y/o verifique los valores que componen este total." ></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left">5. Contable y financiera</div></td>
            <td align="center"><input tabindex="69" name="IV3R5C1N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R5C1N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R5C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de hombres ocupados promedio involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Contable y Financiera." ></td>
            <td>&nbsp;</td>
			<td align="center"><input tabindex="69" name="IV3R5C2N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R5C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R5C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de mujeres ocupadas promedio involucradas en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Contable y Financiera." ></td>
			<td>&nbsp;</td>
            <td align="center"><input tabindex="69" name="IV3R5C3N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R5C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R5C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma total de hombres y mujeres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante <?php echo $_SESSION['vigencia'] ?> en Contable y Financiera, y/o verifique los valores que componen este total." ></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left">6. Investigaci&oacute;n y Desarrollo. Solo si su empresa tiene conformado un departamento de investigación y desarrollo. (Este se desagrega a su vez en los siguientes 4 items. No incluye consultores externos)</div></td>
            <td align="center"><input tabindex="74" name="IV3R6C1N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R6C1N"   onKeypress="return acepta_numero(event)" onBlur="inactivar_col(this.id)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R6C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma del total de hombres ocupados promedio en Investigaci&oacute;n y Desarrollo en <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en la desagregaci&oacute;n que componen esta &aacute;rea funcional (Item 6 - Investigaci&oacute;n y Desarrollo)." ></td>
            <td>&nbsp;</td>
			<td align="center"><input tabindex="74" name="IV3R6C2N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R6C2N"   onKeypress="return acepta_numero(event)" onBlur="inactivar_col(this.id)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R6C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma del total de mujeres ocupadas promedio en Investigaci&oacute;n y Desarrollo en <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en la desagregaci&oacute;n que componen esta &aacute;rea funcional (Item 6 - Investigaci&oacute;n y Desarrollo)." ></td>
			<td>&nbsp;</td>
            <td align="center"><input tabindex="74" name="IV3R6C3N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R6C3N" onKeypress="return acepta_numero(event)" onBlur="inactivar_col(this.id)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R6C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma total de hombres y mujeres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante <?php echo $_SESSION['vigencia'] ?> en Investigaci&oacute;n y Desarrollo, y/o verifique los valores que componen este total." ></td>
            <td>&nbsp;</td>
          </tr>
          
          <tr> 
            <td class="textoNormal"><div style="color: #464639;" align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.1 Investigadores (Coordinadores, lideres de proyectos y/o gestores)</strong></div></td>
            <td align="center"><input tabindex="74" name="IV3R7C1N" type="text" class="alinearEdit"   <?php echo $mcol1; ?> id="IV3R7C1N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R7C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de investigadores ocupados promedio que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Investigaci&oacute;n y desarrollo." ></td>
            <td>&nbsp;</td>
			<td align="center"><input tabindex="74" name="IV3R7C2N" type="text" class="alinearEdit"   <?php echo $mcol2; ?> id="IV3R7C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R7C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de investigadoras ocupadas promedio que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Investigaci&oacute;n y desarrollo." ></td>
			<td>&nbsp;</td>
            <td align="center"><input tabindex="74" name="IV3R7C3N" type="text" class="alinearEdit"   <?php echo $mcol3; ?> id="IV3R7C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R7C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma total de hombres y mujeres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante <?php echo $_SESSION['vigencia'] ?> como Investigadores, y/o verifique los valores que componen este total." ></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td class="textoNormal"><div style="color: #464639;" align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.2 Pasantes o asistentes de investigaci&oacute;n y desarrollo</strong></div></td>
            <td align="center"><input tabindex="74" name="IV3R8C1N" type="text" class="alinearEdit"   <?php echo $mcol1; ?> id="IV3R8C1N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R8C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de hombres pasantes o asistentes de investigadci&oacute;n ocupados promedio, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Investigaci&oacute;n y desarrollo." ></td>
            <td>&nbsp;</td>
			<td align="center"><input tabindex="74" name="IV3R8C2N" type="text" class="alinearEdit"   <?php echo $mcol2; ?> id="IV3R8C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R8C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de mujeres pasantes o asistentes de investigaci&oacute;n ocupadas promedio, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Investigaci&oacute;n y desarrollo." ></td>
			<td>&nbsp;</td>
            <td align="center"><input tabindex="74" name="IV3R8C3N" type="text" class="alinearEdit"   <?php echo $mcol3; ?> id="IV3R8C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R8C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma total de hombres y mujeres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante <?php echo $_SESSION['vigencia'] ?> como Pasantes o Asistentes de Investigaci&oacute;n y Desarrollo, y/o verifique los valores que componen este total." ></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td class="textoNormal"><div style="color: #464639;" align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.3 T&eacute;cnicos en Investigaci&oacute;n y Desarrollo</strong></div></td>
            <td align="center"><input tabindex="74" name="IV3R9C1N" type="text" class="alinearEdit"   <?php echo $mcol1; ?> id="IV3R9C1N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R9C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de t&eacute;cnicos hombres ocupados promedio, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Investigaci&oacute;n y desarrollo." ></td>
            <td>&nbsp;</td>
			<td align="center"><input tabindex="74" name="IV3R9C2N" type="text" class="alinearEdit"   <?php echo $mcol2; ?> id="IV3R9C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R9C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de t&eacute;cnicos mujeres ocupadas promedio, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Investigaci&oacute;n y desarrollo." ></td>
			<td>&nbsp;</td>
            <td align="center"><input tabindex="74" name="IV3R9C3N" type="text" class="alinearEdit"   <?php echo $mcol3; ?> id="IV3R9C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R9C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma total de hombres y mujeres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante <?php echo $_SESSION['vigencia'] ?> como T&eacute;cnicos en Investigaci&oacute;n y Desarrollo, y/o verifique los valores que componen este total." ></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td class="textoNormal"><div style="color: #464639;" align="left"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.4 Auxiliares y/o apoyo administrativo en Investigaci&oacute;n y Desarrollo</strong></div></td>
            <td align="center"><input tabindex="74" name="IV3R10C1N" type="text" class="alinearEdit"   <?php echo $mcol1; ?> id="IV3R10C1N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R10C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de auxiliares o de apoyo administrativo hombres ocupados promedio, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Investigaci&oacute;n y desarrollo." ></td>
            <td>&nbsp;</td>
			<td align="center"><input tabindex="74" name="IV3R10C2N" type="text" class="alinearEdit"   <?php echo $mcol2; ?> id="IV3R10C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R10C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Indique el N&uacute;mero de auxiliares o de apoyo administrativo mujeres ocupadas promedio, que laboraron en el <?php echo $_SESSION['vigencia'] ?> en Investigaci&oacute;n y desarrollo." ></td>
			<td>&nbsp;</td>
            <td align="center"><input tabindex="74" name="IV3R10C3N" type="text" class="alinearEdit"   <?php echo $mcol3; ?> id="IV3R10C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R10C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 4 - Por favor verifique la suma total de hombres y mujeres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante <?php echo $_SESSION['vigencia'] ?> como Auxiliares y/o Apoyo Administrativo en Investigaci&oacute;n y Desarrollo, y/o verifique los valores que componen este total." ></td>
            <td>&nbsp;</td>
          </tr>
          
          <tr> 
            <td class="textoNormal"><div align="left"><strong>Total personal involucrado en actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innnovaci&oacute;n (suma de los renglones 1 a 6)</strong></div></td>
            <td align="center"><input tabindex="79" name="IV3R11C1N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R11C1N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R11C1N']; }?>" maxlength="5" size="5" title="Cap. 4 Num. 4 - Por favor verifique la suma del total de hombres ocupados promedio, involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas funcionales que componen este total." ></td>
            <td>&nbsp;</td>
			<td align="center"><input tabindex="79" name="IV3R11C2N" type="text" class="alinearEdit"   <?php echo $colnum3 ?> id="IV3R11C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R11C2N']; }?>" maxlength="5" size="5" title="Cap. 4 Num. 4 - Por favor verifique la suma del total de mujeres ocupadas promedio, involucradas en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en la empresa durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas funcionales que componen este total." ></td>
			<td>&nbsp;</td>																																																																																																																																																										
            <td align="center"><input tabindex="79" name="IV3R11C3N" type="text" class="alinearEdit"  <?php echo $colnum3 ?>  id="IV3R11C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV3R11C3N']; }?>" maxlength="5" size="5" title="Cap. 4 Num. 4 - Por favor verifique la suma del total de hombres y mujeres ocupados promedio, involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas funcionales que componen este total." ></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        
    </tr>
    
    <tr> 
      <td colspan="3" class="titulos">IV.5 Contrat&oacute; su empresa consultores externos para la 
      realizaci&oacute;n de Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n 
      durante <?php echo $_SESSION['vigencia'] ?>? Si su respuesta es afirmativa, indique el n&uacute;mero de consultores que prestaron 
      servicios tanto dentro de la empresa como fuera de ella:</td>
    </tr>
   <tr> 
      <td colspan="1" class="celdaBlanca"><select name="IV4R1C1N" id="IV4R1C1N" class="textoSelect"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> title="Cap4. Num. 5 - Por favor  indique si o no  la empresa contrat&oacute; consultores externos para la realizaci&oacute;n de Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n durante <?php echo $_SESSION['vigencia'] ?>"  onchange="activa_campos(this.value);">
          <?php if($grabareste == 0){ ?> 
      		<option value=""></option>
          <option value="1" 	>SI</option>
          <option value="2" 	>NO</option>
          <?php }
      else {?>
          <option value=""></option>
          <option value="1" <?php if($row['IV4R1C1N'] == '1'){ echo "selected='selected'"; }  ?> 	>SI</option>
          <option value="2" <?php if($row['IV4R1C1N'] == '2'){ echo "selected='selected'"; }  ?>	>NO</option>
       <?php }?>
          
        </select></td>
        <td colspan="2" class="celdaBlanca"> <table width="100%" border="0" align="center">
          <tr> 
            <td width="50%" ><font class="titulos"><strong>N&uacute;mero de consultores prestando servicios dentro de la empresa (tiene puesto de trabajo en las instalaciones de la empresa)</strong></font></td>
            <td align="center" class="celdaBlanca"><input tabindex="120" name="IV4R1C2N" type="text" class="alinearEdit"  id="IV4R1C2N"   <?php if($grabareste == 0 || $row['IV4R1C1N']==2){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0 || $row['IV4R1C1N']==2){echo "0";}else{ echo $row['IV4R1C2N']; }?>" maxlength="5" size="4" title="Cap4. Num. 5 - Por favor  indique el n&uacute;mero de consultores externos prestando servicios dentro (o con puesto de trabajo dentro de las instaciones) de la empresa en el <?php echo $_SESSION['vigencia'] ?>" ></td>
            
          </tr>
          <tr> 
            <td width="50%" ><font class="titulos"><strong>N&uacute;mero de consultores prestando servicios fuera de la empresa (no tiene puesto de trabajo en las instalaciones de la empresa)</strong></font></td>
            <td align="center" class="celdaBlanca"><input tabindex="121" name="IV4R1C3N" type="text" class="alinearEdit"  id="IV4R1C3N" <?php if($grabareste == 0 || $row['IV4R1C1N']==2){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0 || $row['IV4R1C1N']==2){echo "0";}else{  echo $row['IV4R1C3N']; }?>" maxlength="5" size="4" title="Cap4. Num. 5 - Por favor  indique el n&uacute;mero de consultores externos prestando servicios fuera (o sin puesto de trabajo dentro de las instaciones) de la empresa en el <?php echo $_SESSION['vigencia'] ?>" > 
            </td>
          </tr>
        </table></td>
    </tr>
    
    <tr> 
      <td colspan="3" class="titulos">IV.6  Distribuya el personal ocupado promedio con nivel 
      educativo superior que particip&oacute; en Actividades Cient&iacute;ficas, Tecnol&oacute;gicas 
      y de Innovaci&oacute;n  en su empresa durante <?php echo $_SESSION['vigencia'] ?> (pregunta IV.1 num. 1 - 6), seg&uacute;n el 
      &aacute;rea de formaci&oacute;n del m&aacute;ximo nivel educativo obtenido y sexo:</td>
    </tr>
    <tr>
    <td class = "textoNormal" colspan="3" align="center"">(Los niveles de educaci&oacute;n superior son t&eacute;cnico profesional, tecn&oacute;logo, 
    universitario, especializaci&oacute;n, maestr&iacute;a y doctorado)</td>
    </tr>
    <tr> 
      <td colspan="3" class="celdaBlanca"><table width="100%" border="0">
          <tr> 
            <td rowspan="2" align="center" ><font class="textoNormal"><strong>&Aacute;rea 
              de Formaci&oacute;n</strong></font></td>
          </tr>
          <tr> 
            <td align="center"><font class="textoNormal"><strong>Hombres</strong></font></td>
            <td  width="87" >&nbsp;</td>
            <td  align="center"><font class="textoNormal"><strong>Mujeres</strong></font></td>
            <td  width="87" >&nbsp;</td>
            <td  align="center"><font class="textoNormal"><strong>Total</strong></font></td>
            <td  width="87" >&nbsp;</td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left"><img src="image/mas.png" width="15" height="15" title="Ayuda" onClick="showhide('ayuda1')" align="absmiddle" >1. 
                Ciencias exactas asociadas a la Qu&iacute;mica, F&iacute;sica, 
                Matem&aacute;ticas y Estad&iacute;stica </div></td>
            <td align="center"><input tabindex="80" name="IV5R1C1N" type="text" class="alinearEdit"   id="IV5R1C1N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value=" <?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R1C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de hombres empleados promedio con nivel educativo superior, con formaci&oacute;n en Ciencias exactas asociadas a la qu&iacute;mica o f&iacute;sica, y que est&aacute;n involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="81" name="IV5R1C2N" type="text" class="alinearEdit"   id="IV5R1C2N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R1C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de mujeres empleadas promedio con nivel educativo superior, con formaci&oacute;n en Ciencias exactas asociadas a la qu&iacute;mica o f&iacute;sica, y que est&aacute;n involucradas en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="82" name="IV5R1C3N" type="text" class="alinearEdit"   id="IV5R1C3N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R1C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 6 - Por favor verifique la suma del total de hombres y mujeres ocupados promedio con nivel educativo superior, con formaci&oacute;n en Ciencias exactas asociadas a la qu&iacute;mica o f&iacute;sica, y que est&aacute;n involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas de formaci&oacute;n que componen este total." ></td>
            <td  >&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="7" ><div id="ayuda1"  style='position:relative; display:none; visibility: visible;'  > 
                <div align="left"> 
                  <table width="100%" border="0">
                    <tr> 
                      <td class="ayudas2">Incluya: F&iacute;sica, Qu&iacute;mica, Matem&aacute;icas, 
                        Estad&iacute;stica y Afines </td>
                    </tr>
                  </table>
                </div>
              </div></td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left"><img src="image/mas.png" width="15" height="15" title="Ayuda" onClick="showhide('ayuda2')" align="absmiddle" >2. 
                Ciencias Naturales</div></td>
            <td align="center"><input tabindex="85" name="IV5R2C1N" type="text" class="alinearEdit"   id="IV5R2C1N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R2C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de hombres empleados promedio con nivel educativo superior, con formaci&oacute;n en Ciencias Naturales y que est&aacute;n involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="86" name="IV5R2C2N" type="text" class="alinearEdit"   id="IV5R2C2N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R2C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de mujeres empleadas promedio con nivel educativo superior, con formaci&oacute;n en Ciencias Naturales y que est&aacute;n involucradas en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="87" name="IV5R2C3N" type="text" class="alinearEdit"   id="IV5R2C3N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R2C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 6 - Por favor verifique la suma del total de hombres y mujeres ocupados promedio con nivel educativo superior, con formaci&oacute;n en Ciencias Naturales, y que est&aacute;n involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas de formaci&oacute;n que componen este total." ></td>
            <td  >&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="7" ><div id="ayuda2"  style='position:relative; display:none; visibility: visible;'  > 
                <div align="left"> 
                  <table width="100%" border="0">
                    <tr> 
                      <td class="ayudas2">Incluya: Biolog&iacute;a, Microbiolog&iacute;a, Biotecnologia, 
                        Geolog&iacute;a y Afines </td>
                    </tr>
                  </table>
                </div>
              </div></td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left"><img src="image/mas.png" width="15" height="15" title="Ayuda" onClick="showhide('ayuda3')" align="absmiddle" >3. 
                Ciencias de la Salud</div></td>
            <td align="center"><input tabindex="90" name="IV5R3C1N" type="text" class="alinearEdit"   id="IV5R3C1N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R3C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de hombres empleados promedio con nivel educativo superior, con formaci&oacute;n en Ciencias de la Salud y que est&aacute;n involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="91" name="IV5R3C2N" type="text" class="alinearEdit"   id="IV5R3C2N" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?>  onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R3C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de mujeres empleadas promedio con nivel educativo superior, con formaci&oacute;n en Ciencias de la Salud y que est&aacute;n involucradas en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="92" name="IV5R3C3N" type="text" class="alinearEdit"   id="IV5R3C3N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R3C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 6 - Por favor verifique la suma del total de hombres y mujeres ocupados promedio con nivel educativo superior, con formaci&oacute;n en Ciencias de la Salud, y que est&aacute;n involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas de formaci&oacute;n que componen este total." ></td>
            <td  >&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="7" ><div id="ayuda3"  style='position:relative; display:none; visibility: visible;'  > 
                <div align="left"> 
                  <table width="100%" border="0">
                    <tr> 
                      <td  class="ayudas2">Incluya: Bacteriolog&iacute;a, Enfermer&iacute;a, 
                        Instrumentaci&oacute;n Quir&uacute;rgica, Medicina, Nutrici&oacute;n y Diet&eacute;tica, 
                        Odontolog&iacute;a, Optometr&iacute;a, Salud P&uacute;blica, Terapia y Afines. 
                      </td>
                    </tr>
                  </table>
                </div>
              </div></td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left"><img src="image/mas.png" width="15" height="15" title="Ayuda" onClick="showhide('ayuda4')" align="absmiddle" >4. 
                Ingenier&iacute;a, Arquitectura, Urbanismo y Afines</div></td>
            <td align="center"><input tabindex="95" name="IV5R4C1N" type="text" class="alinearEdit"   id="IV5R4C1N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R4C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de hombres empleados promedio con nivel educativo superior, con formaci&oacute;n en Ingenier&iacute;a, Arquitectura, Urbanismo y Afines, y que est&aacute;n involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="96" name="IV5R4C2N" type="text" class="alinearEdit"   id="IV5R4C2N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R4C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de mujeres empleadas promedio con nivel educativo superior, con formaci&oacute;n en Ingenier&iacute;a, Arquitectura, Urbanismo y Afines, y que est&aacute;n involucradas en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="97" name="IV5R4C3N" type="text" class="alinearEdit"   id="IV5R4C3N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R4C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 6 - Por favor verifique la suma del total de hombres y mujeres ocupados promedio con nivel educativo superior, con formaci&oacute;n en Ingenier&iacute;a, Arquitectura, Urbanismo y Afines, y que est&aacute;n involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas de formaci&oacute;n que componen este total." ></td>
            <td  >&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="7" ><div id="ayuda4"  style='position:relative; display:none; visibility: visible;'  > 
                <div align="left"> 
                  <table width="100%" border="0">
                    <tr> 
                      <td  class="ayudas2">Incluya: Arquitectura, Urbanismo, Ingenier&iacute;a 
                        (Administrativa, Agr&iacute;cola, Forestal, Agroindustrial, De 
                        Alimentos, Agron&oacute;mica, Pecuaria, Ambiental, Sanitaria, 
                        Biom&eacute;dica, Civil, De Minas, Metalurgica, De Sistemas, 
                        Telem&aacute;tica, El&eacute;ctrica, Electr&oacute;nica, De Telecomunicaciones, 
                        Industrial, Mec&aacute;nica, Qu&iacute;mica y Otras) y Afines </td>
                    </tr>
                  </table>
                </div>
              </div></td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left"><img src="image/mas.png" width="15" height="15" title="Ayuda" onClick="showhide('ayuda5')" align="absmiddle" >5. 
                Agronom&iacute;a, Veterinaria y Afines</div></td>
            <td align="center"><input tabindex="100" name="IV5R5C1N" type="text" class="alinearEdit"   id="IV5R5C1N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R5C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de hombres empleados promedio con nivel educativo superior, con formaci&oacute;n en Agronom&iacute;a, Veterinaria y Afines, y que est&aacute;n involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="101" name="IV5R5C2N" type="text" class="alinearEdit"   id="IV5R5C2N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R5C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de mujeres empleadas promedio con nivel educativo superior, con formaci&oacute;n en Agronom&iacute;a, Veterinaria y Afines, y que est&aacute;n involucradas en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="102" name="IV5R5C3N" type="text" class="alinearEdit"   id="IV5R5C3N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R5C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 6 - Por favor verifique la suma del total de hombres y mujeres ocupados promedio con nivel educativo superior, con formaci&oacute;n en Agronom&iacute;a, Veterinaria y Afines, y que est&aacute;n involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas de formaci&oacute;n que componen este total." ></td>
            <td  >&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="7"><div id="ayuda5"  style='position:relative; display:none; visibility: visible;'  > 
                <div align="left"> 
                  <table width="100%" border="0">
                    <tr> 
                      <td  class="ayudas2">Incluya: Agronom&iacute;a, Veterinaria, Zootecnia 
                        y Afines </td>
                    </tr>
                  </table>
                </div>
              </div></td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left"><img src="image/mas.png" width="15" height="15" title="Ayuda" onClick="showhide('ayuda6')" align="absmiddle" >6. 
                Ciencias Sociales</div></td>
            <td align="center"><input tabindex="105" name="IV5R6C1N" type="text" class="alinearEdit"   id="IV5R6C1N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R6C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de hombres empleados promedio con nivel educativo superior, con formaci&oacute;n en Ciencias Sociales y que est&aacute;n involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="106" name="IV5R6C2N" type="text" class="alinearEdit"   id="IV5R6C2N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R6C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de mujeres empleadas promedio con nivel educativo superior, con formaci&oacute;n en Ciencias Sociales y que est&aacute;n involucradas en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="107" name="IV5R6C3N" type="text" class="alinearEdit"   id="IV5R6C3N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R6C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 6 - Por favor verifique la suma del total de hombres y mujeres ocupados promedio con nivel educativo superior, con formaci&oacute;n en Ciencias Sociales, y que est&aacute;n involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas de formaci&oacute;n que componen este total." ></td>
            <td  >&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="7" ><div id="ayuda6"  style='position:relative; display:none; visibility: visible;'  > 
                <div align="left"> 
                  <table width="100%" border="0">
                    <tr> 
                      <td  class="ayudas2">Incluya: Econom&iacute;a, Administraci&oacute;n, 
                        Contadur&iacute;a P&uacute;blica, Ciencia Pol&iacute;tica, Relaciones Internacionales, 
                        Comunicaci&oacute;n Social, Periodismo, Derecho, Formacion relacionada 
                        con el campo Militar o Policial, Sociolog&iacute;a, Trabajo Social, 
                        Otras ciencias Sociales y Afines. </td>
                    </tr>
                  </table>
                </div>
              </div></td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left"><img src="image/mas.png" width="15" height="15" title="Ayuda" onClick="showhide('ayuda7')" align="absmiddle" >7. 
                Ciencias Humanas y Bellas Artes</div></td>
            <td align="center"><input tabindex="110" name="IV5R7C1N" type="text" class="alinearEdit"   id="IV5R7C1N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R7C1N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de hombres empleados promedio con nivel educativo superior, con formaci&oacute;n en Ciencias Humanas y Bellas Artes, y que est&aacute;n involucrados en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="111" name="IV5R7C2N" type="text" class="alinearEdit"   id="IV5R7C2N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R7C2N']; }?>" maxlength="5" size="4" title="Cap. 4 Num.6 - Por favor indique el n&uacute;mero de mujeres empleadas promedio con nivel educativo superior, con formaci&oacute;n en Ciencias Humanas y Bellas Artes, y que est&aacute;n involucradas en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>" ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="112" name="IV5R7C3N" type="text" class="alinearEdit"   id="IV5R7C3N"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R7C3N']; }?>" maxlength="5" size="4" title="Cap. 4 Num. 6 - Por favor verifique la suma del total de hombres y mujeres ocupados promedio con nivel educativo superior, con formaci&oacute;n en Ciencias Humanas y Bellas Artes, y que est&aacute;n involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas de formaci&oacute;n que componen este total." ></td>
            <td  >&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="7" ><div id="ayuda7"  style='position:relative; display:none; visibility: visible;' > 
                <div align="left"> 
                  <table width="100%" border="0">
                    <tr> 
                      <td  class="ayudas2">Incluya: Lenguas, LiterAntropolog&iacute;a, 
                        Artes Liberales, Artes Pl&aacute;sticas, Artes Visuales, Artes 
                        Representativas, Biblotecolog&iacute;a, Deportes, Dise&ntilde;o, Educaci&oacute;n
                        F&iacute;sica, Filosof&iacute;a, Geograf&iacute;a, Historia, Lenguas 
                        Modernas, Literatura, Lingu&iacute;stica, M&uacute;sica, Psicolog&iacute;a, 
                        Publicidad, y Afines </td>
                    </tr>
                  </table>
                </div>
              </div></td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left"><strong>Total personal ocupado promedio con nivel de educaci&oacute;n superior involucrado en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n</strong></div></td>
            <td align="center"><input tabindex="115" name="IV5R8C1N" type="text" class="alinearEdit" <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?>  id="IV5R8C1N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R8C1N']; }?>" maxlength="5" size="5" title="Cap. 4 Num.6 - Por favor verifique la suma del total de hombres ocupados promedio con nivel de educaci&oacute;n superior e involucrados en Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas de formaci&oacute;n que componen este total." ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="116" name="IV5R8C2N" type="text" class="alinearEdit"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> id="IV5R8C2N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R8C2N']; }?>" maxlength="5" size="5" title="Cap. 4 Num.6 - Por favor verifique la suma del total de mujeres ocupadas promedio con nivel de educaci&oacute;n superior e involucradas en Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas de formaci&oacute;n que componen este total." ></td>
            <td  >&nbsp;</td>
            <td align="center"><input tabindex="117" name="IV5R8C3N" type="text" class="alinearEdit"  <?php if($grabareste == 0){  ?>disabled="disabled" <?php } ?> id="IV5R8C3N"   onKeypress="return acepta_numero(event)" value="<?php if($grabareste == 0){echo "0";}else{ echo $row['IV5R8C3N']; }?>" maxlength="5" size="5" title="Cap. 4 Num. 6 - Por favor verifique la suma del total de hombres y mujeres ocupados promedio con nivel educativo superior e involucrados en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que laboraron en el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada una de las &aacute;reas de formaci&oacute;n que componen este total." ></td>
            <td  >&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="3" class="titulos">IV.7  Si su empresa realiz&oacute; inversiones en actividades de 
      formaci&oacute;n y capacitaci&oacute;n especializada (es decir, su respuesta fue mayor a cero (0) 
      en la opci&oacute;n 9 del numeral II.1 para <?php echo $_SESSION['anioant'] . " o " . $_SESSION['vigencia'] ?> ), indique el n&uacute;mero de personas que 
      la recibieron seg&uacute;n el tipo de capacitaci&oacute;n impartida o financiada, en los a&ntilde;os 
      <?php echo $_SESSION['anioant'] . " y " . $_SESSION['vigencia'] ?>:  </td>
    </tr>
    <tr> 
      <td colspan="3" class="celdaBlanca"> <table width="100%" border="0">
          <tr> 
            <td width="722" class="textoNormal" ></td>
            <td colspan="2" align="center"  class="textoNormal"><div align="center"><strong>Personas 
                capacitadas</strong></div></td>
          </tr>
          <tr> 
            <td class="textoNormal" ></td>
            <td width="88" align="center"><font class="textoNormal"><strong><?php echo $_SESSION['anioant'] ?></strong></font></td>
            <td width="59" align="center"><font class="textoNormal"><strong><?php echo $_SESSION['vigencia'] ?></strong></font></td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left">1. Doctorado Formaci&oacute;n de su personal, 
			conducente a un t&iacute;tulo de Doctorado (Ph.D), destinada a actividades cient&iacute;ficas, 
			tecnol&oacute;gicas y de innovaci&oacute;n realizadas por la empresa.</div></td>
            <td align="center" class="celdaBlanca"><input tabindex="120" <?php echo $muestra462011 ?> name="IV4R1C1" type="text" class="alinearEdit"   id="IV4R1C1"   onKeypress="return acepta_numero(event)" value="<?php if($II1R9C1H == 0) echo '0'; else echo $row['IV4R1C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num.7 - Por favor indique el n&uacute;mero de personas capacitadas en el <?php echo $_SESSION['anioant'] ?> que tienen formaci&oacute;n de Doctorado" ></td>
            <td align="center" class="celdaBlanca"><input tabindex="121" <?php echo $muestra462012 ?> name="IV4R1C2" type="text" class="alinearEdit"  id="IV4R1C2" onKeypress="return acepta_numero(event)" value="<?php if($II1R9C2H == 0) echo '0'; else echo $row['IV4R1C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num.7 - Por favor indique el n&uacute;mero de personas capacitadas en el <?php echo $_SESSION['vigencia'] ?> que tienen formaci&oacute;n de Doctorado" > 
            </td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left">2. Maestr&iacute;a Formaci&oacute;n de su personal, 
			conducente a un t&iacute;tulo de Master (MSc, MA, MBA), destinada a actividades cient&iacute;ficas, 
			tecnol&oacute;gicas y de innovaci&oacute;n realizadas por la empresa.</div></td>
            <td align="center" class="celdaBlanca"><input tabindex="122" <?php echo $muestra462011 ?> name="IV4R2C1" type="text" class="alinearEdit"   id="IV4R2C1"   onKeypress="return acepta_numero(event)" value="<?php if($II1R9C1H == 0) echo '0'; else echo $row['IV4R2C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num.7 - Por favor indique el n&uacute;mero de personas capacitadas en el <?php echo $_SESSION['anioant'] ?> que tienen formaci&oacute;n de Maestr&iacute;a" ></td>
            <td align="center" class="celdaBlanca"><input tabindex="123" <?php echo $muestra462012 ?> name="IV4R2C2" type="text" class="alinearEdit"  id="IV4R2C2" onKeypress="return acepta_numero(event)" value="<?php if($II1R9C2H == 0) echo '0'; else echo $row['IV4R2C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num.7 - Por favor indique el n&uacute;mero de personas capacitadas en el <?php echo $_SESSION['vigencia'] ?> que tienen formaci&oacute;n de Maestr&iacute;a" ></td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left">3. Capacitaci&oacute;n especializada: 
                Capacitaci&oacute;n de su personal, sea interna o externa a la empresa, con una duraci&oacute;n
                igual o mayor a 40 horas; destinada a actividades cient&iacute;ficas, tecnol&oacute;gicas
                y de innovaci&oacute;n realizadas por la empresa</div></td>
            <td align="center" class="celdaBlanca"><input tabindex="124" <?php echo $muestra462011 ?> name="IV4R3C1" type="text" class="alinearEdit"   id="IV4R3C1"   onKeypress="return acepta_numero(event)" value="<?php if($II1R9C1H == 0) echo '0'; else echo $row['IV4R3C1']; ?>" maxlength="5" size="4" title="Cap. 4 Num.7 - Por favor indique el n&uacute;mero de personas capacitadas en el <?php echo $_SESSION['anioant'] ?> con capacitaci&oacute;n especializada" ></td>
            <td align="center" class="celdaBlanca"><input tabindex="125" <?php echo $muestra462012 ?> name="IV4R3C2" type="text" class="alinearEdit"  id="IV4R3C2" onKeypress="return acepta_numero(event)" value="<?php if($II1R9C2H == 0) echo '0'; else echo $row['IV4R3C2']; ?>" maxlength="5" size="4" title="Cap. 4 Num.7 - Por favor indique el n&uacute;mero de personas capacitadas en el <?php echo $_SESSION['vigencia'] ?> con capacitaci&oacute;n especializada" > 
            </td>
          </tr>
          <tr> 
            <td class="textoNormal"><div align="left"><strong>Total personal capacitado y/o financiado 
                </strong></div></td>
            <td align="center" class="celdaBlanca"><input tabindex="126" <?php echo $muestra462011 ?> name="IV4R4C1" type="text" class="alinearEdit"  id="IV4R4C1" onKeypress="return acepta_numero(event)" value="<?php if($II1R9C1H == 0) echo '0'; else echo $row['IV4R4C1']; ?>" maxlength="5" size="5" title="Cap. 4 Num.7 - Por favor indique el n&uacute;mero verifique la suma del total de empleados capacitados y/o financiados por la empresa durante el <?php echo $_SESSION['anioant'] ?>, y/o verifique los valores consignados en cada uno de los niveles de capacitaci&oacute;n que componen este total." >
            </td>
            <td align="center" class="celdaBlanca"><input tabindex="127" <?php echo $muestra462012 ?> name="IV4R4C2" type="text" class="alinearEdit"  id="IV4R4C2" onKeypress="return acepta_numero(event)" value="<?php if($II1R9C2H == 0) echo '0'; else echo $row['IV4R4C2']; ?>" maxlength="5" size="5" title="Cap. 4 Num.7 - Por favor indique el n&uacute;mero verifique la suma del total de empleados capacitados y/o financiados por la empresa durante el <?php echo $_SESSION['vigencia'] ?>, y/o verifique los valores consignados en cada uno de los niveles de capacitaci&oacute;n que componen este total." > 
            </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="3" class="celdaBlanca"> <table width="100%" border="0">
          <tr> 
            <td width="50%" align="center" class="textoNormal">Observaciones Anteriores:</td>
            <td width="50%" align="center" class="textoNormal">Observaciones</td>
          </tr>
          <tr> 
            <td width="50%" align="center" class="textoNormal"><textarea name="observaciones_read" cols="42" rows="3"   readonly="true" id="observaciones_read" >
<?php 
if ($row['OBSERVACIONES']!=''){ 
	echo $row['OBSERVACIONES'];
}
 $consulta = "SELECT DISTINCT ( u.ident), u.nombre, r.nombre as region
FROM usuarios u
LEFT JOIN observacion o ON u.ident = o.usuario
LEFT JOIN regionales r ON r.codis = u.region
WHERE o.nordemp =" . $idest . "
AND o.modulo = 'CAPITULO_IV'
AND u.region !=99
AND o.fuente = 'CR' ";
$resulta = mysql_query($consulta, $con);
$observa_critico=mysql_fetch_array($resulta);
  $conscrit = "SELECT DISTINCT (o.observa)
				FROM observacion o
				LEFT JOIN usuarios u ON u.ident = o.usuario
				WHERE o.nordemp =" . $idest . "
				AND o.fuente = 'CR'
				AND o.modulo = 'CAPITULO_IV'
				AND u.region !=99 ";
$resucrit = mysql_query($conscrit, $con);
if($observa_critico['ident']!=''){
    echo "\n";    
    echo "\n";
	echo "OBSERVACIONES ANALISTA REGIONAL: ". $observa_critico['nombre'] . " - " . $observa_critico['region'];
	echo "\n";
	$k=1;
	while ($obscr = mysql_fetch_array($resucrit)) {
		echo "\n";
		echo $k.". " .strtoupper($obscr['observa']);
		$k++;
	}
}
/*  CRITICO DC*/
 $consulta = "SELECT DISTINCT ( u.ident), u.nombre, r.nombre as region
FROM usuarios u
LEFT JOIN observacion o ON u.ident = o.usuario
LEFT JOIN regionales r ON r.codis = u.region
WHERE o.nordemp =" . $idest . "
AND o.modulo = 'CAPITULO_IV'
AND u.region =99
AND o.fuente = 'CR' ";
$resulta = mysql_query($consulta, $con);
$observa_critico=mysql_fetch_array($resulta);
  $conscrit = "SELECT DISTINCT (o.observa)
				FROM observacion o
				LEFT JOIN usuarios u ON u.ident = o.usuario
				WHERE o.nordemp =" . $idest . "
				AND o.fuente = 'CR'
				AND o.modulo = 'CAPITULO_IV'
				AND u.region =99 ";
$resucrit = mysql_query($conscrit, $con);
if($observa_critico['ident']!=''){
    echo "\n";    
    echo "\n";
	echo "OBSERVACIONES ANALISTA DANE CENTRAL: ". $observa_critico['nombre'] . " - " . $observa_critico['region'];
	echo "\n";
	$k=1;
	while ($obscr = mysql_fetch_array($resucrit)) {
		echo "\n";
		echo $k.". " .strtoupper($obscr['observa']);
		$k++;
	}
}
/*  COORDINADOR  RG*/
 $consulta = "SELECT DISTINCT ( u.ident), u.nombre, r.nombre as region
FROM usuarios u
LEFT JOIN observacion o ON u.ident = o.usuario
LEFT JOIN regionales r ON r.codis = u.region
WHERE o.nordemp =" . $idest . "
AND o.modulo = 'CAPITULO_IV'
AND u.region !=99
AND o.fuente = 'CO' ";
$resulta = mysql_query($consulta, $con);
$observa_critico=mysql_fetch_array($resulta);
  $conscrit = "SELECT DISTINCT (o.observa)
				FROM observacion o
				LEFT JOIN usuarios u ON u.ident = o.usuario
				WHERE o.nordemp =" . $idest . "
				AND o.fuente = 'CO'
				AND o.modulo = 'CAPITULO_IV'
				AND u.region !=99 ";
$resucrit = mysql_query($conscrit, $con);
if($observa_critico['ident']!=''){
    echo "\n";    
    echo "\n";
	echo "OBSERVACIONES COORDINADOR REGIONAL: ". $observa_critico['nombre'] . " - " . $observa_critico['region'];
	echo "\n";
	$k=1;
	while ($obscr = mysql_fetch_array($resucrit)) {
		echo "\n";
		echo $k.". " .strtoupper($obscr['observa']);
		$k++;
	}
}
/*  COORDINADOR  RG*/
 $consulta = "SELECT DISTINCT ( u.ident), u.nombre, r.nombre as region
FROM usuarios u
LEFT JOIN observacion o ON u.ident = o.usuario
LEFT JOIN regionales r ON r.codis = u.region
WHERE o.nordemp =" . $idest . "
AND o.modulo = 'CAPITULO_IV'
AND u.region =99
AND o.fuente = 'CO' ";
$resulta = mysql_query($consulta, $con);
$observa_critico=mysql_fetch_array($resulta);
  $conscrit = "SELECT DISTINCT (o.observa)
				FROM observacion o
				LEFT JOIN usuarios u ON u.ident = o.usuario
				WHERE o.nordemp =" . $idest . "
				AND o.fuente = 'CO'
				AND o.modulo = 'CAPITULO_IV'
				AND u.region =99 ";
$resucrit = mysql_query($conscrit, $con);
if($observa_critico['ident']!=''){
    echo "\n";    
    echo "\n";
	echo "OBSERVACIONES COORDINADOR DANE CENTRAL: ". $observa_critico['nombre'] . " - " . $observa_critico['region'];
	echo "\n";
	$k=1;
	while ($obscr = mysql_fetch_array($resucrit)) {
		echo "\n";
		echo $k.". " .strtoupper($obscr['observa']);
		$k++;
	}
}
?></textarea> </td>
            <td width="50%" align="center" class="textoNormal"><textarea name="OBSERVACIONES1" cols="42" rows="3" id="OBSERVACIONES1" <? if($tipou=='CR' || $tipou=='CO'){ echo "readonly='true'"; } ?> onkeydown="OBSERVACIONES.value=(observaciones_read.value+OBSERVACIONES1.value)" onKeyUp="mayuscula(this.id);return normalizar(id)"  ></textarea> 
              <div id="cap1" style="position:absolute; width:200px; height:115px; z-index:1; visibility: hidden;"> 
                <textarea name="OBSERVACIONES" id="OBSERVACIONES" cols="42" rows="3"    >
<?
if ($row['OBSERVACIONES']!=''){ 
	echo $row['OBSERVACIONES'];

}
?>
</textarea>
              </div></td>
          </tr>
        </table></td>
    </tr>
  </table>
  </div>  