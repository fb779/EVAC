<?php
	$bloquear = false;
	$qCap2 = $conn->query("SELECT * FROM capitulo_ii WHERE vigencia = $vig AND C2_nordemp = $numero");
	foreach ($qCap2 AS $row2) {
		$a=1;
	}
	$qCap1 = $conn->query("SELECT * FROM capitulo_i WHERE vigencia = $vig AND C1_nordemp = $numero");
	foreach ($qCap1 AS $row1) {
		$a=1;
	}
	if ($row1['I1R1C1N']!=1 AND $row1['I1R2C1N']!=1 AND $row1['I1R3C1N']!=1 AND $row1['I1R1C1M']!=1 AND $row1['I1R2C1M']!=1 AND $row1['I1R3C1M']!=1
			AND $row1['I1R4C1']!=1 AND $row1['I1R5C1']!=1 AND $row1['I1R6C1']!=1 AND $row1['I5R1C1']!=1 AND $row1['I6R1C1']!=1) {
			$bloquear = true;
	}
?>
 		<?php
 			if ($bloquear) {
 				echo "<h3>No requiere diligenciamiento</h3>";
 				echo "<div class='nvapag'></div>";
 			}
 			else {
 		?>
 		<div class="container text-justify" style="font-size: 9px">
 			<b>CAP&Iacute;TULO II - INVERSI&Oacute;N EN ACTIVIDADES CIENT&Iacute;FICAS, TECNOL&Oacute;GICAS Y DE INNOVACI&Oacute;N EN LOS A&Ntilde;OS - <?php echo $anterior . "-" . $vig ?></b><br>
			Las Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n (ACTI) son todas aquellas actividades que la empresa
			realiza para producir, promover, difundir y/o aplicar conocimientos cient&iacute;ficos y t&eacute;cnicos; as&iacute; como tambi&eacute;n
			para el desarrollo o introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados, de procesos nuevos o
			significativamente mejorados, de m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de comercializaci&oacute;n nuevas.<br><br> 
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas del &aacute;rea financiera y que conozcan las
 				inversiones y gastos de la empresa en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n 
 		</div>
		<form class='form-horizontal' role='form'>
			<div class='container' style='font-family: arial; font-size: 9px'>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>II.1 Indique el valor invertido por su empresa en los a&ntilde;os
						<?php echo $anterior . "-" . $vig?>, en cada una de las siguientes actividades cient&iacute;ficas, tecnol&oacute;gicas
						y de innovaci&oacute;n, para la introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados,
						y/o la implementaci&oacute;n de procesos nuevos o significativamente mejorados, de m&eacute;todos organizativos nuevos,
						o de t&eacute;cnicas de comercializaci&oacute;n nuevas.</b></h5>
					<table>					
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'><b>Monto invertido <?php echo $anterior?></b></td>
							<td style='padding: 5px'><b>Monto invertido <?php echo $vig?></b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Actividades de I+D Internas.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R1C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R1C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Adquisici&oacute;n de I+D (externa).</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R2C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R2C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Adquisici&oacute;n de maquinaria y equipo.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R3C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R3C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Tecnolog&iacute;as de informaci&oacute;n y telecomunicaciones.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R4C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R4C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Mercadotecnia.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R5C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R5C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>Transferencia de tecnolog&iacute;a y/o adquisici&oacute;n de otros conocimientos externos.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R6C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R6C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>7. </b>Asistencia t&eacute;cnica y consultor&iacute;a.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R7C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R7C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>8. </b>Ingenier&iacute;a y dise&ntilde;o industrial.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R8C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R8C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>9. </b>Formaci&oacute;n y capacitaci&oacute;n.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R9C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R9C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px; text-align: right'><b>TOTAL MONTO INVERTIDO.</b></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R10C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II1R10C2']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>II.2 &iquest;Su empresa realiz&oacute; actividades relacionadas con biotecnolog&iacute;a
						durante el per&iacute;odo <?php echo $anterior . "-" . $vig?>?</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>
								Biotecnolog&iacute;a es la aplicaci&oacute;n de la ciencia y la tecnolog&iacute;a a organismos vivos, as&iacute; como
								partes, productos y modelos de los mismos, para alterar materiales vivos o no, con el fin de producir conocimientos,
								bienes o servicios.
							</td>
						<tr>
							<td style='padding: 5px'><?php echo ($row2['II2R1C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>II.3 Del valor total invertido en ACTI (pregunta II.1), indique el monto correspondiente
						a actividades relacionadas con Biotecnolog&iacute;a realizadas por su empresa en los a&ntilde;os <?php echo $anterior . "-" . $vig?>.</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'><b>Monto invertido <?php echo $anterior?></b></td>
							<td style='padding: 5px'><b>Monto invertido <?php echo $vig?></b></td>
						</tr>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II3R1C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row2['II3R1C2']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h4 style='font-family: arial'>Observaciones</h4>
					<textarea class='form-control' rows='2' name='observaciones' id='obsfte' <?php echo $estadObs ?>><?php echo $row2['OBSERVACIONES'] ?></textarea>
				</fieldset>
			</div>
 		</form>
 		<div class='nvapag'></div>
 		<?php }?>
