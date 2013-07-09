<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="utf-8" />
	<title>Oferta Acad&eacute;mica</title>
	<link rel="stylesheet" type="text/css" href="css/landing.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="js/landing.js" type="text/javascript"></script>
</head>
<body>
	<h1>Cat&aacute;logo de Oferta Acad&eacute;mica</h1>
	<map name="imgLandingMap">
		<area shape="rect" coords="60,343,344,386" href="http://www.dec-uia.com/otono_2011/temarios/otono_2013.pdf" onclick="downloadClick()" target="_blank">
      <area shape="rect" coords="262,418,435,438" href="http://www.diplomados.uia.mx" target="_blank">
</map>
	<img src="img/landing.jpg" width="700" border="0" usemap="#imgLandingMap" id="imgLanding" />
	<?php
		include 'inc/catch.class.php';
		$ofertaAcademica = new ofertaAcademica();
		$ofertaAcademica->main();
	?>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-42319605-1', 'dec-uia.com');
		ga('send', 'pageview');
	</script>
</body>
</html>

  																																				
