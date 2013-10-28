<?php
require_once('Connections/otono2011.php');
$numero = $_POST['numero'];

mysql_select_db($database_otono2011, $otono2011);
$sql = "select * from sp_preinscritos_pjf where num_expediente=".$numero;
$rsd = mysql_query($sql);
$msg = mysql_num_rows($rsd); //returns 0 if email not already exists

if($msg != 0){
$msg = "invalid";
}
echo $msg;
?>