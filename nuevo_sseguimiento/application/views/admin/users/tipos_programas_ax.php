		<option value="0">Selecciona el tipo de programa</option>	
		<?php 																																										
			foreach($tipos_programas as $tipo_programa)
			{																													
		?>				
			<option value="<?php echo $tipo_programa->program_type; ?>"><?php echo $tipo_programa->type; ?></option>
		<?php 						
			}							
		?>