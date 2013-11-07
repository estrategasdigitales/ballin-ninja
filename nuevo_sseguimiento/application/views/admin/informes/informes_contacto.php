<!DOCTYPE html>		
<html>
<head>		                                  																	
<meta charset="utf-8">			
    <title></title>																			
    <link rel="stylesheet" href="<?php echo base_url('includes/admin/css/estilos.css'); ?>" media="screen">                                                               			  					                                                                 
    <script src="<?php echo base_url('includes/admin/js/jquery-1.8.2.js'); ?>"></script> 		
    <script src="<?php echo base_url('includes/admin/js/funcionesGeneralesColorBox.js'); ?>"></script> 
</head>																						
<body>				
	<?php echo isset($msj)?$msj:''; ?>																																																											
	<?php echo form_open('admin/informes/update_contacto'); ?>									
	<div><input type="hidden" name="id" value="<?php echo $contacto->id; ?>"></p>																																		
	<p><strong>Programa:</strong> <?php echo $contacto->program_name; ?></p>																									
	<p><strong>Nombre completo:</strong> <?php echo $contacto->nombre.' '.$contacto->paterno.' '.$contacto->materno; ?></p>
	<p><strong>Correo electrónico:</strong> <?php echo $contacto->correo; ?></p>				
	<p><strong>Información que solicita:</strong> <textarea><?php echo $contacto->comentario; ?></textarea></p>
	<p><strong>Comentarios del encargado:</strong> <textarea name="comentario_encargado"><?php echo $contacto->comentario_encargado; ?></textarea></p>
	<?php $atendido = ($contacto->atendido==1)?'checked':''; ?>																											
	<p><input type="checkbox" name="atendido" value="1" <?php echo $atendido; ?>><strong>Atendido</strong></p>		
	<button name="guardar" class="boton_general">Guardar</button>							
	</form>																																									
</body>																							
</html>																				