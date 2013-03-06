<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.js"></script>
<link href="colorbox/colorbox.css" rel="stylesheet" type="text/css" />
<script src="colorbox/jquery.colorbox.js"></script>
<script>
$(document).ready(function(){
		
	//window.location='http://www.dec-uia.com/otono_2011/preinscripcion.php';
	<? if($_GET['reg_news']==1){ ?>
		
		window.open("http://www.dec-uia.com/cgi-bin/dada/mail.cgi?f=subscribe&list=newsDEC&email=<? echo $_GET['email']; ?>");
		
	<? } ?>
	
});
</script>
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #666;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
h1_negro {
	font-size:24px;
	color:#666;
}
h1_rojo {
	font-size:24px;
	color:#F00;
}
h2_negro {
	font-size:18px;
	color:#666;
}
h2_rojo {
	font-size:18px;
	color:#F00;
}
h3_negro {
	color:#666;
}
h3_rojo {
	color:#F00;
}
div.transbox{
	/*position:absolute;*/
	z-index:10;
	width:160px;
	height:30px;
	background:#999;
	color:#FFF;
	vertical-align:central;
	text-align:left;
	padding:2px 0px 0px 0px;
}
div.transbox p{
	font-weight:bold;
	margin:2px 0px 0px 5px;
	color:#FFF;
}
.link_rojo, link_rojo a, link_rojoa:hover, link_rojo a:visited{
	color:#F00;
	text-decoration:none;	
}
.footer{
	background:#999;
	color:#FFF;
	text-align:left;
	padding:10px;
	font-size: 11px;
}
</style>
</head>

<body>
<table width="510" border="0" align="left" cellpadding="0" cellspacing="0">
	<tr>
		<td width="100%" align="center">&nbsp;</td>
	</tr>
	<tr>
	  <td><img src="http://dec-uia.com/FB_landing_page/images/landing_like_trivia2012.jpg" border="0"></td>
  </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center" class="registro">
		<? if($_GET['user']==true){ echo 'El correo proporcionado ya se encuentra registrado.';}else{?>Tu registro fue exitoso.<? } ?><br /><br /><a href="http://dec-uia.com/trivia_2012/registro_b.php" target="_blank"><div style="background:#F00; color:#FFF; cursor:pointer; width:250px; margin:0 auto; text-decoration:none;">Da clic aqu&iacute; para empezar a jugar</div></a></td>
	</tr>	
</table>
</body>
</html>