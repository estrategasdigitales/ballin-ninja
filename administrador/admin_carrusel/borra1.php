<?php 
// Actualizamos en funcion del id que recibimos 
require_once('../../Connections/otono2011.php'); 
$id = $_POST['id'];
$file = $_POST['imagen'];

unlink('../../imagenes/carrusel/'.$file);

mysql_select_db($database_otono2011, $otono2011);
$query = "delete from carrusel_index where id_carrusel_index = '$id'";  
$result = mysql_query($query, $otono2011);  
if($result){
header("Location:admin_carrusel_home.php");
}
?>
