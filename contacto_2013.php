<?php require_once('../Connections/nov2013.php');
										
try{																																																																																											
    $db = new PDO("mysql:host=$host;dbname=$dbname","$username","$password",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));																																													
}catch(PDOException $e){															
	echo "Error !!: " . $e->getMessage() . "<br/>";
	die();																																									
}																																																								
																																				
if((isset($_POST['send_form'])) && ($_POST['send_form']==1)){

	$id_discipline  = $_POST['id_discipline'];
	$id_program 	= $_POST['id_program'];
	$fecha_registro = date('Y-m-d H:i:s');
								
	$programas = $db->query("SELECT pro.program_name,dis.discipline FROM seg_dec_programas as pro INNER JOIN seg_dec_disciplinas as dis ON pro.id_discipline = dis.id_discipline WHERE pro.id_program=".$id_program." AND (pro.id_discipline=".$id_discipline." OR pro.id_discipline_alterna=".$id_discipline." )");																																																																																			
	$programas = $programas->fetchAll(PDO::FETCH_CLASS);	
																															
	//usuarios asignados al programa	
	$key = 'sistema_seguimiento';																																																																											
	$usuarios_programas = $db->query("SELECT u.email_1,u.email_2,u.username,AES_DECRYPT(u.pass,'{$key}') AS pass FROM seg_dec_usuarios AS u INNER JOIN seg_dec_usuarios_programas AS up ON up.user_uuid = u.user_uuid WHERE up.id_discipline=".$id_discipline." AND up.id_program=".$id_program." AND u.notificacion='1' and u.activo='1'");																																																																																			
	$usuarios_programas = $usuarios_programas->fetchAll(PDO::FETCH_ASSOC);																									
																																
	//Información Personal
	$email 	      = $_POST['correo'];
	$paterno      = $_POST['a_paterno'];
	$materno      = $_POST['a_materno'];
	$nombre       = $_POST['nombre'];
	$correo       = $_POST['correo'];
	$comentario   = $_POST['comentario'];
	$acepta_aviso = isset($_POST['option2'])?$_POST['option2']:1;

	$insertSQL = "INSERT INTO seg_dec_contacto(
	id_discipline,
	id_program,
	comentario,
	paterno,
	materno,
	nombre,
	correo,
	acepta_aviso)
	VALUES (
	:id_discipline,
	:id_program,
	:comentario,					
	:paterno,
	:materno,
	:nombre,
	:correo,
	:acepta_aviso
	)";															
																																								
	$query = $db->prepare($insertSQL);
	$query->bindParam(':id_discipline',$id_discipline);
	$query->bindParam(':id_program',$id_program);
	$query->bindParam(':comentario',$comentario);					
	$query->bindParam(':paterno',$paterno);						
	$query->bindParam(':materno',$materno);
	$query->bindParam(':nombre',$nombre);
	$query->bindParam(':correo',$correo);	
	$query->bindParam(':acepta_aviso',$acepta_aviso);	

	$query->execute();											 	
																									
	/*CONSTRUCCION DEL MENSAJE PARA ENVIAR EN EL MAIL*/
	$mensaje = '';						
    $mensaje.="<br /><strong>Han solicitado Informaci&oacute;n:</strong><br /><br />";
	$mensaje="<strong>&Aacute;rea:</strong> ".$programas[0]->discipline."<br />";
	$mensaje.="<strong>Nombre del programa:</strong> ".$programas[0]->program_name."<br />";
																						
	$mensaje.="<br /><strong>Informaci&oacute;n Personal:</strong><br /><br />";
	$mensaje.="<strong>Apellido Paterno:</strong> ".$paterno."<br />";
	$mensaje.="<strong>Apellido Materno:</strong> ".$materno."<br />";
	$mensaje.="<strong>Nombre:</strong> ".$nombre."<br />";
	$mensaje.="<strong>Correo:</strong> ".$correo."<br />";
	$mensaje.="<strong>Comentario:</strong> ".$_POST['comentario'];
	
	
	$headers = "From: " . strip_tags($email) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	
	$headers .= 'Cc: webmaster@dec-uia.com' . "\r\n";				
	
	//echo "ANTES: " . $mensaje;
											
	$mensaje = str_replace("á", "&aacute;", $mensaje);
	$mensaje = str_replace("é", "&eacute;", $mensaje);
	$mensaje = str_replace("í", "&iacute;", $mensaje);
	$mensaje = str_replace("ó", "&oacute;", $mensaje);
	$mensaje = str_replace("ú", "&uacute;", $mensaje);
	$mensaje = str_replace("ñ", "&ntilde;", $mensaje);
	$mensaje = str_replace("Ñ", "&Ntilde;", $mensaje);
	
	//echo "DESPUES: " . $mensaje;
	
	$mail_title = "DEC - Solicitud de informes";
																											
	//mail("dec.ibero@gmail.com", $mail_title, $mensaje, $headers);
	mail("guillermojoel.huerta@gmail.com", $mail_title, $mensaje, $headers);

	$mensaje_coord = '';	
	if(!empty($usuarios_programas)){
																											
		foreach($usuarios_programas as $usuario){ 

			$to_coord_b = $usuario['email_1'];								
			$mensaje_coord .= "<br /><br />";
			$mensaje_coord = "Hay una nueva solicitud de informes para el <strong>".$programas[0]->program_name."</strong>";
			$mensaje_coord .= "<br /><br />";				
			$mensaje_coord .= "Para darle seguimiento visita la siguiente liga:";
			$mensaje_coord .= "<br /><br />";
			$mensaje_coord .= "<a href='http://www.dec-uia.com/s_preiniscritos/' target='_blank'>http://www.dec-uia.com/s_preiniscritos/</a>";
			$mensaje_coord .= "<br /><br />donde podr&aacute;s llevar paso a paso el proceso de inscripci&oacute;n y tener un f&aacute;cil acceso a la informaci&oacute;n del usuario.";
			$mensaje_coord .= "<br /><br />Tu nombre de usuario es: <strong>".$usuario['username']."</strong>";
			$mensaje_coord .= "<br /><br />Tu contrase&ntilde;a: <strong>".$usuario['pass']."</strong>";
			mail($to_coord_b, $mail_title, $mensaje_coord, $headers);															
		}														
	}													 																																													
	//mail('pvazquezdiaz@gmail.com', $mail_title, $mensaje_coord, $headers);
?>									

<script type="text/javascript">
alert("Sus Datos han sido enviado satisfactoriamente");
//window.location = "index.php";						
</script>

<?php

	//header('Location: index.php');
	//para mandar el mail en texto plano.

}
			
?>
<!DOCTYPE html>
<html><!-- InstanceBegin template="/Templates/index.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<link rel="stylesheet" href="Scripts/jquery-ui.css" type="text/css" media="all" />
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="Scripts/menu2.js"></script>
<script src="Scripts/jquery-ui.js"></script>
<script type="text/JavaScript">
//-->
function validate(){
	   
	   //___ NUEVO CODIGO ---
	   
	    var requiredFieldsAlertMsg = "Los siguientes campos son requeridos:\n\n";
		var cont = 0;
		  
		  if($('select#id_program').val()==0){
			  requiredFieldsAlertMsg += "* Programa\n";
				cont++;
		  }
		 
		 if ($('input[name=como_se_entero]:radio').is(':checked')) {
			 //--
		 }else{
			 if($('input#otromedio').val()==''){
				requiredFieldsAlertMsg += "* ¿Cómo se enteró?\n";
				cont++;
			}
		}
		
		if($('input#a_paterno').val()==''){
			requiredFieldsAlertMsg += "* Apellido paterno\n";
			cont++;
		}
		if($('input#a_materno').val()==''){
			requiredFieldsAlertMsg += "* Apellido materno\n";
			cont++;
		}
		if($('input#nombre').val()==''){
			requiredFieldsAlertMsg += "* Nombre(s)\n";
			cont++;
		}
		
	   
		if(cont>0){
			alert(requiredFieldsAlertMsg);
			return false;
		}else{
			return true;
		}		
}

function load_programs(id_discipline)
{
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
xmlhttp.open("GET",'ajax_programas_2013.php?id_discipline='+id_discipline,true);
xmlhttp.send();
}


function count_char(){
	var total_letras = 200;
	$('#comentario').keyup(function() {
			var longitud = $(this).val().length;
			var resto = total_letras - longitud;
			$('#numero').html(resto);
			if(resto <= 0){
					$('#comentario').attr("maxlength", 200);
			}
	});
}

</script>
<!-- InstanceEndEditable -->
<link href="css/estilos_dan.css" rel="stylesheet" type="text/css" />
<!------ Google Analytics ------>
<script type="text/javascript">

 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-24531403-1']);
 _gaq.push(['_trackPageview']);

 (function() {
   var ga = document.createElement('script'); ga.type =
'text/javascript'; ga.async = true;
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
   var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
 })();

</script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23217985-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<script type="text/javascript">

	var lastHeight = 0;

	function resizeHelperIframe()
	{	
		// Gets the new page height
		var newHeight = document.body.offsetHeight; //document.body.scrollHeight;
		
		if(lastHeight != newHeight){
			
			// New height is going to the parent through the helperIframe.
			var helperIframe = document.getElementById('helperIframe');
			helperIframe.contentWindow.location.replace('http://www.diplomados.uia.mx/helper.html#' + newHeight);
			
			lastHeight = newHeight;
		}
	}
	
	window.onload = function(event) {
		
		resizeHelperIframe();
		
	}
		
</script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<iframe id="helperIframe" src='http://www.diplomados.uia.mx/helper.html#1000' height='0' width='0' frameborder='0'></iframe>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<div id="container">
  <div id="header" style="margin-top:16px">
    <div id="logos"> <a href="http://uia.mx/" target="_blank"><img src="imagenes/logo_UIA.jpg" alt="logo" width="100" height="78" border="0" class="logo"/></a><a href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'"><img src="imagenes/logo_DEC.jpg" alt="DEC" width="90" height="78" border="0" /></a></div>
    <div id="primavera" style="margin-bottom:8px"></div>
    <div id="menu" style="float:none;width:1016px">
   	<a href="https://twitter.com/DiplomadosIbero" target="_blank"><div style="float:right;height:24px;width:33px;background-image: url(imagenes/twitter.png);border-left:3px;margin-left:11px;margin-right:13px"></div></a>
    <a href="http://www.facebook.com/diplomados.uia" target="_blank"><div style="float:right; height:24px;width:12px;background-image: url(imagenes/facebook.png);margin-left:10px"></div></a>
     <ul style="margin-left:187px">
           <li ><a style="font-size:11px" href="#" onclick="parent.location='http://www.diplomados.uia.mx/index.php'">Inicio</a></li>
        <li>|</li>
        <li><a style="font-size:11px" font-size='11px' href="#" onclick="parent.location='http://www.diplomados.uia.mx/nosotros.php'">Nosotros</a></li>
        <li>|</li>
        <li><!--a href="http://enlinea.uia.mx/tes_dec/dec_login.cfm" target="_blank"--><a style="font-size:11px" href="#" id="servicios_en_linea">Servicios y Pagos en l&iacute;nea</a></li>
        <li>|</li>
        <li><a style="font-size:11px" font-size='11px' href="#" onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'">Promociones</a></li>
        <li>|</li>
        <li><a style="font-size:11px" href="#" onclick="parent.location='http://www.diplomados.uia.mx/preinscripcion.php'">Preinscripci&oacute;n</a></li>
        <li>|</li>
        <li><a style="font-size:11px" href="#" onclick="parent.location='http://www.diplomados.uia.mx/directorio.php'">Directorio</a></li>
        <li>|</li>
        <li><a style="font-size:11px" href="#" onclick="parent.location='http://www.diplomados.uia.mx/contacto.php'">Informes</a></li>
      </ul>
     </div>
    <div class="bannersuperior2" style="width:706px"></div>
    <br />
    <div id="slide_menu" style="display:none; width:190px; background: url(imagenes/sombrita_submenu.png) repeat-y; background-color:#D6D7D9; position:relative; left:189px;z-index:1000; margin-bottom:-1000px">

  	 </div>
  </div>
  <div id="separador"></div>
    <div id="slide_servicios" style="display: none; width:131px; height:140px; padding-top:10px; background-color: #FFF; z-index: 1007; margin-top:-162px; position:relative; top:148px; left:372px; border:solid 1px #EFEFEF; float:left;">
<ul style="list-style:none; padding-left:16px; width:110px;">
<li style="padding-bottom:10px;"><a href="http://enlinea.uia.mx/tes_dec/dec_login.cfm" target="_blank">Servicios en l&iacute;nea</a></li>
<li style="padding-bottom:10px;"><a href="https://enlinea.uia.mx/sit/SitActividadesEsp.cfm" target="_blank">Pago de traducciones</a></li>
<li style="padding-bottom:10px;"><a href="temarios/politcas_cobranza.pdf" target="_blank">Pol&iacute;ticas cobranza</a></li>
<li style="padding-bottom:10px;"><a href="tutorial_pagos.php">Tutorial pagos en l&iacute;nea</a></li></ul>
  </div>
  <div id="menu_generos_interior_index">
    <div class="roundedBox_interior_index" id="type1"> 
      <!-- esquinas -->
      <!-- esquinas -->
      <div id="menu_desplega_index">
		<?php include('menu_disciplines.php');?>
      </div>
    </div>
  </div>
  <div id= "contenedor_irregular_index" >
    <div id= "type4" class="cuadro_articulos_secciones" style="border:0px;width:816px;padding:0px">
      <div id="caja" style="width:788px; border:1px;height:265px;background-image: url(imagenes/m_informes.jpg);margin-left:26px;position:relative; float:left; z-index:12;"> <!-- InstanceBeginEditable name="header" -->
    				      
    </div>
    <div style="margin-left:24px">
		<div style="width:69%;float:left;margin-left:0px">
			<div id="slide_search" style="border: 1px solid #E0E0E0; display:none; position:relative; margin-top:-202px; top:625px; left:-39px; width:192px; height:200px; background-color:#FFF; z-index:1000;">
				<form name="buscador" action="resultados.php" method="post">
					<label for="buscar"></label>
				    <img src="imagenes/piquito_rojo_buscador.png">
				    <input name="buscar" placeholder="¿Qué tema buscas?" type="text" id="buscar" style="margin:0 0 0 14px; width:150px; height:11px; padding:1px; border:1px solid #999999; font-size:11px;"  />
				    <input name="search" type="submit" id="search" value="n" style="color:#D1D1D1; font-size:1px; width:49px; height:16px; background:url(imagenes/boton_buscar.jpg) top center no-repeat; border:none; margin: 10px 0px 0px 129px;" />
				    <br />
					<table width="180" border="0" cellspacing="0" cellpadding="0" style="margin:10px 0 0 12px;">
				    	<thead>
				    		<tr colspan="3" style="text-align:left; height:20px;font-size:11px;">
				    			<th width="20px" colspan="3">Búsqueda Avanzada (opcional)</th>
				    		</tr>
				    	</thead>
				    	<tr>
				        	<td colspan="3">
				        		 <select name="sArea" id="sArea" style="margin:0px; width:167px; height:15px; border:1px solid #999999; line-height:0; font-size:11px;">
									<option disabled="disabled" value="0" selected="selected" >¿Qu&eacute; &aacute;rea te interesa?</option>
									<option value="arquitectura">Arquitectura</option>
									<option value="arte">Arte</option>
									<option value="asuncion">Asunci&oacute;on Quer&eacute;taro</option>
									<option value="integral a empresas">Atenci&oacute;n Integral a Empresas</option>
									<option value="sector publico">Atenci&oacute;n Integral al Sector P&uacute;blico</option>
									<option value="atrio">Atrio Espacio Cultural</option>
									<option value="barragan">Casa Barrag&aacute;n</option>
									<option value="religiosas">Ciencias Religiosas</option>
									<option value="comunicacion">Comunicaci&oacute;n</option>
									<option value="desarrollo">Desarrollo Humano</option>
									<option value="diseño">Diseño</option>
									<option value="gastronomia">Gastronom&iacute;a</option>
									<option value="humanidades">Humanidades</option>
									<option value="ibero online">Ibero Online</option>
									<option value="idiomas">Idiomas</option>
									<option value="lofft">Lofft</option>
									<option value="negocios">Negocios</option>
									<option value="politica">Pol&iacute;tica y Derecho</option>
									<option value="preparatoria">Preparatoria Abierta</option>
									<option value="educacion ejecutiva">Programas de Educaci&oacute;n Ejecutiva</option>
									<option value="salud">Salud</option>
									<option value="tecnologia">Tencolog&iacute;a</option>
									<option value="xochitla">Xochitla</option>
								</select>
							</td>
				        </tr>
				        <tr>
				        	<td colspan="3" height="30px" valign="bottom">
					        	¿Cu&aacute;ndo quieres comenzar?
					        </td>
				        </tr>
				        <tr>
				        	<td colspan="3" style="font-size:9px;">
					        	Escoge una fecha precisa o un periodo
					        </td>
				        </tr>
				        
				        <tr style="margin-top:10px;"valign="middle">
				        	<td width="75px">
				        		<input type="text" id="datepickerI" name="datepickerI" style="margin:0px; width:55px; height:11px; padding:1px; border:1px solid #999999; line-height:0; font-size:11px;"/>	
				        		<img src="imagenes/calendario.jpg">
				        	</td>
				            <td  width="75px">
				            	<input type="text" id="datepickerF" name="datepickerF" style="margin:0px; width:55px; height:11px; padding:1px; border:1px solid #999999; line-height:0; font-size:11px;"/>
				            	<img src="imagenes/calendario.jpg">
				            </td>
				        </tr>
				        <tr>
				        	<td colspan="3" style="text-align:right;">
				          		<input name="search" type="submit" id="search" value="a" style="color:#D1D1D1; font-size:1px; width:49px; height:16px; background:url(imagenes/boton_buscar.jpg) top center no-repeat; border:none; margin: 15px;" />
				 			</td>
						</tr>
				   </table>
			    </form>
			  </div>
		</div>
	</div>
    <div id= "type4" class="rectangulo_abajo_secciones" style="border:0px">
      <div class="textos"><!-- InstanceBeginEditable name="contenido" -->
		  	<table width="95%" border="0" align="center" cellpadding="10" cellspacing="0">
		  		<tr>
		  			<td width="71%" height="50" valign="bottom" class="contenido_diploBold"><p>Formato
			      de Informes</p></td>
		  			<td width="25%" align="right" valign="top"></td>
		  			<td width="4%" rowspan="2">&nbsp;</td>
	  			</tr>
		  		<tr>
		  			<td colspan="2"><p>La direcci&oacute;n de educaci&oacute;n
		  				continua preocupada en&nbsp; la agilizaci&oacute;n de tr&aacute;mites,
		  				presenta a continuaci&oacute;n un formato de preinscripci&oacute;n
		  				que nos ayudar&aacute; a conocer mejor tus necesidades
		  				y los datos necesarios para informarte sobre tu proceso
	  				  de inscripci&oacute;n.</p></td>
	  			</tr>
		  		<tr>
		  			<td colspan="3"><table width="90%" border="0" align="left" cellpadding="2">
<tr>
<td height="30" align="left" valign="middle" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #666;"><p>Si
  deseas preinscribirte a alg&uacute;n curso o diplomado,
  haz click <a style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #F00; text-decoration:none; cursor:pointer;" href="preinscripcion.php">aqu&iacute;</a></p></td>
</tr>
<tr>
  <td height="30" align="left" valign="middle"style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #F00; text-decoration:none;"><strong>Informes</strong></td>
</tr>
</table>
<div style="clear:both; height:20px;"></div>
<!--COMEIENZA FORMA DE INFORMES--> 									
<form id="form_inf" name="form_inf" method="post" onsubmit="return validate();" action="contacto_2013.php">
	<table width="500" border="0" cellspacing="0" cellpadding="5">
		<tr>											
			<td colspan="2" valign="top"><label for="id_discipline"></label>
				<select onchange="load_programs(this.value);" name="id_discipline" id="id_discipline">
					<option value="0" selected="selected">Selecciona un &aacute;rea</option>
					<?php	$disciplinas =	$db->query('SELECT id_discipline,discipline from seg_dec_disciplinas'); 
				        	if(!empty($disciplinas)){								
				        		foreach($disciplinas as $disciplina){							
				    ?> 																
				        		<option value="<?php echo $disciplina['id_discipline']; ?>"><?php echo $disciplina['discipline'] ?></option>
				    <?php
				        		}																										
				        	}																																	
				    ?>		
				</select></td>
		</tr>
		<tr>
			<td colspan="2" valign="top" id="td_programas"><select name="id_program" id="id_program" style="width:540px; max-width:540px;">
				<option value="0" selected="selected" disabled="disabled">Selecciona un programa</option>
				<option disabled="disabled">-----DIPLOMADOS---</option>
				<?php 
							$tipo_ant = 'diplomado';
							do{
								$tipo = $row_programas['program_type'];
								if($tipo != $tipo_ant){echo '<option disabled="disabled">-----CURSOS---</option>';}
								echo '<option value="'.$row_programas['id_program'].'">'.$row_programas['program_name'].'</option>';
								$tipo_ant = $tipo;
							} while($row_programas = mysql_fetch_assoc($programas)); ?>
			</select></td>
		</tr>
		<tr>
			<td colspan="2" align="center">&nbsp;</td>
		</tr>
		<tr>
			<td width="148" align="right" valign="top">* A. Paterno</td>
			<td width="332" valign="top"><label for="a_paterno"></label>
				<input name="a_paterno" type="text" id="a_paterno" onchange="populate_rfc_name()" size="30" /></td>
		</tr>
		<tr>
			<td align="right" valign="top">* A. Materno</td>
			<td valign="top"><label for="a_materno"></label>
				<input name="a_materno" type="text" id="a_materno" onchange="populate_rfc_name()" size="30" /></td>
		</tr>
		<tr>
			<td align="right" valign="top">* Nombre(s)</td>
			<td valign="top"><label for="nombre"></label>
				<input name="nombre" type="text" id="nombre" onchange="populate_rfc_name()" size="30" /></td>
		</tr>
		<tr>
			<td align="right" valign="top">* E-mail</td>
			<td valign="top"><label for="correo"></label>
				<input name="correo" type="text" id="correo" size="30" /></td>
		</tr>
		<tr>
			<td align="right" valign="top">Comentario:</td>
			<td><label for="telefono_empresa"></label>
				<textarea name="comentario" cols="30" rows="5" id="comentario" onkeydown="count_char();"></textarea></td>
		</tr>
		<tr>
			<td align="right" valign="top">&nbsp;</td>
			<td><span id="numero">200</span> caracteres restantes</p></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="enviar" id="enviar" value="Enviar" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><a href="politicas_privacidad.php" target="_blank" style="color:#ff0000;"><input type="checkbox" name="option2" value="1" checked disabled><strong> He leido y acepto el Aviso de Privacidad</strong></a></td>
		</tr>
	</table>
	<input type="hidden" name="send_form" id="send_form" value="1" />
</form>
<!--FINALIZA FORMA DE INFORMES-->
					</td>
	  			</tr>
	  		</table>
		  <!-- InstanceEndEditable -->
        <table width="93%" border="0" align="center" cellpadding="5" cellspacing="10">
          <tr>
            <td><!-- AddThis Button BEGIN -->
              
              <div class="addthis_toolbox addthis_default_style"
						addthis:url="articulos.php?id_discipline=<?php echo $_GET['id_discipline']; ?>"
						addthis:title="<?php echo $row_temp['discipline'].' - '.$row_disciplines['title'];?>"> <a class="addthis_counter addthis_pill_style"></a> </div>
              <script type="text/javascript">
					var addthis_config = {"data_track_clickback":true};
					</script> 
              <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=pvazquezdiaz"></script> 
              <!-- AddThis Button END --></td>
          </tr>
        </table>
      </div>
      </div>
    <div style="width:25%; float:left; margin-left:18px; margin-top:18px">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>          
          <td align="center"><a onclick="parent.location='http://www.diplomados.uia.mx/promociones.php'" href="#"><img src="imagenes/ladec/banners/banners_laterales/descuentos.jpg" width="181px" border="0" /></a></td>
          </tr>
          <tr>
            <td  align="right" valign="top" >&nbsp;</td>
            </tr>
          <tr>		
            <td align="center"><a onclick="parent.location='http://www.diplomados.uia.mx/propuestas_cursos.php'" href="#"><img src="imagenes/ladec/banners/banners_laterales/solicitalo.jpg" width="181px" height="115" border="0" /></a></td>
          </tr>																
          		
           <tr>
            <td valign="bottom" width="191px" height="118" align="left" style="background: url(imagenes/ladec/banners/banners_laterales/newsletter.jpg) no-repeat bottom transparent; width:191px;">
              <form action="http://www.dec-uia.com/cgi-bin/dada/mail.cgi" method="post" target="_blank" name="form_news" id="form_news">									
                <table width="170" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tbody><tr>						
                    <td width="62%" height="10"></td>
                    <td width="38%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right"><!-- begin subscription_form_widget.tmpl -->
                      
                      <input type="hidden" name="list" value="newsDEC">
                      <input type="hidden" name="f" id="f_s" value="subscribe" checked="checked">
                      <input name="email" type="text" id="email" value="" size="15" class="news_input" placeholder="email" background="none"></td>								
                    <td align="center"><input onClick="_gaq.push(['_trackEvent', 'Newsletter', 'Click', 'Registro al newsletter']);" type="submit" value="" class="processing"></td>
                  </tr>
                  <tr>
                    <td height="1"></td>
                  </tr>
                </tbody></table>
              </form></td>
          </tr>
              
              <!--table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
      <form action="http://www.dec-uia.com/cgi-bin/dada/mail.cgi" method="post">
      Suscr&iacute;bete e nuestro bolet&iacute;n<br /><br />
        <input type="hidden" name="list" value="newsDEC" />
       Correo:<input name="email" type="text" id="email" value="" size="15" /><br />
        <input type="hidden" name="f" id="f_s" value="subscribe" checked="checked" />
        <input type="hidden" name="f"  id="f_u"  value="unsubscribe"  />
      <input type="submit" value="Aceptar" class="processing" />
      </form> 
          </td>
        </tr>
      </table--></td>
          </tr>
        </tbody>
      </table>
   
</div>
</div>
</div>
 <div id="footer" style="float:left;width:810px">
    <table border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="810"><a onclick="parent.location='http://www.diplomados.uia.mx/articulos.php?id_discipline=20'" href="#"><img src="imagenes/banners/idiomas_otono.jpg" alt="Dos" width="804" height="142" border="0" /></a></td>
        </tr>
      <tr align="center" valign="middle">
        <td colspan="2"><p><strong>&copy; Universidad Iberoamericana Ciudad
            de M&eacute;xico. </strong><br>
          </p>
          <address>
          Prol. Paseo de la Reforma 880, edificio G, P.B.
          Lomas de Santa Fe, M&eacute;xico, C.P. 01219, Distrito Federal. <br>
          Tel. (55) 59.50.40.00
          y 91.77.44.00 Lada nacional sin costo: 01 800 627 7615
          </address></td>
      </tr>
    </table>
  </div>
</div>

<map name="Map2" id="Map2">
  <area shape="rect" coords="49,104,76,133" href="https://www.facebook.com/diplomados.uia" target="_blank" />
  <area shape="rect" coords="77,103,109,134" href="http://twitter.com/DiplomadosIbero" target="_blank" />
</map>
</body>
<!-- InstanceEnd --></html>

