<?php require_once('Connections/otono2011.php'); ?>
<?php

if($_GET['id_discipline']==NULL || $_GET['id_discipline']==0){
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names = "SELECT * FROM site_programs WHERE program_type ='diplomado' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
	$row_diplos_names = mysql_fetch_assoc($diplos_names);
	$totalRows_diplos_names = mysql_num_rows($diplos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names = "SELECT * FROM site_programs WHERE program_type ='curso' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$cursos_names = mysql_query($query_cursos_names, $otono2011) or die(mysql_error());
	$row_cursos_names = mysql_fetch_assoc($cursos_names);
	$totalRows_cursos_names = mysql_num_rows($cursos_names);
}else{
	$area = $_GET['id_discipline'];
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names = "SELECT * FROM site_programs WHERE id_discipline = $area AND program_type ='diplomado' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$diplos_names = mysql_query($query_diplos_names, $otono2011) or die(mysql_error());
	$row_diplos_names = mysql_fetch_assoc($diplos_names);
	$totalRows_diplos_names = mysql_num_rows($diplos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_diplos_names_2 = "SELECT * FROM site_programs WHERE id_discipline_alterna != 'NULL' AND program_type ='diplomado' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$diplos_names_2 = mysql_query($query_diplos_names_2, $otono2011) or die(mysql_error());
	$row_diplos_names_2 = mysql_fetch_assoc($diplos_names_2);
	$totalRows_diplos_names_2 = mysql_num_rows($diplos_names_2);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names = "SELECT * FROM site_programs WHERE id_discipline = $area AND program_type ='curso' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$cursos_names = mysql_query($query_cursos_names, $otono2011) or die(mysql_error());
	$row_cursos_names = mysql_fetch_assoc($cursos_names);
	$totalRows_cursos_names = mysql_num_rows($cursos_names);
	
	mysql_select_db($database_otono2011, $otono2011);
	$query_cursos_names_2 = "SELECT * FROM site_programs WHERE id_discipline_alterna != 'NULL' AND program_type ='curso' AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'p') ORDER BY program_name ASC";
	$cursos_names_2 = mysql_query($query_cursos_names_2, $otono2011) or die(mysql_error());
	$row_cursos_names_2 = mysql_fetch_assoc($cursos_names_2);
	$totalRows_cursos_names_2 = mysql_num_rows($cursos_names_2);
}

$reply = '';
	if($totalRows_diplos_names != 0){ 

	  $reply .=  '<option value="0" disabled="disabled">---------------DIPLOMADOS---------------</option>';
	 do { 

	  $reply .=  '<option value="'.$row_diplos_names['id_program'].'">'.$row_diplos_names['program_name'].'</option>';

		} while ($row_diplos_names = mysql_fetch_assoc($diplos_names));
		  $rows_diplos = mysql_num_rows($diplos_names);
		  if($rows_diplos > 0) {
			  mysql_data_seek($diplos_names, 0);
			  $row_diplos_names = mysql_fetch_assoc($diplos_names);
		  }
	}
	if(($totalRows_diplos_names_2 != 0)&&($totalRows_diplos_names == 0)){
	  $reply .=  '<option value="0" disabled="disabled">---------------DIPLOMADOS---------------</option>';
	} 
	if($totalRows_diplos_names_2 != 0){
			  
	  do { 
		
			//Nuevo codigo
			$diplos_disc_alter_array = explode(',',$row_diplos_names_2['id_discipline_alterna']);
		
			for($i = 0; $i < sizeof($diplos_disc_alter_array); $i++){
			
				if($area == $diplos_disc_alter_array[$i]){ 
	  
	  $reply .=  '<option value="'.$row_diplos_names_2['id_program'].'">'.$row_diplos_names_2['program_name'].'</option>';

					}
				}
			} while ($row_diplos_names_2 = mysql_fetch_assoc($diplos_names_2));
	}
	if($totalRows_cursos_names != 0){
	  $reply .=  '<option value="0" disabled="disabled">-----------------CURSOS--------------------</option>';
	  do { 
	  $reply .=  '<option value="'.$row_cursos_names['id_program'].'">'.$row_cursos_names['program_name'].'</option>';

	} while ($row_cursos_names = mysql_fetch_assoc($cursos_names));
	  $rows_cursos = mysql_num_rows($cursos_names);
	  if($rows_cursos > 0) {
		  mysql_data_seek($cursos_names, 0);
		  $row_cursos_names = mysql_fetch_assoc($cursos_names);
	  }
	}
	if(($totalRows_cursos_names_2 != 0)&&($totalRows_cursos_names == 0)){
	  $reply .=  '<option value="0" disabled="disabled">-----------------CURSOS--------------------</option>';
	}
	if($totalRows_cursos_names_2 != 0){
		do { 
			
			$cursos_disc_alter_array = explode(',',$row_cursos_names_2['id_discipline_alterna']);
		
			for($i = 0; $i < sizeof($cursos_disc_alter_array); $i++){
			
				if($area == $cursos_disc_alter_array[$i]){ 
				
	  
	  $reply .=  '<option value="'.$row_cursos_names_2['id_program'].'">'.$row_cursos_names_2['program_name'].'</option>';
				}
			}
		} while ($row_cursos_names_2 = mysql_fetch_assoc($cursos_names_2));
		  $rows_cursos_2 = mysql_num_rows($cursos_names_2);
		  if($rows_cursos_2 > 0) {
			  mysql_data_seek($cursos_names_2, 0);
			  $row_cursos_names_2 = mysql_fetch_assoc($cursos_names_2);
		  }
		}
		
		if($_GET['id_discipline']==14){
			
			mysql_select_db($database_otono2011, $otono2011);
			$query_cursos_idiomas = "SELECT * FROM site_programs WHERE id_discipline = 14 AND idioma =1 AND id_program IN (SELECT id_program FROM site_fechas_idiomas WHERE periodo = 'p') ORDER BY program_name ASC";
			$cursos_idiomas = mysql_query($query_cursos_idiomas, $otono2011) or die(mysql_error());
			$row_cursos_idiomas = mysql_fetch_assoc($cursos_idiomas);
			$totalRows_cursos_idiomas = mysql_num_rows($cursos_idiomas);
			
			do { 
			
			  $reply .=  '<option value="'.$row_cursos_idiomas['id_program'].'">'.$row_cursos_idiomas['program_name'].'</option>';
				
				} while ($row_cursos_idiomas = mysql_fetch_assoc($cursos_idiomas));
				  $row_cursos_idiomas = mysql_num_rows($cursos_idiomas);
			  if($row_cursos_idiomas > 0) {
				  mysql_data_seek($cursos_names_2, 0);
				  $row_cursos_idiomas = mysql_fetch_assoc($cursos_idiomas);
			  }
		}
		
		
echo utf8_encode($reply);
?>