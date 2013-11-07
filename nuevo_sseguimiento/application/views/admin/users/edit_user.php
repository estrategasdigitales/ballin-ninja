<div id="add_edit_user">
	<div id="msj">								
		<?php 											
		echo isset($msj)?$msj:'';
		echo validation_errors();
		?>																														
	</div>
	<h2>Editar usuario</h2>																																																																																																																																			
	<?php echo form_open('admin/users/update',array('id'=>'form_update_users')); ?>																
	<input type="hidden" name="user_uuid" value="<?php echo $user_uuid; ?>">	
	<div class="cont_left">								
		<p><label>Nombre:</label><input type="text" name="nombre" value="<?php echo $nombre; ?>"></p>			
		<p><label>Apellido Paterno:</label><input type="text" name="a_paterno" value="<?php echo $a_paterno; ?>"></p>				
		<p><label>Apellido Materno:</label><input type="text" name="a_materno" value="<?php echo $a_materno; ?>"></p>							
		<p>Descripción del puesto o rol que funge esta persona:<textarea name="descripcion"><?php echo $descripcion; ?></textarea></p>			
	</div>																												
	<div class="cont_right">
		<div>
			<label>Tipo de usuario: *</label>
			<select name="tipo" id="tipo">													
				<option value="0">Selecciona el tipo de usuario</option>																																
				<?php foreach($tipos as $tipo){ 
					$selected = ($tipo->id_tipo==$tipo_selected)?TRUE:''; 
				?>																										
				<option value="<?php echo $tipo->id_tipo; ?>" <?php echo set_select('tipo', $tipo->id_tipo, $selected); ?>><?php echo $tipo->rol; ?></option>												
				<?php } ?>																																	
			<select/>
		</div>													
		<p><label>Username:</label><input type="text" name="username" value="<?php echo $username; ?>"></p>		
		<p><label>Password:</label><input type="password" name="pass" value="<?php echo $pass; ?>"></p>		
		<p><label>Confirmar Password:</label><input type="password" name="repass" value="<?php echo $pass; ?>"></p>																					
		<p><label>Email 1:</label><input type="text" name="email_1" value="<?php echo $email_1; ?>"></p>
		<p><label>Email 2:</label><input type="text" name="email_2" value="<?php echo $email_2; ?>"></p>
	</div>																							
	<div class="clear"></div>																		
	<div class="cont_left">
		<div id="m_notificacion">																																							
			<?php $checked = ($notificacion==1)?'checked':''; ?>												 												
			<input type="checkbox" value="1" name="notificacion" <?php echo $checked; ?>><label>Este usuario recibirá notificaciones vía correo electrónico</label>
			<input type="hidden" id="programas" name="programas">
		</div>
		<p>
			<label>Disciplinas: *</label>					
			<select name="id_discipline" id="id_discipline">
				<option value="0">Selecciona la disciplina</option>																																											
				<?php foreach($disciplinas as $disciplina){ ?>		
				<option value="<?php echo $disciplina->id_discipline; ?>"  <?php echo set_select('id_discipline', $disciplina->id_discipline); ?>><?php echo $disciplina->discipline; ?></option>												
				<?php } ?>																																																												
			<select/>
		</p>
		<p>
			<label>Tipo de programa: *</label>								
			<select name="program_type" id="program_type">																																													
				<option value="0">Selecciona el tipo de programa</option>																																																																																																																
			<select/>
		</p>
		<p>
			<label>Programas: *</label>								
			<select name="id_program" id="id_program">																																													
				<option value="0">Selecciona un programa</option>																																																																			
			<select/>
		</p>
		<p>
			<?php $disabled = ($tipo_selected==1)?'disabled':''; ?>											
			<input type="button" name="agregar_programas" id="agregar_programas" value="Agregar programas" <?php echo $disabled; ?>>
		</p>	
	</div>				
	<div class="cont_right">																
		<div id="usuario_programas">												
			<ul>										
			<?php 			
				if(!empty($usuarios_programas)){
			?>												
					Programas:
			<?php		
					foreach($usuarios_programas as $usuario_programa){
			?>																																																																																									
					<li><?php echo $usuario_programa->program_name; ?><a href="#"><div id="<?php echo $usuario_programa->id_usuario_programa; ?>"><?php echo img('includes/admin/images/delete.png'); ?></div></a></li>
			<?php								
					}						
				}						
			?>
			</ul>										
		</div>																	
	</div>
	<div class="clear"></div>																																																																																												
	<div id="bpos">
		<button name="enviar">Enviar</button>
	</div>				
	</form>																																																																																																			
</div>																	