<?php echo $this->load->view('admin/graficas/menu_graficas'); ?>
<header>
<script src="<?php echo base_url('includes/highcharts/js/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('includes/highcharts/js/modules/exporting.js'); ?>"></script>	
<script src="<?php echo base_url('includes/admin/js/graficas.js'); ?>"></script>		
</header>																	
Grafica del <input type="text" name="fecha_inicio" id="fecha_inicio"> al <input type="text" name="fecha_fin" id="fecha_fin">
<div id="area_programa">																								
	<div>																																														
	<label>Disciplinas: *</label>						
	<select name="id_discipline" id="id_discipline">		
		<option value="0">Todas las disciplinas</option>																																											
		<?php foreach($disciplinas as $disciplina){ ?>		
		<option value="<?php echo $disciplina->id_discipline; ?>"  <?php echo set_select('id_discipline', $disciplina->id_discipline); ?>><?php echo $disciplina->discipline; ?></option>												
		<?php } ?>																																																										
	</select>																		
	</div>				     																												
</div>																								
<input type="button" name="b_area_programa" id="b_area_programa" value="Graficar">
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                    