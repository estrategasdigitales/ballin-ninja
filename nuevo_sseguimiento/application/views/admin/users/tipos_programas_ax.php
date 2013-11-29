		<option value="0">Todos los programas</option>	
		<?php 																																																	
			foreach($tipos_programas as $tipo_programa)
			{																													
		?>				
			<option value="<?php echo $tipo_programa->program_type; ?>"><?php echo $tipo_programa->type; ?></option>
		<?php 						
			}							
		?>