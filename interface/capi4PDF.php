<?php
	$qCap4 = $conn->query("SELECT * FROM capitulo_iv WHERE vigencia = $vig AND C4_nordemp = $numero");
	foreach ($qCap4 AS $row4) {
		$a=1;
	}
?>
 		<div class="container text-justify" style="font-size: 9px">
 			<b>CAP&Iacute;TULO IV - PERSONAL OCUPADO PROMEDIO EN RELACI&Oacute;N CON ACTI DURANTE LOS A&Ntilde;OS <?php echo $anterior . "-" . $vig ?></b><br>
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
		<form class='form-horizontal' role='form'>
			<div class='container'>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>VI.1 Indique el personal ocupado promedio que labor&oacute; en su empresa en los a&ntilde;os
						<?php echo $anterior . '-' . $vig?>. De &eacute;ste, especifique el n&uacute;mero que particip&oacute; en la realizaci&oacute;n de actividades
						cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en los a&ntilde;os <?php echo $anterior . '-' . $vig?>, de acuerdo con
						el m&aacute;ximo nivel educativo alcanzado y con t&iacute;tulo obtenido.</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'><b>M&aacute;ximo nivel educativo alcanzado</b></td>
							<td colspan='2' style='padding: 5px'>Personal ocupado promedio (tiempo completo, permanente y temporal)</td>
							<td colspan='2'style='padding: 5px'>Personal ocupado promedio que particip&oacute; en la realizaci&oacute;n de actividades
								cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n</td>
						</tr>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px; text-align: right'><b><?php echo $anterior?></b></td>
							<td style='padding: 5px; text-align: right'><b><?php echo $vig?></b></td>
							<td style='padding: 5px; text-align: right'><b><?php echo $anterior?></b></td>
							<td style='padding: 5px; text-align: right'><b><?php echo $vig?></b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Doctorado</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R1C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R1C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R1C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R1C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Maestr&iacute;a</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R2C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R2C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R2C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R2C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Especializaci&oacute;n</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R3C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R3C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R3C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R3C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Universitario (Profesional)</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R4C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R4C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R4C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R4C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Tecno&oacute;logo</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R5C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R5C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R5C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R5C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>T&eacute;cnico profesional</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R6C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R6C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R6C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R6C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>7. </b>Educaci&oacute;n secundaria (Completa)</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R7C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R7C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R7C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R7C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>8. </b>Educaci&oacute;n primaria</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R8C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R8C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R8C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R8C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>9. </b>Formaci&oacute;n Profesional Integral - SENA</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R9C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R9C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R9C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R9C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>10. </b>Ninguno</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R10C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R10C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R10C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R10C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px; text-align: right'><b>Total personal ocupado promedio</b></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R11C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R11C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R11C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV1R11C4']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>IV.2 Distribuya el personal ocupado promedio que particip&oacute; en actividades
						cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en su empresa en los a&ntilde;os <?php echo $anterior . '-' . $vig?>
						(pregunta IV.1), seg&uacute;n el (los) departamento(s) donde se desarrollaron y ejecutaron dichas actividades de
						innovaci&oacute;n:</b></h5>
					<table style='width: 100%'>
						<tr>
							<td>Departamento</th>
							<td style='text-align: right'><?php echo $anterior?></td>
							<td style='text-align: right'><?php echo $vig?></td>
							<td>Departamento</td>
							<td style='text-align: right'><?php echo $anterior?></td>
							<td style='text-align: right'><?php echo $vig?></td>
							<td>Departamento</td>
							<td style='text-align: right'><?php echo $anterior?></td>
							<td style='text-align: right'><?php echo $vig?></td>
						</tr>
							<tr>
								<td>1. Amazonas</td>
									<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R1C1']) ?></td>
									<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R1C2']) ?></td>
								<td style='margin-left: 10px'>12. Cesar</td>
									<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R12C1']) ?></td>
									<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R12C2']) ?></td>
								<td style='margin-left: 10px'>23. Norte de Santander</td>
									<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R23C1']) ?></td>
									<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R23C2']) ?></td>
							</tr>
								<tr>
									<td>2. Antioquia</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R2C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R2C2']) ?></td>
									<td style='margin-left: 10px'>13. Choc&oacute;</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R13C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R13C2']) ?></td>
									<td style='margin-left: 10px'>24. Putumayo</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R24C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R24C2']) ?></td>
								</tr>
								<tr>
									<td>3. Arauca</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R3C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R3C2']) ?></td>
									<td style='margin-left: 10px'>14. C&oacute;rdoba</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R14C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R14C2']) ?></td>
									<td style='margin-left: 10px'>25. Quindio</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R25C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R25C2']) ?></td>
								</tr>
								<tr>
									<td>4. Atl&aacute;ntico</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R4C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R4C2']) ?></td>
									<td style='margin-left: 10px'>15. Cundinamarca</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R15C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R15C2']) ?></td>
									<td style='margin-left: 10px'>26. Risaralda</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R26C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R26C2']) ?></td>
								</tr>
								<tr>
									<td>5. Bogot&aacute; D.C.</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R5C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R5C2']) ?></td>
									<td style='margin-left: 10px'>16. Guain&iacute;a</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R16C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R16C2']) ?></td>
									<td style='margin-left: 10px'>27. San Andres y Providencia</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R27C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R27C2']) ?></td>
								</tr>
								<tr>
									<td>6. Bolivar</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R6C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R6C2']) ?></td>
									<td style='margin-left: 10px'>17. Guaviare</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R17C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R17C2']) ?></td>
									<td style='margin-left: 10px'>28. Santander</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R28C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R28C2']) ?></td>
								</tr>
								<tr>
									<td>7. Boyac&aacute;</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R7C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R7C2']) ?></td>
									<td style='margin-left: 10px'>18. Huila</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R18C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R18C2']) ?></td>
									<td style='margin-left: 10px'>29. Sucre</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R29C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R29C2']) ?></td>
								</tr>
								<tr>
									<td>8. Caldas</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R8C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R8C2']) ?></td>
									<td style='margin-left: 10px'>19. La Guajira</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R19C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R19C2']) ?></td>
									<td style='margin-left: 10px'>30. Tolima</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R30C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R30C2']) ?></td>
								</tr>
								<tr>
									<td>9. Caquet&aacute;</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R9C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R9C2']) ?></td>
									<td style='margin-left: 10px'>20. Magdalena</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R20C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R20C2']) ?></td>
									<td style='margin-left: 10px'>31. Valle del Cauca</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R31C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R31C2']) ?></td>
								</tr>
								<tr>
									<td>10. Casanare</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R10C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R10C2']) ?></td>
									<td style='margin-left: 10px'>21. Meta</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R21C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R21C2']) ?></td>
									<td style='margin-left: 10px'>32. Vaup&eacute;s</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R32C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R32C2']) ?></td>
								</tr>
								<tr>
									<td>11. Cauca</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R11C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R11C2']) ?></td>
									<td style='margin-left: 10px'>22. Nari&ntilde;o</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R22C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R22C2']) ?></td>
									<td style='margin-left: 10px'>33. Vichada</td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R33C1']) ?></td>
										<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R33C2']) ?></td>
								</tr>
								<tr>
									<td colspan='6' style='padding: 5px'>&nbsp;</td>
									<td style='padding: 5px; text-align: right'><b>Total</b> (suma de los items 1 a 33)</td>
									<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R34C1']) ?></td>
									<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV2R34C2']) ?></td>
								</tr>
						</table>
						<br><br>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>IV.3</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px; text-align: right'><b><?php echo $anterior?></b></td>
							<td style='padding: 5px; text-align: right'><b><?php echo $vig?></b></td>
						</tr>
						<tr>
							<td style='padding: 5px'>
								Indique el n&uacute;mero promedio de empleados con certificaciones de competencias laborales inherentes a la
								actividad(es) principal(es) que desarrolla la empresa:
							</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV3R1C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV3R1C2']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>IV.4 Distribuya el personal ocupado promedio que particip&oacute; en actividades 
						Cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en su empresa durante <?php echo $vig?> (pregunta IV.1),
						seg&uacute;n su &aacute;rea funcional principal y sexo:</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'><b>Hombres</b></td>
							<td style='padding: 5px'><b>Mujeres</b></td>
							<td style='padding: 5px'><b>Total</b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Direcci&oacute;n General</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R1C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R1C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R1C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Administraci&oacute;n</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R2C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R2C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R2C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Mercadeo y Ventas</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R3C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R3C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R3C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Produc&oacute;n</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R4C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R4C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R4C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Contable y Financiera</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R5C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R5C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R5C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>Investigaci&oacute;n y desarrollo (&Eacute;ste se desagrega a su vez en los siguientes cuatro items. No incluya consultores externos)</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R6C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R6C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R6C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><span style='margin-left: 30px'></span><b>6.1 </b>Investigadores (coordinadores, lideres de proyectos y/o gestores)</span></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R7C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R7C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R7C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><span style='margin-left: 30px'><b>6.2 </b>Pasantes o asistentes de investigaci&oacute;n y desarrollo</span></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R8C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R8C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R8C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><span style='margin-left: 30px'><b>6.3 </b>T&eacute;cnicos en investigaci&oacute;n y desarrollo</span></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R9C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R9C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R9C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><span style='margin-left: 30px'><b>6.4 </b>Auxiliares y/o apoyo administrativo en Investigaci&oacute;n y Desarrollo</span></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R10C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R10C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R10C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px; text-align: right'><b>Total personal involucrado en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n (Suma de las opciones 1 a 6)</b></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R11C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R11C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV4R11C3']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>IV.5 &iquest;Contrat&oacute; su empresa consultores externos para la realizaci&oacute;n
						de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n durante <?php echo $vig?>? Si su respuesta es
						afirmativa, indique el n&uacute;mero de consultores que prestaron servicios tanto dentro de la empresa como fuera de ella:</b></h5>
					<table style='margin-left: 25%'>
						<tr>
							<td style='padding: 5px; text-align: center; width: 10%; font-family: arial; font-size: 12px'><?php echo ($row4['IV5R1C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'>N&uacute;mero de consultores prestando servicios dentro de la empresa<br> (tiene puesto de trabajo en las instalaciones de la empresa)</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV5R1C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px; text-align: center; width: 10%''>&nbsp;</td>
							<td style='padding: 5px'>N&uacute;mero de consultores prestando servicios fuera de la empresa<br> (<b>no</b> tiene puesto de trabajo en las instalaciones de la empresa)</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV5R1C3']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>IV.6 Distribuya el personal ocupado promedio con nivel educativo superior que particip&oacute;
						en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en su empresa durante <?php echo $vig?>
						(pregunta IV.1 opciones 1 - 6), seg&uacute;n el &aacute;rea de formaci&oacute;n del m&aacute;ximo nivel educativo obtenido
						y sexo:</b></h5>
					<table>
						<tr>
							<td style='padding: 5px; text-align: center'><b>&Aacute;rea de formaci&oacute;n</b></td>
							<td style='padding: 5px; text-align: right'><b>Hombres</b></td>
							<td style='padding: 5px; text-align: right'><b>Mujeres</b></td>
							<td style='padding: 5px; text-align: right'><b>Total</b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Ciencias exactas asociadas a la qu&iacute;mica, f&iacute;sica, matem&aacute;ticas y estad&iacute;stica</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R1C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R1C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R1C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Ciencias naturales</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R2C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R2C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R2C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Ciencias de la salud</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R3C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R3C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R3C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Ingenier&iacute;a, arquitectura, urbanismo y afines</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R4C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R4C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R4C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Agronom&iacute;a, veterinaria y afines</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R5C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R5C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R5C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>Ciencias sociales</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R6C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R6C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R6C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>7. </b>Ciencias humanas y bellas artes</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R7C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R7C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R7C3']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>Total personal ocupado promedio con nivel de educaci&oacute;n superior involucrado en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n</b></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R8C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R8C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV6R8C3']) ?></td>
						</tr>
					</table>
					<br><br><br>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>IV.7 Indique el n&uacute;mero de personas que recibieron formaci&oacute;n y capacitaci&oacute;n
						relacionada espec&iacute;ficamente con actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n
						(correspondiente al valor registrado en cap&iacute;tulo II - pregunta 1 - &iacute;tem 9), seg&uacute;n el tipo de capacitaci&oacute;n
						impartida, financiada o cofinanciada por la empresa en los a&ntilde;os <?php echo $anterior . "-" . $vig?>: </b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td colspan='2' style='padding: 5px'><b>Personas capacitadas</b></td>
						</tr>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px; text-align: right'><b><?php echo $anterior?></b></td>
							<td style='padding: 5px; text-align: right'><b><?php echo $vig?></b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Doctorado: formaci&oacute;n de su personal, conducente a un t&iacute;tulo de doctorado (Ph.D), destinada a
								actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n realizadas por la empresa.
							</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV7R1C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV7R1C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Maestr&iacute;a: formaci&oacute;n de su personal, conducente a un t&iacute;tulo de master (MSc, MA, MBA),
								destinada a actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n realizadas por la empresa.
							</td>	
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV7R2C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV7R2C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Especializaci&oacute;n: formaci&oacute;n de su personal, conducente a un t&iacute;tulo de especialista,
								destinada a actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n realizadas por la empresa.
							</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV7R3C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV7R3C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Capacitaci&oacute;n igual o mayor a 40 horas: capacitaci&oacute;n de su personal, sea interna o externa a la
								empresa, con una duraci&oacute;n igual o mayor a 40 horas;  destinada a actividades cient&iacute;ficas, tecnol&oacute;gicas
								y de innovaci&oacute;n realizadas por la empresa.
							</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV7R4C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV7R4C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px; text-align: right'><b>Total personal capacitado y/o financiado</b></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV7R5C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row4['IV7R5C2']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h4 style='font-family: arial'>Observaciones</h4>
					<div class='col-sm-6' style='padding-bottom: 10px'>
						<textarea class='form-control' rows='2' name='observaciones' id='obsfte' <?php echo $estadObs ?>><?php echo $row4['OBSERVACIONES'] ?></textarea>
					</div>
				</fieldset>
			</div>
 		</form>
		<div class='nvapag'></div>
