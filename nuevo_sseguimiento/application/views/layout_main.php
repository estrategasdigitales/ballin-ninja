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
            <div id="titulo">
            	<h1>Sistema de seguimiento de preinscripciones</h1>						
            	<h2>Administrador | <a href="#">Cerrar sesión</a></h2>	
            </div>

            <div id="filtro">                                                               
                <p>
                    <label>*Disciplinas:</label>               
                    <select name="id_discipline" id="id_discipline">
                        <option value="0">Selecciona la disciplina</option>                                                                                                                                                                         
                        <?php foreach($disciplinas as $disciplina){ ?>      
                        <option value="<?php echo $disciplina->id_discipline; ?>"  <?php echo set_select('id_discipline', $disciplina->id_discipline); ?>><?php echo $disciplina->discipline; ?></option>                                               
                        <?php } ?>                                                                                                                                                                                                                              
                    <select/>  
                </p> 
                <p>                      
                    <label>*Tipo de programa:</label>                              
                    <select name="program_type" id="program_type">                                                                                                                                                                                  
                        <option value="0">Selecciona el tipo de programa</option>                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                    <select/>
                </p>
                <p>                                                                                                                                                                                                   
                    <label>*Programas:</label>                             
                    <select name="id_program" id="id_program">                                                                                                                                                                                  
                        <option value="0">Selecciona un programa</option>                                                                                                                                                                                                                                                                           
                    <select/>
                </p>                                                                                                                                                                   
            </div>

        </div>							   		      		     																				
        <div id="menu">                                                        
            <ul class="menu"> 
                <li>                        
                    <a href=<?php echo site_url("admin/users/show"); ?> class="active">Usuarios</a>
                    <ul>

                         <a href=<?php echo site_url("admin/users/add"); ?>>
                            <li>
                                Agregar
                            </li>     
                        </a>         

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
<<<<<<< HEAD
            </ul> 

        </div>          
=======
            </ul>                                                 
        </div>                            
>>>>>>> 3842f8d0d0a4a2192c31e5dfe314d65a0f0312cc
        <div class="clear"></div>                                                
    		<div id="content">                                                                                                                                           
                <div id="base_url" style="display:none"><?php echo base_url(); ?></div>							
    			<?php echo $content_for_layout; ?>			
    		</div>                                                                 	
        </div>       			 					     										
</body>                                            
</html>		