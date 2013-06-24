<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sistema Seguimiento Preinscripciones Dirección de Educación Continua</title>
<style type="text/css">
<!--


#wrapper {
	position:absolute;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	/*padding:20%;*/
	text-align: center;
	vertical-align: middle;
	z-index: 1;
}

#logo {
	position:absolute;
	display:block;
	overflow:hidden;
	left:50px;
	top:10px;
	bottom:20px;
	z-index: 998;
}

#main {
	position: relative;
	text-align:left;
	height:170px;
	width:320px;
	/*background-color:;*/
	margin: auto;
	top: 30%;
}

#login_window {
	position: relative;
	text-align:left;
	font-family:Verdana, Geneva, sans-serif;
	font-size: 12px;
	color:#FFF;
	height:180px;
	width:320px;
	background-color:;
	border:1px solid #666;
    /*Para darle Opacidad*/
	/*filter:progid:DXImageTransform.Microsoft.Alpha(opacity=80);
	filter:alpha(opacity=80);
	-moz-opacity: 0.8;
	opacity: 0.8;
	-khtml-opacity: 0.8;*/
	
}

#login_window_header {
	position: relative;
	text-align:left;
	font-family:Verdana, Geneva, sans-serif;
	font-size: 20px;
	color:#FFF;
	height:40px;
	width:320px;
	background-color: #ED1C24;
	/*border:1px solid #666;*/
    /*Para darle Opacidad*/
	/*filter:progid:DXImageTransform.Microsoft.Alpha(opacity=80);
	filter:alpha(opacity=80);
	-moz-opacity: 0.8;
	opacity: 0.8;
	-khtml-opacity: 0.8;*/
	
}


#label {
	float:left;
	width:100px;
	color: #ED1C24;
	text-align:right;
	padding-top:20px;
	padding-right:10px;
	padding-right:10px;
}

#inputdiv {
	float:left;
	width:200px;
	height:20px;
	padding-top:20px;
}

#buttons {
	float:left;
	width:320px;
	padding-top:20px;
	padding-bottom:20px;
	/*background-color:#C6F;*/
}
-->
</style>
</head>

<body>

<!--div id="bg" name="bg"><img src="images/bg.jpg" width="100%" height="100%"/></div-->

<div id="wrapper">
    <!--img id="logo" name="logo" src="images/logoEstrategas.png" /-->
	<div id="main">
        <div id="login_window">
        	<div id="login_window_header">&nbsp;&nbsp;IBERO</div>
<form name="verify_form" action="login.php" enctype="multipart/form-data" method="POST">   
                <div id="label">
                    usuario: 
                </div>
                <div id="inputdiv">
                    <input id="username" name="username" type="text" />
                </div>
                <div id="label"> 
                    password: 
                </div>
                <div id="inputdiv">
                    <input id="password" name="password" type="password" />
                </div>
                <div id="buttons">
                    <center><input type="submit" name="verify" id="verify" value="acceder" /></center>
                </div>
            <input type="hidden" name="MM_verify" value="verify_form" />
            </form>
        </div>

		<?php 
        if($_GET["invalidUser"]==true){
        ?>
        	<p style="font-family:Verdana, Geneva, sans-serif; font-size: 11px; color: #F00;">Login o password incorrecto, por favor intente de nuevo.</p>
<script type="text/javascript">
				document.getElementById("username").focus();
            </script>
        <?php
        }
        ?>
        
    </div>
</div>
</body>
</html>
