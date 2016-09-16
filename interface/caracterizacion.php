<!-- Contenedor de la caracterizacion -->
		<div id="caracterizacion" class="text-center hidden">
			<div class="container-fluid small">
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Cantidad de vacantes abiertas</label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right subVac solo-numero validar' id='' name='i1r2c' value = "0" maxlength="3"  required/>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">&Aacute;rea funcional</label>
					<div class='small'>
						<select class='form-control input-sm validar' id="" name="i1r2c" required>
							<option value=""> Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >Área de dirección general</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >Área de administración</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >Área de mercadeo/ventas</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >Área de producción</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >Área de contabilidad y finanzas</option>
							<option value="6" <?php //echo ($row['i1r2c'] == 6) ? 'checked' : '';  ?> >Personal de Investigación y desarrollo</option>
							<option value="7" <?php //echo ($row['i1r2c'] == 7) ? 'checked' : '';  ?> >Personal de apoyo</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Mínimo nivel educativo requerido</label>
					<div class='small'>
						<select class='form-control input-sm validar' id="" name="i1r2c" required>
							<option value="" > Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >No bachiller</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >Educación básica secundaria (6° - 9°)</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >Educación media   (10° - 13°)</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >Técnico laboral</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >Técnico profesional</option>
							<option value="6" <?php //echo ($row['i1r2c'] == 6) ? 'checked' : '';  ?> >Tecnólogo</option>
							<option value="7" <?php //echo ($row['i1r2c'] == 7) ? 'checked' : '';  ?> >Estudiante universitario</option>
							<option value="8" <?php //echo ($row['i1r2c'] == 8) ? 'checked' : '';  ?> >Profesional universitario</option>
							<option value="9" <?php //echo ($row['i1r2c'] == 9) ? 'checked' : '';  ?> >Especialización </option>
							<option value="10" <?php //echo ($row['i1r2c'] == 10) ? 'checked' : '';  ?> >Maestría</option>
							<option value="11" <?php //echo ($row['i1r2c'] == 11) ? 'checked' : '';  ?> >Doctorado</option>
							<option value="12" <?php //echo ($row['i1r2c'] == 12) ? 'checked' : '';  ?> >No requiere estudios</option>
						</select>
					</div>
				</div>

			</div>

			<div class="container-fluid small">
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Área de Formación</label>
					<div class='small'>
						<select class='form-control input-sm validar' id="" name="i1r2c" required>
							<option value="" > Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >Economía, Administración y Contaduría</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >Ingeniería, Arquitectura Urbanismo y afines</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >Ciencias Sociales y humanas</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >Ciencias de la educación</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >Ciencias de la salud</option>
							<option value="6" <?php //echo ($row['i1r2c'] == 6) ? 'checked' : '';  ?> >Bellas artes</option>
							<option value="7" <?php //echo ($row['i1r2c'] == 7) ? 'checked' : '';  ?> >Agronomía, Veterinaria</option>
							<option value="8" <?php //echo ($row['i1r2c'] == 8) ? 'checked' : '';  ?> >Matemáticas y ciencias naturales</option>
							<option value="9" <?php //echo ($row['i1r2c'] == 9) ? 'checked' : '';  ?> >No aplica</option>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Experiencia en meses</label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='i1r2c' maxlength="3" value = "<?php //echo $row['i1r2c']?>" maxlength="9" required />
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Modalidad de Contratación</label>
					<div class='small'>
						<select class='form-control input-sm validar' id="" name="i1r2c" required>
							<option value="" > Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >Término Indefinido</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >Término  Fijo</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >Prestación de servicios</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >Por  obra  o  labor  contratada</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >Ocasional ó Transitorio</option>
						</select>
					</div>
				</div>
			</div>

			<div class="container-fluid small">
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Salario u honorarios mensuales</label>
					<div class='input-group input-group-sm'>
						<span class="input-group-addon" id="sizing-addon1">$</span>
						<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='i1r2c' maxlength="9" value = "<?php //echo $row['i1r2c']?>" maxlength="9" placeholder="Valor digitado en pesos" required />
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">Edad</label>
					<div class='input-group input-group-sm'>
						<span class="input-group-addon" id="sizing-addon1">Desde</span>
						<select class='form-control input-sm validar' id="" name="i1r2c" required>
							<option value="" > Seleccione una opción</option>
							<?php for ($i=15; $i <= 90; $i+=5) { ?>
								<option value="<?php echo $i; ?>" > <?php echo $i; ?> </option>
							<?php } ?>
						</select>

						<span class="input-group-addon" id="sizing-addon1">Hasta</span>
						<select class='form-control input-sm validar' id="" name="i1r2c" required>
							<option value="" > Seleccione una opción</option>
							<?php for ($i=15; $i <= 90; $i+=5) { ?>
								<option value="<?php echo $i; ?>" > <?php echo $i; ?> </option>
							<?php } ?>
						</select>
					</div>

					<!-- <div class='small'>
						<select class='form-control input-sm validar' id="" name="i1r2c" required>
							<option value="" > Seleccione una opción</option>
							<option value="1" <?php //echo ($row['i1r2c'] == 1) ? 'checked' : '';  ?> >15 - 20</option>
							<option value="2" <?php //echo ($row['i1r2c'] == 2) ? 'checked' : '';  ?> >20 - 25</option>
							<option value="3" <?php //echo ($row['i1r2c'] == 3) ? 'checked' : '';  ?> >25 - 30</option>
							<option value="4" <?php //echo ($row['i1r2c'] == 4) ? 'checked' : '';  ?> >30 - 35</option>
							<option value="5" <?php //echo ($row['i1r2c'] == 5) ? 'checked' : '';  ?> >35 - 40</option>
							<option value="6" <?php //echo ($row['i1r2c'] == 6) ? 'checked' : '';  ?> >40 - 45</option>
							<option value="7" <?php //echo ($row['i1r2c'] == 7) ? 'checked' : '';  ?> >45 - 50</option>
							<option value="8" <?php //echo ($row['i1r2c'] == 8) ? 'checked' : '';  ?> >50 - 55</option>
							<option value="9" <?php //echo ($row['i1r2c'] == 9) ? 'checked' : '';  ?> >55 - 60</option>
							<option value="10" <?php //echo ($row['i1r2c'] == 10) ? 'checked' : '';  ?> >60 - 65</option>
							<option value="11" <?php //echo ($row['i1r2c'] == 11) ? 'checked' : '';  ?> >65 - 70</option>
							<option value="12" <?php //echo ($row['i1r2c'] == 12) ? 'checked' : '';  ?> >70 - 75</option>
							<option value="13" <?php //echo ($row['i1r2c'] == 13) ? 'checked' : '';  ?> >75 - 80</option>
							<option value="14" <?php //echo ($row['i1r2c'] == 14) ? 'checked' : '';  ?> >80 - 85</option>
							<option value="15" <?php //echo ($row['i1r2c'] == 15) ? 'checked' : '';  ?> >85 - 90</option>
							<option value="16" <?php //echo ($row['i1r2c'] == 16) ? 'checked' : '';  ?> >Indiferente</option>
						</select>
					</div> -->
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">De las vacantes ¿Cuántas logró cubrir?</label>
					<div class='small'>
						<input type='text' class='form-control input-sm validar text-right solo-numero' id='' name='i1r2c' value = "0" maxlength="3" required />
					</div>
				</div>
			</div>

			<div class="container-fluid small">
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">De las vacantes cubiertas ¿cuantas se ocuparon con hombres?</label>
					<div class='small'>
						<input type='text' class='form-control input-sm validar text-right solo-numero' id='' name='i1r2c' value = "0" maxlength="3" required />
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">De las vacantes cubiertas ¿Cuántas se ocuparon con mujeres?</label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='i1r2c' value = "0" maxlength="3" readonly required />
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-3 ">
					<label class="">De las vacantes ¿Cuántas NO logró cubrir? </label>
					<div class='small'>
						<input type='text' class='form-control input-sm text-right validar solo-numero' id='' name='i1r2c' value = "0" maxlength="3" readonly required />
					</div>
				</div>

			</div>

			<div class="container-fluid small">
				<label>De las vacantes NO cubiertas ¿Cuáles fueron las causas?</label>
				<div class="alert alert-danger text-center hidden" role="alert">
					DEBE SELECCIONAR M&Iacute;NIMO UNA DE LAS OPCIONES
				</div>
				<div class="form-group form-group-sm col-xs-12 col-sm-12 text-left">
					<div class="checkbox col-xs-4">
						<label>
							<input type="checkbox" class="validar" name='i1r2c' value="0" disabled>
							La remuneración ofrecida era insuficiente
						</label>
					</div>
					<div class="checkbox col-xs-4">
						<label>
							<input type="checkbox" class="validar" name='i1r2c' value="0" disabled>
							Postulantes sub-calificados
						</label>
					</div>
					<div class="checkbox col-xs-4">
						<label>
							<input type="checkbox" class="validar" name='i1r2c' value="0" disabled>
							Postulantes sobre-calificados
						</label>
					</div>
				</div>
				<div class="form-group form-group-sm col-xs-12 col-sm-12 text-left">
					<div class="checkbox col-xs-4">
						<label>
							<input type="checkbox" class="validar" name='i1r2c' value="0" disabled>
							Falta de experiencia o conocimiento específico
						</label>
					</div>
					<div class="checkbox col-xs-4">
						<label>
							<input type="checkbox" class="validar" name='i1r2c' value="0" disabled>
							Los postulantes no dominaban otros idiomas
						</label>
					</div>
					<div class="checkbox col-xs-4">
						<label>
							<input type="checkbox" class="validar" name='i1r2c' value="0" disabled>
							Pocos postulantes
						</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1 text-left">
					<div class="checkbox">
						<label>
							<input type="checkbox" class="validar" name='i1r2c' value="0" disabled>Otra
						</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-1"></div>
				<div class="form-group form-group-sm col-xs-12 col-sm-8">
					<label class="">Cual?</label>
					<div>
						<input type='text' class='form-control input-sm validar' id='' name='i1r2c' value = "<?php //echo $row['i1r2c']?>" maxlength="50" disabled />
					</div>
				</div>
			</div>
		</div>
		<!-- Contenedor de la caracterizacion -->