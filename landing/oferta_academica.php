<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>oferta academica</title>
  <style>

  	body{								
  		background-color:#DDDBDB;
  	}		
  									
  	#imgLanding{ 		
  		display:block;		
  		margin-right: auto;
		margin-left: auto;
  	}					

  </style>
</head>
<body>
  <h1></h1>				
  	<map name="Map" id="Map">																	
		<area shape="rect" coords="69,350,337,378" href="http://ibero.mx/web/site/tpl-Nivel2.php?menu=mgCooperacion&amp;seccion=cdPremio" target="_blank" />
	</map>																																			
	<img src="landing.jpg" width="700" id="imgLanding" alt="click en imagen" border="0" usemap="#Map"/>
	<?php
																					
     class ofertaAcademica{
					
    	function __construct(){
			require "db.class.php";  
   			$this->db = Db::getInstance();
		}

		public function main()
		{	
			$origin = isset($_GET["origin"])?$_GET["origin"]:null;
	
			if($origin == "eqMGv1Fj7q")
			{													
				$ip =  $this->getIp();
				$query = sprintf("insert into oferta_educativa(fecha,fecha_unix,ip) values(NOW(),UNIX_TIMESTAMP(NOW()), '%s')", mysql_real_escape_string($ip));												
			    $this->db->ejecutar($query);
			}																							
		}								

		public function getIp()
		{
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		        $ip = $_SERVER['HTTP_CLIENT_IP'];
		    }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    }else{
		        $ip = $_SERVER['REMOTE_ADDR'];
		    }
		    return $ip;
		}		
    }						

    $ofertaAcademica = new ofertaAcademica();
    $ofertaAcademica->main();
	
	?>

</body>
</html>

