<?php
	$qCap5 = $conn->query("SELECT * FROM capitulo_v WHERE vigencia = $vig AND C5_nordemp = $numero");
	foreach ($qCap5 AS $row5) {
		$a=1;
	}
	
	$bloquea5 = false;
	$qC1 = $conn->query("SELECT * FROM capitulo_i WHERE C1_nordemp = $numero AND vigencia = $vig");
	foreach ($qC1 AS $rowC1) {
		$b=1;
	}
	if ($rowC1['I1R1C1N']!=1 AND $rowC1['I1R2C1N']!=1 AND $rowC1['I1R3C1N']!=1 AND $rowC1['I1R1C1M']!=1 AND $rowC1['I1R2C1M']!=1 AND $rowC1['I1R3C1M']!=1
		AND $rowC1['I1R4C1']!=1 AND $rowC1['I1R5C1']!=1 AND $rowC1['I1R6C1']!=1 AND $rowC1['I5R1C1']!=1 AND $rowC1['I6R1C1']!=1 AND $rowC1['I7R1C1']!=1) {
		$bloquea5 = true;
	}
?>
		<?php
 			if ($bloquea5) {
 				echo "<h3>No requiere diligenciamiento</h3>";
				echo "<div class='nvapag'></div>";
 			}
 			else {
 		?>
 		<div class="container text-justify" style="font-size: 9px">
 			<b>CAP&Iacute;TULO V - RELACIONES CON ACTORES DEL SISTEMA NACIONAL DE CIENCIA, TECNOLOG&Iacute;A E INNOVACI&Oacute;N Y COOPERACI&Oacute;N
 			PARA LA INNOVACI&Oacute;N EN EL PER&Iacute;ODO <?php echo $anterior . "-" . $vig ?></b><br>
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
		<div class="container text-justify" style="font-size: 9px">
 			<b>&iquest;Quien deber&iacute;a responder este cap&iacute;tulo?:</b>&nbsp;Personas encargadas de la gerencia de proyectos de
 			innovaci&oacute;n con conocimiento de los acuerdos (contractuales o no contractuales) que realiza la empresa a nivel interno y con
 			otras empresas o actores. 
 		</div>
		<form class='form-horizontal' role='form'>
			<div class='container'>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>V.1 Se&ntilde;ale si las siguientes fuentes de informaci&oacute;n y conocimiento fueron
						o no importantes como origen de ideas para desarrollar o implementar servicios o bienes nuevos o significativamente
						mejorados, procesos nuevos o significativamente mejorados, m&eacute;todos organizativos nuevos, o t&eacute;cnicas de
						comercializaci&oacute;n nuevas, durante el per&iacute;odo <?php echo $anterior . "-" . $vig?> en su empresa. Si su respuesta
						es afirmativa para el caso de las fuentes externas, indique la procedencia sea nacional o extranjera.</b></h5>
					<table>
						<tr>
							<td style='padding: 5px'><b>Fuentes Internas a la Empresa</b></td>
							<td style='padding: 5px'>&nbsp;</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>1. </b>Departamento interno de  I + D</td>
							<td style='padding: 5px'><?php echo ($row5['V1R1C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>Departamento de producci&oacute;n</td>
							<td style='padding: 5px'><?php echo ($row5['V1R2C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>Departamento de ventas y mercadeo</td>
							<td style='padding: 5px'><?php echo ($row5['V1R3C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Otro departamento de la empresa</td>
							<td style='padding: 5px'><?php echo ($row5['V1R4C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Grupos interdisciplinarios espec&iacute;ficos para innovar</td>
							<td style='padding: 5px'><?php echo ($row5['V1R5C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>Directivos de la empresa</td>
							<td style='padding: 5px'><?php echo ($row5['V1R6C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>7. </b>Otra empresa relacionada (si hace parte de un conglomerado)</td>
							<td style='padding: 5px'><?php echo ($row5['V1R7C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>8. </b>Casa matriz extranjera</td>
							<td style='padding: 5px'><?php echo ($row5['V1R8C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
					</table>
					<table>
						<tr>
							<td style='padding: 5px'><b>Fuentes Externas a la Empresa</b></td>
							<td style='padding: 5px'>&nbsp;</td>
							<td colspan='4' style='padding: 5px'><b>Procedencia</b></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>9. </b>Departamento I + D de otra empresa del sector</td>
							<td style='padding: 5px'><?php echo ($row5['V1R9C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R9C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R9C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>10. </b>Competidores u otras empresas del sector (excepto el departamento de I + D)</td>
							<td style='padding: 5px'><?php echo ($row5['V1R10C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R10C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R10C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>11. </b>Clientes</td>
							<td style='padding: 5px'><?php echo ($row5['V1R11C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R11C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R11C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>12. </b>Proveedores</td>
							<td style='padding: 5px'><?php echo ($row5['V1R12C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R12C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R12C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>13. </b>Empresas de otro sector</td>
							<td style='padding: 5px'><?php echo ($row5['V1R13C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R13C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R13C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>14. </b>Agremiaciones y/o asociaciones sectoriales</td>
							<td style='padding: 5px'><?php echo ($row5['V1R14C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R14C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R14C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>15. </b>C&aacute;maras de comercio</td>
							<td style='padding: 5px'><?php echo ($row5['V1R15C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R15C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R15C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>16. </b>Centros de Desarrollo Tecnol&oacute;gico (CDT)</td>
							<td style='padding: 5px'><?php echo ($row5['V1R16C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R16C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R16C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>17. </b>Centros de investigaci&oacute;n aut&oacute;nomos</td>
							<td style='padding: 5px'><?php echo ($row5['V1R17C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R17C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R17C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>18. </b>Incubadoras de Empresas de Base Tecnol&oacute;gica (IEBT)</td>
							<td style='padding: 5px'><?php echo ($row5['V1R18C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R18C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R18C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>19. </b>Parques tecnol&oacute;gicos</td>
							<td style='padding: 5px'><?php echo ($row5['V1R19C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R19C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R19C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>20. </b>Centros regionales de productividad</td>
							<td style='padding: 5px'><?php echo ($row5['V1R20C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R20C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R20C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>21. </b>Universidades</td>
							<td style='padding: 5px'><?php echo ($row5['V1R21C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R21C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R21C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>22. </b>Centros de formaci&oacute;n y/o tecnoparques</td>
							<td style='padding: 5px'><?php echo ($row5['V1R22C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R22C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R22C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>23. </b>Consultores, expertos o investigadores</td>
							<td style='padding: 5px'><?php echo ($row5['V1R23C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R23C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R23C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>24. </b>Ferias y exposiciones</td>
							<td style='padding: 5px'><?php echo ($row5['V1R24C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R24C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R24C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>25. </b>Seminarios y conferencias</td>
							<td style='padding: 5px'><?php echo ($row5['V1R25C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R25C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R25C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>26. </b>Libros, revistas o cat&aacute;logos</td>
							<td style='padding: 5px'><?php echo ($row5['V1R26C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R26C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R26C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>27. </b>Sistemas de informaci&oacute;n de propiedad industrial (banco de patentes)</td>
							<td style='padding: 5px'><?php echo ($row5['V1R27C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R27C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R27C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>28. </b>Sistema de informaci&oacute;n de derechos de autor</td>
							<td style='padding: 5px'><?php echo ($row5['V1R28C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R28C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R28C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>29. </b>Internet</td>
							<td style='padding: 5px'><?php echo ($row5['V1R29C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R29C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R29C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>30. </b>Bases de datos cient&iacute;ficas y tecnol&oacute;gicas</td>
							<td style='padding: 5px'><?php echo ($row5['V1R30C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R30C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R30C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>31. </b>Normas y reglamentos t&eacute;cnicos</td>
							<td style='padding: 5px'><?php echo ($row5['V1R31C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R31C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R31C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>32. </b>Instituciones p&uacute;blicas (ministerios, entidades descentralizadas, secretar&iacute;as)</td>
							<td style='padding: 5px'><?php echo ($row5['V1R32C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R32C2'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Nacional</td>
							<td style='padding: 5px'><input type='checkbox' value='1' <?php echo ($row5['V1R32C3'] == 1) ? 'checked' : ''?>></td><td style='padding: 5px'>Extranjera</td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>V.2 Indique si durante el per&iacute;odo <?php echo $anterior . "-" . $vig?> su empresa tuvo
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
					<table>
						<tr>
							<td style='padding: 5px'><b>1. </b>Departamento Administrativo de Ciencia, Tecnolog&iacute;a e Innovaci&oacute;n (COLCIENCIAS)</td>
							<td style='padding: 5px'><?php echo ($row5['V2R1C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>2. </b>SENA</td>
							<td style='padding: 5px'><?php echo ($row5['V2R2C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>3. </b>ICONTEC</td>
							<td style='padding: 5px'><?php echo ($row5['V2R3C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>4. </b>Superintendencia de Industria y Comercio (SIC)</td>
							<td style='padding: 5px'><?php echo ($row5['V2R4C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>5. </b>Direcci&oacute;n nacional de derechos de autor</td>
							<td style='padding: 5px'><?php echo ($row5['V2R5C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>6. </b>Ministerios</td>
							<td style='padding: 5px'><?php echo ($row5['V2R6C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>7. </b>Universidades</td>
							<td style='padding: 5px'><?php echo ($row5['V2R7C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>8. </b>Centros de Desarrollo Tecnol&oacute;gico (CDT)</td>
							<td style='padding: 5px'><?php echo ($row5['V2R8C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>9. </b>Centros de Investigaci&oacute;n Aut&oacute;nomos</td>
							<td style='padding: 5px'><?php echo ($row5['V2R9C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>10. </b>Incubadoras de Empresas de Base Tecnol&oacute;gica (IEBT)</td>
							<td style='padding: 5px'><?php echo ($row5['V2R10C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>11. </b>Parques Tecnol&oacute;gicos</td>
							<td style='padding: 5px'><?php echo ($row5['V2R11C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>12. </b>Centros Regionales de Productividad</td>
							<td style='padding: 5px'><?php echo ($row5['V2R12C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>13. </b>Consejos Departamentales de Ciencia y Tecnolog&iacute;a (CODECyT)</td>
							<td style='padding: 5px'><?php echo ($row5['V2R13C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>14. </b>Comisiones Regionales de Competitividad</td>
							<td style='padding: 5px'><?php echo ($row5['V2R14C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>15. </b>Agremiaciones Sectoriales y C&aacute;maras de Comercio</td>
							<td style='padding: 5px'><?php echo ($row5['V2R15C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>16. </b>Consultores en Innovaci&oacute;n y Desarrollo Tecnol&oacute;gico</td>
							<td style='padding: 5px'><?php echo ($row5['V2R16C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>17. </b>PROEXPORT - PROCOLOMBIA</td>
							<td style='padding: 5px'><?php echo ($row5['V2R17C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>18. </b>BANCOLDEX</td>
							<td style='padding: 5px'><?php echo ($row5['V2R18C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
						<tr>
							<td style='padding: 5px'><b>19. </b>Entidades de formaci&oacute;n t&eacute;cnica y tecnol&oacute;gica (distintas al SENA)</td>
							<td style='padding: 5px'><?php echo ($row5['V2R19C1'] == 1) ? 'SI' : 'NO'?></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h5 class='numeral'><b>V.3 En el per&iacute;odo <?php echo $anterior . "-" . $vig?>, &iquest;Su empresa cooper&oacute;
						con alguno de los siguientes tipos de socios para la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas
						y de innovaci&oacute;n?. Si su respuesta es afirmativa, se&ntilde;ale la ubicaci&oacute;n del socio, ya sea nacional o extranjero, y el
						objetivo de la cooperaci&oacute;n.</b></h5>
					<p>Cooperaci&oacute;n para la realizaci&oacute;n de actividades cient&iacute;ficas, tecnol&oacute;gicas y de innovaci&oacute;n,
						significa la participaci&oacute;n activa con otras empresas o entidades no comerciales en proyectos conjuntos de I+D u otro
						tipo de actividades como las descritas en el Cap&iacute;tulo II de esta encuesta. No implica necesariamente que las dos
						partes obtengan beneficios econ&oacute;micos de la cooperaci&oacute;n. Se excluye la simple contrataci&oacute;n de servicios
						o trabajos de otra organizaci&oacute;n sin cooperaci&oacute;n activa.</p>
					<table>
						<tr>
							<td colspan='2' style='padding: 5px'><b>Tipos de socios</b></td>
							<td style='padding: 5px'><b>Nal</b></td>
							<td style='padding: 5px'><b>Ext</b></td>
							<td style='padding: 5px; font-size: 9px;'>Investigaci&oacute;n y desarrollo (I+D)</td>
							<td style='padding: 5px; font-size: 9px;'>Adquisici&oacute;n de maquinaria y equipo</td>
							<td style='padding: 5px; font-size: 9px;'>Tecnolog&iacute;as de informaci&oacute;n y telecomunicaciones</td>
							<td style='padding: 5px; font-size: 9px;'>Mercadotecnia</td>
							<td style='padding: 5px; font-size: 9px;'>Transf. de tecnolog&iacute;a y/o adqui. de otros conocimientos externos</td>
							<td style='padding: 5px; font-size: 9px;'>Asistencia t&eacute;cnica y consultor&iacute;a</td>
							<td style='padding: 5px; font-size: 9px;'>Ingenier&iacute;a y dise&ntilde;o industrial</td>
							<td style='padding: 5px; font-size: 9px;'>Formaci&oacute;n y capacitaci&oacute;n</td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>1. </b>Otras empresas del mismo grupo (conglomerado)</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R1C1'] == 1) ? 'SI' : 'NO'?></td>
							<td><input type='checkbox' value='1' <?php echo ($row5['V3R1C2'] == 1) ? 'checked' : ''?>></td>
							<td><input type='checkbox' value='1' <?php echo ($row5['V3R1C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R1C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R1C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R1C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R1C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R1C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R1C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R1C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R1C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>2. </b>Proveedores</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R2C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R2C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R2C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R2C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R2C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R2C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R2C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R2C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R2C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R2C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R2C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>3. </b>Clientes</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R3C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R3C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R3C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R3C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R3C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R3C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R3C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R3C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R3C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R3C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R3C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>4. </b>Competidores</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R4C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R4C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R4C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R4C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R4C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R4C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R4C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R4C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R4C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R4C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R4C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>5. </b>Consultores, Expertos o Investigadores</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R5C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R5C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R5C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R5C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R5C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R5C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R5C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R5C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R5C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R5C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R5C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>6. </b>Universidades</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R6C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R6C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R6C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R6C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R6C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R6C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R6C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R6C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R6C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R6C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R6C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>7. </b>Centros de desarrollo tecnol&oacute;gico</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R7C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R7C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R7C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R7C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R7C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R7C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R7C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R7C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R7C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R7C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R7C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>8. </b>Centros de investigaci&oacute;n aut&oacute;nomos</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R8C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R8C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R8C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R8C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R8C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R8C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R8C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R8C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R8C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R8C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R8C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>9. </b>Parques tecnol&oacute;gicos</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R9C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R9C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R9C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R9C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R9C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R9C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R9C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R9C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R9C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R9C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R9C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>10. </b>Centros regionales de productividad</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R10C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R10C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R10C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R10C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R10C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R10C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R10C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R10C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R10C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R10C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R10C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>11. </b>Organismos no gubernamentales</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R11C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R11C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R11C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R11C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R11C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R11C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R11C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R11C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R11C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R11C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R11C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
						<tr>
							<td style='padding: 5px; font-size: 9px;'><b>12. </b>Gobierno</td>
							<td style='padding: 5px; font-size: 9px;'><?php echo ($row5['V3R12C1'] == 1) ? 'SI' : 'NO'?></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R12C2'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R12C3'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R12C4'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R12C5'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R12C6'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R12C7'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R12C8'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R12C9'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R12C10'] == 1) ? 'checked' : ''?>></td>
							<td style='padding: 5px;'><input type='checkbox' value='1' <?php echo ($row5['V3R12C11'] == 1) ? 'checked' : ''?>></td>
						</tr>
					</table>
				</fieldset>
				<fieldset style='border-style: solid; border-width: 1px'>
					<h4 style='font-family: arial'>Observaciones</h4>
					<div class='col-sm-6' style='padding-bottom: 10px'>
						<textarea class='form-control' rows='2' name='observaciones' id='obsfte' <?php echo $estadObs ?>><?php echo $row5['OBSERVACIONES'] ?></textarea>
					</div>
				</fieldset>
			</div>  
 		</form>
		<div class='nvapag'></div>
		<?php } ?>
