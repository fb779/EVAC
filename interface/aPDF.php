<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	// require_once "../dompdf/dompdf_config.inc.php";
	$region = $_SESSION['region'];
	$vig=$_SESSION['vigencia'];
	//$nomPeriodo = $_SESSION['nomPeri'];
	$numero = $_GET['numord'];

	// $dompdf = new DOMPDF();
	// $dompdf->set_paper("letter", "portrait");
	// // $dompdf->set_base_path('/bootstrap/css/bootstrap.min.css');
	// $dompdf->set_base_path(DOMPDF_DIR . '../bootstrap/css');
	// $dompdf->load_html( utf8_decode( file_get_contents( "http://localhost/evac/interface/capi1PDF_BT.php?numord=".$numero."&vigencia=".$vig) ) );
	// $dompdf->render();
	// $dompdf->stream("mi_archivo.pdf");

	include('convertToPDF.php');

	$html =  utf8_decode( file_get_contents("http://localhost/evac/interface/capi1PDF_BT.php?numord=".$numero."&vigencia=".$vig));
	$style = '';
	// $style = '';
	// doPDF('nombrePDF',$html,true,'style.css',false,'letter','landscape');
	doPDF('nombrePDF',$html,true,$style,false,'Letter','portrait');

?>