<!DOCTYPE html>		
<html>
<head>																	
<meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
														       	
	<!-- art -->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet"  href="<?php echo base_url('includes/art/style.css'); ?>" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]--> 			
    <link rel="stylesheet"  href="<?php echo base_url('includes/art/style.responsive.css'); ?>" media="all">
	<!-- gjhj -->                                                                      
	<link rel="stylesheet" href="<?php echo base_url('includes/admin/js/jquery-ui-1.10.3.custom/css/jquery-ui-themes-1.10.3/themes/redmond/jquery-ui.min.css'); ?>" media="screen">
                                       			  					                                                                 
	<!-- art -->
    <script src="<?php echo base_url('includes/art/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('includes/art/script.js'); ?>"></script>
    <script src="<?php echo base_url('includes/art/script.responsive.js'); ?>"></script>
	                                                    				         
	<!-- gjhj -->
	<script src="<?php echo base_url('includes/admin/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('includes/admin/js/jquery.validate.js'); ?>" type="text/javascript"></script>                          
    <script src="<?php echo base_url('includes/admin/js/funcionesGeneralesAdmin.js'); ?>" type="text/javascript"></script>
                                                            									                              	                             	                                                                                    
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('includes/jqGrid/css/ui.jqgrid.css'); ?>" />        
    <!--<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('includes/jqGrid/plugins/ui.multiselect.css'); ?>"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('includes/jqGrid/plugins/searchFilter.css'); ?>"/>-->
    <link rel="stylesheet" href="<?php echo base_url('includes/admin/css/estilos.css'); ?>" media="screen">                                                 
                                                                                                                		
  	<!-- grid -->												                					
    <script src="<?php echo base_url('includes/jqGrid/js/i18n/grid.locale-es.js'); ?>" type="text/javascript"></script> 
    <script type="text/javascript"> 						
    /*.jgrid.no_legacy_api = true; 
    $.jgrid.useJSON = true; */ 
    </script>                   									                                  				 
    <script src="<?php echo base_url('includes/jqGrid/js/jquery.jqGrid.min.js'); ?>" type="text/javascript"></script> 

<style>.art-content .art-postcontent-0 .layout-item-0 { padding-right: 10px;padding-left: 10px;  }
.ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
.ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
.ui-widget { font-family: inherit !important; font-size: inherit !important; }
</style></head>                                         
<body>									
<div id="art-main">
    <div id="art-header-bg" class="clearfix">
            </div>
    <div class="art-sheet clearfix">
    	<!--
<header class="art-header clearfix">
    <div class="art-shapes">
            </div>							
</header>	-->																					
<nav class="art-nav clearfix">
    <ul class="art-hmenu">
        <li>
            <a href=<?php echo site_url("admin/users/show"); ?> class="active">Usuarios</a>
                <ul class="active">					
                    <li>				
                    <a href=<?php echo site_url("admin/users/add"); ?>>Agregar</a>
                    </li>			
                </ul>
        </li>
        <li>
            <a href=<?php echo site_url("admin/preinscritos/show"); ?> class="active">Preinscritos</a>
                <ul class="active">                                                                      
                    <li>                
                    <a href=<?php echo site_url("admin/users/add"); ?>>Agregar</a>
                    </li>           
                </ul>
        </li>                       
        <li>                   
            <a href=<?php echo site_url("admin/users/salir"); ?> class="active">Salir</a>
        </li> 
                                                                
    </ul> 
</nav>
<div class="art-layout-wrapper clearfix">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content clearfix"><article class="art-post art-article">
                                <h2 class="art-postheader"><!--Home--></h2>
                                                        
                <div class="art-postcontent art-postcontent-0 clearfix"><div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%" >                           
		<div class="content">                                                                                            
        <div id="base_url" style="display:none"><?php echo base_url('admin'); ?></div>							
			<?php echo $content_for_layout; ?>			
		</div>				 					     										
        <!--<p><br>
        </p><p>Enter Page content here...</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra, tellus sit amet congue vulputate, nisi erat iaculis nibh, vitae feugiat sapien ante eget mauris.&nbsp;Aenean sollicitudin imperdiet arcu, vitae dignissim est posuere id.</p><table class="art-article" style="width: 100%;"><tbody><tr><td style="width: 50%;"><br></td><td style="width: 50%;"><br></td></tr><tr><td style="width: 50%;"><br></td><td style="width: 50%;"><br></td></tr></tbody></table><p><br></p><p>&nbsp;<a href="" class="art-button">fdf</a>&nbsp;<br></p>
        <form><input type="text" name="hola"><br><br>
         <select name="prueba"><option id="0">Read more</option></select>	
        </form><p><a href="#">Read more</a></p>-->
    </div>						
    </div>
</div>			
<div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 50%" >
    </div><div class="art-layout-cell layout-item-0" style="width: 50%" >
    </div>
    </div>						
</div>
</div>


</article></div>
                    </div>
                </div>
            </div><footer class="art-footer clearfix">
<p><br></p>
<p><br></p>
</footer>
    </div>
</div>
</body></html>		