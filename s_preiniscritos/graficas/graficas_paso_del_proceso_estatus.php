<?php require_once('../restrict_access.php'); ?>
<?php require_once('../Connections/des_preinscritos.php'); ?>
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

//mysql_select_db($database_des_preinscritos, $des_preinscritos);
if(isset($_GET['id_discipline']) && $_GET['id_discipline'] != 0){
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE cancelado = 0 AND id_discipline = ".$_GET['id_discipline']." AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') ORDER BY program_type DESC, program_name ASC";
	
}else{
	
	$query_programas = "SELECT id_program, program_type, program_name FROM site_programs WHERE cancelado = 0 AND id_program IN (SELECT id_program FROM site_fechas_ini WHERE periodo = 'o') AND (";
	
	do{
		$query_programas .= ' id_discipline = '.$row_disciplinas['id_discipline'].' OR';
	}while($row_disciplinas = mysql_fetch_assoc($disciplinas));
	mysql_data_seek($disciplinas,0);
	$row_disciplinas = mysql_fetch_assoc($disciplinas);
	
	$query_programas = substr($query_programas, 0, -2); 
	$query_programas .= ") ORDER BY program_type DESC, program_name ASC";
}
//echo $query_programas;
$programas = mysql_query($query_programas, $des_preinscritos) or die(mysql_error());
$row_programas = mysql_fetch_assoc($programas);

//CODIGO PARA QUE ASIGNE FORMATO LOCAL A LAS FECHAS
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
//++++++++++++++++++++

if(isset($_POST['fecha_ini']) && $_POST['fecha_ini'] != ''){
	//query para obtener las areas a las que puede acceder el usuario logeado
	//mysql_select_db($database_des_preinscritos, $des_preinscritos);
	if($_POST['id_discipline'] == 0 && $_POST['id_program'] == 0){
		
		$query = 1;
		
		$query_graficas = "
		SELECT *
		FROM sp_pasos_status
		WHERE id_preinscrito IN (SELECT id_preinscrito FROM sp_preinscritos WHERE sp_preinscritos.fecha_registro >= '".$_POST['fecha_ini']."' AND sp_preinscritos.fecha_registro <= '".$_POST['fecha_fin']."' AND (";		
		do{
			$query_graficas .= ' sp_preinscritos.id_discipline = '.$row_disciplinas['id_discipline'].' OR';
		}while($row_disciplinas = mysql_fetch_assoc($disciplinas));
		
		mysql_data_seek($disciplinas,0);
		$row_disciplinas = mysql_fetch_assoc($disciplinas);
		
		$query_graficas = substr($query_graficas, 0, -2);		
		
		$query_graficas .= ")) ORDER BY id_preinscrito ASC";
		
		//echo 'query 1: '. $query_graficas;
				
	}else if($_POST['id_discipline'] != 0 && $_POST['id_program'] == 0){
		
		$query = 2;
		
		$query_graficas = "
		SELECT *,
		(SELECT discipline FROM disciplines WHERE id_discipline = ".$_POST['id_discipline'].") AS disciplina
		FROM sp_pasos_status
		WHERE id_preinscrito IN (SELECT id_preinscrito FROM sp_preinscritos WHERE sp_preinscritos.fecha_registro >= '".$_POST['fecha_ini']."' AND sp_preinscritos.fecha_registro <= '".$_POST['fecha_fin']."' AND sp_preinscritos.id_discipline = ".$_POST['id_discipline'].")
		ORDER BY id_preinscrito ASC";
		
		//echo 'query 2: '. $query_graficas;
			
	}else if($_POST['id_discipline'] == 0 && $_POST['id_program'] != 0){
		
		$query = 3;
		
		$query_graficas = "
		SELECT *,
		(SELECT program_type FROM site_programs WHERE id_program = ".$_POST['id_program'].") AS program_type,
		(SELECT program_name FROM site_programs WHERE id_program = ".$_POST['id_program'].") AS programa
		FROM sp_pasos_status
		WHERE id_preinscrito IN (SELECT id_preinscrito FROM sp_preinscritos WHERE sp_preinscritos.fecha_registro >= '".$_POST['fecha_ini']."' AND sp_preinscritos.fecha_registro <= '".$_POST['fecha_fin']."' AND sp_preinscritos.id_program = ".$_POST['id_program'].")
		ORDER BY id_preinscrito ASC";
		
		//echo 'query 3: '. $query_graficas;
		
	}else if($_POST['id_discipline'] != 0 && $_POST['id_program'] != 0){
		
		$query = 4;
		
		$query_graficas = "
		SELECT *,
		(SELECT program_type FROM site_programs WHERE id_program = ".$_POST['id_program'].") AS program_type,
		(SELECT program_name FROM site_programs WHERE id_program = ".$_POST['id_program'].") AS programa,
		(SELECT discipline FROM disciplines WHERE id_discipline = ".$_POST['id_discipline'].") AS disciplina
		FROM sp_pasos_status
		WHERE id_preinscrito IN (SELECT id_preinscrito FROM sp_preinscritos WHERE sp_preinscritos.fecha_registro >= '".$_POST['fecha_ini']."' AND sp_preinscritos.fecha_registro <= '".$_POST['fecha_fin']."' AND sp_preinscritos.id_program = ".$_POST['id_program'].")
		ORDER BY id_preinscrito ASC";
		
		//echo 'query 4: '. $query_graficas;
		
	}
	
	$graficas = mysql_query($query_graficas, $des_preinscritos) or die(mysql_error());
	$row_graficas = mysql_fetch_assoc($graficas);
	
	$disciplina = $row_graficas['disciplina'];
	$program_type = $row_graficas['program_type'];
	$programa = $row_graficas['programa'];
	
	$cont_primer_contacto_a = 0; 
	$documentos_a = 0; 
	$envio_claves_a = 0; 
	$inscritos = 0; 
	$informes = 0;
	
	$cont_primer_contacto_c = 0; 
	$documentos_c = 0; 
	$envio_claves_c = 0; 
	
	$cont_primer_contacto_i = 0; 
	$documentos_i = 0; 
	$envio_claves_i = 0; 

	$valores = '';
	//$row_nac = mysql_fetch_assoc($nac);
	do{
		if($row_graficas['primer_contacto'] == 1 && $row_graficas['documentos'] == 0 && $row_graficas['envio_claves'] == 0 && $row_graficas['pago_realizado'] == 0 && $row_graficas['caso_cerrado'] == 0 && $row_graficas['caso_inconcluso'] == 0 && $row_graficas['informes'] == 0){
			$cont_primer_contacto_a++;
		}
		if($row_graficas['documentos'] == 1 && $row_graficas['envio_claves'] == 0 && $row_graficas['pago_realizado'] == 0 && $row_graficas['caso_cerrado'] == 0 && $row_graficas['caso_inconcluso'] == 0 && $row_graficas['informes'] == 0){
			$documentos_a++;
		}
		if($row_graficas['envio_claves'] == 1 && $row_graficas['pago_realizado'] == 0 && $row_graficas['caso_cerrado'] == 0 && $row_graficas['caso_inconcluso'] == 0 && $row_graficas['informes'] == 0){
			$envio_claves_a++;
		}
		if($row_graficas['pago_realizado'] == 1 && $row_graficas['caso_cerrado'] == 0 && $row_graficas['caso_inconcluso'] == 0 && $row_graficas['informes'] == 0){
			$inscritos++;
		}
		if($row_graficas['informes'] == 1){
			$informes++;
		}
		
		if($row_graficas['primer_contacto'] == 1 && $row_graficas['documentos'] == 0 && $row_graficas['envio_claves'] == 0 && $row_graficas['pago_realizado'] == 0 && $row_graficas['caso_cerrado'] == 1 && $row_graficas['caso_inconcluso'] == 0 && $row_graficas['informes'] == 0){
			$cont_primer_contacto_c++;
		}
		if($row_graficas['documentos'] == 1 && $row_graficas['envio_claves'] == 0 && $row_graficas['pago_realizado'] == 0 && $row_graficas['caso_cerrado'] == 1 && $row_graficas['caso_inconcluso'] == 0 && $row_graficas['informes'] == 0){
			$documentos_c++;
		}
		if($row_graficas['envio_claves'] == 1 && $row_graficas['pago_realizado'] == 0 && $row_graficas['caso_cerrado'] == 1 && $row_graficas['caso_inconcluso'] == 0 && $row_graficas['informes'] == 0){
			$envio_claves_c++;
		}
		
		if($row_graficas['primer_contacto'] == 1 && $row_graficas['documentos'] == 0 && $row_graficas['envio_claves'] == 0 && $row_graficas['pago_realizado'] == 0 && $row_graficas['caso_cerrado'] == 0 && $row_graficas['caso_inconcluso'] == 1 && $row_graficas['informes'] == 0){
			$cont_primer_contacto_i++;
		}
		if($row_graficas['documentos'] == 1 && $row_graficas['envio_claves'] == 0 && $row_graficas['pago_realizado'] == 0 && $row_graficas['caso_cerrado'] == 0 && $row_graficas['caso_inconcluso'] == 1 && $row_graficas['informes'] == 0){
			$documentos_i++;
		}
		if($row_graficas['envio_claves'] == 1 && $row_graficas['pago_realizado'] == 0 && $row_graficas['caso_cerrado'] == 0 && $row_graficas['caso_inconcluso'] == 1 && $row_graficas['informes'] == 0){
			$envio_claves_i++;
		}		

	}while($row_graficas = mysql_fetch_assoc($graficas));
	
	$total = $cont_primer_contacto_a + $documentos_a + $envio_claves_a + $inscritos + $informes + $cont_primer_contacto_c + $documentos_c + $envio_claves_c +$cont_primer_contacto_i + $documentos_i + $envio_claves_i;
	$total_0 = $cont_primer_contacto_a + $documentos_a + $envio_claves_a;
	$total_a = $cont_primer_contacto_a + $documentos_a + $envio_claves_a + $inscritos + $informes;
	$total_c = $cont_primer_contacto_c + $documentos_c + $envio_claves_c;
	$total_i = $cont_primer_contacto_i + $documentos_i + $envio_claves_i;
	
	$valores_a .= "['Primer contacto',".$cont_primer_contacto_a."],['Documentos',".$documentos_a."],['Envío de claves',".$envio_claves_a."],['Pago realizado / Inscritos',".$inscritos."],['Informes',".$informes."]";
	$etiquetas_a .= "'".$cont_primer_contacto_a."','".$documentos_a."','".$envio_claves_a."','".$inscritos."','".$informes."'";
	
	$valores_c .= "['Primer contacto',".$cont_primer_contacto_c."],['Documentos',".$documentos_c."],['Envío de claves',".$envio_claves_c."]";
	$etiquetas_c .= "'".$cont_primer_contacto_c."','".$documentos_c."','".$envio_claves_c."'";
	
	$valores_i .= "['Primer contacto',".$cont_primer_contacto_i."],['Documentos',".$documentos_i."],['Envío de claves',".$envio_claves_i."]";
	$etiquetas_i .= "'".$cont_primer_contacto_i."','".$documentos_i."','".$envio_claves_i."'";
	
	switch($query){
		case 1:
			$graph_title_0 = 'Estatus general de registros.<br /><strong>Todas las áreas</strong><br />Del '.$_POST['fecha_ini'].' al '.$_POST['fecha_fin'].'; <br /><br /><br /><strong>TOTAL: '.$total.'</strong>';
			$graph_title_a = 'Gráfica por pasos y estatus del proceso<br /><strong>Todas las áreas</strong><br />Del '.$_POST['fecha_ini'].' al '.$_POST['fecha_fin'].'; <br /><br /><br /><strong>Preinscritos / Casos abiertos (TOTAL: '.$total_a.')</strong>';
			$graph_title_c = '<strong>Casos cerrados (TOTAL: '.$total_c.')</strong>';
			$graph_title_i = '<strong>Casos inconclusos (TOTAL: '.$total_i.')</strong>';
		break;
		case 2:
			$graph_title_0 = 'Estatus general de registros.<br /><strong>Área: '.utf8_encode($disciplina).'</strong><br />Del '.$_POST['fecha_ini'].' al '.$_POST['fecha_fin'].'; <br /><br /><br /><strong>TOTAL: '.$total.'</strong>';
			$graph_title_a = 'Gráfica por pasos y estatus del proceso<br /><strong>Área: '.utf8_encode($disciplina).'</strong><br />Del '.$_POST['fecha_ini'].' al '.$_POST['fecha_fin'].'; (TOTAL: '.$total_a.')<br /><br /><br /><strong>Preinscritos / Casos abiertos</strong>';
			$graph_title_c = '<strong>Casos cerrados (TOTAL: '.$total_c.')</strong>';
			$graph_title_i = '<strong>Casos inconclusos (TOTAL: '.$total_i.')</strong>';
		break;
		case 3:
			$graph_title_0 = 'Estatus general de registros.<br /><strong>'.$program_type.': '.utf8_encode($programa).'</strong><br />Del '.$_POST['fecha_ini'].' al '.$_POST['fecha_fin'].'; <br /><br /><br /><strong>TOTAL: '.$total.'</strong>';
			$graph_title_a = 'Gráfica por pasos y estatus del proceso<br /><strong>'.$program_type.': '.utf8_encode($programa).'</strong><br />Del '.$_POST['fecha_ini'].' al '.$_POST['fecha_fin'].';<br /><br /><br /><strong>Preinscritos / Casos abiertos  (TOTAL: '.$total_a.')</strong>';
			$graph_title_c = '<strong>Casos cerrados (TOTAL: '.$total_c.')</strong>';
			$graph_title_i = '<strong>Casos inconclusos (TOTAL: '.$total_i.')</strong>';
		break;
		case 4:
			$graph_title_0 = 'Estatus general de registros.<br /><strong>Área: '.utf8_encode($disciplina).' | '.$program_type.': '.utf8_encode($programa).'</strong><br />Del '.$_POST['fecha_ini'].' al '.$_POST['fecha_fin'].'; <br /><br /><br /><strong>TOTAL: '.$total.'</strong>';
			$graph_title_a = 'Gráfica por pasos y estatus del proceso<br /><strong>Área: '.utf8_encode($disciplina).' | '.$program_type.': '.utf8_encode($programa).'</strong><br />Del '.$_POST['fecha_ini'].' al '.$_POST['fecha_fin'].'; <br /><br /><br /><strong>Preinscritos / Casos abiertos (TOTAL: '.$total_a.')</strong>';
			$graph_title_c = '<strong>Casos cerrados (TOTAL: '.$total_c.')</strong>';
			$graph_title_i = '<strong>Casos inconclusos (TOTAL: '.$total_i.')</strong>';
		break;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main_graficas.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Sistema de seguimiento - Gráfica por paso del proceso/estatus</title>
<!-- InstanceEndEditable -->
<link href="../estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../colorbox/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="../colorbox/jquery.colorbox.js"></script>
<script>
function confirmar(){
	return confirm('¿Está seguro/a que desea eliminar este registro? Toda la información y documentos asociados a este registro serán borrados.');
}
$(document).ready(function(){
	//Examples of how to assign the ColorBox event to elements
	$(".group1").colorbox({iframe:true, width:"540px", height:"80%"});
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
</script>
<!-- InstanceBeginEditable name="head" -->
<link rel="stylesheet" type="text/css" href="../jqPlot_graphs/jquery.jqplot.css" />
<link rel="stylesheet" type="text/css" href="../jqPlot_graphs/examples/examples.css" />
<link rel="stylesheet" type="text/css" href="../css/jquery.ui.all.css">
<script type="text/javascript" src="../jqPlot_graphs/jquery.min.js"></script>
<script type="text/javascript" src="../jqPlot_graphs/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="../jqPlot_graphs/excanvas.min.js"></script>
<script type="text/javascript" src="../jqPlot_graphs/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="../jqPlot_graphs/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="../jqPlot_graphs/plugins/jqplot.pointLabels.min.js"></script>
<script type="text/javascript" src="../jqPlot_graphs/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="../jqPlot_graphs/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="../jqPlot_graphs/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="../jqPlot_graphs/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="../jqPlot_graphs/plugins/jqplot.donutRenderer.min.js"></script>
<script src="../scripts/jquery.ui.core.js"></script>
<script src="../scripts/jquery.ui.widget.js"></script>
<script src="../scripts/jquery.ui.datepicker.js"></script>
<script>
$(document).ready(function(){
	$("input#fecha_ini" ).datepicker();
	$("input#fecha_fin" ).datepicker();
	
	//FUNCIOON PARA GRAFICA DE PASTEL
	var data = [['Preinscritos (<? echo $total_0; ?>)', <? echo $total_0; ?>],['Casos cerrados (<? echo $total_c; ?>)', <? echo $total_c; ?>], ['Casos inconclusos (<? echo $total_i; ?>)', <? echo $total_i; ?>],['Inscritos (<? echo $inscritos; ?>)', <? echo $inscritos; ?>],['Informes (<? echo $informes; ?>)', <? echo $informes; ?>]];
	  var plot1 = jQuery.jqplot ('chart0', [data], 
		//title: '<? echo $graph_title_0; ?>',
		{ 
		  seriesDefaults: {
			// Make this a pie chart.
			renderer: jQuery.jqplot.PieRenderer, 
			rendererOptions: {
			  // Put data labels on the pie slices.
			  // By default, labels show the percentage of the slice.
			  showDataLabels: true,
			  dataLabels: 'percent'
			}
		  }, 
		  legend: { show:true, location: 'e' }
		}
	);
  
	//FUNCTION PARA GRAFICA DE BARRAS 1
	  var line1 = [<? echo $valores_a; ?>];
	 
	  var plot1 = $.jqplot('chart1', [line1], {
		title: '<? echo $graph_title_a; ?>',
		seriesDefaults: {renderer: $.jqplot.BarRenderer},
		series:[
		{pointLabels:{
			show: true,
			labels:[<? echo $etiquetas_a; ?>]
		  }}],
		axesDefaults: {
			tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
			tickOptions: {
			  angle: 45,
			  fontSize: '8pt'
			}
		},
		axes: {
		  xaxis: {
			renderer: $.jqplot.CategoryAxisRenderer
		  }
		},
	  });
	  
	  //FUNCTION PARA GRAFICA DE BARRAS 2
	  var line1 = [<? echo $valores_c; ?>];
	 
	  var plot1 = $.jqplot('chart2', [line1], {
		title: '<? echo $graph_title_c; ?>',
		seriesDefaults: {renderer: $.jqplot.BarRenderer},
		series:[
		{pointLabels:{
			show: true,
			labels:[<? echo $etiquetas_c; ?>]
		  }}],
		axesDefaults: {
			tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
			tickOptions: {
			  angle: 45,
			  fontSize: '8pt'
			}
		},
		axes: {
		  xaxis: {
			renderer: $.jqplot.CategoryAxisRenderer
		  }
		},
	  });
	  
	  //FUNCTION PARA GRAFICA DE BARRAS 3
	  var line1 = [<? echo $valores_i; ?>];
	 
	  var plot1 = $.jqplot('chart3', [line1], {
		title: '<? echo $graph_title_i; ?>',
		seriesDefaults: {renderer: $.jqplot.BarRenderer},
		series:[
		{pointLabels:{
			show: true,
			labels:[<? echo $etiquetas_i; ?>]
		  }}],
		axesDefaults: {
			tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
			tickOptions: {
			  angle: 45,
			  fontSize: '8pt'
			}
		},
		axes: {
		  xaxis: {
			renderer: $.jqplot.CategoryAxisRenderer
		  }
		},
	  });
	  
	  
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
xmlhttp.open("GET",'../ajax_programas.php?id_discipline='+id_discipline,true);
xmlhttp.send();
}

function check_graph_form(){
	if($('input#fecha_ini').val() == ''){
		alert('Selecciona la fecha de inicio. Gracias.');
		return false;
	}else if($('input#fecha_fin').val() == ''){
		alert('Selecciona la fecha de término. Gracias.');
		return false;
	}else{
		return true;
	}
}

function graph_history(fecha_ini,fecha_fin){
	$('input#fecha_ini').attr('value',fecha_ini);
	$('input#fecha_fin').attr('value',fecha_fin);
	$('#graph_selector').submit();
}
</script>
<!-- InstanceEndEditable -->
</head>

<body>
<div id="container">
  <div id="header">
    <div id="logos">
      <div style="float:left;"><a href="http://uia.mx/" target="_blank"><img src="../imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" /></a> <a href="../preinscritos.php"><img src="../imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
      <div style="float:left; margin:10px;" >
        <h1>Sistema de seguimiento de preinscripciones</h1>
        <h2>Administrador | <a href="../logout.php">Cerrar sesión</a></h2>
      </div>
      <div id="home_link"></div>
    </div>
    <div class="espacio"> </div>
  </div>
 <div class="sombra"> </div>
  <div id="menu">
	  <div id="menu_int">
		<ul>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/preinscritos.php'){ ?><span style="color:#F00;">Preinscritos</span><? }else{ ?><a href="../preinscritos.php?<? echo $_SERVER['QUERY_STRING']?>">Preinscritos</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/inscritos.php'){ ?><span style="color:#F00;">Inscritos</span><? }else{ ?><a href="../inscritos.php?<? echo $_SERVER['QUERY_STRING']?>">Inscritos</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/casos_cerrados.php'){ ?><span style="color:#F00;">Casos cerrados</span>
			<? }else{ ?><a href="../casos_cerrados.php?<? echo $_SERVER['QUERY_STRING']?>">Casos cerrados</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/casos_inconclusos.php'){ ?><span style="color:#F00;">Casos inconclusos</span>
			<? }else{ ?><a href="../casos_inconclusos.php?<? echo $_SERVER['QUERY_STRING']?>">Casos inconclusos</a><? } ?></li>
		  <li><? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/informes.php'){ ?><span style="color:#F00;">Informes</span>
			<? }else{ ?><a href="../informes.php?<? echo $_SERVER['QUERY_STRING']?>">Informes</a><? } ?></li>
		</ul>
		</div>
		<div id="buscador">
		<form name="buscador" id="buscador" action="resultados_busqueda.php" method="get">
			<a href="graficas_area_programa.php">Gráficas</a>
			<a href="../export_to_xls.php">Exportar a Excel</a>
			<input name="qs" type="text" id="qs" value="" placeholder="Todas las &aacute;reas" />
			<input type="submit" name="enviar" id="enviar" value="Buscar">
		</form>
	  </div>
	</div>
    <div class="sombra"> </div>
	<div class="espacio"></div>
	
  <!-- InstanceBeginEditable name="contenido" -->
  <h1>Gráficas</h1>
  <div class="sombra"> </div>
  <div class="espacio"></div>
  <div id="menu" style="background:none;">
    <div id="menu_int" style="width:100%;">
      <ul>
        <li>
          <? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/graficas/graficas_area_programa.php'){ ?>
          <span style="color:#F00;">Interesados por &aacute;rea/programa</span>
          <? }else{ ?>
          <a href="graficas_area_programa.php?<? echo $_SERVER['QUERY_STRING']?>">Interesados por &aacute;rea/programa</a>
          <? } ?>
        </li>
        <li>
          <? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/graficas/graficas_nacionalidad.php'){ ?>
          <span style="color:#F00;">Nacionalidad</span>
          <? }else{ ?>
          <a href="graficas_nacionalidad.php?<? echo $_SERVER['QUERY_STRING']?>">Nacionalidad</a>
          <? } ?>
        </li>
        <li>
          <? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/graficas/graficas_nivel_academico.php'){ ?>
          <span style="color:#F00;">Nivel acad&eacute;mico</span>
          <? }else{ ?>
          <a href="graficas_nivel_academico.php?<? echo $_SERVER['QUERY_STRING']?>">Nivel acad&eacute;mico</a>
          <? } ?>
        </li>
        <li>
          <? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/graficas/graficas_exalumno.php'){ ?>
          <span style="color:#F00;">Exalumno Ibero</span>
          <? }else{ ?>
          <a href="graficas_exalumno.php?<? echo $_SERVER['QUERY_STRING']?>">Exalumno Ibero</a>
          <? } ?>
        </li>
        <li>
          <? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/graficas/graficas_como_se_entero.php'){ ?>
          <span style="color:#F00;">¿C&oacute;mo se enter&oacute;?</span>
          <? }else{ ?>
          <a href="graficas_como_se_entero.php?<? echo $_SERVER['QUERY_STRING']?>">¿C&oacute;mo se enter&oacute;?</a>
          <? } ?>
        </li>
        <li>
          <? if($_SERVER['PHP_SELF'] == '/s_preiniscritos/graficas/graficas_paso_del_proceso_estatus.php'){ ?>
          <span style="color:#F00;">Paso del proceso / estatus</span>
          <? }else{ ?>
          <a href="graficas_paso_del_proceso.php?<? echo $_SERVER['QUERY_STRING']?>">Paso del proceso / estatus</a>
          <? } ?>
        </li>
      </ul>
    </div>
  </div>
  <div class="sombra"> </div>
  <div class="espacio"> </div>
  <div class="espacio"> </div>
  <div>
    <form action="graficas_paso_del_proceso_estatus.php" method="post" name="graph_selector" id="graph_selector" onsubmit="return check_graph_form();">
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td><div id="select_anio">
            Graficar del
                <input type="text" id="fecha_ini" name="fecha_ini">
                al
                <input type="text" id="fecha_fin" name="fecha_fin" onchange="check_selection_1();" />
                <input type="button" name="hist_graph" id="hist_graph" value="Graficar histórico" onclick="graph_history('2012-08-22 00:00:00','<?php echo date('Y-m-d H:i:s'); ?>');" />
          
            </div>
            <div id="select_programa">
              <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td valign="top" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top" align="left"><!-- comienza select de áreas -->
                      
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
                          <? }while($row_disciplinas = mysql_fetch_assoc($disciplinas)); ?>
                        </select>
                      </label>
                      
                      <!-- termina select de areas --></td>
                  </tr>
                  <tr>
                    <td valign="top" align="left" id="td_programas2">&nbsp;</td>
                  </tr>
                  <tr> 
                    <!-- TD para desplegar el resultado del AJAX -->
                    <td valign="top" align="left" id="td_programas"><select id="id_program" name="id_program" class="contenido_diplo" style="max-width:350px; width:350px;">
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
                      </select></td>
                    <!-- finaliza TD --> 
                  </tr>
                  <tr>
                    <td valign="top" align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top" align="left"><input type="submit" name="graficar" id="graficar" value="Graficar" /></td>
                  </tr>
                </tbody>
              </table>
          </div></td>
        </tr>
      </table>
    </form>
  </div>
  <div class="espacio"></div>
  <div class="espacio"></div>
  <div id="chart0" style="height:600px; width:100%; float:left;"></div>
  <div class="espacio"></div>
  <div id="chart1" style="height:600px; width:100%; float:left;"></div>
  <div class="espacio"></div>
  <div class="espacio"></div>
  <div id="chart2" style="height:600px; width:100%; float:left;"></div>
  <div class="espacio"></div>
  <div class="espacio"></div>
  <div id="chart3" style="height:600px; width:100%; float:left;"></div>
  <div class="espacio"></div>
  <!-- InstanceEndEditable -->
</div>
</body>
<!-- InstanceEnd --></html>
