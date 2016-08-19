<?php
	$bloquea3 = false;
	$qCap3 = $conn->query("SELECT * FROM capitulo_iii WHERE vigencia = $vig AND C3_nordemp = $numero");
	foreach ($qCap3 AS $row3) {
		$a=1;
	}
	$qC1 = $conn->query("SELECT * FROM capitulo_i WHERE C1_nordemp = $numero AND vigencia = $vig");
	foreach ($qC1 AS $row1) {
		$a=1;
	}
	if ($row1['I1R1C1N']!=1 AND $row1['I1R2C1N']!=1 AND $row1['I1R3C1N']!=1 AND $row1['I1R1C1M']!=1 AND $row1['I1R2C1M']!=1 AND $row1['I1R3C1M']!=1
		AND $row1['I1R4C1']!=1 AND $row1['I1R5C1']!=1 AND $row1['I1R6C1']!=1 AND $row1['I5R1C1']!=1 AND $row1['I6R1C1']!=1) {
		$bloquea3 = true;
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
 			<b>CAP&Iacute;TULO III - FINANCIAMIENTO DE LAS ACTIVIDADES CIENT&Iacute;FICAS, TECNOL&Oacute;GICAS Y DE INNOVACI&Oacute;N EN LOS A&Ntilde;OS <?php echo $anterior . "-" . $vig ?></b><br>
			La empresa puede hacer uso de recursos propios, es decir, destinar fondos provenientes del ejercicio de su actividad para financiar
			inversiones en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n. Sin embargo, tambi&eacute;n puede financiar
			o cofinanciar dichas actividades por medio de recursos p&uacute;blicos, sean &eacute;stos reembolsables o no, o mediante el uso de
			recursos privados provenientes de terceros tales como el cr&eacute;dito, las inversiones de capital, la banca privada, las agencias
			u organizaciones privadas (nacionales e internacionales), entre otros.
		</div>
		<div class='container text-justify' style="font-size: 12px">
			<b>Recuerde:</b> las Actividades Cient&iacute;ficas, Tecnol&oacute;gicas y de Innovaci&oacute;n <b>(ACTI)</b> son todas aquellas
			que la empresa realiza para producir, promover, difundir y aplicar conocimientos cient&iacute;ficos y t&eacute;cnicos; as&iacute;
			como tambi&eacute;n para el desarrollo o introducci&oacute;n de innovaciones.											
		</div>
		<div class="container text-justify" style="font-size: 12px">
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas del &aacute;rea financiera y que conozcan las
 				inversiones y gastos de la empresa en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n 
 		</div>
 		<form class='form-horizontal' role='form'>
 			<div class='container'>
 				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>III.1 Distribuya el total invertido en actividades cient&iacute;ficas, tecnol&oacute;gicas
						y de innovaci&oacute;n (total de la inversi&oacute;n del Cap&iacute;tulo II), seg&uacute;n la fuente original de los recursos
						usados para financiar dichas inversiones en los a&ntilde;os <?php echo $anterior . "-" . $vig?>. Debe distinguirse entre el
						uso de recursos propios de la empresa, recursos de otras empresas del grupo, recursos p&uacute;blicos, recursos de banca
						privada, recursos de otras empresas ajenas al grupo, fondos de capital privado y recursos de cooperaci&oacute;n o donaciones.</b></h5>
					<table style='margin-left: 25%'>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td colspan='2' style='padding: 5px; text-align: center'><b><?php echo $anterior?></b></td>
							<td colspan='2' style='padding: 5px; text-align: center'><b><?php echo $vig?></b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Recursos propios de la empresa.</td>
							<td colspan='2' style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R1C1']) ?></td>
							<td colspan='2' style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R1C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Recursos de otras empresas del grupo.</td>
							<td colspan='2' style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R2C1']) ?></td>
							<td colspan='2' style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R2C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Recursos p&uacute;blicos para la realizaci&oacute;n de ACTI.</td>
							<td colspan='2' style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R3C1']) ?></td>
							<td colspan='2' style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R3C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td colspan='2' style='padding: 5px; text-align: center'><b><?php echo $anterior?></b></td>
							<td colspan='2' style='padding: 5px; text-align: center'><b><?php echo $vig?></b></td>
						</tr>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'><b>Nacional</b></td>
							<td style='padding: 5px'><b>Extranjero</b></td>
							<td style='padding: 5px'><b>Nacional</b></td>
							<td style='padding: 5px'><b>Extranjero</b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Recursos de banca privada.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R4C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R4C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R4C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R4C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Recursos de otras empresas.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R5C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R5C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R5C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R5C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>Fondos de capital privado.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R6C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R6C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R6C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R6C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>7. </b>Recursos de cooperaci&oacute;n o donaciones.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R7C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R7C2']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R7C3']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R7C4']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px; text-align: right'><b>TOTAL (debe ser IGUAL al total invertido).</b></td>
							<td colspan='2' style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R8C1']) ?></td>
							<td colspan='2' style='padding: 5px; text-align: right'><?php echo number_format($row3['III1R8C2']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>III.2 Distribuya el monto de recursos p&uacute;blicos utilizados en el a&ntilde;o
						<?php echo $anterior . "-" . $vig?> para financiar inversiones en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n
						(opci&oacute;n 3 del numeral III.1), de acuerdo a la l&iacute;nea de financiaci&oacute;n por la cual se obtuvieron
						los recursos.</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>
								<b>L&iacute;neas de cofinanciaci&oacute;n: </b>Recursos no reembolsables que se otorgan para
								financiar un porcentaje (menor al 100%) del valor total de un proyecto de investigaci&oacute;n, desarrollo tecnol&oacute;gico
								e innovaci&oacute;n. Se exige en este tipo de financiaci&oacute;n una contrapartida en dinero o especie por parte de la
								empresa.
							</td>
							<td style='padding: 5px; text-align: right'><b><?php echo $anterior?></b></td>
							<td style='padding: 5px; text-align: right'><b><?php echo $vig?></b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>BANCOLDEX - INNpulsa - MinComercio. Crecimiento extraordinario, MiPyme y Crecimiento regional.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R1C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R1C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>SENA. Fomento de la innovaci&oacute;n y desarrollo tecnol&oacute;gico en las empresas y Corredores tecnol&oacute;gicos.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R2C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R2C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'>
								<b>3. </b>COLCIENCIAS.  Es tiempo de volver - Nodos de innovaci&oacute;n en TIC - APPS.co - Desarrollo de soluciones
								innovadoras de TI - Modelos de calidad - Apoyo a centros de desarrollo tecnol&oacute;gico para la transferencia de
								tecnolog&iacute;a e innovaci&oacute;n.
							</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R3C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R3C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'>
								<b>4. </b>COLCIENCIAS. Proyectos de investigaci&oacute;n aplicada - Desarrollo Tecnol&oacute;gico - Programas de
								I+D+I en eficiencia t&eacute;rmica - Proyectos de Pruebas de concepto - Talento humano.						
							</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R4C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R4C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>COLCIENCIAS. Locomotora de la innovaci&oacute;n para empresas (desarrollo tecnol&oacute;gico e innovaci&oacute;n).</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R5C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R5C2']) ?></td>
						</tr>
						<tr>
							<td colspan='2' style='padding: 5px'>
								<b>L&iacute;neas de cr&eacute;dito:</b> Recursos reembolsables que se otorgan para
								financiar hasta por el 100% del valor total de un proyecto de investigaci&oacute;n, desarrollo tecnol&oacute;gico e 
								Innovaci&oacute;n.
							</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>BANCOLDEX - INNpulsa. Promover y dinamizar la innovaci&oacute;n de las grandes empresas y MiPymes.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R6C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R6C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>7. </b>BANCOLDEX. Modernizaci&oacute;n empresarial.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R7C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R7C2']) ?></td>
						</tr>
						<tr>
							<td colspan='3' style='padding: 5px'><b>Otras l&iacute;neas</b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>8. </b>Fondos departamentales o municipales de ciencia y tecnolog&iacute;a.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R8C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R8C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>9. </b>Fondo de ciencia, tecnolog&iacute;a e innovaci&oacute;n del sistema general de regal&iacute;as.</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R9C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R9C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px; text-align: right'><b>Total (debe ser igual a la opci&oacute;n 3 del numeral III.1).</b></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R10C1']) ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row3['III2R10C2']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>III.3 &iquest;Tuvo su empresa la intenci&oacute;n de solicitar recursos p&uacute;blicos
						para financiar inversiones en actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n en su empresa,
						durante <?php echo $anterior . "-" . $vig?>?</b></h5>
					<div class='container' style='text-align: center'>
						<?php echo ($row3['III3R1C1'] == 1) ? 'SI' : 'NO'?>
					</div>
					<br><br><br>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id='iii4' <?php echo $estadoIII4 ?>>
					<h5 class='numeral'><b>III.4 Se&ntilde;ale el grado de importancia que tuvieron los siguientes obst&aacute;culos,
						en el acceso a recursos p&uacute;blicos para financiar inversiones en actividades cient&iacute;ficas, tecnol&oacute;gicas
						y de innovaci&oacute;n en su empresa, durante el per&iacute;odo <?php echo $anterior . "-" . $vig?></b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px; text-align: center'><b>Grado de Importancia</b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Desconocimiento de las l&iacute;neas de financiaci&iacute;n p&uacute;blicas existentes</td>
							<?php $valorIn4 = $row3['III4R1C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorIn4]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Falta de informaci&oacute;n sobre requisitos y tr&aacute;mites</td>
							<?php $valorIn4 = $row3['III4R2C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorIn4]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Dificultad para cumplir con los requisitos o completar los tr&aacute;mites</td>
							<?php $valorIn4 = $row3['III4R3C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorIn4]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Tiempo del tr&aacute;mite excesivo</td>
							<?php $valorIn4 = $row3['III4R4C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorIn4]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Condiciones de financiaci&oacute;n y/o cofinanciaci&oacute;n poco atractivas</td>
							<?php $valorIn4 = $row3['III4R5C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorIn4]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>Demora en la intermediaci&oacute;n entre la banca comercial y las l&iacute;neas p&uacute;blicas de cr&eacute;dito</td>
							<?php $valorIn4 = $row3['III4R6C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorIn4]; ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>III.5 Con relaci&oacute;n a beneficios tributarios (deducciones o exenciones) por inversiones en
						desarrollo cient&iacute;fico y tecnol&oacute;gico durante <?php echo $anterior . "-" . $vig?>:</b>
					</h5>
					<?php $valc3n5 = $row3['III5R1C1'] ?>
					<?php echo "<span style='text-align: center; font-family: arial; font-size: 12px; padding-left: 30%'>" . $c3n5[$valc3n5] . "</span"; ?>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>III.6 Indique cu&aacute;les de los siguientes factores fueron un obst&aacute;culo para
						solicitar u obtener beneficios tributarios por inversiones en desarrollo cient&iacute;fico y tecnol&oacute;gico,
						durante el per&iacute;odo <?php echo $anterior . "-" . $vig?>:</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'>Deducci&oacute;n en renta por inversiones para proyectos de ciencia, tecnolog&iacute;a e innovaci&oacute;n</td>
							<td style='padding: 5px'>Exenciones de renta y/o de IVA por inversiones para proyectos de ciencia, tecnolog&iacute;a e innovaci&oacute;n</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Falta de Informaci&oacute;n sobre beneficios y requisitos</td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R1C1'] == 1) ? 'checked' : ''?> /></td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R1C2'] == 1) ? 'checked' : ''?> /></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Dificultades con la herramienta en l&iacute;nea para la solicitud a trav&eacute;s del Sistema Integral de
								Gesti&oacute;n de Proyectos (SIGP)</td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R2C1'] == 1) ? 'checked' : ''?> /></td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R2C2'] == 1) ? 'checked' : ''?> /></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Dificultad para el diligenciamiento del formulario electr&oacute;nico</td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R3C1'] == 1) ? 'checked' : ''?> /></td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R3C2'] == 1) ? 'checked' : ''?> /></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Requisitos y tr&aacute;mites excesivos y/o complejos</td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R4C1'] == 1) ? 'checked' : ''?> /></td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R4C2'] == 1) ? 'checked' : ''?> /></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Tiempo excesivo de tr&aacute;mite de la aprobaci&oacute;n</td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R5C1'] == 1) ? 'checked' : ''?> /></td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R5C2'] == 1) ? 'checked' : ''?> /></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>Poca utilidad del beneficio tributario</td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R6C1'] == 1) ? 'checked' : ''?> /></td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R6C2'] == 1) ? 'checked' : ''?> /></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>7. </b>La ley excluye parcialmente actividades y proyectos de innovaci&oacute;n que desarrolla la empresa</td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R7C1'] == 1) ? 'checked' : ''?> /></td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R7C2'] == 1) ? 'checked' : ''?> /></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>8. </b>No hall&oacute; obst&aacute;culos</td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R8C1'] == 1) ? 'checked' : ''?> /></td>
							<td style='padding: 5px; text-align: center'><input type='checkbox' value='1' <?php echo ($row3['III6R8C2'] == 1) ? 'checked' : ''?> /></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h4 style='font-family: arial'>Observaciones</h4>
					<div class='col-sm-6' style='padding-bottom: 10px'>
						<textarea class='form-control' rows='2' name='observaciones' id='obsfte' <?php echo $estadObs ?>><?php echo $row3['OBSERVACIONES'] ?></textarea>
					</div>
				</fieldset>
 			</div>
 		</form>
 		<div class='nvapag'></div>
 		<?php } ?>
