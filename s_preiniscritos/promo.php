<?php
  require_once('restrict_access.php'); ?>
  <?php require_once('Connections/des_preinscritos.php'); ?>
  <?php
  if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
      if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
      }

      $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

      switch ($theType) {
        case "text":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;    
        case "long":
        case "int":
        $theValue = ($theValue != "") ? intval($theValue) : "NULL";
        break;
        case "double":
        $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
        break;
        case "date":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
        case "defined":
        $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
        break;
      }
      return $theValue;
    }
  }

  $currentPage = $_SERVER["PHP_SELF"];

  //query para obtener las areas a las que puede acceder el usuario logeado
  mysql_select_db($database_des_preinscritos, $des_preinscritos);

  $query_disciplinas = "SELECT id_discipline FROM ss_users_disciplines WHERE id_user = ".$_SESSION['loggedin_id_user'];
  //$query_disciplinas = "SELECT id_discipline FROM ss_users_disciplines WHERE id_user = ".$_SESSION['id_user'];
  $disciplinas = mysql_query($query_disciplinas, $des_preinscritos) or die(mysql_error());
  $row_disciplinas = mysql_fetch_assoc($disciplinas);


  mysql_select_db($database_des_preinscritos, $des_preinscritos);

  
if(!isset($_GET['id_discipline']) || $_GET['id_discipline'] == 0){
    
    $query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE cancelado = 0 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE fecha >= '2012-12-06' AND periodo = 'p') AND (";

     do{
      $query_programas .= ' id_discipline = '.$row_disciplinas['id_discipline'].' OR';
    }while($row_disciplinas = mysql_fetch_assoc($disciplinas));
    mysql_data_seek($disciplinas,0);
    $row_disciplinas = mysql_fetch_assoc($disciplinas);

    $query_programas = substr($query_programas, 0, -2); 
    $query_programas .= ") ORDER BY program_type DESC, program_name ASC";

//echo $query_programas;
$programas = mysql_query($query_programas, $des_preinscritos) or die(mysql_error());
$row_programas = mysql_fetch_assoc($programas); } 


$maxRows_preinscritos = 20;
$pageNum_preinscritos = 0;
if (isset($_GET['pageNum_preinscritos'])) {
  $pageNum_preinscritos = $_GET['pageNum_preinscritos'];
}
$startRow_preinscritos = $pageNum_preinscritos * $maxRows_preinscritos;


  //query para obtener el total de preinscritos
mysql_select_db($database_des_preinscritos, $des_preinscritos);
$query_preinscritos = "SELECT * FROM site_promos ORDER BY id_promo DESC";
$preinscritos_total = mysql_query($query_preinscritos);
$query_limit_preinscritos = sprintf("%s LIMIT %d, %d", $query_preinscritos, $startRow_preinscritos, $maxRows_preinscritos);
$preinscritos = mysql_query($query_limit_preinscritos, $des_preinscritos) or die(mysql_error());
$row_preinscritos = mysql_fetch_assoc($preinscritos);
$num_rows_promo = mysql_num_rows($preinscritos_total);

if (isset($_GET['totalRows_preinscritos'])) {
  $totalRows_preinscritos = $_GET['totalRows_preinscritos'];
} else {
  $all_preinscritos = mysql_query($query_preinscritos);
  $totalRows_preinscritos = mysql_num_rows($all_preinscritos);
}
$totalPages_preinscritos = ceil($totalRows_preinscritos/$maxRows_preinscritos)-1;

$queryString_preinscritos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_preinscritos") == false && 
      stristr($param, "totalRows_preinscritos") == false) {
      array_push($newParams, $param);
  }
}
if (count($newParams) != 0) {
  $queryString_preinscritos = "&" . htmlentities(implode("&", $newParams));
}
}
$queryString_preinscritos = sprintf("&totalRows_preinscritos=%d%s", $totalRows_preinscritos, $queryString_preinscritos);


//Con este script se resetea el filtro de las búsquedas
if(isset($_GET['limpiar']) || $_GET['limpiar'] == "Quitar filtro"){
  echo '<script>window.location="preinscritos.php";</script>';
}

  //CODIGO PARA QUE ASIGNE FORMATO LOCAL A LAS FECHAS
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
  //++++++++++++++++++++
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Sistema de Seguimiento - Preinscritos</title>
  <!-- InstanceEndEditable -->
  <link href="estilos.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="colorbox/colorbox.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="colorbox/jquery.colorbox.js"></script>
  <script>
  function confirmar(){
    return confirm('¿Está seguro/a que desea eliminar este registro? Todos los registros asociados con esta clave de promoción se eliminarán.');
  }
  $(document).ready(function(){
    //Examples of how to assign the ColorBox event to elements
    $(".group1").colorbox({iframe:true, width:"850px", height:"90%"});
  });

  function load_programs(id_discipline)
  {
    //alert(id_discipline);
    $('td#td_programas').html('Cargando...');
    if (id_discipline=="")
    {
      document.getElementById('td_programas').innerHTML="";
      return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange=function()
    {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
      //document.getElementById(div).innerHTML=xmlhttp.responseText;
    //alert(xmlhttp.responseText);
    $('td#td_programas').html(xmlhttp.responseText);    
    
  }
}
xmlhttp.open("GET",'ajax_programas.php?id_discipline='+id_discipline,true);
xmlhttp.send();
}
</script>
<script>
 function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
</script>
<!-- InstanceBeginEditable name="head" -->
<script>
function simple_tooltip(target_items, name){
 $(target_items).each(function(i){
  $("body").append("<div class='"+name+"' id='"+name+i+"'><p>"+$(this).attr('title')+"</p></div>");
  var my_tooltip = $("#"+name+i);

  $(this).removeAttr("title").mouseover(function(){
    my_tooltip.css({opacity:1.0, display:"none"}).fadeIn(400);
  }).mousemove(function(kmouse){
    my_tooltip.css({left:kmouse.pageX+10, top:kmouse.pageY+10});
  }).mouseout(function(){
    my_tooltip.fadeOut(200);
  });
});
}
$(document).ready(function() {

 simple_tooltip("a.tooltip_a","tooltip");

});
</script>
<style>
.tooltip{
  position:absolute;
  z-index:999;
  left:-9999px;
  background-color:#dedede;
  padding:2px;
  border:1px solid #fff;
  border-radius:5px;
  width:200px;
}

.tooltip p{
  margin:0;
  padding:0;
  color:#fff;
  background-color:#F00;
  padding:5px;
  border-radius:5px;
}
</style>
<!-- InstanceEndEditable -->
</head>

<body>
  <div id="container">
    <div id="header">
      <div id="logos">
        <div style="float:left;"><a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" /></a> <a href="preinscritos.php"><img src="imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
        <div style="float:left; margin:10px;" >
          <h1>Sistema de seguimiento de preinscripciones</h1>
          <h2>Administrador | <a href="logout.php">Cerrar sesi&oacute;n</a></h2>
        </div>
        <div id="home_link">
          <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="get" name="form2" id="form2">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td valign="top" align="right">
                   <!-- comienza select de áreas -->
                   <label>Área:
                    <select onchange="load_programs(this.value);" id="id_discipline" name="id_discipline" class="contenido_diplo">
                     <option value="0" selected="selected">Todas mis &aacute;reas</option>
                     <? do{ 
                //query para obtener las areas a las que puede acceder el usuario logeado
                       mysql_select_db($database_des_preinscritos, $des_preinscritos);
                       $query_areas_select = "SELECT discipline FROM disciplines WHERE id_discipline = ".$row_disciplinas['id_discipline'];
                       $areas_select = mysql_query($query_areas_select, $des_preinscritos) or die(mysql_error());
                       $row_areas_select = mysql_fetch_assoc($areas_select);
                       ?>
                       <option value="<? echo $row_disciplinas['id_discipline']; ?>" <? if($row_disciplinas['id_discipline'] == $_GET['id_discipline']){ echo 'selected="selected"'; }?>><? echo utf8_encode($row_areas_select['discipline']); ?></option>
                       <? }while($row_disciplinas = mysql_fetch_assoc($disciplinas)); 
                            $row_disciplinas = mysql_fetch_assoc($disciplinas);?>
                     </select>
                   </label>
                   <!-- termina select de areas -->
                 </td>
               </tr>
               <tr>
                <!-- TD para desplegar el resultado del AJAX -->
                <td valign="top" align="right" id="td_programas">

<?php if(isset($_GET['id_discipline']) && $_GET['id_discipline'] != 0){ ?>
    
    <script>
    var option=getUrlVars()["id_discipline"];
    load_programs(option);
    </script>

  <?php }else{
?>
  

                  <select id="id_program" name="id_program" class="contenido_diplo" style="max-width:350px; width:350px;">
                    <option value="0">Todos los programas</option>
                    <option disabled="disabled">-------DIPLOMADOS-------</option>
                    <? 
                    $tipo_ant = 'diplomado';
                    do{
                      $tipo = $row_programas['program_type'];
                      if($tipo != $tipo_ant){echo '<option disabled="disabled">-----CURSOS---</option>';}
                      echo '<option value="'.$row_programas['id_program'].'"';
                      if($row_programas['id_program'] == $_GET['id_program']){echo ' selected="selected"';}
                      echo '>'.utf8_encode($row_programas['program_name']).'</option>';
                      $tipo_ant = $tipo;
                    } while($row_programas = mysql_fetch_assoc($programas)); ?>
                  </select><?php  } ?>
                </td>
                <!-- finaliza TD -->
              </tr>
              <tr>
               <td valign="top" align="right">
                <input type="submit" name="filtrar" id="filtrar" value="Filtrar" />
                <input type="submit" name="limpiar" id="limpiar" value="Quitar filtro" />
              </td>
             </tr>
           </tbody>
         </table>
       </form>
     </div>
   </div>
   <div class="espacio"> </div>
 </div>
 <div class="sombra"> </div>

 <div id="menu">
   <div id="menu_int">
    <ul>
      <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/preinscritos.php'){ ?><span style="color:#F00;">Preinscritos</span><? }else{ ?><a href="preinscritos.php?<? echo $_SERVER['QUERY_STRING']?>">Preinscritos</a><? } ?></li>
      <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/inscritos.php'){ ?><span style="color:#F00;">Inscritos</span><? }else{ ?><a href="inscritos.php?<? echo $_SERVER['QUERY_STRING']?>">Inscritos</a><? } ?></li>
      <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/casos_cerrados.php'){ ?><span style="color:#F00;">Casos cerrados</span>
       <? }else{ ?><a href="casos_cerrados.php?<? echo $_SERVER['QUERY_STRING']?>">Casos cerrados</a><? } ?></li>
       <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/casos_inconclusos.php'){ ?><span style="color:#F00;">Casos inconclusos</span>
         <? }else{ ?><a href="casos_inconclusos.php?<? echo $_SERVER['QUERY_STRING']?>">Casos inconclusos</a><? } ?></li>
         <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/informes.php'){ ?><span style="color:#F00;">Informes</span>
           <? }else{ ?><a href="informes.php?<? echo $_SERVER['QUERY_STRING']?>">Informes</a><? } ?></li>
           <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/promo.php'){ ?><span style="color:#F00;">Promociones</span>
       <? }else{ ?><a href="promo.php?<? echo $_SERVER['QUERY_STRING']?>">Promociones</a><? } ?></li>
         </ul>
       </div>
       <div id="buscador">
        <form name="buscador" id="buscador" action="resultados_busqueda.php" method="get">
         <a href="graficas/graficas_area_programa.php">Gr&aacute;ficas</a>
         <a href="export_to_xls.php">Exportar a Excel</a>
         <input name="qs" type="text" id="qs" placeholder="Todas las &aacute;reas" value="" size="20" />
         <input type="submit" name="enviar" id="enviar" value="Buscar">
       </form>
     </div>
   </div>
   <div class="sombra"> </div>
   <div class="espacio"></div>

   <!-- InstanceBeginEditable name="contenido" -->
   <?php if(mysql_num_rows($preinscritos) == 0){ ?>
      <div style="color:red;font-size:24px;line-height:26px;">No se han encontrado resultados</div>
   <?php }else{ ?>
   <h3>
    <? /*
    if(isset($_GET['id_discipline']) && $_GET['id_discipline'] != 0){
     mysql_select_db($database_des_preinscritos, $des_preinscritos);
     $query_disc_temp = "SELECT discipline FROM disciplines WHERE id_discipline = ".$_GET['id_discipline'];
     $disc_temp = mysql_query($query_disc_temp, $des_preinscritos) or die(mysql_error());
     $row_disc_temp = mysql_fetch_assoc($disc_temp);
     echo utf8_encode(ucfirst(strtolower($row_disc_temp['discipline'])));
   }else{
     echo 'Todas mis áreas';
   } */
   ?> 
   
   <? /*
   if(isset($_GET['id_program']) && $_GET['id_program'] != 0){
     mysql_select_db($database_des_preinscritos, $des_preinscritos);
     $query_prog_temp = "SELECT program_name, program_type FROM site_programs WHERE id_program = ".$_GET['id_program'];
     $prog_temp = mysql_query($query_prog_temp, $des_preinscritos) or die(mysql_error());
     $row_prog_temp = mysql_fetch_assoc($prog_temp);
     echo utf8_encode(ucfirst(strtolower($row_prog_temp['program_type'].' en '.$row_prog_temp['program_name'])));
   }else{
     echo 'Todos mis programas';
   } */
   ?> 
   
   <? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/preinscritos.php'){ ?>
   Preinscritos
   <? }else if($_SERVER['PHP_SELF'] == '/s_preiniscritos/inscritos.php'){ ?>
   Inscritos
   <? }else if($_SERVER['PHP_SELF'] == '/s_preiniscritos/casos_cerrados.php'){ ?>
   Casos cerrados
   <? }else if($_SERVER['PHP_SELF'] == '/s_preiniscritos/casos_inconclusos.php'){ ?>
   Casos inconclusos
   <? }else if($_SERVER['PHP_SELF'] == '/s_preiniscritos/informes.php'){ ?>
   Informes
   <? } ?>

 </h3>
 <div class="espacio"></div>
 <table width="100%" border="0">
 <tr>
  <td align="right" valign="middle"><strong>
   Registros <?php echo ($startRow_preinscritos + 1) ?> al <?php echo min($startRow_preinscritos + $maxRows_preinscritos, $num_rows_promo) ?> de <?php echo $num_rows_promo ?>
 </strong></td>
 <td align="right" valign="middle"><?php if ($pageNum_preinscritos > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, 0, $queryString_preinscritos); ?>"><img src="First.gif" border="0" /></a>
  <?php } // Show if not first page ?></td>
  <td align="right" valign="middle"><?php if ($pageNum_preinscritos > 0) { // Show if not first page ?>
    <a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, max(0, $pageNum_preinscritos - 1), $queryString_preinscritos); ?>"><img src="Previous.gif" border="0" /></a>
    <?php } // Show if not first page ?></td>
    <td align="right" valign="middle"><?php if ($pageNum_preinscritos < $totalPages_preinscritos) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, min($totalPages_preinscritos, $pageNum_preinscritos + 1), $queryString_preinscritos); ?>"><img src="Next.gif" border="0" /></a>
      <?php } // Show if not last page ?></td>
      <td align="right" valign="middle"><?php if ($pageNum_preinscritos < $totalPages_preinscritos) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, $totalPages_preinscritos, $queryString_preinscritos); ?>"><img src="Last.gif" border="0" /></a>
        <?php } // Show if not last page ?></td>
      </tr>
    </table>
 <table width="960" border="0" cellpadding="5" cellspacing="0" class="tablas">
  <tr class="titulo_tabla">
    <td width="70">Nombre</td>
    <td width="70">Fecha de registro</td>
    <td width="70">Código de promoción</td>
    <td width="110">Correo Electr&oacute;nico</td>
    <td width="70">Responsable de invitaci&oacute;n</td>
    <td width="70">&nbsp;</td>
  </tr>
  <?php 

  $cont = 0;

  do{ 
    
      
      if($cont % 2){$bg='bgcolor="#F1F1F1"';}else{$bg = '';}
      ?>

      <tr <? echo $bg; ?>>
      <td align="left" valign="middle" class="celdas">
      <strong>
      <? if($row_paso['comentario_general'] != ''){
      echo '<a href="#" title="'.utf8_encode(ucfirst(strtolower($row_paso['comentario_general']))).'" class="tooltip_a"><img src="imagenes/informacion.png"/></a> ';
      } ?>
      <!--a class="group1" href="preinscrito_detalle.php?id_preinscrito=<?php echo $row_preinscritos['id_preinscrito']; ?>"-->
      <?php echo utf8_encode(ucfirst(strtolower($row_preinscritos['a_paterno']))).', '.utf8_encode(ucwords(strtolower($row_preinscritos['nombre']))); ?>
      <!--/a-->
      </strong>
      </td>
      <td align="center" valign="middle" class="celdas"><? echo strftime("%d %B %Y", strtotime($row_preinscritos['timestamp'])); ?></td>
      <td align="center" valign="middle" class="celdas"><? if($row_preinscritos['codigo'] != NULL && $row_preinscritos['codigo'] != "NO_PROMO" ){echo $row_preinscritos['codigo'];} ?></td>
      <td align="center" valign="middle" class="celdas"><? echo $row_preinscritos['mail']; ?></td>
      <td align="center" valign="middle" class="celdas"><? if($row_preinscritos['tipo'] == 1){echo 'S&iacute;';}?></td>

      <td align="center" valign="middle" class="celdas">
      <form method="post" action="delete_promo.php" onsubmit="return confirmar();">
      <input type="submit" name="delete_" id="delete_" value="Eliminar" />
      <input type="hidden" name="id_promo" value="<?php echo $row_preinscritos['codigo']; ?>" />
      <input type="hidden" name="url" value="<? echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>" />
      </form>
      </td>
      </tr>
      <?php 

      $cont++;

    } while ($row_preinscritos = mysql_fetch_assoc($preinscritos)); ?>

</table>
<div class="espacio"> </div>
<table width="100%" border="0">
 <tr>
  <td align="right" valign="middle"><strong>
   Registros <?php echo ($startRow_preinscritos + 1) ?> al <?php echo min($startRow_preinscritos + $maxRows_preinscritos, $num_rows_promo) ?> de <?php echo $num_rows_promo ?>
 </strong></td>
 <td align="right" valign="middle"><?php if ($pageNum_preinscritos > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, 0, $queryString_preinscritos); ?>"><img src="First.gif" border="0" /></a>
  <?php } // Show if not first page ?></td>
  <td align="right" valign="middle"><?php if ($pageNum_preinscritos > 0) { // Show if not first page ?>
    <a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, max(0, $pageNum_preinscritos - 1), $queryString_preinscritos); ?>"><img src="Previous.gif" border="0" /></a>
    <?php } // Show if not first page ?></td>
    <td align="right" valign="middle"><?php if ($pageNum_preinscritos < $totalPages_preinscritos) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, min($totalPages_preinscritos, $pageNum_preinscritos + 1), $queryString_preinscritos); ?>"><img src="Next.gif" border="0" /></a>
      <?php } // Show if not last page ?></td>
      <td align="right" valign="middle"><?php if ($pageNum_preinscritos < $totalPages_preinscritos) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_preinscritos=%d%s", $currentPage, $totalPages_preinscritos, $queryString_preinscritos); ?>"><img src="Last.gif" border="0" /></a>
        <?php } // Show if not last page ?></td>
      </tr>
    </table>
    <!-- InstanceEndEditable -->
  </div>
  <?php } ?>
<div class="espacio"> </div>
<div class="espacio"> </div>
<div class="espacio"> </div>
<div class="espacio"> </div>
<div class="espacio"> </div>
<div class="espacio"> </div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($preinscritos);
?>
