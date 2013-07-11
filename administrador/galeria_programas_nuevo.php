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

$query_programa_galeria = "SELECT id_galeria_programa AS ultima_galeria FROM site_galeria_programa ORDER BY id_galeria_programa DESC LIMIT 0,1";
$programa_galeria = mysql_query($query_programa_galeria, $otono2011) or die(mysql_error());
$row_programa_galeria = mysql_fetch_assoc($programa_galeria);
$totalRows_programa_galeria = mysql_num_rows($programa_galeria);
  

          $IMAGE_FILE = $_FILES['imagen_0']['tmp_name'];
          $IMAGE_FILE_NAME = $row_programa_galeria['ultima_galeria'].'_'.$_FILES['imagen_0']['name'];
          
          if($IMAGE_FILE != ""){
              $photosDir="../imagenes/galerias_programas/";
              $img_filename = str_replace(" ","_",$IMAGE_FILE_NAME);
              $photo = new SimpleImage();
              $photo->load($IMAGE_FILE);
              $photo->save($photosDir."/".$img_filename);


          function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad)
          { 
              $width = 550;
              $height = 800;
              $img=ImageCreateFromJpeg($img_original); 
              $img_width  = imagesx($img);
              $img_height = imagesy($img);
              $tlx = floor($img_width / 2) - floor ($img_nueva_anchura / 2);
              $tly = floor($img_height / 2) - floor($img_nueva_altura / 2);
              // Adjust crop size if the image is too small
              if ($tlx < 0)
              {
                $tlx = 0;
              }
              if ($tly < 0)
              {
                $tly = 0;
              }

              if (($img_width - $tlx) < $width)
              {
                $width = $img_width - $tlx;
              }
              if (($img_height - $tly) < $height)
              {
                $height = $img_height - $tly;
              }

              
              $thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura); 

              imagecopy($thumb,$img,0,0,$tlx,$tly,$img_nueva_anchura, $img_nueva_altura); 
              ImageJPEG($thumb,$img_nueva,$img_nueva_calidad);
              ImageDestroy($img);
          } 

         $tmp_name = $_FILES["archivos"]["tmp_name"];
                    $name = $_FILES["archivos"]["name"];
                    $tamano = $_FILES["archivos"]["size"];
                    $tipo = $_FILES["archivos"]["type"]; 
                    $categoria = $_POST["categoria"];
                    $mes = $_POST["mes"];                                                
                    $imagen1 = explode(".",$name);
                    $fecha = date("d_m_Y_"); 
                    $imagen2 = rand(0,9).rand(100,9999).rand(100,9999).".".$imagen1[3];   

        if (!((strpos($tipo, "gif") || strpos($tipo, "png")|| strpos($tipo, "jpeg")) && ($tamano < 10000000))) {
        echo '<table width="700px"><tr><td><p style="font-size:15px; color:red;"><strong>ERROR DE FORMATO O TAMA&Ntilde;O</strong></td><td><strong><a href="subirarchivos.php">REGRESAR</a></td></tr></table></strong></p></div></div>
        ';
        
        }else{                                                                    
                $destino="../imagenes/galerias_programas/";
                $dir_thumb = "thumbs/";                                                                    

                    if (!file_exists($destino.$dir_thumb)){
                        @mkdir ($destino.$dir_thumb, 0777) 
                        or die("No se ha podido crear el directorio ".$destino.$dir_thumb);
                    }                                                                    
                $destTHU= $destino.$dir_thumb;                                                                   
                
                if(move_uploaded_file($_FILES["archivos"]["tmp_name"],$destino.$fecha.$imagen2)){
               // redimensionar_jpeggrande($destino.$originales.$fecha.$imagen2, $destino.$fecha.$imagen2);
                redimensionar_jpeg($destino.$fecha.$IMAGE_FILE_NAME, $destTHU.$fecha.$imagen2, 350, 350, 100);


              $insertSQL2 = sprintf("INSERT INTO site_archivo_galeria(id_galeria_programa, archivo, archivo_thumb) VALUES ('%s', '%s', '%s')",
                      mysql_real_escape_string($row_programa_galeria['ultima_galeria']),
                      mysql_real_escape_string($fecha.$IMAGE_FILE_NAME),
                      mysql_real_escape_string($fecha.$imagen2));

                mysql_select_db($database_otono2011, $otono2011);
                $Result1 = mysql_query($insertSQL2, $otono2011) or die(mysql_error());
          }
        }

  if($_POST['cont'] > 0){

      for($i=1; $i<=$_POST['cont']; $i++){

          $IMAGE_FILE = $_FILES['imagen_'.$i.'']['tmp_name'];
          $IMAGE_FILE_NAME = $row_programa_galeria['ultima_galeria'].'_'.$_FILES['imagen_'.$i.'']['name'];
          
          if($IMAGE_FILE != NULL){
              $photosDir="../imagenes/galerias_programas/";
              $img_filename = str_replace(" ","_",$IMAGE_FILE_NAME);
              $photo = new SimpleImage();
              $photo->load($IMAGE_FILE);
              $photo->save($photosDir."/".$img_filename);

              $insertSQL2 = sprintf("INSERT INTO site_archivo_galeria(id_galeria_programa, archivo) VALUES ('%s', '%s')",
                      mysql_real_escape_string($row_programa_galeria['ultima_galeria']),
                      mysql_real_escape_string($IMAGE_FILE_NAME));

                mysql_select_db($database_otono2011, $otono2011);
                $Result1 = mysql_query($insertSQL2, $otono2011) or die(mysql_error());

          }

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
<!-- LLamada a menú de secciones-->
<?php include('menu_secciones.php'); ?>
<!-- Termina llamada a menú de secciones-->
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