<?php
	require('../fpdf181/fpdf.php');
	// include('TemplatePDF.php');

	class TemplatePDF extends FPDF {

	// 	/*function __construct()
	// 	{
	// 		parent::__construct();
	// 	}*/

		//Cabecera de página
		function Header() {
			// $this->Image('logo.png',10,8,33);
			$this->SetY(0.5);
			$this->SetFont('Arial','B',12);
			$this->Cell(10,1,'Title',1,2,'C');
		}

		//Pie de página
		function Footer() {
			$this->SetY(-1.5);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,1,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}

?>