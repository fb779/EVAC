<?php
	$qCap = $conn->query("SELECT * FROM capitulo_i WHERE vigencia = $vig AND C1_nordemp = $numero");
	foreach ($qCap AS $row) {
		$a=1;
	}
?>
	 		<div class="container text-justify" style="font-size: 9px">
	 			<b>CAP&Iacute;TULO I - INNOVACI&Oacute;N Y SU IMPACTO EN LA EMPRESA EN EL PER&Iacute;ODO - <?php echo $anterior . "-" . $vig ?></b><br>
				Una innovaci&oacute;n se define en esta encuesta como un producto (servicio o bien) nuevo o significativamente mejorado
				introducido en el mercado, o un proceso nuevo o significativamente mejorado introducido en la empresa, o un m&eacute;todo
				organizativo nuevo introducido en la empresa, o una t&eacute;cnica de comercializaci&oacute;n nueva introducida en la empresa. 
	 			<ul>
	 				<li>Una innovaci&oacute;n es siempre nueva para la empresa. No es necesario que sea nueva en el mercado en el que la empresa opera.</li>
	 				<li>Los cambios de naturaleza est&eacute;tica, y los cambios simples de organizaci&oacute;n o gesti&oacute;n no cuentan como innovaci&oacute;n.</li>
	 				<li>Tanto los servicios como los bienes que la empresa introduce al mercado, son considerados como productos.
	 					Los servicios, a diferencia de los bienes, suelen ser productos intangibles o dif&iacute;cilmente almacenables y
	 					sus procesos de producci&oacute;n y comercializaci&oacute;n pueden darse de manera simult&aacute;nea.</li>
	 				<li> El suministro de un servicio puede tener como complemento, o requerir como soporte, el suministro de un bien; y a la inversa.</li>   
	 			</ul>
	 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas con conocimiento de primera mano de las
	 				 actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n, que lleva a cabo la empresa 
	 		</div>
			<form class='form-horizontal' role='form'>
				<div class='container' style='font-family: arial; font-size: 9px'>
					<fieldset style='border-style: solid; border-width: 1px; font-size: 9px;' id='i1'>
						<h5 class='numeral'>I.1 Indique si durante el per&iacute;odo <?php echo $anterior . "-" . $vig?> su empresa introdujo alguna de las siguientes innovaciones. Si su respuesta es afirmativa especifique el n&uacute;mero.</h5>
						<div class='container'>
							<b>Tenga en cuenta:</b> Un servicio o bien nuevo, es un producto cuyas caracter&iacute;sticas fundamentales
								(especificaciones t&eacute;cnicas, componentes y materiales, software incorporado o usos previstos)
								revisten novedad con relaci&oacute;n a los correspondientes a productos anteriores producidos por la empresa.
						</div>
						<table>
							<tr style='font-size: 9px;'>
								<td style='padding: 5px'><b>1. </b>Servicios o bienes nuevos &uacute;nicamente para su empresa (Ya exist&iacute;an en el mercado nacional y/o en el internacional).</td>
								<td style='padding: 5px'><?php echo ($row['I1R1C1N'] == 1) ? 'SI' : 'NO'?></td>
								<td style='padding: 5px'><?php echo $row['I1R1C2N']?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>2. </b>Servicios o bienes nuevos en el mercado nacional (Ya exist&iacute;an en el mercado internacional).</td>
								<td style='padding: 5px'><?php echo ($row['I1R2C1N'] == 1) ? 'SI' : 'NO'?></td>
								<td style='padding: 5px'><?php echo $row['I1R2C2N']?></td> 
							</tr>
							<tr>
								<td style='padding: 5px'><b>3. </b>Servicios o bienes nuevos en el mercado internacional.</td>
								<td style='padding: 5px'><?php echo ($row['I1R3C1N'] == 1) ? 'SI' : 'NO'?></td>
								<td style='padding: 5px'><?php echo $row['I1R3C2N']?></td> 
							</tr>
							<tr>
								<td style='padding: 5px'>Total innovaciones de servicios o bienes nuevos</td>
								<td style='padding: 5px'>&nbsp;</td>
								<td style='padding: 5px'><?php echo $row['I1R4C2N']?></td> 
							</tr>
						</table>
						<div class='container'>
							<b>Tenga en cuenta:</b> Un servicio o bien significativamente mejorado, es un producto cuyo desempe&ntilde;o ha sido
								mejorado o perfeccionado en gran medida. Puede darse por el uso de componentes o materiales de mejor desempe&ntilde;o,
								o por cambios en uno de los subsistemas t&eacute;cnicos que componen un producto complejo.
						</div>
						<table>
							<tr>
								<td style='padding: 5px'><b>4. </b>Servicios o bienes significativamente mejorados para su empresa (Ya exist&iacute;an en el mercado nacional y/o en el internacional).</td>
								<td style='padding: 5px'><?php echo ($row['I1R1C1M'] == 1) ? 'SI' : 'NO'?></td>
								<td style='padding: 5px'><?php echo $row['I1R1C2M']?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>5. </b>Servicios o bienes significativamente mejorados en el mercado nacional (Ya exist&iacute;an en el mercado internacional).</td>
								<td style='padding: 5px'><?php echo ($row['I1R2C1M'] == 1) ? 'SI' : 'NO'?></td>
								<td style='padding: 5px'><?php echo $row['I1R2C2M']?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>6. </b>Servicios o bienes significativamente mejorados en el mercado internacional.</td>
								<td style='padding: 5px'><?php echo ($row['I1R3C1M'] == 1) ? 'SI' : 'NO'?></td>
								<td style='padding: 5px'><?php echo $row['I1R3C2M']?></td>
							</tr>
							<tr>
								<td style='padding: 5px'>Total innovaciones de servicios o bienes significativamente mejorados</td>
								<td style='padding: 5px'>&nbsp;</td>
								<td style='padding: 5px'><?php echo $row['I1R4C2M']?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>Otros tipos de Innovaciones</b></td>
								<td style='padding: 5px'>&nbsp;</td>
								<td style='padding: 5px'>&nbsp;</td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>7. </b>Introdujo procesos nuevos o significativamente mejorados, m&eacute;todos de prestaci&oacute;n de servicios, distribuci&oacute;n, entrega, o  sistemas log&iacute;sticos en su empresa.</td>
								<td style='padding: 5px'><?php echo ($row['I1R4C1'] == 1) ? 'SI' : 'NO'?></td>
								<td style='padding: 5px'><?php echo $row['I1R4C2']?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>8. </b>Introdujo nuevos m&eacute;todos organizativos implementados en el funcionamiento interno de la empresa,
									en el sistema de gesti&oacute;n del conocimiento, en la organizaci&oacute;n del lugar de trabajo, o 
									en la gesti&oacute;n de las relaciones externas de la empresa. 
								</td>
								<td style='padding: 5px'><?php echo ($row['I1R5C1'] == 1) ? 'SI' : 'NO'?></td>
								<td style='padding: 5px'><?php echo $row['I1R5C2']?></td>
							</tr>
							<tr>
								<td style='padding: 5px'>
									<b>9. </b>Introdujo nuevas t&eacute;cnicas de comercializaci&oacute;n en su empresa (canales para promoci&oacute;n
										y venta, o modificaciones significativas en el empaque o dise&ntilde;o del producto), implementadas en la empresa
										con el objetivo de ampliar o mantener su mercado. (Se excluyen los cambios que afectan las funcionalidades
										del producto puesto que eso corresponder&iacute;a a un servicio o bien significativamente mejorado).
								</td>
								<td style='padding: 5px'><?php echo ($row['I1R6C1'] == 1) ? 'SI' : 'NO'?></td>
								<td style='padding: 5px'><?php echo $row['I1R6C2']?></td>
							</tr>
						</table>
					</fieldset>
					<fieldset style='border-style: solid; border-width: 1px'>
						<h5 class='numeral'><b>I.2 Se&ntilde;ale el grado de importancia del impacto, que tuvo sobre los siguientes
							aspectos de su empresa durante el per&iacute;odo <?php echo $anterior . " - " . $vig?>, la introducci&oacute;n de servicios
							o bienes nuevos o significativamente mejorados, y/o la implementaci&oacute;n de procesos nuevos o significativamente
							mejorados, de m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de comercializaci&oacute;n nuevas.</b></h5>
						<table>
							<tr>
								<td style='padding: 5px'>Producto</td>
								<td style='padding: 5px'>Grado de Importancia</td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>1. </b>Mejora en la calidad de los servicios o bienes</td>
								<?php $valor = $row['I2R1C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>2. </b>Ampliaci&oacute;n en la gama de servicios o bienes</td>
								<?php $valor = $row['I2R2C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td colspan='2' style='padding: 5px'><b>Mercado</b></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>3. </b>Ha mantenido su participaci&oacute;n en el mercado geogr&aacute;fico de su empresa</td>
								<?php $valor = $row['I2R3C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>4. </b>Ha ingresado a un mercado geogr&aacute;fico nuevo</td>
								<?php $valor = $row['I2R4C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td colspan='2' style='padding: 5px'><b>Proceso</b></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>5. </b>Aumento de la productividad</td>
								<?php $valor = $row['I2R5C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>6. </b>Reducci&oacute;n de los costos laborales</td>
								<?php $valor = $row['I2R6C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>7. </b>Reducci&oacute;n en el uso de materias primas o insumos</td>
								<?php $valor = $row['I2R7C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>8. </b>Reducci&oacute;n en el consumo de energ&iacute;a el&eacute;ctrica u otros energ&eacute;ticos</td>
								<?php $valor = $row['I2R8C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>9. </b>Reducci&oacute;n en el consumo de agua</td>
								<?php $valor = $row['I2R9C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>10. </b>Reducci&oacute;n en costos asociados a comunicaciones</td>
								<?php $valor = $row['I2R10C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>11. </b>Reducci&oacute;n en costos asociados a transporte</td>
								<?php $valor = $row['I2R11C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>12. </b>Reducci&oacute;n en costos de mantenimiento y reparaciones</td>
								<?php $valor = $row['I2R12C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td colspan='2' style='padding: 5px'><b>Otros Impactos</b></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>13. </b>Mejora en el cumplimiento de regulaciones, normas y reglamentos t&eacute;cnicos. Incluye cumplimiento
									de normas de reducci&oacute;n de vertimientos o emisiones t&oacute;xicas y de mejora de las condiciones de
									seguridad industrial</td>
								<?php $valor = $row['I2R13C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>14. </b>Aprovechamiento de residuos en los procesos de la empresa</td>
								<?php $valor = $row['I2R14C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>15. </b>Disminuci&oacute;n en el pago de impuestos</td>
								<?php $valor = $row['I2R15C1'] ?>
								<td style='padding: 5px'><?php echo $gradoI[$valor]?></td>
							</tr>
						</table>
					</fieldset>
					<fieldset>
						<h5 class='numeral'><b>I.3 Indique el valor correspondiente a los ingresos o ventas operacionales nacionales y las
							exportaciones efectuadas por su empresa en los a&ntilde;os <?php echo $anterior . "y " . $vig?>. <mark>(En miles de pesos corrientes)</mark></b></h5>
						<table>
							<tr>
								<td style='padding: 5px'>Valor de ingresos o ventas nacionales durante el periodo <?php echo $anterior ?></td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I3R1C1']) ?></td>
								<td style='padding: 5px'>Valor de Exportaciones totales durante el periodo <?php echo $anterior ?></td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I3R1C2']) ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'>Valor de ingresos o ventas nacionales durante el periodo <?php echo $vig ?></td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I3R2C1']) ?></td>
								<td style='padding: 5px'>Valor de Exportaciones totales durante el periodo <?php echo $vig ?></td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I3R2C2']) ?></td>
							</tr>
						</table>
					</fieldset>
					<fieldset style='border-style: solid; border-width: 1px'>
						<h5 class='numeral'><b>I.4 Distribuya en porcentajes el valor de los ingresos o ventas operacionales nacionales y de las
							exportaciones del a&ntilde;o <?php echo $vig ?>, reportado en el numeral I.3, seg&uacute;n la siguiente clasificaci&oacute;n.
							Compruebe que la suma de cada columna es 100%.</b></h5>
						<table>
							<tr>
								<td style='padding: 5px'>&nbsp;</td>
								<td style='padding: 5px'>(%)Nacionales</td>
								<td style='padding: 5px'>(%)Exportaciones</td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>1. </b>Servicios o bienes nuevos o mejorados significativamente para a la empresa (Ya exist&iacute;an en el mercado nacional y/o en el internacional)</td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I4R1C1']) ?></td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I4R1C2']) ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>2. </b>Servicios o bienes nuevos o mejorados significativamente en el mercado nacional (Ya exist&iacute;an en el mercado internacional)</td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I4R2C1']) ?></td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I4R2C2']) ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>3. </b>Servicios o bienes nuevos o mejorados significativamente en el mercado internacional</td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I4R3C1']) ?></td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I4R3C2']) ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>4. </b>Servicios o bienes que se mantuvieron sin cambios o cuyos cambios no fueron significativos (productos no innovadores)</td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I4R4C1']) ?></td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I4R4C2']) ?></td>
							</tr>
							<tr>
								<td style='padding: 5px; text-align: right'><b>Total</b></td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I4R5C1']) ?></td>
								<td style='padding: 5px; text-align: right'><?php echo number_format($row['I4R5C2']) ?></td>
							</tr>
						</table>
					</fieldset>
					<fieldset style='border-style: solid; border-width: 1px'>
						<h5 class='numeral'><b>I.5</b></h5>
						<table>
							<tr>
								<td style='padding: 5px'>
									Al finalizar <?php echo $vig ?>, &iquest;ten&iacute;a su empresa alg&uacute;n
									proyecto en marcha, es decir, no finalizado, para la introducci&oacute;n de servicios o bienes nuevos o
									significativamente mejorados, y/o la implementaci&oacute;n de procesos nuevos o significativamente mejorados, de 
									m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de comercializaci&oacute;n nuevas? 
								</td>
								<td style='padding: 5px'><?php echo ($row['I5R1C1'] == 1) ? 'SI' : 'NO'?></td>
							</tr>
						</table>
					</fieldset>
					<fieldset style='border-style: solid; border-width: 1px'>
						<h5 class='numeral'><b>I.6</b></h5>
						<table>
							<tr>
								<td style='padding: 5px'>
									 Durante el per&iacute;odo <?php echo $anterior . " - " . $vig?>, &iquest;su empresa abandon&oacute; alg&uacute;n proyecto
									 para la introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados, o para la implementaci&oacute;n
									 de procesos nuevos o significativamente mejorados, de m&eacute;todos organizativos nuevos, o de t&eacute;cnicas de
									 comercializaci&oacute;n nuevas, ya sea que lo hubiese iniciado durante este per&iacute;odo o en per&iacute;odos anteriores? 
								</td>
								<td style='padding: 5px'><?php echo ($row['I6R1C1'] == 1) ? 'SI' : 'NO'?></td>
							</tr>
						</table>
					</fieldset>
					<fieldset style='border-style: solid; border-width: 1px'>
						<h5 class='numeral'><b>I.7</b></h5>
						<table>
							<tr>
								<td style='padding: 5px'>
									 Durante el per&iacute;odo <?php echo $anterior . " - " . $vig?>, &iquest;tuvo su empresa la intenci&oacuten de realizar
									 alg&uacute;n proyecto para la introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados,
									 y/o la implementaci&oacute;n de procesos nuevos o significativamente mejorados, de m&eacute;todos organizativos 
									 nuevos, o de t&eacute;cnicas de comercializaci&oacute;n nuevas? 
								</td>
								<td style='padding: 5px'><?php echo ($row['I7R1C1'] == 1) ? 'SI' : 'NO'?></td>
							</tr>
						</table>
					</fieldset>
					<fieldset style='border-style: solid; border-width: 1px'>
						<h5 class='numeral'><b>I.8 En el per&iacute;odo <?php echo $anterior . " - " . $vig?>, su empresa obtuvo alg&uacute;n contrato para proveer servicios o bienes a...</b></h5>
						<table>
							<tr>
								 <td style='padding: 5px'><b>1. </b>Entidades del sector p&uacute;blico nacional?</td>
								 <td style='padding: 5px'><?php echo ($row['I8R1C1'] == 1) ? 'SI' : 'NO'?></td>
							</tr>
							<tr>
								 <td style='padding: 5px'><b>2. </b>Entidades del sector p&uacute;blico extranjero?</td>
								 <td style='padding: 5px'><?php echo ($row['I8R2C1'] == 1) ? 'SI' : 'NO'?></td>
							</tr>
						</table>
					</fieldset>
					<fieldset style='border-style: solid; border-width: 1px'>
						<h5 class='numeral'><b>I.9 Dentro de los contratos que su empresa realiz&oacute; con entidades del sector 
							p&uacute;blico (pregunta I.8) &iquest;se estableci&oacute; el suministro de alguno(s) de los servicios o bienes nuevos 
							o significativamente mejorados que su empresa introdujo durante el per&iacute;odo <?php echo $anterior . " - " . $vig?> 
							(pregunta I.1 opciones 1 a 6)...</b></h5>
						<table>
							<tr>
								 <td style='padding: 5px'><b>1. </b>Con entidades del sector p&uacute;blico nacional?</td>
								 <td style='padding: 5px'><?php echo ($row['I9R1C1'] == 1) ? 'SI' : 'NO'?></td>
							</tr>
							<tr>
								 <td style='padding: 5px'><b>2. </b>Con entidades del sector p&uacute;blico extranjero?</td>
								 <td style='padding: 5px'><?php echo ($row['I9R2C1'] == 1) ? 'SI' : 'NO'?></td>
							</tr>
						</table>
					</fieldset>
					<fieldset style='border-style: solid; border-width: 1px'>
						<h5 class='numeral'><b>I.10 Se&ntilde;ale el grado de importancia que tuvieron los siguientes obst&aacute;culos,
							para la introducci&oacute;n de servicios o bienes nuevos o significativamente mejorados, y/o la implementaci&oacute;n
							de procesos nuevos o significativamente mejorados, de m&eacute;todos organizativos nuevos, o de t&eacute;cnicas
							de comercializaci&oacute;n nuevas en su empresa, durante el per&iacute;odo <?php echo $anterior . " - " . $vig?>:</b></h5>
						<table>
							<tr>
								<td style='padding: 5px'><b>Obst&aacute;culos asociados a informaci&oacute;n y capacidades internas</b></td>
								<td style='padding: 5px'><b>Grado de Importancia</b></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>1. </b>Escasez de recursos propios</td>
								<?php $valorI = $row['I10R1C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>2. </b>Falta de personal calificado</td>
								<?php $valorI = $row['I10R2C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>3. </b>Dificultad para el cumplimiento de regulaciones y reglamentos t&eacute;cnicos</td>
								<?php $valorI = $row['I10R3C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>4. </b>Escasa informaci&oacute;n sobre mercados</td>
								<?php $valorI = $row['I10R4C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>5. </b>Escasa informaci&oacute;n sobre tecnolog&iacute;a disponible</td>
								<?php $valorI = $row['I10R5C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>6. </b>Escasa informaci&oacute;n sobre instrumentos p&uacute;blicos de apoyo</td>
								<?php $valorI = $row['I10R6C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td colspan='2' style='padding: 5px'><b>Obst&aacute;culos asociados a riesgos</b></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>7. </b>Incertidumbre frente a la demanda de servicios o bienes innovadores</td>
								<?php $valorI = $row['I10R7C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>8. </b>Incertidumbre frente al &eacute;xito en la ejecuci&oacute;n t&eacute;cnica del proyecto</td>
								<?php $valorI = $row['I10R8C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>9. </b>Baja rentabilidad de la innovaci&oacute;n</td>
								<?php $valorI = $row['I10R9C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td colspan='2' style='padding: 5px'><b>Obst&aacute;culos asociados al entorno</b></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>10 </b>Dificultades para acceder a financiamiento externo a la empresa</td>
								<?php $valorI = $row['I10R10C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>11 </b>Escasas posibilidades de cooperaci&oacute;n con otras empresas o instituciones</td>
								<?php $valorI = $row['I10R11C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>12 </b>Facilidad de imitaci&oacute;n por terceros</td>
								<?php $valorI = $row['I10R12C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>13 </b>Insuficiente capacidad del sistema de propiedad intelectual para proteger la innovaci&oacute;n</td>
								<?php $valorI = $row['I10R13C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
							<tr>
								<td style='padding: 5px'><b>14 </b>Baja oferta de servicios de inspecci&oacute;n, pruebas, calibraci&oacute;n, certificaci&oacute;n y verificaci&oacute;n</td>
								<?php $valorI = $row['I10R14C1']; ?>
								<td style='padding: 5px'><?php echo $gradoI[$valorI] ?></td>
							</tr>
						</table>
					</fieldset>
					<fieldset style='border-style: solid; border-width: 1px'>
						<h4 style='font-family: arial'>Observaciones</h4>
						<div class='col-xs-6' style='padding-bottom: 10px'>
							<textarea class='form-control' rows='2' name='observaciones' id='obsfte' <?php echo $estadObs ?>><?php echo $row['OBSERVACIONES'] ?></textarea>
						</div>
					</fieldset>
	 		</form>
	 		<div class='nvapag'></div>
