	<option value="0">Selecciona el programa</option>	
		<?php 																															
			foreach($programas as $programa)
			{																											

		?>
				<option value="<?php echo $programa->id_program; ?>"><?php echo $programa->program_name; ?></option>
		<?php 						

			}							

	?>