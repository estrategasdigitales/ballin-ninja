<!DOCTYPE html>		
<html>		
<head>				                                  																	
<meta charset="utf-8">
    <title></title>						
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">													       	                                                                   
    <link rel="stylesheet" href="<?php echo base_url('includes/admin/css/estilos.css'); ?>" media="screen">                                                               			  					                                                                 
    <script src="<?php echo base_url('includes/admin/js/jquery-1.8.2.js'); ?>"></script> 
    <script src="<?php echo base_url('includes/admin/js/funcionesGeneralesColorBox.js'); ?>"></script> 
</head>																																																																																														 											    		                                                                 
<body>																								
<div id="msj_">				
	<?php 	
	echo isset($msj)?$msj:''; 
	echo validation_errors(); 
	?>											
</div>																																			
<?php echo form_open_multipart('admin/preinscritos/update',array('id'=>'form_edit_preinscrito')); ?>
<div>																																																																														
	<div id="datos_programa">
		<h1>Programa:</h1>
		<h2><?php echo $program_name; ?></h2>
	</div>														 								
	<div id="datos_generales">						
		<h1>Datos del interesado:</h1>																														
		<p><input type="hidden" name="id_preinscrito" value="<?php echo $id_preinscrito; ?>"></p>																																																																																				
		<p><strong>Nombre:</strong><input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>"></p>					
		<p><strong>Apellido paterno:</strong><input type="text" name="a_paterno" id="a_paterno" value="<?php echo $a_paterno; ?>"></p>		
		<p><strong>Apellido materno:</strong><input type="text" name="a_materno" id="a_materno" value="<?php echo $a_materno; ?>"></p>		
		<p><strong>Fecha de registro:</strong><input type="text" name="fecha_registro" id="fecha_registro" value="<?php echo $fecha_registro; ?>"></p>
		<p><strong>Calle y número:</strong><input type="text" name="calle_numero" id="calle_numero" value="<?php echo $calle_numero; ?>"></p>
		<p><strong>Del o mpo: </strong><input type="text" name="del_mpo" id="del_mpo" value="<?php echo $del_mpo; ?>"></p>
		<p><strong>Cp:</strong><input type="text" name="cp" id="cp" value="<?php echo $cp; ?>"></p>
		<p><strong>Ciudad:</strong><input type="text" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>"></p>
		<p><strong>Estado:</strong><input type="text" name="estado" id="estado" value="<?php echo $estado; ?>"></p>
		<p><strong>Teléfono:</strong><input type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>"></p>
		<p><strong>Celular:</strong><input type="text" name="celular" id="celular" value="<?php echo $celular; ?>"></p>
		<p><strong>RFC:</strong><input type="text" name="rfc" id="rfc" value="<?php echo $rfc; ?>"></p>
		<p><strong>Correo electrónico:</strong><input type="text" name="correo" id="correo" value="<?php echo $correo; ?>"></p>
		<p><strong>Institución de estudios:</strong><input type="text" name="institucion_estudios" id="institucion_estudios" value="<?php echo $institucion_estudios; ?>"></p>
		<p><strong>Nacionalidad:</strong><input type="text" name="nacionalidad" id="nacionalidad" value="<?php echo $nacionalidad; ?>"></p>
		<p><strong>Nivel académico:</strong><input type="text" name="grado_academico" id="grado_academico" value="<?php echo $grado_academico; ?>"></p>
		<p><strong>Exalumno Ibero:</strong><input type="text" name="exalumno" id="exalumno" value="<?php echo $exalumno; ?>"></p>
		<p><strong>¿Cómo se enteró?:</strong><input type="text" name="como_se_entero" id="como_se_entero" value="<?php echo $como_se_entero; ?>"></p>
		<p><strong>¿Porqué la Ibero?:</strong><input type="text" name="porque_la_ibero" id="porque_la_ibero" value="<?php echo $porque_la_ibero; ?>"></p>
		<p><strong>Empresa:</strong><input type="text" name="empresa" id="empresa" value="<?php echo $empresa; ?>"></p>
		<p><strong>Puesto: </strong><input type="text" name="puesto" id="puesto" value="<?php echo $puesto; ?>"></p>
		<p><strong>Dirección de la empresa: </strong><input type="text" name="direccion_empresa" id="direccion_empresa" value="<?php echo $direccion_empresa; ?>"></p>
		<p><strong>Teléfono de la empresa: </strong><input type="text" name="telefono_empresa" id="telefono_empresa" value="<?php echo $telefono_empresa; ?>"></p>																				 																																			
	</div>			
</div>		
<div id="subir_documentos">	
	<h1>Documentos :</h1>				
	<?php 										
		 if(!empty($archivos)){

		 	foreach($archivos as $archivo){
	?>																							
			<div><a href="<?php echo base_url('includes/admin/documentos/'.$archivo->archivo); ?>" target="_blank"><?php echo $archivo->doc_type; ?></a></div>			
	<?php 								
			}																															
		 }else{		
	?>	 			
		<p>No existen documentos.</p>
	<?php 				
		 } 						
	?>																																																																																																							
	<div>Agregar Archivos: <a href="#" id="agregar_input_file"><?php echo img(array('src'=>'includes/admin/images/seguimiento/archivo.png')); ?></a></div>		
	<div><input type="file" name="documento_upload[]"  id="documento_upload"></div>
	<div>Tipo de documento:<input type="text" name="doc_type[]"></div>						 									 																																																																																																			
</div>							
<div class="clear"></div>										
<div id="estatus_proceso">										
	<h1>Estatus del proceso:</h1>	
	<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-top:25px;">
		<tr>
			<td valign="top" width="140" height="50">
				<input type="checkbox" value="1" name="primer_contacto" id="primer_contacto" <?php echo ($primer_contacto==1)?"checked":""; ?>><label>Primer contacto</label>
			</td>
			<td valign="top">
				<a href="#" name="estatus" rel="estatus_primer_contacto"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
				<div id="estatus_primer_contacto" style="display:none;"><textarea name="comment_primercontacto"><?php echo $comment_primercontacto; ?></textarea></div>	
			</td>
		</tr>
		<tr>
			<td valign="top" height="50" class="division_pasos">
				<input type="checkbox" value="1" name="documentos"  id="documentos" <?php echo ($documentos==1)?"checked":""; ?>><label>Documento</label>
			</td>
			<td valign="top" class="division_pasos">
				<a href="#" name="estatus" rel="estatus_documentos"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
				<div id="estatus_documentos" style="display:none;"><textarea name="comment_documentos"><?php echo $comment_documentos; ?></textarea></div>	
			</td>
		</tr>
		<tr>
			<td valign="top" height="50" class="division_pasos">
				<input type="checkbox" value="1" name="envio_decse" id="envio_decse" <?php echo ($envio_decse==1)?"checked":""; ?>><label>Enviar a DECSE</label>	
			</td>
			<td valign="top" class="division_pasos">
				<a href="#" name="estatus" rel="estatus_envio_decse"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
				<div id="estatus_envio_decse" style="display:none;"><textarea name="comment_decse"><?php echo $comment_decse; ?></textarea></div>	
			</td>
		</tr>
		<tr>
			<td valign="top" height="50" class="division_pasos">
				<input type="checkbox" value="1" name="envio_claves"  id="envio_claves" <?php echo ($envio_claves==1)?"checked":""; ?>><label>Envío de claves</label>	
			</td>
			<td valign="top" class="division_pasos">
				<a href="#" name="estatus" rel="estatus_envio_claves"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
				<div id="estatus_envio_claves" style="display:none;"><textarea name="comment_envioclaves"><?php echo $comment_envioclaves; ?></textarea></div>	
			</td>
		</tr>
		<tr>
			<td valign="top" height="50" class="division_pasos">
				<input type="checkbox" value="1" name="pago_realizado"  id="pago_realizado" <?php echo ($pago_realizado==1)?"checked":""; ?>><label>Pago realizado</label>	
			</td>
			<td valign="top" class="division_pasos">
				<a href="#" name="estatus" rel="estatus_pago_realizado"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
				<div id="estatus_pago_realizado" style="display:none;"><textarea name="comment_pagorealizado"><?php echo $comment_pagorealizado; ?></textarea></div>	
			</td>
		</tr>	
	</table>	
</div>																																																																																																		
<div id="clasificar_aspirante">														
	<h1>Clasificación del aspirante</h1>																																																																
	<p><input type="radio" value="caso_cerrado" name="clasificacion" id="caso_cerrado" <?php echo ($caso_cerrado==1)?"checked":""; ?>><label>Caso cerrado</label></p>										 
	<p><input type="radio" value="caso_inconcluso" name="clasificacion"  id="caso_inconcluso" <?php echo ($caso_inconcluso==1)?"checked":""; ?>><label>Caso inconcluso</label></p>										 
	<h2>Informes</h2>																																																																																																	
	<p><input type="checkbox" value="1" name="informes" id="informes" <?php echo ($informes==1)?"checked":""; ?>><label>Informes</label></p>										 
	<p><input type="checkbox" value="1" name="atendido" id="atendido" <?php echo ($atendido==1)?"checked":""; ?>><label>Atendido</label></p>										 		
	<h2>Comentario general</h2>																								
	<p><a href="#" rel="comentarios_comentario_general">Añadir / editar comentario general</a></p>			
	<div id="comentarios_comentario_general" style="display:none;"><textarea name="comentario_general"><?php echo $comentario_general; ?></textarea></div>
</div>					
<div class="clear"></div>	
<div id="editar_preinscrito">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<div id="button_cancelar">																																																																																																																																																																																																																																																																																																				
					<a href="<?php echo base_url("admin/preinscritos/detalle/".$id_preinscrito); ?>">Cancelar</a>												
				</div>
			</td>				
			<td>
				<input type="submit" name="enviar" id="button_guardar" class="boton_general" value="Guardar">	
			</td>
		</tr>
	</table>
</div>																														
	</form>																											
</body>					
</html>														
																	