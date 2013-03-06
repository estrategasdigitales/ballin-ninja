<?php require_once('Connections/otono2011.php'); ?>
<?
mysql_select_db($database_otono2011, $otono2011);
$query_fechas_ini = "SELECT id_fecha, fecha, (SELECT nombre_sede FROM site_sedes WHERE site_sedes.id_sede = site_fechas_ini.id_sede) AS sede, horario FROM site_fechas_ini WHERE cancelado = 0 AND id_program = ".$_GET['id_program']." AND fecha > '2011-12-31'";
$fechas_ini = mysql_query($query_fechas_ini, $otono2011) or die(mysql_error());
$row_fechas_ini = mysql_fetch_assoc($fechas_ini);
$totalRows_fechas_ini = mysql_num_rows($fechas_ini);
$reply = '<p><label>Horario:</label></p>
				
<select name="id_fecha" id="id_fecha">
	<option value="0">Selecciona el horario que deseas</option>';
	do { 
							
		$reply .= '<option value="'.$row_fechas_ini['id_fecha'].'">'.$row_fechas_ini['horario']; if($row_fechas_ini['sede']!=NULL){$reply .= 'Sede: '.$row_fechas_ini['sede']; } $reply .= '</option>';

		
} while ($row_fechas_ini = mysql_fetch_assoc($fechas_ini));

$reply .= '</select>';

echo utf8_encode($reply);
?>