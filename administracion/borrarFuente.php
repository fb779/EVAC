<?php
	if (session_id() == "") {
		session_start();
	}
	include '../conecta.php';
	$region = $_SESSION['region'];
	$vig = $_SESSION['vigencia'];
	
	if($_REQUEST['nordemp']){
		$qborrar = $conn->prepare("UPDATE control SET usuarioss = '' WHERE usuarioss = '".$_REQUEST['ususario']."' AND nordemp=".$_REQUEST['nordemp']."");
		$qborrar->execute();
		
		if($qborrar==true){
			$mensaje="LA FUENTE ".$_REQUEST['nordemp']." ASIGNADA AL USUARIO ".$_REQUEST['ususario']."  HA SIDO BORRADA EXITOSAMENTE.";
			$html="<script>alert('".$mensaje."');</script>";
			echo $html;
			echo "Redireccionando.";
			// $indice = $registro[0][10];
			echo "<script language=\"Javascript\">history.go(-1);</script>";
		}
		else
		{	
			$mensaje="No se pudo borrar la fuente, revise que la fuente ya est&eacute; registrada en el sistema!!.";
			 
			$html="<script>alert('".$mensaje."');</script>";
			echo $html;
			echo "Redireccionando.";
			// $indice = $registro[0][10];
			echo "<script language=\"Javascript\">history.go(-1);</script>"; 
		}	
	}
?>
