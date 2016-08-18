
<?php

try {
	require('TemplatePDF.php');


	// echo "string";
	// $pdf = new TemplatePDF();
	$pdf = new TemplatePDF('P','cm','Legal');
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,1.6,'Quiboles mundo degenerado!',0,1,'L');
	$pdf->Cell(0,1.6,'Quiboles mundo degenerado!',0,1,'L');
	$pdf->Cell(0,1,'Quiboles mundo degenerado!',0,1,'C');
	$pdf->Cell(0,1,'Quiboles mundo degenerado!',0,1,'R');
	$pdf->Cell(200,30,'Powered by FPDF.',0,1,'C');
	$pdf->Output();
} catch (Exception $e) {
	echo $e;
}
?>