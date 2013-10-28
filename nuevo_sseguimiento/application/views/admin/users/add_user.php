<div id="add_user">
	<div id="msj">
		<?php 							
		echo isset($msj)?$msj:'';
		echo validation_errors();
		?>																						
	</div>																																																																																					
	<?php echo form_open('admin/users/add',array('id'=>'form_add_users')); ?>	
	<div class="cont_left">																													
	<label>Nombre: *</label><input type="text" name="nombre" value="<?php echo set_value('nombre'); ?>">		
	<label>Apellido Paterno: *</label><input type="text" name="a_paterno" value="<?php echo set_value('a_paterno'); ?>">			
	<label>Apellido Materno: </label><input type="text" name="a_materno" value="<?php echo set_value('a_materno'); ?>">							
	<label>Descripción del puesto o rol que funge esta persona: *</label><textarea name="descripcion"><?php echo set_value('descripcion'); ?></textarea>			
	</div>															
	<div class="cont_right">
	<label>Tipo de usuario: *</label>
	<select name="tipo">																															
		<?php foreach($tipos as $tipo){ ?>		
		<option value="<?php echo $tipo->id_tipo; ?>"  <?php echo set_select('tipo', $tipo->id_tipo); ?>><?php echo $tipo->rol; ?></option>												
		<?php } ?>																														
	<select/>																																																													
	<label>Username: *</label><input type="text" name="username" value="<?php echo set_value('username'); ?>">							
	<label>Password: *</label><input type="password" name="pass">										
	<label>Confirmar Password:</label><input type="password" name="repass">												
	<label>Correo electronico principal: *</label><input type="text" name="email_1" value="<?php echo set_value('email_1'); ?>">		
	<label>Correo electronico secundario:</label><input type="text" name="email_2"  value="<?php echo set_value('email_2'); ?>">						
	</div>																										
	<div class="clear"></div>										
	<div id="m_notificacion"><input type="checkbox" name="notificacion" value="1"><label>Este usuario recibirá notificaciones vía correo electrónico</label></div>
	<div>
		<input type="hidden" id="programas" name="programas">
	</div>					
	<div class="cont_right">			
	<div id="usuario_programas">
		Programas:				
		<ul></ul></div>
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
	<div><input type="button" name="agregar_programas" id="agregar_programas" value="Agregar programa"></div>																																							
	<div id="bpos"><button name="enviar">Enviar</button></div>																									
	</form>																																																																																						
</div>																								