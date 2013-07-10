<?php 
require_once('../Connections/otono2011.php');

mysql_select_db($database_otono2011, $otono2011);
$query_programa = "SELECT * FROM site_programs ORDER BY program_name ASC";
$programa = mysql_query($query_programa, $otono2011) or die(mysql_error());
$row_programa = mysql_fetch_assoc($programa);
$totalRows_programa = mysql_num_rows($programa);


if((isset($_POST['MM_insert'])) && ($_POST['MM_insert'] == 'form1')){

  include('SimpleImage.php');

  $insertSQL = sprintf("INSERT INTO site_galeria_programa(id_programa, publicado) VALUES ('%s', '%s')",
                      mysql_real_escape_string($_POST['id_program']),
                      mysql_real_escape_string($_POST['publicado']));

  mysql_select_db($database_otono2011, $otono2011);
  $Result1 = mysql_query($insertSQL, $otono2011) or die(mysql_error());

$query_programa_galeria = "SELECT MAX(id_galeria_programa) AS ultima_galeria FROM site_galeria_programa";
$programa_galeria = mysql_query($query_programa_galeria, $otono2011) or die(mysql_error());
$row_programa_galeria = mysql_fetch_assoc($programa_galeria);
$totalRows_programa_galeria = mysql_num_rows($programa_galeria);

          $IMAGE_FILE = $_FILES['imagen_0']['tmp_name'];
          $IMAGE_FILE_NAME = $_FILES['imagen_0']['name'];
          
          if($IMAGE_FILE != NULL){
              $photosDir="../imagenes/galerias_programas/programa_".$row_programa_galeria['ultima_galeria'];
              $img_filename = str_replace(" ","_",$IMAGE_FILE_NAME);
              $photo = new SimpleImage();
              $photo->load($IMAGE_FILE);
              $photo->save($photosDir."/".$img_filename);

              $insertSQL2 = sprintf("INSERT INTO site_archivo_galeria(id_galeria_programa, archivo) VALUES ('%s', '%s')",
                      mysql_real_escape_string($row_programa_galeria['ultima_galeria']),
                      mysql_real_escape_string($IMAGE_FILE_NAME));
          }

  if($_POST['cont'] > 0){

      for($i=0; $i<=$_POST['cont']; $i++){

          $IMAGE_FILE = $_FILES['imagen_'.$i.'']['tmp_name'];
          $IMAGE_FILE_NAME = $_FILES['imagen_'.$i.'']['name'];
          
          if($IMAGE_FILE != NULL){
              $photosDir="../imagenes/galerias_programas/programa_".$row_programa_galeria['ultima_galeria'];
              $img_filename = str_replace(" ","_",$IMAGE_FILE_NAME);
              $photo = new SimpleImage();
              $photo->load($IMAGE_FILE);
              $photo->save($photosDir."/".$img_filename);

              $insertSQL2 = sprintf("INSERT INTO site_archivo_galeria(id_galeria_programa, archivo) VALUES ('%s', '%s')",
                      mysql_real_escape_string($row_programa_galeria['ultima_galeria']),
                      mysql_real_escape_string($IMAGE_FILE_NAME));

          }

      }

  }

/*
  $insertSQL2 = sprintf("INSERT INTO site_archivo_galeria(id_galeria_programa, archivo) VALUES ('%s', '%s')",
                      mysql_real_escape_string($row_programa_galeria['ultima_galeria']),
                      mysql_real_escape_string($_POST['publicado']));

  mysql_select_db($database_otono2011, $otono2011);
  $Result2 = mysql_query($insertSQL, $otono2011) or die(mysql_error());

*/
  header('Location: galeria_progr_home.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-88859-1" />
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<title>Administrador Carrusel - Nueva Imagen</title>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function(){

CKEDITOR.replace( 'texto' );
})
</script>
</head>

<!--body>




</body--><body>
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
            <h1>Nueva Galer&iacute;a </h1>
            <form action="galeria_programas_nuevo.php" onsubmit="return checkFields();" method="post" name="form1" id="form1" enctype="multipart/form-data">
<table align="center" width="70%">
  <tr>
    <td><br>
  <table border="0" align="center" cellpadding="5" cellspacing="0" width="40%">
       <tr>
            <td colspan="3" align="center" class="titulo_interno"><strong>Nueva Imagen Carrusel Home</strong></td>
       </tr>
          <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>Programa:</strong></td>
      <td colspan="2">
        <select name="id_program" id="id_program">
          <?php
          do {  
          ?>
          <option value="<?php echo $row_programa['id_program']?>"><?php echo $row_programa['program_name']?></option>
          <?php
          } while ($row_programa = mysql_fetch_assoc($programa));
            $rows = mysql_num_rows($programa);
            if($rows > 0) {
              mysql_data_seek($programa, 0);
              $row_programa = mysql_fetch_assoc($programa);
            }
          ?>
        </select>
      </td>
    </tr>
       <tr id="inputs_imagenes">
           <td width="35%"><strong>* Im&aacute;genes Galer&iacute;a:</strong></td>
             <td><input type="file" name="imagen_0" id="imagen"/></td>
             <td><input type="button" id="add_inputs" value="Agregar m&aacute;s im&aacute;genes"></td>
       </tr>
          <td colspan="2" align="center"><input type="button" value="Regresar" onclick="javascript:window.location='galeria_progr_home.php'" />&nbsp;&nbsp;&nbsp;
          <input type="submit" value="Insertar" /></td>
       </tr>
    </table>
    <br>
  </td></tr>
</table>
  <input type="hidden" name="MM_insert" value="form1" />
  <input type="hidden" name="publicado" value="0" />
  <input type="hidden" name="cont" value="0"/>
</form>
<p>&nbsp;</p>
<!-- InstanceEndEditable --></div>
  <div id="separador" style="clear:both; height:20px;"></div>
  
</div>
</body>
<script>
var cont = 0;
$('#add_inputs').on('click', function(){
  cont++;
  $('input[name="cont"]').val(cont);
  $('tr#inputs_imagenes').after($('<tr>').append($('<td>')).append($('<td>').append($('<input>').attr({'type':'file', 'name':'imagen_'+cont}))))
})

function checkFields(){

  
if($('input#imagen').val() == ""){
  alert('El campo imagen es obligatorio')
  return false
  }
else if($('input[name="destino"]').val() == ""){
  alert('El campo destino es obligatorio')
  return false
  }
  return true
}
</script>
</html>