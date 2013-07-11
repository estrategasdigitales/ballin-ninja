<?php require_once('../Connections/otono2011.php'); 

$id_programa = $_POST['id_programa'];

mysql_select_db($database_otono2011, $otono2011);
$query_programas = "SELECT publicado FROM site_galeria_programa WHERE id_programa=$id_programa";
$programas = mysql_query($query_programas, $otono2011) or die(mysql_error());
$row_programas = mysql_fetch_assoc($programas);

if($row_programas['publicado'] == 1){
	$insertSQL = "UPDATE site_galeria_programa SET publicado=0 WHERE id_programa=".$id_programa;

  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());
  echo "Despublicado";
}else{

	$insertSQL = "UPDATE site_galeria_programa SET publicado=1 WHERE id_programa=".$id_programa;

  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());

echo "Publicado";
}
?>