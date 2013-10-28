<!DOCTYPE html>		
<html>		
<head>				                                  																	
<meta charset="utf-8">
    <title></title>						
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">													       	                                                                   
    <link rel="stylesheet" href="<?php echo base_url('includes/admin/css/estilos2.css'); ?>" media="screen">                                                               			  					                                                                 
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
	<div><label>Programa:</label> <?php echo $program_name; ?></div>		
	<div>Datos del interesado:</div>																														
	<div><input type="hidden" name="id_preinscrito" value="<?php echo $id_preinscrito; ?>"></div>																																																																																				
	<div><label>Nombre:</label><input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>"></div>					
	<div><label>Apellido paterno:</label><input type="text" name="a_paterno" id="a_paterno" value="<?php echo $a_paterno; ?>"></div>		
	<div><label>Apellido materno:</label><input type="text" name="a_materno" id="a_materno" value="<?php echo $a_materno; ?>"></div>		
	<div><label>Fecha de registro:</label><input type="text" name="fecha_registro" id="fecha_registro" value="<?php echo $fecha_registro; ?>"></div>
	<div><label>Calle y número:</label><input type="text" name="calle_numero" id="calle_numero" value="<?php echo $calle_numero; ?>"></div>
	<div><label>Del o mpo: </label><input type="text" name="del_mpo" id="del_mpo" value="<?php echo $del_mpo; ?>"></div>

	<div><label>Cp:</label><input type="text" name="cp" id="cp" value="<?php echo $cp; ?>"></div>
	<div><label>Ciudad:</label><input type="text" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>"></div>
	<div><label>Estado:</label><input type="text" name="estado" id="estado" value="<?php echo $estado; ?>"></div>
	<div><label>Teléfono:</label><input type="text" name="telefono" id="telefono" value="<?php echo $telefono; ?>"></div>
	<div><label>Celular:</label><input type="text" name="celular" id="celular" value="<?php echo $celular; ?>"></div>
	<div><label>RFC:</label><input type="text" name="rfc" id="rfc" value="<?php echo $rfc; ?>"></div>
	<div><label>Correo electrónico:</label><input type="text" name="correo" id="correo" value="<?php echo $correo; ?>"></div>
	<div><label>Institución de estudios:</label><input type="text" name="institucion_estudios" id="institucion_estudios" value="<?php echo $institucion_estudios; ?>"></div>
	<div><label>Nacionalidad:</label><input type="text" name="nacionalidad" id="nacionalidad" value="<?php echo $nacionalidad; ?>"></div>
	<div><label>Nivel académico:</label><input type="text" name="grado_academico" id="grado_academico" value="<?php echo $grado_academico; ?>"></div>
	<div><label>Exalumno Ibero:</label><input type="text" name="exalumno" id="exalumno" value="<?php echo $exalumno; ?>"></div>
	<div><label>¿Cómo se enteró?:</label><input type="text" name="como_se_entero" id="como_se_entero" value="<?php echo $como_se_entero; ?>"></div>
	<div><label>¿Porqué la Ibero?:</label><input type="text" name="porque_la_ibero" id="porque_la_ibero" value="<?php echo $porque_la_ibero; ?>"></div>
																											
	<div><label>Empresa:</label><input type="text" name="empresa" id="empresa" value="<?php echo $empresa; ?>"></div>
	<div><label>Puesto: </label><input type="text" name="puesto" id="puesto" value="<?php echo $puesto; ?>"></div>
	<div><label>Dirección de la empresa: </label><input type="text" name="direccion_empresa" id="direccion_empresa" value="<?php echo $direccion_empresa; ?>"></div>
	<div><label>Teléfono de la empresa: </label><input type="text" name="telefono_empresa" id="telefono_empresa" value="<?php echo $telefono_empresa; ?>"></div>																				 																																			
</div>				
<div id="estatus_proceso">										
	<div>Estatus del proceso:</div>	

	<div></label><input type="checkbox" value="1" name="primer_contacto" id="primer_contacto" <?php echo ($primer_contacto==1)?"checked":""; ?>><label>Primer contacto</label></div>
	<a href="#" name="estatus" rel="estatus_primer_contacto"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
	<div id="estatus_primer_contacto" style="display:none;"><textarea name="td_comment_primercontacto"></textarea></div>																		
																													
	<div><input type="checkbox" value="1" name="documentos"  id="documentos" <?php echo ($documentos==1)?"checked":""; ?>><label>Documento</label></div>			
	<a href="#" name="estatus" rel="estatus_documentos"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
	<div id="estatus_documentos" style="display:none;"><textarea name="td_comment_documentos"></textarea></div>																								
																
	<div><input type="checkbox" value="1" name="envio_decse" id="envio_decse" <?php echo ($envio_decse==1)?"checked":""; ?>><label>Enviar a DECSE</label></div>			
	<a href="#" name="estatus" rel="estatus_envio_decse"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
	<div id="estatus_envio_decse" style="display:none;"><textarea name="td_comment_decse"></textarea></div>		
									
	<div><input type="checkbox" value="1" name="envio_claves"  id="envio_claves" <?php echo ($envio_claves==1)?"checked":""; ?>><label>Envío de claves</label></div>			
	<a href="#" name="estatus" rel="estatus_envio_claves"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
	<div id="estatus_envio_claves" style="display:none;"><textarea name="td_comment_envioclaves"></textarea></div>				
																																																													
	<div><input type="checkbox" value="1" name="pago_realizado"  id="pago_realizado" <?php echo ($pago_realizado==1)?"checked":""; ?>><label>Pago realizado</label></div>			
	<a href="#" name="estatus" rel="estatus_pago_realizado"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
	<div id="estatus_pago_realizado" style="display:none;"><textarea name="td_comment_pagorealizado"></textarea></div>		
</div>					
<div id="subir_documentos">	
	Documentos :					
	<?php 							
		 if(!empty($archivos)){

		 	foreach($archivos as $archivo){
	?>																							
			<div><a href="<?php echo base_url('includes/admin/documentos/'.$archivo->archivo); ?>" target="_blank"><?php echo $archivo->doc_type; ?></a></div>			
	<?php 								
			}																												
		 }else{		
	?>	 			
		<div>No existen documentos.</div>
	<?php 				
		 } 						
	?>																																																																																																							
	<div>Agregar Archivos: <a href="#" id="agregar_input_file"><?php echo img(array('src'=>'includes/admin/images/seguimiento/archivo.png')); ?></a></div>		
	<div><input type="file" name="documento_upload[0]"  id="documento_upload"></div>
	<div>Tipo de documento:<input type="text" name="doc_type[0]"></div>						 									 																																																																																																			
</div>																																																																															
<div id="clasificar_aspirante">
		<div><input type="checkbox" value="1" name="caso_cerrado"  id="caso_cerrado" <?php echo ($caso_cerrado==1)?"checked":""; ?>><label>Caso cerrado</label></div>										 
		<div><input type="checkbox" value="1" name="caso_inconcluso"  id="caso_inconcluso" <?php echo ($caso_inconcluso==1)?"checked":""; ?>><label>Caso inconcluso</label></div>										 
		<div><input type="checkbox" value="1" name="informes"  id="informes" <?php echo ($informes==1)?"checked":""; ?>><label>Informes</label></div>										 
		<div><input type="checkbox" value="1" name="atendido"  id="atendido" <?php echo ($atendido==1)?"checked":""; ?>><label>Atendido</label></div>										 
</div>													
<div id="comentarios">																
		<div><a href="#" rel="comentarios_comentario_general">Añadir / editar comentario general</a></div>			
		<div id="comentarios_comentario_general" style="display:none;"><textarea name="comentario_general"><?php echo $comentario_general; ?></textarea></div>
</div>																																																																																																																																																																																																																																																																																																		
	<a href="<?php echo base_url("admin/preinscritos/detalle/".$id_preinscrito); ?>">cancelar</a>												
	<button name="enviar">Enviar</button>
	</form>																								
</body>					
</html>														
																	