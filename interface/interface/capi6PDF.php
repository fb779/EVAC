<?php
	$qCap6 = $conn->query("SELECT * FROM capitulo_vi WHERE vigencia = $vig AND C6_nordemp = $numero");
	foreach ($qCap6 AS $row6) {
		$a=1;
	}
?>
		<div class="container text-justify" style="font-size: 12px">
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas familiarizadas con conceptos de propiedad
 			intelectual, patentes, derechos de autor y sistemas de gesti&oacute;n de calidad implementados en la empresa. 
 		</div>
		<form class='form-horizontal' role='form'>
			<div class='container'>
				<b>CAP&Iacute;TULO VI - PROPIEDAD INTELECTUAL, CERTIFICACIONES DE CALIDAD, NORMAS T&Eacute;CNICAS Y REGLAMENTOS T&Eacute;CNICOS EN EL PER&Iacute;ODO <?php echo $anterior . "-" . $vig ?></b>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>VI.1 Para cada uno de los siguientes m&eacute;todos de protecci&oacute;n, indique si su
						empresa es titular de derechos de propiedad intelectual vigentes a diciembre de <?php echo $vig?>, y especifique el n&uacute;mero
						de registros correspondiente.</b></h5>
					<table style='margin-left: 25%'>
						<tr>
							<td style='padding: 5px'><b>Registros de propiedad intelectual</b></td>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'>Total de registros  vigentes a diciembre de <?php echo $vig ?></td>
						</tr>
						<tr>
							<td colspan='3' style='padding: 5px'><b>1. </b>Patentes</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1.1 </b>Patentes de invenci&oacute;n</td>
							<td style='padding: 5px'><?php echo ($row6['VI1R1C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI1R1C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1.2 </b>Patentes de modelo de utilidad</td>
							<td style='padding: 5px'><?php echo ($row6['VI1R2C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI1R2C2']?></td>
						</tr>
						<tr>
							<td colspan='3' style='padding: 5px'><b>2. </b>Derechos de autor</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2.1 </b>Derechos de autor de obras literarias, art&iacute;sticas, musicales, audiovisuales, arquitect&oacute;nicas o fonogramas</td>
							<td style='padding: 5px'><?php echo ($row6['VI1R3C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI1R3C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2.2 </b>Derechos de autor de registros de software</td>
							<td style='padding: 5px'><?php echo ($row6['VI1R4C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI1R4C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3 </b>Registros de dise&ntilde;os industriales</td>
							<td style='padding: 5px'><?php echo ($row6['VI1R5C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI1R5C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4 </b>Registros de marcas y otros signos distintivos</td>
							<td style='padding: 5px'><?php echo ($row6['VI1R6C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI1R6C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5 </b>Certificados de obtentor de variedades vegetales</td>
							<td style='padding: 5px'><?php echo ($row6['VI1R7C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI1R7C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px; text-align: right'><b>Total de registros de propiedad intelectual vigentes a diciembre</b></td>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI1R8C2']?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>VI.2 Para cada uno de los siguientes m&eacute;todos de protecci&oacute;n, indique si su
						empresa obtuvo derechos de propiedad intelectual durante el per&iacute;odo <?php echo $anterior . "-" . $vig?>, y especifique
						el n&uacute;mero de registros correspondientes.</b></h5>
					<table style='margin-left: 25%'>
						<tr>
							<td style='padding: 5px'><b>Registros de propiedad intelectual (Ver definiciones en VI.1)</b></td>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px; text-align: right'>Total de registros obtenidos <?php echo $anterior . "-" . $vig?></td>
						</tr>
						<tr>
							<td colspan='3' style='padding: 5px'><b>1. </b>Patentes</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1.1 </b>Patentes de invenci&oacute;n</td>
							<td style='padding: 5px'><?php echo ($row6['VI2R1C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI1R1C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1.2 </b>Patentes de modelo de utilidad</td>
							<td style='padding: 5px'><?php echo ($row6['VI2R2C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI2R2C2']?></td>
						</tr>
						<tr>
							<td colspan='3' style='padding: 5px'><b>2. </b>Derechos de autor</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2.1 </b>Derechos de autor de obras literarias, art&iacute;sticas, musicales, audiovisuales, arquitect&oacute;nicas o fonogramas</td>
							<td style='padding: 5px'><?php echo ($row6['VI2R3C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI2R3C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2.2 </b>Derechos de autor de registros de software</td>
							<td style='padding: 5px'><?php echo ($row6['VI2R4C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI2R4C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3 </b>Registros de dise&ntilde;os industriales</td>
							<td style='padding: 5px'><?php echo ($row6['VI2R5C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI2R5C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4 </b>Registros de marcas y otros signos distintivos</td>
							<td style='padding: 5px'><?php echo ($row6['VI2R6C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI2R6C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5 </b>Certificados de obtentor de variedades vegetales</td>
							<td style='padding: 5px'><?php echo ($row6['VI2R7C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI2R7C2']?></td>
						</tr>
						<tr>
							<td style='padding: 5px; text-align: right'><b>Total de registros de propiedad intelectual obtenidos en el periodo - <?php echo $anterior - " - " . $vig ?></b></td>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px; text-align: right'><?php echo $row6['VI2R8C2']?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>VI.3 Para cada una de las siguientes opciones, indique si su empresa utiliz&oacute;
						otros m&eacute;todos de protecci&oacute;n durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?>, y especifique
						el n&uacute;mero de casos en que utiliz&oacute; el m&eacute;todo correspondiente.</b></h5>
					<table style='margin-left: 25%'>
						<tr>
							<td style='padding: 5px'><b>Otros M&eacute;todos de Protecci&oacute;n</b></td>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px; text-align: right'>Total de casos en que utiliz&oacute; el m&eacute;todo <?php echo $anterior . "-" . $vig?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Secreto Industrial</td>
							<td style='padding: 5px'><?php echo ($row6['VI3R1C1'] == 1) ? 'SI' : 'NO' ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row6['VI3R1C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Alta complejidad en el dise&ntilde;o</td>
							<td style='padding: 5px'><?php echo ($row6['VI3R2C1'] == 1) ? 'SI' : 'NO' ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row6['VI3R2C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Acuerdos o contratos de confidencialidad con otras empresas</td>
							<td style='padding: 5px'><?php echo ($row6['VI3R3C1'] == 1) ? 'SI' : 'NO' ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row6['VI3R3C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Acuerdos o contratos de confidencialidad con los empleados</td>
							<td style='padding: 5px'><?php echo ($row6['VI3R4C1'] == 1) ? 'SI' : 'NO' ?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row6['VI3R4C2']) ?></td>
						</tr>
						<tr>
							<td style='padding: 5px; text-align: right'><b>Total de otros m&eacute;todos de protecci&oacute;n utilizados en el per&iacute;odo <?php echo $anterior . "-" . $vig ?></b></td>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row6['VI3R5C2']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px' id="vi4">
					<h5 class='numeral'><b>VI.4</b></h5>
					<table style='margin-left: 25%'>
						<tr>
							<td style='padding: 5px'>
								&iquest;Tuvo su empresa la intenci&oacute;n de solicitar registros de propiedad intelectual durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?>
							</td>
							<td style='padding: 5px'><?php echo ($row6['VI4R1C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>VI.5 Se&ntilde;ale el grado de importancia que tuvieron los siguientes obst&aacute;culos,
						para la solicitud u obtenci&oacute;n de registros de propiedad intelectual por parte de su empresa, durante el per&iacute;odo <?php echo $anterior . "-" . $vig?>: </b></h5>
					<table style='margin-left: 25%'>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'><b>Grado de importancia</b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Falta de informaci&oacute;n sobre beneficios y requisitos</td>
							<?php $valorI = $row6['VI5R1C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Dificultad para cumplir con los requisitos o completar los tr&aacute;mites</td>
							<?php $valorI = $row6['VI5R2C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Tiempo del tr&aacute;mite excesivo</td>
							<?php $valorI = $row6['VI5R3C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Poca efectividad de los registros para proveer protecci&oacute;n a la propiedad intelectual</td>
							<?php $valorI = $row6['VI5R4C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Balance costo - beneficio no favorable
							<?php $valorI = $row6['VI5R5C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>No se generan ideas novedosas que sean susceptibles de obtener registros de propiedad intelectual
							<?php $valorI = $row6['VI5R6C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>7. </b>Escasa capacidad interna de gesti&oacute;n de la propiedad intelectual
							<?php $valorI = $row6['VI5R7C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI]; ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>VI.6</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'>N&uacute;mero de Certificaciones</td>
						</tr>
						<tr>
							<td style='padding: 5px'>
								Durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?>, &iquest;su empresa obtuvo certificaciones de calidad de
								proceso?. Si su respuesta es afirmativa, indique cu&aacute;ntas. (por ejemplo, si tiene 2 procesos con ISO-14040 y un
								proceso con ISO-9001, debe registrar 3 certificaciones)
							</td>
							<td style='padding: 5px'><?php echo ($row6['VI6R1C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px; text-align: right'><?php echo number_format($row6['VI6R1C2']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>VI.7</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'>N&uacute;mero de Certificaciones</td>
						</tr>
						<tr>
							<td style='padding: 5px'>
								Durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?>, &iquest;su empresa obtuvo certificaciones de calidad de
								producto?. Si su respuesta es afirmativa, indique cu&aacute;ntas. (por ejemplo, si tiene 2 productos con ISO-9000, debe
								registrar 2 certificaciones)
							</td>
							<td style='padding: 5px'><?php echo ($row6['VI7R1C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><?php echo number_format($row6['VI7R1C2']) ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>VI.8</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'>
								&iquest;Los servicios o bienes que produjo su empresa durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?> est&aacute;n 
								sujetos al cumplimiento de reglamentos t&eacute;cnicos?
							</td>
							<td style='padding: 5px'><?php echo ($row6['VI8R1C1'] == 1) ? 'SI' : 'NO' ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>VI.9 Se&ntilde;ale el grado de importancia que tuvo sobre los siguientes aspectos de su
						empresa, la obtenci&oacute;n de certificaciones de calidad de producto o proceso durante el per&iacute;odo <?php echo $anterior . "-" . $vig ?>:</b></h5>
					<table style='margin-left: 25%'>
						<tr>
							<td style='padding: 5px'>&nbsp;</td>
							<td style='padding: 5px'><b>Grado de importancia</b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Generaci&oacute;n de ideas para innovar</td>
							<?php $valorI9 = $row6['VI9R1C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI9]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Aumento de la productividad</td>
							<?php $valorI9 = $row6['VI9R2C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI9]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Mayor acceso a mercados nacionales</td>
							<?php $valorI9 = $row6['VI9R3C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI9]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Mayor acceso a mercados internacionales</td>
							<?php $valorI9 = $row6['VI9R4C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI9]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Mayor actualizaci&oacute;n tecnol&oacute;gica</td>
							<?php $valorI9 = $row6['VI9R5C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI9]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>Mayor actualizaci&oacute;n tecnol&oacute;gica</td>
							<?php $valorI9 = $row6['VI9R6C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI9]; ?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>7. </b>Mejor relaci&oacute;n con otras empresas del sector</td>
							<?php $valorI9 = $row6['VI9R7C1']; ?>
							<td style='padding: 5px'><?php echo $gradoI[$valorI9]; ?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h4 style='font-family: arial'>Observaciones</h4>
					<div class='col-sm-6' style='padding-bottom: 10px'>
						<textarea class='form-control' rows='2' name='observaciones' id='obsfte'><?php echo $row6['OBSERVACIONES'] ?></textarea>
					</div>
				</fieldset>
			</div>
		</form>
