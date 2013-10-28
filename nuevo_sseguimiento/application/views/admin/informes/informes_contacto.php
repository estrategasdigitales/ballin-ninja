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
	<div>Contacto detalle</div>	
	<div><?php echo $preinscrito->nombre; ?></div>
	<div><?php echo $preinscrito->paterno; ?></div>	
	<div><?php echo $preinscrito->materno; ?></div>
	<div><?php echo $preinscrito->correo; ?></div>
	<div><?php echo $preinscrito->comentario; ?></div>														
</body>						
</html>																				