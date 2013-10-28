<?
/*
Mysql To Excel
Generación de excel versión 1.0
Nicolás Pardo - 2007
*/
#Conexion a la db
require_once('Connections/otono2011.php');
 
#Sql, acá pone tu consulta a la tabla que necesites exportar filtrando los datos que creas necesarios.
$sql = "SELECT id_preinscrito AS Folio, fecha_registro AS Fecha_Registro, modalidad AS Modalidad, a_paterno AS Apellido_Paterno, a_materno AS Apellido_Materno, nombre AS Nombre, genero AS Genero, fecha_nac AS Fecha_de_Nacimiento, ciudad AS Ciudad, estado AS Estado, rfc AS RFC, telefono AS Telefono, correo AS Correo, puesto AS Puesto, num_expediente AS Numero_de_Expediente, organo_adscripcion AS Organo_de_Adscripcion, recibio_propuesta AS Recibio_Propuesta, nombre_propuesta AS Nombre_de_quien_propuso, cargo_propuesta AS Cargo_de_quien_propuso FROM sp_preinscritos_pjf ORDER BY fecha_registro ASC";
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
			
			if($rs['id_preinscrito'] < 10){
					$rs['id_preinscrito'] = "000".$rs['id_preinscrito'];
				}elseif($rs['id_preinscrito'] >= 10 && $rs['id_preinscrito'] < 100){
					$rs['id_preinscrito'] = "00".$rs['id_preinscrito'];
				}elseif($rs['id_preinscrito'] >= 100 && $rs['id_preinscrito'] < 1000){
					$rs['id_preinscrito'] = "0".$rs['id_preinscrito'];
				}else{
					$rs['id_preinscrito'] = $rs['id_preinscrito'];
				}
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