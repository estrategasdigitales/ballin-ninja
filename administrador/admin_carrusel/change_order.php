<?php
require_once('../../Connections/otono2011.php');
mysql_select_db($database_otono2011, $otono2011);


if($_POST['direction'] == 0){

	$nuevo_orden = $_POST['orden'] - 1;

	$query_orden = "UPDATE carrusel_index SET orden='".$_POST['orden']."' WHERE orden = '".$nuevo_orden."'";
	$result = mysql_query($query_orden, $otono2011)or die(mysql_error());

	$query_Recordset1 = "UPDATE carrusel_index SET orden='".$nuevo_orden."' WHERE id_carrusel_index = '".$_POST['id']."'";
	$result = mysql_query($query_Recordset1, $otono2011)or die(mysql_error());

	$data = 'success';

	echo $data;

}

if($_POST['direction'] == 1){

	$nuevo_orden = $_POST['orden'] + 1;

	$query_orden = "UPDATE carrusel_index SET orden='".$_POST['orden']."' WHERE orden = '".$nuevo_orden."'";
	$result = mysql_query($query_orden, $otono2011)or die(mysql_error());

	$query_Recordset1 = "UPDATE carrusel_index SET orden='".$nuevo_orden."' WHERE id_carrusel_index = '".$_POST['id']."'";
	$result = mysql_query($query_Recordset1, $otono2011)or die(mysql_error());

	$data = 'success';

	echo $data;

}


?>