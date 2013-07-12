<?php require_once('Connections/des_preinscritos.php'); ?>
<?php
//query para obtener las areas a las que puede acceder el usuario logeado
mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_disciplinas = "SELECT id_discipline FROM ss_users_disciplines WHERE id_user = 1";
//$query_disciplinas = "SELECT id_discipline FROM ss_users_disciplines WHERE id_user = ".$_SESSION['id_user'];
$disciplinas = mysql_query($query_disciplinas, $des_preinscritos) or die(mysql_error());
$row_disciplinas = mysql_fetch_assoc($disciplinas);

mysql_select_db($database_des_preinscritos, $des_preinscritos);
if($_GET['id_discipline'] != 0 && $_GET['id_discipline'] != 4 && $_GET['id_discipline'] != 20 && $_GET['id_discipline'] != 9 && $_GET['id_discipline'] != 14 && $_GET['id_discipline'] != 8 && $_GET['id_discipline'] != 6 && $_GET['id_discipline'] != 11 && $_GET['id_discipline'] != 2 && $_GET['id_discipline'] != 3 && $_GET['id_discipline'] != 10 && $_GET['id_discipline'] != 24){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE cancelado = 0 AND id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01' AND cancelado != 1) ORDER BY program_type DESC, program_name ASC";
	
}else if($_GET['id_discipline'] == 20){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE  id_discipline = ".$_GET['id_discipline']." OR id_discipline_alterna = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	
}else if($_GET['id_discipline'] == 6 || $_GET['id_discipline'] == 2 || $_GET['id_discipline'] == 4 || $_GET['id_discipline'] == 9 || $_GET['id_discipline'] == 8 || $_GET['id_discipline'] == 3 || $_GET['id_discipline'] == 10 || $_GET['id_discipline'] == 24){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo >= '2013-06-01' AND periodo = 'o') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline, id_discipline_alterna, id_discipline_alterna_2 FROM site_programs WHERE id_discipline_alterna = ".$_GET['id_discipline']." OR id_discipline_alterna_2 = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01' AND periodo = 'o') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}/*else if($_GET['id_discipline'] == 2){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 2 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 2 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 4){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 4 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 4 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 9){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 9 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 9 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 8){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 8 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 8 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 3){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 3 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 3 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 10){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 10 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 10 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}*/else if($_GET['id_discipline'] == 14){
	
	$query_programas2 = "SELECT * FROM site_programs WHERE id_discipline = 14 AND program_type = 'curso' AND cancelado = 0 AND idioma = 1 AND cancelado = 0 AND  id_program IN (SELECT id_program FROM site_fechas_idiomas WHERE inicio >= '2013-00-00' AND periodo = 'o') ORDER BY idioma ASC, program_name ASC";
	$query_programas_alternativa2 = "SELECT * FROM site_programs WHERE id_discipline = 14 AND program_type = 'curso' AND cancelado = 0 AND idioma = 1 AND cancelado = 0 AND id_program IN (SELECT id_program FROM site_fechas_idiomas WHERE inicio >= '2013-06-01' AND periodo = 'o') ORDER BY idioma ASC, program_name ASC";
	$programas_alternativa2 = mysql_query($query_programas_alternativa2, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa2 = mysql_fetch_assoc($programas_alternativa2);

	$query_programas = "SELECT * FROM site_programs WHERE id_discipline = 14 AND cancelado = 0 AND cancelado = 0 AND  id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2012-12-06' AND periodo = 'o') ORDER BY idioma ASC, program_name ASC";
	$query_programas_alternativa = "SELECT * FROM site_programs WHERE id_discipline = 14 AND cancelado = 0 AND cancelado = 0 AND  id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2012-06-01') ORDER BY idioma ASC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($_GET['id_discipline'] == 11){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 11 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, id_discipline, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = 11 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}

else{
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE cancelado = 0 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2012-12-06' AND periodo = 'o') ORDER BY program_type DESC, program_name ASC";

}

$programas = mysql_query($query_programas, $des_preinscritos) or die(mysql_error());
$row_programas = mysql_fetch_assoc($programas);

$tipo_ant = 'diplomado';

$tipo_prog = "";

$response = '';

$response .= '

	<select name="id_program" id="id_program" style="max-width:350px; width:350px;">
		<option value="0" selected="selected" disabled="disabled">Selecciona un programa</option>
		<option disabled="disabled">-----DIPLOMADOS---</option>';
				do{

					$tipo = $row_programas['program_type'];
					
					if($tipo != $tipo_ant)
						{
							$response .= '<option disabled="disabled">-----CURSOS---</option>';
				}
					$response .= '<option value="'.$row_programas['id_program'].'">'.utf8_encode($row_programas['program_name']).'</option>';
					
					$tipo_ant = $tipo;

			} while($row_programas = mysql_fetch_assoc($programas));
		
			if(isset($row_programas_alternativa) && $row_programas_alternativa != NULL){

				do{

				if(($row_programas_alternativa['id_discipline_alterna']==6) && ($row_programas_alternativa['id_discipline_alterna']==6))
				{

					$tipo = $row_programas_alternativa['program_type'];

					if($tipo != $tipo_ant)
						{
							$response .= '<option disabled="disabled">-----CURSOS---</option>';
						}

					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					
					$tipo_ant = $tipo;
				}
				else if(($row_programas_alternativa['id_discipline_alterna']==2) && ($row_programas_alternativa['id_discipline_alterna']==2))
				{

					$tipo = $row_programas_alternativa['program_type'];

					if($tipo != $tipo_ant)
						{
							$response .= '<option disabled="disabled">-----CURSOS---</option>';
						}

					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					
					$tipo_ant = $tipo;
				}
				else if(($row_programas_alternativa['id_discipline_alterna']==3) && ($row_programas_alternativa['id_discipline_alterna']==3))
				{

					$tipo = $row_programas_alternativa['program_type'];

					if($tipo != $tipo_ant)
						{
							$response .= '<option disabled="disabled">-----CURSOS---</option>';
						}

					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					
					$tipo_ant = $tipo;
				}
				else if(($row_programas_alternativa['id_discipline_alterna']==9) && ($row_programas_alternativa['id_discipline_alterna']==9))
				{

					$tipo = $row_programas_alternativa['program_type'];
					
					if($tipo == $tipo_prog)
						{
							$response .= '<option disabled="disabled">-----Programas HP---</option>';
						}

					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					
					$tipo_ant = $tipo;
				}
				else if(($row_programas_alternativa['id_discipline_alterna']==10) && ($row_programas_alternativa['id_discipline_alterna']==10))
				{

					$tipo = $row_programas_alternativa['program_type'];

					if($tipo != $tipo_ant)
						{
							$response .= '<option disabled="disabled">-----CURSOS---</option>';
						}

					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					
					$tipo_ant = $tipo;
				}
				else if(($row_programas_alternativa['id_discipline_alterna']==8) && ($row_programas_alternativa['id_discipline_alterna']==8))
				{

					$tipo = $row_programas_alternativa['program_type'];

					if($tipo != $tipo_ant)
						{
							$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';
						}

					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					
					$tipo_ant = $tipo;
				}else if(($row_programas_alternativa['id_discipline_alterna']==4) && ($row_programas_alternativa['id_discipline_alterna']==4))
				{

					$tipo = $row_programas_alternativa['program_type'];

					if($tipo != $tipo_ant)
						{
							$response .= '<option disabled="disabled">-----PROGRAMAS COMPARTIDOS---</option>';
						}

					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					
					$tipo_ant = $tipo;
				}
				else if(($row_programas_alternativa['id_discipline']==14))
				{

					
					while($row_programas_alternativa2 = mysql_fetch_assoc($programas_alternativa2)){
					$response .= '<option value="'.$row_programas_alternativa2['id_program'].'">'.utf8_encode($row_programas_alternativa2['program_name']).'</option>';
				}
					
					
				}
				else if(($row_programas_alternativa['id_discipline_alterna']==11) && ($row_programas_alternativa['id_discipline_alterna']==11))
				{

					$tipo = $row_programas_alternativa['program_type'];

					if($tipo != $tipo_ant)
						{
							$response .= '<option disabled="disabled">-----CURSOS---</option>';
						}

					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					
					$tipo_ant = $tipo;
				}
				else if(($row_programas_alternativa['id_discipline_alterna_2']==24))
				{

					$tipo = $row_programas_alternativa['program_type'];

					if($tipo != $tipo_ant)
						{
							$response .= '<option disabled="disabled">-----CURSOS---</option>';
						}

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