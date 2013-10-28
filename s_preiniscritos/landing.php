<?php
	//registro_red();
	$comentarios=$_GET["tipo"];
	if($comentarios=="q6ORo3L4JJdU5EO"){
		$red="Facebook";
		registro_red($red);
	}
	else if($comentarios=="hwR4tiCeYwfShYO"){
		$red="Adsense";
		registro_red($red);
	}
	else if($comentarios=="jSl2QH8Xp8EqWEO"){
		//header('Location: landing.php?tipo=jSl2QH8Xp8EqWEO');
		echo "no existe datos";

	}

	function registro_red($red){
		$fecha=date("Y-m-d H:i:s");
		$num1=rand(1,40);
		$num2=rand(1,40);
		$num3=rand(1,40);
		$id=$num1."".$num2."".$num3;
		$base_datos="decuiaco_site";
		$servidor="localhost";
		$usuario="decuiaco";
		$password="DEC2010";
		$conex=mysql_connect($servidor, $usuario, $password) or die(mysql_error());
		mysql_select_db($base_datos, $conex);
		$sql="INSERT INTO landing_harvard (id_landing,tipo_red,fecha) VALUES ('".$id."','".$red."','".$fecha."')";
		$result=mysql_query($sql);

	}



?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="icon" href="http://www.dec-uia.com/logo_UIA.jpg" type="image/x-icon">
<title>Dirección de Educación Continua</title>
</head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript">
		$(document).ready(function(){
			$("#validate_form").click(validacion_form);
			$(".diplomados").click(function(){
				window.location="http://www.diplomados.uia.mx/programas.php?id_discipline=23&id_program=386&titulo=Strengthening_Business_Presentation_Techniques_"
			})
		})
		function validacion_form(){
			nombres=$("#nombre").val();
			paternos=$("#paterno").val();
			maternos=$("#materno").val();
			mails=$("#mail").val();
			telefonos=$("#telefono").val();
			check = $("input[type='checkbox']:checked").length;
			var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
			if(nombres==""){
				$("#nombre").css("background","red")
				$("#nombre").val("información requerida")
				return false;
			}
			else if(paternos==""){
				$("#nombre").css("background","white")
				$("#paterno").css("background","red")
				$("#paterno").val("información requerida")
				return false;
			}
			else if(maternos==""){
				$("#paterno").css("background","white")
				$("#materno").css("background","red")
				$("#materno").val("información requerida")
				return false;
			}
			else if (mails == ""){
				$("#materno").css("background","white")
				$("#mail").css("background","red")
				$("#mail").val("información requerida")
				return false;
			}
			else if(!emailreg.test(mails)){
				$("#materno").css("background","white")
				$("#mail").css("background","red")
				$("#mail").val("Correo inválido")
				return false;
			}
			else if(telefonos==""){
				$("#mail").css("background","white")
				$("#telefono").css("background","red")
				$("#telefono").val("información requerida")
				return false;
			}
			else if(check==""){
				$("#mail").css("background","white")
				$(".error_checkbox").css({
					"display":"block",
					"font-size":"12px",
					"color":"red"})
				$(".error_checkbox").append("<label>Escoge tu(s) programa(s) de interés</labe>")
				$("#validate_form").css({"position":"relative","top":"-18px"})
				$("#registro").css("height","auto")
				return false;
			}
			else{
				return true;
			}
		}
	</script>
<body>
	<div id="landing">
		<div class="landing2">
			<div id='logos'></div>
			<div id="titulo">
				<h3 style="margin-top: 30px">Programas ejecutivos impartidos por:</h3>
				<h1>Harvard Graduate School of Design Executive Education Programs</h1>
			</div>
			<div id="diplomados">
				<h3 >Programas de excelencia internacional</h3>
				<table border=0>
					<tr>
						<td >
							<div style="float:left;">
								<p class="diplomado">Strengthening Business<br> Presentation Techniques</p>
								<p>Lograrás:</p>

									<span>·</span><div class="list2"><p class="list">Perfeccionar tus habilidades discursivas frente a grupos pequeños o grandes audiencias.</p></div>
									<span>·</span><div class="list2"><p class="list">Generar mensajes claros y contundentes.</p></div>
									<span>·</span><div class="list2"><p class="list">Control de neviosismo y mejor conocimiento de tu público receptor.</p></div>
									<span>·</span><div class="list2"><p class="list">Aplicar nuevas formas de presentaciones, materiales y apoyos audiovisuales.</p></div>

								<p class="horario" style="margin-top: 73px">Inicio: 22 y 23 de febrero de 2013 <br>Horario: 10:00-19:00 hrs.</p>
							</div>
						</td>
						<td>
							<div style="margin-left: 13px; ">
								<p class="diplomado">Social Media Strategies</p>
								<p style="margin-top: 37px">Lograrás:</p>
									
									<span>·</span><div class="list2"><p class="list">Aplicar los medios sociales para impulsar la competitividad de tu organización o empresa.</p></div>
									<span>·</span><div class="list2"><p class="list">Fortalecer el diseño de estrategias de marketing en internet.</p></div>
									<span>·</span><div class="list2"><p class="list">Conocer estrategias exitosas de casos reales y aplicarlas a tus propias necesidades.</p></div>
									<span>·</span><div class="list2"><p class="list">Dimensionar el alcance del social media y entender sus mediciones.</p></div>
									
								<p class="horario horario2 " id="horario2" style="margin-top: 97px">Inicio: 05 y 06 de abril de 2013 <br>Horario: 10:00-19:00 hrs.</p>
							</div>
						</td>
						<td>
							<div id="registro">
								<p style="color:red;">Regístrate y conoce:</p>
								<p style="color:red; font-size: 13px; margin-top:-13px">beneficios del programa, plan de descuentos y más.</p>
								<form action="registro_harvard.php" name"harvard" method="post" >
									<label style=" font-size: 13px; margin-top:-13px">*Nombre:</label><br>
									<input type="text" name="nombre" id="nombre"><br>
									<label style=" font-size: 13px;">*Apellido paterno:</label><br>
									<input type="text" name="A_paterno" id="paterno"><br>
									<label style=" font-size: 13px;">*Apellido materno:</label><br>
									<input type="text" name="A_materno" id="materno"><br>
									<label style=" font-size: 13px;">*E-mail:</label><br>
									<input type="text" name="mail" id="mail"><br>
									<label style=" font-size: 13px;">*Teléfono:</label><br>
									<input type="text" name="telefono" id="telefono" style="width: 120px"><select name="tipo_telefono"><option value="celular">Celular</option><option value="telefono">Fijo</option></select><br>
									<label style=" font-size: 13px;">*Programa de interés:</label><br>
									<input type="hidden" value=<?php echo $red; ?> name="red">

										<input type="checkbox" value="386" name="tipo_harvard"><span style="font-size: 13px;color:black;">Strengthening Business <br> <span style="font-size: 13px;color:black;margin-left: 18px;">Presentation Techniques</span></span><br>
										<input type="checkbox" value="387" name="tipo_harvard2" style="font-size: 13px;"  ><span style="font-size: 13px;color:black;">Social Media Strategies</span></input>
										<div class="error_checkbox" style="display: none"></div>
									<br>
									<input type="submit" id="validate_form" value="Enviar">
								</form>

							</div>
							<input type="button" value="ir a diplomados ibero" style="margin-top:6px" class="diplomados">
						</td>

					</tr>
				</table>
			</div>
			<img src="img/sombra_divisoria.png" class="linea">
		</div>
	</div>
</body>
</html>
