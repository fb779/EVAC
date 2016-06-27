<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='cap4';
	$vig=$_SESSION['vigencia'];
	$estadObs = ($tipousu != "FU" ? "readonly" : "");
	$anterior = $vig-1;
	$tabla = 'capitulo_iv'; $tabla2 = 'capitulo_iva';
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$grabaOK = false;
	
	$consLog = ($region == 99 ? true : false);
	
	$cLog = "<span class='glyphicon glyphicon-time' style='color: blue; font-size: 14px;'></span>";
	
	$estadoIV1 = 'disabled'; $estadoIV21 = ''; $estadoIV22 = ''; $estadoIV6 = ''; $estadoIV71 = ''; $estadoIV72 = ''; $estadoIV5 = '';
	$estadoIV4R6C1 = ''; $estadoIV4R6C2 = ''; $estadoIV4R6C3 = '';
	
	$qCap2 = $conn->prepare("SELECT * FROM capitulo_ii WHERE C2_nordemp= :idNumero AND vigencia = :anoProc");
	$qCap2->execute(array('idNumero'=>$numero, 'anoProc'=>$vig));
	$rowc2 = $qCap2->fetch(PDO::FETCH_ASSOC);
	
	if ($rowc2['II1R9C1']==0) {
		$estadoIV71 = 'disabled';
		$qLimpia4a = $conn->prepare("UPDATE capitulo_iv SET IV7R1C1=NULL,IV7R2C1=NULL,IV7R3C1=NULL,IV7R4C1=NULL,IV7R5C1=NULL WHERE C4_nordemp = $numero AND vigencia = $vig");
		$qLimpia4a->execute();
	}
	if ($rowc2['II1R9C2']==0) {
		$estadoIV72 = 'disabled';
		$qLimpia4a = $conn->prepare("UPDATE capitulo_iv SET IV7R1C2=NULL,IV7R2C2=NULL,IV7R3C2=NULL,IV7R4C2=NULL,IV7R5C2=NULL WHERE C4_nordemp = $numero AND vigencia = $vig");
		$qLimpia4a->execute();
	}
	
	$qCap1 = $conn->prepare("SELECT * FROM capitulo_i WHERE C1_nordemp= :idNumero AND vigencia = :anoProc");
	$qCap1->execute(array('idNumero'=>$numero, 'anoProc'=>$vig));
	$rowc1 = $qCap1->fetch(PDO::FETCH_ASSOC);
	
	if ($rowc1['I1R1C1N']!=1 AND $rowc1['I1R2C1N']!=1 AND $rowc1['I1R3C1N']!=1 AND $rowc1['I1R1C1M']!=1 AND $rowc1['I1R2C1M']!=1 AND $rowc1['I1R3C1M']!=1 
		AND $rowc1['I1R4C1']!=1 AND $rowc1['I1R5C1']!=1 AND $rowc1['I1R6C1']!=1 AND $rowc1['I5R1C1']!=1 AND $rowc1['I6R1C1']!=1) {
			$estadoIV1 = 'disabled';
			$qLimpia4 = $conn->prepare("UPDATE capitulo_iv SET IV1R1C3=NULL,IV1R1C4=NULL,IV1R2C3=NULL,IV1R2C4=NULL,IV1R3C3=NULL,IV1R3C4=NULL,
				IV1R4C3=NULL,IV1R4C4=NULL,IV1R5C3=NULL,IV1R5C4=NULL,IV1R6C3=NULL,IV1R6C4=NULL,IV1R7C3=NULL,IV1R7C4=NULL,IV1R8C3=NULL,IV1R8C4=NULL,
				IV1R9C3=NULL,IV1R9C4=NULL,IV1R10C3=NULL,IV1R10C4=NULL,IV1R11C3=NULL,IV1R11C4=NULL,IV2R1C1=NULL,IV2R1C2=NULL,IV2R2C1=NULL,IV2R2C2=NULL,
				IV2R3C1=NULL,IV2R3C2=NULL,IV2R4C1=NULL,IV2R4C2=NULL,IV2R5C1=NULL,IV2R5C2=NULL,IV2R6C1=NULL,IV2R6C2=NULL,IV2R7C1=NULL,IV2R7C2=NULL,
				IV2R8C1=NULL,IV2R8C2=NULL,IV2R9C1=NULL,IV2R9C2=NULL,IV2R10C1=NULL,IV2R10C2=NULL,IV2R11C1=NULL,IV2R11C2=NULL,IV2R12C1=NULL,IV2R12C2=NULL,
				IV2R13C1=NULL,IV2R13C2=NULL,IV2R14C1=NULL,IV2R14C2=NULL,IV2R15C1=NULL,IV2R15C2=NULL,IV2R16C1=NULL,IV2R16C2=NULL,IV2R17C1=NULL,IV2R17C2=NULL,
				IV2R18C1=NULL,IV2R18C2=NULL,IV2R19C1=NULL,IV2R19C2=NULL,IV2R20C1=NULL,IV2R20C2=NULL,IV2R21C1=NULL,IV2R21C2=NULL,IV2R22C1=NULL,IV2R22C2=NULL,
				IV2R23C1=NULL,IV2R23C2=NULL,IV2R24C1=NULL,IV2R24C2=NULL,IV2R25C1=NULL,IV2R25C2=NULL,IV2R26C1=NULL,IV2R26C2=NULL,IV2R27C1=NULL,IV2R27C2=NULL,
				IV2R28C1=NULL,IV2R28C2=NULL,IV2R29C1=NULL,IV2R29C2=NULL,IV2R30C1=NULL,IV2R30C2=NULL,IV2R31C1=NULL,IV2R31C2=NULL,IV2R32C1=NULL,IV2R32C2=NULL,
				IV2R33C1=NULL,IV2R33C2=NULL,IV2R34C1=NULL,IV2R34C2=NULL,IV4R1C1=NULL,IV4R1C2=NULL,IV4R1C3=NULL,IV4R2C1=NULL,IV4R2C2=NULL,IV4R2C3=NULL,
				IV4R3C1=NULL,IV4R3C2=NULL,IV4R3C3=NULL,IV4R4C1=NULL,IV4R4C2=NULL,IV4R4C3=NULL,IV4R5C1=NULL,IV4R5C2=NULL,IV4R5C3=NULL,IV4R6C1=NULL,IV4R6C2=NULL,IV4R6C3=NULL,
				IV4R7C1=NULL,IV4R7C2=NULL,IV4R7C3=NULL,IV4R8C1=NULL,IV4R8C2=NULL,IV4R8C3=NULL,IV4R9C1=NULL,IV4R9C2=NULL,IV4R9C3=NULL,IV4R10C1=NULL,IV4R10C2=NULL,IV4R10C3=NULL,
				IV4R11C1=NULL,IV4R11C2=NULL,IV4R11C3=NULL,IV5R1C1='',IV5R1C2=NULL,IV5R1C3=NULL,IV6R1C1=NULL,IV6R1C2=NULL,IV6R1C3=NULL,IV6R2C1=NULL,IV6R2C2=NULL,IV6R2C3=NULL,
				IV6R3C1=NULL,IV6R3C2=NULL,IV6R3C3=NULL,IV6R4C1=NULL,IV6R4C2=NULL,IV6R4C3=NULL,IV6R5C1=NULL,IV6R5C2=NULL,IV6R5C3=NULL,IV6R6C1=NULL,IV6R6C2=NULL,IV6R6C3=NULL,
				IV6R7C1=NULL,IV6R7C2=NULL,IV6R7C3=NULL,IV6R8C1=NULL,IV6R8C2=NULL,IV6R8C3=NULL WHERE C4_nordemp = $numero AND vigencia = $vig");
			$qLimpia4->execute();
	}
	include '../persistencia/cargaDato.php';
	
	if ($rowc1['I1R1C1N']==1 OR $rowc1['I1R2C1N']==1 OR $rowc1['I1R3C1N']==1 OR $rowc1['I1R1C1M']==1 OR $rowc1['I1R2C1M']==1 OR $rowc1['I1R3C1M']==1 
		OR $rowc1['I1R4C1']==1 OR $rowc1['I1R5C1']==1 OR $rowc1['I1R6C1']==1 OR $rowc1['I5R1C1']==1 OR $rowc1['I6R1C1']==1) {
			$estadoIV1 = '';
	}
	
	if ($row['IV1R11C3']==0) {
		$estadoIV21 = 'disabled';
	}
	if ($row['IV1R11C4']==0) {
		$estadoIV22 = 'disabled';
	}
	if ($row['IV1R1C4']+$row['IV1R2C4']+$row['IV1R3C4']+$row['IV1R4C4']+$row['IV1R5C4']+$row['IV1R6C4']==0) {
		$estadoIV6 = 'disabled';
	}
	if ($row['IV4R6C1']==0) {
		$estadoIVR6C1 = "disabled";
	}
	
	if ($row['IV4R6C2']==0) {
		$estadoIVR6C2 = "disabled";
	}
	
	if ($row['IV4R6C3']==0) {
		$estadoIVR6C3 = "disabled";
	}
	
	if ($row['IV5R1C1']!=1) {
		$estadoIV5 = "disabled";
	}
	
	$qCap2 = $conn->prepare("SELECT * FROM capitulo_ii WHERE C2_nordemp= :idNumero AND vigencia = :anoProc");
	$qCap2->execute(array('idNumero'=>$numero, 'anoProc'=>$vig));
	$rowc2 = $qCap2->fetch(PDO::FETCH_ASSOC);
	
	if ($rowc2['II1R9C1']==0) {
		$estadoIV71 = 'disabled';
	}
	if ($rowc2['II1R9C2']==0) {
		$estadoIV72 = 'disabled';
	}
	
	if ($tipousu != "FU") {
		$txtEstado = " - estado - " . $rowCtl['desc_estado'];
	}
	else {
		$txtEstado = "";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Encuesta de Desarrollo e Innovaci&oacute;n Tecnol&oacute;gica - Formulario Electr&oacute;nico</title>
		<link href="../bootstrap/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
		<!-- Bootstrap -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../bootstrap/css/custom.css" rel="stylesheet">
		<link href="../bootstrap/css/sticky-footer.css" rel="stylesheet">		
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/cargaDato.js"></script>
		<script type="text/javascript" src="../js/valida1.js"></script>
		<script type="text/javascript" src="../js/validaForm4.js"></script>
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/html5shiv.js"></script>
		<script type="text/javascript" src="../js/respond.js"></script>
		<script type="text/javascript" src="../js/css3-mediaqueries.js"></script>
		<style type="text/css"> p {font-size: 13px !important;}</style>
		<style>
			.modal-width {
				width: 90%;
			}
		</style>
		<script type="text/javascript">
			var retorno = "";
			$(function() {
            	$("#capitulo4").submit(function(event) {
                	event.preventDefault();

	                $.ajax({
	                    url: "../persistencia/grabacapi.php",
	                    type: "POST",
	                    data: $(this).serialize(),
	                    beforeSend:  validaForm4,
	                    success: function(dato) {
		                   	if (retorno=="") {
								$("#btn_cont").show();
								$("#idmsg").show();
								$(function() {
									$.ajax({
									url: "../persistencia/grabactl.php",
									type: "POST",
									data: {modulo: "m4", estado: "2", numero: $("#numero").val(), capitulo: "C4"},
									success: function(dato) {
									}
								});
								});
								if ($("#idTipo").val() == "CR") {
									$("#idObs1").modal('show');
								}
							}
							else {
								retorno = "id"+retorno;
								document.getElementById(retorno).focus();
								$(function() {
									$.ajax({
									url: "../persistencia/grabactl.php",
									type: "POST",
									data: {modulo: "m4", estado: "1", numero: $("#numero").val(), capitulo: "C3"},
									success: function(dato) {
									}
								});
								});
							}
	                    }
	                });
            	});
			});

			$(function() {
				$("#idiv1r1c1,#idiv1r2c1,#idiv1r3c1,#idiv1r4c1,#idiv1r5c1,#idiv1r6c1,#idiv1r7c1,#idiv1r8c1,#idiv1r9c1,#idiv1r10c1,#idiv1r11c1,#idiv1r1c2,#idiv1r2c2,#idiv1r3c2,#idiv1r4c2,#idiv1r5c2,#idiv1r6c2,#idiv1r7c2,#idiv1r8c2,#idiv1r9c2,#idiv1r10c2,#idiv1r11c2,#idiv1r1c3,#idiv1r2c3,#idiv1r3c3,#idiv1r4c3,#idiv1r5c3,#idiv1r6c3,#idiv1r7c3,#idiv1r8c3,#idiv1r9c3,#idiv1r10c3,#idiv1r11c3,#idiv1r1c4,#idiv1r2c4,#idiv1r3c4,#idiv1r4c4,#idiv1r5c4,#idiv1r6c4,#idiv1r7c4,#idiv1r8c4,#idiv1r9c4,#idiv1r10c4,#idiv1r11c4,#idiv3r1c1,#idiv3r1c2").keyup(function(){
					if ($(this).val() != "")
						$(this).val( $(this).val().replace(/[^0-9]/g, '') );
				});
			});

			$(function() {
				$("#idiv1r1c1,#idiv1r2c1,#idiv1r3c1,#idiv1r4c1,#idiv1r5c1,#idiv1r6c1,#idiv1r7c1,#idiv1r8c1,#idiv1r9c1,#idiv1r10c1,#idiv1r11c1,#idiv1r1c2,#idiv1r2c2,#idiv1r3c2,#idiv1r4c2,#idiv1r5c2,#idiv1r6c2,#idiv1r7c2,#idiv1r8c2,#idiv1r9c2,#idiv1r10c2,#idiv1r11c2,#idiv1r1c3,#idiv1r2c3,#idiv1r3c3,#idiv1r4c3,#idiv1r5c3,#idiv1r6c3,#idiv1r7c3,#idiv1r8c3,#idiv1r9c3,#idiv1r10c3,#idiv1r11c3,#idiv1r1c4,#idiv1r2c4,#idiv1r3c4,#idiv1r4c4,#idiv1r5c4,#idiv1r6c4,#idiv1r7c4,#idiv1r8c4,#idiv1r9c4,#idiv1r10c4,#idiv1r11c4,#idiv3r1c1,#idiv3r1c2").blur(function(){
					if ($(this).val() != "") {
						$(this).val(parseInt($(this).val()));
					}
				});
			});
			
			$(function() {
				$("#idiv2r1c1,#idiv2r2c1,#idiv2r3c1,#idiv2r4c1,#idiv2r5c1,#idiv2r6c1,#idiv2r7c1,#idiv2r8c1,#idiv2r9c1,#idiv2r10c1,#idiv2r11c1,#idiv2r12c1,#idiv2r13c1,#idiv2r14c1,#idiv2r15c1,#idiv2r16c1,#idiv2r17c1,#idiv2r18c1,#idiv2r19c1,#idiv2r20c1,#idiv2r21c1,#idiv2r22c1,#idiv2r23c1,#idiv2r24c1,#idiv2r25c1,#idiv2r26c1,#idiv2r27c1,#idiv2r28c1,#idiv2r29c1,#idiv2r30c1,#idiv2r31c1,#idiv2r32c1,#idiv2r33c1,#idiv2r34c1,#idiv2r1c2,#idiv2r2c2,#idiv2r3c2,#idiv2r4c2,#idiv2r5c2,#idiv2r6c2,#idiv2r7c2,#idiv2r8c2,#idiv2r9c2,#idiv2r10c2,#idiv2r11c2,#idiv2r12c2,#idiv2r13c2,#idiv2r14c2,#idiv2r15c2,#idiv2r16c2,#idiv2r17c2,#idiv2r18c2,#idiv2r19c2,#idiv2r20c2,#idiv2r21c2,#idiv2r22c2,#idiv2r23c2,#idiv2r24c2,#idiv2r25c2,#idiv2r26c2,#idiv2r27c2,#idiv2r28c2,#idiv2r29c2,#idiv2r30c2,#idiv2r31c2,#idiv2r32c2,#idiv2r33c2,#idiv2r34c2").keyup(function(){
					if ($(this).val() != "")
						$(this).val( $(this).val().replace(/[^0-9]/g, '') );
				});
			});

			$(function() {
				$("#idiv2r1c1,#idiv2r2c1,#idiv2r3c1,#idiv2r4c1,#idiv2r5c1,#idiv2r6c1,#idiv2r7c1,#idiv2r8c1,#idiv2r9c1,#idiv2r10c1,#idiv2r11c1,#idiv2r12c1,#idiv2r13c1,#idiv2r14c1,#idiv2r15c1,#idiv2r16c1,#idiv2r17c1,#idiv2r18c1,#idiv2r19c1,#idiv2r20c1,#idiv2r21c1,#idiv2r22c1,#idiv2r23c1,#idiv2r24c1,#idiv2r25c1,#idiv2r26c1,#idiv2r27c1,#idiv2r28c1,#idiv2r29c1,#idiv2r30c1,#idiv2r31c1,#idiv2r32c1,#idiv2r33c1,#idiv2r34c1,#idiv2r1c2,#idiv2r2c2,#idiv2r3c2,#idiv2r4c2,#idiv2r5c2,#idiv2r6c2,#idiv2r7c2,#idiv2r8c2,#idiv2r9c2,#idiv2r10c2,#idiv2r11c2,#idiv2r12c2,#idiv2r13c2,#idiv2r14c2,#idiv2r15c2,#idiv2r16c2,#idiv2r17c2,#idiv2r18c2,#idiv2r19c2,#idiv2r20c2,#idiv2r21c2,#idiv2r22c2,#idiv2r23c2,#idiv2r24c2,#idiv2r25c2,#idiv2r26c2,#idiv2r27c2,#idiv2r28c2,#idiv2r29c2,#idiv2r30c2,#idiv2r31c2,#idiv2r32c2,#idiv2r33c2,#idiv2r34c2").blur(function(){
					$(this).val(parseInt($(this).val()));
				});
			});
			
			$(function() {
				$("#idiv4r1c1,#idiv4r2c1,#idiv4r3c1,#idiv4r4c1,#idiv4r5c1,#idiv4r6c1,#idiv4r7c1,#idiv4r8c1,#idiv4r9c1,#idiv4r10c1,#idiv4r11c1,#idiv4r1c2,#idiv4r2c2,#idiv4r3c2,#idiv4r4c2,#idiv4r5c2,#idiv4r6c2,#idiv4r7c2,#idiv4r8c2,#idiv4r9c2,#idiv4r10c2,#idiv4r11c2,#idiv4r1c3,#idiv4r2c3,#idiv4r3c3,#idiv4r4c3,#idiv4r5c3,#idiv4r6c3,#idiv4r7c3,#idiv4r8c3,#idiv4r9c3,#idiv4r10c3,#idiv4r11c3,#idiv5r1c2,#idiv5r1c3").keyup(function(){
					if ($(this).val() != "")
						$(this).val( $(this).val().replace(/[^0-9]/g, '') );
				});
			});

			$(function() {
				$("#idiv4r1c1,#idiv4r2c1,#idiv4r3c1,#idiv4r4c1,#idiv4r5c1,#idiv4r6c1,#idiv4r7c1,#idiv4r8c1,#idiv4r9c1,#idiv4r10c1,#idiv4r11c1,#idiv4r1c2,#idiv4r2c2,#idiv4r3c2,#idiv4r4c2,#idiv4r5c2,#idiv4r6c2,#idiv4r7c2,#idiv4r8c2,#idiv4r9c2,#idiv4r10c2,#idiv4r11c2,#idiv4r1c3,#idiv4r2c3,#idiv4r3c3,#idiv4r4c3,#idiv4r5c3,#idiv4r6c3,#idiv4r7c3,#idiv4r8c3,#idiv4r9c3,#idiv4r10c3,#idiv4r11c3,#idiv5r1c2,#idiv5r1c3").blur(function(){
					$(this).val(parseInt($(this).val()));
				});
			});
			
			$(function() {
				$("#idiv6r1c1,#idiv6r2c1,#idiv6r3c1,#idiv6r4c1,#idiv6r5c1,#idiv6r6c1,#idiv6r7c1,#idiv6r8c1,#idiv6r1c2,#idiv6r2c2,#idiv6r3c2,#idiv6r4c2,#idiv6r5c2,#idiv6r6c2,#idiv6r7c2,#idiv6r8c2,#idiv6r1c3,#idiv6r2c3,#idiv6r3c3,#idiv6r4c3,#idiv6r5c3,#idiv6r6c3,#idiv6r7c3,#idiv6r8c3,#idiv7r1c1,#idiv7r2c1,#idiv7r3c1,#idiv7r4c1,#idiv7r5c1,#idiv7r1c2,#idiv7r2c2,#idiv7r3c2,#idiv7r4c2,#idiv7r5c2").keyup(function(){
					if ($(this).val() != "")
						$(this).val( $(this).val().replace(/[^0-9]/g, '') );
				});
			});

			$(function() {
				$("#idiv6r1c1,#idiv6r2c1,#idiv6r3c1,#idiv6r4c1,#idiv6r5c1,#idiv6r6c1,#idiv6r7c1,#idiv6r8c1,#idiv6r1c2,#idiv6r2c2,#idiv6r3c2,#idiv6r4c2,#idiv6r5c2,#idiv6r6c2,#idiv6r7c2,#idiv6r8c2,#idiv6r1c3,#idiv6r2c3,#idiv6r3c3,#idiv6r4c3,#idiv6r5c3,#idiv6r6c3,#idiv6r7c3,#idiv6r8c3,#idiv7r1c1,#idiv7r2c1,#idiv7r3c1,#idiv7r4c1,#idiv7r5c1,#idiv7r1c2,#idiv7r2c2,#idiv7r3c2,#idiv7r4c2,#idiv7r5c2").blur(function(){
					$(this).val(parseInt($(this).val()));
				});
			});
		
			$(function() {
				$("#idiv1r11c3, #idiv1r11c4").blur(function() {
					if(this.id == "idiv1r11c3" && $(this).val() == 0) {
						$("#idiv2r1c1,#idiv2r2c1,#idiv2r3c1,#idiv2r4c1,#idiv2r5c1,#idiv2r6c1,#idiv2r7c1,#idiv2r8c1,#idiv2r9c1,#idiv2r10c1,#idiv2r11c1,#idiv2r12c1,#idiv2r13c1,#idiv2r14c1,#idiv2r15c1,#idiv2r16c1,#idiv2r17c1,#idiv2r18c1,#idiv2r19c1,#idiv2r20c1,#idiv2r21c1,#idiv2r22c1,#idiv2r23c1,#idiv2r24c1,#idiv2r25c1,#idiv2r26c1,#idiv2r27c1,#idiv2r28c1,#idiv2r29c1,#idiv2r30c1,#idiv2r31c1,#idiv2r32c1,#idiv2r33c1,#idiv2r34c1").attr('disabled', 'disabled');
						$("#idiv2r1c1,#idiv2r2c1,#idiv2r3c1,#idiv2r4c1,#idiv2r5c1,#idiv2r6c1,#idiv2r7c1,#idiv2r8c1,#idiv2r9c1,#idiv2r10c1,#idiv2r11c1,#idiv2r12c1,#idiv2r13c1,#idiv2r14c1,#idiv2r15c1,#idiv2r16c1,#idiv2r17c1,#idiv2r18c1,#idiv2r19c1,#idiv2r20c1,#idiv2r21c1,#idiv2r22c1,#idiv2r23c1,#idiv2r24c1,#idiv2r25c1,#idiv2r26c1,#idiv2r27c1,#idiv2r28c1,#idiv2r29c1,#idiv2r30c1,#idiv2r31c1,#idiv2r32c1,#idiv2r33c1,#idiv2r34c1").val("0");
					}
					if(this.id == "idiv1r11c4" && $(this).val() == 0) {
						$("#idiv2r1c2,#idiv2r2c2,#idiv2r3c2,#idiv2r4c2,#idiv2r5c2,#idiv2r6c2,#idiv2r7c2,#idiv2r8c2,#idiv2r9c2,#idiv2r10c2,#idiv2r11c2,#idiv2r12c2,#idiv2r13c2,#idiv2r14c2,#idiv2r15c2,#idiv2r16c2,#idiv2r17c2,#idiv2r18c2,#idiv2r19c2,#idiv2r20c2,#idiv2r21c2,#idiv2r22c2,#idiv2r23c2,#idiv2r24c2,#idiv2r25c2,#idiv2r26c2,#idiv2r27c2,#idiv2r28c2,#idiv2r29c2,#idiv2r30c2,#idiv2r31c2,#idiv2r32c2,#idiv2r33c2,#idiv2r34c2").attr('disabled', 'disabled');
						$("#idiv2r1c2,#idiv2r2c2,#idiv2r3c2,#idiv2r4c2,#idiv2r5c2,#idiv2r6c2,#idiv2r7c2,#idiv2r8c2,#idiv2r9c2,#idiv2r10c2,#idiv2r11c2,#idiv2r12c2,#idiv2r13c2,#idiv2r14c2,#idiv2r15c2,#idiv2r16c2,#idiv2r17c2,#idiv2r18c2,#idiv2r19c2,#idiv2r20c2,#idiv2r21c2,#idiv2r22c2,#idiv2r23c2,#idiv2r24c2,#idiv2r25c2,#idiv2r26c2,#idiv2r27c2,#idiv2r28c2,#idiv2r29c2,#idiv2r30c2,#idiv2r31c2,#idiv2r32c2,#idiv2r33c2,#idiv2r34c2").val("0");
					}
				});
			});

			$(function() {
				$("#idiv1r11c3, #idiv1r11c4").blur(function() {
					if(this.id == "idiv1r11c3" && $(this).val() > 0) {
						$("#idiv2r1c1,#idiv2r2c1,#idiv2r3c1,#idiv2r4c1,#idiv2r5c1,#idiv2r6c1,#idiv2r7c1,#idiv2r8c1,#idiv2r9c1,#idiv2r10c1,#idiv2r11c1,#idiv2r12c1,#idiv2r13c1,#idiv2r14c1,#idiv2r15c1,#idiv2r16c1,#idiv2r17c1,#idiv2r18c1,#idiv2r19c1,#idiv2r20c1,#idiv2r21c1,#idiv2r22c1,#idiv2r23c1,#idiv2r24c1,#idiv2r25c1,#idiv2r26c1,#idiv2r27c1,#idiv2r28c1,#idiv2r29c1,#idiv2r30c1,#idiv2r31c1,#idiv2r32c1,#idiv2r33c1,#idiv2r34c1").removeAttr('disabled');
					}
					if(this.id == "idiv1r11c4" && $(this).val() > 0) {
						$("#idiv2r1c2,#idiv2r2c2,#idiv2r3c2,#idiv2r4c2,#idiv2r5c2,#idiv2r6c2,#idiv2r7c2,#idiv2r8c2,#idiv2r9c2,#idiv2r10c2,#idiv2r11c2,#idiv2r12c2,#idiv2r13c2,#idiv2r14c2,#idiv2r15c2,#idiv2r16c2,#idiv2r17c2,#idiv2r18c2,#idiv2r19c2,#idiv2r20c2,#idiv2r21c2,#idiv2r22c2,#idiv2r23c2,#idiv2r24c2,#idiv2r25c2,#idiv2r26c2,#idiv2r27c2,#idiv2r28c2,#idiv2r29c2,#idiv2r30c2,#idiv2r31c2,#idiv2r32c2,#idiv2r33c2,#idiv2r34c2").removeAttr('disabled');
					}
				});
			});

			$(function() {
				$("#idiv1r11c4").blur(function() {
					if($(this).val() > 0) {
						$("#idiv4r1c1,#idiv4r1c2,#idiv4r1c3,#idiv4r2c1,#idiv4r2c2,#idiv4r2c3,#idiv4r3c1,#idiv4r3c2,#idiv4r3c3,#idiv4r4c1,#idiv4r4c2,#idiv4r4c3,#idiv4r5c1,#idiv4r5c2,#idiv4r5c3,#idiv4r6c1,#idiv4r6c2,#idiv4r6c3,#idiv4r7c1,#idiv4r7c2,#idiv4r7c3,#idiv4r8c1,#idiv4r8c2,#idiv4r8c3,#idiv4r9c1,#idiv4r9c2,#idiv4r9c3,#idiv4r10c1,#idiv4r10c2,#idiv4r10c3,#idiv4r11c1,#idiv4r11c2,#idiv4r11c3").removeAttr('disabled');
					}
					if($(this).val() == 0) {
						$("#idiv4r1c1,#idiv4r1c2,#idiv4r1c3,#idiv4r2c1,#idiv4r2c2,#idiv4r2c3,#idiv4r3c1,#idiv4r3c2,#idiv4r3c3,#idiv4r4c1,#idiv4r4c2,#idiv4r4c3,#idiv4r5c1,#idiv4r5c2,#idiv4r5c3,#idiv4r6c1,#idiv4r6c2,#idiv4r6c3,#idiv4r7c1,#idiv4r7c2,#idiv4r7c3,#idiv4r8c1,#idiv4r8c2,#idiv4r8c3,#idiv4r9c1,#idiv4r9c2,#idiv4r9c3,#idiv4r10c1,#idiv4r10c2,#idiv4r10c3,#idiv4r11c1,#idiv4r11c2,#idiv4r11c3").attr('disabled', 'disabled');
						$("#idiv4r1c1,#idiv4r1c2,#idiv4r1c3,#idiv4r2c1,#idiv4r2c2,#idiv4r2c3,#idiv4r3c1,#idiv4r3c2,#idiv4r3c3,#idiv4r4c1,#idiv4r4c2,#idiv4r4c3,#idiv4r5c1,#idiv4r5c2,#idiv4r5c3,#idiv4r6c1,#idiv4r6c2,#idiv4r6c3,#idiv4r7c1,#idiv4r7c2,#idiv4r7c3,#idiv4r8c1,#idiv4r8c2,#idiv4r8c3,#idiv4r9c1,#idiv4r9c2,#idiv4r9c3,#idiv4r10c1,#idiv4r10c2,#idiv4r10c3,#idiv4r11c1,#idiv4r11c2,#idiv4r11c3").val("0");
					}
				});
			});

			$(function() {
				$("#idiv5r1c1,#idiv5r1c12").click(function() {
					if(this.id == "idiv5r1c1") {
						$("#idiv5r1c2,#idiv5r1c3").removeAttr('disabled');
					}
					if(this.id == "idiv5r1c12") {
						$("#idiv5r1c2,#idiv5r1c3").val('');
						$("#idiv5r1c2,#idiv5r1c3").attr('disabled', 'disabled');
					}
				});
			});

			$(function() {
				$("#idiv1r1c4,#idiv1r2c4,#idiv1r3c4,#idiv1r4c4,#idiv1r5c4,#idiv1r6c4").blur(function() {
					if($("#idiv1r1c4").val()+$("#idiv1r2c4").val()+$("#idiv1r3c4").val()+$("#idiv1r4c4").val()+$("#idiv1r5c4").val()+$("#idiv1r6c4").val()>0) {
						$("#idiv6r1c1,#idiv6r1c2,#idiv6r1c3,#idiv6r2c1,#idiv6r2c2,#idiv6r2c3,#idiv6r3c1,#idiv6r3c2,#idiv6r3c3,#idiv6r4c1,#idiv6r4c2,#idiv6r4c3,#idiv6r5c1,#idiv6r5c2,#idiv6r5c3,#idiv6r6c1,#idiv6r6c2,#idiv6r6c3,#idiv6r7c1,#idiv6r7c2,#idiv6r7c3,#idiv6r8c1,#idiv6r8c2,#idiv6r8c3").removeAttr('disabled');
					}
					if($("#idiv1r1c4").val()+$("#idiv1r2c4").val()+$("#idiv1r3c4").val()+$("#idiv1r4c4").val()+$("#idiv1r5c4").val()+$("#idiv1r6c4").val()==0) {
						$("#idiv6r1c1,#idiv6r1c2,#idiv6r1c3,#idiv6r2c1,#idiv6r2c2,#idiv6r2c3,#idiv6r3c1,#idiv6r3c2,#idiv6r3c3,#idiv6r4c1,#idiv6r4c2,#idiv6r4c3,#idiv6r5c1,#idiv6r5c2,#idiv6r5c3,#idiv6r6c1,#idiv6r6c2,#idiv6r6c3,#idiv6r7c1,#idiv6r7c2,#idiv6r7c3,#idiv6r8c1,#idiv6r8c2,#idiv6r8c3").attr('disabled', 'disabled');
						$("#idiv6r1c1,#idiv6r1c2,#idiv6r1c3,#idiv6r2c1,#idiv6r2c2,#idiv6r2c3,#idiv6r3c1,#idiv6r3c2,#idiv6r3c3,#idiv6r4c1,#idiv6r4c2,#idiv6r4c3,#idiv6r5c1,#idiv6r5c2,#idiv6r5c3,#idiv6r6c1,#idiv6r6c2,#idiv6r6c3,#idiv6r7c1,#idiv6r7c2,#idiv6r7c3,#idiv6r8c1,#idiv6r8c2,#idiv6r8c3").val("0");
					}
				});
			});
			//TOTAL NUM 1 COLUMNA 1
			$(function() {
				$("#idiv1r11c1").blur(function() {
					if(parseInt($("#idiv1r1c1").val())+parseInt($("#idiv1r2c1").val())+parseInt($("#idiv1r3c1").val())+parseInt($("#idiv1r4c1").val())+parseInt($("#idiv1r5c1").val())+parseInt($("#idiv1r6c1").val())+parseInt($("#idiv1r7c1").val())+parseInt($("#idiv1r8c1").val())+parseInt($("#idiv1r9c1").val())+parseInt($("#idiv1r10c1").val())!=parseInt($("#idiv1r11c1").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 1 COLUMNA 2
			$(function() {
				$("#idiv1r11c2").blur(function() {
					if(parseInt($("#idiv1r1c2").val())+parseInt($("#idiv1r2c2").val())+parseInt($("#idiv1r3c2").val())+parseInt($("#idiv1r4c2").val())+parseInt($("#idiv1r5c2").val())+parseInt($("#idiv1r6c2").val())+parseInt($("#idiv1r7c2").val())+parseInt($("#idiv1r8c2").val())+parseInt($("#idiv1r9c2").val())+parseInt($("#idiv1r10c2").val())!=parseInt($("#idiv1r11c2").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 1 COLUMNA 3
			$(function() {
				$("#idiv1r11c3").blur(function() {
					if(parseInt($("#idiv1r1c3").val())+parseInt($("#idiv1r2c3").val())+parseInt($("#idiv1r3c3").val())+parseInt($("#idiv1r4c3").val())+parseInt($("#idiv1r5c3").val())+parseInt($("#idiv1r6c3").val())+parseInt($("#idiv1r7c3").val())+parseInt($("#idiv1r8c3").val())+parseInt($("#idiv1r9c3").val())+parseInt($("#idiv1r10c3").val())!=parseInt($("#idiv1r11c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 1 COLUMNA 4
			$(function() {
				$("#idiv1r11c4").blur(function() {
					if(parseInt($("#idiv1r1c4").val())+parseInt($("#idiv1r2c4").val())+parseInt($("#idiv1r3c4").val())+parseInt($("#idiv1r4c4").val())+parseInt($("#idiv1r5c4").val())+parseInt($("#idiv1r6c4").val())+parseInt($("#idiv1r7c4").val())+parseInt($("#idiv1r8c4").val())+parseInt($("#idiv1r9c4").val())+parseInt($("#idiv1r10c4").val())!=parseInt($("#idiv1r11c4").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 2 COLUMNA 1
			$(function() {
				$("#idiv2r34c1").blur(function() {
					if(parseInt($("#idiv2r1c1").val())+parseInt($("#idiv2r2c1").val())+parseInt($("#idiv2r3c1").val())+parseInt($("#idiv2r4c1").val())+parseInt($("#idiv2r5c1").val())+parseInt($("#idiv2r6c1").val())+parseInt($("#idiv2r7c1").val())+parseInt($("#idiv2r8c1").val())+parseInt($("#idiv2r9c1").val())+parseInt($("#idiv2r10c1").val())+parseInt($("#idiv2r11c1").val())+parseInt($("#idiv2r12c1").val())+parseInt($("#idiv2r13c1").val())+parseInt($("#idiv2r14c1").val())+parseInt($("#idiv2r15c1").val())+parseInt($("#idiv2r16c1").val())+parseInt($("#idiv2r17c1").val())+parseInt($("#idiv2r18c1").val())+parseInt($("#idiv2r19c1").val())+parseInt($("#idiv2r20c1").val())+parseInt($("#idiv2r21c1").val())+parseInt($("#idiv2r22c1").val())+parseInt($("#idiv2r23c1").val())+parseInt($("#idiv2r24c1").val())+parseInt($("#idiv2r25c1").val())+parseInt($("#idiv2r26c1").val())+parseInt($("#idiv2r27c1").val())+parseInt($("#idiv2r28c1").val())+parseInt($("#idiv2r29c1").val())+parseInt($("#idiv2r30c1").val())+parseInt($("#idiv2r31c1").val())+parseInt($("#idiv2r32c1").val())+parseInt($("#idiv2r33c1").val())!=parseInt($("#idiv2r34c1").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 2 COLUMNA 2
			$(function() {
				$("#idiv2r34c2").blur(function() {
					if(parseInt($("#idiv2r1c2").val())+parseInt($("#idiv2r2c2").val())+parseInt($("#idiv2r3c2").val())+parseInt($("#idiv2r4c2").val())+parseInt($("#idiv2r5c2").val())+parseInt($("#idiv2r6c2").val())+parseInt($("#idiv2r7c2").val())+parseInt($("#idiv2r8c2").val())+parseInt($("#idiv2r9c2").val())+parseInt($("#idiv2r10c2").val())+parseInt($("#idiv2r11c2").val())+parseInt($("#idiv2r12c2").val())+parseInt($("#idiv2r13c2").val())+parseInt($("#idiv2r14c2").val())+parseInt($("#idiv2r15c2").val())+parseInt($("#idiv2r16c2").val())+parseInt($("#idiv2r17c2").val())+parseInt($("#idiv2r18c2").val())+parseInt($("#idiv2r19c2").val())+parseInt($("#idiv2r20c2").val())+parseInt($("#idiv2r21c2").val())+parseInt($("#idiv2r22c2").val())+parseInt($("#idiv2r23c2").val())+parseInt($("#idiv2r24c2").val())+parseInt($("#idiv2r25c2").val())+parseInt($("#idiv2r26c2").val())+parseInt($("#idiv2r27c2").val())+parseInt($("#idiv2r28c2").val())+parseInt($("#idiv2r29c2").val())+parseInt($("#idiv2r30c2").val())+parseInt($("#idiv2r31c2").val())+parseInt($("#idiv2r32c2").val())+parseInt($("#idiv2r33c2").val())!=parseInt($("#idiv2r34c2").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 COLUMNA 1
			$(function() {
				$("#idiv4r11c1").blur(function() {
					if(parseInt($("#idiv4r1c1").val())+parseInt($("#idiv4r2c1").val())+parseInt($("#idiv4r3c1").val())+parseInt($("#idiv4r4c1").val())+parseInt($("#idiv4r5c1").val())+parseInt($("#idiv4r6c1").val())!=parseInt($("#idiv4r11c1").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 COLUMNA 2
			$(function() {
				$("#idiv4r11c2").blur(function() {
					if(parseInt($("#idiv4r1c2").val())+parseInt($("#idiv4r2c2").val())+parseInt($("#idiv4r3c2").val())+parseInt($("#idiv4r4c2").val())+parseInt($("#idiv4r5c2").val())+parseInt($("#idiv4r6c2").val())!=parseInt($("#idiv4r11c2").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 1
			$(function() {
				$("#idiv4r1c3").blur(function() {
					if(parseInt($("#idiv4r1c1").val())+parseInt($("#idiv4r1c2").val())!=parseInt($("#idiv4r1c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 2
			$(function() {
				$("#idiv4r2c3").blur(function() {
					if(parseInt($("#idiv4r2c1").val())+parseInt($("#idiv4r2c2").val())!=parseInt($("#idiv4r2c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 3
			$(function() {
				$("#idiv4r3c3").blur(function() {
					if(parseInt($("#idiv4r3c1").val())+parseInt($("#idiv4r3c2").val())!=parseInt($("#idiv4r3c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 4
			$(function() {
				$("#idiv4r4c3").blur(function() {
					if(parseInt($("#idiv4r4c1").val())+parseInt($("#idiv4r4c2").val())!=parseInt($("#idiv4r4c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 5
			$(function() {
				$("#idiv4r5c3").blur(function() {
					if(parseInt($("#idiv4r5c1").val())+parseInt($("#idiv4r5c2").val())!=parseInt($("#idiv4r5c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 6
			$(function() {
				$("#idiv4r6c3").blur(function() {
					if(parseInt($("#idiv4r6c1").val())+parseInt($("#idiv4r6c2").val())!=parseInt($("#idiv4r6c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 7
			$(function() {
				$("#idiv4r7c3").blur(function() {
					var valor1 = parseInt($("#idiv4r7c1").val()) || 0;
					var valor2 = parseInt($("#idiv4r7c2").val()) || 0;
					if(valor1+valor2!=parseInt($("#idiv4r7c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 8
			$(function() {
				$("#idiv4r8c3").blur(function() {
					var valor1 = parseInt($("#idiv4r8c1").val()) || 0;
					var valor2 = parseInt($("#idiv4r8c2").val()) || 0;
					if(valor1+valor2!=parseInt($("#idiv4r8c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 9
			$(function() {
				$("#idiv4r9c3").blur(function() {
					var valor1 = parseInt($("#idiv4r9c1").val()) || 0;
					var valor2 = parseInt($("#idiv4r9c2").val()) || 0;
					if(valor1+valor2!=parseInt($("#idiv4r9c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 10
			$(function() {
				$("#idiv4r10c3").blur(function() {
					var valor1 = parseInt($("#idiv4r10c1").val()) || 0;
					var valor2 = parseInt($("#idiv4r10c2").val()) || 0;
					if(valor1+valor2!=parseInt($("#idiv4r10c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 4 RENGLON 11
			$(function() {
				$("#idiv4r11c3").blur(function() {
					if(parseInt($("#idiv4r11c1").val())+parseInt($("#idiv4r11c2").val())!=parseInt($("#idiv4r11c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 6 COLUMNA 1
			$(function() {
				$("#idiv6r8c1").blur(function() {
					if(parseInt($("#idiv6r1c1").val())+parseInt($("#idiv6r2c1").val())+parseInt($("#idiv6r3c1").val())+parseInt($("#idiv6r4c1").val())+parseInt($("#idiv6r5c1").val())+parseInt($("#idiv6r6c1").val())+parseInt($("#idiv6r7c1").val())!=parseInt($("#idiv6r8c1").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 6 COLUMNA 2
			$(function() {
				$("#idiv6r8c2").blur(function() {
					if(parseInt($("#idiv6r1c2").val())+parseInt($("#idiv6r2c2").val())+parseInt($("#idiv6r3c2").val())+parseInt($("#idiv6r4c2").val())+parseInt($("#idiv6r5c2").val())+parseInt($("#idiv6r6c2").val())+parseInt($("#idiv6r7c2").val())!=parseInt($("#idiv6r8c2").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 6 RENGLON 1
			$(function() {
				$("#idiv6r1c3").blur(function() {
					if(parseInt($("#idiv6r1c1").val())+parseInt($("#idiv6r1c2").val())!=parseInt($("#idiv6r1c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 6 RENGLON 2
			$(function() {
				$("#idiv6r2c3").blur(function() {
					if(parseInt($("#idiv6r2c1").val())+parseInt($("#idiv6r2c2").val())!=parseInt($("#idiv6r2c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 6 RENGLON 3
			$(function() {
				$("#idiv6r3c3").blur(function() {
					if(parseInt($("#idiv6r3c1").val())+parseInt($("#idiv6r3c2").val())!=parseInt($("#idiv6r3c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 6 RENGLON 4
			$(function() {
				$("#idiv6r4c3").blur(function() {
					if(parseInt($("#idiv6r4c1").val())+parseInt($("#idiv6r4c2").val())!=parseInt($("#idiv6r4c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 6 RENGLON 5
			$(function() {
				$("#idiv6r5c3").blur(function() {
					if(parseInt($("#idiv6r5c1").val())+parseInt($("#idiv6r5c2").val())!=parseInt($("#idiv6r5c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 6 RENGLON 6
			$(function() {
				$("#idiv6r6c3").blur(function() {
					if(parseInt($("#idiv6r6c1").val())+parseInt($("#idiv6r6c2").val())!=parseInt($("#idiv6r6c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 6 RENGLON 7
			$(function() {
				$("#idiv6r7c3").blur(function() {
					if(parseInt($("#idiv6r7c1").val())+parseInt($("#idiv6r7c2").val())!=parseInt($("#idiv6r7c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 6 RENGLON 8
			$(function() {
				$("#idiv6r8c3").blur(function() {
					if(parseInt($("#idiv6r8c1").val())+parseInt($("#idiv6r8c2").val())!=parseInt($("#idiv6r8c3").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 7 COLUMNA 1
			$(function() {
				$("#idiv7r5c1").blur(function() {
					if(parseInt($("#idiv7r5c1").val()) == 0) {
						alert("TOTAL DEBE SER MAYOR QUE CERO");
					}
					if(parseInt($("#idiv7r1c1").val())+parseInt($("#idiv7r2c1").val())+parseInt($("#idiv7r3c1").val())+parseInt($("#idiv7r4c1").val())!=parseInt($("#idiv7r5c1").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});
			//TOTAL NUM 7 COLUMNA 2
			$(function() {
				$("#idiv7r5c2").blur(function() {
					if(parseInt($("#idiv7r5c2").val()) == 0) {
						alert("TOTAL DEBE SER MAYOR QUE CERO");
					}
					if(parseInt($("#idiv7r1c2").val())+parseInt($("#idiv7r2c2").val())+parseInt($("#idiv7r3c2").val())+parseInt($("#idiv7r4c2").val())!=parseInt($("#idiv7r5c2").val())) {
						alert("TOTAL DIGITADO INVALIDO");
					}
				});
			});

			$(function() {
				$("#idiv4r6c1").blur(function() {
					if ($(this).val()>0) {
						$("#idiv4r7c1,#idiv4r8c1,#idiv4r9c1,#idiv4r10c1").prop("disabled", false);
					}
					else {
						$("#idiv4r7c1,#idiv4r8c1,#idiv4r9c1,#idiv4r10c1").prop("disabled", true);
					}
				})
			});

			$(function() {
				$("#idiv4r6c2").blur(function() {
					if ($(this).val()>0) {
						$("#idiv4r7c2,#idiv4r8c2,#idiv4r9c2,#idiv4r10c2").prop("disabled", false);
					}
					else {
						$("#idiv4r7c2,#idiv4r8c2,#idiv4r9c2,#idiv4r10c2").prop("disabled", true);
					}
				})
			});

			$(function() {
				$("#idiv4r6c3").blur(function() {
					if ($(this).val()>0) {
						$("#idiv4r7c3,#idiv4r8c3,#idiv4r9c3,#idiv4r10c3").prop("disabled", false);
					}
					else {
						$("#idiv4r7c3,#idiv4r8c3,#idiv4r9c3,#idiv4r10c3").prop("disabled", true);
					}
				})
			});
			
			$(function() {
				$("#idiv2r34c1").blur(function() {
					if ($(this).val() != $("#idiv1r11c3").val()) {
						alert("Total debe ser igual que total numeral 1 columna 3")
					}
				});
			});
			
			$(function() {
				$("#idiv2r34c2").blur(function() {
					if ($(this).val() != $("#idiv1r11c4").val()) {
						alert("Total debe ser igual que total numeral 1 columna 4")
					}
				});
			});
			
			$(function() {
				$("#idiv3r1c1").blur(function() {
					if(parseInt($(this).val().length) < 1){
						alert("Este campo es obligatorio, si no tiene valores, digite 0.");
						return false;
					}
							
					if (parseInt($(this).val()) > parseInt($("#idiv1r11c1").val())) {
						alert("Valor debe ser menor o igual que total numeral 1 columna 1");
						return false;
					}
					return false; 
				});
			});

			$(function() {
				$("#idiv3r1c2").blur(function() {
					if(parseInt($(this).val().length) < 1){
						alert("Este campo es obligatorio, si no tiene valores, digite 0.");
						return false;
					}	
					if (parseInt($(this).val()) > parseInt($("#idiv1r11c2").val())) {
						alert("Valor debe ser menor o igual que total numeral 1 columna 2")
						return false;
					}
					return false; 
				});
			});
			
			$(function() {
				$("#idiv6r8c3").blur(function() {
					if ($(this).val() != parseInt($("#idiv1r1c4").val())+parseInt($("#idiv1r2c4").val())+parseInt($("#idiv1r3c4").val())+parseInt($("#idiv1r4c4").val())+parseInt($("#idiv1r5c4").val())+parseInt($("#idiv1r6c4").val())) {
						alert("Total debe ser igual que suma numeral 1 columna 4 renglones 1 a 6");
					}
				});
			});
			
			$(function() {
				$("#idiv4r11c3").blur(function() {
					if ($(this).val() != $("#idiv1r11c4").val()) {
						alert("Total debe ser igual a total numeral 1 columna 4");
					}
					var noactivo = $("#idiv4r7c1").is(":disabled");
					if (!noactivo) {
						if(parseInt($("#idiv4r6c1").val())!=0){
							if (parseInt($("#idiv4r6c1").val()) != parseInt($("#idiv4r7c1").val())+parseInt($("#idiv4r8c1").val())+parseInt($("#idiv4r9c1").val())+parseInt($("#idiv4r10c1").val())) {
								alert("NUMERAL 4: Total reng. 6 col. 1 = 6.1+6.2+6.3+6.4 INVALIDO");
							}
                      	}
					}
					var noactivo = $("#idiv4r7c2").is(":disabled");
					if (!noactivo) {
							if(parseInt($("#idiv4r6c2").val())!=0){
								if (parseInt($("#idiv4r6c2").val()) != parseInt($("#idiv4r7c2").val())+parseInt($("#idiv4r8c2").val())+parseInt($("#idiv4r9c2").val())+parseInt($("#idiv4r10c2").val())) {
									alert("NUMERAL 4: Total reng. 6 col. 2 = 6.1+6.2+6.3+6.4 INVALIDO");
								}
							}
					}
				});
			});
			
			$(document).ready(function(){
    			$('[data-toggle="tooltip"]').tooltip();   
			});
			
			$(window).on('hidden.bs.modal', function() {
				$.ajax({
					url: "../persistencia/grabactl.php",
	                type: "POST",
	                data: {obser: "obs", numero: $("#numero").val(), capit: "4", observa: $("#obscrit").val()},
	                success: function(dato) {
					}
				});
			});
			
			$(function() {
				$("#wc4").affix({
					offset: {top: 10}
				});
			});
			
			$(document).ready(function(){
				$('[data-toggle="popover"]').popover();
			});
		</script>
	</head>
	<body>
		<?php
			include 'menuFuente.php';
/*			
			if ($tipousu != "FU") {
				echo "<script type='text/javascript'>";
				echo "$(function() {";
				echo "$(window).load(function(){";
			    echo "$('#avisoCrit').modal('show');";
			    echo "});});";
			    echo "</script>";
			}
*/			
		?>
		<div class="well well-sm" style="font-size: 12px; padding-top: 60px; z-index: 1;" id="wc4">
 				<?php echo $numero . "-" . $nombre?> - CAP&Iacute;TULO IV - PERSONAL OCUPADO PROMEDIO EN RELACI&Oacute;N CON ACTI DURANTE LOS A&Ntilde;OS <?php echo $anterior . "-" . $vig . " . " . $txtEstado ?>
 		</div>
 		<div class="container text-justify" style="font-size: 12px">
			<p>El personal ocupado promedio en el a&ntilde;o por la empresa corresponde al que ejerce su fuerza laboral independientemente del tipo
				de contrataci&oacute;n ya sean propietarios, permanentes, temporal contratado directamente o a trav&eacute;s de agencias,
				personal aprendiz o pasantes en etapa pr&aacute;ctica o personal por prestaci&oacute;n de servicios, con excepci&oacute;n de los
				consultores externos contratados para la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n.</p>
			<p>El personal que participa en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, corresponde al que
				desarrolla, ya sea en dedicaci&oacute;n permanente o parcial, actividades dentro de la empresa dirigidas a la producci&oacute;n,
				promoci&oacute;n, difusi&oacute;n y aplicaci&oacute;n de conocimientos cient&iacute;ficos y t&eacute;cnicos; y al desarrollo
				o introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados, de procesos nuevos o significativamente
				mejorados, de m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de comercializaci&oacute;n nuevas.</p> 
		</div>
		<div class="container text-justify" style="font-size: 12px">
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas del &aacute;rea de recursos humanos y con acceso a
 				informaci&oacute;n de los empleados de la empresa. 
 		</div>

		<input type="hidden" name="tipousu" id="idTipo" value="<?php echo $tipousu ?>" />
		<form class='form-horizontal' role='form' data-toggle='validator' name="capitulo4" id="capitulo4" method="post">
			<div class='container'>
				<input type="hidden" name="C4_nordemp" id="numero" value="<?php echo $numero ?>" />
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iv1&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> IV.1 Indique el personal ocupado promedio que labor&oacute; en su empresa en los a&ntilde;os
						<?php echo $anterior . '-' . $vig?>. De &eacute;ste, especifique el n&uacute;mero que particip&oacute; en la realizaci&oacute;n de actividades
						cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en los a&ntilde;os <?php echo $anterior . '-' . $vig?>, de acuerdo con
						el m&aacute;ximo nivel educativo alcanzado y con t&iacute;tulo obtenido.</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 text-center'><b>M&aacute;ximo nivel educativo alcanzado</b></div>
						<div class='col-sm-2 text-center'>Personal ocupado promedio (tiempo completo, permanente y temporal)</div>
						<div class='col-sm-2 text-center'>Personal ocupado promedio que particip&oacute; en la realizaci&oacute;n de actividades
							cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n						
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6'>&nbsp;</div>
						<div class='col-sm-1 text-right'><b><?php echo $anterior?></b></div>
						<div class='col-sm-1 text-right'><b><?php echo $vig?></b></div>
						<div class='col-sm-1 text-right'><b><?php echo $anterior?></b></div>
						<div class='col-sm-1 text-right'><b><?php echo $vig?></b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn11">
							<b>1. </b>Doctorado
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r1c1' name='iv1r1c1' value = "<?php echo $row['IV1R1C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r1c2' name='iv1r1c2' value = "<?php echo $row['IV1R1C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r1c3' onBlur="valida12(this.id, 'idiv1r1c1', 'COLUMNA1');" name='iv1r1c3' value = "<?php echo $row['IV1R1C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r1c4' onBlur="valida12(this.id, 'idiv1r1c2', 'COLUMNA2');" name='iv1r1c4' value = "<?php echo $row['IV1R1C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn12">
							<b>2. </b>Maestr&iacute;a
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r2c1' name='iv1r2c1' value = "<?php echo $row['IV1R2C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r2c2' name='iv1r2c2' value = "<?php echo $row['IV1R2C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r2c3' onBlur="valida12(this.id, 'idiv1r2c1', 'COLUMNA1');" name='iv1r2c3' value = "<?php echo $row['IV1R2C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r2c4' onBlur="valida12(this.id, 'idiv1r2c2', 'COLUMNA2');" name='iv1r2c4' value = "<?php echo $row['IV1R2C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn13">
							<b>3. </b>Especializaci&oacute;n
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r3c1' name='iv1r3c1' value = "<?php echo $row['IV1R3C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r3c2' name='iv1r3c2' value = "<?php echo $row['IV1R3C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r3c3' onBlur="valida12(this.id, 'idiv1r3c1', 'COLUMNA1');" name='iv1r3c3' value = "<?php echo $row['IV1R3C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r3c4' onBlur="valida12(this.id, 'idiv1r3c2', 'COLUMNA2');" name='iv1r3c4' value = "<?php echo $row['IV1R3C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn14">
							<b>4. </b>Universitario (Profesional)
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r4c1' name='iv1r4c1' value = "<?php echo $row['IV1R4C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r4c2' name='iv1r4c2' value = "<?php echo $row['IV1R4C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r4c3' onBlur="valida12(this.id, 'idiv1r4c1', 'COLUMNA1');" name='iv1r4c3' value = "<?php echo $row['IV1R4C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r4c4' onBlur="valida12(this.id, 'idiv1r4c2', 'COLUMNA2');" name='iv1r4c4' value = "<?php echo $row['IV1R4C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn15">
							<b>5. </b>Tecno&oacute;logo
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r5c1' name='iv1r5c1' value = "<?php echo $row['IV1R5C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r5c2' name='iv1r5c2' value = "<?php echo $row['IV1R5C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r5c3' onBlur="valida12(this.id, 'idiv1r5c1', 'COLUMNA1');" name='iv1r5c3' value = "<?php echo $row['IV1R5C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r5c4' onBlur="valida12(this.id, 'idiv1r5c2', 'COLUMNA2');" name='iv1r5c4' value = "<?php echo $row['IV1R5C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm' id="txtn16">
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>6. </b>T&eacute;cnico profesional
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r6c1' name='iv1r6c1' value = "<?php echo $row['IV1R6C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r6c2' name='iv1r6c2' value = "<?php echo $row['IV1R6C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r6c3' onBlur="valida12(this.id, 'idiv1r6c1', 'COLUMNA1');" name='iv1r6c3' value = "<?php echo $row['IV1R6C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r6c4' onBlur="valida12(this.id, 'idiv1r6c2', 'COLUMNA2');" name='iv1r6c4' value = "<?php echo $row['IV1R6C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn17">
							<b>7. </b>Educaci&oacute;n secundaria (Completa)
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r7c1' name='iv1r7c1' value = "<?php echo $row['IV1R7C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r7c2' name='iv1r7c2' value = "<?php echo $row['IV1R7C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r7c3' onBlur="valida12(this.id, 'idiv1r7c1', 'COLUMNA1');" name='iv1r7c3' value = "<?php echo $row['IV1R7C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r7c4' onBlur="valida12(this.id, 'idiv1r7c2', 'COLUMNA2');" name='iv1r7c4' value = "<?php echo $row['IV1R7C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn18">
							<b>8. </b>Educaci&oacute;n primaria
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r8c1' name='iv1r8c1' value = "<?php echo $row['IV1R8C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r8c2' name='iv1r8c2' value = "<?php echo $row['IV1R8C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r8c3' onBlur="valida12(this.id, 'idiv1r8c1', 'COLUMNA1');" name='iv1r8c3' value = "<?php echo $row['IV1R8C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r8c4' onBlur="valida12(this.id, 'idiv1r8c2', 'COLUMNA2');" name='iv1r8c4' value = "<?php echo $row['IV1R8C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn19">
							<b>9. </b>Formaci&oacute;n Profesional Integral - SENA
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r9c1' name='iv1r9c1' value = "<?php echo $row['IV1R9C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r9c2' name='iv1r9c2' value = "<?php echo $row['IV1R9C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r9c3' onBlur="valida12(this.id, 'idiv1r9c1', 'COLUMNA1');" name='iv1r9c3' value = "<?php echo $row['IV1R9C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r9c4' onBlur="valida12(this.id, 'idiv1r9c2', 'COLUMNA2');" name='iv1r9c4' value = "<?php echo $row['IV1R9C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn110">
							<b>10. </b>Ninguno
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r10c1' name='iv1r10c1' value = "<?php echo $row['IV1R10C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r10c2' name='iv1r10c2' value = "<?php echo $row['IV1R10C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r10c3' onBlur="valida12(this.id, 'idiv1r10c1', 'COLUMNA1');" name='iv1r10c3' value = "<?php echo $row['IV1R10C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r10c4' onBlur="valida12(this.id, 'idiv1r10c2', 'COLUMNA2');" name='iv1r10c4' value = "<?php echo $row['IV1R10C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-right' style='margin-left: 30px' id="txtn111">
							<b>Total personal ocupado promedio</b>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r11c1' name='iv1r11c1' value = "<?php echo $row['IV1R11C1']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r11c2' name='iv1r11c2' value = "<?php echo $row['IV1R11C2']?>" maxlength="5" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r11c3' name='iv1r11c3' value = "<?php echo $row['IV1R11C3']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv1r11c4' name='iv1r11c4' value = "<?php echo $row['IV1R11C4']?>" maxlength="5" <?php echo $estadoIV1 ?> />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iv2&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> IV.2 Distribuya el personal ocupado promedio que particip&oacute; en actividades
						cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en su empresa en los a&ntilde;os <?php echo $anterior . '-' . $vig?>
						(pregunta IV.1), seg&uacute;n el (los) departamento(s) donde se desarrollaron y ejecutaron dichas actividades de
						innovaci&oacute;n:</b></h5>
					</legend>
					<div class='container-fluid'>
						<table class='table table-bordered'>
							<thead>
								<tr>
									<th>Departamento</th>
									<th class='text-center'><?php echo $anterior?></th>
									<th class='text-center'><?php echo $vig?></th>
									<th>Departamento</th>
									<th class='text-center'><?php echo $anterior?></th>
									<th class='text-center'><?php echo $vig?></th>
									<th>Departamento</th>
									<th class='text-center'><?php echo $anterior?></th>
									<th class='text-center'><?php echo $vig?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class='small'>1. Amazonas</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r1c1' name='iv2r1c1' value = "<?php echo $row['IV2R1C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r1c2' name='iv2r1c2' value = "<?php echo $row['IV2R1C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>12. Cesar</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r12c1' name='iv2r12c1' value = "<?php echo $row['IV2R12C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r12c2' name='iv2r12c2' value = "<?php echo $row['IV2R12C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>23. Norte de Santander</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r23c1' name='iv2r23c1' value = "<?php echo $row['IV2R23C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r23c2' name='iv2r23c2' value = "<?php echo $row['IV2R23C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td class='small'>2. Antioquia</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r2c1' name='iv2r2c1' value = "<?php echo $row['IV2R2C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r2c2' name='iv2r2c2' value = "<?php echo $row['IV2R2C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>13. Choc&oacute;</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r13c1' name='iv2r13c1' value = "<?php echo $row['IV2R13C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r13c2' name='iv2r13c2' value = "<?php echo $row['IV2R13C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>24. Putumayo</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r24c1' name='iv2r24c1' value = "<?php echo $row['IV2R24C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r24c2' name='iv2r24c2' value = "<?php echo $row['IV2R24C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td class='small'>3. Arauca</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r3c1' name='iv2r3c1' value = "<?php echo $row['IV2R3C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r3c2' name='iv2r3c2' value = "<?php echo $row['IV2R3C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>14. C&oacute;rdoba</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r14c1' name='iv2r14c1' value = "<?php echo $row['IV2R14C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r14c2' name='iv2r14c2' value = "<?php echo $row['IV2R14C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>25. Quindio</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r25c1' name='iv2r25c1' value = "<?php echo $row['IV2R25C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r25c2' name='iv2r25c2' value = "<?php echo $row['IV2R25C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td class='small'>4. Atl&aacute;ntico</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r4c1' name='iv2r4c1' value = "<?php echo $row['IV2R4C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r4c2' name='iv2r4c2' value = "<?php echo $row['IV2R4C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>15. Cundinamarca</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r15c1' name='iv2r15c1' value = "<?php echo $row['IV2R15C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r15c2' name='iv2r15c2' value = "<?php echo $row['IV2R15C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>26. Risaralda</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r26c1' name='iv2r26c1' value = "<?php echo $row['IV2R26C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r26c2' name='iv2r26c2' value = "<?php echo $row['IV2R26C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td class='small'>5. Bogot&aacute; D.C.</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r5c1' name='iv2r5c1' value = "<?php echo $row['IV2R5C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r5c2' name='iv2r5c2' value = "<?php echo $row['IV2R5C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>16. Guain&iacute;a</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r16c1' name='iv2r16c1' value = "<?php echo $row['IV2R16C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r16c2' name='iv2r16c2' value = "<?php echo $row['IV2R16C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>27. San Andres y Providencia</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r27c1' name='iv2r27c1' value = "<?php echo $row['IV2R27C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r27c2' name='iv2r27c2' value = "<?php echo $row['IV2R27C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td class='small'>6. Bolivar</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r6c1' name='iv2r6c1' value = "<?php echo $row['IV2R6C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r6c2' name='iv2r6c2' value = "<?php echo $row['IV2R6C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>17. Guaviare</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r17c1' name='iv2r17c1' value = "<?php echo $row['IV2R17C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r17c2' name='iv2r17c2' value = "<?php echo $row['IV2R17C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>28. Santander</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r28c1' name='iv2r28c1' value = "<?php echo $row['IV2R28C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r28c2' name='iv2r28c2' value = "<?php echo $row['IV2R28C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td class='small'>7. Boyac&aacute;</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r7c1' name='iv2r7c1' value = "<?php echo $row['IV2R7C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r7c2' name='iv2r7c2' value = "<?php echo $row['IV2R7C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>18. Huila</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r18c1' name='iv2r18c1' value = "<?php echo $row['IV2R18C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r18c2' name='iv2r18c2' value = "<?php echo $row['IV2R18C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>29. Sucre</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r29c1' name='iv2r29c1' value = "<?php echo $row['IV2R29C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r29c2' name='iv2r29c2' value = "<?php echo $row['IV2R29C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td class='small'>8. Caldas</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r8c1' name='iv2r8c1' value = "<?php echo $row['IV2R8C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r8c2' name='iv2r8c2' value = "<?php echo $row['IV2R8C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>19. La Guajira</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r19c1' name='iv2r19c1' value = "<?php echo $row['IV2R19C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r19c2' name='iv2r19c2' value = "<?php echo $row['IV2R19C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>30. Tolima</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r30c1' name='iv2r30c1' value = "<?php echo $row['IV2R30C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r30c2' name='iv2r30c2' value = "<?php echo $row['IV2R30C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td class='small'>9. Caquet&aacute;</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r9c1' name='iv2r9c1' value = "<?php echo $row['IV2R9C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r9c2' name='iv2r9c2' value = "<?php echo $row['IV2R9C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>20. Magdalena</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r20c1' name='iv2r20c1' value = "<?php echo $row['IV2R20C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r20c2' name='iv2r20c2' value = "<?php echo $row['IV2R20C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>31. Valle del Cauca</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r31c1' name='iv2r31c1' value = "<?php echo $row['IV2R31C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r31c2' name='iv2r31c2' value = "<?php echo $row['IV2R31C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td class='small'>10. Casanare</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r10c1' name='iv2r10c1' value = "<?php echo $row['IV2R10C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r10c2' name='iv2r10c2' value = "<?php echo $row['IV2R10C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>21. Meta</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r21c1' name='iv2r21c1' value = "<?php echo $row['IV2R21C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r21c2' name='iv2r21c2' value = "<?php echo $row['IV2R21C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>32. Vaup&eacute;s</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r32c1' name='iv2r32c1' value = "<?php echo $row['IV2R32C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r32c2' name='iv2r32c2' value = "<?php echo $row['IV2R32C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td class='small'>11. Cauca</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r11c1' name='iv2r11c1' value = "<?php echo $row['IV2R11C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r11c2' name='iv2r11c2' value = "<?php echo $row['IV2R11C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>22. Nari&ntilde;o</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r22c1' name='iv2r22c1' value = "<?php echo $row['IV2R22C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r22c2' name='iv2r22c2' value = "<?php echo $row['IV2R22C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
									<td class='small'>33. Vichada</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r33c1' name='iv2r33c1' value = "<?php echo $row['IV2R33C1']?>" maxlength="5" <?php echo $estadoIV21 ?> />
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r33c2' name='iv2r33c2' value = "<?php echo $row['IV2R33C2']?>" maxlength="5" <?php echo $estadoIV22 ?> />
									</td>
								</tr>
								<tr>
									<td colspan='6'>&nbsp;</td>
									<td class='small' id="txtn234"><b>Total</b> (suma de los items 1 a 33)</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r34c1' name='iv2r34c1' value = "<?php echo $row['IV2R34C1']?>" maxlength="7" <?php echo $estadoIV21 ?>/>
									</td>
									<td class='col-sm-1 small'>
										<input type='text' class='form-control input-sm text-right' id='idiv2r34c2' name='iv2r34c2' value = "<?php echo $row['IV2R34C2']?>" maxlength="7" <?php echo $estadoIV22 ?>/>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iv3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> IV.3</b></h5></legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small'>&nbsp;</div>
						<div class='col-sm-1 small text-right'><b><?php echo $anterior?></b></div>
						<div class='col-sm-1 small text-right'><b><?php echo $vig?></b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							Indique el n&uacute;mero promedio de empleados con certificaciones de competencias laborales inherentes a la
							actividad(es) principal(es) que desarrolla la empresa:
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv3r1c1' name='iv3r1c1' value = "<?php echo $row['IV3R1C1']?>" />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv3r1c2' name='iv3r1c2' value = "<?php echo $row['IV3R1C2']?>" />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="iv4" <?php echo $estadoIV1 ?> >
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iv4&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> IV.4 Distribuya el personal ocupado promedio que particip&oacute; en actividades 
						Cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en su empresa durante <?php echo $vig?> (pregunta IV.1),
						seg&uacute;n su &aacute;rea funcional principal y sexo:</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>&nbsp;</div>
						<div class='col-sm-1 small text-right'><b>Hombres</b></div>
						<div class='col-sm-1 small text-right'><b>Mujeres</b></div>
						<div class='col-sm-1 small text-right'><b>Total</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn41">
							<b>1. </b>Direcci&oacute;n General
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r1c1' name='iv4r1c1' value = "<?php echo $row['IV4R1C1']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r1c2' name='iv4r1c2' value = "<?php echo $row['IV4R1C2']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r1c3' name='iv4r1c3' value = "<?php echo $row['IV4R1C3']?>" <?php echo $estadoIV22 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn42">
							<b>2. </b>Administraci&oacute;n
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r2c1' name='iv4r2c1' value = "<?php echo $row['IV4R2C1']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r2c2' name='iv4r2c2' value = "<?php echo $row['IV4R2C2']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r2c3' name='iv4r2c3' value = "<?php echo $row['IV4R2C3']?>" <?php echo $estadoIV22 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn43">
							<b>3. </b>Mercadeo y Ventas
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r3c1' name='iv4r3c1' value = "<?php echo $row['IV4R3C1']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r3c2' name='iv4r3c2' value = "<?php echo $row['IV4R3C2']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r3c3' name='iv4r3c3' value = "<?php echo $row['IV4R3C3']?>" <?php echo $estadoIV22 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn44">
							<b>4. </b>Produc&oacute;n
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r4c1' name='iv4r4c1' value = "<?php echo $row['IV4R4C1']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r4c2' name='iv4r4c2' value = "<?php echo $row['IV4R4C2']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r4c3' name='iv4r4c3' value = "<?php echo $row['IV4R4C3']?>" <?php echo $estadoIV22 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn45">
							<b>5. </b>Contable y Financiera
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r5c1' name='iv4r5c1' value = "<?php echo $row['IV4R5C1']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r5c2' name='iv4r5c2' value = "<?php echo $row['IV4R5C2']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r5c3' name='iv4r5c3' value = "<?php echo $row['IV4R5C3']?>" <?php echo $estadoIV22 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn46">
							<b>6. </b>Investigaci&oacute;n y desarrollo (&Eacute;ste se desagrega a su vez en los siguientes cuatro items. No incluya consultores externos)
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r6c1' name='iv4r6c1' value = "<?php echo $row['IV4R6C1']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r6c2' name='iv4r6c2' value = "<?php echo $row['IV4R6C2']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r6c3' name='iv4r6c3' value = "<?php echo $row['IV4R6C3']?>" <?php echo $estadoIV22 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn47">
							<span style='margin-left: 30px'></span><b>6.1 </b>Investigadores (coordinadores, lideres de proyectos y/o gestores)</span>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r7c1' name='iv4r7c1' value = "<?php echo $row['IV4R7C1']?>" <?php echo $estadoIV22 ?> <?php echo $estadoIVR6C1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r7c2' name='iv4r7c2' value = "<?php echo $row['IV4R7C2']?>" <?php echo $estadoIV22 ?> <?php echo $estadoIVR6C2 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r7c3' name='iv4r7c3' value = "<?php echo $row['IV4R7C3']?>" <?php echo $estadoIV22 ?> <?php echo $estadoIVR6C3 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn48">
							<span style='margin-left: 30px'><b>6.2 </b>Pasantes o asistentes de investigaci&oacute;n y desarrollo</span>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r8c1' name='iv4r8c1' value = "<?php echo $row['IV4R8C1']?>" <?php echo $estadoIVR6C1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r8c2' name='iv4r8c2' value = "<?php echo $row['IV4R8C2']?>" <?php echo $estadoIVR6C2 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r8c3' name='iv4r8c3' value = "<?php echo $row['IV4R8C3']?>" <?php echo $estadoIVR6C3 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn49">
							<span style='margin-left: 30px'><b>6.3 </b>T&eacute;cnicos en investigaci&oacute;n y desarrollo</span>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r9c1' name='iv4r9c1' value = "<?php echo $row['IV4R9C1']?>" <?php echo $estadoIVR6C1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r9c2' name='iv4r9c2' value = "<?php echo $row['IV4R9C2']?>" <?php echo $estadoIVR6C2 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r9c3' name='iv4r9c3' value = "<?php echo $row['IV4R9C3']?>" <?php echo $estadoIVR6C3 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn410">
							<span style='margin-left: 30px'><b>6.4 </b>Auxiliares y/o apoyo administrativo en Investigaci&oacute;n y Desarrollo</span>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r10c1' name='iv4r10c1' value = "<?php echo $row['IV4R10C1']?>" <?php echo $estadoIVR6C1 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r10c2' name='iv4r10c2' value = "<?php echo $row['IV4R10C2']?>" <?php echo $estadoIVR6C2 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r10c3' name='iv4r10c3' value = "<?php echo $row['IV4R10C3']?>" <?php echo $estadoIVR6C3 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn411">
							<b>Total personal involucrado en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n (Suma de las opciones 1 a 6)</b>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r11c1' name='iv4r11c1' value = "<?php echo $row['IV4R11C1']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r11c2' name='iv4r11c2' value = "<?php echo $row['IV4R11C2']?>" <?php echo $estadoIV22 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv4r11c3' name='iv4r11c3' value = "<?php echo $row['IV4R11C3']?>" <?php echo $estadoIV22 ?> />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="iv5" <?php echo $estadoIV1 ?> >
					<legend><h5 style='font-family: arial' id="txtn51"><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iv5&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> IV.5 &iquest;Contrat&oacute; su empresa consultores externos para la realizaci&oacute;n
						de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante <?php echo $vig?>? Si su respuesta es
						afirmativa, indique el n&uacute;mero de consultores que prestaron servicios tanto dentro de la empresa como fuera de ella:</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small text-center' style='margin-left: 30px'>
							<label class='radio-inline'><input type='radio' id='idiv5r1c1' name='iv5r1c1' value = '1' <?php echo ($row['IV5R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idiv5r1c12' name='iv5r1c1' value = '2' <?php echo ($row['IV5R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-4 small'>
							N&uacute;mero de consultores prestando servicios dentro de la empresa (tiene puesto de trabajo en las instalaciones de la empresa)							
						</div>
						<div class='col-sm-1 small'>
							<input type='text' class='form-control input-sm text-right' id='idiv5r1c2' name='iv5r1c2' <?php echo $estadoIV5 ?> value = "<?php echo $row['IV5R1C2']?>" maxlength="3" />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small text-center' style='margin-left: 30px'>&nbsp;</div>
						<div class='col-sm-4 small'>
							N&uacute;mero de consultores prestando servicios fuera de la empresa (<b>no</b> tiene puesto de trabajo en las instalaciones de la empresa)
						</div>
						<div class='col-sm-1 small'>
							<input type='text' class='form-control input-sm text-right' id='idiv5r1c3' name='iv5r1c3' <?php echo $estadoIV5 ?> value = "<?php echo $row['IV5R1C3']?>" maxlength="3" />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="iv6" <?php echo $estadoIV1 ?> >
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iv6&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> IV.6 Distribuya el personal ocupado promedio con nivel educativo superior que particip&oacute;
						en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en su empresa durante <?php echo $vig?>
						(pregunta IV.1 opciones 1 - 6), seg&uacute;n el &aacute;rea de formaci&oacute;n del m&aacute;ximo nivel educativo obtenido
						y sexo:</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-center' style='margin-left: 30px'><b>&Aacute;rea de formaci&oacute;n</b></div>
						<div class='col-sm-1 small text-right'><b>Hombres</b></div>
						<div class='col-sm-1 small text-right'><b>Mujeres</b></div>
						<div class='col-sm-1 small text-right'><b>Total</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn61">
							<b>1. </b>Ciencias exactas asociadas a la qu&iacute;mica, f&iacute;sica, matem&aacute;ticas y estad&iacute;stica<a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' data-placement='top' title='Ciencias exactas.' data-content='Incluya: f&iacute;sica, qu&iacute;mica, matem&aacute;ticas, estad&iacute;stica y afines'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r1c1' name='iv6r1c1' value = "<?php echo $row['IV6R1C1']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r1c2' name='iv6r1c2' value = "<?php echo $row['IV6R1C2']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r1c3' name='iv6r1c3' value = "<?php echo $row['IV6R1C3']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn62">
							<b>2. </b>Ciencias naturales <a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Ciencias naturales.' data-content='Incluya: biolog&iacute;a, microbiolog&iacute;a, biotecnolog&iacute;a, geolog&iacute;a y afines'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r2c1' name='iv6r2c1' value = "<?php echo $row['IV6R2C1']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r2c2' name='iv6r2c2' value = "<?php echo $row['IV6R2C2']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r2c3' name='iv6r2c3' value = "<?php echo $row['IV6R2C3']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn63">
							<b>3. </b>Ciencias de la salud<a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Ciencias de la salud.' data-content='Incluya: bacteriolog&iacute;a, enfermer&iacute;a, instrumentaci&oacute;n quir&uacute;rgica, medicina, nutrici&oacute;n y diet&eacute;tica, odontolog&iacute;a, optometr&iacute;a, salud p&uacute;blica, terapia y afines.'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r3c1' name='iv6r3c1' value = "<?php echo $row['IV6R3C1']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r3c2' name='iv6r3c2' value = "<?php echo $row['IV6R3C2']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r3c3' name='iv6r3c3' value = "<?php echo $row['IV6R3C3']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn64">
							<b>4. </b>Ingenier&iacute;a, arquitectura, urbanismo y afines<a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Ingenier&iacute;a, arquitectura, urbanismo y afines' data-content='Incluya: arquitectura, urbanismo, ingenier&iacute;a (administrativa, agr&iacute;cola, forestal, agroindustrial, de alimentos, agron&oacute;mica, pecuaria, ambiental, sanitaria, biom&eacute;dica, civil, de minas, metalurgica, de sistemas, telem&aacute;tica, el&eacute;ctrica, electr&oacute;nica, de telecomunicaciones, industrial, mec&aacute;nica, qu&iacute;mica y otras) y afines.'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r4c1' name='iv6r4c1' value = "<?php echo $row['IV6R4C1']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r4c2' name='iv6r4c2' value = "<?php echo $row['IV6R4C2']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r4c3' name='iv6r4c3' value = "<?php echo $row['IV6R4C3']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn65">
							<b>5. </b>Agronom&iacute;a, veterinaria y afines<a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Agronom&iacute;a, veterinaria y afines.' data-content='Incluya: agronom&iacute;a, veterinaria, zootecnia y afines.'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r5c1' name='iv6r5c1' value = "<?php echo $row['IV6R5C1']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r5c2' name='iv6r5c2' value = "<?php echo $row['IV6R5C2']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r5c3' name='iv6r5c3' value = "<?php echo $row['IV6R5C3']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn66">
							<b>6. </b>Ciencias sociales<a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Ciencias sociales' data-content='Incluya: econom&iacute;a, administraci&oacute;n, contadur&iacute;a p&uacute;blica, ciencia pol&iacute;tica, relaciones internacionales, comunicaci&oacute;n social, periodismo, derecho, formaci&oacute;n relacionada con el campo militar o policial, sociolog&iacute;a, trabajo social, otras ciencias sociales y afines.'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r6c1' name='iv6r6c1' value = "<?php echo $row['IV6R6C1']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r6c2' name='iv6r6c2' value = "<?php echo $row['IV6R6C2']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r6c3' name='iv6r6c3' value = "<?php echo $row['IV6R6C3']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn67">
							<b>7. </b>Ciencias humanas y bellas artes<a href='#'><span class='glyphicon glyphicon-info-sign' data-toggle='popover' data-trigger='hover' title='Ciencias humanas y bellas artes' data-content='Incluya: lenguas, antropolog&iacute;a, artes liberales, artes pl&aacute;sticas, artes visuales, artes representativas, biblotecolog&iacute;a, deportes, dise&ntilde;o, educaci&oacute;n f&iacute;sica, filosof&iacute;a, teolog&iacute;a, geograf&iacute;a, historia, lenguas modernas, literatura, ling&uuml;&iacute;stica, m&uacute;sica, psicolog&iacute;a, publicidad, y afines.'></span></a>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r7c1' name='iv6r7c1' value = "<?php echo $row['IV6R7C1']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r7c2' name='iv6r7c2' value = "<?php echo $row['IV6R7C2']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r7c3' name='iv6r7c3' value = "<?php echo $row['IV6R7C3']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn68">
							<b>Total personal ocupado promedio con nivel de educaci&oacute;n superior involucrado en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n</b>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r8c1' name='iv6r8c1' value = "<?php echo $row['IV6R8C1']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r8c2' name='iv6r8c2' value = "<?php echo $row['IV6R8C2']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv6r8c3' name='iv6r8c3' value = "<?php echo $row['IV6R8C3']?>" maxlength="5" <?php echo $estadoIV6 ?> />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="iv7" <?php echo $estadoIV1 ?> >
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iv7&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> IV.7 Indique el n&uacute;mero de personas que recibieron formaci&oacute;n y capacitaci&oacute;n
						relacionada espec&iacute;ficamente con actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n
						(correspondiente al valor registrado en cap&iacute;tulo II - pregunta 1 - &iacute;tem 9), seg&uacute;n el tipo de capacitaci&oacute;n
						impartida, financiada o cofinanciada por la empresa en los a&ntilde;os <?php echo $anterior . "-" . $vig?>: </b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='form-group form-group-sm'>
							<div class='col-sm-6 small'></div>
							<div class='col-sm-2 small text-right'><b>Personas capacitadas</b></div>
						</div>
						<div class='form-group form-group-sm'>
							<div class='col-sm-6 small'></div>
							<div class='col-sm-1 small text-right'><b><?php echo $anterior?></b></div>
							<div class='col-sm-1 small text-right'><b><?php echo $vig?></b></div>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>1. </b>Doctorado: formaci&oacute;n de su personal, conducente a un t&iacute;tulo de doctorado (Ph.D), destinada a
								actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n realizadas por la empresa.
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv7r1c1' name='iv7r1c1' value = "<?php echo $row['IV7R1C1']?>" <?php echo $estadoIV71 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv7r1c2' name='iv7r1c2' value = "<?php echo $row['IV7R1C2']?>" <?php echo $estadoIV72 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>2. </b>Maestr&iacute;a: formaci&oacute;n de su personal, conducente a un t&iacute;tulo de master (MSc, MA, MBA),
							destinada a actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n realizadas por la empresa.
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv7r2c1' name='iv7r2c1' value = "<?php echo $row['IV7R2C1']?>" <?php echo $estadoIV71 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv7r2c2' name='iv7r2c2' value = "<?php echo $row['IV7R2C2']?>" <?php echo $estadoIV72 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>3. </b>Especializaci&oacute;n: formaci&oacute;n de su personal, conducente a un t&iacute;tulo de especialista,
							destinada a actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n realizadas por la empresa.
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv7r3c1' name='iv7r3c1' value = "<?php echo $row['IV7R3C1']?>" <?php echo $estadoIV71 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv7r3c2' name='iv7r3c2' value = "<?php echo $row['IV7R3C2']?>" <?php echo $estadoIV72 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px'>
							<b>4. </b>Capacitaci&oacute;n igual o mayor a 40 horas: capacitaci&oacute;n de su personal, sea interna o externa a la
							empresa, con una duraci&oacute;n igual o mayor a 40 horas;  destinada a actividades cient&iacute;ficas, tecnol&oacute;gicas
							y de innovaci&oacute;n realizadas por la empresa.
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv7r4c1' name='iv7r4c1' value = "<?php echo $row['IV7R4C1']?>" <?php echo $estadoIV71 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv7r4c2' name='iv7r4c2' value = "<?php echo $row['IV7R4C2']?>" <?php echo $estadoIV72 ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small text-right' style='margin-left: 30px' id="txtn75">
							<b>Total personal capacitado y/o financiado</b>
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv7r5c1' name='iv7r5c1' value = "<?php echo $row['IV7R5C1']?>" <?php echo $estadoIV71 ?> />
						</div>
						<div class='col-sm-1 small text-right'>
							<input type='text' class='form-control input-sm text-right' id='idiv7r5c2' name='iv7r5c2' value = "<?php echo $row['IV7R5C2']?>" <?php echo $estadoIV72 ?> />
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h4 style='font-family: arial'>Observaciones</h4></legend>
					<div class='col-sm-6' style='padding-bottom: 10px'>
						<textarea class='form-control' rows='2' name='observaciones' id='obsfte' <?php echo $estadObs ?>><?php echo $row['OBSERVACIONES'] ?></textarea>
					</div>
				</fieldset>
				<?php if ($grabaOK) { ?>
				<div class='form-group form-group-sm'>
					<div class='col-md-8'>
						<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Cap&iacute;tulo IV Actualizado Correctamente</p>
					</div>
					<div class='col-sm-1 small pull-right' id="btn_cont" style="display: none;" >
						<a href='capitulo5.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente cap&iacute;tulo'>Continuar</a>
					</div>
					<div class='col-sm-1 small pull-right'>
						<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar informaci&oacute;n Cap&iacute;tulo IV'>Grabar</button>
					</div>
				</div>
				<?php } ?>
			</div>  
 		</form>
		<div id="idObs1" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Observaciones</h4>
					  </div>
					  <div class="modal-body">
						<textarea class='form-control' rows='2' name='observaCrit' id='obscrit'></textarea>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" id="gObs">Grabar</button>
					  </div>
				</div>
			</div>
		</div>
		
		<?php include 'modalediteas.php' ?>
		
		<div id="avisoCrit" class="modal fade" role="dialog">
  			<div class="modal-dialog modal-lg">
   				 <div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
        					<h4 class="modal-title">RECOMENDACIONES PARA UN BUEN PROCESO DE CR&Iacute;TICA EN EL CAP&Iacute;TULO IV</h4>
      				</div>
      				<div class="modal-body">
        				<ol style='text-align: justify; font-family: arial'>
						<li>Las fuentes que reporten  personal en <b>CERO (0)</b> para cualquiera de los dos a&ntilde;os o para ambos a&ntilde;os (personal ocupado promedio
							tiempo completo, permanente y temporal a&ntilde;os 1 y/o 2), se recomienda indagar y justificar si es el caso. As&iacute; mismo,  revisar  las
							fuentes que registren <b>1, 2 y 3</b> empleados promedios ocupados.
						<li>Revisar fuentes que registren personal empleado en la EDIT  diferente al registrado en la EAC o EAS para el a&ntilde;o 1.
						<li>Las fuentes que registren <b>VARIACIONES ALTAS</b> de personal empleado del a&ntilde;o 1 al a&ntilde;o 2 (personal ocupado promedio tiempo
							completo, permanente y temporal a&ntilde;o 1 al a&ntilde;o 2), se recomienda indagar.
						<li>Verificar las fuentes que  registren personal con t&iacute;tulo de <b>DOCTORADO</b> para cualquiera de los dos a&ntilde;os, se debe enfatizar
							que el n&uacute;mero de personas registradas debe contar con el t&iacute;tulo obtenido de doctor en alg&uacute;n &aacute;rea de formaci&oacute;n. Las empresas del
							sector <b>SALUD</b> hay que tener un tratamiento especial, ya que en este sector se denomina doctor a la persona que puede ejercer
							la medicina, que posee los conocimientos necesarios para diagnosticar una determinada enfermedad y ponerle fin a trav&eacute;s de un
							tratamiento particular; sin embargo, solo se podr&aacute;n registrar como doctores aquellas personas que ejerzan su profesi&oacute;n y hayan
							obtenido el doctorado (grado m&aacute;s alto que se otorga en cualquier disciplina o profesi&oacute;n ), a partir de una formaci&oacute;n acad&eacute;mica en
							un &aacute;rea espec&iacute;fica.
						<li>Revisar fuentes que registren m&aacute;s de un <b>ALTO GRADO</b> de su personal total con t&iacute;tulo Formaci&oacute;n Profesional Integra - SENA
							o nivel educativo NINGUNO para cualquiera de los dos a&ntilde;os.
						<li>Revisar fuentes <b>INNOVADORAS</b> que reporten en <b>CERO</b> (0) personal en ACTI para ambos a&ntilde;os.
						<li>Las fuentes que registren un <b>ALTO N&Uacute;MERO DE PERSONAL</b> con <b>COMPETENCIAS LABORALES</b> frente al total de la empresa
							(personal ocupado promedio tiempo completo, permanente y temporal a&ntilde;os 1 y/o 2) para cualquiera de los dos a&ntilde;os, se recomienda
							indagar ya que las certificaciones de competencia laboral <b>NO</b> son cursos, ni t&iacute;tulos acad&eacute;micos, ni experiencia emp&iacute;rica.
							Estos son certificados  los otorga una entidad competente como el SENA despu&eacute;s de evaluar en ambiente real a los empleados seg&uacute;n
							la competencia que tenga, los cuales deben ser renovados  cada determinado periodo y deben ser relevantes para el cargo que
							desempe&ntilde;a dicho empleado.
						<li>Revisar fuentes que reporten un <b>ALTO N&Uacute;MERO</b> de los consultores externos frente al total del personal en ACTI
							(personal ocupado promedio que particip&oacute;  en la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n anos 1 y/o 2).
						<li>Revisar fuentes que registren un <b>ALTO N&Uacute;MERO</b> de  personal con capacitaci&oacute;n impartida o financiada frente al total ocupado
							(personal ocupado promedio tiempo completo, permanente y temporal a&ntilde;os 1 y/o 2).
						<li>Realizar observaciones claras, <b>NO DEJAR NOTAS</b> como datos ok, datos verificados, etc. en lo posible indicar el nombre y cargo
							de la persona que suministra la informaci&oacute;n.
						</ol>
      				</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      				</div>
    			</div>
  			</div>
		</div>
 	</body>
 </html> 
