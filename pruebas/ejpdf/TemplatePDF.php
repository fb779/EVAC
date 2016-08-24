<?php
	require('../../fpdf181/fpdf.php');
	// include('TemplatePDF.php');

	class TemplatePDF extends FPDF {
		var $aj_cell_w = 0; // 0 se extiende hasta la márgen derecha
		var $aj_cell_h = 1; // Alto de celda. Valor por defecto 0.
		var $aj_border = ['si' => 1, 'no' => 0];
		var $aj_bo_esp = ['L' => 'LTRB'];

		//Cabecera de página
		function Header() {
			// $this->Image('logo.png',10,8,33);
			$this->cell(80);
			$this->SetFont('Arial','B',12);
			$this->Cell(30,10,'Title',1,0,'C');
			$this->Ln(20);
		}

		//Pie de página
		function Footer() {
			$this->SetY(-8);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}

?>