<?php
	if (session_id() == "") {
		session_start();
	}
	
	$ident_usu = $_SESSION['idusu'];
	$region = $_SESSION['region'];
	$nombre = $_SESSION['nombreu'];
	$vig = $_SESSION['vigencia'];
	$anterior = $vig -1;
	include '../conecta.php';
	
	date_default_timezone_set('America/Bogota');
	
	require_once '../mailer/PHPMailer_5.2.3/class.phpmailer.php';
	$fecha = date("Y-m-d");
	$qRegion = $conn->query("SELECT * FROM regionales WHERE codis = " . $region);
	foreach($qRegion AS $dato_region) {
		$a=1;
	}
	
	$qCorreo = $conn->query("SELECT a.numdoc, a.dv, a.nordemp, a.nombre, a.dirnotifi, a.emailnotif, b.estado FROM caratula a, control b
		WHERE a.regional = $region AND (a.envcorr IN ( 0, 2 ) OR a.vericorr =0) AND a.activa =1 AND a.nordemp = b.nordemp AND b.estado =0");
		
	foreach ($qCorreo AS $lcorreo) {
		$nit = $lcorreo['numdoc'];
		$dv = $lcorreo['dv'];
		$nordemp = $lcorreo['nordemp'];
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPKeepAlive = true;
		//$mail->SingleTo = true; //Oculta el correo quien realiza el envio
		//$mail->SMTPSecure = "ssl";
		$mail->Host = "192.168.1.98";
		$mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing) 12.// 1 = errors and messages 13.// 2 = messages only
		$mail->MailerDebug = true;
		$mail->Port = 25;
		$mail->Username = "aplicaciones@dane.gov.co";
		$mail->Password = "Ou67UtapW3v";
		$mail->AddReplyTo('edit@dane.gov.co', 'DANE - Encuesta de Desarrollo e Innovación Tecnológica');
		$mail->SetFrom('edit@dane.gov.co', 'DANE - Encuesta de Desarrollo e Innovación Tecnológica');
		$mail->Subject = "DANE - Información Encuesta de Desarrollo e Innovación Tecnológica";
		$mail->AddEmbeddedImage('../images/banner_top.png', 'banner_top', 'banner_top.png');
		$mail->Body = "<table>
		<tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
		<td><img src=\"cid:banner_top\" width='438' height='70' /></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
		</tr>
		<tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
		<td style='font-family: arial; font-size: 14px'><b></b><br><br>
		" . $dato_region['nombre'] . "  " . $fecha . 
		"<br><br><br>Señores<b><br>
		" . $lcorreo['nombre'] . "</b><br><b>
		" . $lcorreo['dirnotifi'] . "</b><br>
		Ciudad<br><br><br><br>
		Asunto:   Notificaci&oacute;n encuesta de desarrollo e innovaci&oacute;n tecnol&oacute;gica – EDIT<br><br><br><br>		
		<p style = 'text-align: justify; font-size: 14px'>Cordial saludo:</p>
		<p style = 'text-align: justify; font-size: 14px'>El Departamento Administrativo Nacional de Estad&iacute;stica - DANE como ente
		rector del Sistema Estad&iacute;stico Nacional, asegura la producción de estad&iacute;sticas b&aacute;sicas y estrat&eacute;gicas
		para la toma de decisiones en el desarrollo econ&oacute;mico y social del pa&iacute;s</p>
		<p style = 'text-align: justify; font-size: 14px'>Con el fin de cumplir con este objetivo, el DANE desarrolla una medición con periodicidad
		bianual de las diferentes actividades de desarrollo e innovaci&oacute;n tecnol&oacute;gica, en el sector de servicios a trav&eacute;s de la 
		<b>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - EDIT</b>. Esta encuesta tiene como objetivo general, caracterizar la
		din&aacute;mica tecnol&oacute;gica y analizar las actividades de innovaci&oacute;n y desarrollo tecnol&oacute;gico en las empresas con actividad
		servicios en Colombia, as&iacute; como realizar una evaluaci&oacute;n de los instrumentos de pol&iacute;tica, tanto de fomento como de
		protecci&oacute;n a la innovaci&oacute;n.</p>
		<p style = 'text-align: justify; font-size: 14px'>Con el prop&oacute;sito de facilitar  el reporte de la informaci&oacute;n
		correspondiente a los a&ntilde;os " . $anterior . "-" . $vig . ", el Dane  tiene a su disposici&oacute;n un formulario electr&oacute;nico al cual podr&aacute; ingresar
		luego de <a style='font-size: 16px' href='http://formularios.dane.gov.co/EDITSV/administracion/correosctl.php?b04f60=" . $nit . "&5f458dc406e8=" . $dv . "&b0a6a243b5fe=" . $nordemp . "&per=" . $vig . "'><b>GENERAR SU USUARIO Y CONTRASE&Ntilde;A</b></a>.</p>
		<p style = 'text-align: justify; font-size: 14px'>A trav&eacute;s del siguiente link <a style='font-size: 16px' href='http://formularios.dane.gov.co/EDITSV/'><b>Formulario Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica</b></a>,
		podr&aacute; ingresar a diligenciar el formulario.
		<p style = 'text-align: justify; font-size: 14px'>Recuerde que su empresa cuenta con 10 d&iacute;as h&aacute;biles a partir del 1 de febrero para rendir la informaci&oacute;n solicitada en el formulario; una vez enviada esta informaci&oacute;n ser&aacute; 
		sometida a revisi&oacute;n por el  funcionario asignado por el  DANE y posteriormente si existe alguna duda sobre el diligenciamiento, esta persona  se contactara  con usted para confirmar o modificar dicha informaci&oacute;n.
		<p style = 'text-align: justify; font-size: 14px'>Para mayor informaci&oacute;n y aclaraciones, reiteramos que cuenta de forma gratuita con la
		asesor&iacute;a de personal del DANE, quienes lo estar&aacute;n visitando para apoyarlo en el diligenciamiento del formulario, igualmente puede
		comunicarse al <b>tel&eacute;fono " . $dato_region['telefono'] . 
		"</b><p style = 'text-align: justify; font-size: 14px'>Resulta importante precisar, que de acuerdo con la ley 079 del 20 de octubre de 1993
		los datos que el DANE solicita en estos formularios son estrictamente confidenciales y en ning&uacute;n caso tienen fines fiscales
		 ni pueden ser utilizados como prueba judicial.</p><br><br><br>
		<p style = 'text-align: justify; font-size: 14px'>Cordialmente,<br><br><br><br><b>" . $dato_region['asistente'] . "</b><br>
		ASISTENTE T&Eacute;CNICO<br>ENCUESTA DE DESARROLLO E INNOVACI&Oacute;N TECNOL&Oacute;GICA<br>" . $dato_region['nombre'] . "<br>" . $dato_region['direccion'] . "<br>" . $dato_region['telefono'] . "<br>" . $dato_region['correo'] .  
		"</td></tr></table>";
		$mail->AddAddress($lcorreo['emailnotif']);
	//		$mail->AddAttachment("mailer/Industriales.xlsx", "Industria 2011.xlsx");
	//		$mail->AddAttachment("mailer/Industria450.pdf", "Carta EAM.pdf");
		$mail->IsHTML(true);
		//$mail->ConfirmReadingTo = "fajaimesm@dane.gov.co";
			
		if(!$mail->Send()){
			$rmalos = $conn->prepare("UPDATE caratula SET envcorr = 2 WHERE nordemp = " . $lcorreo['nordemp']);
			$rmalos->execute();
		} else {
			$rbuenos = $conn->prepare("UPDATE caratula SET envcorr = 1, fec_correo = NOW() WHERE nordemp = " . $lcorreo['nordemp']);
			$rbuenos->execute();
		}  
		//$mail->ClearAllRecipients();
		$mail->ClearAddresses();
		$mail->ClearAttachments();
		//unset($mail); 
	}
 	$resumen = $conn->query("SELECT envcorr, COUNT( envcorr ) AS enviados FROM caratula WHERE regional = " . $region . " GROUP BY envcorr");
  	foreach ($resumen AS $linea) {
 		switch ($linea['envcorr']) {
 			case 0:
 				echo "NO ENVIADOS: " . $linea['enviados'] . "<br />";
 				break;
 			case 1:
 				echo "ENVIADOS:    " . $linea['enviados'] . "<br />";
 				break;
 			case 2:
 				echo "ERRADOS:     " . $linea['enviados'] . "<br />";
 				break;
 		}
 	}
 	echo "Envío terminado";
//http://formularios.dane.gov.co/eam/ 	
?>
