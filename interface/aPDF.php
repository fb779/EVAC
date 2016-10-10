<?php
/*----------------------------------------------------------/*

$path     : nombre y/o ruta del pdf (sin la extensión)
                p.e: --> 'ejemplo' , 'pdfs/nuevo-ejemplo'
                si se deja vacío --> se genera uno aleatorio

$content  : contenido del pdf

$body     : true o false.
                true  --> Añade; <doctype>, <body>, <head> a $content
                false --> no altera el $content

$style    : la ruta de la CSS. Puede estar vacía
                 Para cargar una css --> necesita $body = true;

$mode     : true o false.
                true  --> guarda el pdf en un directorio y lo muestra
                false --> pregunta si guarda o abre el archivo

$paper_1  : tamaño del papel[*]
$paper_2  : estilo del papel[*]

    [*] como ver las opciones disponibles:
        --> http://code.google.com/p/dompdf/wiki/Usage#Invoking_dompdf_via_the_command_line

/*----------------------------------------------------------*/

	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	$nameUsuario = $_SESSION['nombreu'];
	$region = $_SESSION['region'];
	$vig=$_SESSION['vigencia'];
	$namePeriodo =$_SESSION['nomPeriAct'];

	$numero = $_GET['numord'];

    include('convertToPDF.php');

    $host = $_SERVER['SERVER_NAME'];
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
    // $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
    $path = $nameUsuario.' - '.$namePeriodo;
    // $content = utf8_decode(file_get_contents("http://localhost/evac/interface/capi1PDF_BT.php?numord=".$numero."&vigencia=".$vig));
    $content = utf8_decode(file_get_contents($protocol."".$host."/interface/capi1PDF_BT.php?numord=".$numero."&vigencia=".$vig));
    $body = true;
    $style = '';
    $mode = false;

	toPDF($path,$content,$body,$style,false,'Letter','portrait');

?>