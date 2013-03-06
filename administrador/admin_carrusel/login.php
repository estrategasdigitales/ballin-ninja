<?php
session_start();
require_once('../../Connections/otono2011.php'); 
if(isset($_POST['submitted'])){
	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	mysql_select_db($database_otono2011, $otono2011);
	$query = 'SELECT * FROM carrusel_usuarios WHERE usuario="'.$usuario.'" AND pass="'.$password.'"';
	$result = mysql_query($query, $otono2011);
	$rows = mysql_num_rows($result);
	
	if($rows ==1){
		
		$_SESSION['sesion'] = 1;
		$_SESSION['usuario'] = $usuario;
		header("Location:admin_carrusel_home.php");
		
	}
	else{
		?>
		<script type="text/javascript">
	    alert("Usuario o Contrase\u00f1a Incorrectos.");
	    history.back();
	  	</script>
		<?php
		header("Location:index.php");
	}

}


?>