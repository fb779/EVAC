<?php
	if (session_id() == "") {
		session_start();
	}
	ini_set('default_charset', 'UTF-8');
	$region = $_SESSION['region'];
	$vig=$_SESSION['vigencia'];
	$numero = $_GET['numord'];

	// require_once "../dompdf/dompdf_config.inc.php";
	// $dompdf = new DOMPDF();
	// $dompdf->set_paper("letter", "portrait");
	// // $dompdf->set_base_path('/bootstrap/css/bootstrap.min.css');
	// $dompdf->set_base_path(DOMPDF_DIR . '../bootstrap/css');
	// $dompdf->load_html( utf8_decode( file_get_contents( "http://localhost/evac/interface/capi1PDF_BT.php?numord=".$numero."&vigencia=".$vig) ) );
	// $dompdf->render();
	// $dompdf->stream("mi_archivo.pdf");

	include('convertToPDF.php');

	$html = utf8_decode(file_get_contents("http://localhost/evac/interface/capi1PDF_BT.php?numord=".$numero."&vigencia=".$vig));
	// echo htmlentities($bodytag);
	// $html = file_get_contents("http://localhost/evac/interface/capi1PDF_BT.php?numord=".$numero."&vigencia=".$vig);
	// echo "$html";
	$style = '';

	doPDF('nombrePDF',$html,true,$style,false,'Letter','portrait');

?>