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
SELECT site_programs.id_program, site_programs.program_type, site_programs.program_name, site_programs.program_new, site_programs.id_encargado, site_programs.description, site_programs.program_pdf, site_programs.id_maestro, site_programs.duration, site_programs.costo_curso, site_programs.cost_inscripcion, site_programs.costo_modulo, site_fechas_ini.id_sede, site_fechas_ini.horario, site_fechas_ini.periodo, site_fechas_ini.fecha FROM site_programs, site_fechas_ini WHERE site_fechas_ini.periodo='o' AND site_programs.id_program = site_fechas_ini.id_program ORDER BY program_name ASC
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
header("Content-Disposition: attachment; filename=tabla.xls");
echo $return; 
?>