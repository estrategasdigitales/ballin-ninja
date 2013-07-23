<?php require_once('../Connections/otono2011.php'); 

session_start();

if(!isset($_SESSION['loggedin_id_user']) || $_SESSION['loggedin_id_user'] == ""){
	header('Location: login.php');
} 

mysql_select_db($database_otono2011, $otono2011);
$query_rfc = sprintf("SELECT id_preinscrito, rfc FROM sp_preinscritos ORDER BY rfc ASC");
$rfc = mysql_query($query_rfc, $otono2011) or die(mysql_error());
$fecha_hoy = date('Ymd')."</br>";

$cont = 0;

while($row_rfc = mysql_fetch_assoc($rfc)){

	$rfc_fecha = str_split($row_rfc['rfc'], 10);
	$chars = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
	$rfc_fecha1 = str_replace($chars, "", $rfc_fecha[0]);
	$largo = strlen($rfc_fecha1);

	if($largo == 6){
		$cont++;

		$fecha_completa = (int)"19".(int)$rfc_fecha1;
		$edad = $fecha_hoy - $fecha_completa;
		$edad_limpia = str_split($edad, 2);

		$query_edades = "UPDATE sp_preinscritos SET edad=".$edad_limpia[0]." WHERE id_preinscrito=".$row_rfc['id_preinscrito'];

		  mysql_select_db($database_otono2011, $otono2011);
		  $Result_edades = mysql_query($query_edades, $otono2011) or die(mysql_error());

		echo $cont."- ".$fecha_completa."-".$edad_limpia[0]."<br>";
	}
}

header('Location: edades.php');
 
?>