<?php require_once('../Connections/otono2011.php');

$name = $_GET['name_program'];
mysql_select_db($database_otono2011, $otono2011);
      $query_programa = "SELECT program_name, id_program FROM site_programs WHERE program_name LIKE '%".$name."%' ORDER BY program_name ASC"; 
      $programa = mysql_query($query_programa, $otono2011) or die(mysql_error());
      $totalRows_programa = mysql_num_rows($programa);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"/>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educaci&oacute;n Continua</title>
<!-- InstanceEndEditable -->
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
 <style>

  .contenedor_programas_result{
    width:600px;
    float:left;
    margin: 30px 0px;
    clear:both;
  }

  .contenedor_programas{
    clear:both;
  }

  .contenedor_programas a{
    cursor: pointer;
    float:left;
    font-size:12px;
    color:#000;
    padding: 5px 0px 5px;
  }
 
  .contenedor_programas_result a{
    font-size:12px;
    color:#000;
  }

	.contenedor_inputs{
 		width:500px;
 		margin-top:-36px;
 		clear:both;
 		float:left;
 	} 	

  .programs_list{
    padding:20px 0px;
    float:left;
    clear:both;

  }

 	.contenedor_inputs a{
 		float:left;
 		font-size:15px;
 		color:#000;
 		padding: 5px 0px 5px 10px;
 	}

 	.inputs{
 		float:left;
 		font-size: 16px;
 		border: 1px solid #000;
 		clear:both;
 		margin:5px 0px;
 	}

 	.botones{
	    border:none;
	    background-color: #FFF;
	    float:left;
	    cursor:pointer;
	    margin:5px 0px;
}

	#empty_prog{
		display:none; 
		color:#F00; 
		float:left;
	}

	#empty_nom_prog{
		display:none; 
		color:#F00; 
		float:left;
	}

 </style>
 <script src="../Scripts/jquery.js"></script>
 <script>

 $(document).ready(function(){

  $('#input_enviar').focus(function(){

      if($('#input_enviar').val() == 'Ingrese ID del programa'){

          $('#input_enviar').val('');
      }
  })

  $('#input_enviar').focusout(function(){

      if($('#input_enviar').val() == ''){

        $('#input_enviar').val('Ingrese ID del programa');
     }

  })

  $('#input_buscar').focus(function(){

      if($('#input_buscar').val() == 'Nombre del programa'){

          $('#input_buscar').val('');
      }
  })

  $('#input_buscar').focusout(function(){

      if($('#input_buscar').val() == ''){

        $('#input_buscar').val('Nombre del programa');
     }

  })


 	$('form#enviar').submit(function(){

 		if($('#input_enviar').val() == "Ingrese ID del programa" || $('#input_enviar').val() == ""){

 			$('p#empty_prog').show().fadeOut(1000);//alert('Introduce el id de un programa');
 			return false;
 		}

 		return true;

 	})


 	$('form#buscar').submit(function(){

 		
 		if($('#input_buscar').val() == "Nombre del programa" || $('#input_buscar').val() == ""){

 			$('p#empty_nom_prog').show().fadeOut(1000);//alert('Introduce el id de un programa');
 			return false;
 		}

 		return true;

 	})


 })

 </script>

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="container">
  <div id="header">
    <div id="logos">
      <h1><a href="http://uia.mx/" target="_blank"><img src="../imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'"><img src="../imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></h1>
    </div>
    <h1 style="float:left; margin:15px; color:#666;"> Administrador de Contenidos</h1>
  </div>
  <div id="separador"></div>
  <div id="separador"></div>
  <div id="menu_generos_interior_index">
    <div class="roundedBox_interior_index" id="type1"> 
      <!-- esquinas -->
      <div class="corner topLeft"></div>
      <div class="corner topRight"></div>
      <div class="corner bottomLeft"></div>
      <div class="corner bottomRight"></div>
      <!-- esquinas -->
      <div id="menu_desplega_index">
        <div id="menu_areas">
          <h2>Programas</h2>
          <ul>
            <li><a href="programas_home.php">Programas</a> </li>
            <li><a href="fechas_home.php">Fechas</a> </li>
            <li><a href="fechas_idiom_home.php">Fechas Idiomas</a> </li>
            <li><a href="propuestas_progr_home.php">Propuestas Programas</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Carrusel Index</h2>
          <ul>
            <li><a href="admin_carrusel/index.php">Banners</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Art&iacute;culos</h2>
          <ul>
            <li><a href="admin_discipline_articles.php?id_discipline=1">Disciplinas</a> </li>
            <li><a href="admin_opinions.php">La Comunidad Ibero Opina</a> </li>            
            <li><a href="admin_weekly_articles.php">Art&iacute;culos semanales</a> </li>
            <!--li><a href="admin_media_articles.php">La DEC en los Medios</a> </li-->
          </ul>
          <p>&nbsp;</p>
          <h2>Sedes</h2>
          <ul>
            <li><a href="admin_sedes_home.php">Sedes</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Directorio</h2>
          <ul>
            <li><a href="admin_dir_dec.php">DEC</a></li>
            <li><a href="admin_dir_maestros.php">Maestros</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="contenedor_irregular_index" style="width:800px;"><!-- InstanceBeginEditable name="contenido" -->

  	<div class="contenedor_programas">

  	 	<h1>Resultado de b&uacute;squeda</h1>

  	</div>

    <div class="contenedor_programas_result">

      <?php 
      if($totalRows_programa > 0){
          while($row_programa = mysql_fetch_assoc($programa)){

            echo '<a class="programs_list" href="programas_editar.php?id_program='.$row_programa["id_program"].'">'.$row_programa['program_name'].'</a>';

          }
        }else{

          echo "No se encontraron coincidencias para tu b&uacute;squeda.";

        }

      ?>

    </div>
        <div class="contenedor_programas">

    <a onclick="javascript:history.back(-1);"><< Regresar</a>

  </div> 


<!-- InstanceEndEditable --></div>

  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>