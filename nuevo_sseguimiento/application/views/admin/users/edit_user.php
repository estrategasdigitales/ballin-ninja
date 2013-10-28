<div id="edit_user">
	<div id="msj">
		<?php 											
		echo isset($msj)?$msj:'';
		echo validation_errors();
		?>																														
	</div>																																																																																																																				
	<?php echo form_open('admin/users/update',array('id'=>'form_update_users')); ?>																
	<input type="hidden" name="user_uuid" value="<?php echo $user_uuid; ?>">	
	<div class="cont_left">		
	<label>Nombre:</label><input type="text" name="nombre" value="<?php echo $nombre; ?>">			
	<label>Apellido Paterno:</label><input type="text" name="a_paterno" value="<?php echo $a_paterno; ?>">				
	<label>Apellido Materno:</label><input type="text" name="a_materno" value="<?php echo $a_materno; ?>">							
	<label>Descripción del puesto o rol que funge esta persona:</label><textarea name="descripcion"><?php echo $descripcion; ?></textarea>			
	</div>																												
	<div class="cont_right">
	<label>Tipo de usuario: *</label>
	<select name="tipo">																																	
		<?php foreach($tipos as $tipo){ 
			$selected = ($tipo->id_tipo==$tipo_selected)?TRUE:''; 
		?>																										
		<option value="<?php echo $tipo->id_tipo; ?>" <?php echo set_select('tipo', $tipo->id_tipo, $selected); ?>><?php echo $tipo->rol; ?></option>												
		<?php } ?>																														
	<select/>							
	<label>Username:</label><input type="text" name="username" value="<?php echo $username; ?>">		
	<label>Password:</label><input type="password" name="pass" value="<?php echo $pass; ?>">		
	<label>Confirmar Password:</label><input type="password" name="repass" value="<?php echo $pass; ?>">																					
	<label>Email 1:</label><input type="text" name="email_1" value="<?php echo $email_1; ?>">
	<label>Email 2:</label><input type="text" name="email_2" value="<?php echo $email_2; ?>">
	</div>																			
	<div class="clear"></div>										
	<div id="m_notificacion">																																							
	<?php $checked = ($notificacion==1)?'checked':''; ?>												 												
	<input type="checkbox" value="1" name="notificacion" <?php echo $checked; ?>><label>Este usuario recibirá notificaciones vía correo electrónico</label>
	</div>
	<div>
		<input type="hidden" id="programas" name="programas">
	</div>			
	<div class="cont_right">																
	<div id="usuario_programas">			
		Programas:			
		<ul>										
		<?php 			
			if(!empty($usuarios_programas)){
				foreach($usuarios_programas as $usuario_programa){
		?>																																																																												
				<li><?php echo $usuario_programa->program_name; ?><a href="#"><div id="<?php echo $usuario_programa->id_usuario_programa; ?>">X</div></a></li>
		<?php								
				}						
			}		
		?>
		</ul>							
	</div>																	
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
	<div><input type="button" name="agregar_programas" id="agregar_programas" value="Agregar programas"></div>																																																																								
	<div id="bpos"><button name="enviar">Enviar</button></div>				
	</form>																																																																																																
</div>																	