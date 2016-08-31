<?php
if(session_id() == "") {
	session_start();
}
$vig = $_SESSION['vigencia'];

require('../fpdf/fpdf.php');

class PDF extends FPDF
{
	function Header()
	{
		$this->Image('../images/banner_superior.png',6,7,200);
        $this->Image('../images/banner_titulo.png',6,25,200);

		$this->SetFont('Arial','B',15);
		$this->Cell(50);
		$this->Cell(90,42,'PAZ Y SALVO',0,0,'C');
		//$this->Image('images/banner_pazysalvo.png',90,40,35);
		$this->Cell(-140);
		$this->SetFont('Arial','B',10);
		$this->Write(80,'EL DEPARTAMENTO ADMINISTRATIVO NACIONAL DE ESTADISTICA - DANE - CERTIFICA QUE:');
		$this->Ln(10);

	}
}

$empresa = $_GET['numord'];

include '../conecta.php';

$nomPeriodo = $conn->query("SELECT nomperiodo FROM periodoactivo WHERE id = ".$vig)->fetch(PDO::FETCH_ASSOC);

$qCara = $conn->query("SELECT a.nordemp, a.nombre, a.nompropie, a.direccion, a.numdoc, a.depto, a.mpio, b.ndpto, b.nmuni FROM caratula a, divipola b WHERE a.nordemp = $empresa AND b.dpto = a.depto AND b.muni = a.mpio");

foreach($qCara AS $lCara) {
	$nombre = $lCara['nombre'];
	$razons = $lCara['nompropie'];
	$direccion = $lCara['direccion'];
	$documento = $lCara['numdoc'];
	$mpio = $lCara['nmuni'];
	$dpto = $lCara['ndpto'];
	$numero = $lCara['nordemp'];
}

$pdf=new PDF();
$pdf->AddPage();
$pdf->Image('../images/fondo_datos.png',6,60,199);
$pdf->SetFont('Times','',11);
$pdf->Cell(0,240);
$pdf->Write(30,'La empresa: ');
$pdf->SetFont('Arial','I',11);
$pdf->Cell(90,30,$nombre,0,0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','',11);
$pdf->Write(30,'Razón Social: ');
$pdf->SetFont('Arial','I',11);
$pdf->Cell(90,30,$razons,0,0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','',11);
$pdf->Write(30,'Dirección: ');
$pdf->SetFont('Arial','I',11);
$pdf->Cell(55,30,$direccion,0,0,'L');
$pdf->Cell(60);
$pdf->SetFont('Times','',11);
$pdf->Cell(-6);
$pdf->Write(30,'NIT: ');
$pdf->SetFont('Arial','I',11);
$pdf->Cell(30,30,$documento,0,0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','',11);
$pdf->Write(30,'Municipio: ');
$pdf->SetFont('Arial','I',12);
$pdf->Cell(48,30,$mpio,0,0,'L');
$pdf->Cell(60);
$pdf->SetFont('Times','',11);
$pdf->Write(30,'Departamento: ');
$pdf->SetFont('Arial','I',12);
$pdf->Cell(30,30,$dpto,0,0,'L');
$pdf->Ln(10);
$pdf->SetFont('Times','',11);
$pdf->Write(30,'Rindió la Encuesta de Vacantes correspondiente al '. $nomPeriodo['nomperiodo'] .' y cumplió con los requisitos establecidos en ');
$pdf->Ln(10);
$pdf->Write(30,'la Ley 0079 del 20 de Octubre de 1993.');
//$pdf->Ln(10);
//$pdf->Write(30,'');
$pdf->Ln(10);
$pdf->SetFont('Times','',11);
$pdf->Write(30,'Esta empresa debe identificarse con el número ');
$pdf->SetFont('Arial','I',12);
$pdf->Write(30,$numero);
$pdf->SetFont('Times','',11);
$pdf->Cell(0,30,'  para todos los trámites requeridos y para la información estadística ');
$pdf->Ln(10);
$pdf->Write(30,'solicitada por el DANE.');
$pdf->Ln(10);
$pdf->Ln(10);
$pdf->Write(30,'Recuerde que la emisión del paz y salvo, no evita consultas posteriores por parte del DANE, frente a la información ');
$pdf->Ln(10);
$pdf->Write(30,'por ustedes reportada; lo que si evita es la aplicación de las sanciones establecidas en la ley 079 de 1993, por no ');
$pdf->Ln(10);
$pdf->Write(30,'rendir información al DANE.',0,'L');
//$pdf->Ln(10);
//$pdf->Write(30,'Válido hasta: ',0,'L');
//$pdf->SetFont('Arial','I',12);
//$pdf->Cell(30,30,' Marzo de 2010',0,0,'C');
//$pdf->Ln();

$pdf->Output('registro.pdf','I');
?>
