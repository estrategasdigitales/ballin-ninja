<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_des_preinscritos = "localhost";
$database_des_preinscritos = "decuiaco_site";
$username_des_preinscritos = "decuiaco";
$password_des_preinscritos = "DEC2010";
$des_preinscritos = mysql_pconnect($hostname_des_preinscritos, $username_des_preinscritos, $password_des_preinscritos) or trigger_error(mysql_error(),E_USER_ERROR); 
?>