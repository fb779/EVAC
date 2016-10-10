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
    include '../conecta.php';

	ini_set('default_charset', 'UTF-8');

    $vig = $_SESSION['vigencia'];
    $namePeriodo = $_SESSION['nomPeriAct'];
    // $nameUsuario = $_SESSION['nombreu'];
    $numero = $_GET['numord'];

    $emQuery = $conn->query("SELECT nombre FROM caratula WHERE nordemp = $numero")->fetch(PDO::FETCH_ASSOC);
    $nameEmpresa = $emQuery['nombre'];
    // $region = $_SESSION['region'];

    include('convertToPDF.php');

    $host  = $_SERVER['HTTP_HOST'];
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
    $selff = str_replace('aPDF.php', '', $_SERVER['PHP_SELF']);

    $rutaBase = $protocol."".$host."".$selff;

    $content = utf8_decode(file_get_contents($rutaBase."/capi1PDF_BT.php?numord=".$numero."&vigencia=".$vig));
    // $content = file_get_contents($rutaBase."/capi1PDF_BT.php?numord=".$numero."&vigencia=".$vig);

    $path = $nameEmpresa.' - '.$namePeriodo;
    $body = true;
    $style = '';
    $mode = false;

	toPDF($path,$content,$body,$style,false,'Letter','portrait');
?>