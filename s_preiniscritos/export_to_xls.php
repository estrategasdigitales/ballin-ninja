<?php require_once('restrict_access.php'); ?>
<?php require_once('Connections/des_preinscritos.php'); ?>
<?
/*
Mysql To Excel
Generación de excel versión 1.0
Nicolás Pardo - 2007
*/

mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_disciplinas = "SELECT id_discipline FROM ss_users_disciplines WHERE id_user = ".$_SESSION['loggedin_id_user'];
$disciplinas = mysql_query($query_disciplinas, $des_preinscritos) or die(mysql_error());
$row_disciplinas = mysql_fetch_assoc($disciplinas);
#Sql, acá pone tu consulta a la tabla que necesites exportar filtrando los datos que creas necesarios.
if($row_disciplinas['id_discipline'] != 20){
		$sql="SELECT discipline AS disciplina ,program_type AS tipo ,program_name AS programa ,primer_contacto AS primer_contacto ,documentos AS documentos,envio_claves AS envio_claves_a_decse ,pago_realizado AS pago_realizado,caso_cerrado AS caso_cerrado,caso_inconcluso  AS caso_inconcluso,informes AS informes,comentario_general AS comentario,fecha_registro, como_se_entero, a_paterno, a_materno, nombre, calle_numero, colonia, del_mpo, cp, ciudad, estado, rfc, telefono, celular, correo, nacionalidad, grado_academico, institucion_estudios, exalumno
		FROM sp_preinscritos 
			INNER JOIN disciplines ON sp_preinscritos.id_discipline=disciplines.id_discipline
			INNER JOIN site_programs ON site_programs.id_program = sp_preinscritos.id_program 
			INNER JOIN sp_pasos_status ON sp_pasos_status.id_preinscrito = sp_preinscritos.id_preinscrito 
		WHERE sp_preinscritos.id_preinscrito
				IN (SELECT sp_preinscritos.id_preinscrito FROM sp_pasos_status  INNER JOIN sp_preinscritos ON sp_preinscritos.id_preinscrito = sp_pasos_status.id_preinscrito)
				AND (";
						do{
							$sql .= ' sp_preinscritos.id_discipline = '.$row_disciplinas['id_discipline'].' OR';
						  }
						while($row_disciplinas = mysql_fetch_assoc($disciplinas));
								mysql_data_seek($disciplinas,0);
								$row_disciplinas = mysql_fetch_assoc($disciplinas);
								
								$sql = substr($sql, 0, -2); 
								$sql .= 
				    ")
				ORDER BY sp_preinscritos.id_discipline ASC";
	}
	else{
		$sql="SELECT discipline AS disciplina ,program_type AS tipo ,program_name AS programa ,primer_contacto AS primer_contacto ,documentos AS documentos,envio_claves AS envio_claves_a_decse ,pago_realizado AS pago_realizado,caso_cerrado AS caso_cerrado,caso_inconcluso  AS caso_inconcluso,informes AS informes,comentario_general AS comentario
		FROM sp_preinscritos 
			INNER JOIN disciplines ON sp_preinscritos.id_discipline=disciplines.id_discipline
			INNER JOIN site_programs ON site_programs.id_program = sp_preinscritos.id_program 
			INNER JOIN sp_pasos_status ON sp_pasos_status.id_preinscrito = sp_preinscritos.id_preinscrito 
		WHERE sp_preinscritos.id_discipline
				IN (SELECT id_discipline FROM site_programs  WHERE id_discipline_alterna = 20)
				AND sp_preinscritos.id_preinscrito 
				IN(SELECT sp_preinscritos.id_preinscrito FROM sp_pasos_status INNER JOIN  sp_preinscritos ON sp_preinscritos.id_preinscrito = sp_pasos_status.id_preinscrito 
				AND sp_pasos_status.pago_realizado = 0 AND sp_pasos_status.caso_cerrado = 0 
				AND sp_pasos_status.caso_inconcluso = 0 AND sp_pasos_status.informes = 0  ) ORDER BY fecha_registro DESC, sp_preinscritos.id_preinscrito DESC";
	}

$r = mysql_query($sql); //or trigger_error( mysql_error($des_preinscritos), E_USER_ERROR );

$return = '';
if( mysql_num_rows($r)>0){
    $return .= '<table border=1>';
    $cols = 0;
    while($rs = mysql_fetch_row($r)){
			//echo $rs['disciplina'];die;
		/*$sql3 = "SELECT status FROM ss_status WHERE id_program = ".$rs['id_program'];
		mysql_select_db($database_otono2011, $otono2011);
		$r3 = mysql_query( $sql3 ) or trigger_error( mysql_error($otono2011), E_USER_ERROR );
		$rs3 = mysql_fetch_row($r3);*/
		
        $return .= '<tr>';
        if($cols==0){
            $cols = sizeof($rs);
            $cols_names = array();
            for($i=0; $i<$cols; $i++){
                $col_name = mysql_field_name($r,$i);
                $return .= '<th>'.htmlspecialchars($col_name).'</th>';
                $cols_names[$i] = $col_name;
            }
            $return .= '</tr><tr>';
        }
        for($i=0; $i<$cols; $i++){
            #En esta iteración podes manejar de manera personalizada datos, por ejemplo:
            $return .= '<td>'.htmlspecialchars($rs[$i]).'</td>';
        }
        $return .= '</tr>';
    }
    $return .= '</table>';
    mysql_free_result($r);
    
}
#Cambiando el content-type más las <table> se pueden exportar formatos como csv
header("Content-type: application/vnd-ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=tabla_dec.xls");
echo utf8_encode($return); 

?>