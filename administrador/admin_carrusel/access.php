<?php 
include('libs/db.php'); 

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$query_login = sprintf('SELECT * FROM carrusel_usuarios WHERE usuario="'.$usuario.'" AND pass="'.$password.'"');
$login = mysql_query($query_login, $GLOBALS['DB']) or die(mysql_error());
$login_num_rows = mysql_num_rows($login);
$login_rows = mysql_fetch_assoc($login);


if($login_num_rows == 1){
    
    session_start(); // start session.
        $_SESSION["esvalido"] = "SI";
    $_SESSION["username"] = "Administrador"; 
    header("location: admin_carrusel_home.php");

} else {
    header("location: index.php");
}  


?>