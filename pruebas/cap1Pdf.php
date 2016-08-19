<?php
	require_once("../dompdf/dompdf_config.inc.php");

	//$html = 'cap1.html';

	$hmtl = '
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title></title>
			<link rel="stylesheet" href="">
		</head>
		<body>
			<h4>esto es un html simple de prueba para la impresion de un pdf</h4>
		</body>
		</html>
	';

	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream("pazysalvo.pdf");
	/*require_once "../dompdf/dompdf_config.inc.php";
	ob_start();*/
?>

