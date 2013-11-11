<?php echo $this->load->view('admin/graficas/menu_graficas'); ?>
<header>
<script src="<?php echo base_url('includes/highcharts/js/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('includes/highcharts/js/modules/exporting.js'); ?>"></script>	
<script src="<?php echo base_url('includes/admin/js/graficas.js'); ?>"></script>		
</header>																	
Grafica del <input type="text" name="fecha_inicio" id="fecha_inicio"> al <input type="text" name="fecha_fin" id="fecha_fin">
<div id="filtro_graficas">			
		<p>																																			
			<label>Disciplinas: *</label>												
			<select name="id_discipline" id="id_discipline">
				<option value="0">Todas las disciplinas</option>																																											
				<?php foreach($disciplinas as $disciplina){ ?>		
				<option value="<?php echo $disciplina->id_discipline; ?>"  <?php echo set_select('id_discipline', $disciplina->id_discipline); ?>><?php echo $disciplina->discipline; ?></option>												
				<?php } ?>																																																														
			</select>			
		</p>												
		<p>			
			<label>Tipo de programa: *</label>								
			<select name="program_type" id="program_type">																																													
				<option value="0">Selecciona el tipo de programa</option>																																																																																																																
			</select>
		</p>								
		<p>
			<label>Programas: *</label>								
			<select name="id_program" id="id_program">																																													
				<option value="0">Selecciona un programa</option>																																																																			
			</select>						
		</p>										
</div>																														     																																																										
<input type="button" name="b_exalumno" id="b_exalumno" value="Graficar">
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>