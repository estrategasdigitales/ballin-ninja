<?php
	class ofertaAcademica{

		function __construct(){
			require "db.class.php";  
			$this->db = Db::getInstance();
		}

		public function main(){	
			$origin = isset($_GET["origin"])?$_GET["origin"]:null;

			if($origin == "eqMGv1Fj7q"){													
				$ip =  $this->getIp();
				$query = sprintf("INSERT INTO origen_visitas(fecha, fecha_unix, ip) VALUES(NOW(), UNIX_TIMESTAMP(NOW()), '%s')", mysql_real_escape_string($ip));												
				$this->db->ejecutar($query);
			}																							
		}								

		public function getIp(){
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}

		public function descargaCatalogo(){
			$ip = $this->getIp();
			$query = sprintf("INSERT INTO descarga_catalogo(fecha, fecha_unix, ip) VALUES(NOW(), UNIX_TIMESTAMP(NOW()), '%s')", mysql_real_escape_string($ip));
			$this->db->ejecutar($query);
		}		
	}							
?>