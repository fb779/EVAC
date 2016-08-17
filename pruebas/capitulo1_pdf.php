
<?php
require('../fpdf181/fpdf.php');

$pdf = new FPDF('P','cm','Legal');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,1,'Quiboles mundo degenerado!',1,0,'L');
$pdf->Cell(100,1,'Quiboles mundo degenerado!',1,0,'C');
$pdf->Cell(200,30,'Powered by FPDF.',0,1,'C');
$pdf->Output();
?>