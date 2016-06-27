<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	ini_set('default_charset', 'UTF-8');
	$region = $_SESSION['region'];
	$tipousu = $_SESSION['tipou'];
	$page='cap5';
	$vig=$_SESSION['vigencia'];
	$estadObs = ($tipousu != "FU" ? "readonly" : "");
	$anterior = $vig-1;
	$tabla = 'capitulo_v';
	$numero = $_GET['numord']; $nombre = $_GET['nombre'];
	$grabaOK = false;
	include '../persistencia/cargaDato.php';
	
	$consLog = ($region == 99 ? true : false);
	
	$cLog = "<span class='glyphicon glyphicon-time' style='color: blue; font-size: 14px;'></span>";
	
	$estadoV1 = ''; $estadoV2 = ''; $estadoV3 = ''; $bloquear = "NO";
	
	$qCap1 = $conn->prepare("SELECT * FROM capitulo_i WHERE C1_nordemp= :idNumero AND vigencia = :anoProc");
	$qCap1->execute(array('idNumero'=>$numero, 'anoProc'=>$vig));
	$rowc1 = $qCap1->fetch(PDO::FETCH_ASSOC);
	
	if ($rowc1['I1R1C1N']==1 OR $rowc1['I1R2C1N']==1 OR $rowc1['I1R3C1N']==1 OR $rowc1['I1R1C1M']==1 OR $rowc1['I1R2C1M']==1 OR $rowc1['I1R3C1M']==1 
		OR $rowc1['I1R4C1']==1 OR $rowc1['I1R5C1']==1 OR $rowc1['I1R6C1']==1 OR $rowc1['I5R1C1']==1 OR $rowc1['I6R1C1']==1) {
			$estadoV1 = '';
	}
	if ($rowc1['I1R1C1N']!=1 AND $rowc1['I1R2C1N']!=1 AND $rowc1['I1R3C1N']!=1 AND $rowc1['I1R1C1M']!=1 AND $rowc1['I1R2C1M']!=1 AND $rowc1['I1R3C1M']!=1 
		AND $rowc1['I1R4C1']!=1 AND $rowc1['I1R5C1']!=1 AND $rowc1['I1R6C1']!=1 AND $rowc1['I5R1C1']!=1 AND $rowc1['I6R1C1']!=1 AND $rowc1['I7R1C1']==1) {
			$estadoV1 = ''; $estadoV2 = ''; $estadoV3 = 'disabled';
	}
	
	$qC1 = $conn->prepare("SELECT * FROM capitulo_i WHERE C1_nordemp = :nFuente AND vigencia = :periodo");
	$qC1->execute(array('nFuente'=>$numero, 'periodo'=>$vig));
	$rowC1 = $qC1->fetch(PDO::FETCH_ASSOC);
	if (!($rowC1)) {
		$bloquear = "SI";
	}
	else {
		if ($rowC1['I1R1C1N']!=1 AND $rowC1['I1R2C1N']!=1 AND $rowC1['I1R3C1N']!=1 AND $rowC1['I1R1C1M']!=1 AND $rowC1['I1R2C1M']!=1 AND $rowC1['I1R3C1M']!=1
			AND $rowC1['I1R4C1']!=1 AND $rowC1['I1R5C1']!=1 AND $rowC1['I1R6C1']!=1 AND $rowC1['I5R1C1']!=1 AND $rowC1['I6R1C1']!=1 AND $rowC1['I7R1C1']!=1) {
			$bloquear = "SI";
		}
	}
	if ($bloquear == "SI") {
		$borraReg = $conn->prepare("DELETE FROM capitulo_v WHERE C5_nordemp = :numero AND vigencia = :periodo");
		$borraReg->execute(array(':numero'=>$numero, ':periodo'=>$vig));
		
		if ($tipousu == "CR" AND $rowCtl['acceso'] == "CR" AND $rowCtl['estado'] == 4) {
			$actuCtl = $conn->prepare("UPDATE control set m5 = 3 WHERE nordemp = :numero AND vigencia = :periodo");
			$actuCtl->execute(array(':numero'=>$numero, ':periodo'=>$vig));
		}
		else {
			if ($tipousu == "FU" AND $rowCtl['acceso'] == "FU" AND $rowCtl['estado'] < 4) {
				$actuCtl = $conn->prepare("UPDATE control set m5 = 2 WHERE nordemp = :numero AND vigencia = :periodo");
				$actuCtl->execute(array(':numero'=>$numero, ':periodo'=>$vig));
			}
		}
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
		<script type="text/javascript" src="../js/validaForm5.js"></script>
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
            $("#capitulo5").submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: "../persistencia/grabacapi.php",
                    type: "POST",
                    data: $(this).serialize(),
					beforeSend:  validaForm5,
                    success: function(dato) {
						if (retorno=="") {
							$("#btn_cont").show();
							$("#idmsg").show();
							$(function() {
								$.ajax({
								url: "../persistencia/grabactl.php",
								type: "POST",
								data: {modulo: "m5", estado: "2", numero: $("#numero").val(), capitulo: "C5"},
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
								data: {modulo: "m5", estado: "1", numero: $("#numero").val(), capitulo: "C5"},
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
				$("#idv1r9c1").click(function() {
					$("#idv1r9c2,#idv1r9c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r10c1").click(function() {
					$("#idv1r10c2,#idv1r10c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r11c1").click(function() {
					$("#idv1r11c2,#idv1r11c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r12c1").click(function() {
					$("#idv1r12c2,#idv1r12c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r13c1").click(function() {
					$("#idv1r13c2,#idv1r13c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r14c1").click(function() {
					$("#idv1r14c2,#idv1r14c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r15c1").click(function() {
					$("#idv1r15c2,#idv1r15c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r16c1").click(function() {
					$("#idv1r16c2,#idv1r16c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r17c1").click(function() {
					$("#idv1r17c2,#idv1r17c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r18c1").click(function() {
					$("#idv1r18c2,#idv1r18c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r19c1").click(function() {
					$("#idv1r19c2,#idv1r19c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r20c1").click(function() {
					$("#idv1r20c2,#idv1r20c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r21c1").click(function() {
					$("#idv1r21c2,#idv1r21c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r22c1").click(function() {
					$("#idv1r22c2,#idv1r22c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r23c1").click(function() {
					$("#idv1r23c2,#idv1r23c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r24c1").click(function() {
					$("#idv1r24c2,#idv1r24c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r25c1").click(function() {
					$("#idv1r25c2,#idv1r25c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r26c1").click(function() {
					$("#idv1r26c2,#idv1r26c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r27c1").click(function() {
					$("#idv1r27c2,#idv1r27c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r28c1").click(function() {
					$("#idv1r28c2,#idv1r28c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r29c1").click(function() {
					$("#idv1r29c2,#idv1r29c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r30c1").click(function() {
					$("#idv1r30c2,#idv1r30c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r31c1").click(function() {
					$("#idv1r31c2,#idv1r31c3").prop("disabled", false);
				});
			});
			$(function() {
				$("#idv1r32c1").click(function() {
					$("#idv1r32c2,#idv1r32c3").prop("disabled", false);
				});
			});
			
			$(function() {
				$("#idv1r9c12").click(function() {
					$("#idv1r9c2,#idv1r9c3").prop("checked", false);
					$("#idv1r9c2,#idv1r9c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r10c12").click(function() {
					$("#idv1r10c2,#idv1r10c3").prop("checked", false);
					$("#idv1r10c2,#idv1r10c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r11c12").click(function() {
					$("#idv1r11c2,#idv1r11c3").prop("checked", false);
					$("#idv1r11c2,#idv1r11c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r12c12").click(function() {
					$("#idv1r12c2,#idv1r12c3").prop("checked", false);
					$("#idv1r12c2,#idv1r12c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r13c12").click(function() {
					$("#idv1r13c2,#idv1r13c3").prop("checked", false);
					$("#idv1r13c2,#idv1r13c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r14c12").click(function() {
					$("#idv1r14c2,#idv1r14c3").prop("checked", false);
					$("#idv1r14c2,#idv1r14c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r15c12").click(function() {
					$("#idv1r15c2,#idv1r15c3").prop("checked", false);
					$("#idv1r15c2,#idv1r15c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r16c12").click(function() {
					$("#idv1r16c2,#idv1r16c3").prop("checked", false);
					$("#idv1r16c2,#idv1r16c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r17c12").click(function() {
					$("#idv1r17c2,#idv1r17c3").prop("checked", false);
					$("#idv1r17c2,#idv1r17c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r18c12").click(function() {
					$("#idv1r18c2,#idv1r18c3").prop("checked", false);
					$("#idv1r18c2,#idv1r18c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r19c12").click(function() {
					$("#idv1r19c2,#idv1r19c3").prop("checked", false);
					$("#idv1r19c2,#idv1r19c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r20c12").click(function() {
					$("#idv1r20c2,#idv1r20c3").prop("checked", false);
					$("#idv1r20c2,#idv1r20c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r21c12").click(function() {
					$("#idv1r21c2,#idv1r21c3").prop("checked", false);
					$("#idv1r21c2,#idv1r21c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r22c12").click(function() {
					$("#idv1r22c2,#idv1r22c3").prop("checked", false);
					$("#idv1r22c2,#idv1r22c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r23c12").click(function() {
					$("#idv1r23c2,#idv1r23c3").prop("checked", false);
					$("#idv1r23c2,#idv1r23c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r24c12").click(function() {
					$("#idv1r24c2,#idv1r24c3").prop("checked", false);
					$("#idv1r24c2,#idv1r24c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r25c12").click(function() {
					$("#idv1r25c2,#idv1r25c3").prop("checked", false);
					$("#idv1r25c2,#idv1r25c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r26c12").click(function() {
					$("#idv1r26c2,#idv1r26c3").prop("checked", false);
					$("#idv1r26c2,#idv1r26c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r27c12").click(function() {
					$("#idv1r27c2,#idv1r27c3").prop("checked", false);
					$("#idv1r27c2,#idv1r27c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r28c12").click(function() {
					$("#idv1r28c2,#idv1r28c3").prop("checked", false);
					$("#idv1r28c2,#idv1r28c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r29c12").click(function() {
					$("#idv1r29c2,#idv1r29c3").prop("checked", false);
					$("#idv1r29c2,#idv1r29c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r30c12").click(function() {
					$("#idv1r30c2,#idv1r30c3").prop("checked", false);
					$("#idv1r30c2,#idv1r30c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r31c12").click(function() {
					$("#idv1r31c2,#idv1r31c3").prop("checked", false);
					$("#idv1r31c2,#idv1r31c3").prop("disabled", true);
				});
			});
			$(function() {
				$("#idv1r32c12").click(function() {
					$("#idv1r32c2,#idv1r32c3").prop("checked", false);
					$("#idv1r32c2,#idv1r32c3").prop("disabled", true);
				});
			});
			
			$(function() {
				$("#idv3r1c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r1c2,#idv3r1c3,#idv3r1c4,#idv3r1c5,#idv3r1c6,#idv3r1c7,#idv3r1c8,#idv3r1c9,#idv3r1c10,#idv3r1c11").prop("disabled", false);
					}
					else {
						$("#idv3r1c2,#idv3r1c3,#idv3r1c4,#idv3r1c5,#idv3r1c6,#idv3r1c7,#idv3r1c8,#idv3r1c9,#idv3r1c10,#idv3r1c11").prop("disabled", true);
						$("#idv3r1c2,#idv3r1c3,#idv3r1c4,#idv3r1c5,#idv3r1c6,#idv3r1c7,#idv3r1c8,#idv3r1c9,#idv3r1c10,#idv3r1c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r2c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r2c2,#idv3r2c3,#idv3r2c4,#idv3r2c5,#idv3r2c6,#idv3r2c7,#idv3r2c8,#idv3r2c9,#idv3r2c10,#idv3r2c11").prop("disabled", false);
					}
					else {
						$("#idv3r2c2,#idv3r2c3,#idv3r2c4,#idv3r2c5,#idv3r2c6,#idv3r2c7,#idv3r2c8,#idv3r2c9,#idv3r2c10,#idv3r2c11").prop("disabled", true);
						$("#idv3r2c2,#idv3r2c3,#idv3r2c4,#idv3r2c5,#idv3r2c6,#idv3r2c7,#idv3r2c8,#idv3r2c9,#idv3r2c10,#idv3r2c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r3c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r3c2,#idv3r3c3,#idv3r3c4,#idv3r3c5,#idv3r3c6,#idv3r3c7,#idv3r3c8,#idv3r3c9,#idv3r3c10,#idv3r3c11").prop("disabled", false);
					}
					else {
						$("#idv3r3c2,#idv3r3c3,#idv3r3c4,#idv3r3c5,#idv3r3c6,#idv3r3c7,#idv3r3c8,#idv3r3c9,#idv3r3c10,#idv3r3c11").prop("disabled", true);
						$("#idv3r3c2,#idv3r3c3,#idv3r3c4,#idv3r3c5,#idv3r3c6,#idv3r3c7,#idv3r3c8,#idv3r3c9,#idv3r3c10,#idv3r3c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r4c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r4c2,#idv3r4c3,#idv3r4c4,#idv3r4c5,#idv3r4c6,#idv3r4c7,#idv3r4c8,#idv3r4c9,#idv3r4c10,#idv3r4c11").prop("disabled", false);
					}
					else {
						$("#idv3r4c2,#idv3r4c3,#idv3r4c4,#idv3r4c5,#idv3r4c6,#idv3r4c7,#idv3r4c8,#idv3r4c9,#idv3r4c10,#idv3r4c11").prop("disabled", true);
						$("#idv3r4c2,#idv3r4c3,#idv3r4c4,#idv3r4c5,#idv3r4c6,#idv3r4c7,#idv3r4c8,#idv3r4c9,#idv3r4c10,#idv3r4c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r5c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r5c2,#idv3r5c3,#idv3r5c4,#idv3r5c5,#idv3r5c6,#idv3r5c7,#idv3r5c8,#idv3r5c9,#idv3r5c10,#idv3r5c11").prop("disabled", false);
					}
					else {
						$("#idv3r5c2,#idv3r5c3,#idv3r5c4,#idv3r5c5,#idv3r5c6,#idv3r5c7,#idv3r5c8,#idv3r5c9,#idv3r5c10,#idv3r5c11").prop("disabled", true);
						$("#idv3r5c2,#idv3r5c3,#idv3r5c4,#idv3r5c5,#idv3r5c6,#idv3r5c7,#idv3r5c8,#idv3r5c9,#idv3r5c10,#idv3r5c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r6c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r6c2,#idv3r6c3,#idv3r6c4,#idv3r6c5,#idv3r6c6,#idv3r6c7,#idv3r6c8,#idv3r6c9,#idv3r6c10,#idv3r6c11").prop("disabled", false);
					}
					else {
						$("#idv3r6c2,#idv3r6c3,#idv3r6c4,#idv3r6c5,#idv3r6c6,#idv3r6c7,#idv3r6c8,#idv3r6c9,#idv3r6c10,#idv3r6c11").prop("disabled", true);
						$("#idv3r6c2,#idv3r6c3,#idv3r6c4,#idv3r6c5,#idv3r6c6,#idv3r6c7,#idv3r6c8,#idv3r6c9,#idv3r6c10,#idv3r6c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r7c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r7c2,#idv3r7c3,#idv3r7c4,#idv3r7c5,#idv3r7c6,#idv3r7c7,#idv3r7c8,#idv3r7c9,#idv3r7c10,#idv3r7c11").prop("disabled", false);
					}
					else {
						$("#idv3r7c2,#idv3r7c3,#idv3r7c4,#idv3r7c5,#idv3r7c6,#idv3r7c7,#idv3r7c8,#idv3r7c9,#idv3r7c10,#idv3r7c11").prop("disabled", true);
						$("#idv3r7c2,#idv3r7c3,#idv3r7c4,#idv3r7c5,#idv3r7c6,#idv3r7c7,#idv3r7c8,#idv3r7c9,#idv3r7c10,#idv3r7c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r8c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r8c2,#idv3r8c3,#idv3r8c4,#idv3r8c5,#idv3r8c6,#idv3r8c7,#idv3r8c8,#idv3r8c9,#idv3r8c10,#idv3r8c11").prop("disabled", false);
					}
					else {
						$("#idv3r8c2,#idv3r8c3,#idv3r8c4,#idv3r8c5,#idv3r8c6,#idv3r8c7,#idv3r8c8,#idv3r8c9,#idv3r8c10,#idv3r8c11").prop("disabled", true);
						$("#idv3r8c2,#idv3r8c3,#idv3r8c4,#idv3r8c5,#idv3r8c6,#idv3r8c7,#idv3r8c8,#idv3r8c9,#idv3r8c10,#idv3r8c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r9c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r9c2,#idv3r9c3,#idv3r9c4,#idv3r9c5,#idv3r9c6,#idv3r9c7,#idv3r9c8,#idv3r9c9,#idv3r9c10,#idv3r9c11").prop("disabled", false);
					}
					else {
						$("#idv3r9c2,#idv3r9c3,#idv3r9c4,#idv3r9c5,#idv3r9c6,#idv3r9c7,#idv3r9c8,#idv3r9c9,#idv3r9c10,#idv3r9c11").prop("disabled", true);
						$("#idv3r9c2,#idv3r9c3,#idv3r9c4,#idv3r9c5,#idv3r9c6,#idv3r9c7,#idv3r9c8,#idv3r9c9,#idv3r9c10,#idv3r9c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r10c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r10c2,#idv3r10c3,#idv3r10c4,#idv3r10c5,#idv3r10c6,#idv3r10c7,#idv3r10c8,#idv3r10c9,#idv3r10c10,#idv3r10c11").prop("disabled", false);
					}
					else {
						$("#idv3r10c2,#idv3r10c3,#idv3r10c4,#idv3r10c5,#idv3r10c6,#idv3r10c7,#idv3r10c8,#idv3r10c9,#idv3r10c10,#idv3r10c11").prop("disabled", true);
						$("#idv3r10c2,#idv3r10c3,#idv3r10c4,#idv3r10c5,#idv3r10c6,#idv3r10c7,#idv3r10c8,#idv3r10c9,#idv3r10c10,#idv3r10c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r11c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r11c2,#idv3r11c3,#idv3r11c4,#idv3r11c5,#idv3r11c6,#idv3r11c7,#idv3r11c8,#idv3r11c9,#idv3r11c10,#idv3r11c11").prop("disabled", false);
					}
					else {
						$("#idv3r11c2,#idv3r11c3,#idv3r11c4,#idv3r11c5,#idv3r11c6,#idv3r11c7,#idv3r11c8,#idv3r11c9,#idv3r11c10,#idv3r11c11").prop("disabled", true);
						$("#idv3r11c2,#idv3r11c3,#idv3r11c4,#idv3r11c5,#idv3r11c6,#idv3r11c7,#idv3r11c8,#idv3r11c9,#idv3r11c10,#idv3r11c11").prop("checked", false);
					}
				});
			});
			$(function() {
				$("#idv3r12c1").change(function() {
					if ($(this).val() == 1) {
						$("#idv3r12c2,#idv3r12c3,#idv3r12c4,#idv3r12c5,#idv3r12c6,#idv3r12c7,#idv3r12c8,#idv3r12c9,#idv3r12c10,#idv3r12c11").prop("disabled", false);
					}
					else {
						$("#idv3r12c2,#idv3r12c3,#idv3r12c4,#idv3r12c5,#idv3r12c6,#idv3r12c7,#idv3r12c8,#idv3r12c9,#idv3r12c10,#idv3r12c11").prop("disabled", true);
						$("#idv3r12c2,#idv3r12c3,#idv3r12c4,#idv3r12c5,#idv3r12c6,#idv3r12c7,#idv3r12c8,#idv3r12c9,#idv3r12c10,#idv3r12c11").prop("checked", false);
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
	                data: {obser: "obs", numero: $("#numero").val(), capit: "5", observa: $("#obscrit").val()},
	                success: function(dato) {
					}
				});
			});
			
			$(function() {
				$("#wc5").affix({
                    offset: {top: 10}
				});
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
		<div class="well well-sm" style="font-size: 12px; padding-top: 60px; z-index: 1;" id="wc5">
 			<?php echo $numero . "-" . $nombre?> - CAP&Iacute;TULO V - RELACIONES CON ACTORES DEL SISTEMA NACIONAL DE CIENCIA, TECNOLOG&Iacute;A E INNOVACI&Oacute;N Y COOPERACI&Oacute;N
 			PARA LA INNOVACI&Oacute;N EN EL PER&Iacute;ODO <?php echo $anterior . "-" . $vig . " . " . $txtEstado ?>
 		</div>
		<?php
 			if ($bloquear == "SI") {
 				echo "<h3>No requiere diligenciamiento</h3>";
 			}
 			else {
 		?>
 		<div class="container text-justify" style="font-size: 12px">
			<p>El Sistema Nacional de Ciencia, Tecnolog&iacute;a e Innovaci&oacute;n (SNCTI) es un sistema abierto del cual forman parte las
				pol&iacute;ticas, estrategias, programas, metodolog&iacute;as y mecanismos para la gesti&oacute;n, promoci&oacute;n,
				financiaci&oacute;n, protecci&oacute;n y divulgaci&oacute;n de la investigaci&oacute;n cient&iacute;fica y la innovaci&oacute;n
				tecnol&oacute;gica, as&iacute; como las organizaciones p&uacute;blicas, privadas o mixtas que realicen o promuevan el desarrollo
				de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n (Ley 1286 de 2009).</p>
			<p>La realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en la empresa, depende en parte
				de la diversidad y estructura de las relaciones que ella establece con otras organizaciones (p&uacute;blicas, privadas o mixtas)
				y del grado de utilizaci&oacute;n de fuentes de informaci&oacute;n para proveerse de nuevas ideas para desarrollar o implementar
				innovaciones. Dichas relaciones pueden existir tanto con fuentes internas a la empresa, es decir grupos, departamentos o personas
				dentro de la misma empresa u otras empresas del mismo grupo; como con fuentes externas a la empresa, es decir, organizaciones o
				empresas que no pertenecen al grupo empresarial, o medios de informaci&oacute;n de libre acceso. </p> 
		</div>
		<div class="container text-justify" style="font-size: 12px">
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas encargadas de la gerencia de proyectos de
 			innovaci&oacute;n con conocimiento de los acuerdos (contractuales o no contractuales) que realiza la empresa a nivel interno y con
 			otras empresas o actores. 
 		</div>
		
		<input type="hidden" name="tipousu" id="idTipo" value="<?php echo $tipousu ?>" />
		<form class='form-horizontal' role='form' data-toggle='validator' name="capitulo5" id="capitulo5" method="post">
			<div class='container'>
				<input type="hidden" name="C5_nordemp" id="numero" value="<?php echo $numero ?>" />
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=v1&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> V.1 Se&ntilde;ale si las siguientes fuentes de informaci&oacute;n y conocimiento fueron
						o no importantes como origen de ideas para desarrollar o implementar servicios o bienes nuevos o significativamente
						mejorados, procesos nuevos o significativamente mejorados, m&eacute;todos organizativos nuevos, o t&eacute;cnicas de
						comercializaci&oacute;n nuevas, durante el per&iacute;odo <?php echo $anterior . "-" . $vig?> en su empresa. Si su respuesta
						es afirmativa para el caso de las fuentes externas, indique la procedencia sea nacional o extranjera.</b></h5>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 text-center'><b>Fuentes Internas a la Empresa</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn11">
							<b>1. </b>Departamento interno de  I + D
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv1r1c1' name='v1r1c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r1c12' name='v1r1c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn12">
							<b>2. </b>Departamento de producci&oacute;n
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv1r2c1' name='v1r2c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R2C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r2c12' name='v1r2c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R2C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn13">
							<b>3. </b>Departamento de ventas y mercadeo
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv1r3c1' name='v1r3c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R3C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r3c12' name='v1r3c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R3C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn14">
							<b>4. </b>Otro departamento de la empresa
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv1r4c1' name='v1r4c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R4C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r4c12' name='v1r4c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R4C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn15">
							<b>5. </b>Grupos interdisciplinarios espec&iacute;ficos para innovar
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv1r5c1' name='v1r5c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R5C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r5c12' name='v1r5c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R5C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn16">
							<b>6. </b>Directivos de la empresa
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv1r6c1' name='v1r6c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R6C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r6c12' name='v1r6c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R6C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn17">
							<b>7. </b>Otra empresa relacionada (si hace parte de un conglomerado)
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv1r7c1' name='v1r7c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R7C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r7c12' name='v1r7c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R7C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn18">
							<b>8. </b>Casa matriz extranjera
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv1r8c1' name='v1r8c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R8C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r8c12' name='v1r8c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R8C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 text-center'><b>Fuentes Externas a la Empresa</b></div>
						<div class='col-sm-3 small'></div>
						<div class='col-sm-3 small'><b>Procedencia</b></div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn19">
							<b>9. </b>Departamento I + D de otra empresa del sector
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r9c1' name='v1r9c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R9C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r9c12' name='v1r9c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R9C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r9c2' name='v1r9c2' value='1' <?php echo ($row['V1R9C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R9C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r9c3' name='v1r9c3' value='1' <?php echo ($row['V1R9C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R9C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn110">
							<b>10. </b>Competidores u otras empresas del sector (excepto el departamento de I + D)
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r10c1' name='v1r10c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R10C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r10c12' name='v1r10c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R10C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r10c2' name='v1r10c2' value='1' <?php echo ($row['V1R10C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R10C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r10c3' name='v1r10c3' value='1' <?php echo ($row['V1R10C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R10C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn111">
							<b>11. </b>Clientes
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r11c1' name='v1r11c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R11C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r11c12' name='v1r11c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R11C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r11c2' name='v1r11c2' value='1' <?php echo ($row['V1R11C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R11C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r11c3' name='v1r11c3' value='1' <?php echo ($row['V1R11C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R11C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn112">
							<b>12. </b>Proveedores
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r12c1' name='v1r12c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R12C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r12c12' name='v1r12c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R12C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r12c2' name='v1r12c2' value='1' <?php echo ($row['V1R12C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R12C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r12c3' name='v1r12c3' value='1' <?php echo ($row['V1R12C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R12C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn113">
							<b>13. </b>Empresas de otro sector
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r13c1' name='v1r13c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R13C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r13c12' name='v1r13c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R13C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r13c2' name='v1r13c2' value='1' <?php echo ($row['V1R13C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R13C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r13c3' name='v1r13c3' value='1' <?php echo ($row['V1R13C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R13C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn114">
							<b>14. </b>Agremiaciones y/o asociaciones sectoriales
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r14c1' name='v1r14c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R14C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r14c12' name='v1r14c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R14C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r14c2' name='v1r14c2' value='1' <?php echo ($row['V1R14C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R14C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r14c3' name='v1r14c3' value='1' <?php echo ($row['V1R14C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R14C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn115">
							<b>15. </b>C&aacute;maras de comercio
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r15c1' name='v1r15c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R15C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r15c12' name='v1r15c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R15C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r15c2' name='v1r15c2' value='1' <?php echo ($row['V1R15C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R15C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r15c3' name='v1r15c3' value='1' <?php echo ($row['V1R15C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R15C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn116">
							<b>16. </b>Centros de Desarrollo Tecnol&oacute;gico (CDT)
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r16c1' name='v1r16c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R16C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r16c12' name='v1r16c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R16C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r16c2' name='v1r16c2' value='1' <?php echo ($row['V1R16C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R16C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r16c3' name='v1r16c3' value='1' <?php echo ($row['V1R16C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R16C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn117">
							<b>17. </b>Centros de investigaci&oacute;n aut&oacute;nomos
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r17c1' name='v1r17c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R17C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r17c12' name='v1r17c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R17C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r17c2' name='v1r17c2' value='1' <?php echo ($row['V1R17C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R17C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r17c3' name='v1r17c3' value='1' <?php echo ($row['V1R17C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R17C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn118">
							<b>18. </b>Incubadoras de Empresas de Base Tecnol&oacute;gica (IEBT)
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r18c1' name='v1r18c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R18C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r18c12' name='v1r18c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R18C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r18c2' name='v1r18c2' value='1' <?php echo ($row['V1R18C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R18C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r18c3' name='v1r18c3' value='1' <?php echo ($row['V1R18C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R18C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn119">
							<b>19. </b>Parques tecnol&oacute;gicos
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r19c1' name='v1r19c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R19C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r19c12' name='v1r19c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R19C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r19c2' name='v1r19c2' value='1' <?php echo ($row['V1R19C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R19C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r19c3' name='v1r19c3' value='1' <?php echo ($row['V1R19C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R19C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn120">
							<b>20. </b>Centros regionales de productividad
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r20c1' name='v1r20c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R20C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r20c12' name='v1r20c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R20C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r20c2' name='v1r20c2' value='1' <?php echo ($row['V1R20C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R20C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r20c3' name='v1r20c3' value='1' <?php echo ($row['V1R20C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R20C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn121">
							<b>21. </b>Universidades
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r21c1' name='v1r21c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R21C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r21c12' name='v1r21c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R21C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r21c2' name='v1r21c2' value='1' <?php echo ($row['V1R21C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R21C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r21c3' name='v1r21c3' value='1' <?php echo ($row['V1R21C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R21C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn122">
							<b>22. </b>Centros de formaci&oacute;n y/o tecnoparques
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r22c1' name='v1r22c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R22C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r22c12' name='v1r22c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R22C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r22c2' name='v1r22c2' value='1' <?php echo ($row['V1R22C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R22C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r22c3' name='v1r22c3' value='1' <?php echo ($row['V1R22C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R22C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn123">
							<b>23. </b>Consultores, expertos o investigadores
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r23c1' name='v1r23c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R23C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r23c12' name='v1r23c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R23C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r23c2' name='v1r23c2' value='1' <?php echo ($row['V1R23C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R23C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r23c3' name='v1r23c3' value='1' <?php echo ($row['V1R23C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R23C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn124">
							<b>24. </b>Ferias y exposiciones
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r24c1' name='v1r24c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R24C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r24c12' name='v1r24c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R24C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r24c2' name='v1r24c2' value='1' <?php echo ($row['V1R24C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R24C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r24c3' name='v1r24c3' value='1' <?php echo ($row['V1R24C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R24C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn125">
							<b>25. </b>Seminarios y conferencias
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r25c1' name='v1r25c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R25C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r25c12' name='v1r25c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R25C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r25c2' name='v1r25c2' value='1' <?php echo ($row['V1R25C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R25C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r25c3' name='v1r25c3' value='1' <?php echo ($row['V1R25C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R25C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn126">
							<b>26. </b>Libros, revistas o cat&aacute;logos
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r26c1' name='v1r26c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R26C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r26c12' name='v1r26c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R26C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r26c2' name='v1r26c2' value='1' <?php echo ($row['V1R26C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R26C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r26c3' name='v1r26c3' value='1' <?php echo ($row['V1R26C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R26C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn127">
							<b>27. </b>Sistemas de informaci&oacute;n de propiedad industrial (banco de patentes)
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r27c1' name='v1r27c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R27C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r27c12' name='v1r27c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R27C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r27c2' name='v1r27c2' value='1' <?php echo ($row['V1R27C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R27C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r27c3' name='v1r27c3' value='1' <?php echo ($row['V1R27C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R27C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn128">
							<b>28. </b>Sistema de informaci&oacute;n de derechos de autor
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r28c1' name='v1r28c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R28C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r28c12' name='v1r28c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R28C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r28c2' name='v1r28c2' value='1' <?php echo ($row['V1R28C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R28C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r28c3' name='v1r28c3' value='1' <?php echo ($row['V1R28C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R28C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn129">
							<b>29. </b>Internet
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r29c1' name='v1r29c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R29C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r29c12' name='v1r29c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R29C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r29c2' name='v1r29c2' value='1' <?php echo ($row['V1R29C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R29C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r29c3' name='v1r29c3' value='1' <?php echo ($row['V1R29C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R29C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm' id="txtn130">
						<div class='col-sm-4 small' style='margin-left: 30px'>
							<b>30. </b>Bases de datos cient&iacute;ficas y tecnol&oacute;gicas
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r30c1' name='v1r30c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R30C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r30c12' name='v1r30c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R30C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r30c2' name='v1r30c2' value='1' <?php echo ($row['V1R30C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R30C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r30c3' name='v1r30c3' value='1' <?php echo ($row['V1R30C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R30C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn131">
							<b>31. </b>Normas y reglamentos t&eacute;cnicos
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r31c1' name='v1r31c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R31C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r31c12' name='v1r31c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R31C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r31c2' name='v1r31c2' value='1' <?php echo ($row['V1R31C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R31C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r31c3' name='v1r31c3' value='1' <?php echo ($row['V1R31C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R31C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-4 small' style='margin-left: 30px' id="txtn132">
							<b>32. </b>Instituciones p&uacute;blicas (ministerios, entidades descentralizadas, secretar&iacute;as)
						</div>
						<div class='col-sm-3 small'>
							<label class='radio-inline'><input type='radio' id='idv1r32c1' name='v1r32c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V1R32C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv1r32c12' name='v1r32c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V1R32C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
						<div class='col-sm-3 small'>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r32c2' name='v1r32c2' value='1' <?php echo ($row['V1R32C2'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R32C1'] == 1) ? '' : 'disabled' ?> />Nacional</label>
							<label class='checkbox-inline'><input type='checkbox' id='idv1r32c3' name='v1r32c3' value='1' <?php echo ($row['V1R32C3'] == 1) ? 'checked' : ''?> <?php echo ($row['V1R32C1'] == 1) ? '' : 'disabled' ?> />Extranjera</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iv2&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> V.2 Indique si durante el per&iacute;odo <?php echo $anterior . "-" . $vig?> su empresa tuvo
						relaci&oacute;n alguna con los siguientes actores del SNCTI, como apoyo para la realizaci&oacute;n de actividades cient&iacute;ficas,
						tecnol&oacute;gicas y de innovaci&oacute;n, en la b&uacute;squeda de servicios o bienes nuevos o significativamente
						mejorados, procesos nuevos o significativamente mejorados, m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de
						comercializaci&oacute;n nuevas.</b></h5>
						<p>Relaciones que apoyan la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n
						incluyen el intercambio de informaci&oacute;n acerca de pol&iacute;ticas, estrategias, programas o metodolog&iacute;as,
						como apoyo a la realizaci&oacute;n de ACTI; la transferencia de conocimiento, asesor&iacute;a, acompa&ntilde;amiento o
						financiaci&oacute;n para la planeaci&oacute;n o ejecuci&oacute;n de ACTI; la subcontrataci&oacute;n de servicios o trabajos
						necesarios para la realizaci&oacute;n de ACTI; y la participaci&oacute;n conjunta en procesos de concertaci&oacute;n,
						divulgaci&oacute;n o debates acerca del estado de la ciencia, tecnolog&iacute;a e innovaci&oacute;n.</p>
					</legend>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn21">
							<b>1. </b>Departamento Administrativo de Ciencia, Tecnolog&iacute;a e Innovaci&oacute;n (COLCIENCIAS)
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r1c1' name='v2r1c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R1C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r1c12' name='v2r1c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R1C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn22">
							<b>2. </b>SENA
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r2c1' name='v2r2c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R2C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r2c12' name='v2r2c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R2C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn23">
							<b>3. </b>ICONTEC
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r3c1' name='v2r3c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R3C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r3c12' name='v2r3c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R3C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn24">
							<b>4. </b>Superintendencia de Industria y Comercio (SIC)
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r4c1' name='v2r4c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R4C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r4c12' name='v2r4c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R4C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn25">
							<b>5. </b>Direcci&oacute;n nacional de derechos de autor
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r5c1' name='v2r5c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R5C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r5c12' name='v2r5c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R5C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn26">
							<b>6. </b>Ministerios
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r6c1' name='v2r6c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R6C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r6c12' name='v2r6c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R6C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn27">
							<b>7. </b>Universidades
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r7c1' name='v2r7c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R7C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r7c12' name='v2r7c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R7C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn28">
							<b>8. </b>Centros de Desarrollo Tecnol&oacute;gico (CDT)
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r8c1' name='v2r8c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R8C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r8c12' name='v2r8c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R8C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn29">
							<b>9. </b>Centros de Investigaci&oacute;n Aut&oacute;nomos
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r9c1' name='v2r9c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R9C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r9c12' name='v2r9c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R9C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn210">
							<b>10. </b>Incubadoras de Empresas de Base Tecnol&oacute;gica (IEBT)
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r10c1' name='v2r10c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R10C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r10c12' name='v2r10c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R10C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn211">
							<b>11. </b>Parques Tecnol&oacute;gicos
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r11c1' name='v2r11c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R11C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r11c12' name='v2r11c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R11C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn212">
							<b>12. </b>Centros Regionales de Productividad
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r12c1' name='v2r12c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R12C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r12c12' name='v2r12c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R12C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn213">
							<b>13. </b>Consejos Departamentales de Ciencia y Tecnolog&iacute;a (CODECyT)
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r13c1' name='v2r13c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R13C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r13c12' name='v2r13c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R13C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn214">
							<b>14. </b>Comisiones Regionales de Competitividad
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r14c1' name='v2r14c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R14C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r14c12' name='v2r14c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R14C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn215">
							<b>15. </b>Agremiaciones Sectoriales y C&aacute;maras de Comercio
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r15c1' name='v2r15c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R15C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r15c12' name='v2r15c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R15C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn216">
							<b>16. </b>Consultores en Innovaci&oacute;n y Desarrollo Tecnol&oacute;gico
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r16c1' name='v2r16c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R16C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r16c12' name='v2r16c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R16C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn217">
							<b>17. </b>PROEXPORT - PROCOLOMBIA
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r17c1' name='v2r17c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R17C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r17c12' name='v2r17c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R17C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn218">
							<b>18. </b>BANCOLDEX
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r18c1' name='v2r18c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R18C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r18c12' name='v2r18c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R18C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-6 small' style='margin-left: 30px' id="txtn219">
							<b>19. </b>Entidades de formaci&oacute;n t&eacute;cnica y tecnol&oacute;gica (distintas al SENA)
						</div>
						<div class='col-sm-4 small'>
							<label class='radio-inline'><input type='radio' id='idv2r19c1' name='v2r19c1' <?php echo $estadoV1 ?> value = '1' <?php echo ($row['V2R19C1'] == 1) ? 'checked' : ''?> />SI</label>
							<label class='radio-inline'><input type='radio' id='idv2r19c12' name='v2r19c1' <?php echo $estadoV1 ?> value = '2' <?php echo ($row['V2R19C1'] == 2) ? 'checked' : ''?> />NO</label>
						</div>
					</div>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<legend><h5 style='font-family: arial'><b><?php echo ($consLog ? "<a href='../administracion/listaLog.php?idl=iv3&numfte=" . $numero . "' title='Control Cambios' target='_blank'>" . $cLog . "</a>" : '') ?> V.3 En el per&iacute;odo <?php echo $anterior . "-" . $vig?>, &iquest;Su empresa cooper&oacute;
						con alguno de los siguientes tipos de socios para la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas
						y de innovaci&oacute;n?. Si su respuesta es afirmativa, se&ntilde;ale la ubicaci&oacute;n del socio, ya sea nacional o extranjero, y el
						objetivo de la cooperaci&oacute;n.</b></h5>
					</legend>
					<p>Cooperaci&oacute;n para la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n,
						significa la participaci&oacute;n activa con otras empresas o entidades no comerciales en proyectos conjuntos de I+D u otro
						tipo de actividades como las descritas en el Cap&iacute;tulo II de esta encuesta. No implica necesariamente que las dos
						partes obtengan beneficios econ&oacute;micos de la cooperaci&oacute;n. Se excluye la simple contrataci&oacute;n de servicios
						o trabajos de otra organizaci&oacute;n sin cooperaci&oacute;n activa.</p>
					<div class='form-group form-group-sm'>
						<div class='col-sm-3 small text-center'><b>Tipos de socios</b></div>
						<div class='col-sm-1 small'><b>Nal-Ext</b></div>
						<div class='col-sm-1 small' style="font-size: 10px;">Investigaci&oacute;n y desarrollo (I+D)</div>
						<div class='col-sm-1 small' style="font-size: 10px;">Adquisici&oacute;n de maquinaria y equipo</div>
						<div class='col-sm-1 small' style="font-size: 10px;">Tecnolog&iacute;as de informaci&oacute;n y telecomunicaciones</div>
						<div class='col-sm-1 small' style="font-size: 10px;">Mercadotecnia</div>
						<div class='col-sm-1 small' style="font-size: 10px;">Transf. de tecnolog&iacute;a y/o adqui. de otros conocimientos externos</div>
						<div class='col-sm-1 small' style="font-size: 10px;">Asistencia t&eacute;cnica y consultor&iacute;a</div>
						<div class='col-sm-1 small' style="font-size: 10px;">Ingenier&iacute;a y dise&ntilde;o industrial</div>
						<div class='col-sm-1 small' style="font-size: 10px;">Formaci&oacute;n y capacitaci&oacute;n</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn31"><b>1. </b>Otras empresas del mismo grupo (conglomerado)</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r1c1' id='idv3r1c1' <?php echo $estadoV3 ?> >
							    <?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R1C1'] != 1 OR $row['V3R1C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R1C1'] != 1 OR $row['V3R1C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php }?>
								<option value="1" <?php echo ($row['V3R1C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R1C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r1c2' name='v3r1c2' value='1' <?php echo ($row['V3R1C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R1C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r1c3' name='v3r1c3' value='1' <?php echo ($row['V3R1C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R1C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r1c4' name='v3r1c4' value='1' <?php echo ($row['V3R1C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R1C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r1c5' name='v3r1c5' value='1' <?php echo ($row['V3R1C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R1C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r1c6' name='v3r1c6' value='1' <?php echo ($row['V3R1C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R1C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r1c7' name='v3r1c7' value='1' <?php echo ($row['V3R1C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R1C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r1c8' name='v3r1c8' value='1' <?php echo ($row['V3R1C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R1C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r1c9' name='v3r1c9' value='1' <?php echo ($row['V3R1C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R1C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r1c10' name='v3r1c10' value='1' <?php echo ($row['V3R1C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R1C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r1c11' name='v3r1c11' value='1' <?php echo ($row['V3R1C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R1C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn32"><b>2. </b>Proveedores</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r2c1' id='idv3r2c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R2C1'] != 1 OR $row['V3R2C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R2C1'] != 1 OR $row['V3R2C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php }?>
								<option value="1" <?php echo ($row['V3R2C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R2C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r2c2' name='v3r2c2' value='1' <?php echo ($row['V3R2C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R2C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r2c3' name='v3r2c3' value='1' <?php echo ($row['V3R2C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R2C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r2c4' name='v3r2c4' value='1' <?php echo ($row['V3R2C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R2C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r2c5' name='v3r2c5' value='1' <?php echo ($row['V3R2C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R2C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r2c6' name='v3r2c6' value='1' <?php echo ($row['V3R2C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R2C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r2c7' name='v3r2c7' value='1' <?php echo ($row['V3R2C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R2C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r2c8' name='v3r2c8' value='1' <?php echo ($row['V3R2C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R2C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r2c9' name='v3r2c9' value='1' <?php echo ($row['V3R2C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R2C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r2c10' name='v3r2c10' value='1' <?php echo ($row['V3R2C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R2C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r2c11' name='v3r2c11' value='1' <?php echo ($row['V3R2C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R2C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn33"><b>3. </b>Clientes</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r3c1' id='idv3r3c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R3C1'] != 1 OR $row['V3R3C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R3C1'] != 1 OR $row['V3R3C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php }?>
								<option value="1" <?php echo ($row['V3R3C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R3C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r3c2' name='v3r3c2' value='1' <?php echo ($row['V3R3C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R3C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r3c3' name='v3r3c3' value='1' <?php echo ($row['V3R3C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R3C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r3c4' name='v3r3c4' value='1' <?php echo ($row['V3R3C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R3C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r3c5' name='v3r3c5' value='1' <?php echo ($row['V3R3C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R3C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r3c6' name='v3r3c6' value='1' <?php echo ($row['V3R3C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R3C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r3c7' name='v3r3c7' value='1' <?php echo ($row['V3R3C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R3C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r3c8' name='v3r3c8' value='1' <?php echo ($row['V3R3C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R3C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r3c9' name='v3r3c9' value='1' <?php echo ($row['V3R3C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R3C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r3c10' name='v3r3c10' value='1' <?php echo ($row['V3R3C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R3C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r3c11' name='v3r3c11' value='1' <?php echo ($row['V3R3C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R3C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn34"><b>4. </b>Competidores</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r4c1' id='idv3r4c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R4C1'] != 1 OR $row['V3R4C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R4C1'] != 1 OR $row['V3R4C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php }?>
								<option value="1" <?php echo ($row['V3R4C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R4C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r4c2' name='v3r4c2' value='1' <?php echo ($row['V3R4C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R4C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r4c3' name='v3r4c3' value='1' <?php echo ($row['V3R4C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R4C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r4c4' name='v3r4c4' value='1' <?php echo ($row['V3R4C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R4C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r4c5' name='v3r4c5' value='1' <?php echo ($row['V3R4C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R4C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r4c6' name='v3r4c6' value='1' <?php echo ($row['V3R4C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R4C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r4c7' name='v3r4c7' value='1' <?php echo ($row['V3R4C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R4C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r4c8' name='v3r4c8' value='1' <?php echo ($row['V3R4C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R4C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r4c9' name='v3r4c9' value='1' <?php echo ($row['V3R4C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R4C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r4c10' name='v3r4c10' value='1' <?php echo ($row['V3R4C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R4C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r4c11' name='v3r4c11' value='1' <?php echo ($row['V3R4C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R4C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn35"><b>5. </b>Consultores, expertos o investigadores</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r5c1' id='idv3r5c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R5C1'] != 1 OR $row['V3R5C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R5C1'] != 1 OR $row['V3R5C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php }?>
								<option value="1" <?php echo ($row['V3R5C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R5C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r5c2' name='v3r5c2' value='1' <?php echo ($row['V3R5C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R5C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r5c3' name='v3r5c3' value='1' <?php echo ($row['V3R5C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R5C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r5c4' name='v3r5c4' value='1' <?php echo ($row['V3R5C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R5C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r5c5' name='v3r5c5' value='1' <?php echo ($row['V3R5C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R5C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r5c6' name='v3r5c6' value='1' <?php echo ($row['V3R5C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R5C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r5c7' name='v3r5c7' value='1' <?php echo ($row['V3R5C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R5C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r5c8' name='v3r5c8' value='1' <?php echo ($row['V3R5C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R5C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r5c9' name='v3r5c9' value='1' <?php echo ($row['V3R5C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R5C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r5c10' name='v3r5c10' value='1' <?php echo ($row['V3R5C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R5C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r5c11' name='v3r5c11' value='1' <?php echo ($row['V3R5C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R5C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn36"><b>6. </b>Universidades</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r6c1' id='idv3r6c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R6C1'] != 1 OR $row['V3R6C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R6C1'] != 1 OR $row['V3R6C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php }?>
								<option value="1" <?php echo ($row['V3R6C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R6C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r6c2' name='v3r6c2' value='1' <?php echo ($row['V3R6C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R6C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r6c3' name='v3r6c3' value='1' <?php echo ($row['V3R6C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R6C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r6c4' name='v3r6c4' value='1' <?php echo ($row['V3R6C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R6C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r6c5' name='v3r6c5' value='1' <?php echo ($row['V3R6C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R6C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r6c6' name='v3r6c6' value='1' <?php echo ($row['V3R6C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R6C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r6c7' name='v3r6c7' value='1' <?php echo ($row['V3R6C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R6C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r6c8' name='v3r6c8' value='1' <?php echo ($row['V3R6C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R6C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r6c9' name='v3r6c9' value='1' <?php echo ($row['V3R6C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R6C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r6c10' name='v3r6c10' value='1' <?php echo ($row['V3R6C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R6C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r6c11' name='v3r6c11' value='1' <?php echo ($row['V3R6C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R6C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn37"><b>7. </b>Centros de desarrollo tecnol&oacute;gico</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r7c1' id='idv3r7c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R7C1'] != 1 OR $row['V3R7C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R7C1'] != 1 OR $row['V3R7C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php }?>
								<option value="1" <?php echo ($row['V3R7C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R7C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r7c2' name='v3r7c2' value='1' <?php echo ($row['V3R7C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R7C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r7c3' name='v3r7c3' value='1' <?php echo ($row['V3R7C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R7C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r7c4' name='v3r7c4' value='1' <?php echo ($row['V3R7C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R7C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r7c5' name='v3r7c5' value='1' <?php echo ($row['V3R7C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R7C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r7c6' name='v3r7c6' value='1' <?php echo ($row['V3R7C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R7C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r7c7' name='v3r7c7' value='1' <?php echo ($row['V3R7C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R7C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r7c8' name='v3r7c8' value='1' <?php echo ($row['V3R7C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R7C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r7c9' name='v3r7c9' value='1' <?php echo ($row['V3R7C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R7C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r7c10' name='v3r7c10' value='1' <?php echo ($row['V3R7C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R7C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r7c11' name='v3r7c11' value='1' <?php echo ($row['V3R7C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R7C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn38"><b>8. </b>Centros de investigaci&oacute;n aut&oacute;nomos</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r8c1' id='idv3r8c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R8C1'] != 1 OR $row['V3R8C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R8C1'] != 1 OR $row['V3R8C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } ?>
								<option value="1" <?php echo ($row['V3R8C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R8C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r8c2' name='v3r8c2' value='1' <?php echo ($row['V3R8C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R8C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r8c3' name='v3r8c3' value='1' <?php echo ($row['V3R8C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R8C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r8c4' name='v3r8c4' value='1' <?php echo ($row['V3R8C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R8C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r8c5' name='v3r8c5' value='1' <?php echo ($row['V3R8C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R8C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r8c6' name='v3r8c6' value='1' <?php echo ($row['V3R8C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R8C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r8c7' name='v3r8c7' value='1' <?php echo ($row['V3R8C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R8C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r8c8' name='v3r8c8' value='1' <?php echo ($row['V3R8C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R8C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r8c9' name='v3r8c9' value='1' <?php echo ($row['V3R8C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R8C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r8c10' name='v3r8c10' value='1' <?php echo ($row['V3R8C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R8C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r7c11' name='v3r8c11' value='1' <?php echo ($row['V3R8C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R8C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn39"><b>9. </b>Parques tecnol&oacute;gicos</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r9c1' id='idv3r9c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R9C1'] != 1 OR $row['V3R9C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R9C1'] != 1 OR $row['V3R9C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } ?>
								<option value="1" <?php echo ($row['V3R9C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R9C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r9c2' name='v3r9c2' value='1' <?php echo ($row['V3R9C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R9C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r9c3' name='v3r9c3' value='1' <?php echo ($row['V3R9C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R9C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r9c4' name='v3r9c4' value='1' <?php echo ($row['V3R9C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R9C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r9c5' name='v3r9c5' value='1' <?php echo ($row['V3R9C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R9C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r9c6' name='v3r9c6' value='1' <?php echo ($row['V3R9C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R9C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r9c7' name='v3r9c7' value='1' <?php echo ($row['V3R9C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R9C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r9c8' name='v3r9c8' value='1' <?php echo ($row['V3R9C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R9C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r9c9' name='v3r9c9' value='1' <?php echo ($row['V3R9C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R9C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r9c10' name='v3r9c10' value='1' <?php echo ($row['V3R9C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R9C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r9c11' name='v3r9c11' value='1' <?php echo ($row['V3R9C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R9C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn310"><b>10. </b>Centros regionales de productividad</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r10c1' id='idv3r10c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R10C1'] != 1 OR $row['V3R10C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R10C1'] != 1 OR $row['V3R10C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } ?>
								<option value="1" <?php echo ($row['V3R10C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R10C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r10c2' name='v3r10c2' value='1' <?php echo ($row['V3R10C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R10C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r10c3' name='v3r10c3' value='1' <?php echo ($row['V3R10C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R10C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r10c4' name='v3r10c4' value='1' <?php echo ($row['V3R10C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R10C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r10c5' name='v3r10c5' value='1' <?php echo ($row['V3R10C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R10C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r10c6' name='v3r10c6' value='1' <?php echo ($row['V3R10C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R10C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r10c7' name='v3r10c7' value='1' <?php echo ($row['V3R10C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R10C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r10c8' name='v3r10c8' value='1' <?php echo ($row['V3R10C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R10C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r10c9' name='v3r10c9' value='1' <?php echo ($row['V3R10C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R10C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r10c10' name='v3r10c10' value='1' <?php echo ($row['V3R10C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R10C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r10c11' name='v3r10c11' value='1' <?php echo ($row['V3R10C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R10C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn311"><b>11. </b>Organizaciones no gubernamentales</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r11c1' id='idv3r11c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R11C1'] != 1 OR $row['V3R11C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R11C1'] != 1 OR $row['V3R11C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } ?>
								<option value="1" <?php echo ($row['V3R11C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R11C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r11c2' name='v3r11c2' value='1' <?php echo ($row['V3R11C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R11C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r11c3' name='v3r11c3' value='1' <?php echo ($row['V3R11C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R11C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r11c4' name='v3r11c4' value='1' <?php echo ($row['V3R11C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R11C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r11c5' name='v3r11c5' value='1' <?php echo ($row['V3R11C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R11C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r11c6' name='v3r11c6' value='1' <?php echo ($row['V3R11C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R11C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r11c7' name='v3r11c7' value='1' <?php echo ($row['V3R11C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R11C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r11c8' name='v3r11c8' value='1' <?php echo ($row['V3R11C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R11C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r11c9' name='v3r11c9' value='1' <?php echo ($row['V3R11C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R11C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r11c10' name='v3r11c10' value='1' <?php echo ($row['V3R11C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R11C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r11c11' name='v3r11c11' value='1' <?php echo ($row['V3R11C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R11C1'] == 1) ? '' : 'disabled' ?> />
						</div>
					</div>
					<div class='form-group form-group-sm'>
						<div class='col-sm-2 small' style="margin-left: 20px; font-size: 10px;" id="txtn312"><b>12. </b>Gobierno</div>
						<div class='col-sm-1 small'>
							<select class='form-control' name = 'v3r12c1' id='idv3r12c1' <?php echo $estadoV3 ?> >
								<?php if($estadoV3=="disabled"){  ?>
									<option value="" <?php echo ($row['V3R12C1'] != 1 OR $row['V3R12C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } else{  ?>
									<option value="0" <?php echo ($row['V3R12C1'] != 1 OR $row['V3R12C1'] != 2) ? 'selected' : ''?>>--</option>
								<?php } ?>
								<option value="1" <?php echo ($row['V3R12C1'] == 1) ? 'selected' : ''?>>SI</option>
								<option value="2" <?php echo ($row['V3R12C1'] == 2) ? 'selected' : ''?>>NO</option>
							</select>
						</div>
						<div class='col-sm-1 small'>
							<input type='checkbox' id='idv3r12c2' name='v3r12c2' value='1' <?php echo ($row['V3R12C2'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Nacional" <?php echo ($row['V3R12C1'] == 1) ? '' : 'disabled' ?> />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='checkbox' id='idv3r12c3' name='v3r12c3' value='1' <?php echo ($row['V3R12C3'] == 1) ? 'checked' : ''?> data-toggle="tooltip" title="Extranjero" <?php echo ($row['V3R12C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r12c4' name='v3r12c4' value='1' <?php echo ($row['V3R12C4'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R12C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r12c5' name='v3r12c5' value='1' <?php echo ($row['V3R12C5'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R12C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r12c6' name='v3r12c6' value='1' <?php echo ($row['V3R12C6'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R12C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r12c7' name='v3r12c7' value='1' <?php echo ($row['V3R12C7'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R12C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r12c8' name='v3r12c8' value='1' <?php echo ($row['V3R12C8'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R12C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r12c9' name='v3r12c9' value='1' <?php echo ($row['V3R12C9'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R12C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r12c10' name='v3r12c10' value='1' <?php echo ($row['V3R12C10'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R12C1'] == 1) ? '' : 'disabled' ?> />
						</div>
						<div class='col-sm-1 small' style="width: 94px">
							<input type='checkbox' id='idv3r12c11' name='v3r12c11' value='1' <?php echo ($row['V3R12C11'] == 1) ? 'checked' : ''?> <?php echo ($row['V3R12C1'] == 1) ? '' : 'disabled' ?> />
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
						<p class='bg-success text-center text-uppercase' style='display: none' id='idmsg'>Cap&iacute;tulo V Actualizado Correctamente</p>
					</div>
					<div class='col-sm-1 small pull-right' id="btn_cont" style="display: none;" >
						<a href='capitulo6.php?numord=<?php echo $numero . "&nombre=" . $nombre?>' class='btn btn-default' data-toggle='tooltip' title='Ir a siguiente cap&iacute;tulo'>Continuar</a>
					</div>
					<div class='col-sm-1 small pull-right'>
						<button type='submit' class='btn btn-primary btn-md' data-toggle='tooltip' title='Actualizar informaci&oacute;n Cap&iacute;tulo III'>Grabar</button>
					</div>
				</div>
				<?php } ?>
			</div>  
 		</form>
		<?php } ?>
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
        					<h4 class="modal-title">RECOMENDACIONES PARA UN BUEN PROCESO DE CR&Iacute;TICA EN EL CAP&Iacute;TULO V</h4>
      				</div>
      				<div class="modal-body">
        				<ol style='text-align: justify; font-family: arial'>
						<li>Las fuentes <b>INNOVADORAS</b> deben marcar afirmativo por lo menos una fuente de ideas, se recomienda revisar y corregir si es
							el caso.
						<li>Revisar que las fuentes de ideas externas tengan marcada la <b>PROCEDENCIA</b> (nacional y/o extranjera) de cada una de estas.
						<li>Las fuentes que marquen cooperaci&oacute;n con alg&uacute;n tipo de socio deben tener marcada el <b>OBJETIVO</b> de cada una de estas.
						<li>Revisar fuentes peque&ntilde;as que marcaron <b>CASA MATRIZ y/o DEPARTAMENTO INTERNO DE I+D.</b>
						<li>Realizar observaciones claras, <b>NO DEJAR NOTAS</b> como datos ok, datos verificados, etc. en lo posible indicar el nombre y
							cargo  de la persona que suministra la informaci&oacute;n.
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
