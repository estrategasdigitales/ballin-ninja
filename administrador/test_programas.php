<?php require_once('../Connections/otono2011.php'); 

mysql_select_db($database_otono2011, $otono2011);
$query = "SELECT program_name FROM site_programs_dupl";
$query_query = mysql_query($query, $otono2011);
$row_query = mysql_fetch_assoc($query_query);

do{

$nombre_programa = $row_query['program_name'];

$array_acentos = array('á', 'é', 'í', 'ó', 'ú', 'á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ', 'Á' ,'É', 'Í', 'Ó', 'Ú', 'Ñ');
$array_html = array('á', 'é', 'í', 'ó', 'ú', '&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&uuml;', '&ntilde;' ,'&Aacute;' ,'&Eacute;' ,'&Iacute;' ,'&Oacute;', '&Uacute;', '&Ntilde;');

$nuevo_registro = str_replace($array_html, $array_acentos, $nombre_programa);

$nuevo_registro = utf8_decode($nuevo_registro);

mysql_select_db($database_otono2011, $otono2011);
$query_update = "UPDATE site_programs_dupl SET program_name = '".$nuevo_registro."'  WHERE program_name = '".$nombre_programa."'";
$Result1 = mysql_query($query_update, $otono2011);
}while($row_query = mysql_fetch_assoc($query_query));

?>