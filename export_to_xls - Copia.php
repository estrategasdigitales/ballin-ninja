<?
/*
Mysql To Excel
Generación de excel versión 1.0
Nicolás Pardo - 2007
*/
#Conexion a la db
require_once('Connections/otono2011.php');
 
#Sql, acá pone tu consulta a la tabla que necesites exportar filtrando los datos que creas necesarios.
$sql = "
SELECT 
    date, (SELECT program_name FROM site_programs WHERE site_programs.id_program =  ss_preregistration.id_program) AS programa, paternal_last_name, maternal_last_name, first_name, address, neighborhood, delegation, zip_code, city, state, home_phone, cell_phone, email, nationality, old_student, (SELECT status FROM ss_status WHERE ss_status.id_status =  ss_preregistration.id_status) AS status
FROM
     ss_preregistration
ORDER BY
    id_pre_registration ASC
";
mysql_select_db($database_otono2011, $otono2011);
$r = mysql_query( $sql ) or trigger_error( mysql_error($otono2011), E_USER_ERROR );
$return = '';
if( mysql_num_rows($r)>0){
    $return .= '<table border=1>';
    $cols = 0;
    while($rs = mysql_fetch_row($r)){
		
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
header("Content-Disposition: attachment; filename=tabla_02011.xls");
echo $return; 
?>