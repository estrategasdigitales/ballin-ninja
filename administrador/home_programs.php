<?php require_once('../Connections/otono2011.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/temp_admin.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1"
        />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Educaci&oacute;n Continua</title>
<!-- InstanceEndEditable -->
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
 <style>

 	.contenedor_programas{
 		width:200px;
 		float:left;
 		margin: 4px 0px 50px 0px;
 		clear:both;
 	}

 
 	.contenedor_programas a{
 		font-size:20px;
 		color:#000;
 	}

	.contenedor_inputs{
 		width:500px;
 		margin-top:-36px;
 		clear:both;
 		float:left;
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

$(document).ready(function() {
    $("#input_enviar").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
});

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
    <a href="index.php"><img width="20px" height="20px" src="imagenes/home.png" style="float:left; clear:both; margin-left: 206px; margin-top:-13px;"></img></a>
    <div class="bannersuperior2" style="margin-left: 4px"></div>

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
          </ul>
          <p>&nbsp;</p>
          <h2>Carrusel Index</h2>
          <ul>
            <li><a href="admin_carrusel_home.php">Banners</a></li>
          </ul>
          <p>&nbsp;</p>
          <h2>Art&iacute;culos</h2>
          <ul>
            <li><a href="admin_discipline_articles.php?id_discipline=1">Disciplinas</a> </li>
            <li><a href="admin_opinions.php">La Comunidad Ibero Opina</a> </li>            
            <li><a href="admin_weekly_articles.php">Art&iacute;culos semanales</a> </li>
            <li><a href="admin_media_articles.php">La DEC en los Medios</a> </li>
          </ul>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
  <div id="contenedor_irregular_index" style="width:800px;"><!-- InstanceBeginEditable name="contenido" -->

  	<div class="contenedor_programas">

  	 	<a href="programas_nuevo.php">&rsaquo;&nbsp;Nuevo programa</a>

  	</div>

  	<div class="contenedor_programas">

  	 	<a href="#">&rsaquo;&nbsp;Editar programa</a>

  	</div>

  	<div class="contenedor_inputs">
  		<form id="enviar" action="programa_id.php">
  	 		<input class="inputs" id="input_enviar" name="id_program" placeholder="Ingrese ID del programa" type="text" value="Ingrese ID del programa" size="30"/> 
  	 		<input type="submit" class="botones" value="Enviar"/>
  	 		<p id="empty_prog">Introduce el id del programa</p>
  	 	</form>
  	 	<form id="buscar" action="program_name.php">
  	 		<input class="inputs" id="input_buscar" name="name_program" placeholder="Nombre del programa" type="text" value="Nombre del programa" size="30"/>
  	 		<input type="submit" class="botones" value="Buscar"/>
  	 		<p id="empty_nom_prog">Introduce el nombre del programa</p>
  	 	</form>
  	</div>
<!--
 <h1> Programas </h1>
<table  border="0" cellpadding="5" cellspacing="0" class="tablas">
	<tr class="titulo_tabla">
		<td>Programa</td>
		<td>Disciplina</td>
		<td>Disciplina alterna</td>
		<td>Tipo</td>
		<td>Nuevo</td>
		<td>Cancelado</td>
		<td colspan="2">
        <input type="button" value="Nuevo Programa" onclick="javascript:window.location='programas_nuevo.php'">
        </td>
	  </tr>
	<?php do { ?>
		<tr>
			<td><a href="programas_editar.php?id_program=<?php echo $row_programas['id_program']; ?>"><?php echo $row_programas['program_name']; ?></a></td>
			<td><?php echo $row_programas['id_discipline']; ?></td>
			<td><?php echo $row_programas['id_discipline_alterna']; ?></td>
			<td><?php echo $row_programas['program_type']; ?></td>
			<td><?php echo $row_programas['program_new']; ?></td>
			<td><?php echo $row_programas['cancelado']; ?></td>
			<td><a href="programas_editar.php?id_program=<?php echo $row_programas['id_program']; ?>">Editar</a></td>
			<td><a href="programas_eliminar.php?id_program=<?php echo $row_programas['id_program']; ?>">Eliminar</a></td>
		</tr>
		<?php } while ($row_programas = mysql_fetch_assoc($programas)); ?>
</table>
<table border="0" align="center">
	<tr>
		<td><?php if ($pageNum_programas > 0) { // Show if not first page ?>
				<a href="<?php printf("%s?pageNum_programas=%d%s", $currentPage, 0, $queryString_programas); ?>"><img src="First.gif" border="0" /></a>
		<?php } // Show if not first page ?></td>
		<td><?php if ($pageNum_programas > 0) { // Show if not first page ?>
				<a href="<?php printf("%s?pageNum_programas=%d%s", $currentPage, max(0, $pageNum_programas - 1), $queryString_programas); ?>"><img src="Previous.gif" border="0" /></a>
		<?php } // Show if not first page ?></td>
		<td><?php if ($pageNum_programas < $totalPages_programas) { // Show if not last page ?>
				<a href="<?php printf("%s?pageNum_programas=%d%s", $currentPage, min($totalPages_programas, $pageNum_programas + 1), $queryString_programas); ?>"><img src="Next.gif" border="0" /></a>
		<?php } // Show if not last page ?></td>
		<td><?php if ($pageNum_programas < $totalPages_programas) { // Show if not last page ?>
				<a href="<?php printf("%s?pageNum_programas=%d%s", $currentPage, $totalPages_programas, $queryString_programas); ?>"><img src="Last.gif" border="0" /></a>
		<?php } // Show if not last page ?></td>
	</tr>
</table> -->
<!-- InstanceEndEditable --></div>
  <div id="separador" style=" clear:both; height:20px;"></div>
  
</div>
</body>
<!-- InstanceEnd --></html>