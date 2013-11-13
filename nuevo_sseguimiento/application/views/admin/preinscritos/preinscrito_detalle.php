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
<div><?php echo isset($msj)?$msj:''; ?></div>	
<div id="preinscrito_detalle">					
	<div id="datos_programa">
		<h1>Programa:</h1>
		<h2><?php echo $preinscrito->program_name; ?></h2>
	</div>								

	<div id="datos_generales">																																																																														
		<h1>Datos del interesado:</h1>			
		<p><strong>Nombre Completo:</strong> <?php echo $preinscrito->nombre.' '.$preinscrito->a_paterno.' '.$preinscrito->a_materno; ?></p>		
		<p><strong>Fecha de registro:</strong> <?php echo $preinscrito->fecha_registro; ?></p>
		<p><strong>Calle y número:</strong> <?php echo $preinscrito->calle_numero; ?></p>
		<p><strong>Del o mpo: </strong> <?php echo $preinscrito->del_mpo; ?></p>

		<p><strong>Cp:</strong> <?php echo $preinscrito->cp; ?></p>
		<p><strong>Ciudad:</strong> <?php echo $preinscrito->ciudad; ?></p>
		<p><strong>Estado:</strong> <?php echo $preinscrito->estado; ?></p>
		<p><strong>Teléfono:</strong> <?php echo $preinscrito->telefono; ?></p>
		<p><strong>Celular:</strong> <?php echo $preinscrito->celular; ?></p>
		<p><strong>RFC:</strong> <?php echo $preinscrito->rfc; ?></p>
		<p><strong>Correo electrónico:</strong> <?php echo $preinscrito->correo; ?></p>
		<p><strong>Institución de estudios:</strong> <?php echo $preinscrito->institucion_estudios; ?></p>
		<p><strong>Nacionalidad:</strong> <?php echo $preinscrito->nacionalidad; ?></p>
		<p><strong>Nivel académico:</strong> <?php echo $preinscrito->grado_academico; ?></p>
		<p><strong>Exalumno Ibero:</strong> <?php echo $preinscrito->exalumno; ?></p>
		<p><strong>¿Cómo se enteró?:</strong> <?php echo $preinscrito->como_se_entero; ?></p>
		<p><strong>¿Porqué la Ibero?:</strong> <?php echo $preinscrito->porque_la_ibero; ?></p>
																							
		<p><strong>Empresa:</strong> <?php echo $preinscrito->empresa; ?></p>
		<p><strong>Puesto: </strong> <?php echo $preinscrito->puesto; ?></p>
		<p><strong>Dirección de la empresa: </strong> <?php echo $preinscrito->direccion_empresa; ?></p>
		<p><strong>Teléfono de la empresa: </strong> <?php echo $preinscrito->telefono_empresa; ?></p>																				 																																			
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
	</div>								
	<div class="clear"></div>													
	<div id="estatus_proceso">																									
		<h1>Estatus del proceso:</h1>
		<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin-top:25px;">
			<tr>
				<td valign="top" width="140" height="50">
					<input type="checkbox" name="primer_contacto" id="primer_contacto" <?php echo ($preinscrito->primer_contacto==1)?"checked":""; ?> disabled="disabled"><label>Primer contacto</label>
				</td>
				<td valign="top">
					<a href="#" name="estatus" rel="estatus_primer_contacto"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
					<div id="estatus_primer_contacto" style="display:none;">
						<textarea name="comentarios_primer_contacto"><?php echo $comment_primercontacto; ?></textarea>																
					</div>																																														
				</td>
			</tr>
			<tr>
				<td valign="top" height="50" class="division_pasos">
					<input type="checkbox" name="documentos"  id="documentos" <?php echo ($preinscrito->documentos==1)?"checked":""; ?> disabled="disabled"><label>Documento</label>
				</td>
				<td valign="top" class="division_pasos">
					<a href="#" name="estatus" rel="estatus_documentos"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
					<div id="estatus_documentos" style="display:none;">
						<textarea name="comentarios_documentos"><?php echo $comment_documentos; ?></textarea>												
					</div>	
				</td>
			</tr>		
			<tr>
				<td valign="top" height="50" class="division_pasos">
					<input type="checkbox" name="envio_decse" id="envio_decse" <?php echo ($preinscrito->envio_decse==1)?"checked":""; ?> disabled="disabled"><label>Enviar a DECSE</label>	
				</td>
				<td valign="top" class="division_pasos">
					<a href="#" name="estatus" rel="estatus_envio_decse"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
					<div id="estatus_envio_decse" style="display:none;">
						<textarea name="comentarios_envio_decse"><?php echo $comment_decse; ?></textarea>
					</div>	
				</td>
			</tr>
			<tr>
				<td valign="top" height="50" class="division_pasos">
					<input type="checkbox" name="envio_claves"  id="envio_claves" <?php echo ($preinscrito->envio_claves==1)?"checked":""; ?> disabled="disabled"><label>Envío de claves</label>	
				</td>
				<td valign="top" class="division_pasos">
					<a href="#" name="estatus" rel="estatus_envio_claves"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
					<div id="estatus_envio_claves" style="display:none;">
						<textarea  name="comentarios_envio_claves"><?php echo $comment_envioclaves; ?></textarea>
					</div>	
				</td>
			</tr>
			<tr>
				<td valign="top" height="50" class="division_pasos">
					<input type="checkbox" name="pago_realizado"  id="pago_realizado" <?php echo ($preinscrito->pago_realizado==1)?"checked":""; ?> disabled="disabled"><label>Pago realizado</label>	
				</td>
				<td valign="top" class="division_pasos">
					<a href="#" name="estatus" rel="estatus_pago_realizado"><?php echo img(array('src'=>'includes/admin/images/seguimiento/comentario.png')); ?> Agregar comentario</a>		
					<div id="estatus_pago_realizado" style="display:none;">
						<textarea name="comentarios_pago_realizado"><?php echo $comment_pagorealizado; ?></textarea>
					</div>	
				</td>
			</tr>	
		</table>																								
	</div>																																																																																																	
	<div id="clasificar_aspirante">
		<h1>Clasificación del aspirante</h1>																													
		<p><input type="checkbox" name="caso_cerrado"  id="caso_cerrado" <?php echo ($preinscrito->caso_cerrado==1)?"checked":""; ?> disabled="disabled"><label>Caso cerrado</label></p>									 
		<p><input type="checkbox" name="caso_inconcluso"  id="caso_inconcluso" <?php echo ($preinscrito->caso_inconcluso==1)?"checked":""; ?> disabled="disabled"><label>Caso inconcluso</label></p>									 
		<p><input type="checkbox" name="informes"  id="informes" <?php echo ($preinscrito->informes==1)?"checked":""; ?> disabled="disabled"><label>Informes</label></p>
		<p><input type="checkbox" name="atendido"  id="atendido" <?php echo ($preinscrito->atendido==1)?"checked":""; ?> disabled="disabled"><label>Atendido</label></p>									 
		<h2>Comentario general</h2>																																							
		<p><a href="#" rel="comentarios_comentario_general">Añadir / editar comentario general</a></p>						
		<div id="comentarios_comentario_general" style="display:none;">
			<textarea name="comentario_general"><?php echo $preinscrito->comentario_general; ?></textarea>
		</div>
	</div>
	<div class="clear"></div>					
	<div id="button_editar">																																																																																																																																																																																																																																															
		<a href="<?php echo base_url("admin/preinscritos/editar/".$preinscrito->id_preinscrito); ?>">editar</a>															
	</div>		
</div>						
</body>		
</html>																				