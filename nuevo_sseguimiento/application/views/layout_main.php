<!DOCTYPE html>		
<html>
<head>                                  																	
<meta charset="utf-8">		
    <title>Home</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">													       	
	<!-- gjhj -->                                                                      
	<link rel="stylesheet" href="<?php echo base_url('includes/admin/js/jquery-ui-1.10.3.custom/css/jquery-ui-themes-1.10.3/themes/smoothness/jquery-ui.min.css'); ?>" media="screen">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('includes/jqGrid/css/ui.jqgrid.css'); ?>" />								 		   		  	  
    <link rel="stylesheet" href="<?php echo base_url('includes/admin/css/colorbox.css'); ?>" media="screen">				                                                                                                                                                             
    <link rel="stylesheet" href="<?php echo base_url('includes/admin/css/estilos.css'); ?>" media="screen">                                                               			  					                                                                 
	                                                  				
    <!-- art -->                                        
    <script src="<?php echo base_url('includes/art/jquery.js'); ?>"></script>
    <!--<script src="<?php echo base_url('includes/jqGrid/js/jquery-1.7.2.min.js'); ?>" type="text/javascript"></script>--> 
	<!-- gjhj -->                                                                                                           
	<script src="<?php echo base_url('includes/admin/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('includes/admin/js/jquery.colorbox.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('includes/admin/js/jquery.validate.js'); ?>" type="text/javascript"></script>                                
    <script src="<?php echo base_url('includes/admin/js/funcionesGeneralesAdmin.js'); ?>" type="text/javascript"></script>
    <!-- grid -->       												                					
    <script src="<?php echo base_url('includes/jqGrid/js/jquery.jqGrid.min.js'); ?>" type="text/javascript"></script> 
    <script src="<?php echo base_url('includes/jqGrid/js/i18n/grid.locale-es.js'); ?>" type="text/javascript"></script>                                                                                                      

    <script>                        
        $(document).ready(function(){
        //Examples of how to assign the ColorBox event to elements
        $(".group1").colorbox({iframe:true, width:"850px", height:"90%"});
        });                                
    </script>                                                        
<style>.art-content .art-postcontent-0 .layout-item-0 { padding-right: 10px;padding-left: 10px;  }
.ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
.ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
/*.ui-widget { font-family: inherit !important; font-size: inherit !important; }*/
</style></head>                                                                      
<body>                                        					
        <div id="centrado">                          
        <div id="encabezado">               
        	<div id="logo">
            	<?php echo img('includes/admin/images/seguimiento/logo_UIA.jpg'); ?>				
            	<?php echo img('includes/admin/images/seguimiento/logo_DEC.jpg'); ?>			
        	</div>	
        	<h1>Sistema de seguimiento de preinscripciones</h1>						
        	<h2>Administrador | <a href="#">Cerrar sesión</a></h2>																							
        </div>							   		      		     																				
        <div>                                                        
            <ul class="menu"> 
                <li>                        
                    <a href=<?php echo site_url("admin/users/show"); ?> class="active">Usuarios</a>
                    <ul>
                        <li>        
                            <a href=<?php echo site_url("admin/users/add"); ?>>Agregar</a>
                        </li>              
                    </ul>                
                </li>
                <li>
                <a href=<?php echo site_url("admin/preinscritos/show"); ?> class="active">Preinscritos</a>
                    <!--<ul class="active">                                                                      
                        <li>                
                        <a href=<?php echo site_url("admin/users/add"); ?>>Mostrar</a>
                        </li>           
                    </ul>-->       
                </li> 
                <li>                   
                <a href=<?php echo site_url("admin/inscritos/show"); ?> class="active">Inscritos</a>
                    <!--<ul class="active">                                                                                       
                        <li>                                                                           
                        <a href=<?php echo site_url("admin/users/add"); ?>>Inscritos</a>
                        </li>           
                    </ul>-->                      
                </li> 
                <li>                                                    
                <a href=<?php echo site_url("admin/casos_cerrados/show"); ?> class="active">Casos cerrados</a>
                    <!--<ul class="active">                 				                                                                      
                        <li>                                                                                                                                                    
                        <a href=<?php echo site_url("admin/caso_cerrado/add"); ?>>Inscritos</a>
                        </li>                         
                    </ul>-->                          
                </li> 
                <li>                                                                           
                <a href=<?php echo site_url("admin/casos_inconclusos/show"); ?> class="active">Casos inconclusos</a>
                    <!--<ul class="active">                                                                                       
                        <li>                                                                                                                                                    
                        <a href=<?php echo site_url("admin/caso_cerrado/add"); ?>>Casos inconclusos</a>
                        </li>                         
                    </ul>-->                          
                </li>                                         
                <li>                                                                           
                    <a href=<?php echo site_url("admin/informes/show"); ?> class="active">Informes</a>                         
                </li>        
                <li>                                                                                                                                         
                    <a href=<?php echo site_url("admin/graficas/show"); ?> class="active">Graficas</a>                         
                </li>                                                              
                <li>                                				                
                    <a href=<?php echo site_url("acceso/login/salir"); ?> class="active">Salir</a>
                </li>                                           
            </ul>                                                 
        </div>                            
        <div class="clear"></div>                                                
    		<div id="content">                                                                                                                                           
                <div id="base_url" style="display:none"><?php echo base_url(); ?></div>							
    			<?php echo $content_for_layout; ?>			
    		</div>                                                                 	
        </div>       			 					     										
</body>                                            
</html>		