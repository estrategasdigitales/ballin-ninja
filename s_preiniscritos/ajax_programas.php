<?php require_once('Connections/des_preinscritos.php'); 

$discipline = $_GET['id_discipline'];
$id_user = $_GET['id_usuario'];

mysql_select_db($database_des_preinscritos, $des_preinscritos);
if($discipline != 0 && $discipline != 4 && $discipline != 20 && $discipline != 9 && $discipline != 14 && $discipline != 8 && $discipline != 6 && $discipline != 11 && $discipline != 2 && $discipline != 3 && $discipline != 10 && $discipline != 24){
		
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE cancelado = 0 AND id_discipline = ".$discipline." ORDER BY program_type DESC, program_name ASC";
	
}else if($discipline == 20){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE (id_discipline = ".$discipline." OR id_discipline_alterna = ".$discipline.") AND periodo = 'o' AND cancelado = 0 ORDER BY program_type DESC, program_name ASC";
	
}else if($discipline == 6 || $discipline == 2 || $discipline == 4 || $discipline == 5 || $discipline == 8 || $discipline == 3 || $discipline == 10 || $discipline == 11){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = ".$discipline." AND cancelado = 0 AND periodo = 'o' ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = ".$discipline." AND cancelado = 0 AND periodo = 'o' ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($discipline == 9){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = ".$discipline." AND cancelado = 0 AND periodo = 'o' ORDER BY id_program DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna FROM site_programs WHERE id_discipline_alterna = ".$discipline."  OR id_discipline_alterna_2 = ".$discipline." AND cancelado = 0 AND periodo = 'o' ORDER BY program_type ASC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($discipline == 24){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE id_discipline = 24 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$query_programas_alternativa = "SELECT id_program, program_type, program_name, id_discipline_alterna, id_discipline_alterna_2 FROM site_programs WHERE id_discipline_alterna = 24 OR id_discipline_alterna_2 = 24 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-06-01') ORDER BY program_type DESC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else if($discipline == 14){
	
	/*$query_programas2 = "SELECT * FROM site_programs WHERE (id_discipline = 14 OR id_discipline_alterna = 14) AND program_type = 'curso' AND cancelado = 0 AND idioma = 1 AND periodo ='o' ORDER BY idioma ASC, program_name ASC";
	$query_programas_alternativa2 = "SELECT * FROM site_programs WHERE id_discipline = 14 AND program_type = 'curso' AND cancelado = 0 AND idioma = 1 AND periodo ='o' ORDER BY idioma ASC, program_name ASC";
	$programas_alternativa2 = mysql_query($query_programas_alternativa2, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa2 = mysql_fetch_assoc($programas_alternativa2);*/

	$query_programas = "SELECT * FROM site_programs WHERE (id_discipline = 14 OR id_discipline_alterna = 14) AND cancelado = 0 AND periodo ='o' ORDER BY idioma ASC, program_name ASC";
	$query_programas_alternativa = "SELECT * FROM site_programs WHERE id_discipline = 14 AND cancelado = 0 AND periodo ='o' ORDER BY idioma ASC, program_name ASC";
	$programas_alternativa = mysql_query($query_programas_alternativa, $des_preinscritos) or die(mysql_error());
	$row_programas_alternativa = mysql_fetch_assoc($programas_alternativa);

}else{
	
	$query_programas = "SELECT id_program, id_discipline, id_discipline_alterna, id_discipline_alterna_2, program_type, program_name, idioma
FROM site_programs 
WHERE (id_discipline IN (SELECT id_discipline FROM ss_users_disciplines WHERE id_user = ".$id_user." ) 
OR id_discipline_alterna IN (SELECT id_discipline FROM ss_users_disciplines WHERE id_user = ".$id_user." ) 
OR id_discipline_alterna_2 IN (SELECT id_discipline FROM ss_users_disciplines WHERE id_user = ".$id_user." ) )
AND cancelado = 0
AND periodo = 'o'
GROUP BY id_program
ORDER BY program_type DESC, idioma DESC, program_name ASC";

}

$programas = mysql_query($query_programas, $des_preinscritos) or die(mysql_error());
$row_programas = mysql_fetch_assoc($programas);

$tipo_ant = 'diplomado';

$response = '';

$response .= '

	<select name="id_program" id="id_program" style="max-width:350px; width:350px;">
		<option value="0" selected="selected" disabled="disabled">Selecciona un programa</option>
		<!--option disabled="disabled">-----DIPLOMADOS---</option-->';

			$tipo = "";
			$tipo_ant = "";

				do{

                      switch ($row_programas['program_type']) {
                        case 'programahp':
                          $tipo_programa = 'PROGRAMAS HP';
                          $tipo_ant = $row_programas['program_type'];
                          break;
                        case 'programa':
                          $tipo_programa = 'PROGRAMAS';
                          $tipo_ant = $row_programas['program_type'];
                          break;
                        case 'diplomado':
                          $tipo_programa = 'DIPLOMADOS';
                          $tipo_ant = $row_programas['program_type'];
                          break;
                        case 'curso':
                          $tipo_programa = 'CURSOS';
                          $tipo_ant = $row_programas['program_type'];
                          break;
                      }

                     if($tipo != $tipo_ant){
                        $response .=  '<option disabled="disabled">-----'.$tipo_programa.'---</option>';
                      }


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
				else if(($row_programas_alternativa['id_discipline_alterna']==5) && ($row_programas_alternativa['id_discipline_alterna']==5))
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
				else if(($row_programas_alternativa['id_discipline_alterna']==16) && ($row_programas_alternativa['id_discipline_alterna']==16))
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
				/*else if(($row_programas_alternativa['id_discipline']==14))
				{

					
					while($row_programas_alternativa2 = mysql_fetch_assoc($programas_alternativa2)){
					$response .= '<option value="'.$row_programas_alternativa2['id_program'].'">'.utf8_encode($row_programas_alternativa2['program_name']).'</option>';
				}
					
					
				}*/
				else if(($row_programas_alternativa['id_discipline_alterna']==24) && ($row_programas_alternativa['id_discipline_alterna']==24))
				{

					$tipo = $row_programas_alternativa['program_type'];

					if($tipo != $tipo_ant)
						{
							$response .= '<option disabled="disabled">-----CURSOS---</option>';
						}

					$response .= '<option value="'.$row_programas_alternativa['id_program'].'">'.utf8_encode($row_programas_alternativa['program_name']).'</option>';
					
					$tipo_ant = $tipo;
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
			} while($row_programas_alternativa = mysql_fetch_assoc($programas_alternativa));

			}

	$response .= '</select>
';

mysql_free_result($programas);

echo $response;
?>