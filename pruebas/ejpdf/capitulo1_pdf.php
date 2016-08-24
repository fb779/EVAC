
<?php

try {
	require('TemplatePDF.php');


	// echo "string";
	// $pdf = new TemplatePDF();
	$pdf = new TemplatePDF('P','mm','Letter');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0, 7, 'Quiboles mundo degenerado!', 0, 0);
	$pdf->Ln();
	for($i=1;$i<=40;$i++) {
		$pdf->Cell(0,5, utf8_decode('Imprimiendo línea número '.$i),0,1);
	}
	// $pdf->Cell(0,1,'Quiboles mundo degenerado!',0,1,'L');
	// $pdf->Cell(0,1,'Quiboles mundo degenerado!',0,1,'C');
	// $pdf->Cell(0,1,'Quiboles mundo degenerado!',0,1,'R');
	// $pdf->Cell(200,30,'Powered by FPDF.',0,1,'C');
	$pdf->Output();
} catch (Exception $e) {
	echo $e;
}
?>