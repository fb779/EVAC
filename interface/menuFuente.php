<?php
	$estadoMenu = "";
	$color1=""; $color2=""; $color3=""; $color4=""; $color5=""; $color6="";
	$icono1=""; $icono2=""; $icono3=""; $icono4=""; $icono5=""; $icono6="";
// 	$muestrapys = false;
    /* Activa el iconop y cambia el color a verde cuando se ha guardado el formulario */
	if ($rowCtl['estado']>=3 && $rowCtl['m1']==2) {
		$color1 = "OK";
		$icono1 = "SI";
	}
	$txtColor = "style='color: green'";
	$icono = "<span class='glyphicon glyphicon-ok' style='color: green'></span>";

	$qCtl = $conn->query("SELECT estado FROM control WHERE nordemp = $numero AND vigencia = $vig")->fetch(PDO::FETCH_ASSOC);
	if (count($qCtl) > 0){
		$estado = $qCtl['estado'];
	}else{
		$estado = 0;
	}
?>
<nav class="navbar navbar-default navbar-fixed-top small">
	<div class="container-fluid">
    	<div class="navbar-header">
    		<?php
    			if ($tipousu == "FU") {
    				echo "<span class='navbar-brand small' style='font-size: 12px'>ENCUESTA DE VACANTES - EVAC </span>";
    			}
    			else {
    				echo "<span class='navbar-brand small' style='font-size: 12px'><a href='../administracion/operativo.php'>ENCUESTA DE VACANTES - EVAC </a></span>";
    			}
    		?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        	<ul class="nav navbar-nav">
            	<li <?php echo ($page=='cara') ? 'class="active"' : '' ?>><a href="caratula.php?numero=<?php echo $numero ?>">Car&aacute;tula &Uacute;nica</a></li>
            	<li <?php echo ($page=='cap1') ? 'class="active"' : '' ?>><a href="capitulo1.php?numord=<?php echo $numero . "&nombre=" . $nombre?>" <?php echo ($color1 == "OK") ? $txtColor : ''?> >Modulo 1<?php echo ($icono1 == "SI") ? $icono : ''?></a></li>
            	<!-- li <?php echo ($page=='cap2') ? 'class="active"' : '' ?>><a href="capitulo2.php?numord=<?php echo $numero . "&nombre=" . $nombre?>" <?php echo ($color2 == "OK") ? $txtColor : ''?> >Modulo 2<?php echo ($icono2 == "SI") ? $icono : ''?></a></li>
            	<li <?php echo ($page=='cap3') ? 'class="active"' : '' ?>><a href="capitulo3.php?numord=<?php echo $numero . "&nombre=" . $nombre?>" <?php echo ($color3 == "OK") ? $txtColor : ''?> >Modulo 3<?php echo ($icono3 == "SI") ? $icono : ''?></a></li>
            	<li <?php echo ($page=='cap4') ? 'class="active"' : '' ?>><a href="capitulo4.php?numord=<?php echo $numero . "&nombre=" . $nombre?>" <?php echo ($color4 == "OK") ? $txtColor : ''?> >Modulo 4<?php echo ($icono4 == "SI") ? $icono : ''?></a></li>
            	<li <?php echo ($page=='cap5') ? 'class="active"' : '' ?>><a href="capitulo5.php?numord=<?php echo $numero . "&nombre=" . $nombre?>" <?php echo ($color5 == "OK") ? $txtColor : ''?> >Modulo 5<?php echo ($icono5 == "SI") ? $icono : ''?></a></li>
            	<li <?php echo ($page=='cap6') ? 'class="active"' : '' ?>><a href="capitulo6.php?numord=<?php echo $numero . "&nombre=" . $nombre?>" <?php echo ($color6 == "OK") ? $txtColor : ''?> >Modulo 6<?php echo ($icono6 == "SI") ? $icono : ''?></a></li>
            	<li <?php echo ($page=='cap7') ? 'class="active"' : '' ?>><a href="capitulo7.php?numord=<?php echo $numero . "&nombre=" . $nombre?>">Evaluaci&oacute;n</a></li-->

				<?php
					if($estado>4){
						echo "<li><a href='../administracion/registro.php?numord=" . $numero . "'>PAZ Y SALVO</a></li>";
					}
            		if ($tipousu != "FU") {
						if ($page!="cara") {
							//echo "<li><a href='#' data-toggle='modal' data-target='#idediteas'>EDIT-EAS</a></li>";
							echo "<li><a href='observa.php?numord=" . $numero . "&capit=" . $page . "' target='_blank'>Observaciones</a></li>";
						}
            		}
            	?>
          	</ul>
          	<ul class="nav navbar-nav navbar-right">
          		<?php if ($estado>3) { ?>
          			<li><a href="aPDF.php?numord=<?php echo $numero ; ?>">Form. Diligenciado</a></li>
          			<!-- <li><a href="formDili.php?numord=<?php echo $numero . "&nombre=" . $nombre?>">Form. Diligenciado</a></li> -->
          		<?php } ?>
            	<li><a href="../administracion/cambioclave.php">Cambiar Clave</a></li>
            	<li><a href="../index.php">Finalizar Sesi&oacute;n <span class="sr-only">(current)</span></a></li>
        	</ul>
       </div><!--/.nav-collapse -->
	</div>
</nav>
<?php
	 if ($tipousu != "FU" AND $region != 99) {
		echo "<script type='text/javascript'>";
		echo "$(function() {";
		echo "$(window).load(function(){";
		echo "$('#avisoCrit').modal('show');";
		echo "});});";
		echo "</script>";
	}
?>
