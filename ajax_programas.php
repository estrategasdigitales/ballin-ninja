<?php require_once('Connections/otono2011.php'); ?>
<?php

mysql_select_db($database_otono2011, $otono2011);
if($_GET['id_discipline'] != 0 && $_GET['id_discipline'] != 1 && $_GET['id_discipline'] != 2 && $_GET['id_discipline'] != 3 && $_GET['id_discipline'] != 4 && $_GET['id_discipline'] != 5 && $_GET['id_discipline'] != 6 && $_GET['id_discipline'] != 7 && $_GET['id_discipline'] != 8 && $_GET['id_discipline'] != 9 && $_GET['id_discipline'] != 10 && $_GET['id_discipline'] != 11 && $_GET['id_discipline'] != 12 && $_GET['id_discipline'] != 13 && $_GET['id_discipline'] != 14 && $_GET['id_discipline'] != 15 && $_GET['id_discipline'] != 16 && $_GET['id_discipline'] != 17 && $_GET['id_discipline'] != 18 && $_GET['id_discipline'] != 20 && $_GET['id_discipline'] != 24){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = ".$_GET['id_discipline']." AND cancelado = 0 AND periodo = 'o' ORDER BY program_type DESC, program_name ASC";

} /*else if($_GET['id_discipline'] == 20){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE  id_discipline = ".$_GET['id_discipline']." OR id_discipline_alterna = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	
}*/else if($_GET['id_discipline'] == 1 || $_GET['id_discipline'] == 2 || $_GET['id_discipline'] == 3 || $_GET['id_discipline'] == 4 || $_GET['id_discipline'] == 5 || $_GET['id_discipline'] == 6 || $_GET['id_discipline'] == 7 || $_GET['id_discipline'] == 8 || $_GET['id_discipline'] == 9 || $_GET['id_discipline'] == 10 || $_GET['id_discipline'] == 11 || $_GET['id_discipline'] == 12 || $_GET['id_discipline'] == 13 || $_GET['id_discipline'] == 14 || $_GET['id_discipline'] == 15 || $_GET['id_discipline'] == 16 || $_GET['id_discipline'] == 17 || $_GET['id_discipline'] == 18 || $_GET['id_discipline'] == 20 || $_GET['id_discipline'] == 24 ){
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = ".$_GET['id_discipline']." AND periodo = 'o' AND cancelado = 0 ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna, id_discipline_alterna_2 
									FROM site_programs 
									WHERE (id_discipline_alterna = ".$_GET['id_discipline']." 
										OR id_discipline_alterna_2 = ".$_GET['id_discipline'].") 
										AND periodo = 'o' 
										AND cancelado = '0' 
										ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}/*else if($_GET['id_discipline'] == 2){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 2 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 2 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 3){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 3 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 3 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 4){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 4 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 4 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 5){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 5 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 5 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 6){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 6 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 6 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 7){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 7 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 7 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 8){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 8 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 8 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 9){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 9 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 9 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 10){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 10 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 10 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 11){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 11 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 11 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);
		
}else if($_GET['id_discipline'] == 12){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 12 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 12 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 13){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 13 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 13 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 14){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 14 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 14 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 15){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 15 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 15 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 16){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 16 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 16 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 17){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 17 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 17 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 18){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 18 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 18 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 20){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 20 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 20 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01'  AND cancelado = '0') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $otono2011) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);
	
}*/else{
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE cancelado = 0 AND periodo = 'o'  ORDER BY program_type DESC, program_name ASC";
}
$programas = mysql_query($query_programas, $otono2011) or die(mysql_error());
$row_programas = mysql_fetch_assoc($programas);

$tipo_ant = '';

$response = '';

$response .= '

	<select name="id_program" id="id_program" style="width:540px; max-width:540px;">
		<option value="0" selected="selected" disabled="disabled">Selecciona un programa</option>';
		
			do{
				if(($row_programas['id_program']!=217) && ($row_programas['id_program']!=195)){
					$tipo = $row_programas['program_type'];
					switch ($tipo) {
						case 'programahp':
							$tipo_mostrar = "PROGRAMAS HP";
							break;
						case 'diplomado':
							$tipo_mostrar = "DIPLOMADOS";
							break;
						case 'curso':
							$tipo_mostrar = "CURSOS";
							break;
						
						default:
							$tipo_mostrar = strtoupper($tipo);
							break;
					}
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----'.$tipo_mostrar.'---</option>';}
					$response .= '<option value="'.$row_programas['id_program'].'">'.utf8_encode($row_programas['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
			} while($row_programas = mysql_fetch_assoc($programas));

			if(isset($row_programas_alternativa) && $row_programas_alternativa != NULL){

				do{
				if(($row_programas_alternativa['id_discipline_alterna']==1) && ($row_programas_alternativa['id_discipline_alterna']==1)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==2) && ($row_programas_alternativa['id_discipline_alterna']==2)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==3) && ($row_programas_alternativa['id_discipline_alterna']==3)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==4) && ($row_programas_alternativa['id_discipline_alterna']==4)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==5) && ($row_programas_alternativa['id_discipline_alterna']==5)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==6) && ($row_programas_alternativa['id_discipline_alterna']==6)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==7) && ($row_programas_alternativa['id_discipline_alterna']==7)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==8) && ($row_programas_alternativa['id_discipline_alterna']==8)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==9) && ($row_programas_alternativa['id_discipline_alterna']==9)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==10) && ($row_programas_alternativa['id_discipline_alterna']==10)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==11) && ($row_programas_alternativa['id_discipline_alterna']==11)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==12) && ($row_programas_alternativa['id_discipline_alterna']==12)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==13) && ($row_programas_alternativa['id_discipline_alterna']==13)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==14) && ($row_programas_alternativa['id_discipline_alterna']==14)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==15) && ($row_programas_alternativa['id_discipline_alterna']==15)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==16) && ($row_programas_alternativa['id_discipline_alterna']==16)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==17) && ($row_programas_alternativa['id_discipline_alterna']==17)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				if(($row_programas_alternativa['id_discipline_alterna']==18) && ($row_programas_alternativa['id_discipline_alterna']==18)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				
				if(($row_programas_alternativa['id_discipline_alterna']==20) && ($row_programas_alternativa['id_discipline_alterna']==20)){
					$tipo = "PROGRAMAS COMPARTIDOS";
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
				
				if(($row_programas_alternativa['id_discipline_alterna_2']==24) && ($row_programas_alternativa['id_discipline_alterna_2']==24)){
					$tipo = $row_programas_alternativa['program_type'];
					if($tipo != $tipo_ant){$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';}
					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					$tipo_ant = $tipo;
				}
			} while($row_programas_alternativa = mysql_fetch_assoc($programas_alternativa));

			}
		
	$response .= '</select>
';

mysql_free_result($programas);

echo $response;
?>
