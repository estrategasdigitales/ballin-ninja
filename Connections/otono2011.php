<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_otono2011 = "127.0.0.1";
$database_otono2011 = "decuiaco_site";
$username_otono2011 = "decuiaco";
$password_otono2011 = "DEC2010";
$otono2011 = mysql_pconnect($hostname_otono2011, $username_otono2011, $password_otono2011) or trigger_error(mysql_error(),E_USER_ERROR); 
?>