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
<div><?php echo isset($msj)?$msj:''; ?></div>	
<div id="preinscrito_detalle">					
<div id="datos_programa"><div class="titulo_cb">Programa:</div><label><?php echo $preinscrito->program_name; ?></label></div>								 								
<div id="datos_generales">																																																																														
	<div class="titulo_cb">Datos del interesado:</div>			
	<div><label>Nombre Completo:</label> <?php echo $preinscrito->nombre.' '.$preinscrito->a_paterno.' '.$preinscrito->a_materno; ?></div>		
	<div><label>Fecha de registro:</label> <?php echo $preinscrito->fecha_registro; ?></div>
	<div><label>Calle y número:</label> <?php echo $preinscrito->calle_numero; ?></div>
	<div><label>Del o mpo: </label> <?php echo $preinscrito->del_mpo; ?></div>

	<div><label>Cp:</label> <?php echo $preinscrito->cp; ?></div>
	<div><label>Ciudad:</label> <?php echo $preinscrito->ciudad; ?></div>
	<div><label>Estado:</label> <?php echo $preinscrito->estado; ?></div>
	<div><label>Teléfono:</label> <?php echo $preinscrito->telefono; ?></div>
	<div><label>Celular:</label> <?php echo $preinscrito->celular; ?></div>
	<div><label>RFC:</label> <?php echo $preinscrito->rfc; ?></div>
	<div><label>Correo electrónico:</label> <?php echo $preinscrito->correo; ?></div>
	<div><label>Institución de estudios:</label> <?php echo $preinscrito->institucion_estudios; ?></div>
	<div><label>Nacionalidad:</label> <?php echo $preinscrito->nacionalidad; ?></div>
	<div><label>Nivel académico:</label> <?php echo $preinscrito->grado_academico; ?></div>
	<div><label>Exalumno Ibero:</label> <?php echo $preinscrito->exalumno; ?></div>
	<div><label>¿Cómo se enteró?:</label> <?php echo $preinscrito->como_se_entero; ?></div>
	<div><label>¿Porqué la Ibero?:</label> <?php echo $preinscrito->porque_la_ibero; ?></div>
																						
	<div><label>Empresa:</label> <?php echo $preinscrito->empresa; ?></div>
	<div><label>Puesto: </label> <?php echo $preinscrito->puesto; ?></div>
	<div><label>Dirección de la empresa: </label> <?php echo $preinscrito->direccion_empresa; ?></div>
	<div><label>Teléfono de la empresa: </label> <?php echo $preinscrito->telefono_empresa; ?></div>																				 																																			
</div>
<div id="subir_documentos">				
	<div class="titulo_cb">Documentos :</div>										
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
</div>								
<div class="clear"></div>													
<div id="estatus_proceso">																									
	<div class="titulo_cb">Estatus del proceso:</div>																									
	<div></label><input type="checkbox" name="primer_contacto" id="primer_contacto" <?php echo ($preinscrito->primer_contacto==1)?"checked":""; ?> disabled="disabled"><label>Primer contacto</label></div>
	<a href="#" name="estatus" rel="estatus_primer_contacto"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
	<div id="estatus_primer_contacto" style="display:none;"><textarea name="comentarios_primer_contacto"></textarea></div>											
																				
	<div><input type="checkbox" name="documentos"  id="documentos" <?php echo ($preinscrito->documentos==1)?"checked":""; ?> disabled="disabled"><label>Documento</label></div>			
	<a href="#" name="estatus" rel="estatus_documentos"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
	<div id="estatus_documentos" style="display:none;"><textarea name="comentarios_documentos"></textarea></div>																						
													
	<div><input type="checkbox" name="envio_decse" id="envio_decse" <?php echo ($preinscrito->envio_decse==1)?"checked":""; ?> disabled="disabled"><label>Enviar a DECSE</label></div>			
	<a href="#" name="estatus" rel="estatus_envio_decse"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
	<div id="estatus_envio_decse" style="display:none;"><textarea name="comentarios_envio_decse"></textarea></div>
	
	<div><input type="checkbox" name="envio_claves"  id="envio_claves" <?php echo ($preinscrito->envio_claves==1)?"checked":""; ?> disabled="disabled"><label>Envío de claves</label></div>			
	<a href="#" name="estatus" rel="estatus_envio_claves"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
	<div id="estatus_envio_claves" style="display:none;"><textarea  name="comentarios_envio_claves"></textarea></div>
																																			
	<div><input type="checkbox" name="pago_realizado"  id="pago_realizado" <?php echo ($preinscrito->pago_realizado==1)?"checked":""; ?> disabled="disabled"><label>Pago realizado</label></div>			
	<a href="#" name="estatus" rel="estatus_pago_realizado"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
	<div id="estatus_pago_realizado" style="display:none;"><textarea name="comentarios_pago_realizado"></textarea></div>
</div>																																																																																																	
<div id="clasificar_aspirante">
		<div class="titulo_cb">Clasificación del aspirante</div>																													
		<div><input type="checkbox" name="caso_cerrado"  id="caso_cerrado" <?php echo ($preinscrito->caso_cerrado==1)?"checked":""; ?> disabled="disabled"><label>Caso cerrado</label></div>										 
		<div><input type="checkbox" name="caso_inconcluso"  id="caso_inconcluso" <?php echo ($preinscrito->caso_inconcluso==1)?"checked":""; ?> disabled="disabled"><label>Caso inconcluso</label></div>										 
		<div><input type="checkbox" name="informes"  id="informes" <?php echo ($preinscrito->informes==1)?"checked":""; ?> disabled="disabled"><label>Informes</label></div>										 
		<div><input type="checkbox" name="atendido"  id="atendido" <?php echo ($preinscrito->atendido==1)?"checked":""; ?> disabled="disabled"><label>Atendido</label></div>										 
</div>																										
<div id="comentarios">														
		<div class="titulo_cb">Comentario general</div>																																							
		<div><a href="#" rel="comentarios_comentario_general">Añadir / editar comentario general</a></div>							
		<div id="comentarios_comentario_general" style="display:none;"><textarea name="comentario_general"><?php echo $preinscrito->comentario_general; ?></textarea></div>
</div>
<div id="button_editar">																																																																																																																																																																																																																																															
<a href="<?php echo base_url("admin/preinscritos/editar/".$preinscrito->id_preinscrito); ?>">editar</a>															
</div>		
</div>						
</body>		
</html>																				