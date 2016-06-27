<div id="idediteas" class="modal fade" role="dialog">
			<div class="modal-dialog modal-width">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" style='font-family: arial'>EDIT - EAS - <?php echo $nombre ?></h4>
					</div>
					<div class="modal-body">
						<table class='table table-bordered'>
							<tr style='font-size: 8px'>
								<td rowspan='2'>No.Ord.</td>
								<td rowspan='2'>Sede</td>
								<td rowspan='2'>Nit</td>
								<td rowspan='2'>Nombre Comercial</td>
								<td colspan='8' style='text-align: center'><b>ENCUESTA ANUAL DE COMERCIO Y ANUAL DE SERVICIOS INF. 2014</b></td>
								<td colspan='3' style='text-align: center'><b>INFORMACI&Oacute;N SERVICIOS EDIT 2012-2013</b></td>
								<td colspan='3' style='text-align: center'><b>INFORMACI&Oacute;N INDUSTRIA(edici&oacute;n) EDIT 2013-2014</b></td>
								<td rowspan='2'><b>PROY. EN M.</b></td>
								<td rowspan='2'>Nov. EDIT</td>
								<td rowspan='2'>Dir. Base</td>
							</tr>
							<tr style='font-size: 8px'>
								<td>CIIU4</td>
								<td>Nov.</td>
								<td>Pers. Tot.</td>
								<td>Total Ing.</td>
								<td>Otros Ing.</td>
								<td>Maq. y Eq.</td>
								<td>Eq. Inf. y Telec.</td>
								<td>Software</td>
								<td>Pers. Tot. 2012</td>
								<td>Pers. Tot. 2013</td>
								<td>Total Ventas 2013</td>
								<td>Pers. Tot. 2013</td>
								<td>Pers. Tot. 2014</td>
								<td>Total Ventas 2014</td>
							</tr>	
							<tr style='font-size: 8px'>
								<td><?php echo $rowEditEas['nordemp'] ?></td>
								<td><?php echo $rowEditEas['nombre_regional'] ?></td>
								<td><?php echo $rowEditEas['numdoc']?></td>
								<td><?php echo $rowEditEas['nombre'] ?></td>
								<td><?php echo $rowEditEas['ciiu3'] ?></td>
								<td><?php echo $rowEditEas['novedad'] ?></td>
								<td><?php echo $rowEditEas['personal'] ?></td>
								<td><?php echo $rowEditEas['ingresos'] ?></td>
								<td><?php echo $rowEditEas['otrosing'] ?></td>
								<td><?php echo $rowEditEas['maqyeq'] ?></td>
								<td><?php echo $rowEditEas['eqinf'] ?></td>
								<td><?php echo $rowEditEas['software']?></td>
								<td><?php echo $rowEditEas['pertot_edit_a1'] ?></td>
								<td><?php echo $rowEditEas['pertot_edit_a2'] ?></td>
								<td><?php echo $rowEditEas['vtas_edit_a1'] ?></td>
								<td><?php echo $rowEditEas['pertot_edit_i1'] ?></td>
								<td><?php echo $rowEditEas['pertot_edit_i2'] ?></td>
								<td><?php echo $rowEditEas['vtas_edit_i1'] ?></td>
								<td><?php echo $rowEditEas['enmarcha'] ?></td>
								<td><?php echo $rowEditEas['novant']?></td>
								<td><?php echo $rowEditEas['dirbase']?></td>
							</tr>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" id="cierra">Cerrar</button>
					</div>
				</div>
			</div>
		</div>