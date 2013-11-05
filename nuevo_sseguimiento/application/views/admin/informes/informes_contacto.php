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
	<div><input type="hidden" name="id" value="<?php echo $contacto->id; ?>"></div>																																		
	<div>Programa: <?php echo $contacto->nombre; ?></div>																							
	<div>Nombre completo: <?php echo $contacto->nombre.' '.$contacto->paterno.' '.$contacto->materno; ?></div>
	<div>Correo electrónico: <?php echo $contacto->correo; ?></div>				
	<div>Información que solicita: <textarea><?php echo $contacto->comentario; ?></textarea></div>
	<div>Comentarios del encargado: <textarea name="comentario_encargado"><?php echo $contacto->comentario_encargado; ?></textarea></div>
	<?php $atendido = ($contacto->atendido==1)?'checked':''; ?>																											
	<div><input type="checkbox" name="atendido" value="1" <?php echo $atendido; ?>>Atendido</div>		
	<button name="guardar">Guardar</button>							
	</form>																																									
</body>																							
</html>																				