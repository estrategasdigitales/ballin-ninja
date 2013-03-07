<?php
require_once('Connections/otono2011.php');

$disciplina = $_POST['disciplina'];

$response = '';

/// D I P L O M A D O S

mysql_select_db($database_otono2011, $otono2011);
$query_progs_diplos = "SELECT * FROM site_programs WHERE program_type = 'diplomado' AND cancelado = 0 AND id_discipline  = ".$disciplina." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-00-00' AND periodo = 'p') ORDER BY program_name ASC";
$progs_diplos = mysql_query($query_progs_diplos, $otono2011) or die(mysql_error());    
$row_progs_diplos = mysql_fetch_assoc($progs_diplos);
$totalRows_progs_diplos = mysql_num_rows($progs_diplos);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_diplos_2 = "SELECT * FROM site_programs WHERE program_type = 'diplomado' AND cancelado = 0 AND id_discipline_alterna  = ".$disciplina." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-00-00' AND periodo = 'p') ORDER BY program_name ASC";
$progs_diplos_2 = mysql_query($query_progs_diplos_2, $otono2011) or die(mysql_error());
$row_progs_diplos_2 = mysql_fetch_assoc($progs_diplos_2);
$totalRows_progs_diplos_2 = mysql_num_rows($progs_diplos_2);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_diplos_3 = "SELECT * FROM site_programs WHERE program_type = 'diplomado' AND cancelado = 0 AND id_discipline_alterna_2  = ".$disciplina." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-00-00' AND periodo = 'p') ORDER BY program_name ASC";
$progs_diplos_3 = mysql_query($query_progs_diplos_3, $otono2011) or die(mysql_error());
$row_progs_diplos_3 = mysql_fetch_assoc($progs_diplos_3);
$totalRows_progs_diplos_3 = mysql_num_rows($progs_diplos_3);

/// C U R S O S

mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos = "SELECT * FROM site_programs WHERE program_type = 'curso' AND cancelado = 0 AND cancelado = 0 AND id_discipline = ".$disciplina." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2012-12-06' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_cursos = mysql_query($query_progs_cursos, $otono2011) or die(mysql_error());
$row_progs_cursos = mysql_fetch_assoc($progs_cursos);
$totalRows_progs_cursos = mysql_num_rows($progs_cursos);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos_2 = "SELECT * FROM site_programs WHERE program_type = 'curso' AND cancelado = 0 AND cancelado = 0 AND id_discipline_alterna  = ".$disciplina." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE  fecha >= '2012-12-06' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_cursos_2 = mysql_query($query_progs_cursos_2, $otono2011) or die(mysql_error());
$row_progs_cursos_2 = mysql_fetch_assoc($progs_cursos_2);
$totalRows_progs_cursos_2 = mysql_num_rows($progs_cursos_2);

mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos_3 = "SELECT * FROM site_programs WHERE program_type = 'curso' AND cancelado = 0 AND cancelado = 0 AND id_discipline_alterna_2  = ".$disciplina." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2012-12-06' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_cursos_3 = mysql_query($query_progs_cursos_3, $otono2011) or die(mysql_error());
$row_progs_cursos_3 = mysql_fetch_assoc($progs_cursos_3);
$totalRows_progs_cursos_3 = mysql_num_rows($progs_cursos_3);

//PROGRAMAS
mysql_select_db($database_otono2011, $otono2011);
$query_progs_progs = "SELECT * FROM site_programs WHERE program_type = 'programa' AND cancelado = 0 AND id_discipline = ".$disciplina." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2012-12-06' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_progs = mysql_query($query_progs_progs, $otono2011) or die(mysql_error());
$row_progs_progs = mysql_fetch_assoc($progs_progs);
$totalRows_progs_progs = mysql_num_rows($progs_progs);

//PROGRAMAS HP

mysql_select_db($database_otono2011, $otono2011);
$query_progs_hp = "SELECT * FROM site_programs WHERE program_type = 'programahp'  AND cancelado = 0 AND id_discipline = ".$disciplina." OR id_discipline_alterna = ".$disciplina." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2013-00-00' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_hp = mysql_query($query_progs_hp, $otono2011) or die(mysql_error());
$row_progs_hp = mysql_fetch_assoc($progs_hp);
$totalRows_progs_hp = mysql_num_rows($progs_hp);

//IDIOMAS

mysql_select_db($database_otono2011, $otono2011);
$query_progs_cursos_i = "SELECT * FROM site_programs WHERE program_type = 'curso' AND cancelado = 0 AND idioma = 1 AND cancelado = 0 AND id_discipline = ".$disciplina." AND id_program IN (SELECT id_program FROM site_fechas_idiomas WHERE inicio >= '2013-00-00' AND periodo = 'p') ORDER BY idioma ASC, program_name ASC";
$progs_cursos_i = mysql_query($query_progs_cursos_i, $otono2011) or die(mysql_error());
$row_progs_cursos_i = mysql_fetch_assoc($progs_cursos_i);
$totalRows_progs_cursos_i = mysql_num_rows($progs_cursos_i);

/// P R O G R A M A S
/*
if(isset($_POST['programa']) && $_POST['programa'] != NULL))
mysql_select_db($database_otono2011, $otono2011);
$query_programa = "SELECT * FROM site_programs WHERE cancelado = 0 AND id_program = ".$programa;
$programa = mysql_query($query_programa, $otono2011) or die(mysql_error());
$row_programa = mysql_fetch_assoc($programa);
$totalRows_programa = mysql_num_rows($programa);


mysql_select_db($database_otono2011, $otono2011);
$query_fecha_ini = "SELECT * FROM site_fechas_ini WHERE periodo = 'p' AND cancelado = 0 AND fecha >= '2013-00-00' AND id_program = ".$programa;
$fecha_ini = mysql_query($query_fecha_ini, $otono2011) or die(mysql_error());
//$row_fecha_ini = mysql_fetch_assoc($fecha_ini);
$totalRows_fecha_ini = mysql_num_rows($fecha_ini);*/


	$response = '<p class="header_programas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id="close_slider_menu" style="cursor:pointer;"><img style="border:none;" src="imagenes/cerrar_slidemenu.png"></a></p>';
	
	$response .= '<p style="padding-left:10px;"><a href=# onclick=parent.location="http://www.diplomados.uia.mx/articulos.php?id_discipline='.$disciplina.'" style="font-size:16px; font-weight:bold; color: #666666;">Entrevista</a></p>';
   
	/// Listado de diplomados

	

	if($totalRows_progs_diplos != 0 || $totalRows_progs_diplos_2 != 0 || $totalRows_progs_diplos_3 != 0 || $totalRows_progs_diplos_hp != 0){ 

	 	$response .= '<p style="padding-left:10px"><img src="imagenes/linea_submenu.png"><p style="font-size:16px; font-weight:bold; padding-left:10px;">Diplomados</p><p style="padding-left:10px;"><img src="imagenes/linea_submenu.png"></p><ul style="list-style-type:none; margin-left:-29px;">';

	 }elseif($totalRows_progs_progs != 0){

		$response .= '<img src="imagenes/linea_submenu.png">';

	 }
	if($totalRows_progs_diplos > 0){ 

	   do {
					$no_n = str_replace('ñ', 'n', $row_progs_diplos['program_name']);
					$no_a = str_replace('á', 'a', $no_n);
					$no_e = str_replace('é', 'e', $no_a);
					$no_i = str_replace('í', 'i', $no_e);
					$no_o = str_replace('ó', 'o', $no_i);
					$no_u = str_replace('ú', 'u', $no_o);
					$titulo = str_replace(' ', '_', $no_u); 
	 $response .=  "<li style='padding:3px 15px 3px 0px;'><a href=# onclick=parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=".$disciplina."&amp;id_program=".$row_progs_diplos['id_program']."&titulo=".$titulo."'>".utf8_encode($row_progs_diplos['program_name']);

	 	if($row_progs_diplos['program_new']==1){

	 		$response .= '<span class="contenido_diploRojo"> Nuevo </span>';

	 	}else if($row_progs_diplos['program_new']==2){

	 		$response .= '<span class="contenido_diploRojo"> Nueva versión </span>';

	 	} 

	 	$response .= '</a></li>';

	 } while ($row_progs_diplos = mysql_fetch_assoc($progs_diplos)); 

	}

	if($totalRows_progs_diplos_2 > 0){ 

	   do {

	   				$no_n = str_replace('ñ', 'n', $row_progs_diplos_2['program_name']);
					$no_a = str_replace('á', 'a', $no_n);
					$no_e = str_replace('é', 'e', $no_a);
					$no_i = str_replace('í', 'i', $no_e);
					$no_o = str_replace('ó', 'o', $no_i);
					$no_u = str_replace('ú', 'u', $no_o);
					$titulo = str_replace(' ', '_', $no_u); 
					
	 $response .=  "<li style='padding:3px 15px 3px 0px;'><a href=# onclick=parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=".$disciplina."&amp;id_program=".$row_progs_diplos_2['id_program']."&titulo=".$titulo."'>".utf8_encode($row_progs_diplos_2['program_name']);

	 	if($row_progs_diplos_2['program_new']==1){

	 		$response .= '<span class="contenido_diploRojo"> Nuevo </span> ';

	 	}else if($row_progs_diplos_2['program_new']==2){

	 		$response .= '<span class="contenido_diploRojo"> Nueva versión </span> ';

	 	} 

	 	$response .= '</a></li>';

	 } while ($row_progs_diplos_2 = mysql_fetch_assoc($progs_diplos_2));

	}

// P R O G R A M A S

	if($totalRows_progs_diplos_3 > 0){ 

	   do{
					
			$response .=  "<li style='padding:3px 15px 3px 0px;'><a href=# onclick=parent.location='http://www.diplomados.uia.mx/programas.php?id_discipline=".$disciplina."&amp;id_program=".$row_progs_diplos_3['id_program']."&titulo=".$titulo."'>".utf8_encode($row_progs_diplos_3['program_name']);

		 	if($row_progs_diplos_3['program_new']==1){

		 		$response .= '<span class="contenido_diploRojo"> Nuevo </span> ';

		 	}else if($row_progs_diplos_3['program_new']==2){

		 		$response .= '<span class="contenido_diploRojo"> Nueva versión </span> ';
		 	} 
		 	$response .= '</a></li>';

		}while ($row_progs_diplos_3 = mysql_fetch_assoc($progs_diplos_3)); 
	}
	$response .= "</ul>";

	if($totalRows_progs_progs > 0){ 
		$response .='<!--p class="header_programas">Programas</p!-->
					<ul class="lista_programas">';
					do {
							$no_n = str_replace('ñ', 'n', $row_progs_progs['program_name']);
							$no_a = str_replace('á', 'a', $no_n);
							$no_e = str_replace('é', 'e', $no_a);
							$no_i = str_replace('í', 'i', $no_e);
							$no_o = str_replace('ó', 'o', $no_i);
							$no_u = str_replace('ú', 'u', $no_o);
							$titulo = str_replace(' ', '_', $no_u); 
							$response .= '<li style="padding:3px 15px 3px 0px;"><a href=# onclick=parent.location="http://www.diplomados.uia.mx/programas.php?id_discipline='.$disciplina.'&amp;id_program='.$row_progs_progs["id_program"].'&titulo='.$titulo.'">'.utf8_encode($row_progs_progs["program_name"]);
           				 	if($row_progs_progs['program_new']==1){

						 		$response .= '<span class="contenido_diploRojo"> Nuevo </span> ';

						 	}else if($row_progs_progs['program_new']==2){

						 		$response .= '<span class="contenido_diploRojo"> Nueva versión </span> ';
							 }
							$response .= '</a></li>';
					} while ($row_progs_progs = mysql_fetch_assoc($progs_progs)); 

					$response .= '</ul>';
	} 



	/// Listado de cursos
 
	if($totalRows_progs_cursos != 0 || $totalRows_progs_cursos_2 != 0 || $totalRows_progs_cursos_3 != 0){

		$response .= '<img src="imagenes/linea_submenu.png"><p style="font-size:16px; font-weight:bold; padding:10px 0 0 10px;">Cursos</p><img src="imagenes/linea_submenu.png"><ul style="list-style-type:none; margin-left:-29px;">';

	}

	if($totalRows_progs_cursos > 0){
		
		do { 
                  
           		 $response .=  '<li style="padding:3px 15px 3px 0px;"><a href=# onclick=parent.location="http://www.diplomados.uia.mx/programas.php?id_discipline='.$disciplina.'&id_program='.$row_progs_cursos['id_program'].'">'.utf8_encode($row_progs_cursos['program_name']);

	             if($row_progs_cursos['program_new']==1){

	             	$response .= '<span class="contenido_diploRojo"> Nuevo </span> ';

	         	 }

         		$response .= '</a></li>';
                    
            }while ($row_progs_cursos = mysql_fetch_assoc($progs_cursos));
					
	} 

		if($totalRows_progs_cursos_2 > 0){
		
		do { 
                  
           		 $response .=  '<li style="padding:3px 15px 3px 0px;"><a href=# onclick=parent.location="http://www.diplomados.uia.mx/programas.php?id_discipline='.$disciplina.'&id_program='.$row_progs_cursos_2['id_program'].'">*'.utf8_encode($row_progs_cursos_2['program_name']);

	             if($row_progs_cursos_2['program_new']==1){

	             	$response .= '<span class="contenido_diploRojo"> Nuevo </span> ';

	         	 }

         		$response .= '</a></li>';
                    
            }while ($row_progs_cursos_2 = mysql_fetch_assoc($progs_cursos_2));
					
	} 

		if($totalRows_progs_cursos_3 > 0){
		
		do { 
                  
           		 $response .=  '<li style="padding:3px 15px 3px 0px;"><a href=# onclick=parent.location="http://www.diplomados.uia.mx/programas.php?id_discipline='.$disciplina.'&id_program='.$row_progs_cursos_3['id_program'].'">*'.utf8_encode($row_progs_cursos_3['program_name']);

	             if($row_progs_cursos_3['program_new']==1){

	             	$response .= '<span class="contenido_diploRojo"> Nuevo </span> ';

	         	 }

         		$response .= '</a></li>';
                    
            }while ($row_progs_cursos_3 = mysql_fetch_assoc($progs_cursos_3));
					$response .= '</ul>';
	} 

// PROGRAMAS HP

	if($totalRows_progs_hp > 0 && ($disciplina==9)){ 
		

$response .= '<p><img src="imagenes/linea_submenu.png"><p style="font-size:16px; font-weight:bold">Programas HP</p><p><img src="imagenes/linea_submenu.png"></p><ul style="list-style-type:none; margin-left:-29px;">';

	   /*do{
					
			
		 	if($row_progs_hp['program_new']==1){

		 		$response .= '<span class="contenido_diploRojo"> Nuevo </span> ';

		 	}else if($row_progs_hp['program_new']==2){

		 		$response .= '<span class="contenido_diploRojo"> Nueva versión </span> ';
		 	} 
		 	$response .= '</a></li>';

		}while ($row_progs_hp = mysql_fetch_assoc($progs_diplos_3)); 
	}*/
	$response .= "</ul>";

	if($totalRows_progs_hp > 0){ 
		$response .='<!--p class="header_programas">Programas</p!-->
					<ul class="lista_programas" style="padding:3px 0px">';
					do {
							$no_n = str_replace('ñ', 'n', $row_progs_progs['program_name']);
							$no_a = str_replace('á', 'a', $no_n);
							$no_e = str_replace('é', 'e', $no_a);
							$no_i = str_replace('í', 'i', $no_e);
							$no_o = str_replace('ó', 'o', $no_i);
							$no_u = str_replace('ú', 'u', $no_o);
							$titulo = str_replace(' ', '_', $no_u); 
							$response .= '<li style="padding:3px 15px 3px 0px;"><a href=# onclick=parent.location="http://www.diplomados.uia.mx/programas.php?id_discipline='.$disciplina.'&amp;id_program='.$row_progs_hp['id_program'].'&titulo='.$titulo.'">'.utf8_encode($row_progs_hp['program_name']);

						 	if($row_progs_hp['program_new']==1){

						 		$response .= '<span class="contenido_diploRojo"> Nuevo </span> ';

						 	}else if($row_progs_hp['program_new']==2){

						 		$response .= '<span class="contenido_diploRojo"> Nueva versión </span> ';
							 }
							$response .= '</a></li>';
					} while ($row_progs_hp = mysql_fetch_assoc($progs_hp)); 

					$response .= '</ul>';
	}
}

// IDIOMAS

	if($totalRows_progs_cursos_i > 0){ 


	   do{
					
			
		 	if($row_progs_cursos_i['program_new']==1){

		 		$response .= '<span class="contenido_diploRojo"> Nuevo </span> ';

		 	}else if($row_progs_cursos_i['program_new']==2){

		 		$response .= '<span class="contenido_diploRojo"> Nueva versión </span> ';
		 	} 
		 	$response .= '</a></li>';

		}while ($row_progs_cursos_i = mysql_fetch_assoc($progs_diplos_3)); 
	}
	$response .= "</ul>";

	if($totalRows_progs_cursos_i > 0){ 
		$response .='<!--p class="header_programas">Programas</p!-->
					<ul class="lista_programas" style="padding:3px 6px">';
					do {
							$no_n = str_replace('ñ', 'n', $row_progs_progs['program_name']);
							$no_a = str_replace('á', 'a', $no_n);
							$no_e = str_replace('é', 'e', $no_a);
							$no_i = str_replace('í', 'i', $no_e);
							$no_o = str_replace('ó', 'o', $no_i);
							$no_u = str_replace('ú', 'u', $no_o);
							$titulo = str_replace(' ', '_', $no_u); 
							$response .= '<li style="padding:3px 15px 3px 0px;"><a href=# onclick=parent.location="http://www.diplomados.uia.mx/programas.php?id_discipline='.$disciplina.'&amp;id_program='.$row_progs_cursos_i['id_program'].'&titulo='.$titulo.'">'.utf8_encode($row_progs_cursos_i['program_name']);
             

						 	if($row_progs_cursos_i['program_new']==1){

						 		$response .= '<span class="contenido_diploRojo"> Nuevo </span> ';

						 	}else if($row_progs_cursos_i['program_new']==2){

						 		$response .= '<span class="contenido_diploRojo"> Nueva versión </span> ';
							 }
							$response .= '</a></li>';
					} while ($row_progs_cursos_i = mysql_fetch_assoc($progs_cursos_i)); 

					$response .= '</ul>';
	} 

echo $response;

?>