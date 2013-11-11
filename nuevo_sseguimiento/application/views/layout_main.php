<!DOCTYPE html>		
<html>
<head>                                  																	
<meta charset="utf-8">		
    <title>Home</title>                                     
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
</head>                                                                      
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
            <?php 
            $filtro = isset($filtro)?$filtro:false;
            if($filtro){ ?>                                                                                                                                           
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
            <?php } ?>                 
        </div>	                             						   		      		     																				
        <div id="menu">                                                        
            <ul class="menu"> 
                <li>                                               
                    <a href=<?php echo base_url("admin/users/show"); ?>>Usuarios</a>
                    <ul>

                         <a href=<?php echo base_url("admin/users/add"); ?>>
                            <li>
                                Agregar Usuarios
                            </li>     
                        </a>         

                    </ul>                
                </li>
                <li>
                    <a href=<?php echo base_url("admin/preinscritos/show"); ?>>Preinscritos</a>     
                </li>                               
                <li>                   
                    <a href=<?php echo base_url("admin/inscritos/show"); ?>>Inscritos</a>                    
                </li> 
                <li>                                                    
                    <a href=<?php echo base_url("admin/casos_cerrados/show"); ?>>Casos cerrados</a>                        
                </li> 
                <li>                                                                           
                    <a href=<?php echo base_url("admin/casos_inconclusos/show"); ?>>Casos inconclusos</a>                         
                </li>                                         
                <li>                                                                           
                    <a href=<?php echo base_url("admin/informes/show"); ?>>Informes</a>                         
                </li>        
                <li>                                                                                                                                         
                    <a href=<?php echo base_url("admin/graficas/area"); ?>>Graficas</a>                         
                </li>                                                                                                                    
                <li>                                                				                
                    <a href=<?php echo base_url("acceso/login/salir"); ?>>Salir</a>
                </li>                                                                             
            </ul> 
        </div>          
        <div class="clear"></div>                                                
    		<div id="content">                                                                                                                                                                                                                                                                                    
                <div id="base_url" style="display:none"><?php echo base_url(); ?></div>     	
                <div id="controller" style="display:none"><?php echo $this->uri->segment(2); ?></div>						
    			<?php echo $content_for_layout; ?>                                                    			
    		</div>                                                                        	
        </div>       			 					     										
</body>                                            
</html>		