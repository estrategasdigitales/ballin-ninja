<div id="show_preinscritos">
	<script>		
		$(function() {
			$( document ).tooltip();
		});		
	</script>
	<style>			
		.comment_i{
			display:inline;
		}				
	</style>	
	<div class="jqgrid">
	<div id="msj">
		<?php 										
		echo isset($msj)?$msj:'';
		?>																										
	</div>		
	<div>																
	<label>Disciplinas: *</label>				
	<select name="id_discipline" id="id_discipline">
		<option value="0">Selecciona la disciplina</option>																																											
		<?php foreach($disciplinas as $disciplina){ ?>		
		<option value="<?php echo $disciplina->id_discipline; ?>"  <?php echo set_select('id_discipline', $disciplina->id_discipline); ?>><?php echo $disciplina->discipline; ?></option>												
		<?php } ?>																																																								
	<select/>							
	</div>				
	<div>																																																					
	<label>Tipo de programa: *</label>								
	<select name="program_type" id="program_type">																																													
		<option value="0">Selecciona el tipo de programa</option>																																																																																																																
	<select/>																																																	
	</div>																			
	<div>																																																										
	<label>Programas: *</label>								
	<select name="id_program" id="id_program">																																													
		<option value="0">Selecciona un programa</option>																																																																			
	<select/>																																									
	</div>																																												
	<table id="list_preinscritos"></table><!--Grid table-->
    <div id="pager_preinscritos"></div>  <!--pagination div-->
	</div>	
</div>																																				